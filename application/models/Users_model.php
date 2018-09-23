<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database(); 
    }
    public function getUserData(){
        $query = $this->db->get('driver'); 
        foreach($query->result() as $row):
                $data[] = $row;
        endforeach;
        return $data;
        
    }
    public function userDoLogin($username, $password){
        $this->db->select('id, token, orders');
        $this->db->where('username',$username);
        $this->db->where('password',$password);
        $query = $this->db->get('user');
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