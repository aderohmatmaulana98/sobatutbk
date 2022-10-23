<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once 'application/controllers/manage_school/Base.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Userdata extends SchoolBase
{
    public function __construct()
    {
        parent::__construct();
        if ($this->base_model->get_join_item('row', '*', NULL, 'users', ['users_groups'], ['users.id=users_groups.user_id'], ['inner'], ['users.id' => $this->session->userdata('user_id'), 'group_id' => 2])) {
            $this->_is_logged_in();
        }
        $this->data['title'] = "User data";
    }

    public function index($id = NULL)
    {
        $this->data['reseller'] = FALSE;

        $user_id = $this->session->userdata('user_id');

        $sql = "SELECT users.`first_name`, users.`company`, users.`username`, users.`active`, users.id
        FROM users, `groups`, `users_groups`, users_resellers
        WHERE groups.`id` = users_groups.`group_id`
        AND users.`id` = users_groups.`user_id`
        AND users_resellers.`user_id` = users.`id`
        AND `users_resellers`.`reseller_id` = $user_id";

        $this->data['item'] = $this->db->query($sql)->result_array();
        if ($this->base_model->get_join_item('row', '*', NULL, 'users', ['users_groups'], ['users.id=users_groups.user_id'], ['inner'], ['users.id' => $this->session->userdata('user_id'), 'group_id' => 3])) {
            if (!is_null($id) && !$this->base_model->get_item('row', ['users_resellers'], '*', ['user_id' => $id, 'reseller_id' => $this->session->userdata('user_id')])) {
                show_404();
            }
            $this->data['item'] = $this->base_model->get_join_item('result', 'users.*', NULL, 'users', ['users_resellers'], ['users.id=users_resellers.user_id'], ['inner'], ['reseller_id' => $this->session->userdata('user_id')]);
            $this->data['users_ticket'] = $this->base_model->get_join_item('result', 'users.*, users_ticket.id as ticket_id, users_ticket.category, users_ticket.quantity, users_ticket.status,users_ticket.created', NULL, 'users', ['users_ticket'], ['users.id=users_ticket.user_id'], ['inner'], ['reseller_id' => $this->session->userdata('user_id')]);
            $this->data['reseller'] = TRUE;
        }
        $this->data['user'] = $this->base_model->get_item('row', 'users', '*', ['id' => $id]);
        $this->data['ticket'] = $this->base_model->get_item('row', 'ticket', '*', ['user_id' => $id]);
        $sesi = $this->session->userdata('user_id');
        $data['sesi1'] = $sesi;
        $sql = "SELECT  users.*, `groups`.`id` AS grup_id FROM users, groups, users_groups WHERE users.`id`=users_groups.`user_id`AND `groups`.`id` = `users_groups`.`group_id`AND users.`id` = $sesi";
        $data['cek_user'] = $this->db->query($sql)->row_array();
        $data['cek_user'] = $data['cek_user']['grup_id'];
        $this->schoolview('school/userdata/userdata', $this->data);
    }

    public function add_ticket()
    {
        $this->form_validation->set_rules('type', 'Produk', 'trim|required');
        $this->form_validation->set_rules('quantity', 'Jumlah Tiket', 'trim|numeric|required');

        if ($this->form_validation->run() === FALSE) {
            $this->_result_msg('danger', validation_errors());
            redirect('manage_school/userdata/index/' . $this->input->post('user_id'));
        } else {
            if (!$this->base_model->get_item('row', 'users', '*', ['id' => $this->input->post('user_id')])) {
                $this->_result_msg('success', 'Pilih user yang akan ditambahkan tiket');
                redirect('manage_school/userdata/index/' . $this->input->post('user_id'));
            }
            if ($this->base_model->get_join_item('row', '*', NULL, 'users', ['users_groups'], ['users.id=users_groups.user_id'], ['inner'], ['users.id' => $this->session->userdata('user_id'), 'group_id' => 3])) {
                $params = array(
                    'user_id' => $this->input->post('user_id'),
                    'reseller_id' => $this->session->userdata('user_id'),
                    'category' => $this->input->post('type'),
                    'quantity' => $this->input->post('quantity'),
                    'status' => 0,
                    'created' => time()
                );
                $this->_result_msg('success', 'Tiket berhasil ditambahkan. Menunggu disetujui.');
                $this->base_model->insert_item('users_ticket', $params);
            } else {
                $ticket = $this->base_model->get_item('row', 'ticket', '*', ['user_id' => $this->input->post('user_id')]);
                if (!$ticket) {
                    $params = array(
                        'user_id' => $this->input->post('user_id'),
                        $this->input->post('type') => $this->input->post('quantity'),
                        'tps' => $this->input->post('quantity'),
                    );
                    $this->base_model->insert_item('ticket', $params, 'id');
                } else {
                    $params = array(
                        $this->input->post('type') => $ticket[$this->input->post('type')] + $this->input->post('quantity'),
                        'tps' => $ticket['tps'] + $this->input->post('quantity'),
                    );
                    $this->base_model->update_item('ticket', $params, array('user_id' => $this->input->post('user_id')));
                }
                $this->_result_msg('success', 'Tiket berhasil ditambahkan. Menunggu disetujui.');
            }
            redirect('manage_school/userdata/index/' . $this->input->post('user_id'));
        }
    }

    public function delete_ticket($id = NULL)
    {
        $ticket = $this->base_model->get_item('row', 'users_ticket', '*', ['id' => $id, 'status' => 0]);
        if (!empty($ticket)) {
            $this->base_model->delete_item('users_ticket', ['id' => $id]);
            $this->_result_msg('success', 'Pengajuan tiket telah dibatalkan.');
        }
        redirect('manage_school/userdata/index/');
    }

    public function create_user()
    {
        $tables = $this->config->item('tables', 'ion_auth');
        $identity_column = $this->config->item('identity', 'ion_auth');
        $this->data['identity_column'] = $identity_column;
        $this->config->set_item('ion_auth', FALSE, 'email_activation');

        // validate form input
        $this->form_validation->set_rules('first_name', 'Nama', 'trim|required');
        if ($identity_column !== 'email') {
            $this->form_validation->set_rules('identity', 'Username', 'trim|required|is_unique[' . $tables['users'] . '.' . $identity_column . ']');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[' . $tables['users'] . '.email]');
        } else {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[' . $tables['users'] . '.email]');
        }
        $this->form_validation->set_rules('phone', 'Phone', 'trim|numeric|required');
        $this->form_validation->set_rules('company', 'Sekolah', 'trim');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']');
        //$this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[password_confirm]');
        //$this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

        if ($this->form_validation->run() === TRUE) {
            $email = strtolower($this->input->post('email'));
            $identity = $this->input->post('identity');
            $password = $this->input->post('password');

            $additional_data = [
                'first_name' => $this->input->post('first_name'),
                'company' => $this->input->post('company'),
                'phone' => $this->input->post('phone'),
            ];
        }
        if ($this->form_validation->run() === TRUE && $this->ion_auth->register($identity, $password, $email, $additional_data, [2])) {

            // check to see if we are creating the user
            // redirect them back to the admin page
            $user_id = $this->base_model->get_item('row', 'users', 'id', ['username' => $identity]);
            if (!$this->base_model->get_item('row', 'users_resellers', '*', ['user_id' => $user_id['id']])) {
                $this->base_model->insert_item('users_resellers', ['user_id' => $user_id['id'], 'reseller_id' => $this->session->userdata('user_id')]);
            }
            $this->session->set_flashdata('msg', $this->ion_auth->messages());
            redirect("manage_school/userdata", 'refresh');
        } else {
            // display the create user form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['first_name'] = [
                'name' => 'first_name',
                'id' => 'first_name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('first_name'),
                'class' => 'form-control',
                'placeholder' => 'Nama'
            ];
            $this->data['identity'] = [
                'name' => 'identity',
                'id' => 'identity',
                'type' => 'text',
                'value' => $this->form_validation->set_value('identity'),
                'class' => 'form-control',
                'placeholder' => 'Username'
            ];
            $this->data['email'] = [
                'name' => 'email',
                'id' => 'email',
                'type' => 'text',
                'value' => $this->form_validation->set_value('email'),
                'class' => 'form-control',
                'placeholder' => 'Email'
            ];
            $this->data['company'] = [
                'name' => 'company',
                'id' => 'company',
                'type' => 'text',
                'value' => $this->form_validation->set_value('company'),
                'class' => 'form-control',
                'placeholder' => 'Sekolah'
            ];
            $this->data['phone'] = [
                'name' => 'phone',
                'id' => 'phone',
                'type' => 'text',
                'value' => $this->form_validation->set_value('phone'),
                'class' => 'form-control',
                'placeholder' => 'No Telp/WA'
            ];
            $this->data['password'] = [
                'name' => 'password',
                'id' => 'password',
                'type' => 'password',
                'value' => $this->form_validation->set_value('password'),
                'class' => 'form-control',
                'placeholder' => 'Password'
            ];
            $this->data['password_confirm'] = [
                'name' => 'password_confirm',
                'id' => 'password_confirm',
                'type' => 'password',
                'value' => $this->form_validation->set_value('password_confirm'),
            ];
            $this->schoolview('school/reseller/create_user', $this->data);
        }
    }

    public function import_user()
    {
        $file_mime = array('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/zip', 'application/vnd.ms-excel', 'application/msword', 'application/x-zip', 'application/vnd.ms-excel', 'application/msexcel', 'application/x-msexcel', 'application/x-ms-excel', 'application/x-excel', 'application/x-dos_ms_excel', 'application/xls', 'application/x-xls', 'application/excel', 'application/download', 'application/vnd.ms-office', 'application/msword');
        $file_name = $_FILES['user_file']['name'];
        if ($file_name && in_array($_FILES['user_file']['type'], $file_mime)) {

            $worksheet = IOFactory::load($_FILES['user_file']['tmp_name']);
            $sheetData = $worksheet->getActiveSheet()->toArray();
            if (!empty($sheetData)) {
                for ($i = 1; $i < count($sheetData); $i++) {
                    $param = [
                        'username' => trim($sheetData[$i][0]),
                        'email' => empty(trim($sheetData[$i][1])) ? NULL : trim($sheetData[$i][1]),
                        'password' => empty(trim($sheetData[$i][2])) ? NULL : trim($sheetData[$i][2]),
                        'first_name' => empty(trim($sheetData[$i][3])) ? NULL : trim($sheetData[$i][3]),
                        'company' => empty(trim($sheetData[$i][4])) ? NULL : trim($sheetData[$i][4]),
                        'kelas' => empty(trim($sheetData[$i][5])) ? NULL : trim($sheetData[$i][5]),
                        'kabupaten' => empty(trim($sheetData[$i][6])) ? NULL : trim($sheetData[$i][6]),
                        'provinsi' => empty(trim($sheetData[$i][7])) ? NULL : trim($sheetData[$i][7]),
                        'phone' => empty(trim($sheetData[$i][8])) ? NULL : trim($sheetData[$i][8]),
                        'gender' => empty(trim($sheetData[$i][9])) ? 0 : trim($sheetData[$i][9])
                    ];
                    $this->base_model->insert_item('users_generate', $param);
                }
                $this->_generate_user();

                //create result output
                $user_data = $this->base_model->get_item('result', 'users_generate', '*');
                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();
                $i = 2;
                $sheet->setCellValue('A1', 'Username/NISN');
                $sheet->setCellValue('B1', 'Password');
                $sheet->setCellValue('C1', 'Nama');
                $sheet->setCellValue('D1', 'Sekolah');
                $sheet->setCellValue('E1', 'Keterangan');
                if (!empty($user_data)) {
                    foreach ($user_data as $v) {
                        $sheet->setCellValue('A' . $i, $v['username']);
                        $sheet->setCellValue('B' . $i, $v['password']);
                        $sheet->setCellValue('C' . $i, $v['first_name']);
                        $sheet->setCellValue('D' . $i, $v['company']);
                        $sheet->setCellValue('E' . $i, $v['log']);
                        $i++;
                    }
                }

                $writer = new Xlsx($spreadsheet);
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment; filename="' . urlencode('result.xlsx') . '"');
                $writer->save('php://output');
            }

            $this->base_model->empty_table('users_generate');
        } else {
            $this->session->set_flashdata('msg', 'Pilih file excel .xlsx');
            redirect('manage_school/userdata', 'refresh');
        }
    }

    public function _generate_user()
    {
        ini_set("memory_limit", "-1");
        set_time_limit(0);
        $users_data = $this->base_model->get_item('result', 'users_generate', '*');
        if (!empty($users_data)) {
            $this->config->set_item('ion_auth', FALSE, 'email_activation');
            $j = 1;
            foreach ($users_data as $i) {
                $char = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';

                $email = (isset($i['email']) && $i['email'] != '') ? strtolower($i['email']) : $i['username'];
                $identity = $i['username'];
                $password = $i['password'];

                $additional_data = [
                    'first_name' => $i['first_name'],
                    'last_name' => NULL,
                    'company' => $i['company'],
                    'kelas' => $i['kelas'],
                    'kabupaten' => $i['kabupaten'],
                    'provinsi' => $i['provinsi'],
                    'phone' => $i['phone'],
                    'gender' => $i['gender'],
                ];
                if ($this->ion_auth->register($identity, $password, $email, $additional_data)) {

                    // update the userpassword then give the ticket
                    $this->base_model->update_item('users_generate', ['password' => $password, 'log' => 'acoount succesfully created'], ['id' => $i['id']]);
                    $curr_user = $this->base_model->get_item('row', 'users', 'id', ['username' => $identity]);
                    $this->base_model->insert_item('users_resellers', ['user_id' => $curr_user['id'], 'reseller_id' => $this->session->userdata('user_id')]);
                    if ($curr_user) {
                        $this->base_model->insert_item('ticket', ['user_id' => $curr_user['id'], 'tka_saintek' => 1, 'tka_soshum' => 1, 'tka_campuran' => 1, 'tps' => 1]);
                    }
                } else {
                    // update the error log
                    $this->base_model->update_item('users_generate', ['log' => 'Unable to Create Account. Make sure username or email hasn\'t been used'], ['id' => $i['id']]);
                }
                $j++;
            }
        }
    }

    public function import_user_format()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'NISN');
        $sheet->setCellValue('B1', 'Email');
        $sheet->setCellValue('C1', 'Password');
        $sheet->setCellValue('D1', 'Nama Lengkap');
        $sheet->setCellValue('E1', 'Sekolah');
        $sheet->setCellValue('F1', 'Kelas');
        $sheet->setCellValue('G1', 'Kabupaten');
        $sheet->setCellValue('H1', 'Provinsi');
        $sheet->setCellValue('I1', 'No. WA');
        $sheet->setCellValue('J1', 'Gender');

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . urlencode('format_file.xlsx') . '"');
        $writer->save('php://output');
    }
}
