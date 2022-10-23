<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Userdashboard extends CI_Controller
{

    public function addCard1()
    {
        $awal = $this->input->post('awal');
        $akhir = $this->input->post('akhir');
        $user_dashboard = $this->db->get('interface_user_dashboard')->result_array();
        $img = $this->db->get('interface_img')->result_array();

        for ($no = 0; $no < count($user_dashboard); $no++) :
            if ($no >= $awal && $no <= $akhir) :
                $judul = $user_dashboard[$no]['judul'];
                $temp =  $this->input->post($judul);
                $this->db->set('isi', $temp);
                $this->db->where('id', $user_dashboard[$no]['id']);
                $this->db->update('interface_user_dashboard');
            endif;
        endfor;

        foreach ($img as $i) :

            // echo $i['id'] . " - " . $i['judul'] . " - " . $i['isi'] . "<br>";

            $judul = $i['judul'];

            $file = $_FILES[$judul]['name'];

            echo $file . "<br>";

            if ($file) {

                $config['upload_path']          = './asset/user/img/';
                $config['allowed_types']        = 'jpg|jpeg|png|svg';
                $config['max_size']             = 2000;

                $this->load->library('upload', $config);

                // $this->load->initialize($config);

                if (!$this->upload->do_upload($judul)) {

                    $error_m = $this->upload->display_errors();

                    $this->session->set_flashdata('message-file', "<div class='alert alert-danger'>" . $error_m . "</div>");
                } else {
                    $data = $this->upload->data();

                    $filename = $data['file_name'];

                    $id_img = $this->input->post($i['id']);

                    $this->db->set('isi', $filename);
                    $this->db->where('id', $id_img);
                    $this->db->update('interface_img');
                }
            }
        endforeach;

        // die;

        $this->session->set_flashdata('message', '<div class="alert alert-success">Update data berhasil</div>');
        redirect('admin/homepage');
    }

    public function is_active($id)
    {
        if ($id) :
            $data = $this->db->get_where('interface_user_dashboard', ['id' => $id])->row_array();
            if ($data['is_active'] == 1) :
                $this->db->set('is_active', 0);
            else :
                $this->db->set('is_active', 1);
            endif;
            $this->db->where('id', $id);
            $this->db->update('interface_user_dashboard');
        endif;
        redirect('admin/homepage');
    }


    public function add()
    {
        $isi = $this->input->post('isi');

        $this->db->insert('interface_user_list_1', ['isi' => $isi]);
        $this->session->set_flashdata('message', '<div class="alert alert-success">Add data berhasil</div>');
        redirect('admin/homepage');
    }

    public function addlisttatib()
    {
        $isi = $this->input->post('isi');

        $this->db->insert('interface_user_list_2', ['isi' => $isi]);
        $this->session->set_flashdata('message', '<div class="alert alert-success">Add data berhasil</div>');
        redirect('admin/homepage');
    }

    public function edit()
    {
        $isi = $this->input->post('isi');
        $id = $this->input->post('id');

        $this->db->where('id', $id);
        $this->db->update('interface_user_list_1', ['isi' => $isi]);

        $this->session->set_flashdata('message', '<div class="alert alert-success">Update data berhasil</div>');
        redirect('admin/homepage');
    }

    public function editul2()
    {
        $isi = $this->input->post('isi');
        $id = $this->input->post('id');

        $this->db->where('id', $id);
        $this->db->update('interface_user_list_2', ['isi' => $isi]);

        $this->session->set_flashdata('message', '<div class="alert alert-success">Update data berhasil</div>');
        redirect('admin/homepage');
    }

    public function hapus($id)
    {

        $this->db->where('id', $id);
        $this->db->delete('interface_user_list_1');

        $this->session->set_flashdata('message', '<div class="alert alert-success">Hapus data berhasil</div>');
        redirect('admin/homepage');
    }

    public function hapusul2($id)
    {

        $this->db->where('id', $id);
        $this->db->delete('interface_user_list_2');

        $this->session->set_flashdata('message', '<div class="alert alert-success">Hapus data berhasil</div>');
        redirect('admin/homepage');
    }
}
