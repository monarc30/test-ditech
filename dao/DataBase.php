<?php

require_once ( "../models/Users.php" );
require_once ( "../models/Rooms.php" );
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
	
	public function getEmailByUser(int $id=null, string $email):int{
		
		$con = $this->getConn();	

		$id = preg_replace('/\D/', '', $id);

		$and_id = null;
		
		if ($id!=null) 
			$and_id = " and id != $id ";
		
		$query = "select email from users where email='$email' $and_id ";

		$res = mysqli_query($con,$query);
		$rows = mysqli_num_rows($res);
		return $rows;
	}

	public function insertRooms( Rooms $Rooms ):array{
		
		$con = $this->getConn();
		
		if(isset($_POST["id_vendor"]))
		{				
			$query = "insert into rooms (description) values (
				
				'".$Rooms->getDescription()."')";
			
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

	public function insertUsers( Users $Users ):array{
		
		$con = $this->getConn();		
		
		if ($this->getEmailByUser(null,$Users->getEmail())==0) {

			$query = "insert into users (name,email,login,password) values (
				'".$Users->getName()."',
				'".$Users->getEmail()."',
				'".$Users->getLogin()."',
				'".$Users->getPassword()."')";

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

	public function alterRooms( Rooms $Rooms ):array{
		
		$con = $this->getConn();
		
		$DT = new DateTime();				

		$query = "update rooms set 
		description='".$Rooms->getDescription()."',		
		updated_date='".$DT->format( "Y-m-d H:i:s" )."' where id=".$Rooms->getid()."";

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
	
	public function alterUser( Users $Users ):array{		

		$con = $this->getConn();		

		if ($this->getEmailByUser($Users->getid(),$Users->getEmail())==0) {

			$DT = new DateTime();				

			$query = "update users set 
			name='".$Users->getName()."',
			email='".$Users->getEmail()."',
			login='".$Users->getLogin()."',
			password='".$Users->getPassword()."',
			updated_date='".$DT->format( "Y-m-d H:i:s" )."' where id=".$Users->getid()."";

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

	public function deleteVendorSales( Rooms $Rooms ):array{
		
		$con = $this->getConn();	
		
		$query = "delete from vendors_sales where id=".$Rooms->getid()."";

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
	
	
	public function deleteUser( Users $Users, RentedRooms $RentedRooms ):array{
		
		$con = $this->getConn();			

		$query_user = "delete from rented_rooms where id_user=".$RentedRooms->getid();		
		
		if (mysqli_query($con,$query_user)) {

			$query = "delete from users where id=".$Users->getid()."";

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
	
	public function getUsers():array{
		
		$con = $this->getConn();	
		
		$Users = array();		
		$query = "select * from users";
		$res = mysqli_query($con,$query);		
		
		while($row=mysqli_fetch_assoc($res)) 
		{
			$Vendors[] = $row;
		}		
		
		return $Vendors;		
	}

	public function getRentedRooms(string $date = ""):array{

		$and_date = "";

		if ($date != null) {
			$and_date  = "and b.date = '$date 00:00:00'";
		}
		
		$con = $this->getConn();	
		
		$Users = array();	

		$query = "select a.name,a.email,b.id,b.description,b.value,b.date,b.created_date 
					from users a 
					inner join rooms b on a.id = b.id_vendor where 1=1 $and_date";

		$res = mysqli_query($con,$query);		
		
		while($row=mysqli_fetch_assoc($res)) 
		{
			$Users[] = $row;
		}		
		
		return $Users;		
	}

	public function user_one_users( Rooms $Rooms ):array {
		
		$con = $this->getConn();	
		
		$id = $Rooms->getid();

		$query = "select * from rooms where id=$id";
		$res = mysqli_query($con,$query);
		
		$users = array();
		
		if (mysqli_query($con,$query)) {
			while($row=mysqli_fetch_assoc($res)) 
			{
				//$date = $row['date'];				
				//$date_time = new DateTime($date);
				//$brazil_date = $date_time->format('Y-m-d');
				
				$users['created_date'] = $row['created_date'];
				$users['description'] = $row['description'];
				
			}		
			
			return $users;		
		}
	}	
	
	public function User_one( Users $Users ):array {

		$con = $this->getConn();
		
		$id = $Users->getid();
		
		$query = "select * from users where id=$id";

		$res = mysqli_query($con,$query);
		
		$users = array();
		
		if (mysqli_query($con,$query)) {
			while($row=mysqli_fetch_assoc($res)) 
			{
				$users['created_date'] = $row['created_date'];
				$users['name'] = $row['name'];
				$users['email'] = $row['email'];
				$users['login'] = $row['login'];
				$users['password'] = $row['password'];
				
			}		
			
			return $users;		
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