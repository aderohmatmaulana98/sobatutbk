<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Alasan extends CI_Controller
{

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


        redirect('admin/homepage');
    }
}
