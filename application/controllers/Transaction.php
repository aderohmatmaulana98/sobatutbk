<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once 'application/third_party/midtrans/Midtrans.php';

class Transaction extends CI_Controller
{
    public function notifhandler()
    {
        $this->load->model('base_model');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$serverKey = 'SB-Mid-server-LeUCYpw_pv89q-NPJ8ovRHB7';
        $notif = new \Midtrans\Notification();

        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $order_id = $notif->order_id;
        $fraud = $notif->fraud_status;

        $log_params = [
            'order_id' => $order_id,
            'payment' => $type,
            'status' => $transaction,
            'created' => date('Y-m-d H:i:s'),
            'status_code' => $notif->status_code
        ];

        $data_order = $this->base_model->get_item('row', 'orders', '*', ['id' => $order_id]);
        if ($data_order['status'] == 'pending' || is_null($data_order['status'])) {
            $this->base_model->update_item('orders', ['payment' => $type, 'status' => $transaction, 'modified' => $notif->transaction_time], ['id' => $order_id]);
            if ($transaction == 'settlement' || ($transaction == 'capture' && $fraud == 'accept')) {
                $ticket = $this->base_model->get_item('row', 'ticket', '*', ['user_id' => $data_order['user_id']]);
                if (!$ticket) {
                    $params = array(
                        'user_id' => $data_order['user_id'],
                        $this->_category($data_order['category']) => $data_order['quantity'],
                        'tps' => $data_order['quantity'],
                    );
                    $this->base_model->insert_item('ticket', $params, 'id');
                } else {
                    $params = array(
                        $this->_category($data_order['category']) => $ticket[$this->_category($data_order['category'])] + $data_order['quantity'],
                        'tps' => $ticket['tps'] + $data_order['quantity'],
                    );
                    $this->base_model->update_item('ticket', $params, array('user_id' => $data_order['user_id']));
                }
                $log_params['msg'] = "Transaction order_id: " . $order_id . " successfully transfered using " . $type . ". Give " . $data_order['quantity'] . " ticket to user_id: " . $data_order['user_id'];
                $this->base_model->insert_item('order_notif', $log_params);
            }
        }
        if ($transaction == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $log_params['msg'] = "Transaction order_id: " . $order_id . " is challenged by FDS";
                } else {
                    $log_params['msg'] = "Transaction order_id: " . $order_id . " successfully captured using " . $type;
                }
            }
        } else if ($transaction == 'settlement') {
            $log_params['msg'] = "Transaction order_id: " . $order_id . " successfully transfered using " . $type;
        } else if ($transaction == 'pending') {
            $log_params['msg'] = "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
        } else if ($transaction == 'deny') {
            $log_params['msg'] = "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
        } else if ($transaction == 'expire') {
            $log_params['msg'] = "Payment using " . $type . " for transaction order_id: " . $order_id . " is expired.";
        } else if ($transaction == 'cancel') {
            $log_params['msg'] = "Payment using " . $type . " for transaction order_id: " . $order_id . " is canceled.";
        }
        $this->base_model->insert_item('order_notif', $log_params);
    }

    public function _category($ctg)
    {
        switch ($ctg) {
            case 1:
                return 'tka_saintek';
            case 2:
                return 'tka_soshum';
            case 3:
                return 'tka_campuran';
        }
    }
}
