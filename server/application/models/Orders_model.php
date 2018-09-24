<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Orders_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database(); 
    }
    public function insertOrders($data){
        $this->db->insert('orders', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
        
    }
    public function insertOrdersStatus($data){
        $this->db->insert('orderstatus', $data);        
    }
    public function getOrdersUser($id){
        $this->db->select('item.name, orderstatus.statusdatetime, driver.username');
        $this->db->from('orders orders');
        $this->db->join('driver driver','driver.id = orders.id_driver','Left');
        $this->db->join('orderstatus orderstatus','orderstatus.id_order = orders.id');
        $this->db->join('item item','item.id = orders.id_item');
        $this->db->where('orders.id_user',$id);
        $query = $this->db->get();
        if($query->num_rows() > 0):
           foreach($query->result() as $row):
                    $data[] = $row;
            endforeach;
            return $data;
        else:
            return false;
        endif;
    }
}