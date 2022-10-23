<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once 'application/controllers/manage/Base.php';

class Bank_soal extends AdminBase
{
    public function __construct()
    {
        parent::__construct();
        $this->data['title'] = "Bank soal";
    }

    public function index()
    {
        $this->data['item'] = $this->base_model->get_join_item('result', 'bank_soal.*, category, subject, COUNT(soal.id) as count', 'bank_soal.id DESC', 'bank_soal', array('kategori_soal', 'soal'), array('bank_soal.kategori_soal_id=kategori_soal.id', 'soal.bank_soal_id = bank_soal.id'), array('inner', 'left'), NULL, array('bank_soal.id'));
        $this->adminview('admin/banksoal/banksoal', $this->data);
    }

    public function create()
    {
        $this->data['item'] = $this->base_model->get_item('result', 'kategori_soal', 'DISTINCT(category)');
        $this->data['soal'] = [];

        $this->form_validation->set_rules('name', 'Nama Bank Soal', 'trim|required');
        $this->form_validation->set_rules('subject', 'Kategori Soal', 'trim|required|numeric');

        if ($this->form_validation->run() === FALSE) {
            $this->adminview('admin/banksoal/tambahkoleksisoal_create', $this->data);
        } else {
            $params = array(
                'name' => $this->input->post('name', TRUE),
                'kategori_soal_id' => $this->input->post('subject', TRUE),
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            );
            if ($this->base_model->insert_item('bank_soal', $params, 'id')) {
                $this->_result_msg('danger', 'Data baru telah ditambahkan');
            } else {
                $this->_result_msg('success', 'Gagal menambahkan data');
            }
            redirect('manage/bank_soal/index');
        }
    }

    public function update($id = NULL)
    {
        $this->data['post'] = $this->base_model->get_join_item('row', 'bank_soal.*, category, subject', NULL, 'bank_soal', array('kategori_soal'), array('bank_soal.kategori_soal_id=kategori_soal.id'), array('inner'), array('bank_soal.id' => $id));
        if (!$this->data['post']) {
            show_404();
        }
        $this->data['item'] = $this->base_model->get_item('result', 'kategori_soal', 'DISTINCT(category)');
        $this->data['subject'] = $this->base_model->get_item('result', 'kategori_soal', 'id, category, subject');
        $this->data['soal'] = $this->base_model->get_item('result', 'soal', '*', ['bank_soal_id' => $id]);;

        $this->form_validation->set_rules('name', 'Nama Bank Soal', 'trim|required');
        $this->form_validation->set_rules('subject', 'Kategori Soal', 'trim|required|numeric');

        if ($this->form_validation->run() === FALSE) {
            $this->adminview('admin/banksoal/tambahkoleksisoal', $this->data);
        } else {
            $params = array(
                'name' => $this->input->post('name', TRUE),
                'kategori_soal_id' => $this->input->post('subject', TRUE),
                'modified' => date('Y-m-d H:i:s'),
            );
            $act = $this->base_model->update_item('bank_soal', $params, array('id' => $id));
            if (!$act) {
                $this->_result_msg('danger', 'Gagal menyimpan data');
            } else {
                $this->base_model->update_item('soal', ['kategori_soal_id' => $this->input->post('subject', TRUE), 'modified' => date('Y-m-d H:i:s')], array('bank_soal_id' => $id));
                $this->_result_msg('success', 'Data berhasil diubah');
            }
            redirect('manage/bank_soal/update/' . $id);
        }
    }

    public function delete($id = NULL)
    {
        if (!$this->base_model->get_item('row', 'bank_soal', 'id', array('id' => $id))) {
            $this->_result_msg('danger', 'Data tidak ditemukan');
        } else {
            if ($this->base_model->get_item('row', 'soal', 'id', array('bank_soal_id' => $id))) {
                $this->_result_msg('danger', 'Gagal menghapus data. Bank soal terkait dengan data lainnya.');
            } else {
                $result = $this->base_model->delete_item('bank_soal', array('id' => $id));
                if ($result) {
                    $this->_result_msg('success', 'Data telah dihapus');
                } else {
                    $this->_result_msg('danger', 'Gagal menghapus data');
                }
            }
        }
        redirect('manage/bank_soal');
    }

