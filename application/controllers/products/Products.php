<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Restserver\Libraries\REST_Controller;
require APPPATH . '/libraries/REST_Controller.php';
 
class Products extends REST_Controller {
 
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('users_model');
        $this->load->model('products_model');
    }
    
    /*
    * @method:GET
    */
    public function index_get(){
        header('Access-Control-Allow-Origin: *');
        $data = $this->products_model->getProductsData();
        $this->response($data);
    }
    
    private function save_session($id_user, $token, $orders) {
		$newdata = array(
			'iduser' => $id_user,
			'token'  => $token,
            'order'  => $orders,
			'logged_in' => TRUE
		);
		$this->session->set_userdata($newdata);
	}
}