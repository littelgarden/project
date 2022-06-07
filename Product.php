<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MX_Controller {

    function __construct() {
        parent::__construct();
        modules::run('admin/admin_ini/admin_ini');
        $this->load->model('Product_model');
    }

    function index() {
        $input = $this->input->post();
        if ($input)
            $this->Product_model->add_update_product($input);
        $view_data['tab'] = "product management";
        $data['page_data'] = $this->load->view('product/product', $view_data, TRUE);
        echo modules::run(ADMIN_DEFAULT_TEMPLATE, $data);
    }

    function ajax_products_list() {
        $this->Product_model->ajax_products_list();
    }

    function ajax_delete_product() {
        $input = $this->input->post();
        if ($input) {
            $this->db->where('id', $input['id']);
            $this->db->update('products', array("status" => 2));
            echo json_encode(array('data' => 1));
        }
    }
}

?>