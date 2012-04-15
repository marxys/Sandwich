<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pages extends CI_Controller{

	function __construct(){
		parent::__construct();
	}
	// Chargé par défaut.
	public function index(){
		if(sizeof($this->session->all_userdata()) != 7)
			$this->session->set_userdata(array(  'user_id' => 0, 'type'=>0));
		$this->load->view('modules/header'); 
		$this->load->view('acceuil');
	//	print_r($this->session->all_userdata());
		$this->load->view('modules/footer'); 
		//$this->load->view('welcome_message');
	}
	
	public function contact(){
		$this->load->view('contact');
		
	}
	
}