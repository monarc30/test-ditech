<?php

class Debtors {
	
	private $id;
	private $name;
	private $address;
	private $cpf;
	private $email;
	private $birth;	
	private $created_date;	
	private $updated_date;	
	
	public function __contruct(	int $id, string $name, string $address, 
								string $cpf, string $email, DateTimeInterface $birth, 
								DateTimeInterface $created_date, DateTimeInterface $updated_date ) 
	{
		$this->id = $id;
		$this->name = $name;
		$this->address = $address;
		$this->cpf = $cpf;
		$this->email = $email;
		$this->birth = $birth;
		$this->created_date = $created_date;
		$this->updated_date = $updated_date;
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
	
	public function setAddress($address):void {
		$this->name = $address;		
	}
	
	public function getAddress():string {
		return $this->address;		
	}
	
	public function setCpf($cpf):void {
		$this->name = $cpf;		
	}
	
	public function getCpf():string {
		return $this->cpf;		
	}
	
	public function setEmail($email):void {
		$this->email = $email;
	}
	
	public function getEmail():string {
		return $this->email;		
	}
	
	public function setBirth($birth):void {
		$this->birth = $birth;
	}
	
	public function getBirth():DateTimeInterface {
		return $this->birth;		
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