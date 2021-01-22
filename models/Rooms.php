<?php

class Rooms {
	
	private $id;
	private $description;
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
	
	public function setDescription($description):void {
		$this->description = $description;		
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
	
}