<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Products_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database(); 
    }
    public function getProductsData(){
        $query = $this->db->get('item'); 
        foreach($query->result() as $row):
                $data[] = $row;
        endforeach;
        return $data;
    }
}