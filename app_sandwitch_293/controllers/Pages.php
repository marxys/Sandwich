<?php
class Pages extends CI_Controller{

	function __construct(){
		parent::__construct();
		
	}
	// Chargé par défaut.
	public function index(){
		$this->load->view('acceuil');
	}
	
	public function contact(){
		$this->load->view('contact');
	}
}