<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Testimoni extends CI_Controller
{

    public function add()
    {
        $nama = $this->input->post('nama');
        $instansi = $this->input->post('instansi');
        $caption = $this->input->post('caption');

        $data = [
            'nama' => $nama,
            'instansi' => $instansi,
            'isi' => $caption
        ];

        $this->db->insert('testimoni', $data);

        redirect('admin/homepage');
    }

    public function edit()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $instansi = $this->input->post('instansi');
        $caption = $this->input->post('caption');

        $data = [
            'nama' => $nama,
            'instansi' => $instansi,
            'isi' => $caption
        ];

        $this->db->where('id', $id);
        $this->db->update('testimoni', $data);

        redirect('admin/homepage');
    }

    public function hapus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('testimoni');

        redirect('admin/homepage');
    }
}
