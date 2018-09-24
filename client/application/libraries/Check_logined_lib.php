<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Check_logined_lib {
    var $CI;

    public function __construct($params = array()) {
        $this->CI =& get_instance();
        $this->CI->load->library('session');
    }

    public function check_logined() {
    	$return = false;
    	$ses_iduser = $this->CI->session->userdata('iduser');
		$ses_token = $this->CI->session->userdata('token');
        $ses_username = $this->CI->session->userdata('username');
		$ses_loggedin = $this->CI->session->userdata('logged_in');
		if($ses_loggedin) {
            return TRUE;
		}
        else return FALSE;
    }
}