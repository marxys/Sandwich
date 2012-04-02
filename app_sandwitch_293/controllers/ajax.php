<?php 

class Ajax extends CI_Controller{
	
	function __construct(){
		parent::__construct();
	}
	
	public function ajax_request(){
		if(isset($_POST['p'] && is_string($_POST['p'])){
			switch($_POST['p']){
				case 'connexion' :   $this->load->model('connexion');   ;break; // + Appel de la fonction réalisant la connexion.
			}
		}
	}
}