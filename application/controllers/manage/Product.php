<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once 'application/controllers/manage/Base.php';

class Product extends AdminBase
{
    public function __construct()
    {
        parent::__construct();
        $this->data['title'] = "Product";
    }

    public function index()
    {
        $this->data['item'] = $this->base_model->get_item('result', 'product', '*');
        $this->adminview('admin/produk/product', $this->data);
    }

    public function create()
    {
        $this->form_validation->set_rules('name', 'Nama Produk', 'trim|required');
        $this->form_validation->set_rules('description', 'Deskripsi', 'trim');
        $this->form_validation->set_rules('type', 'Kategori', 'trim|required|numeric');
        $this->form_validation->set_rules('status', 'Status', 'trim|required|numeric');

        if ($this->form_validation->run() === FALSE) {
            $this->data['name'] = [
                'name'  => 'name',
                'id'    => 'name',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('name'),
                'class' => 'form-control',
                'placeholder' => 'Nama Produk'
            ];
            $this->data['description'] = [
                'name'  => 'description',
                'id'    => 'description',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('description'),
                'class' => 'form-control',
                'placeholder' => 'Deskripsi Produk'
            ];
            $this->data['message'] = validation_errors();
            $this->adminview('admin/produk/tambahproduct', $this->data);
        } else {
            $params = array(
                'name' => $this->input->post('name', TRUE),
                'description' => $this->input->post('description'),
                'type' => $this->input->post('type', TRUE),
                'status' => $this->input->post('status', TRUE),
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            );
            $act = $this->base_model->insert_item('product', $params, 'id');
            if ($act) {
                $this->_result_msg('success', 'Data baru telah ditambahkan');
                redirect('manage/product/update/' . $act);
            } else {
                $this->_result_msg('danger', 'Gagal menambahkan data');
                redirect('manage/product/create');
            }
        }
    }

    public function update($id = NULL)
    {
        $this->data['post'] = $this->base_model->get_item('row', 'product', '*', ['id' => $id]);
        if (!$this->data['post']) {
            show_404();
        }
        $this->data['product_item'] = $this->base_model->get_join_item('result', 'product_item.*', NULL, 'product_item', ['product'], ['product_item.product_id=product.id'], ['inner'], ['product.id' => $id]);

        $this->form_validation->set_rules('name', 'Nama Produk', 'trim|required');
        $this->form_validation->set_rules('description', 'Deskripsi', 'trim');
        $this->form_validation->set_rules('type', 'Kategori', 'trim|required|numeric');
        $this->form_validation->set_rules('status', 'Status', 'trim|required|numeric');

        if ($this->form_validation->run() === FALSE) {
            $this->data['name'] = [
                'name'  => 'name',
                'id'    => 'name',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('name', $this->data['post']['name']),
                'class' => 'form-control',
                'placeholder' => 'Nama Produk'
            ];
            $this->data['description'] = [
                'name'  => 'description',
                'id'    => 'description',
                'type'  => 'textarea',
                'value' => $this->form_validation->set_value('description', $this->data['post']['description']),
                'class' => 'form-control',
                'placeholder' => 'Deskripsi Produk'
            ];
            $this->data['message'] = validation_errors();
            $this->adminview('admin/produk/tambahproduct', $this->data);
        } else {
            $params = array(
                'name' => $this->input->post('name', TRUE),
                'description' => $this->input->post('description'),
                'type' => $this->input->post('type', TRUE),
                'status' => $this->input->post('status', TRUE),
                'modified' => date('Y-m-d H:i:s')
            );
            $act = $this->base_model->update_item('product', $params, array('id' => $id));
            if (!$act) {
                $this->_result_msg('danger', 'Gagal menyimpan data');
            } else {
                $this->_result_msg('success', 'Data berhasil diubah');
            }
            redirect('manage/product/update/' . $id);
        }
    }

    public function add_ticket()
    {
        $this->form_validation->set_rules('product_id', 'Produk', 'trim|numeric|required');
        $this->form_validation->set_rules('quantity', 'Jumlah Tiket', 'trim|numeric|required');
        $this->form_validation->set_rules('price', 'Harga', 'trim|numeric|required');
        $this->form_validation->set_rules('description', 'Keterangan Deskripsi', 'trim');

        if ($this->form_validation->run() === FALSE) {
            $this->_result_msg('danger', validation_errors());
            redirect('manage/product/update/' . $this->input->post('product_id'));
        } else {
            $params = array(
                'product_id' => $this->input->post('product_id', TRUE),
                'quantity' => $this->input->post('quantity', TRUE),
                'price' => $this->input->post('price', TRUE),
                'description' => $this->input->post('description', TRUE),
            );
            if ($this->base_model->insert_item('product_item', $params, 'id')) {
                $this->_result_msg('danger', 'Data baru telah ditambahkan');
            } else {
                $this->_result_msg('success', 'Gagal menambahkan data');
            }
            redirect('manage/product/update/' . $this->input->post('product_id'));
        }
    }

    public function delete($id = NULL)
    {
        if (!$this->base_model->get_item('row', 'product', 'id', array('id' => $id))) {
            $this->_result_msg('danger', 'Data tidak ditemukan');
        } else {
            if ($this->base_model->delete_item('product', array('id' => $id))) {
                $this->_result_msg('success', 'Data telah dihapus');
            } else {
                $this->_result_msg('danger', 'Gagal menghapus data');
            }
        }
        redirect('manage/product');
    }

    public function delete_product_item($id = NULL, $product_id = NULL)
    {
        if (!$this->base_model->get_item('row', 'product_item', 'id', array('id' => $id))) {
            $this->_result_msg('danger', 'Data tidak ditemukan');
        } else {
            if ($this->base_model->delete_item('product_item', array('id' => $id))) {
                $this->_result_msg('success', 'Data telah dihapus');
            } else {
                $this->_result_msg('danger', 'Gagal menghapus data');
            }
        }
        redirect('manage/product/update/' . $product_id);
    }

    public function delete_all($uri = NULL)
    {
        $data = $this->input->post('pcheck');
        if (!empty($data)) {
            foreach ($data as $value) {
                if ($this->base_model->get_item('row', 'bank_soal', 'id', array('id' => $value))) {
                    $this->base_model->delete_item('bank_soal', array('id' => $value));
                }
            }
        } else {
            $this->_result_msg('danger', 'Tidak ada data yang dipilih');
        }
        redirect('manage/bank_soal/show');
    }
}
