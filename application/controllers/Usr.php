<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once 'application/third_party/midtrans/Midtrans.php';

class Usr extends CI_Controller
{
    private $data = [];

    public function __construct()
    {
        parent::__construct();
        $this->load->library(['ion_auth']);
        $this->load->model('base_model');
        $this->_is_logged_in();
        $this->data['user'] = $this->ion_auth->user($this->session->userdata('user_id'))->row();
        $this->_is_doing_exam();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $this->data['tryout_schedule'] = [];
        $this->data['title'] = "Dashboard";
        $this->data['ticket'] = $this->base_model->get_item('row', 'ticket', '*', ['user_id' => $this->session->userdata('user_id')]);
        $get_school_id = $this->base_model->get_item('row', 'users_resellers', 'reseller_id', ['user_id' => $this->session->userdata('user_id')]);
        $this->data['tryout'] = $this->base_model->get_join_item('result', 'tryout.*, tryout_group.name as tryout_group_name, tryout_school.start_date, tryout_school.start_time, tryout_school.end_date, tryout_school.end_time', NULL, 'tryout', ['tryout_group', 'tryout_school'], ['tryout.tryout_group_id=tryout_group.id', 'tryout_school.tryout_id=tryout.id'], ['inner', 'inner'], ['tryout_school.status' => 1, 'tryout_school.user_school_id' => $get_school_id['reseller_id']]);
        $exam_data = $this->base_model->get_item('result', 'exam', 'tryout_group_id, category', ['user_id' => $this->session->userdata('user_id')]);
        $this->data['exam_data'] = [];
        if (!empty($exam_data)) {
            foreach ($exam_data as $v) {
                $this->data['exam_data'][$v['tryout_group_id']] = $v['category'];
            }
        }
        //show tryout schedule each month
        if (!empty($this->data['tryout'])) {
            foreach ($this->data['tryout'] as $v) {
                $this->data['tryout_schedule'][$v['tryout_group_id']][] = $v;
                $this->data['tryout_schedule'][$v['tryout_group_id']]['tryout_group_name'] = $v['tryout_group_name'];
            }
        }

        $user_id = $this->session->userdata('user_id');
        $this->data['exam'] = $this->base_model->get_item('row', 'exam', '*', ['user_id' => $this->session->userdata('user_id'), 'month' => date('n')]);

        $sql = "SELECT exam.`tps`, exam.`tka`
        FROM exam, users
        WHERE exam.`user_id` = users.`id`
        AND users.`id` = $user_id";
        $this->data['exam1'] = $this->db->query($sql)->row_array();

        $cek_user = "SELECT COUNT(`exam`.`user_id`)
        FROM `exam`, `users`
        WHERE exam.`user_id` = users.`id`
        AND users.`id` = $user_id";

        $this->data['cek'] = $this->db->query($cek_user)->row_array();

        $this->data['user_dashboard'] = $this->db->get('interface_user_dashboard')->result_array();
        $this->data['user_list_1'] = $this->db->get('interface_user_list_1')->result_array();
        $this->data['img'] = $this->db->get('interface_img')->result_array();
        // $waktu_sekarang = date('d-m-Y H:i:s', time()+60);
        // $cobaan = date('d-m-Y H:i:s', strtotime($waktu_sekarang) ) ;
        // var_dump($waktu_sekarang);
        // die;
        if (!empty($this->data['tryout'])) {
            foreach ($this->data['tryout'] as $sesi) {
                if ($sesi['type'] == 1) {
                    $this->data['active_room'][$sesi['active_month']]['tka_saintek'] = 0;
                }
                if ($sesi['type'] == 2) {
                    $this->data['active_room'][$sesi['active_month']]['tka_soshum'] = 0;
                }
                if ($sesi['type'] == 3) {
                    $this->data['active_room'][$sesi['active_month']]['tka_campuran'] = 0;
                }
                if ($sesi['type'] == 4) {
                    $this->data['active_room'][$sesi['active_month']]['tps'] = 0;
                }
                $doing_exam = $this->base_model->get_item('row', 'exam', 'month, status, COUNT(*) as active_exam', ['month' => $sesi['active_month'], 'status' => $sesi['type']]);

                if (!empty($doing_exam)) {
                    if ($doing_exam['status'] == 1) {
                        $this->data['active_room'][$sesi['active_month']]['tka_saintek'] = $doing_exam['active_exam'];
                    }
                    if ($doing_exam['status'] == 2) {
                        $this->data['active_room'][$sesi['active_month']]['tka_soshum'] = $doing_exam['active_exam'];
                    }
                    if ($doing_exam['status'] == 3) {
                        $this->data['active_room'][$sesi['active_month']]['tka_campuran'] = $doing_exam['active_exam'];
                    }
                    if ($doing_exam['status'] == 4) {
                        $this->data['active_room'][$sesi['active_month']]['tps'] = $doing_exam['active_exam'];
                    }
                }
            }
        }

        $this->load->view('user/template/header', $this->data);
        $this->load->view('user/template/sidebar');
        $this->load->view('user/template/topbar');
        $this->load->view('user/index');
        $this->load->view('user/template/footer');
    }

