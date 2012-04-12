<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Json {
	
	private $jsonencode;
	private $i;
	
    public function __construct(){
		
		// initialiser $jsonencode	
		$this->i = 0;
		$this->json['error'] = 0;
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
	// 0 si aucuns args
	public function call($fun,$args){
		$this->jsonencode['functions'][$this->i]['name'] = $fun; 
		$this->jsonencode['functions'][$this->i]['args'] = $args;
		$this->i++;
	}
}