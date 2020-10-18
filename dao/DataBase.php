<?php

require_once ( "../models/Vendors.php" );
require_once ( "../models/VendorsSales.php" );
require_once ( "../models/Email.php" );

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
	
	public function getEmailByVendor(int $id=null, string $email):int{
		$con = $this->getConn();	

		$id = preg_replace('/\D/', '', $id);

		$and_id = null;
		
		if ($id!=null) 
			$and_id = " and id != $id ";
		
		$query = "select email from vendors where email='$email' $and_id ";

		$res = mysqli_query($con,$query);
		$rows = mysqli_num_rows($res);
		return $rows;
	}

	public function insertVendorSales( VendorsSales $VendorsSales ):array{
		
		$con = $this->getConn();
		
		if(isset($_POST["id_vendor"]))
		{				
			$query = "insert into vendors_sales (commission,value,date,id_vendor) values (
				
				'".$VendorsSales->getCommission()."',
				'".$VendorsSales->getValue()."',
				'".$VendorsSales->getData()."',				
				'".$VendorsSales->getIdVendor()."')";
			
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

	public function insertVendors( Vendors $Vendors ):array{
		
		$con = $this->getConn();		
		
		if ($this->getEmailByVendor(null,$Vendors->getEmail())==0) {

			$query = "insert into vendors (name,email,commission) values (
				'".$Vendors->getName()."',
				'".$Vendors->getEmail()."',
				'".$Vendors->getCommission()."')";

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

	public function alterVendorSales( VendorsSales $VendorsSales ):array{
		
		$con = $this->getConn();
		
		$DT = new DateTime();				

		$query = "update vendors_sales set 
		commission='".$VendorsSales->getCommission()."',
		value='".$VendorsSales->getValue()."',
		date='".$VendorsSales->getData()."',
		id_vendor='".$VendorsSales->getIdVendor()."',				
		updated_date='".$DT->format( "Y-m-d H:i:s" )."' where id=".$VendorsSales->getid()."";

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
	
	public function alterVendor( Vendors $Vendors ):array{		

		$con = $this->getConn();		

		if ($this->getEmailByVendor($Vendors->getid(),$Vendors->getEmail())==0) {

			$DT = new DateTime();				

			$query = "update vendors set 
			name='".$Vendors->getName()."',
			email='".$Vendors->getEmail()."',
			commission='".$Vendors->getCommission()."',
			updated_date='".$DT->format( "Y-m-d H:i:s" )."' where id=".$Vendors->getid()."";

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

	public function deleteVendorSales( VendorsSales $VendorsSales ):array{
		
		$con = $this->getConn();	
		
		$query = "delete from vendors_sales where id=".$VendorsSales->getid()."";

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
	
	
	public function deleteVendor( Vendors $Vendors, VendorsSales $VendorsSales ):array{
		
		$con = $this->getConn();			

		$query_vendor = "delete from vendors_sales where id_vendor=".$VendorsSales->getid();
		
		
		if (mysqli_query($con,$query_vendor)) {

			$query = "delete from vendors where id=".$Vendors->getid()."";

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
	}
	
	public function getVendors():array{
		
		$con = $this->getConn();	
		
		$Vendors = array();		
		$query = "select * from vendors";
		$res = mysqli_query($con,$query);		
		
		while($row=mysqli_fetch_assoc($res)) 
		{
			$Vendors[] = $row;
		}		
		
		return $Vendors;		
	}

	public function getVendorsSales(string $date = ""):array{

		$and_date = "";

		if ($date != null) {
			$and_date  = "and b.date = '$date 00:00:00'";
		}
		
		$con = $this->getConn();	
		
		$Vendors = array();	

		$query = "select a.name,a.email,b.id,b.commission,b.value,b.date,b.created_date 
					from vendors a 
					inner join vendors_sales b on a.id = b.id_vendor where 1=1 $and_date";

		$res = mysqli_query($con,$query);		
		
		while($row=mysqli_fetch_assoc($res)) 
		{
			$Vendors[] = $row;
		}		
		
		return $Vendors;		
	}

	public function vendor_one_vendors( VendorsSales $VendorsSales ):array {
		
		$con = $this->getConn();	
		
		$id = $VendorsSales->getid();

		$query = "select * from vendors_sales where id=$id";
		$res = mysqli_query($con,$query);
		
		$vendors = array();
		
		if (mysqli_query($con,$query)) {
			while($row=mysqli_fetch_assoc($res)) 
			{
				$date = $row['date'];				
				$date_time = new DateTime($date);
				$brazil_date = $date_time->format('Y-m-d');
				
				$vendors['created_date'] = $row['created_date'];
				$vendors['commission'] = $row['commission'];
				$vendors['value'] = $row['value'];
				$vendors['date'] = $brazil_date;
				$vendors['id_vendor'] = $row['id_vendor'];				
			}		
			
			return $vendors;		
		}
	}	
	
	public function Vendor_one( Vendors $Vendors ):array {

		$con = $this->getConn();
		
		$id = $Vendors->getid();
		
		$query = "select * from vendors where id=$id";

		$res = mysqli_query($con,$query);
		
		$vendors = array();
		
		if (mysqli_query($con,$query)) {
			while($row=mysqli_fetch_assoc($res)) 
			{
				$vendors['created_date'] = $row['created_date'];
				$vendors['name'] = $row['name'];
				$vendors['email'] = $row['email'];
				$vendors['commission'] = $row['commission'];				
			}		
			
			return $vendors;		
		}
	}


	public function sendEmail( Email $Email ):array{

		$email = $Email->getemail();
		$date = $Email->getDate();
		$subject = $Email->getSubject();
		$total = $Email->getTotal();
		$body = " Day: $date - Total Sales: $total ";
		
		if ($Email->send( $email, $subject, $body )) {
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
	
}