    public function statistik()
    {
        $this->load->helper('url');

        $this->data['tryout'] = $this->base_model->get_item('result', 'tryout_group', 'id, name');
        $tryout_group_id = $this->input->post('tryout_group');
        $this->data['exam_month'] = 12;
        if ($this->input->post('exam_score_item')) {
            $this->form_validation->set_rules('exam_score_item', 'Bulan', 'trim|numeric|required');
            if ($this->form_validation->run() === TRUE) {
                $this->data['exam_month'] = $this->input->post('exam_score_item', TRUE);
            }
        };
        $this->data['exam_history'] = $this->base_model->get_join_item('result', 'exam_history.*, tryout_group.name as tryout_group_name', 'exam_id ASC', 'exam_history', ['exam', 'tryout_group'], ['exam.id=exam_history.exam_id', 'exam.tryout_group_id=tryout_group.id'], ['inner', 'inner'], ['exam.user_id' => $this->session->userdata('user_id'), 'exam.tryout_group_id' => $tryout_group_id]);
        $this->data['orders'] = $this->base_model->get_item('result', 'orders', '*', ['user_id' => $this->session->userdata('user_id')]);

        $this->data['utbk_score'] = $this->base_model->get_join_item('result', 'exam_score.*, kategori_soal.category, kategori_soal.subject', NULL, 'exam_score', ['exam', 'kategori_soal'], ['exam.id=exam_score.exam_id', 'exam_score.kategori_soal_id = kategori_soal.id'], ['inner', 'inner'], ['exam.user_id' => $this->session->userdata('user_id'), 'exam.tryout_group_id' => $tryout_group_id, 'scope' => 3]);
        // var_dump($this->data['utbk_score']);
        // die;
        $this->data['user_dashboard'] = $this->db->get('interface_user_dashboard')->result_array();
        $this->data['user_list_1'] = $this->db->get('interface_user_list_1')->result_array();
        $this->data['img'] = $this->db->get('interface_img')->result_array();

        $score_limit = $this->base_model->get_join_item('result', 'MIN(exam_score.score) as min, MAX(exam_score.score) as max, exam_score.kategori_soal_id', NULL, 'exam_score', ['exam', 'kategori_soal'], ['exam.id=exam_score.exam_id', 'exam_score.kategori_soal_id = kategori_soal.id'], ['inner', 'inner'], ['exam.tryout_group_id' => $tryout_group_id, 'scope' => 3], ['exam_score.kategori_soal_id']);
        if (!empty($score_limit)) {
            foreach ($score_limit as $v) {
                $this->data['score_limit'][$v['kategori_soal_id']] = [
                    'max' => $v['max'],
                    'min' => $v['min'],
                ];
            }
        }
        $this->data['ptn1'] = $this->base_model->get_join_item('row', 'exam.ptn1, ptn.nama, ptn.jurusan, ptn.point', NULL, 'exam', ['ptn'], ['ptn.id = exam.ptn1'], ['inner'], ['exam.tryout_group_id' => $tryout_group_id, 'exam.user_id' => $this->session->userdata('user_id')]);
        $this->data['ptn2'] = $this->base_model->get_join_item('row', 'exam.ptn2, ptn.nama, ptn.jurusan, ptn.point', NULL, 'exam', ['ptn'], ['ptn.id = exam.ptn2'], ['inner'], ['exam.tryout_group_id' => $tryout_group_id, 'exam.user_id' => $this->session->userdata('user_id')]);
        //get chart data
        $chart_data = $this->base_model->get_join_item('result', 'SUM(exam_score.score)/COUNT(exam_score.score) as pfm, exam.month', 'exam.id ASC', 'exam_score', ['exam'], ['exam.id=exam_score.exam_id'], ['inner'], ['exam.user_id' => $this->session->userdata('user_id')], ['month']);
        //assign to month as index
        $chart_item = [
            12 => 0,
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
            6 => 0,
            7 => 0,
            8 => 0,
            9 => 0,
            10 => 0,
            11 => 0,
        ];
        if (!empty($chart_data)) {
            foreach ($chart_data as $v) {
                $chart_item[$v['month']] = round($v['pfm'], 2);
            }
        }
        $this->data['chart_data'] = implode(',', $chart_item);
        $this->data['title'] = "Statistik";

        // begin for output

        $this->data['chart_data_score'] = $this->base_model->get_join_item('result', 'AVG(exam_score.score) as score, tryout_group.name', NULL, 'exam_score', ['exam', 'tryout_group'], ['exam.id=exam_score.exam_id', 'exam.tryout_group_id=tryout_group.id'], ['inner', 'inner'], ['exam.user_id' => $this->session->userdata('user_id')], ['exam.tryout_group_id']);
        $this->data['avg_score'] = $this->base_model->get_join_item('row', 'AVG(exam_score.score) as score', NULL, 'exam_score', ['exam'], ['exam.id=exam_score.exam_id'], ['inner'], ['exam.user_id' => $this->session->userdata('user_id'), 'exam.tryout_group_id' => $tryout_group_id, 'scope' => 3]);
        $avg_score = $this->data['avg_score']['score'];

        //output 1: Pilihan Prodi Berdasarkan Minat Siswa
        if (!empty($this->data['ptn1']) && !empty($this->data['ptn2']) && !empty($this->data['utbk_score'])) {
            $ptn1 = $this->data['ptn1']['ptn1'];
            $ptn2 = $this->data['ptn2']['ptn2'];
            $this->data['choosen_university'] = $this->base_model->get_item('result', 'ptn', '*', ["id IN ($ptn1, $ptn2)" => NULL]);

            //output 2: Rekomendasi Pilihan Prodi yang Sama Sesuai Pilihan Siswa Di Provinsi yang Dipilih
            $this->data['output2'] = [];
            foreach ($this->data['choosen_university'] as $v) {
                $get_recom = $this->base_model->get_item('result', 'ptn', "*, ROUND($avg_score,2) - point as gap", ['kategori' => $v['kategori'], 'provinsi' => $v['provinsi'], 'jurusan' => $v['jurusan'], 'point <' => $avg_score], NULL, 'gap ASC', 3);
                if ($get_recom) {
                    array_push($this->data['output2'], $get_recom);
                }
            }

            //output 3: Rekomendasi Pilihan Prodi yang Sama Sesuai Pilihan Siswa Di Wilayah (Regional) PTN
            $this->data['output3'] = [];
            foreach ($this->data['choosen_university'] as $v) {
                $get_recom = $this->base_model->get_item('result', 'ptn', "*, ROUND($avg_score,2) - point as gap", ['kategori' => $v['kategori'], 'wilayah' => $v['wilayah'], 'jurusan' => $v['jurusan'], 'point <' => $avg_score], NULL, 'gap ASC', 3);
                if ($get_recom) {
                    array_push($this->data['output3'], $get_recom);
                }
            }

            //output 4: Rekomendasi Pilihan Prodi Sesuai PTN Pilihan Siswa
            $this->data['output4'] = [];
            foreach ($this->data['choosen_university'] as $v) {
                $get_recom = $this->base_model->get_item('result', 'ptn', "*, ROUND($avg_score,2) - point as gap", ['kategori' => $v['kategori'], 'nama' => $v['nama'], 'point <' => $avg_score], NULL, 'gap ASC', 3);
                array_push($this->data['output4'], $get_recom);
            }

            //output 5: Rekomendasi Pilihan Prodi Sesuai Kompetensi Siswa di PTN yang Dipilih
            $this->data['tryout_score'] = $this->base_model->get_join_item('result', 'exam.category, exam_score.*', NULL, 'exam_score', ['exam'], ['exam.id=exam_score.exam_id'], ['inner'], ['exam.tryout_group_id' => $tryout_group_id, 'exam.user_id' => $this->session->userdata('user_id'), 'scope' => 3]);
            $exam_category = $this->data['tryout_score'][0]['category'];
            $score_tka = [];
            if ($exam_category == 'saintek') {
                foreach ($this->data['tryout_score'] as $v) {
                    if ($v['kategori_soal_id'] == 6) {
                        $score_tka[0] = [
                            'score' => $v['score'],
                            'category' => 'tka1'
                        ];
                    }
                    if ($v['kategori_soal_id'] == 7) {
                        $score_tka[1] = [
                            'score' => $v['score'],
                            'category' => 'tka2'
                        ];
                    }
                    if ($v['kategori_soal_id'] == 8) {
                        $score_tka[2] = [
                            'score' => $v['score'],
                            'category' => 'tka3'
                        ];
                    }
                    if ($v['kategori_soal_id'] == 9) {
                        $score_tka[3] = [
                            'score' => $v['score'],
                            'category' => 'tka4'
                        ];
                    }
                }
            } else if ($exam_category == 'soshum') {
                foreach ($this->data['tryout_score'] as $v) {
                    if ($v['kategori_soal_id'] == 10) {
                        $score_tka[0] = [
                            'score' => $v['score'],
                            'category' => 'tka1'
                        ];
                    }
                    if ($v['kategori_soal_id'] == 11) {
                        $score_tka[1] = [
                            'score' => $v['score'],
                            'category' => 'tka2'
                        ];
                    }
                    if ($v['kategori_soal_id'] == 12) {
                        $score_tka[2] = [
                            'score' => $v['score'],
                            'category' => 'tka3'
                        ];
                    }
                    if ($v['kategori_soal_id'] == 13) {
                        $score_tka[3] = [
                            'score' => $v['score'],
                            'category' => 'tka4'
                        ];
                    }
                }
            }
            usort($score_tka, function ($a, $b) {
                return $b['score'] <=> $a['score'];
            });

            $ptn_list = [];
            foreach ($this->data['choosen_university'] as $v) {
                $get_recom = $this->base_model->get_item('result', 'ptn', "*, ROUND($avg_score,2) - point as gap", ['kategori' => $v['kategori'], 'nama' => $v['nama'], 'point <' => $avg_score], NULL, 'gap ASC');
                array_push($ptn_list, $get_recom);
            }

            $this->data['output5'] = [];
            if (!empty($ptn_list)) {
                foreach ($ptn_list as $prodi) {
                    $output5_list = [];
                    if (!empty($prodi)) {
                        foreach ($prodi as $v) {
                            $score_prodi[0] = [
                                'score' => $v['tka1'],
                                'category' => 'tka1'
                            ];
                            $score_prodi[1] = [
                                'score' => $v['tka2'],
                                'category' => 'tka2'
                            ];
                            $score_prodi[2] = [
                                'score' => $v['tka3'],
                                'category' => 'tka3'
                            ];
                            $score_prodi[3] = [
                                'score' => $v['tka4'],
                                'category' => 'tka4'
                            ];

                            usort($score_prodi, function ($a, $b) {
                                return $b['score'] <=> $a['score'];
                            });

                            if ($score_tka[0]['category'] == $score_prodi[0]['category'] && $score_tka[1]['category'] == $score_prodi[1]['category']) {
                                array_push($output5_list, $v);
                                if (count($output5_list) == 3) {
                                    break;
                                }
                            }
                        }
                    }
                    array_push($this->data['output5'], $output5_list);
                }
            }
        }

        $this->data['output'] = ['tryout_group_id' => $this->input->post('tryout_group')];

        
        if ($this->input->get('action') != "download") {
            $this->load->view('user/template/header', $this->data);
            $this->load->view('user/template/sidebar');
            $this->load->view('user/template/topbar');
            $this->load->view('user/statistik/statistik');
            $this->load->view('user/template/footer');
        } else {
            $this->load->view('user/statistik/download', $this->data);
        }

    }

