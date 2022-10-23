<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class AdminBase extends CI_Controller
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

    public function adminview($child_view = "", $data = array())
    {
        $sql = "SELECT users.id, users.company , `users_resellers`.`reseller_id`
                FROM `users`, `groups`, `users_groups`, `users_resellers`
                WHERE `users`.`id` = `users_groups`.`user_id`
                AND `groups`.`id` = `users_groups`.`group_id`
                AND users_resellers.`reseller_id` = users.`id`
                AND groups.`id` = 4
                GROUP BY users.id";
        $data['school'] = $this->db->query($sql)->result_array();
        $data['child_template'] = $child_view;
        $data['user_reseller'] = $this->base_model->get_join_item('row', '*', NULL, 'users', ['users_groups'], ['users.id=users_groups.user_id'], ['inner'], ['users.id' => $this->session->userdata('user_id'), 'group_id' => 3]);
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/template/topbar');
        $this->load->view($child_view);
        $this->load->view('admin/template/footer');
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
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            // redirect them to the login page
            show_404();
        }
    }
}
