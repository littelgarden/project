<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends MX_Controller {

    function __construct() {
        parent::__construct();
        modules::run('admin/admin_ini/admin_ini');
        $this->load->model('Orders_model');
    }

    function index() {
        $view_data['tab'] = "orders";
        $data['page_data'] = $this->load->view('orders/orders', $view_data, TRUE);
        echo modules::run(ADMIN_DEFAULT_TEMPLATE, $data);
    }

    function ajax_orders_list() {
        $this->Orders_model->ajax_orders_list();
    }

    function chage_orders($id,$status) {
        $this->Orders_model->chage_orders($id,$status);
    }

}

?>