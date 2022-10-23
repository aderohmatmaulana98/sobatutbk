<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tentang extends CI_Controller
{

    public function addMisi()
    {
        $misi = $this->input->post('misi');

        $this->db->insert('interface_misi', ['isi' => $misi]);

        $this->session->set_flashdata('message', '<div class="alert alert-success">Tambah data misi berhasil</div>');


        redirect('admin/homepage');
    }

    public function updateMisi()
    {
        $id = $this->input->post('id');
        $misi = $this->input->post('misi');

        $this->db->set('isi', $misi);
        $this->db->where('id', $id);
        $this->db->update('interface_misi');

        $this->session->set_flashdata('message', '<div class="alert alert-success">Update data misi berhasil</div>');


        redirect('admin/homepage');
    }

    public function deleteMisi($id)
    {

        $this->db->where('id', $id);
        $this->db->delete('interface_misi');

        $this->session->set_flashdata('message', '<div class="alert alert-success">Hapus data misi berhasil</div>');


        redirect('admin/homepage');
    }

    public function update()
    {
        $master = $this->db->get('interface')->result_array();
        $img = $this->db->get('interface_img')->result_array();

        $awal = $this->input->post('awal');
        $akhir = $this->input->post('akhir');

        for ($no = 0; $no < count($master); $no++) :
            if ($no >= $awal && $no <= $akhir) :
                $judul = $master[$no]['judul'];
                $temp =  $this->input->post($judul);
                $this->db->set('isi', $temp);
                $this->db->where('id', $master[$no]['id']);
                $this->db->update('interface');
            endif;
        endfor;

        foreach ($img as $i) :

            // echo $i['id'] . " - " . $i['judul'] . " - " . $i['isi'] . "<br>";

            $judul = $i['judul'];

            $file = $_FILES[$judul]['name'];

            if ($file) {

                $config['upload_path']          = './asset/homepage/img/';
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

        $this->session->set_flashdata('message', '<div class="alert alert-success">Update data berhasil</div>');
        // die;

        redirect('admin/homepage');
    }

    public function addFAQ()
    {
        $tanya = $this->input->post('tanya');
        $jawab = $this->input->post('jawab');

        $data = [
            'tanya' => $tanya,
            'jawab' => $jawab
        ];

        $this->db->insert('interface_faq', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success">Add data FAQ berhasil</div>');

        redirect('admin/homepage');
    }

    public function updateFAQ()
    {
        $id = $this->input->post('id');
        $tanya = $this->input->post('tanya');
        $jawab = $this->input->post('jawab');

        $data = [
            'tanya' => $tanya,
            'jawab' => $jawab
        ];

        $this->db->where('id', $id);
        $this->db->update('interface_faq', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success">Update data FAQ berhasil</div>');

        redirect('admin/homepage');
    }

    public function deleteFAQ($id)
    {

        $this->db->where('id', $id);
        $this->db->delete('interface_faq');

        $this->session->set_flashdata('message', '<div class="alert alert-success">Delete data FAQ berhasil</div>');

        redirect('admin/homepage');
    }
}