    public function get_subject()
    {
        $data = [];
        if ($this->input->post('id')) {
            $data =  $this->base_model->get_join_item('result', 'bank_soal.*, category, subject', NULL, 'bank_soal', array('kategori_soal'), array('bank_soal.kategori_soal_id=kategori_soal.id'), array('inner'), array('kategori_soal.id' => $this->input->post('id')));
        } else {
            $data = $this->base_model->get_item('result', 'kategori_soal', '*', ['category' => $this->input->post('category')]);
        }
        echo json_encode(['status' => TRUE, 'data' => $data]);
    }

    /*
     Butir Soal Section
    */

    public function create_soal($id)
    {
        $this->data['bank_soal'] = $this->base_model->get_join_item('row', 'bank_soal.*, category, subject, kategori_soal.id as kategori_id', NULL, 'bank_soal', array('kategori_soal'), array('bank_soal.kategori_soal_id=kategori_soal.id'), array('inner'), array('bank_soal.id' => $id));
        if (!$this->data['bank_soal']) {
            show_404();
        }

        $this->data['materi'] = $this->base_model->get_item('result', 'materi', '*', ['kategori_soal_id' => $this->data['bank_soal']['kategori_soal_id']]);
        $this->data['indikator'] = $this->base_model->get_item('result', 'indikator', '*', ['kategori_soal_id' => $this->data['bank_soal']['kategori_soal_id']]);

        $this->form_validation->set_rules('description', 'Soal', 'trim|required');
        $this->form_validation->set_rules('opt1', 'Opsi 1', 'trim|required');
        $this->form_validation->set_rules('opt2', 'Opsi 2', 'trim|required');
        $this->form_validation->set_rules('opt3', 'Opsi 3', 'trim|required');
        $this->form_validation->set_rules('opt4', 'Opsi 4', 'trim|required');
        $this->form_validation->set_rules('opt5', 'Opsi 5', 'trim|required');
        $this->form_validation->set_rules('opt5', 'Opsi 5', 'trim|required');
        $this->form_validation->set_rules('answer', 'Jawaban Benar', 'trim|required|numeric');
        $this->form_validation->set_rules('explanation', 'Pembahasan', 'trim');
        $this->form_validation->set_rules('materi', 'Materi', 'trim|numeric');
        $this->form_validation->set_rules('indikator', 'Indikator', 'trim|numeric');
        $this->form_validation->set_rules('kategori_soal_id', 'Kategori id', 'trim|required|numeric');


        if ($this->form_validation->run() === TRUE) {
            $params = array(
                'description' => $this->input->post('description'),
                'opt1' => $this->input->post('opt1'),
                'opt2' => $this->input->post('opt2'),
                'opt3' => $this->input->post('opt3'),
                'opt4' => $this->input->post('opt4'),
                'opt5' => $this->input->post('opt5'),
                'answer' => $this->input->post('answer', TRUE),
                'explanation' => $this->input->post('explanation'),
                'materi_id' => $this->input->post('materi'),
                'indikator_id' => $this->input->post('indikator'),
                'bank_soal_id' => $id,
                'kategori_soal_id' => $this->input->post('kategori_soal_id', TRUE),
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            );

            if ($this->base_model->insert_item('soal', $params, 'id')) {
                $this->_result_msg('danger', 'Data baru telah ditambahkan');
            } else {
                $this->_result_msg('success', 'Gagal menambahkan data');
            }
            redirect('manage/bank_soal/update/' . $id);
        } else {
            $this->data['description'] = [
                'name'  => 'description',
                'id'    => 'description',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('description'),
                'class' => 'form-control',
                'rows' => '5',
                'placeholder' => 'Pertanyaan'
            ];

            $this->data['opt1'] = [
                'name'  => 'opt1',
                'id'    => 'opt1',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('opt1'),
                'class' => 'form-control',
                'rows' => '2',
                'placeholder' => 'Opsi 1'
            ];

            $this->data['opt2'] = [
                'name'  => 'opt2',
                'id'    => 'opt2',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('opt2'),
                'class' => 'form-control',
                'rows' => '2',
                'placeholder' => 'Opsi 2'
            ];

            $this->data['opt3'] = [
                'name'  => 'opt3',
                'id'    => 'opt3',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('opt3'),
                'class' => 'form-control',
                'rows' => '2',
                'placeholder' => 'Opsi 3'
            ];

            $this->data['opt4'] = [
                'name'  => 'opt4',
                'id'    => 'opt4',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('opt4'),
                'class' => 'form-control',
                'rows' => '2',
                'placeholder' => 'Opsi 4'
            ];

            $this->data['opt5'] = [
                'name'  => 'opt5',
                'id'    => 'opt5',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('opt5'),
                'class' => 'form-control',
                'rows' => '2',
                'placeholder' => 'Opsi 5'
            ];

            $this->data['answer'] = [
                'name'  => 'answer',
                'id'    => 'answer',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('answer'),
            ];

            $this->data['explanation'] = [
                'name'  => 'explanation',
                'id'    => 'explanation',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('explanation'),
                'class' => 'form-control',
                'rows' => '5',
                'placeholder' => 'Pembahasan'
            ];

            $this->data['assets_footer'] = array(
                'asset_1' => '<script src="' . base_url() . 'asset/ckeditor/ckeditor.js"></script>',
                'asset_2' => '<script>CKEDITOR.replace(\'description\', {height: 150});</script>',
                'asset_3' => '<script>CKEDITOR.replace(\'opt1\', {height: 75});</script>',
                'asset_4' => '<script>CKEDITOR.replace(\'opt2\', {height: 75});</script>',
                'asset_5' => '<script>CKEDITOR.replace(\'opt3\', {height: 75});</script>',
                'asset_6' => '<script>CKEDITOR.replace(\'opt4\', {height: 75});</script>',
                'asset_7' => '<script>CKEDITOR.replace(\'opt5\', {height: 75});</script>',
                'asset_8' => '<script>CKEDITOR.replace(\'explanation\', {height: 175});</script>',
                'asset_9' => '<script>CKEDITOR.config.extraPlugins = \'ckeditor_wiris\';</script>',
            );

            $this->adminview('admin/banksoal/tambahpertanyaan', $this->data);
        }
    }

