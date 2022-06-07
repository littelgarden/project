<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MX_Controller {

    function __construct() {
        parent::__construct();
        modules::run('admin/admin_ini/login_ini');
        $this->load->library('form_validation', 'uploads');
    }

    public function index() {
        if ($this->session->userdata('active_admin_data'))
            redirect(site_url('admin/admin/index'));

        $prompt = array();
        if ($this->input->post()) {
            $input = $this->input->post();

            $this->db->select("users.*");
            $this->db->Where("users.email", $input['email']);
            $this->db->Where("users.password", md5($input['password']));
            $this->db->group_start()
                    ->where("users.user_type", 2)
                    ->or_where("users.user_type", 3)
                    ->group_end();
            $this->db->where('users.status', 1);
            $result = $this->db->get('users')->row();
            
            if ($result) {
                $newdata = array(
                    'active_admin_flag' => True,
                    'active_admin_id' => $result->id,
                    'active_admin_data' => $result,
                    'admin_name' => $result->name,
                    'admin_email' => $result->email
                );
                $this->session->set_userdata($newdata);
                redirect(site_url('admin/admin/index'));
            } else {
                $this->db->Where("email", $input['email']);
                $result = $this->db->get('users')->row();
                if ($result) {
                    if ($result->password != md5($input['password'])) {
                        $prompt = array(
                            "type" => "warning",
                            "message" => "Enter Valid Password..!"
                        );
                    } else if ($result->user_type != 2) {
                        $prompt = array(
                            "type" => "error",
                            "message" => "Enter Valid Details..!"
                        );
                    } else if ($result->status == 0) {
                        $prompt = array(
                            "type" => "warning",
                            "message" => "Your Account is pending for activation..!"
                        );
                    } else if ($result->status == 2) {
                        $prompt = array(
                            "type" => "error",
                            "message" => "Your Account is Blocked..!"
                        );
                    } else if ($result->status == 3) {
                        $prompt = array(
                            "type" => "error",
                            "message" => "Your Account is Deleted..!"
                        );
                    } else {
                        $prompt = array(
                            "type" => "error",
                            "message" => "Enter Valid Email..!"
                        );
                    }
                } else
                    $prompt = array(
                        "type" => "error",
                        "message" => "Enter Valid Email..!"
                    );
            }
        }
        //$this->load->view('tutor_panel/login/login');
        $this->load->view('login/login', array("prompt" => $prompt));
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect(site_url('admin/login/index'));
    }

    public function register() {
        $input = $this->input->post();
        if ($input) {
            $input['user_type'] = 2;
            $input['created'] = time();
            $input['status'] = 3;
            $this->db->insert('users', $input);
            redirect("admin/login");
        }
        $this->load->view('login/register');
    }

    function request_reset_password() {
        $input = $this->input->post();
        if ($input) {
            $this->db->where('email', $input['email']);
            $this->db->where('user_type', 2);
            $user = $this->db->get("users")->row_array();
            if ($user) {
                $this->db->where('email', $input['email']);
                $this->db->update('users', array("reset_status" => 1));
                if ($this->db->affected_rows() > 0) {
                    echo json_encode(array("data" => 3));
                } else {
                    echo json_encode(array("data" => 2));
                }
            } else {
                echo json_encode(array("data" => 1));
            }
        }
    }

}
