<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Restserver\Libraries\REST_Controller;
require APPPATH . '/libraries/REST_Controller.php';

 
class Drivers extends REST_Controller {
 
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('drivers_model');
        $this->load->model('orders_model');
    }
    public function index_get(){
        
    }
    /*
    * @method:GET
    * Link routes:api/driver/orders
    */
    public function driver_orders_get()
    {
        header('Access-Control-Allow-Origin: *');
        $data = $this->orders_model->getOrdersDriver();
        $this->response($data);
    }
    /*
    * @method:POST
    */
    public function driver_login_post()
    {
        header('Access-Control-Allow-Origin: *');
        $username = $this->post('username');
        $password = $this->post('password');
        $encrypt_pass = md5($password);
        $checkLogin = $this->drivers_model->driverDoLogin($username, $encrypt_pass);
        if($checkLogin == FALSE):
            $this->response('FAIL');
        else:
            $this->response($checkLogin);    
        endif;
        
    }
    
   
}