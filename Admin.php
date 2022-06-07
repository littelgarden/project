<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MX_Controller {

    function __construct() {
        parent::__construct();
        modules::run('admin/Admin_ini/admin_ini');
        $this->load->model('Admin_model');
    }

    public function push() {
        $view_data['tab'] = 'dashboard';
        $data['page_data'] = $this->load->view('push', $view_data, TRUE);
        echo modules::run(ADMIN_DEFAULT_TEMPLATE, $data);
    }

    public function index($id = '') {
        $view_data = $this->Admin_model->index();
        $view_data['tab'] = 'dashboard';
        $data['page_data'] = $this->load->view('admin/admin/WELCOME_PAGE_SUPER_USER', $view_data, TRUE);
        $data['page_title'] = "welcome page";
        echo modules::run(ADMIN_DEFAULT_TEMPLATE, $data);
    }

    function add_role() {
        $input = $this->input->post();
        $list = TRUE;
        if (isset($_GET['id']) && !$input) {
            $view_data['result'] = $this->Admin_model->get_roles();
            $view_data['role_group'] = $this->Admin_model->get_role_group($_GET['id']);
            $list = FALSE;
        }
        if ($input) {
            $this->Admin_model->add_role($input);
        }
        $view_data['tab'] = 'role management';
        $view_data['sub_tab'] = 'add role';
        if ($list) {
            $data['page_data'] = $this->load->view('admin/admin/role_list', $view_data, TRUE);
        } else {
            $data['page_data'] = $this->load->view('admin/admin/add_role', $view_data, TRUE);
        }
        echo modules::run(ADMIN_DEFAULT_TEMPLATE, $data);
    }

    function ajax_roles_list() {
        $this->Admin_model->ajax_roles_list();
    }

    function ajax_delete_role() {
        $this->db->where('id', $this->input->post('id'));
        $this->db->delete('user_permission_group');
        echo json_encode(array("data" => 1));
    }

    function add_user() {
        $view_data['tab'] = 'role management';
        $view_data['sub_tab'] = 'add user';
        $view_data['perms'] = $this->db->get('user_permission_group')->result_array();
        $data['page_data'] = $this->load->view('admin/admin/add_user', $view_data, TRUE);
        echo modules::run(ADMIN_DEFAULT_TEMPLATE, $data);
    }

    function ajax_add_user() {
        $input = $this->input->post();
        if ($input) {
            $this->Admin_model->ajax_add_user($input);
        }
    }

    function ajax_users_list() {
        $this->Admin_model->ajax_users_list();
    }

    function ajax_delete_user() {
        $this->db->where('id', $this->input->post('id'));
        $this->db->delete('users');
        echo json_encode(array("data" => 1));
    }

    function change_requested_password() {
        $input = $this->input->post();
        if ($input) {
            $this->Admin_model->change_requested_password($input);
        }
        page_alert_box("success", "Password Changed");
        redirect($_SERVER['HTTP_REFERER']);
    }
}
