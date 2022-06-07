<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback extends MX_Controller {

    function __construct() {
        parent::__construct();
        modules::run('admin/admin_ini/admin_ini');
        $this->load->model('Feedback_model');
    }

    function index() {
        $view_data['tab'] = "feedback";
        $data['page_data'] = $this->load->view('feedback/feedback', $view_data, TRUE);
        echo modules::run(ADMIN_DEFAULT_TEMPLATE, $data);
    }

    function view_feedback($id) {
        if ($input = $this->input->post()) {
            $input['type'] = 2;
            $input['created'] = time();
            $input['status'] = 1;
            $input['parent_id'] = $id;
            
            $this->db->insert("feedback", $input);
        }
        $view_data['tab'] = "feedback";
        $this->db->group_start()
                ->where("id", $id)
                ->or_where("parent_id", $id)
                ->group_end();
        $view_data['feedbacks'] = $this->db->get("feedback")->result_array();
        $data['page_data'] = $this->load->view('feedback/view_feedback', $view_data, TRUE);
        echo modules::run(ADMIN_DEFAULT_TEMPLATE, $data);
    }

    function ajax_feedback_list() {
        $this->Feedback_model->ajax_feedback_list();
    }

    function delete_feedback($id) {
        $this->Feedback_model->delete_feedback($id);
    }

}

?>