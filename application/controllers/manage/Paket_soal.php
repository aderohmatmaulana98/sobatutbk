<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once 'application/controllers/manage/Base.php';

class Paket_soal extends AdminBase
{
    public function __construct()
    {
        parent::__construct();
        $this->data['title'] = "Paket soal";
    }

    public function index()
    {
        $this->data['item'] = $this->base_model->get_item('result', 'paket_soal', '*');
        $this->adminview('admin/paketsoal/paketsoal', $this->data);
    }

    public function create()
    {

        $this->form_validation->set_rules('name', 'Nama Bank Soal', 'trim|required');
        $this->form_validation->set_rules('description', 'Deskripsi Bank Soal', 'trim');

        if ($this->form_validation->run() === FALSE) {
            $this->adminview('admin/paketsoal/tambahpaketsoal_create', $this->data);
        } else {
            $params = array(
                'name' => $this->input->post('name', TRUE),
                'description' => $this->input->post('description', TRUE),
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            );
            if ($this->base_model->insert_item('paket_soal', $params, 'id')) {
                $this->_result_msg('danger', 'Data baru telah ditambahkan');
            } else {
                $this->_result_msg('success', 'Gagal menambahkan data');
            }
            redirect('manage/paket_soal/index');
        }
    }

    public function update($id = NULL)
    {
        $this->data['post'] = $this->base_model->get_item('row', 'paket_soal', '*', ['id' => $id]);
        if (!$this->data['post']) {
            show_404();
        }
        $this->data['kategori_soal'] = $this->base_model->get_item('result', 'kategori_soal', 'DISTINCT(category)');
        $this->data['subject'] = $this->base_model->get_item('result', 'kategori_soal', 'id, category, subject');
        $this->data['soal'] = $this->base_model->get_item('result', 'soal', '*', ['bank_soal_id' => $id]);;

        $this->form_validation->set_rules('name', 'Nama Paket Soal', 'trim|required');
        $this->form_validation->set_rules('description', 'Kategori Soal', 'trim');

        if ($this->form_validation->run() === FALSE) {
            $this->data['kategori_bank_soal'] = $this->base_model->get_join_item('result', 'DISTINCT(kategori_soal.id), category, subject', 'kategori_soal.id ASC', 'kategori_soal', array('soal', 'butir_paket_soal'), array('kategori_soal.id=soal.kategori_soal_id', 'soal.id = butir_paket_soal.soal_id'), array('inner', 'inner'), array('butir_paket_soal.paket_soal_id' => $id));
            $this->data['butir_paket_soal'] = $this->base_model->get_join_item('result', 'soal.*, category, subject', NULL, 'kategori_soal', array('soal', 'butir_paket_soal'), array('kategori_soal.id=soal.kategori_soal_id', 'soal.id = butir_paket_soal.soal_id'), array('inner', 'inner'), array('butir_paket_soal.paket_soal_id' => $id));
            $this->adminview('admin/paketsoal/tambahpaketsoal', $this->data);
        } else {
            $params = array(
                'name' => $this->input->post('name', TRUE),
                'description' => $this->input->post('description', TRUE),
                'modified' => date('Y-m-d H:i:s'),
            );
            $act = $this->base_model->update_item('paket_soal', $params, array('id' => $id));
            if (!$act) {
                $this->_result_msg('danger', 'Gagal menyimpan data');
            } else {
                $this->_result_msg('success', 'Data berhasil diubah');
            }
            redirect('manage/paket_soal/update/' . $id);
        }
    }

    public function delete($id = NULL)
    {
        if (!$this->base_model->get_item('row', 'paket_soal', 'id', array('id' => $id))) {
            $this->_result_msg('danger', 'Data tidak ditemukan');
        } else {
            if ($this->base_model->get_item('row', 'butir_paket_soal', 'id', array('paket_soal_id' => $id)) || $this->base_model->get_item('row', 'tryout', 'id', array('paket_soal_id' => $id))) {
                $this->_result_msg('danger', 'Gagal menghapus data. Paket soal terkait dengan data lainnya.');
            } else {
                $result = $this->base_model->delete_item('paket_soal', array('id' => $id));
                if ($result) {
                    $this->_result_msg('success', 'Data telah dihapus');
                } else {
                    $this->_result_msg('danger', 'Gagal menghapus data');
                }
            }
        }
        redirect('manage/paket_soal');
    }

    public function delete_item_soal($paket_soal_id = NULL, $soal_id = NULL)
    {
        if (!$this->base_model->get_item('row', 'butir_paket_soal', 'id', array('paket_soal_id' => $paket_soal_id, 'soal_id' => $soal_id))) {
            $this->_result_msg('danger', 'Data tidak ditemukan');
        } else { 
            if ($this->base_model->delete_item('butir_paket_soal', array('paket_soal_id' => $paket_soal_id, 'soal_id' => $soal_id))) {
                $this->_result_msg('success', 'Data telah dihapus');
            } else {
                $this->_result_msg('danger', 'Gagal menghapus data');
            }
        }
        redirect('manage/paket_soal/update/' . $paket_soal_id);
    }

    public function delete_all_soal($paket_soal_id = NULL, $kategori_soal_id = NULL)
    {
        if (!$this->base_model->get_item('row', 'butir_paket_soal', 'id', array('paket_soal_id' => $paket_soal_id))) {
            $this->_result_msg('danger', 'Data tidak ditemukan');
        } else {
            $item = $this->base_model->get_join_item('result', 'butir_paket_soal.*', NULL, 'kategori_soal', array('soal', 'butir_paket_soal'), array('kategori_soal.id=soal.kategori_soal_id', 'soal.id = butir_paket_soal.soal_id'), array('inner', 'inner'), array('kategori_soal.id' => $kategori_soal_id, 'butir_paket_soal.paket_soal_id' => $paket_soal_id));

            if (!empty($item)) {
                foreach($item as $i){
                    $this->base_model->delete_item('butir_paket_soal', array('id' => $i['id']));
                }
                $this->_result_msg('success', 'Data telah dihapus');
            }
        }
        redirect('manage/paket_soal/update/' . $paket_soal_id);
    }

    public function add_soal()
    {

        $this->form_validation->set_rules('material', 'Nama Bank Soal', 'trim|required|numeric');
        $this->form_validation->set_rules('paket_soal_id', 'Paket Soal', 'trim|required|numeric');

        if ($this->form_validation->run() === FALSE) {
            $this->adminview('admin/paketsoal/tambahpaketsoal', $this->data);
        } else {
            $butir_soal = $this->base_model->get_item('result', 'soal', '*', ['bank_soal_id' => $this->input->post('material')]);
            foreach ($butir_soal as $soal) {
                $params = array(
                    'paket_soal_id' => $this->input->post('paket_soal_id'),
                    'soal_id' => $soal['id']
                );
                if ($this->base_model->get_item('row', 'butir_paket_soal', '*', $params)) {
                    $this->base_model->delete_item('butir_paket_soal', $params);
                }
                $this->base_model->insert_item('butir_paket_soal', $params);
            }
            redirect('manage/paket_soal/update/' . $this->input->post('paket_soal_id'));
        }
    }
}
