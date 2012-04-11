<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Json {
	
	private $jsonencode;
	
    public function __construct(){
		
		// initialiser $jsonencode	
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
	public function setFunctions($array){
	}
}