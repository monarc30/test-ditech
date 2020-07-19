<?php

class DebtorsDebt {
	
	private $id;
	private $description;
	private $value;
	private $date_due;
	private $created_date;	
    private $updated_date;	
    private $id_debtor;	
    

    public function __contruct(	int $id, string $description, float $value, 
                                DateTimeInterface $date_due, DateTimeInterface $created_date, 
                                DateTimeInterface $updated_date, int $id_debtor) 
	{
		$this->id = $id;
		$this->description = $description;
        $this->value = $value;
        $this->date_due = $date_due;
		$this->created_date = $created_date;
        $this->updated_date = $updated_date;
        $this->id_debtor = $id_debtor;
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
	
	public function setValue($value):void {
		$this->value = $value;		
	}
	
	public function getValue():string {
		return $this->value;		
	}
	
	public function setDatadue($date_due):void {
		$this->date_due = $date_due;
	}
	
	public function getDatadue():DateTimeInterface {
		return $this->date_due;		
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
	
	public function setIddebtor($id_debtor):void {
		$this->id_debtor = $id_debtor;
	}
	
	public function getIddebtor():DateTimeInterface {
		return $this->id_debtor;		
	}

}