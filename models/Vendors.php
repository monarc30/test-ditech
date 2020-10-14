<?php

class Vendors {
	
	private $id;
	private $name;
	private $address;
	private $cpf;
	private $email;
	private $birth;	
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
	
	public function setCommission($commission):void {
		$this->commission = $commission;
	}
	
	public function getCommission():string {
		return $this->commission;		
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