    public function pembahasan($exam_id, $category)
    {
        if (!$this->base_model->get_item('row', 'exam', '*', ['id' => $exam_id])) {
            show_404();
        }
        $ctg = '';
        switch ($category) {
            case 1:
                $ctg = '(6,7,8,9)';
                break;
            case 2:
                $ctg = '(10,11,12,13)';
                break;
            case 3:
                $ctg = '(1,2,3,4,5,6,7,8,9)';
                break;
            case 4:
                $ctg = '(1,2,3,4)';
                break;
            default:
                show_404();
        }
        $this->data['item'] = [];
        $item = $this->base_model->get_join_item('result', 'user_exam.user_answer, user_exam.kategori_soal_id, soal.description as soal, soal.opt1, soal.opt2, soal.opt3, soal.opt4, soal.opt5, soal.answer, soal.explanation, kategori_soal.category, kategori_soal.subject, materi.name as materi, indikator.name as indikator', NULL, 'user_exam', ['exam', 'kategori_soal', 'soal', 'materi', 'indikator'], ['exam.id=user_exam.exam_id', 'user_exam.kategori_soal_id=kategori_soal.id', 'user_exam.soal_id=soal.id', 'soal.materi_id=materi.id', 'soal.indikator_id=indikator.id'], ['inner', 'inner', 'inner', 'left', 'left'], ['exam.user_id' => $this->session->userdata('user_id'), 'exam_id' => $exam_id, "user_exam.kategori_soal_id IN $ctg" => NULL]);
        foreach ($item as $v) {
            $this->data['item'][$v['kategori_soal_id']]['soal'][] = $v;
            $this->data['item'][$v['kategori_soal_id']]['category'] = $v['category'];
            $this->data['item'][$v['kategori_soal_id']]['subject'] = $v['subject'];
        }
        $this->data['title'] = "Pembahasan";
        $this->load->view('user/template/header', $this->data);
        $this->load->view('user/pembahasan');
        $this->load->view('user/template/footer');
    }