    public function update_soal($id, $id_soal)
    {
        $this->data['bank_soal'] = $this->base_model->get_join_item('row', 'bank_soal.*, category, subject, kategori_soal.id as kategori_id', NULL, 'bank_soal', array('kategori_soal'), array('bank_soal.kategori_soal_id=kategori_soal.id'), array('inner'), array('bank_soal.id' => $id));
        $this->data['soal'] = $this->base_model->get_item('row', 'soal', '*', ['id' => $id_soal]);
        if (!$this->data['bank_soal'] || !$this->data['soal']) {
            show_404();
        }

        $this->data['materi'] = $this->base_model->get_item('result', 'materi', '*', ['kategori_soal_id' => $this->data['bank_soal']['kategori_soal_id']]);
        $this->data['indikator'] = $this->base_model->get_item('result', 'indikator', '*', ['kategori_soal_id' => $this->data['bank_soal']['kategori_soal_id']]);

        $this->form_validation->set_rules('description', 'Soal', 'trim|required');
        $this->form_validation->set_rules('opt1', 'Opsi 1', 'trim|required');
        $this->form_validation->set_rules('opt2', 'Opsi 2', 'trim|required');
        $this->form_validation->set_rules('opt3', 'Opsi 3', 'trim|required');
        $this->form_validation->set_rules('opt4', 'Opsi 4', 'trim|required');
        $this->form_validation->set_rules('opt5', 'Opsi 5', 'trim|required');
        $this->form_validation->set_rules('opt5', 'Opsi 5', 'trim|required');
        $this->form_validation->set_rules('answer', 'Jawaban Benar', 'trim|required|numeric');
        $this->form_validation->set_rules('explanation', 'Pembahasan', 'trim');
        $this->form_validation->set_rules('materi', 'Materi', 'trim|numeric');
        $this->form_validation->set_rules('indikator', 'Indikator', 'trim|numeric');
        $this->form_validation->set_rules('kategori_soal_id', 'Kategori id', 'trim|required|numeric');


        if ($this->form_validation->run() === TRUE) {
            $params = array(
                'description' => $this->input->post('description'),
                'opt1' => $this->input->post('opt1'),
                'opt2' => $this->input->post('opt2'),
                'opt3' => $this->input->post('opt3'),
                'opt4' => $this->input->post('opt4'),
                'opt5' => $this->input->post('opt5'),
                'answer' => $this->input->post('answer', TRUE),
                'explanation' => $this->input->post('explanation'),
                'materi_id' => $this->input->post('materi'),
                'indikator_id' => $this->input->post('indikator'),
                'bank_soal_id' => $id,
                'kategori_soal_id' => $this->input->post('kategori_soal_id', TRUE),
                'modified' => date('Y-m-d H:i:s'),
            );

            if ($this->base_model->update_item('soal', $params, ['id' => $id_soal])) {
                $this->_result_msg('danger', 'Data berhasil diubah ');
            } else {
                $this->_result_msg('success', 'Gagal menyimpan data');
            }
            redirect('manage/bank_soal/update_soal/' . $id . '/' . $id_soal);
        } else {
            $this->data['description'] = [
                'name'  => 'description',
                'id'    => 'description',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('description', $this->data['soal']['description']),
                'class' => 'form-control',
                'rows' => '5',
                'placeholder' => 'Pertanyaan'
            ];

            $this->data['opt1'] = [
                'name'  => 'opt1',
                'id'    => 'opt1',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('opt1', $this->data['soal']['opt1']),
                'class' => 'form-control',
                'rows' => '2',
                'placeholder' => 'Opsi 1'
            ];

            $this->data['opt2'] = [
                'name'  => 'opt2',
                'id'    => 'opt2',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('opt2', $this->data['soal']['opt2']),
                'class' => 'form-control',
                'rows' => '2',
                'placeholder' => 'Opsi 2'
            ];

            $this->data['opt3'] = [
                'name'  => 'opt3',
                'id'    => 'opt3',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('opt3', $this->data['soal']['opt3']),
                'class' => 'form-control',
                'rows' => '2',
                'placeholder' => 'Opsi 3'
            ];

            $this->data['opt4'] = [
                'name'  => 'opt4',
                'id'    => 'opt4',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('opt4', $this->data['soal']['opt4']),
                'class' => 'form-control',
                'rows' => '2',
                'placeholder' => 'Opsi 4'
            ];

            $this->data['opt5'] = [
                'name'  => 'opt5',
                'id'    => 'opt5',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('opt5', $this->data['soal']['opt5']),
                'class' => 'form-control',
                'rows' => '2',
                'placeholder' => 'Opsi 5'
            ];

            $this->data['answer'] = [
                'name'  => 'answer',
                'id'    => 'answer',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('answer', $this->data['soal']['answer']),
            ];

            $this->data['explanation'] = [
                'name'  => 'explanation',
                'id'    => 'explanation',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('explanation', $this->data['soal']['explanation']),
                'class' => 'form-control',
                'rows' => '5',
                'placeholder' => 'Pembahasan'
            ];

            $this->data['assets_footer'] = array(
                'asset_1' => '<script src="' . base_url() . 'asset/ckeditor/ckeditor.js"></script>',
                'asset_2' => '<script>CKEDITOR.replace(\'description\', {height: 150});</script>',
                'asset_3' => '<script>CKEDITOR.replace(\'opt1\', {height: 75});</script>',
                'asset_4' => '<script>CKEDITOR.replace(\'opt2\', {height: 75});</script>',
                'asset_5' => '<script>CKEDITOR.replace(\'opt3\', {height: 75});</script>',
                'asset_6' => '<script>CKEDITOR.replace(\'opt4\', {height: 75});</script>',
                'asset_7' => '<script>CKEDITOR.replace(\'opt5\', {height: 75});</script>',
                'asset_8' => '<script>CKEDITOR.replace(\'explanation\', {height: 175});</script>',
                'asset_9' => '<script>CKEDITOR.config.extraPlugins = \'ckeditor_wiris\';</script>',
            );

            $this->adminview('admin/banksoal/editpertanyaan', $this->data);
        }
    }

    public function delete_soal($bank_soal_id = NULL, $id = NULL)
    {
        if (!$this->base_model->get_item('row', 'soal', 'id', array('id' => $id))) {
            $this->_result_msg('danger', 'Data tidak ditemukan');
        } else {
            if ($this->base_model->get_item('row', 'butir_paket_soal', 'id', array('soal_id' => $id))) {
                $this->_result_msg('danger', 'Gagal menghapus data. Soal terkait dengan bank soal.');
            } else {
                if ($this->base_model->delete_item('soal', array('id' => $id))) {
                    $this->_result_msg('success', 'Data telah dihapus');
                } else {
                    $this->_result_msg('danger', 'Gagal menghapus data');
                }
            }
        }
        redirect('manage/bank_soal/update/' . $bank_soal_id);
    }
    /*
     End Butir Soal
    */
}
