<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('check_logined_lib');
    }
	public function index()
	{
		$this->load->view('login');
	}
    public function login(){
        $returndata = '';
        $url = "http://localhost/order-simulation-1/server/index.php/api/user/login";
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $data = array(
            "username"=>$username,
            "password"=>$password
        );
        $datastring = json_encode($data);
		$curl = curl_init($url); 
		curl_setopt($curl , CURLOPT_URL, $url);
		curl_setopt($curl , CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        //curl_setopt($curl , CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
    	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
    	curl_setopt($curl, CURLOPT_POST, true); 
    	curl_setopt($curl, CURLOPT_POSTFIELDS, $datastring); 
    	$curl_response = json_decode(curl_exec($curl));
        curl_close($curl);
        if($curl_response != "FAIL"):
            $this->save_session($curl_response[0]->id, $curl_response[0]->token, $curl_response[0]->orders, $curl_response[0]->username);
            $returndata["message"] = "Success Login";
            $returndata["status"] = 1;
        else:
            $returndata["message"] = "Fail to Login";
            $returndata["status"] = 0;        
        endif;
        echo json_encode($returndata);    
        exit;
    }
    
    public function getOrders(){
        $logined_user = $this->check_logined_lib->check_logined();
		if($logined_user == TRUE):
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => "http://localhost/order-simulation-1/server/index.php/api/products/get",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
                ),
            ));
            $response_items = json_decode(curl_exec($curl),TRUE);
            $err = curl_error($curl);
            curl_close($curl);
            $data["orders"] = $this->getDataOrders($this->session->userdata('iduser'));
            $data["items"] = $response_items;
            $this->load->view('orders', $data);
        else:    
            redirect(base_url());
        endif;        
    }
    public function ordersPost(){
        $url = "http://localhost/order-simulation-1/server/index.php/api/orders/post";
        $id_item = $this->input->post('id');
        $address = $this->input->post('address');
        $id_user = $this->session->userdata('iduser');
        $data = array(
            "iditem"=>$id_item,
            "address"=>$address,
            "iduser"=>$id_user
        );
        $datastring = json_encode($data);
		$curl = curl_init($url); 
		curl_setopt($curl , CURLOPT_URL, $url);
		curl_setopt($curl , CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        //curl_setopt($curl , CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
    	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
    	curl_setopt($curl, CURLOPT_POST, true); 
    	curl_setopt($curl, CURLOPT_POSTFIELDS, $datastring); 
    	$curl_response = json_decode(curl_exec($curl));
        curl_close($curl);
        $returndata["message"] = "Success Orders";
        $returndata["status"] = 1;
        echo json_encode($returndata);   
        exit;
        
    }
    private function save_session($id_user, $token, $orders, $username) {
		$newdata = array(
			'iduser' => $id_user,
            'username'=>$username,
			'token'  => $token,
            'order'  => $orders,
			'logged_in' => TRUE
		);
		$this->session->set_userdata($newdata);
	}
    private function getDataOrders($id_user){
        $url = "http://localhost/order-simulation-1/server/index.php/api/ordershistory/post";
        $data = array(
            "iduser"=>$id_user
        );
        $datastring = json_encode($data);
		$curl = curl_init($url); 
		curl_setopt($curl , CURLOPT_URL, $url);
		curl_setopt($curl , CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        //curl_setopt($curl , CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
    	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
    	curl_setopt($curl, CURLOPT_POST, true); 
    	curl_setopt($curl, CURLOPT_POSTFIELDS, $datastring); 
    	$curl_response = json_decode(curl_exec($curl), TRUE);
        curl_close($curl);
        return $curl_response;        
    }
}