    //Product Section
    public function product()
    {
        $this->data['title'] = "Product";

        $this->data['product'] = $this->base_model->get_join_item('result', 'product.*', NULL, 'product', ['product_item'], ['product.id=product_item.product_id'], ['inner'], ['status' => 1], ['product.id']);

        $this->load->view('user/template/header', $this->data);
        $this->load->view('user/template/sidebar');
        $this->load->view('user/template/topbar');
        $this->load->view('user/product/product');
        $this->load->view('user/template/footer');
    }

    public function order($id)
    {
        $this->data['title'] = "Product";
        $this->data['product'] = $this->base_model->get_item('row', 'product', '*', ['id' => $id]);
        if (!$this->data['product']) {
            show_404();
        }
        $this->data['product_item'] = $this->base_model->get_item('result', 'product_item', '*', ['product_id' => $id]);

        if ($this->input->post('ticket')) {
            $this->form_validation->set_rules('ticket', 'Tiket', 'trim|numeric|required');

            if ($this->form_validation->run() === TRUE) {
                $item = $this->base_model->get_item('row', 'product_item', '*', ['id' => $this->input->post('ticket')]);
                if (!$item) {
                    show_404();
                }
                $params = [
                    'product_id' => $item['product_id'],
                    'product_name' => $this->data['product']['name'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'user_id' => $this->session->userdata('user_id'),
                    'category' => $this->input->post('category'),
                    'created' => date('Y-m-d H:i:s')
                ];
                $order = $this->base_model->insert_item('orders', $params, 'id');
                if ($order) {
                    $order_item = $this->base_model->get_item('row', 'orders', '*', ['id' => $order]);
                    //$this->session->set_flashdata('message_sa', 'Kamu memesan ' . $order_item['quantity'] . ' Tiket ' . $order_item['product_name'] . ' Harga ' . number_format($order_item['price'], 0, '', '.') . '. Kamu akan diarahkan ke WA untuk menyelesaikan pesananmu.');
                    //$this->session->set_flashdata('message_wa', 'Halo kak saya telah pesan ' . $order_item['quantity'] . ' Tiket ' . $order_item['product_name'] . ' Harga ' . number_format($order_item['price'], 0, '', '.'));
                    redirect('usr/transaction/' . $order);
                }
            }
        }
        $this->load->view('user/template/header', $this->data);
        $this->load->view('user/template/sidebar');
        $this->load->view('user/template/topbar');
        $this->load->view('user/product/product_item');
        $this->load->view('user/template/footer');
    }

    public function order_history($id)
    {
    }

    //Transaction Handling
    public function transaction($id)
    {
        $this->data['orders'] = $this->base_model->get_join_item('row', 'orders.*, users.first_name, users.email, users.phone', NULL, ['orders'], ['users'], ['orders.user_id = users.id'], ['inner'], ['orders.id' => $id]);
        if (empty($this->data['orders'])) {
            show_404();
        }
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-LeUCYpw_pv89q-NPJ8ovRHB7';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        $this->data['clientKey'] = 'SB-Mid-client-_MbfciIfUsdrBIKp';
        $this->data['snapToken'] = $this->data['orders']['snaptoken'];

        if (is_null($this->data['orders']['snaptoken'])) {

            $params = array(
                'transaction_details' => array(
                    'order_id' => $this->data['orders']['id'],
                    'gross_amount' => $this->data['orders']['price'],
                ),
                'item_details' => [array(
                    'id' => $this->data['orders']['product_id'],
                    'price' => $this->data['orders']['price'],
                    'quantity' => 1,
                    'name' => $this->data['orders']['product_name'] . ' ' . $this->data['orders']['quantity'] . ' Tiket',
                    'category' => $this->data['orders']['category'],
                )],
                'customer_details' => array(
                    'first_name' => $this->data['orders']['first_name'],
                    'email' => $this->data['orders']['email'],
                    'phone' => $this->data['orders']['phone'],
                ),
            );

            $this->data['snapToken'] = \Midtrans\Snap::getSnapToken($params);
        }

        if ($this->data['orders']['payment'] == 'gopay' && $this->data['orders']['status'] == 'pending') {
            $status = get_object_vars(\Midtrans\Transaction::status($this->data['orders']['id']));
            if ($status['transaction_status'] == 'pending') {
                $cancel = \Midtrans\Transaction::cancel($this->data['orders']['id']);
                $this->base_model->update_item('orders', ['status' => 'cancel'], ['id' => $this->data['orders']['id']]);
                $this->data['orders']['status'] = 'cancel';
            }
        }
        $this->data['title'] = "Pembayaran";

        $this->load->view('user/template/header', $this->data);
        $this->load->view('user/product/detail_pembayaran');
        $this->load->view('user/template/footer');
    }

    public function update_transaction()
    {
        $data_order = $this->base_model->get_item('row', 'orders', '*', ['id' => $this->input->post('id')]);
        if ($data_order) {
            $params = [
                'payment' => $this->input->post('payment'),
                'status' => $this->input->post('status'),
                'modified' => $this->input->post('modified'),
            ];
            if ($data_order['status'] == 'pending' || is_null($data_order['status'])) {
                $this->base_model->update_item('orders', $params, ['id' => $this->input->post('id')]);
            }

            if ($this->input->post('status') == 'settlement' && ($data_order['status'] == 'pending' || is_null($data_order['status']))) {
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
                $log_params = [
                    'order_id' => $this->input->post('id'),
                    'payment' => $this->input->post('payment'),
                    'status' => $this->input->post('status'),
                    'created' => date('Y-m-d H:i:s'),
                    'status_code' => 200,
                    'msg' => "Transaction order_id: " . $this->input->post('id') . " successfully transfered using " . $this->input->post('payment') . ". Give " . $data_order['quantity'] . " ticket to user_id: " . $data_order['user_id'],
                ];
                $this->base_model->insert_item('order_notif', $log_params);
            }
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }

    public function update_snaptoken()
    {
        $data = $this->base_model->get_item('row', 'orders', '*', ['id' => $this->input->post('id')]);
        if ($data) {
            if (is_null($data['snaptoken'])) {
                $this->base_model->update_item('orders', ['snaptoken' => $this->input->post('snaptoken')], ['id' => $this->input->post('id')]);
            }
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }

    public function get_transaction()
    {
        $data = $this->base_model->get_item('row', 'orders', 'product_name, payment, status', ['id' => $this->input->post('id')]);
        if ($data) {
            echo json_encode(['status' => TRUE, 'data' => $data]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }

    public function profile()
    {
        $this->data['title'] = "Profile";

        $this->load->view('user/template/header', $this->data);
        $this->load->view('user/template/sidebar');
        $this->load->view('user/template/topbar');
        $this->load->view('user/profile');
        $this->load->view('user/template/footer');
    }

    //Authentication
    public function _is_logged_in()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }
    }

    public function _is_doing_exam()
    {
        $exam_data = $this->base_model->get_item('row', 'exam', '*', ['user_id' => $this->session->userdata('user_id'), 'status !=' => 0]);
        if ($exam_data) {
            if (date('Y-m-d H:i:s') <= date('Y-m-d H:i:s', strtotime($exam_data['finish_date']))) {
                redirect('exm/ujian/' . $exam_data['is_doing']);
            } else {
                $params = array(
                    'status' => 0,
                    'end_date' => NULL,
                    'finish_date' => NULL,
                    'is_doing' => NULL
                );
                switch ($exam_data['status']) {
                    case 1:
                    case 2:
                    case 3:
                        $params['tka'] = 1;
                        break;
                    case 4:
                        $params['tps'] = 1;
                        break;
                }
                $this->base_model->update_item('exam', $params, array('user_id' => $this->session->userdata('user_id'), 'status' => $exam_data['status']));
                $this->base_model->update_item('user_exam', ['reset' => 0, 'tampil' => 0], array('exam_id' => $exam_data['id'], 'category' => $exam_data['status']));
                $this->session->set_flashdata('message_sa', 'Selamat kamu telah menyelesaikan TPS/TKA');
                redirect('usr');
            }
        }
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
