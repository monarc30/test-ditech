<?php

class RentedRooms {
	
	private $id;
	private $id_user;
	private $id_room;
	private $start_reserved;
	private $end_reserved;
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
	
	public function setidUser($id_user):void {
		$this->id_user = $id_user;		
	}
	
	public function getidUser():int {
		return $this->id_user;		
	}	
	
	public function setidRoom($id_room):void {
		$this->id_room = $id_room;
	}
	
	public function getidRoom():int {
		return $this->id_room;		
	}

	public function setstartReserved($start_reserved):void {
		$this->start_reserved = $start_reserved;
	}
	
	public function getstartReserved():int {
		return $this->start_reserved;		
	}

	public function setendReserved($end_reserved):void {
		$this->end_reserved = $end_reserved;
	}
	
	public function getendReserved():string {
		return $this->end_reserved;		
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