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
        $this->load->model('drivers_model');
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
        $data_date =  date("Y-m-d H:i:s");
        $orderstatuses = array('Order Created at '.$data_date);
        
        $dataInsert = array(
            'address'=>$address,
            'id_item'=>$id_item,
            'id_user'=>$id_user,
            'orderstatuses'=> json_encode($orderstatuses)
        );
        
        $order_id = $this->orders_model->insertOrders($dataInsert);
        $dataInsertOrderStatus = array(
            'statusdatetime'=>$data_date,
            'id_order'=>$order_id,
            'id_status'=>1
        );
        $this->orders_model->insertOrdersStatus($dataInsertOrderStatus);
        $this->response('SUCCESS');
    }
    /*
    * @method:POST
    */
    public function order_history_post()
    {
        header('Access-Control-Allow-Origin: *');
        $id_user = $this->post('iduser');
        $dataOrders = $this->orders_model->getOrdersUser($id_user);
        $this->response($dataOrders);
    }
    /*
    * @method:POST
    */
    public function driver_take_orders_post()
    {
        header('Access-Control-Allow-Origin: *');
        $id_order = $this->post('idorder');
        $id_driver = $this->post('iddriver');
                
        // Updating orders table set id driver = parameter id driver
        $this->orders_model->updateDriverOrders($id_order,$id_driver);     
        
        // Fetch Data Orders.orderstatuses to insert new json status
        $dataOrdersStatuses = $this->orders_model->getOrderStatuses($id_order);
        $orderStatuses = json_decode($dataOrdersStatuses[0]->orderstatuses,TRUE);
        
        //Insert New orderstatuses into array
        array_push($orderStatuses, "Order Taken by Driver at ".date("Y-m-d H:i:s"));
        
        // Encode back to JSON to insert to DB
        $orderStatuses = json_encode($orderStatuses);
        $this->orders_model->updateOrderStatuses($id_order,$orderStatuses);
        
        //UPDATE TABLE OrderStatus
        $this->orders_model->updateOrderStatusTaken($id_order,2);
        
        $this->response('SUCCESS');
    }
    /*
    * @method:POST
    */
    public function orders_driver_post(){
        header('Access-Control-Allow-Origin: *');
        $id_driver = $this->post('iddriver');
        $dataOrders = $this->orders_model->getOrdersById($id_driver);
        $this->response($dataOrders);   
    }
    /*
    * @method:POST
    */
    public function driver_delivery_post()
    {
        header('Access-Control-Allow-Origin: *');
        $id_order = $this->post('idorder');
        $id_driver = $this->post('iddriver');
         
        // Fetch Data Orders.orderstatuses to insert new json status
        $dataOrdersStatuses = $this->orders_model->getOrderStatuses($id_order);
        $orderStatuses = json_decode($dataOrdersStatuses[0]->orderstatuses,TRUE);
        
        //Insert New orderstatuses into array
        array_push($orderStatuses, "Order on Delivery ".date("Y-m-d H:i:s"));
        
        // Encode back to JSON to insert to DB
        $orderStatuses = json_encode($orderStatuses);
        $this->orders_model->updateOrderStatuses($id_order,$orderStatuses);
        
        //UPDATE TABLE OrderStatus
        $this->orders_model->updateOrderStatusTaken($id_order,3);
        $this->response('SUCCESS');
    }
     /*
    * @method:POST
    */
    public function driver_delivered_post()
    {
        header('Access-Control-Allow-Origin: *');
        $id_order = $this->post('idorder');
        $id_driver = $this->post('iddriver');
         
        // Fetch Data Orders.orderstatuses to insert new json status
        $dataOrdersStatuses = $this->orders_model->getOrderStatuses($id_order);
        $orderStatuses = json_decode($dataOrdersStatuses[0]->orderstatuses,TRUE);
        
        //Insert New orderstatuses into array
        array_push($orderStatuses, "Order Delivered ".date("Y-m-d H:i:s"));
        
        // Encode back to JSON to insert to DB
        $orderStatuses = json_encode($orderStatuses);
        $this->orders_model->updateOrderStatuses($id_order,$orderStatuses);
        
        //UPDATE TABLE OrderStatus
        $this->orders_model->updateOrderStatusTaken($id_order,4);
        $this->response('SUCCESS');
    }
   
}