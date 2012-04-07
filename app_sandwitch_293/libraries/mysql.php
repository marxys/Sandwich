<?php

$GLOBALS["mysql_occurence"] = 0;
 

class Mysql {
	
	
        var $mysql_handle;
        var $mysql_host;
        var $mysql_user;
        var $mysql_pass;
        var $mysql_db;
        var $occurence;
        var $error;
		var $bdd;
		var $reponse;
		var $request;
		var $output;
		
        function __construct(){
				
				//start configuration
                $this->occurence        = &$GLOBALS["mysql_occurence"];
                $this->mysql_host       = "mysql51-35.pro";
                $this->mysql_user       = "tumulteswd";
                $this->mysql_pass       = "sitebdd13";
                $this->mysql_db         = "tumulteswd";
				//end configuration
                $this->occurence++;
				if($this->connect()) ;
        }
		 //old version of query for retrocompatibility
		 function query($query){
             try {
			    $this->reponse = $this->bdd->query($query);
				return $this->reponse;
			 }
			 catch(Exception $e) {
					$this->error = $e->getMessage();
					return false;
				}
        }
		function quote($value) {
			return $this->bdd->quote($value);
		}
		function insert($name,$query,$array) {
			try {
				if(empty($this->request[$name])) // si la requète n'a pas été préparée, on la prépare
						$this->request[$name] = $this->bdd->prepare($query);
				$this->bdd->beginTransaction();
				$this->request[$name]->execute($array);
				$return = $this->bdd->lastInsertId();
				if($this->bdd->commit()) return $return;
				else return false;
			} 
			catch(Exception $e) { 
        		$this->bdd->rollback(); 
       			$this->error = "Error!: " . $e->getMessage() . "\n"; 
    		} 
	
		}
		//execute une requête préparée et la stock dans le tableau 
        function qexec($name, $query, $array){
			
             try {
				if(empty($this->request[$name])) // si la requète n'a pas été préparée, on la prépare
						$this->request[$name] = $this->bdd->prepare($query);
				$this->request[$name]->execute($array);
				return $this->request[$name];
			 }
			 catch(Exception $e) {
					$this->error = $e->getMessage();
					return false;
				}
        }
		
		//execute une requête préparée existante
		function execute($name, $array){
			
             try {
				 $this->request[$name]->execute($array);
				 return $this->request[$name];
			 }
			 catch(Exception $e) {
					$this->error = $e->getMessage();
					return false;
				}
        }
		
		//prépare une requête sans l'executer
		function prepare($name, $query){
			
             try {
			    $this->request[$name] = $this->bdd->prepare($query);
			 }
			 catch(Exception $e) {
					$this->error = $e->getMessage();
					return false;
				}
        }
		
        function connect(){
			try {
				$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                $this->bdd = new PDO("mysql:host=$this->mysql_host;dbname=$this->mysql_db", $this->mysql_user, $this->mysql_pass, $pdo_options);
				return true;
			}
			catch (Exception $e) {
				$this->error = $e->getMessage();
				return false;
			}
        }
        function __destruct(){
              if(!empty($this->request)){
				foreach($this->request as $entree) {
					
					$entree->closeCursor(); 
				
				}
			  }
				 if(!empty($this->reponse)) $this->reponse->closeCursor(); 
        }
}
