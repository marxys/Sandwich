<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Json {
	
	private $jsonencode;
	private $i;
	
    public function __construct(){
		
		// initialiser $jsonencode	
		$this->i = 0;
    }
	public function get(){
		return $this->jsonencode;
		
	}
	public function setError($err){
		$this->jsonencode['error'] = $err;
	}
	public function setMessage($message){
		$this->jsonencode['message'] = $message;
	}
	
	// $fun = (string) 
	// $args = array($string,..);
	public function call($fun,$args){
		$this->jsonencode['functions'][$i]['name'] = $fun; 
		$this->jsonencode['functions'][$i]['args'] = $args;
		$this->i++;
	}
}