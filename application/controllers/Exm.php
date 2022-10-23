<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Exm extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(['ion_auth']);
        $this->load->model('base_model');
        $this->_is_logged_in();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index($exam = NULL, $id = NULL)
    {
        $this->_is_doing_exam(); //check if any exam was on going
        $category_exam = $this->_exam_status($exam);

        $data['ptn_category'] = $this->_ptn_category($exam);
        $data['get_tps_category'] = '';
        //get sesi to define end time for user
        $get_school_id = $this->base_model->get_item('row', 'users_resellers', 'reseller_id', ['user_id' => $this->session->userdata('user_id')]);
        // $sesi = $this->base_model->get_item('row', 'tryout', '*', ['status' => 1, 'type' => $category_exam, 'id' => $id]);
        $sesi = $this->base_model->get_join_item('row', 'tryout.id, tryout.name, tryout.tryout_group_id, tryout.type, tryout.active_month, tryout_school.start_date, tryout_school.start_time, tryout_school.end_date, tryout_school.end_time', NULL, 'tryout', ['tryout_school'], ['tryout.id=tryout_school.tryout_id'], ['inner'], ['tryout_school.status' => 1, 'tryout.type' => $category_exam, 'tryout.id' => $id, 'tryout_school.user_school_id' => $get_school_id['reseller_id']]);
        if (!$sesi) {
            $this->session->set_flashdata('message_sa', 'Tidak ditemukan jadwal ujian yang dipilih, ulangi memilih ujian yang tersedia. Info lebih lanjut hubungi CS kami.');
            redirect('usr');
        }

        $data['get_exam'] = $this->base_model->get_item('row', 'exam', '*', ['user_id' => $this->session->userdata('user_id'), 'tryout_group_id' => $sesi['tryout_group_id']]);

        if ($data['get_exam']) {
            if ($exam == 'tka_saintek' || $exam == 'tka_soshum') {
                if ($data['ptn_category'] != $data['get_exam']['category']) {
                    $this->session->set_flashdata('message_sa', 'Kamu telah memilih kategori <strong>' . $data['get_exam']['category'] . '</strong> untuk sesi tryout ini, silakan pilih sesi <strong>' . $data['get_exam']['category'] . '</strong> untuk melanjutkan tryout.');
                    redirect('usr');
                }
            }
        } else {
            //capture category for tps
            if ($exam === 'tps') {
                $data['get_tps_category'] = $this->input->post('get_tps_category');
                if ($this->input->post('get_tps_category') == '0' || is_null($this->input->post('get_tps_category'))) {
                    $this->session->set_flashdata('message_sa', 'Terjadi kesalahan, tentukan kategori jurusan sebelum memulai tryout. Info lebih lanjut hubungi CS kami.');
                    redirect('usr');
                }
                $data['ptn_category'] = $this->_ptn_category($this->input->post('get_tps_category'));
            }
        }


        $this->_check_exam_category($exam, $sesi);

        $data['user_list_2'] = $this->db->get('interface_user_list_2')->result_array();

        $data['title'] = "Tata tertib";
        $data['user'] = $this->ion_auth->user($this->session->userdata('user_id'))->row();
        $data['ptn'] = $this->base_model->get_item('result', 'ptn', 'DISTINCT(nama)');
        $data['exam'] = $exam;
        $data['exam_id'] = $id;

        //get data ptn1 and ptn2
        $data['ptn_jurusan1'] = $this->base_model->get_item('row', 'ptn', '*', ['id' => $data['get_exam']['ptn1']]);
        $data['all_jurusan_ptn1'] = $this->base_model->get_item('result', 'ptn', '*', ['nama' => $data['ptn_jurusan1']['nama']]);
        $data['ptn_jurusan2'] = $this->base_model->get_item('row', 'ptn', '*', ['id' => $data['get_exam']['ptn2']]);
        $data['all_jurusan_ptn2'] = $this->base_model->get_item('result', 'ptn', '*', ['nama' => $data['ptn_jurusan2']['nama']]);

        if (empty($data['get_exam'])) {
            $this->form_validation->set_rules('jurusan1', 'PTN Pilihan 1', 'trim|required|numeric');
            $this->form_validation->set_rules('jurusan2', 'PTN Pilihan 2', 'trim|required|numeric');
        } else {
            $this->form_validation->set_rules('jurusan1', 'PTN Pilihan 1', 'trim|numeric');
            $this->form_validation->set_rules('jurusan2', 'PTN Pilihan 2', 'trim|numeric');
        }

        if ($this->form_validation->run() === FALSE) {

            $data['error_message'] = (NULL != validation_errors()) ? 'Lengkapi PTN Pilihan 1 dan 2 sebelum memulai ujian' : '';
            $this->load->view('exam/template/header', $data);
            // $this->load->view('exam/template/sidebar');
            $this->load->view('exam/template/topbar');
            $this->load->view('exam/index');
            $this->load->view('exam/template/footer');
        } else {
            $exam_time = $this->_get_exam_time($sesi['type']);
            // $exam_time = ($this->_exam_category($exam) == 'tps') ? date('H:i:s', strtotime('+1 hour +45 minutes', strtotime(date("H:i:s")))) : date('H:i:s', strtotime('+1 hour +30 minutes', strtotime(date("H:i:s"))));
            // $end_date = ($exam_time >= $sesi['end_time']) ? date('Y-m-d H:i:s', strtotime($sesi['end_time'])) : date('Y-m-d H:i:s', strtotime($exam_time));
            $end_date = date('Y-m-d H:i:s', time() + 600);
            if ($category_exam == 1 || $category_exam == 2) {
                $finish_date = date('Y-m-d H:i:s', time() + 5400);
            } else {
                $finish_date = date('Y-m-d H:i:s', time() + 8300);
            }
            $params = array(
                'status' => $category_exam,
                'finish_date' => $finish_date
            );
            if ($data['get_exam']) {
                $this->base_model->update_item('exam', $params, array('user_id' => $this->session->userdata('user_id'), 'tryout_group_id' => $sesi['tryout_group_id']));
            } else {
                $params['tryout_group_id'] = $sesi['tryout_group_id'];
                $params['user_id'] = $this->session->userdata('user_id');
                $params['month'] = $sesi['active_month'];
                $params['ptn1'] = $this->input->post('jurusan1', TRUE);
                $params['ptn2'] = $this->input->post('jurusan2', TRUE);
                $params['category'] = $data['ptn_category'];
                $this->base_model->insert_item('exam', $params);
            }

            //check ticket
            $ticket = $this->base_model->get_item('row', 'ticket', '*', ['user_id' => $this->session->userdata('user_id')]);
            //tiket min 1
            // if ($exam == 'tka_saintek' || $exam == 'tka_soshum' || $exam == 'tka_campuran') {
            //     $user_id_tiket = $this->session->userdata('user_id');
            //     $update_tiket = "UPDATE ticket
            //     SET ticket.`tka_saintek` = 0, ticket.`tka_soshum` = 0, ticket.`tka_campuran` = 0
            //     WHERE ticket.`user_id` = $user_id_tiket";
            //     $this->db->query($update_tiket);
            // } else {
            $this->base_model->update_item('ticket', [$exam => $ticket[$exam] - 1], array('user_id' => $this->session->userdata('user_id')));
            // }
            $exam_id = $this->base_model->get_item('row', 'exam', '*', ['user_id' => $this->session->userdata('user_id'), 'tryout_group_id' => $sesi['tryout_group_id']]);
            //add exam history
            $this->base_model->insert_item('exam_history', ['name' => $sesi['name'], 'date' => date('Y-m-d H:i:s'), 'exam_id' => $exam_id['id'], 'category' => $sesi['type'], 'start_date' => $sesi['start_date'], 'end_date' => $sesi['end_date'], 'start_time' => $sesi['start_time'], 'end_time' => $sesi['end_time']]);
            //duplicate soal to user
            $exam_data = $this->base_model->get_join_item('result', 'soal.*', NULL, 'soal', ['butir_paket_soal', 'paket_soal', 'tryout'], ['soal.id = butir_paket_soal.soal_id', 'butir_paket_soal.paket_soal_id = paket_soal.id', 'paket_soal.id = tryout.paket_soal_id'], ['inner', 'inner', 'inner'], ['type' => $this->_exam_status($exam), 'status' => 1, 'tryout.id' => $sesi['id']]);

            $id_user = $this->session->userdata('user_id');
            $id_exam = $exam_id['id'];
            $cekdata = "SELECT COUNT(user_exam.id) as jumlah
            FROM exam, users, user_exam, kategori_soal
            WHERE exam.`user_id` = users.`id`
            AND user_exam.`exam_id` = exam.`id`
            AND user_exam.`kategori_soal_id` = `kategori_soal`.`id`
            AND `user_exam`.`category`= $category_exam
            AND exam.id = $id_exam
            AND users.id = $id_user";
            $cekdata1 = $this->db->query($cekdata)->row_array();
            $cekdata1 = $cekdata1['jumlah'];

            if ($cekdata1 == 0) {
                if (!empty($exam_data)) {
                    foreach ($exam_data as $i) {
                        $soal = array(
                            'answer' => $i['answer'],
                            'exam_id' => $exam_id['id'],
                            'kategori_soal_id' => $i['kategori_soal_id'],
                            'soal_id' => $i['id'],
                            'category' => $category_exam,
                            'created' => date('Y-m-d H:i:s'),
                            'modified' => date('Y-m-d H:i:s'),
                            'reset' => 1,
                            'tampil' => 1,
                        );
                        $this->base_model->insert_item('user_exam', $soal);
                    }
                    $kategori = $category_exam;
                    $sesi_ujian = $exam_id['tryout_group_id'];
                    $id_exam1 = $exam_id['id'];

                    $this->reset($id_exam1, $sesi_ujian, $kategori);
                }
            }

            $this->next_mapel();
            redirect('exm/ujian/');
        }
    }

    function next_mapel($bank_soal_id = 0)
    {
        //apply for user test simulation
        if ($bank_soal_id === 'simulation') {
            redirect('usr');
        }

        $id_user = $this->session->userdata('user_id');
        $sql2 = "SELECT exam.`id`, exam.`status`, exam.finish_date
        FROM exam, users
        WHERE exam.`user_id` = users.`id`
        AND exam.`status` != 0
        AND users.`id` = $id_user";
        $data['exam_id'] = $this->db->query($sql2)->row_array();
        // $bank_soal_id +1;
        $exam_id = $data['exam_id']['id'];

        $tipe_ujian1 = NULL;

        if ($data['exam_id']['status'] == 1) {
            $tipe_ujian1 = 'saintek';
        } elseif ($data['exam_id']['status'] == 2) {
            $tipe_ujian1 = 'soshum';
        } elseif ($data['exam_id']['status'] == 3) {
            $tipe_ujian1 = 'campuran';
        } else {
            $tipe_ujian1 = 'tps';
        }

        $sql6 = "SELECT `kategori_soal`.`subject`
        FROM `kategori_soal`, user_exam, exam
        WHERE user_exam.`kategori_soal_id` = `kategori_soal`.`id`
        AND exam.`id` = user_exam.`exam_id`
        AND kategori_soal.`category` = '$tipe_ujian1'
        AND user_exam.`exam_id` = $exam_id
        AND user_exam.`tampil` = 1
        GROUP BY `kategori_soal`.`subject`
        ORDER BY `kategori_soal`.id ASC";

        $selisih = null;
        if ($bank_soal_id == 0) {
            $selisih = 0;
        } else {
            $selisih = 1;
        }

        $data['subject'] = $this->db->query($sql6)->result_array();
        $subject = $data['subject'];
        $subject = $subject[$bank_soal_id - $selisih]['subject'];

        $sql3 = "SELECT `kategori_soal`.`waktu`
        FROM `kategori_soal`, user_exam, exam
        WHERE user_exam.`kategori_soal_id` = `kategori_soal`.`id`
        AND exam.`id` = user_exam.`exam_id`
        AND kategori_soal.`category` = '$tipe_ujian1'
        GROUP BY `kategori_soal`.`subject`
        ORDER BY `kategori_soal`.id ASC";

        $data['kategori'] = $this->db->query($sql3)->result_array();
        $waktu = $data['kategori'];
        $waktu = (int)$waktu[$bank_soal_id]['waktu'];

        $time_next = date('Y-m-d H:i:s', time() + $waktu);
        if ($time_next > $data['exam_id']['finish_date']) {
            $time_next = $data['exam_id']['finish_date'];
        }
        if ($bank_soal_id != 0) {
            $sql5 = "UPDATE user_exam, kategori_soal, exam, users
        SET `user_exam`.`reset` = 0
        WHERE user_exam.`kategori_soal_id` = kategori_soal.`id`
        AND exam.`user_id` = users.`id`
        AND user_exam.`exam_id` = exam.`id`
        AND users.`id` = $id_user
        AND user_exam.`exam_id` = $exam_id
        AND `kategori_soal`.`subject`= '$subject'";
            $this->db->query($sql5);
        }

        $sql_update = "UPDATE exam
                SET exam.end_date = '$time_next', exam.is_doing = $bank_soal_id
                WHERE exam.id = $exam_id";
        $this->db->query($sql_update);

        redirect('exm/ujian/' . $bank_soal_id);
    }

    public function start()
    {
        $this->_is_doing_exam_on_start();
        $data['user'] = $this->ion_auth->user($this->session->userdata('user_id'))->row();

        $data['title'] = "Selamat Mengerjakan Tryout - SobatUTBK";
        //get exam data
        $exam_data = $this->base_model->get_item('row', 'exam', '*', ['user_id' => $this->session->userdata('user_id'), 'status !=' => 0]);
        $data['exam_time'] = (strtotime(date('Y-m-d H:i:s', strtotime($exam_data['end_date']))) - strtotime(date('Y-m-d H:i:s')));
        $data['exam_name'] = $this->_exam_category_status($exam_data['status']);
        $data['exam_items'] = $this->base_model->get_join_item('result', 'user_exam.*, kategori_soal.category as kategori_soal, subject', NULL, 'user_exam', ['kategori_soal'], ['user_exam.kategori_soal_id=kategori_soal.id'], ['inner'], ['exam_id' => $exam_data['id'], 'user_exam.category' => $exam_data['status']]);
        //arrange subject/mapel
        $data['subjects'] = [];
        foreach ($data['exam_items'] as $i) {
            if (!in_array($i['subject'], $data['subjects'])) {
                array_push($data['subjects'], $i['subject']);
            }
        }

        //arrange subject soal
        $data['subjects_soal'] = [];
        foreach ($data['subjects'] as $i) {
            foreach ($data['exam_items'] as $j) {
                if ($i == $j['subject']) {
                    $data['subjects_soal'][$i][] = [
                        'soal' => $j['soal'],
                        'opt' => [$j['opt1'], $j['opt2'], $j['opt3'], $j['opt4'], $j['opt5']],
                        'soal_id' => $j['id'],
                        'user_answer' => $j['user_answer']
                    ];
                }
            }
        }

        $this->load->view('exam/start-template/header', $data);
        $this->load->view('exam/start', $data);
        $this->load->view('exam/start-template/footer', $data);
    }

    public function ujian($bank_soal_id = NULL)
    {
        $this->load->helper('url');

        $data['title'] = "Selamat Mengerjakan Tryout - SobatUTBK";
        $exam_data = $this->base_model->get_item('row', 'exam', '*', ['user_id' => $this->session->userdata('user_id'), 'status !=' => 0]);
        $data['exam_items'] = $this->base_model->get_join_item('result', 'user_exam.*, kategori_soal.category as kategori_soal, subject', NULL, 'user_exam', ['kategori_soal'], ['user_exam.kategori_soal_id=kategori_soal.id'], ['inner'], ['exam_id' => $exam_data['id'], 'user_exam.category' => $exam_data['status']]);
        $data['exam_name'] = $this->_exam_category_status($exam_data['status']);
        if ($bank_soal_id != $exam_data['is_doing']) {
            $bank_soal_id = $exam_data['is_doing'];
            redirect('exm/ujian/' . $bank_soal_id);
        }
        $current_bank_soal = $bank_soal_id;

        $data['subjects'] = [];
        foreach ($data['exam_items'] as $i) {
            if (!in_array($i['subject'], $data['subjects'])) {
                array_push($data['subjects'], $i['subject']);
            }
        }

        $id_user = $this->session->userdata('user_id');
        $sql2 = "SELECT exam.`id`
        FROM exam, users
        WHERE exam.`user_id` = users.`id`
        AND exam.`status` != 0
        AND users.`id` = $id_user";
        $data['exam_id'] = $this->db->query($sql2)->row_array();

        $exam_id = $data['exam_id']['id'];

        $sql4 = "SELECT exam.`end_date`, finish_date
        FROM users, exam
        WHERE users.`id`= exam.`user_id`
        AND exam.`id` = $exam_id";
        $times = $this->db->query($sql4)->row_array();

        $end_date = $times['end_date'];
        $finish_date = $times['finish_date'];
        $time_now = date('Y-m-d H:i:s');
        $end_date1 = (strtotime($end_date));
        $end_date2 = date("Y-m-d H:i:s", $end_date1);

        if (!$current_bank_soal) {
            // redirect('siswa');
        }

        $status = NULL;
        $cek = $data['exam_name'];

        if ($cek == "TKA SAINTEK") {
            $status = "saintek";
        } elseif ($cek == "TKA SOSHUM") {
            $status = "soshum";
        } else {
            $status = "tps";
        }

        $sql = "SELECT DISTINCT(`kategori_soal`.`subject`) AS mapel
        FROM `kategori_soal`, exam, user_exam
        WHERE `kategori_soal`.`category` = '$status'
        AND kategori_soal.id = user_exam.kategori_soal_id
        AND user_exam.exam_id = exam.id
        AND exam.`id` = $exam_id
        AND user_exam.tampil =1
        ORDER BY `kategori_soal`.`id` ASC";

        $subjek = $this->db->query($sql)->result_array();
        $data['coba'] = [];
        for ($i = 1; $i <= count($subjek); $i++) {
            foreach ($subjek as $s) {

                $dataku =  [
                    'name' => $s,
                    'slug' => $i
                ];
                $i += 1;


                array_push($data['coba'], $dataku);
            }
        }

        $list_bank_soal = $data['coba'];

        $next_key = $bank_soal_id + 1;
        if ($next_key <= count($subjek)) {
            $kategori = $subjek[0 + $bank_soal_id]['mapel'];

            $sql1 = "SELECT soal.`description`, soal.`opt1`, soal.`opt2`, soal.`opt3`, soal.`opt4`, soal.`opt5`, user_exam.`user_answer`, soal.`kategori_soal_id`, user_exam.id
            FROM user_exam, soal, kategori_soal, bank_soal, exam
            WHERE soal.`id` = user_exam.`soal_id`
            AND soal.`kategori_soal_id` = `kategori_soal`.`id`
            AND soal.`bank_soal_id` = `bank_soal`.`id`
            AND exam.`id`= user_exam.`exam_id`
            AND `kategori_soal`.`subject`= '$kategori'
            AND exam.`id` = $exam_id
            AND user_exam.reset = 1
            AND user_exam.tampil = 1
            ORDER BY soal.id ASC";

            $data['soal'] = $this->db->query($sql1)->result_array();

            $soal_soal = $data['soal'];

            $data['soal_tmp'] = [];
            foreach ($soal_soal as $ss) {
                $soal = array(
                    "soal" => $ss['description'],
                    "opt" => array(
                        "1" => $ss['opt1'],
                        "2" => $ss['opt2'],
                        "3" => $ss['opt3'],
                        "4" => $ss['opt4'],
                        "5" => $ss['opt5'],
                    ),
                    "is_done" => isset($ss['user_answer']),
                    "user_exam_answer_id" => $ss['id'],
                    "answer" => $ss['user_answer']
                );
                array_push($data['soal_tmp'], $soal);
            }

            $soal_fix = $data['soal_tmp'];

            $list_question = json_encode(
                array(
                    'category' => $subjek[0 + $bank_soal_id]['mapel'],
                    'total' => count($soal_fix),
                    'is_menu_opened' => true,
                    'bank_soal' => $soal_fix,
                    'next' => $next_key
                )
            );

            $data['exam_time'] = (strtotime(date('Y-m-d H:i:s', strtotime($end_date2))) - strtotime(date('Y-m-d H:i:s')));


            $data['list_categories'] = $list_bank_soal;
            $data['count_category'] = sizeof($list_bank_soal);
            $data['list_questions'] = $list_question;
            $data['current'] = 1 + $bank_soal_id;
        }

        $cek_finish = "SELECT COUNT(DISTINCT(`kategori_soal`.`subject`)) AS jumlah
        FROM `kategori_soal`, exam, user_exam
        WHERE `kategori_soal`.`category` = '$status'
        AND kategori_soal.id = user_exam.kategori_soal_id
        AND user_exam.exam_id = exam.id
        AND exam.`id` = $exam_id
        AND user_exam.tampil = 1";

        $cek_finish1 = $this->db->query($cek_finish)->row_array();
        $cek_finish1 = (int)$cek_finish1['jumlah'];

        if ($bank_soal_id < $cek_finish1 && $time_now < $finish_date) {
            $this->load->view('exam/start-template/header', $data);
            $this->load->view('exam/start', $data);
            $this->load->view('exam/start-template/footer', $data);
        } else {
            redirect('exm/finish/' . $status . '/' . $exam_id);
        }
    }

    public function finish($status, $exam_id)
    {
        $id_user = $this->session->userdata('user_id');
        $sql = "UPDATE user_exam, kategori_soal, exam, users
        SET user_exam.`tampil` = 0, user_exam.`reset` = 0
        WHERE user_exam.`kategori_soal_id` = kategori_soal.`id`
        AND exam.`user_id` = users.`id`
        AND user_exam.`exam_id` = exam.`id`
        AND users.`id` = $id_user
        AND kategori_soal.category = '$status'
        AND exam.id = $exam_id";

        $this->db->query($sql);

        $exam_data = $this->base_model->get_item('row', 'exam', '*', ['user_id' => $this->session->userdata('user_id'), 'status !=' => 0]);
        if ($exam_data) {
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

            $this->base_model->update_item('exam', $params, array('user_id' => $this->session->userdata('user_id'), 'id' => $exam_id));
        }
        $this->session->set_flashdata('message_sa', 'Selamat kamu telah menyelesaikan TPS/TKA');
        redirect('usr');
    }

    public function reset($id_exam1, $sesi_ujian, $kategori)
    {

        $nisn = $this->session->userdata('user_id');

        $sql2 = "SELECT exam.`id`
        FROM exam, users
        WHERE users.id = exam.user_id
        AND `tryout_group_id` = $sesi_ujian
        AND exam.id = $id_exam1";

        $exam_id = $this->db->query($sql2)->row_array();
        $exam_id = $exam_id['id'];


        $sql = "UPDATE user_exam, kategori_soal, exam, users
        SET user_exam.`user_answer` = NULL, user_exam.`score` = NULL, `user_exam`.`reset` = 1, `user_exam`.`tampil` = 1
        WHERE user_exam.`kategori_soal_id` = kategori_soal.`id`
        AND exam.`user_id` = users.`id`
        AND user_exam.`exam_id` = exam.`id`
        AND users.`id` = $nisn
        AND `user_exam`.`category`= $kategori
        AND exam.id = $exam_id";
        $this->db->query($sql);
    }

    public function _is_logged_in()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }
    }

    public function get_jurusan()
    {
        $data = $this->base_model->get_item('result', 'ptn', '*', ['nama' => $this->input->post('nama'), 'kategori' => $this->input->post('kategori')]);
        if (!empty($data)) {
            echo json_encode(['status' => TRUE, 'data' => $data]);
        } else {
            echo json_encode(['status' => TRUE, 'data' => []]);
        }
    }

    public function update_answer()
    {
        $this->form_validation->set_rules('id', 'Soal', 'trim|required|numeric');
        $this->form_validation->set_rules('answer', 'Jawaban', 'trim|required|numeric');

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(['status' => FALSE, 'data' => [], 'message' => validation_errors()]);
        } else {
            $data = $this->base_model->get_item('row', 'user_exam', '*', ['id' => $this->input->post('id')]);
            if ($data) {
                $score = ($data['answer'] == $this->input->post('answer', TRUE)) ? 1 : 0;
                $params = [
                    'user_answer' => $this->input->post('answer', TRUE),
                    'score' => $score,
                ];
                $act = $this->base_model->update_item('user_exam', $params, array('id' => $this->input->post('id')));
                if ($act) {
                    echo json_encode(['status' => TRUE, 'data' => $act, 'message' => '']);
                } else {
                    echo json_encode(['status' => FALSE, 'data' => $act, 'message' => '']);
                }
            } else {
                echo json_encode(['status' => FALSE, 'data' => [], 'message' => '']);
            }
        }
    }

    public function _check_exam_category($exam = NULL, $sesi = NULL)
    {
        switch ($exam) {
            case 'tka_saintek':
            case 'tka_soshum':
            case 'tka_campuran':
            case 'tps':
                //check ticket
                $ticket = $this->base_model->get_item('row', 'ticket', '*', ['user_id' => $this->session->userdata('user_id')]);
                //check exam
                $ctg_exam = $this->base_model->get_item('row', 'exam', '*', ['user_id' => $this->session->userdata('user_id'), 'tryout_group_id' => $sesi['tryout_group_id']]);
                //get exam category
                $ctg = $this->_exam_category($exam);
                //check if now(date) is not between exam date
                if (date('Y-m-d') < date('Y-m-d', strtotime($sesi['start_date'])) || date('Y-m-d') > date('Y-m-d', strtotime($sesi['end_date']))) {
                    $this->session->set_flashdata('message_sa', 'Tanggal sesi ujian yang kamu pilih belum dimulai. Info lebih lanjut hubungi CS kami.');
                    redirect('usr');
                }

                if (!empty($sesi) && !empty($ticket)) {
                    //check if test is taken between time session
                    if (date('H:i:s') >= date('H:i:s', strtotime($sesi['start_time'])) && date('H:i:s') <= date('H:i:s', strtotime($sesi['end_time']))) {
                        //check if ticket and session quota available
                        if ($ticket[$exam] > 0) {
                            //check if already test on the current month base on exam category

                            if ($ctg_exam[$ctg] != 1) {
                                return true;
                            } else {
                                $this->session->set_flashdata('message_sa', 'Kamu sudah mengikuti sesi tryout ini. Info lebih lanjut hubungi CS kami.');
                            }
                        } else {
                            $this->session->set_flashdata('message_sa', 'Tiketmu tidak tersedia. Cek kembali tiketmu dan silakan ikuti sesi selanjutnya sesuai jam sesi. Info lebih lanjut hubungi CS kami.');
                        }
                    } else {
                        $this->session->set_flashdata('message_sa', 'Sesi ujian yang dipilih belum dimulai. Cek kembali jam sesi. Info lebih lanjut hubungi CS kami.');
                    }
                } else {
                    $this->session->set_flashdata('message_sa', 'Sesi ujian yang dipilih tidak tersedia/tiket tidak tersedia. Info lebih lanjut hubungi CS kami.');
                }
                redirect('usr');
            default:
                redirect('usr');
        }
    }

    public function _exam_status($exam)
    {
        switch ($exam) {
            case 'tka_saintek':
                return 1;
            case 'tka_soshum':
                return 2;
            case 'tka_campuran':
                return 3;
            case 'tps':
                return 4;
            default:
                return 0;
        }
    }

    public function _ptn_category($exam)
    {
        switch ($exam) {
            case 'tka_saintek':
                return 'saintek';
            case 'tka_soshum':
                return 'soshum';
        }
    }

    public function _exam_category($exam)
    {
        switch ($exam) {
            case 'tka_saintek':
            case 'tka_soshum':
            case 'tka_campuran':
                return 'tka';
            case 'tps':
                return 'tps';
            default:
                return 0;
        }
    }
    public function _exam_category_status($exam)
    {
        switch ($exam) {
            case 1:
                return 'TKA SAINTEK';
            case 2:
                return 'TKA SOSHUM';
            case 3:
                return 'TKA Campuran';
            case 4:
                return 'TPS';
            default:
                return 0;
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
                    'is_doing' => NULL,
                    'finish_date' => NULL
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

    public function _is_doing_exam_on_start()
    {
        $exam_data = $this->base_model->get_item('row', 'exam', '*', ['user_id' => $this->session->userdata('user_id'), 'status !=' => 0]);
        if ($exam_data) {
            if (date('Y-m-d H:i:s') >= date('Y-m-d H:i:s', strtotime($exam_data['end_date']))) {

                $params = array(
                    'status' => 0,
                    'end_date' => NULL,
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
                $this->session->set_flashdata('message_sa', 'Selamat kamu telah menyelesaikan TPS/TKA');
                redirect('usr');
            }
        } else {
            redirect('usr');
        }
    }

    public function _get_exam_time($exam)
    {
        switch ($exam) {
            case 1:
            case 2:
                return date('H:i:s', strtotime('+1 hour +30 minutes', strtotime(date("H:i:s"))));
            case 3:
                return date('H:i:s', strtotime('+3 hour', strtotime(date("H:i:s"))));
            case 4:
                return date('H:i:s', strtotime('+1 hour +45 minutes', strtotime(date("H:i:s"))));
            default:
                return date('H:i:s', strtotime('+1 hour +30 minutes', strtotime(date("H:i:s"))));
        }
    }

    public function _get_month($month)
    {
        switch ($month) {
            case 1:
                return 'Januari';
            case 2:
                return 'Februari';
            case 3:
                return 'Maret';
            case 4:
                return 'April';
            case 5:
                return 'Mei';
            case 6:
                return 'Juni';
            case 7:
                return 'Juli';
            case 8:
                return 'Agustus';
            case 9:
                return 'September';
            case 10:
                return 'Oktober';
            case 11:
                return 'November';
            case 12:
                return 'Desember';
            default:
                return '';
        }
    }

    //for simulation only
    public function simulation()
    {
        $data['user'] = $this->ion_auth->user($this->session->userdata('user_id'))->row();

        $data['title'] = "Selamat Mengerjakan Tryout - SobatUTBK";
        //get exam data
        $data['exam_items'] = $this->base_model->get_join_item('result', 'soal.*, kategori_soal.category as kategori_soal, subject', NULL, 'soal', ['butir_paket_soal', 'paket_soal', 'kategori_soal'], ['soal.id=butir_paket_soal.soal_id', 'butir_paket_soal.paket_soal_id=paket_soal.id', 'soal.kategori_soal_id=kategori_soal.id'], ['inner', 'inner', 'inner'], ['paket_soal.id' => 7, 'kategori_soal.id' => 1]);
        $data['exam_name'] = 'TPS';
        //arrange subject/mapel
        $data['subjects'] = [];
        $k = 1;
        foreach ($data['exam_items'] as $i) {
            if (!in_array($i['subject'], array_column($data['subjects'], 'name'))) {
                array_push($data['subjects'], ['name' => $i['subject'], 'slug' => $k]);
                $k++;
            }
        }

        //arrange subject soal
        $data['subjects_soal'] = [];
        foreach ($data['subjects'] as $i) {
            foreach ($data['exam_items'] as $j) {
                if ($i['name'] == $j['subject']) {
                    $data['subjects_soal'][$i['name']][] = [
                        'soal' => $j['description'],
                        'opt' => ['1' => $j['opt1'], '2' => $j['opt2'], '3' => $j['opt3'], '4' => $j['opt4'], '5' => $j['opt5']],
                        "is_done" => false,
                        "user_exam_answer_id" => $j['id'],
                        "answer" => false
                    ];
                }
            }
        }

        // var_dump($data['subjects']);die();

        $list_question = json_encode(
            array(
                'category' => $data['subjects'][0]['name'],
                'total' => count($data['subjects_soal']['kemampuan memahami bacaan dan menulis']),
                'is_menu_opened' => true,
                'bank_soal' => $data['subjects_soal']['kemampuan memahami bacaan dan menulis'],
                'next' => 'simulation'
            )
        );

        $data['list_categories'] = $data['subjects'];
        $data['count_category'] = sizeof($data['subjects']);
        $data['list_questions'] = $list_question;
        $data['current'] = 1;
        $data['exam_time'] = 1020;

        $this->load->view('exam/start-template/header', $data);
        $this->load->view('exam/start-simulation', $data);
        $this->load->view('exam/start-template/footer', $data);
    }
}
