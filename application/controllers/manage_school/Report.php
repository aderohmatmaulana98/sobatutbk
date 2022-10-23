<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once 'application/controllers/manage_school/Base.php';

class Report extends SchoolBase
{
    public function __construct()
    {
        parent::__construct();
        if ($this->base_model->get_join_item('row', '*', NULL, 'users', ['users_groups'], ['users.id=users_groups.user_id'], ['inner'], ['users.id' => $this->session->userdata('user_id'), 'group_id' => 2])) {
            $this->_is_logged_in();
        }
        $this->data['title'] = "Download Report";
    }

    public function index()
    {
        $selected_user_id = $this->input->get('user');

        if ($selected_user_id != null) {
            $this->data['tryout'] = $this->base_model->get_item('result', 'tryout_group', 'id, name');
            $tryout_group_id = $this->input->post('tryout_group');
            $this->data['tryout_link'] = $this->base_model->get_item('row', 'tryout_group', 'description', ['id' => $tryout_group_id]);

            // $this->data['utbk_score'] = $this->base_model->get_join_item('result', 'exam_score.*, kategori_soal.category, kategori_soal.subject', NULL, 'exam_score', ['exam', 'kategori_soal'], ['exam.id=exam_score.exam_id', 'exam_score.kategori_soal_id = kategori_soal.id'], ['inner', 'inner'], ['exam.user_id' => $selected_user_id, 'exam.tryout_group_id' => $tryout_group_id, 'scope' => 3]);

            $this->data['output'] = ['tryout_group_id' => $this->input->post('tryout_group')];

            $this->load->view('school/report/download', $this->data);
        } else {
            redirect('manage_school/homepage', 'refresh');
        }
    }
}
