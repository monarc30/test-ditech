<?php

class Users {
	
	private $id;
	private $name;
	private $email;
	private $login;
	private $password;
	private $created_date;	
	private $updated_date;	
	
	public function __contruct() 
	{
		
	}
	
	
	public function setid($id):void {		
		$this->id = $id;		
	}
	
	public function getid():int {		
		return $this->id;
	}
	
	public function setName($name):void {
		$this->name = $name;		
	}
	
	public function getName():string {
		return $this->name;		
	}	
	
	public function setEmail($email):void {
		$this->email = $email;
	}
	
	public function getEmail():string {
		return $this->email;		
	}

	public function setLogin($login):void {
		$this->login = $login;
	}
	
	public function getLogin():string {
		return $this->login;		
	}

	public function setPassword($password):void {
		$this->password = $password;
	}
	
	public function getPassword():string {
		return $this->password;		
	}
	
	public function setCreateddate($created_date):void {
		$this->birth = $created_date;
	}
	
	public function getCreateddate():DateTimeInterface {
		return $this->created_date;		
	}
	
	public function setUpdateddate($updated_date):void {
		$this->updated_date = $updated_date;
	}
	
	public function getUpdateddate():DateTimeInterface {
		return $this->updated_date;		
	}

}