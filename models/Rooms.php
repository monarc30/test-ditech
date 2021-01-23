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

	public function getDescription():string {
		return $this->description;		
	}
	
	
}