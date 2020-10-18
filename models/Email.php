<?php

class Email {

    private $email;
	private $date;	
    private $total;
    private $subject;
	
    public function __contruct() 
	{
		
	}
	
	
	public function setemail($email):void {
		$this->email = $email;
	}
	
	public function getemail():string {
		return $this->email;
	}
	
	public function setTotal($total):void {
		$this->total = $total;		
	}
	
	public function getTotal():string {
		return $this->total;		
	}
	
	public function setDate($date):void {
		$this->date = $date;
	}
	
	public function getDate():string {
		return $this->date;		
    }
    
    public function setSubject($subject):void {
		$this->subject = $subject;
	}
	
	public function getSubject():string {
		return $this->subject;		
    }
    
    public function send( $email, $subject, $body ) {

        $headers  = "From: Test Tray <$email>\n";
		$headers .= "Return-Path: From: Test Tray  <$email>\n";
		$headers .= "MIME-Version: 1.0\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\n";

        mail ($email,$subject,$body,$headers, "-r$email");

    }

}