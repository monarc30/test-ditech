<?php

class VendorsSales {
	
	private $id;
	private $commission;
	private $value;
	private $date;
	private $created_date;	
    private $updated_date;	
    private $id_vendor;	
    

    public function __contruct() 
	{
		
	}
	
	
	public function setid($id):void {
		$this->id = $id;
	}
	
	public function getid():int {
		return $this->id;
	}
	
	public function setCommission($commission):void {
		$this->commission = $commission;		
	}
	
	public function getCommission():string {
		return $this->commission;		
	}	
	
	public function setValue($value):void {
		$this->value = $value;		
	}
	
	public function getValue():string {
		return $this->value;		
	}
	
	public function setData($date):void {
		$this->date = $date;
	}
	
	public function getData():string {
		return $this->date;		
	}
	
	public function setCreateddate($created_date):void {
		$this->created_date = $created_date;
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
	
	public function setIdvendor($id_vendor):void {
		$this->id_vendor = $id_vendor;
	}
	
	public function getIdvendor():int {
		return $this->id_vendor;		
	}
	
}