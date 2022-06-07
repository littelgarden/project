<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("Home_model");
    }

    public function index() {
        $view_data['banners'] = $this->Home_model->get_banners();
        $view_data['products'] = $this->Home_model->get_products();
        $view_data['tags'] = $this->Home_model->get_tags();
        $this->load->view('home/home', $view_data);
    }

    function add_to_cart() {
        if (isset($_SESSION['cart'][$_POST['id']])) {
            $_SESSION['cart'][$_POST['id']]['quantity']++;
        } else {
            $_SESSION['cart'][$_POST['id']]['quantity'] = 1;
        }
        echo json_encode(array("data" => 1));
    }

    function my_cart() {
        $view_data['orders'] = array();
        $view_data['is_cart'] = 1;
        $this->load->view('home/my_cart', $view_data);
    }

    function order_history() {
        $this->db->select("o.order_id,p.title,p.image,o.quantity,o.price,p.currency,o.product_id,o.status");
        $this->db->order_by("o.id", "desc");
        $this->db->where("o.user_id", $this->session->userdata('active_user_id'));
        $this->db->join("products p", "p.id=o.product_id");
        $view_data['orders'] = $this->db->get("orders o")->result_array();

        $view_data['is_cart'] = 0;
        $this->load->view('home/my_cart', $view_data);
    }

    function remove_items_from_cart() {
        if ($_POST) {
            foreach ($_POST['ids'] as $key => $value) {
                unset($_SESSION['cart'][$value]);
            }
        }
        echo json_encode(array("data" => 1));
    }

    function change_quantity() {
        if ($_POST['quantity'])
            $_SESSION['cart'][$_POST['id']]['quantity'] = $_POST['quantity'];
        else
            unset($_SESSION['cart'][$_POST['id']]);
        echo json_encode(array("data" => 1));
    }

    function product_detail($id) {
        if ($this->session->userdata('active_user_id')) {
            $this->db->where("user_id", $this->session->userdata('active_user_id'));
            $view_data['feedbacks'] = $this->db->get("feedback")->result_array();
        } else {
            $view_data['feedbacks'] = array();
        }

        $this->db->where("product_id", $id);
        $view_data['product_reports'] = $this->db->get("product_feedback")->result_array();

        $this->db->where("id", $id);
        $view_data['product'] = $this->db->get("products")->row_array();
        $view_data['products'] = $this->Home_model->get_products($view_data['product']['tags']);
        $this->load->view('home/product_detail', $view_data);
    }

    function feedback() {
        $input = $this->input->post();
        $feedback = array(
            "user_id" => $this->session->userdata('active_user_id'),
            "type" => 1,
            "title" => $input['title'],
            "message" => $input['message'],
            "created" => time(),
            "status" => 1
        );
        $this->db->insert("feedback", $feedback);
        $this->session->set_flashdata("flash_alert", "Feedback Submitted");
        redirect($_SERVER['HTTP_REFERER']);
    }

    function product_report() {
        $input = $this->input->post();
        $feedback = array(
            "user_id" => $this->session->userdata('active_user_id'),
            "product_id" => $input['product_id'],
            "description" => $input['message'],
            "created" => time(),
        );
        $this->db->insert("product_feedback", $feedback);
        $this->session->set_flashdata("flash_alert", "Product Reported");
        redirect($_SERVER['HTTP_REFERER']);
    }

    function check_out() {
        $this->db->order_by("order_id", "desc");
        $order = $this->db->get("orders")->row_array();
        if ($order) {
            $order_id = ++$order['order_id'];
        } else {
            $order_id = 1;
        }

        foreach ($_SESSION['cart'] as $key => $value) {
            $this->db->where("id", $key);
            $product = $this->db->get("products")->row_array();

            $insert = array(
                "user_id" => $this->session->userdata('active_user_id'),
                "product_id" => $key,
                "quantity" => $value['quantity'],
                "price" => $product['price'] * $value['quantity'],
                "status" => 0,
                "created" => time(),
                "order_id" => $order_id
            );
            $this->db->insert("orders", $insert);
        }
        unset($_SESSION['cart']);
        $this->session->set_flashdata("flash_alert", "Order Has Been Placed Successfully");
        redirect($_SERVER['HTTP_REFERER']);
    }

    function my_orders() {
        $view_data['orders'] = $this->Home_model->my_orders($this->session->userdata('active_user_id'));
        $this->load->view('home/my_orders', $view_data);
    }

    function about_us() {
        $view_data['about'] = $this->db->where("tag", "ABOUT_US")->get("meta_info")->row()->value;
        $this->load->view('home/about_us', $view_data);
    }

    function contact_us() {
        $view_data['contact_us'] = $this->db->where("tag", "CONTACT_US")->get("meta_info")->row()->value;
        $this->load->view('home/contact_us', $view_data);
    }

}
