<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once 'application/controllers/manage_school/Base.php';

class Tracking extends SchoolBase
{
    public function __construct()
    {
        parent::__construct();
        if ($this->base_model->get_join_item('row', '*', NULL, 'users', ['users_groups'], ['users.id=users_groups.user_id'], ['inner'], ['users.id' => $this->session->userdata('user_id'), 'group_id' => 2])) {
            $this->_is_logged_in();
        }
        $this->data['title'] = "Tracking Pengerjaan";
    }

    public function index()
    {
        $sesi = $this->session->userdata('user_id');
        $sql = "SELECT users.`username`, users.`first_name`, `exam`.`tka`, exam.`tps`, exam.`status`, tryout_group.name
        FROM users, `users_resellers`, `users_groups`, groups, exam,tryout_group
        WHERE users.`id` = `users_groups`.`user_id`
        AND `groups`.`id` = `users_groups`.`group_id`
        AND tryout_group.id = exam.tryout_group_id
        AND users_resellers.`user_id` = users.`id`
        AND users.`id` = exam.`user_id`
        AND users_resellers.`reseller_id` = $sesi
        AND users.`active` = 1
        ORDER BY tryout_group.name ASC
        ";

        $sql1 = "SELECT `tryout_group`.`name`, `tryout_group`.`id`
        FROM `tryout_group`";

        $this->data['sesi_ujian'] = $this->db->query($sql1)->result_array();
        $this->data['tipe'] = $this->base_model->getdatatipe();
        $this->data['pengerjaan'] = $this->db->query($sql)->result_array();
        $this->schoolview('school/tracking/tracking', $this->data);
    }
    public function get_mapel()
    {
        $tipe = $this->input->post('tipe');
        $data = $this->base_model->getdatajenisujian($tipe);
        $output = '<option value="">Pilih Sub-Test</option>';
        foreach ($data as $row) {
            $output .= '<option value="' . $row->subject . '">' . $row->subject . '</option>';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function reset()
    {
        $nisn = $this->input->post('nisn');
        $tipe = $this->input->post('tipe');
        $mapel1 = $this->input->post('mapel1');
        $mapel2 = $this->input->post('mapel2');
        $mapel3 = $this->input->post('mapel3');
        $mapel4 = $this->input->post('mapel4');
        $mapel5 = $this->input->post('mapel5');
        $mapel6 = $this->input->post('mapel6');
        $mapel7 = $this->input->post('mapel7');
        $mapel8 = $this->input->post('mapel8');
        $mapel9 = $this->input->post('mapel9');
        $mapel10 = $this->input->post('mapel10');
        $mapel11 = $this->input->post('mapel11');
        $mapel12 = $this->input->post('mapel12');
        $sesi_ujian = $this->input->post('sesi');

        if ($tipe == "saintek") {
            $array1 = [$mapel1, $mapel2, $mapel3, $mapel4];
        } elseif ($tipe == "soshum") {
            $array1 = [$mapel5, $mapel6, $mapel7, $mapel8];
        } else {
            $array1 = [$mapel9, $mapel10, $mapel11, $mapel12];
        }

        foreach (array_keys($array1, NULL) as $key) {
            unset($array1[$key]);
        }

        $mapel = $array1;

        if ($nisn == NULL || $tipe == NULL || $mapel == NULL || $sesi_ujian == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Form harus diisi semua !!!</div>');
            redirect('manage_school/tracking');
        }

        $sql3 = "SELECT COUNT(users.`username`) as jumlah
        FROM users
        WHERE users.`username`='$nisn'";

        $cek_user = $this->db->query($sql3)->row_array();
        $cek_user = (int)$cek_user['jumlah'];

        if ($cek_user == 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Username tidak ditemukan !!!
          </div>');
            redirect('manage_school/tracking');
        }

        if ($tipe == 'saintek') {
            $sql1 = "UPDATE ticket, users, exam
            SET exam.`tka` = 0 , ticket.`tka_saintek` = 1
            WHERE users.`id` = exam.`user_id`
            AND ticket.`user_id` = users.`id`
            AND exam.`tryout_group_id` = $sesi_ujian
            AND users.`username` = '$nisn'";
        } elseif ($tipe == 'soshum') {
            $sql1 = "UPDATE ticket, users, exam
            SET exam.`tka` = 0 , ticket.`tka_soshum` = 1
            WHERE users.`id` = exam.`user_id`
            AND ticket.`user_id` = users.`id`
            AND exam.`tryout_group_id` = $sesi_ujian
            AND users.`username` = '$nisn'";
        } else {
            $sql1 = "UPDATE ticket, users, exam
            SET exam.`tps` = 0 , ticket.tps = 1
            WHERE users.`id` = exam.`user_id`
            AND ticket.`user_id` = users.`id`
            AND exam.`tryout_group_id` = $sesi_ujian
            AND users.`username` = '$nisn'";
        }

        $sql2 = "SELECT exam.`id`
        FROM exam, users
        WHERE users.id = exam.user_id
        AND `tryout_group_id` = $sesi_ujian
        AND users.username = '$nisn'";

        $exam_id = $this->db->query($sql2)->row_array();
        $exam_id = $exam_id['id'];

        $sql5 = "UPDATE user_exam, kategori_soal, exam, users
        SET `user_exam`.`reset` = 0, `user_exam`.`tampil` = 0, exam.is_doing = NULL, exam.status = 0, exam.end_date = NULL, exam.finish_date = NULL
        WHERE user_exam.`kategori_soal_id` = kategori_soal.`id`
        AND exam.`user_id` = users.`id`
        AND user_exam.`exam_id` = exam.`id`
        AND users.`username` = '$nisn'
        AND exam.id = $exam_id";
        $this->db->query($sql5);

        for ($i = 0; $i < count($mapel); $i++) {
        }

        foreach ($mapel as $key) {
            $sql = "UPDATE user_exam, kategori_soal, exam, users
            SET user_exam.`user_answer` = NULL, user_exam.`score` = NULL, `user_exam`.`reset` = 1, `user_exam`.`tampil` = 1
            WHERE user_exam.`kategori_soal_id` = kategori_soal.`id`
            AND exam.`user_id` = users.`id`
            AND user_exam.`exam_id` = exam.`id`
            AND users.`username` = '$nisn'
            AND `kategori_soal`.`subject`= '$key'
            AND exam.id = $exam_id";
            $this->db->query($sql);
        }


        $this->db->query($sql1);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    Akun berhasil direset
  </div>');
        redirect('manage_school/tracking');
    }
}
