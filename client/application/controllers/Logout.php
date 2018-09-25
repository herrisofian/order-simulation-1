<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {
	protected $data;

	public function __construct() {
        parent::__construct();

		$this->load->helper('url');
		$this->load->library('session');
    }
    
	public function index() {
		$newdata = array(
			'iduser' => "",
			'token'  => "",
			'logged_in' => FALSE
		);
		$this->session->set_userdata($newdata);
		redirect(base_url());
	}
}
