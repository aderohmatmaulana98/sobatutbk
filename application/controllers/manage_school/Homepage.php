<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once 'application/controllers/manage_school/Base.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Dompdf\Dompdf;

class Homepage extends SchoolBase
{
    public function __construct()
    {
        parent::__construct();
        if ($this->base_model->get_join_item('row', '*', NULL, 'users', ['users_groups'], ['users.id=users_groups.user_id'], ['inner'], ['users.id' => $this->session->userdata('user_id'), 'group_id' => 2])) {
            $this->_is_logged_in();
        }
        $this->data['title'] = "Dashboard";
    }

    public function index()
    {
        $this->data['tryout'] = $this->base_model->get_item('result', 'tryout_group', 'id, name');
        $this->data['tryout_link'] = $this->base_model->get_item('row', 'tryout_group', 'description', ['id' => $this->input->post('tryout_group')]);

        $this->data['avg_tka_category'] = $this->base_model->get_join_item('row', 'kategori_soal.category, AVG(exam_score.score) as score', NULL, 'exam_score', ['kategori_soal', 'exam', 'users', 'users_resellers'], ['exam_score.kategori_soal_id = kategori_soal.id', 'exam_score.exam_id = exam.id', 'exam.user_id = users.id', 'users.id = users_resellers.user_id'], ['inner', 'inner', 'inner', 'inner'], ['scope' => 3, 'reseller_id' => $this->session->userdata('user_id'), 'exam.tryout_group_id' => $this->input->post('tryout_group'), 'kategori_soal.category IN ("saintek", "soshum") ' => NULL]);
        $this->data['avg_tps_category'] = $this->base_model->get_join_item('row', 'kategori_soal.category, AVG(exam_score.score) as score', NULL, 'exam_score', ['kategori_soal', 'exam', 'users', 'users_resellers'], ['exam_score.kategori_soal_id = kategori_soal.id', 'exam_score.exam_id = exam.id', 'exam.user_id = users.id', 'users.id = users_resellers.user_id'], ['inner', 'inner', 'inner', 'inner'], ['scope' => 3, 'reseller_id' => $this->session->userdata('user_id'), 'exam.tryout_group_id' => $this->input->post('tryout_group'), 'kategori_soal.category' => 'tps']);

        $scope_tka = is_null($this->input->post('filter_tka')) ? 3 : $this->input->post('filter_tka');
        $this->data['avg_tka_sekolah'] = $this->base_model->get_join_item('result', 'users.provinsi, users.kabupaten, users.company as user_company, AVG(exam_score.score) as score, (SELECT users.username FROM users WHERE first_name = user_company LIMIT 1) as npsn, (SELECT AVG(exam_score.score) as avg_score FROM exam_score INNER JOIN exam ON exam_score.exam_id = exam.id INNER JOIN users ON exam.user_id = users.id INNER JOIN kategori_soal ON exam_score.kategori_soal_id=kategori_soal.id WHERE kategori_soal.category IN ("saintek", "soshum") AND users.company = user_company AND exam_score.scope = ' . $scope_tka . ' AND exam.tryout_group_id ' . ($this->input->post('tryout_group') < 1 ? 'IS NULL' : '= '. $this->input->post('tryout_group')) . ' GROUP BY exam.user_id ORDER BY avg_score ASC LIMIT 1) as min_score, (SELECT AVG(exam_score.score) as avg_score FROM exam_score INNER JOIN exam ON exam_score.exam_id = exam.id INNER JOIN users ON exam.user_id = users.id INNER JOIN kategori_soal ON exam_score.kategori_soal_id=kategori_soal.id WHERE kategori_soal.category IN ("saintek", "soshum") AND users.company = user_company AND exam_score.scope = ' . $scope_tka . ' AND exam.tryout_group_id ' . ($this->input->post('tryout_group') < 1 ? 'IS NULL' : '= '. $this->input->post('tryout_group')) . ' GROUP BY exam.user_id ORDER BY avg_score DESC LIMIT 1) as max_score', NULL, 'exam_score', ['kategori_soal', 'exam', 'users', 'users_resellers'], ['exam_score.kategori_soal_id = kategori_soal.id', 'exam_score.exam_id = exam.id', 'exam.user_id = users.id', 'users.id = users_resellers.user_id'], ['inner', 'inner', 'inner', 'inner'], ['scope' => $scope_tka, 'exam.tryout_group_id' => $this->input->post('tryout_group'), 'kategori_soal.category IN ("saintek", "soshum")' => NULL], ['reseller_id']);
        // $this->data['avg_tka_sekolah'] = $this->base_model->get_join_item('result', 'users.provinsi, users.company as user_company, AVG(exam_score.score) as score, (SELECT users.username FROM users WHERE first_name = user_company LIMIT 1) as npsn, (SELECT AVG(exam_score.score) as avg_score FROM exam_score INNER JOIN exam ON exam_score.exam_id = exam.id INNER JOIN users ON exam.user_id = users.id INNER JOIN kategori_soal ON exam_score.kategori_soal_id=kategori_soal.id WHERE kategori_soal.category IN ("saintek", "soshum") AND users.company = user_company AND exam_score.scope = ' . $scope_tka . ' AND exam.tryout_group_id ' . ($this->input->post('tryout_group') < 1 ? 'IS NULL' : '= '. $this->input->post('tryout_group')) . ' GROUP BY exam.user_id ORDER BY avg_score ASC LIMIT 1) as min_score, (SELECT AVG(exam_score.score) as avg_score FROM exam_score INNER JOIN exam ON exam_score.exam_id = exam.id INNER JOIN users ON exam.user_id = users.id WHERE users.company = user_company INNER JOIN kategori_soal ON exam_score.kategori_soal_id=kategori_soal.id WHERE kategori_soal.category IN ("saintek", "soshum") AND exam_score.scope = ' . $scope_tka . ' AND exam.tryout_group_id ' . ($this->input->post('tryout_group') < 1 ? 'IS NULL' : '= '. $this->input->post('tryout_group')) . ' GROUP BY exam.user_id ORDER BY avg_score DESC LIMIT 1) as max_score', NULL, 'exam_score', ['kategori_soal', 'exam', 'users', 'users_resellers'], ['exam_score.kategori_soal_id = kategori_soal.id', 'exam_score.exam_id = exam.id', 'exam.user_id = users.id', 'users.id = users_resellers.user_id'], ['inner', 'inner', 'inner', 'inner'], ['scope' => $scope_tka, 'exam.tryout_group_id' => $this->input->post('tryout_group'), 'kategori_soal.category IN ("saintek", "soshum")' => NULL], ['reseller_id']);
        // $this->data['max_avg_tka_sekolah'] = $this->data['avg_tka_sekolah'] ? max(array_column($this->data['avg_tka_sekolah'], 'score')) : 0;
        // $this->data['min_avg_tka_sekolah'] = $this->data['avg_tka_sekolah'] ? min(array_column($this->data['avg_tka_sekolah'], 'score')) : 0;

        $scope_tps = is_null($this->input->post('filter_tps')) ? 3 : $this->input->post('filter_tps');
        $this->data['avg_tps_sekolah'] = $this->base_model->get_join_item('result', 'users.provinsi, users.kabupaten, users.company as user_company, AVG(exam_score.score) as score, (SELECT users.username FROM users WHERE first_name = user_company LIMIT 1) as npsn, (SELECT AVG(exam_score.score) as avg_score FROM exam_score INNER JOIN exam ON exam_score.exam_id = exam.id INNER JOIN users ON exam.user_id = users.id INNER JOIN kategori_soal ON exam_score.kategori_soal_id=kategori_soal.id WHERE kategori_soal.category IN ("tps") AND users.company = user_company AND exam_score.scope = ' . $scope_tps . ' AND exam.tryout_group_id ' . ($this->input->post('tryout_group') < 1 ? 'IS NULL' : '= '. $this->input->post('tryout_group')) . ' GROUP BY exam.user_id ORDER BY avg_score ASC LIMIT 1) as min_score, (SELECT AVG(exam_score.score) as avg_score FROM exam_score INNER JOIN exam ON exam_score.exam_id = exam.id INNER JOIN users ON exam.user_id = users.id INNER JOIN kategori_soal ON exam_score.kategori_soal_id=kategori_soal.id WHERE kategori_soal.category IN ("tps") AND users.company = user_company AND exam_score.scope = ' . $scope_tps . ' AND exam.tryout_group_id ' . ($this->input->post('tryout_group') < 1 ? 'IS NULL' : '= '. $this->input->post('tryout_group')) . ' GROUP BY exam.user_id ORDER BY avg_score DESC LIMIT 1) as max_score', NULL, 'exam_score', ['kategori_soal', 'exam', 'users', 'users_resellers'], ['exam_score.kategori_soal_id = kategori_soal.id', 'exam_score.exam_id = exam.id', 'exam.user_id = users.id', 'users.id = users_resellers.user_id'], ['inner', 'inner', 'inner', 'inner'], ['scope' => $scope_tps, 'exam.tryout_group_id' => $this->input->post('tryout_group'), 'kategori_soal.category IN ("tps")' => NULL], ['reseller_id']);
        // $this->data['avg_tps_sekolah'] = $this->base_model->get_join_item('result', 'users.provinsi, users.company as user_company, AVG(exam_score.score) as score, (SELECT users.username FROM users WHERE first_name = user_company LIMIT 1) as npsn, (SELECT AVG(exam_score.score) as avg_score FROM exam_score INNER JOIN exam ON exam_score.exam_id = exam.id INNER JOIN users ON exam.user_id = users.id INNER JOIN kategori_soal ON exam_score.kategori_soal_id=kategori_soal.id WHERE kategori_soal.category IN ("tps") AND users.company = user_company AND exam_score.scope = ' . $scope_tps . ' AND exam.tryout_group_id ' . ($this->input->post('tryout_group') < 1 ? 'IS NULL' : '= '. $this->input->post('tryout_group')) . ' GROUP BY exam.user_id ORDER BY avg_score ASC LIMIT 1) as min_score, (SELECT AVG(exam_score.score) as avg_score FROM exam_score INNER JOIN exam ON exam_score.exam_id = exam.id INNER JOIN users ON exam.user_id = users.id WHERE users.company = user_company INNER JOIN kategori_soal ON exam_score.kategori_soal_id=kategori_soal.id WHERE kategori_soal.category IN ("tps") AND exam_score.scope = ' . $scope_tps . ' AND exam.tryout_group_id ' . ($this->input->post('tryout_group') < 1 ? 'IS NULL' : '= '. $this->input->post('tryout_group')) . ' GROUP BY exam.user_id ORDER BY avg_score DESC LIMIT 1) as max_score', NULL, 'exam_score', ['kategori_soal', 'exam', 'users', 'users_resellers'], ['exam_score.kategori_soal_id = kategori_soal.id', 'exam_score.exam_id = exam.id', 'exam.user_id = users.id', 'users.id = users_resellers.user_id'], ['inner', 'inner', 'inner', 'inner'], ['scope' => $scope_tps, 'exam.tryout_group_id' => $this->input->post('tryout_group'), 'kategori_soal.category IN ("tps")' => NULL], ['reseller_id']);
        // $this->data['max_avg_tps_sekolah'] = $this->data['avg_tps_sekolah'] ? max(array_column($this->data['avg_tps_sekolah'], 'score')) : 0;
        // $this->data['min_avg_tps_sekolah'] = $this->data['avg_tps_sekolah'] ? min(array_column($this->data['avg_tps_sekolah'], 'score')) : 0;

        $id_user = $this->session->userdata('user_id');
        $this->data['school_data'] = $this->base_model->get_item('row', 'users', 'provinsi, kabupaten', ['id' => $id_user]);
        
        $sql = "SELECT users.id, users.`username`, users.`first_name`, users.`email`, users.`active`, users.kelas
        FROM users, users_resellers
        WHERE `users_resellers`.`user_id`= users.`id`
        AND `users_resellers`.`reseller_id` = $id_user";

        $this->data['data_siswa'] = $this->db->query($sql)->result_array();

        $this->data['output'] = ['tryout_group_id' => $this->input->post('tryout_group'), 'tka_category' => $scope_tka, 'tps_category' => $scope_tps];
        $this->schoolview('school/homepage/homepage', $this->data);
    }
    public function create_user()
    {
        $id_reseler = $this->session->userdata('user_id');
        $nisn = $this->input->post('nisn');
        $email = $this->input->post('email');
        $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        $nama = $this->input->post('nama');
        $sekolah = $this->input->post('kelas');
        $kelas = $this->input->post('nisn');
        $kabupaten = $this->input->post('kabupaten');
        $provinsi = $this->input->post('provinsi');
        $no_hp = $this->input->post('no_hp');
        $jk = $this->input->post('jk');

        $sql = "SELECT COUNT(users.`username`) AS jumlah
        FROM users
        WHERE users.`username` = $nisn ";

        $cek_nisn = $this->db->query($sql)->row_array();
        $cek_nisn = $cek_nisn['jumlah'];

        if ($cek_nisn != 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
    NISN sudah didaftarkan !
  </div>');
            redirect('manage_school/homepage');
        }

        $data = [
            'username' => $nisn,
            'email' => $email,
            'password' => $password,
            'first_name' => $nama,
            'company' => $sekolah,
            'active' => 0,
            'kelas' => $kelas,
            'kabupaten' => $kabupaten,
            'provinsi' => $provinsi,
            'phone' => $no_hp,
            'gender' => $jk
        ];
        $this->db->insert('users', $data);

        $sql1 = "SELECT users.`id` as id
        FROM users
        WHERE users.`username` = $nisn";

        $id_user = $this->db->query($sql1)->row_array();
        $id_user = $id_user['id'];


        $data1 = [
            'user_id' => $id_user,
            'tka_saintek' => 1,
            'tka_soshum' => 1,
            'tka_campuran' => 1,
            'tps' => 1
        ];
        $this->db->insert('ticket', $data1);

        $data2 = [
            'user_id' => $id_user,
            'reseller_id' => $id_reseler
        ];
        $this->db->insert('users_resellers', $data2);

        $data3 = [
            'user_id' => $id_user,
            'group_id' => 2
        ];
        $this->db->insert('users_groups', $data3);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    Akun berhasil dibuat
  </div>');
        redirect('manage_school/homepage');
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
                $sheet->setCellValue('E1', 'Kelas');
                $sheet->setCellValue('F1', 'Keterangan');
                if (!empty($user_data)) {
                    foreach ($user_data as $v) {
                        $sheet->setCellValue('A' . $i, $v['username']);
                        $sheet->setCellValue('B' . $i, $v['password']);
                        $sheet->setCellValue('C' . $i, $v['first_name']);
                        $sheet->setCellValue('D' . $i, $v['company']);
                        $sheet->setCellValue('E' . $i, $v['kelas']);
                        $sheet->setCellValue('F' . $i, $v['log']);
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
            redirect('manage_school/homepage', 'refresh');
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

    public function pembahasan($tryout_group_id)
    {
        if (!$this->base_model->get_item('row', 'tryout_group', '*', ['id' => $tryout_group_id])) {
            show_404();
        }
        $this->data['item'] = [];
        $item = $this->base_model->get_join_item('result', 'tryout_group.name as tryout_group_name, soal.description as soal, soal.opt1, soal.opt2, soal.opt3, soal.opt4, soal.opt5, soal.answer, soal.explanation, soal.kategori_soal_id, kategori_soal.category, kategori_soal.subject', NULL, 'soal', ['butir_paket_soal', 'kategori_soal', 'tryout', 'tryout_group'], ['soal.id=butir_paket_soal.soal_id', 'soal.kategori_soal_id=kategori_soal.id', 'butir_paket_soal.paket_soal_id=tryout.paket_soal_id', 'tryout.tryout_group_id=tryout_group.id'], ['inner', 'inner', 'inner', 'inner'], ['tryout.tryout_group_id' => $tryout_group_id, 'kategori_soal.id' => 1]);

        foreach ($item as $v) {
            $this->data['item'][$v['kategori_soal_id']]['soal'][] = $v;
            $this->data['item'][$v['kategori_soal_id']]['category'] = $v['category'];
            $this->data['item'][$v['kategori_soal_id']]['subject'] = $v['subject'];
        }
        $this->data['title'] = $item[0]['tryout_group_name'];
        $pdfdata = $this->load->view('school/homepage/exportexam/header', $this->data, TRUE);
        $pdfdata .= $this->load->view('school/homepage/exportexam/pembahasan', [], TRUE);
        $pdfdata .= $this->load->view('school/homepage/exportexam/footer', [], TRUE);

        // echo $pdfdata; die;
        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($pdfdata);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();
    }
}
