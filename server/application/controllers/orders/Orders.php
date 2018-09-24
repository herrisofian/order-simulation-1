<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Restserver\Libraries\REST_Controller;
require APPPATH . '/libraries/REST_Controller.php';

 
class Orders extends REST_Controller {
 
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('orders_model');
    }
    public function index_post(){
        
    }
    /*
    * @method:POST
    */
    public function order_post()
    {
        header('Access-Control-Allow-Origin: *');
        $id_item = $this->post('iditem');
        $address = $this->post('address');
        $id_user = $this->post('iduser');
        $dataInsert = array(
            'address'=>$address,
            'id_item'=>$id_item,
            'id_user'=>$id_user
        );
        
        
        $order_id = $this->orders_model->insertOrders($dataInsert);
        $dataInsertOrderStatus = array(
            'statusdatetime'=> date("Y-m-d H:i:s"),
            'id_order'=>$order_id
        );
        $this->orders_model->insertOrdersStatus($dataInsertOrderStatus);
        $this->response('SUCCESS');
    }
     /*
    * @method:GET
    */
    public function order_history_post()
    {
        header('Access-Control-Allow-Origin: *');
        $id_user = $this->post('iduser');
        $dataOrders = $this->orders_model->getOrdersUser($id_user);
        $this->response($dataOrders);
    }
   
}