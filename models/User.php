<?php

class User {
	
	private $id;
	private $name;
	private $email;
	private $birth;
	private $drink_ml;
	
	public function __contruct($id = null) {	
		
		
	}
	
	
	public function setid($id){
		$this->id = $id;
	}
	public function getid(){
		return $this->id;
	}
	
	
	public function setName($name){
		$this->name = $name;		
	}
	public function getName(){
		return $this->name;		
	}
	
	
	public function setEmail($email){
		$this->email = $email;
	}
	public function getEmail(){
		return $this->email;		
	}


	public function setBirth($birth){
		$this->birth = $birth;
	}
	public function getBirth(){
		return $this->birth;		
	}
	
	
	public function setDrink($drink_ml){
		$this->drink_ml = $drink_ml;		
	}
	public function getDrink(){
		return $this->drink_ml;		
	}
	

}