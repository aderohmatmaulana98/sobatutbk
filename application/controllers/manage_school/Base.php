<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class SchoolBase extends CI_Controller
{

    protected $data = [];
    public function __construct()
    {

        parent::__construct();
        $uri_except_reseller = ['userdata'];
        $this->load->model('base_model');
        $this->load->library(['ion_auth']);

        if (!in_array($this->uri->segment(2), $uri_except_reseller)) {
            $this->_is_logged_in();
        }

        $this->data['user'] = $this->ion_auth->user($this->session->userdata('user_id'))->row();
        $this->data['item'] = [];
    }

    public function schoolview($child_view = "", $data = array())
    {
        $data['child_template'] = $child_view;
        $data['user_reseller'] = $this->base_model->get_join_item('row', '*', NULL, 'users', ['users_groups'], ['users.id=users_groups.user_id'], ['inner'], ['users.id' => $this->session->userdata('user_id'), 'group_id' => 3]);
        $this->load->view('school/template/header', $data);
        $this->load->view('school/template/sidebar');
        $this->load->view('school/template/topbar');
        $this->load->view($child_view);
        $this->load->view('school/template/footer');
    }

    public function _result_msg($alert, $msg)
    {
        return $this->session->set_flashdata(array(
            'msg' => $msg,
            'alert' => 'alert-' . $alert
        ));
    }

    public function _is_logged_in()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            show_404();
        }
    }
}
