<?php

class DataBase {
	
	private $host;
	private $user;
	private $pass;
	private $bd;		

	private $table;

	public function __construct( 	string $host, 
									string $user, 
									string $password, 
									string $dbname ) {
	
		$this->host = $host;
		$this->user = $user;
		$this->pass = $password;
		$this->bd = $dbname;		
		
	}	
	
	public function getConn() {
		return $this->con = mysqli_connect($this->host, $this->user, $this->pass, $this->bd);
	}
	
	public function getEmailByDebtor($id=null,$email){
		$con = $this->getConn();	

		$and_id = null;
		
		if ($id!=null) 
			$and_id = " and id != $id ";
		
		$query = "select email from debtors where email='$email' $and_id ";
		$res = mysqli_query($con,$query);
		$rows = mysqli_num_rows($res);
		return $rows;
	}

	public function getCPF_Exists($id=null,$cpf){
		$con = $this->getConn();	

		$and_id = null;
		
		if ($id!=null) 
			$and_id = " and id != $id ";
		
		$query = "select cpf from debtors where cpf='$cpf' $and_id ";
		$res = mysqli_query($con,$query);
		$rows = mysqli_num_rows($res);
		return $rows;
	}

	public function insertDebtor(){
		
		$con = $this->getConn();		
		
		if(isset($_POST["email"]))
		{				
			if ($this->getEmailByDebtor(null,$_POST["email"])==0) {

				$query = "insert into debtors (name,address,cpf,email,birth) values (
					'".$_POST['name']."',
					'".$_POST['address']."',
					'".$_POST['cpf']."',
					'".$_POST['email']."',
					'".$_POST['birth']."')";

				if (mysqli_query($con,$query)) {
					$data[] = array(
						'success' => '1'
					);
				}
				else {
					$data[] = array(
						'success' => '0'
					);
				}
			}else{
				$data[] = array(
					'success' => '2'
				);		
			}		
		}else{
			$data[] = array(
				'success' => '0'
			);				
		}
		
		return $data;
	}	
	
	public function alterDebtor(){
		
		$con = $this->getConn();
		
		if(isset($_POST["email"]))
		{				
			if ($this->getEmailByDebtor($_POST['id'],$_POST["email"])==0) {

				$DT = new DateTime();				

				$query = "update debtors set 
				name='".$_POST['name']."',
				address='".$_POST['address']."',
				cpf='".$_POST['cpf']."',
				email='".$_POST['email']."',
				birth='".$_POST['birth']."',
				updated_date='".$DT->format( "Y-m-d H:i:s" )."' where id=".$_POST['id']."";
				if (mysqli_query($con,$query)) {
					$data[] = array(
						'success' => '1'
					);
				}
				else {
					$data[] = array(
						'success' => '0'
					);
				}
			}else{
				$data[] = array(
					'success' => '2'
				);		
			}		
		}else{
			$data[] = array(
				'success' => '0'
			);				
		}
		
		return $data;
		
	}
	
	public function deleteDebtor($id){
		
		$con = $this->getConn();	
		
		$query = "delete from debtors where id=$id";
		
		if (mysqli_query($con,$query)) {
			$data[] = array(
				'success' => '1'
			);
		}
		else {
			$data[] = array(
				'success' => '0'
			);
		}
		return $data;
	}
	
	public function getDebtors(){
		
		$con = $this->getConn();	
		
		$debtors = array();		
		$query = "select * from debtors";
		$res = mysqli_query($con,$query);		
		
		while($row=mysqli_fetch_assoc($res)) 
		{
			$debtors[] = $row;
		}		
		
		return $debtors;		
	}

	public function getDebtorsDebt(){
		
		$con = $this->getConn();	
		
		$debtors = array();		
		$query = "select * from debtors_debt";
		$res = mysqli_query($con,$query);		
		
		while($row=mysqli_fetch_assoc($res)) 
		{
			$debtors[] = $row;
		}		
		
		return $debtors;		
	}
	
	public function debtor_one($id) {
		
		$con = $this->getConn();			
		$query = "select * from debtors where id=$id";
		$res = mysqli_query($con,$query);		
		
		if (mysqli_query($con,$query)) {
			while($row=mysqli_fetch_assoc($res)) 
			{
				$debtors['created_date'] = $row['created_date'];
				$debtors['name'] = $row['name'];
				$debtors['address'] = $row['address'];
				$debtors['cpf'] = $row['cpf'];
				$debtors['email'] = $row['email'];
				$debtors['birth'] = $row['birth'];				
			}		
			
			return $debtors;		
		}
	}	

	/**
	 * Get the value of table
	 */ 
	public function getTable():string
	{
		return $this->table;
	}

	/**
	 * @return  self
	 */ 
	public function setTable($table)
	{
		$this->table = $table;

		return $this;
	}	
}