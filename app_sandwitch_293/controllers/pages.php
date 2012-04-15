<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pages extends CI_Controller{

	function __construct(){
		parent::__construct();
	}
	// Chargé par défaut.
	public function index(){
		$this->load->view('modules/header'); 
		$this->load->view('acceuil');
		$this->load->view('modules/footer'); 
		//$this->load->view('welcome_message');
	}
	
	public function contact(){
		$this->load->view('contact');
		
	}
	
}