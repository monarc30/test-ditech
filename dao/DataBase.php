<?php

require_once ( "../models/Debtors.php" );
require_once ( "../models/DebtorsDebt.php" );

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

	public function insertDebtorDebt( DebtorsDebt $DebtorsDebt ){
		
		$con = $this->getConn();
		
		if(isset($_POST["id_debtor"]))
		{				
			$query = "insert into debtors_debt (description,value,date_due,id_debtor) values (
				
				'".$DebtorsDebt->getDescription()."',
				'".$DebtorsDebt->getValue()."',
				'".$DebtorsDebt->getDatadue()."',				
				'".$DebtorsDebt->getIddebtor()."')";

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
				'success' => '0'
			);				
		}
		
		return $data;
	}

	public function insertDebtor( Debtors $debtors ){
		
		$con = $this->getConn();		
		
		if ($this->getEmailByDebtor(null,$debtors->getEmail())==0) {

			$query = "insert into debtors (name,address,cpf,email,birth) values (
				'".$debtors->getName()."',
				'".$debtors->getAddress()."',
				'".$debtors->getCpf()."',
				'".$debtors->getEmail()."',
				'".$debtors->getBirth()."')";

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
		
		
		return $data;
	}	

	public function alterDebtorDebt( DebtorsDebt $DebtorsDebt ){
		
		$con = $this->getConn();
		
		$DT = new DateTime();				

		$query = "update debtors_debt set 
		description='".$DebtorsDebt->getDescription()."',
		value='".$DebtorsDebt->getValue()."',
		date_due='".$DebtorsDebt->getDatadue()."',
		id_debtor='".$DebtorsDebt->getIddebtor()."',				
		updated_date='".$DT->format( "Y-m-d H:i:s" )."' where id=".$DebtorsDebt->getid()."";
		
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
	
	public function alterDebtor( Debtors $debtors ){
		
		$con = $this->getConn();		
		
		if ($this->getEmailByDebtor($_POST['id'],$debtors->getEmail())==0) {

			$DT = new DateTime();				

			$query = "update debtors set 
			name='".$debtors->getName()."',
			address='".$debtors->getAddress()."',
			cpf='".$debtors->getCpf()."',
			email='".$debtors->getEmail()."',
			birth='".$debtors->getBirth()."',
			updated_date='".$DT->format( "Y-m-d H:i:s" )."' where id=".$debtors->getid()."";

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
	
		
		return $data;
		
	}

	public function deleteDebtorDebt( DebtorsDebt $DebtorsDebt ){
		
		$con = $this->getConn();	
		
		$query = "delete from debtors_debt where id=".$DebtorsDebt->getid()."";
		
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
	}
	
	
	public function deleteDebtor( Debtors $debtors ){
		
		$con = $this->getConn();	
		
		$query = "delete from debtors where id=".$debtors->getid()."";
		
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

	public function debtor_one_debtors( DebtorsDebt $DebtorsDebt ) {
		
		$con = $this->getConn();	
		
		$id = $DebtorsDebt->getid();

		$query = "select * from debtors_debt where id=$id";
		$res = mysqli_query($con,$query);		
		
		if (mysqli_query($con,$query)) {
			while($row=mysqli_fetch_assoc($res)) 
			{
				$debtors['created_date'] = $row['created_date'];
				$debtors['description'] = $row['description'];
				$debtors['value'] = $row['value'];
				$debtors['date_due'] = $row['date_due'];
				$debtors['id_debtor'] = $row['id_debtor'];				
			}		
			
			return $debtors;		
		}
	}	
	
	public function debtor_one( Debtors $debtors ) {

		$con = $this->getConn();
		
		$id = $debtors->getid();
		
		$query = "select * from debtors where id=$id";

		$res = mysqli_query($con,$query);		
		
		if (mysqli_query($con,$query)) {
			while($row=mysqli_fetch_assoc($res)) 
			{
				$Debtors['created_date'] = $row['created_date'];
				$Debtors['name'] = $row['name'];
				$Debtors['address'] = $row['address'];
				$Debtors['cpf'] = $row['cpf'];
				$Debtors['email'] = $row['email'];
				$Debtors['birth'] = $row['birth'];				
			}		
			
			return $Debtors;		
		}
	}		
}