<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once 'application/controllers/manage_school/Base.php';

class Examtime extends SchoolBase
{
    public function __construct()
    {
        parent::__construct();
        if ($this->base_model->get_join_item('row', '*', NULL, 'users', ['users_groups'], ['users.id=users_groups.user_id'], ['inner'], ['users.id' => $this->session->userdata('user_id'), 'group_id' => 2])) {
            $this->_is_logged_in();
        }
        $this->data['title'] = "Waktu Ujian";
    }

    public function index()
    {
        $this->data['item'] = $this->base_model->get_join_item('result', 'tryout_school.*, tryout.name, tryout.type, tryout_group.name as tryout_group_name', 'tryout_school.id ASC', 'tryout_school', ['tryout', 'tryout_group'], ['tryout_school.tryout_id=tryout.id', 'tryout_school.tryout_group_id=tryout_group.id'], ['inner', 'inner'], ['tryout_school.user_school_id' => $this->session->userdata('user_id')]);
        $this->schoolview('school/examtime/examtime', $this->data);
    }

    public function update($id = NULL)
    {
        $this->data['title'] = "Update Waktu Ujian";
        $this->data['post'] = $this->base_model->get_item('row', 'tryout_school', '*', ['id' => $id]);
        if (!$this->data['post']) {
            show_404();
        }
        $this->data['paket_soal'] = $this->base_model->get_item('result', 'paket_soal', '*');
        $this->data['group_paket_ujian'] = $this->base_model->get_item('result', 'tryout_group', '*');

        $this->data['sesi_ujian'] = $this->base_model->get_item('result', 'tryout', 'id, name, type', ['tryout_group_id' => $this->data['post']['tryout_group_id']]);

        $this->form_validation->set_rules('tryout_group', 'Group Tryout', 'trim|required|numeric');
        $this->form_validation->set_rules('tryout', 'Sesi Tryout', 'trim|required|numeric');
        $this->form_validation->set_rules('start_time', 'Jam mulai', 'trim|required');
        $this->form_validation->set_rules('end_time', 'Jam selesai', 'trim|required');
        $this->form_validation->set_rules('start_date', 'Tanggal mulai', 'trim|required');
        $this->form_validation->set_rules('end_date', 'Tanggal berakhir', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required|numeric');

        if ($this->form_validation->run() === FALSE) {
            $this->data['start_time'] = [
                'name'  => 'start_time',
                'id'    => 'start_time',
                'type'  => 'time',
                'value' => $this->form_validation->set_value('start_time', $this->data['post']['start_time']),
                'class' => 'form-control',
            ];
            $this->data['end_time'] = [
                'name'  => 'end_time',
                'id'    => 'end_time',
                'type'  => 'time',
                'value' => $this->form_validation->set_value('end_time', $this->data['post']['end_time']),
                'class' => 'form-control',
            ];
            $this->data['start_date'] = [
                'name'  => 'start_date',
                'id'    => 'start_date',
                'type'  => 'date',
                'value' => $this->form_validation->set_value('start_date', $this->data['post']['start_date']),
                'class' => 'form-control',
            ];
            $this->data['end_date'] = [
                'name'  => 'end_date',
                'id'    => 'end_date',
                'type'  => 'date',
                'value' => $this->form_validation->set_value('end_date', $this->data['post']['end_date']),
                'class' => 'form-control',
            ];
            $this->data['validation_error'] = validation_errors();
            $this->schoolview('school/examtime/addexamtime', $this->data);
        } else {
            $params = array(
                'tryout_group_id' => $this->input->post('tryout_group', TRUE),
                'tryout_id' => $this->input->post('tryout', TRUE),
                'user_school_id' => $this->session->userdata('user_id'),
                'start_date' => $this->input->post('start_date', TRUE),
                'start_time' => $this->input->post('start_time', TRUE),
                'end_date' => $this->input->post('end_date', TRUE),
                'end_time' => $this->input->post('end_time', TRUE),
                'status' => $this->input->post('status', TRUE),
                'modified' => date('Y-m-d H:i:s')
            );
            $get_tryout_group = [];
            if ($this->input->post('tryout', TRUE) != $this->data['post']['tryout_id']) {
                $get_tryout_group = $this->base_model->get_join_item('row', 'tryout_school.*, tryout.name, tryout.type, tryout_group.name as tryout_group_name', NULL, 'tryout_school', ['tryout', 'tryout_group'], ['tryout_school.tryout_id=tryout.id', 'tryout_school.tryout_group_id=tryout_group.id'], ['inner', 'inner'], ['tryout_school.tryout_group_id' => $this->input->post('tryout_group', TRUE), 'tryout_school.tryout_id' => $this->input->post('tryout', TRUE), 'tryout_school.user_school_id' => $this->session->userdata('user_id')]);
            }
            if ($get_tryout_group) {
                $this->_result_msg('danger', 'Gagal menyimpan data. Paket Ujian ' . $get_tryout_group['tryout_group_name'] . ' dengan nama sesi ' . $get_tryout_group['name'] . ' sudah pernah dibuat. Silakan edit data yang telah ada.');
            } else {
                $act = $this->base_model->update_item('tryout_school', $params, array('id' => $id));
                if (!$act) {
                    $this->_result_msg('danger', 'Gagal menyimpan data');
                } else {
                    $this->_result_msg('success', 'Data berhasil diubah');
                }
            }
            redirect('manage_school/examtime/index');
        }
    }

    public function create()
    {

        $this->data['group_paket_ujian'] = $this->base_model->get_item('result', 'tryout_group', '*');

        $this->data['title'] = "Tambah Waktu Ujian";

        $this->form_validation->set_rules('tryout_group', 'Group Tryout', 'trim|required|numeric');
        $this->form_validation->set_rules('tryout', 'Sesi Tryout', 'trim|required|numeric');
        $this->form_validation->set_rules('start_time', 'Jam mulai', 'trim|required');
        $this->form_validation->set_rules('end_time', 'Jam selesai', 'trim|required');
        $this->form_validation->set_rules('start_date', 'Tanggal mulai', 'trim|required');
        $this->form_validation->set_rules('end_date', 'Tanggal berakhir', 'trim|required');
        $this->form_validation->set_rules('status', 'Status', 'trim|required|numeric');

        $this->data['post'] = [];
        if ($this->form_validation->run() === FALSE) {
            $this->data['start_time'] = [
                'name'  => 'start_time',
                'id'    => 'start_time',
                'type'  => 'time',
                'value' => $this->form_validation->set_value('start_time'),
                'class' => 'form-control',
            ];
            $this->data['end_time'] = [
                'name'  => 'end_time',
                'id'    => 'end_time',
                'type'  => 'time',
                'value' => $this->form_validation->set_value('end_time'),
                'class' => 'form-control',
            ];
            $this->data['start_date'] = [
                'name'  => 'start_date',
                'id'    => 'start_date',
                'type'  => 'date',
                'value' => $this->form_validation->set_value('start_date'),
                'class' => 'form-control',
            ];
            $this->data['end_date'] = [
                'name'  => 'end_date',
                'id'    => 'end_date',
                'type'  => 'date',
                'value' => $this->form_validation->set_value('end_date'),
                'class' => 'form-control',
            ];
            $this->data['validation_error'] = validation_errors();
            $this->schoolview('school/examtime/addexamtime', $this->data);
        } else {
            $params = array(
                'tryout_group_id' => $this->input->post('tryout_group', TRUE),
                'tryout_id' => $this->input->post('tryout', TRUE),
                'user_school_id' => $this->session->userdata('user_id'),
                'start_date' => $this->input->post('start_date', TRUE),
                'start_time' => $this->input->post('start_time', TRUE),
                'end_date' => $this->input->post('end_date', TRUE),
                'end_time' => $this->input->post('end_time', TRUE),
                'status' => $this->input->post('status', TRUE),
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            );
            $get_tryout_group = $this->base_model->get_join_item('row', 'tryout_school.*, tryout.name, tryout.type, tryout_group.name as tryout_group_name', NULL, 'tryout_school', ['tryout', 'tryout_group'], ['tryout_school.tryout_id=tryout.id', 'tryout_school.tryout_group_id=tryout_group.id'], ['inner', 'inner'], ['tryout_school.tryout_group_id' => $this->input->post('tryout_group', TRUE), 'tryout_school.tryout_id' => $this->input->post('tryout', TRUE), 'tryout_school.user_school_id' => $this->session->userdata('user_id')]);
            if ($get_tryout_group) {
                $this->_result_msg('danger', 'Gagal menambahkan data. Paket Ujian ' . $get_tryout_group['tryout_group_name'] . ' dengan nama sesi ' . $get_tryout_group['name'] . ' sudah pernah dibuat. Silakan edit data yang telah ada.');
            } else {
                if ($this->base_model->insert_item('tryout_school', $params, 'id')) {
                    $this->_result_msg('success', 'Data baru telah ditambahkan');
                } else {
                    $this->_result_msg('danger', 'Gagal menambahkan data');
                }
            }

            redirect('manage_school/examtime/index');
        }
    }

    public function get_tryout()
    {
        $data = [];
        if ($this->input->post('tryout_group_id')) {
            $data = $this->base_model->get_item('result', 'tryout', 'id, name, type', ['tryout_group_id' => $this->input->post('tryout_group_id')]);
        }
        echo json_encode(['status' => TRUE, 'data' => $data]);
    }
}
