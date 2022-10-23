<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once 'application/third_party/midtrans/Midtrans.php';

class Home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        error_reporting(0);
        $this->load->model('base_model');
    }
    public function index()
    {
        // if ($this->input->get('bypass', TRUE) != true) {
        //     redirect('auth/login', 'refresh');
        // }

        $data['title'] = "Platform Simulasi SBMPTN untuk Mengukur Potensi Siswa";

        $data['master'] = $this->db->get('interface')->result_array();
        $data['misi'] = $this->db->get('interface_misi')->result_array();
        $data['faq'] = $this->db->get('interface_faq')->result_array();
        $data['img'] = $this->db->get('interface_img')->result_array();
        $data['testi'] = $this->db->get('testimoni')->result_array();
        $data['product'] = $this->base_model->get_join_item('result', 'product.*', NULL, 'product', ['product_item'], ['product.id=product_item.product_id'], ['inner'], ['status' => 1], ['product.id']);


        // die;

        $this->load->view('homepage/new/component/header', $data);
        $this->load->view('homepage/new/index');
        $this->load->view('homepage/new/component/footer');
    }

    public function tentang()
    {
        $data['master'] = $this->db->get('interface')->result_array();
        $data['misi'] = $this->db->get('interface_misi')->result_array();
        $data['faq'] = $this->db->get('interface_faq')->result_array();
        $data['img'] = $this->db->get('interface_img')->result_array();
        $data['testi'] = $this->db->get('testimoni')->result_array();

        $data['title'] = "Tentang";
        $this->load->view('homepage/new/component/header', $data);
        $this->load->view('homepage/new/tentang');
        $this->load->view('homepage/new/component/footer');
    }

    public function testimoni()
    {
        $data['master'] = $this->db->get('interface')->result_array();
        $data['misi'] = $this->db->get('interface_misi')->result_array();
        $data['faq'] = $this->db->get('interface_faq')->result_array();
        $data['img'] = $this->db->get('interface_img')->result_array();
        $data['testi'] = $this->db->get('testimoni')->result_array();

        $data['title'] = "Testimoni";

        $this->load->view('homepage/new/component/header', $data);
        $this->load->view('homepage/new/testimoni');
        $this->load->view('homepage/new/component/footer');
    }

    public function galeri()
    {

        $data['title'] = "Galeri";

        $this->load->view('homepage/new/component/header', $data);
        $this->load->view('homepage/new/galeri');
        $this->load->view('homepage/new/component/footer');
    }

    public function maintenance()
    {
        $data['title'] = "Under Construction - SobatUTBK";
        $data['message'] = "Under Construction";
        $data['deadline_time'] = "Oct 20, 2021 23:59:59";
        $this->load->view('homepage/maintenance', $data);
    }
}
