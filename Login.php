<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("Home_model");
    }

    public function index() {
        if ($this->session->userdata('active_user_id'))
            redirect(site_url('web/home/index'));

        $input = $this->input->post();
        if ($input) {
            $this->Home_model->login($input);
        }
        $view_data['products'] = $this->Home_model->get_products();
        $this->load->view('user/login', $view_data);
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect(site_url('web/home/index'));
    }

    public function register() {
        $input = $this->input->post();
        if ($input) {
            $this->db->where('email', $input['email']);
            $result = $this->db->get('users')->row();
            if ($result) {
                echo json_encode(array("data" => 2, "target" => "email", "message" => "Email Already Exist"));
                die;
            }
            $input['user_type'] = 1;
            $input['created'] = time();
            $input['status'] = 1;
            $input['password'] = md5($input['password']);
            if ($input['password'] != md5($input['c_password'])) {
                echo json_encode(array("data" => 1, "message" => "Password Does Not Match"));
                die;
            } else {
                unset($input['c_password']);
                $this->db->insert('users', $input);
                echo json_encode(array("data" => 1, "message" => "Registration Successful. Now you can login"));
                die;
            }
        }
        $this->load->view('user/register');
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

    function change_password() {
        if ($input = $this->input->post()) {
            if ($input['password'] != $input['c_password'])
                echo json_encode(array("data" => 2, "message" => "Password Does Not Match"));
            else {
                $this->db->where("id", $this->session->userdata('active_user_id'));
                $this->db->update("users", array("password" => md5($input['password'])));
                echo json_encode(array("data" => 1, "message" => "Password Changed Successfully"));
            }die;
        }
        $this->load->view('user/change_password', array());
    }

    function profile() {
        if ($input = $this->input->post()) {
            $this->db->where("id", $this->session->userdata('active_user_id'));
            $this->db->update("users", $input);
            echo json_encode(array("data" => 1, "message" => "Profile Update Successfully"));
            die;
        }
        $view_data['profile'] = $this->session->userdata('active_user_data');
        $this->load->view('user/profile', $view_data);
    }

}
