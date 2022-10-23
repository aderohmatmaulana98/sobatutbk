<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once 'application/controllers/manage/Base.php';

class Reseller extends AdminBase
{
    public $data = [];

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(['ion_auth']);
        $this->load->helper(['url', 'language']);

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
        $this->data['title'] = "User Sekolah";
    }

    public function index()
    {
        if (!$this->ion_auth->is_admin()) {
            show_404();
        }

        $this->data['resellers'] = $this->base_model->get_join_item('result', 'users.*', NULL, 'users', ['users_groups'], ['users.id=users_groups.user_id'], ['inner'], ['group_id' => 4]);
        $tables = $this->config->item('tables', 'ion_auth');
        $identity_column = $this->config->item('identity', 'ion_auth');
        $this->data['identity_column'] = $identity_column;
        $this->config->set_item('ion_auth', FALSE, 'email_activation');

        // validate form input
        $this->form_validation->set_rules('first_name', 'Nama', 'trim|required');
        if ($identity_column !== 'email') {
            $this->form_validation->set_rules('identity', 'Username', 'trim|required|is_unique[' . $tables['users'] . '.' . $identity_column . ']');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[' . $tables['users'] . '.email]');
        } else {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[' . $tables['users'] . '.email]');
        }
        $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim|numeric|required');
        $this->form_validation->set_rules('company', $this->lang->line('create_user_validation_company_label'), 'trim');
        $this->form_validation->set_rules('kabupaten', 'Kabupaten', 'trim|required');
        $this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
        $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']');
        //$this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[password_confirm]');
        //$this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

        if ($this->form_validation->run() === TRUE) {
            $email = strtolower($this->input->post('email'));
            $identity = $this->input->post('identity');
            $password = $this->input->post('password');

            $additional_data = [
                'first_name' => $this->input->post('first_name'),
                'company' => $this->input->post('company'),
                'phone' => $this->input->post('phone'),
                'kabupaten' => $this->input->post('kabupaten'),
                'provinsi' => $this->input->post('provinsi'),
            ];
        }
        if ($this->form_validation->run() === TRUE) {
            $created_id = $this->ion_auth->register($identity, $password, $email, $additional_data, [4]);
            
            if ($created_id) {
                $this->base_model->update_item('users', ['active' => 1], ['id' => $created_id]);
            }
            // check to see if we are creating the user
            // redirect them back to the admin page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            $this->session->set_flashdata('message_sa', 'example');

            redirect("manage/reseller", 'refresh');
        } else {
            // display the create user form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['first_name'] = [
                'name' => 'first_name',
                'id' => 'first_name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('first_name'),
                'class' => 'form-control',
                'placeholder' => 'Nama'
            ];
            $this->data['identity'] = [
                'name' => 'identity',
                'id' => 'identity',
                'type' => 'text',
                'value' => $this->form_validation->set_value('identity'),
                'class' => 'form-control',
                'placeholder' => 'Username'
            ];
            $this->data['email'] = [
                'name' => 'email',
                'id' => 'email',
                'type' => 'text',
                'value' => $this->form_validation->set_value('email'),
                'class' => 'form-control',
                'placeholder' => 'Email'
            ];
            $this->data['company'] = [
                'name' => 'company',
                'id' => 'company',
                'type' => 'text',
                'value' => $this->form_validation->set_value('company'),
                'class' => 'form-control',
                'placeholder' => 'Sekolah'
            ];
            $this->data['phone'] = [
                'name' => 'phone',
                'id' => 'phone',
                'type' => 'text',
                'value' => $this->form_validation->set_value('phone'),
                'class' => 'form-control',
                'placeholder' => 'No Telp/WA'
            ];
            $this->data['password'] = [
                'name' => 'password',
                'id' => 'password',
                'type' => 'password',
                'value' => $this->form_validation->set_value('password'),
                'class' => 'form-control',
                'placeholder' => 'Password'
            ];
            $this->data['kabupaten'] = [
                'name' => 'kabupaten',
                'id' => 'kabupaten',
                'type' => 'text',
                'value' => $this->form_validation->set_value('kabupaten'),
                'class' => 'form-control',
                'placeholder' => 'Kabupaten'
            ];
            $this->data['provinsi'] = [
                'name' => 'provinsi',
                'id' => 'provinsi',
                'type' => 'text',
                'value' => $this->form_validation->set_value('provinsi'),
                'class' => 'form-control',
                'placeholder' => 'Provinsi'
            ];
            // $this->data['password_confirm'] = [
            //     'name' => 'password_confirm',
            //     'id' => 'password_confirm',
            //     'type' => 'password',
            //     'value' => $this->form_validation->set_value('password_confirm'),
            // ];
            $this->adminview('admin/reseller/reseller', $this->data);
        }
    }

    public function delete_school($id)
    {
        $sql = "DELETE FROM users WHERE users.`id` = $id";
        $this->db->query($sql);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    Akun berhasil dihapus !!
  </div>');
        redirect('manage/reseller');
    }

    public function edit_school()
    {
        $this->data['resellers'] = $this->base_model->get_join_item('result', 'users.*', NULL, 'users', ['users_groups'], ['users.id=users_groups.user_id'], ['inner'], ['group_id' => 4]);
        $this->adminview('admin/reseller/edit_school', $this->data);
    }
    public function edit_school_aksi()
    {
        $username = $this->input->post('username');
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $company = $this->input->post('company');
        $provinsi = $this->input->post('provinsi');
        $id = $this->input->post('id');
        $kabupaten = $this->input->post('kabupaten');


        $this->db->set('username', $username);
        $this->db->set('first_name', $nama);
        $this->db->set('email', $email);
        $this->db->set('phone', $phone);
        $this->db->set('company', $company);
        $this->db->set('provinsi', $provinsi);
        $this->db->set('kabupaten', $kabupaten);
        $this->db->where('id', $id);

        $this->db->update('users');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Akun berhasil di ubah !!
      </div>');
        redirect('manage/reseller');
    }
}
