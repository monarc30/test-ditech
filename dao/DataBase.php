<?php

require_once ( "../models/Users.php" );
require_once ( "../models/Rooms.php" );
require_once ( "../models/RentedRooms.php" );

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
			);		}			
		
		
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
	
	
	public function insertRentedRooms( RentedRooms $RentedRooms ):array{
		
		$con = $this->getConn();			

		$id_user = $RentedRooms->getidUser();
		$id_room = $RentedRooms->getidRoom();
		$start = $RentedRooms->getstartReserved();
		$end = $RentedRooms->getendReserved();

		$start_date = date('Y-m-d H:i:s',strtotime('-1 hour',strtotime($start)));

		$end_date = date('Y-m-d H:i:s',strtotime('+1 hour',strtotime($start)));		

		$query_condition1 = "select id_user,start_reserved from rented_rooms where id_user = $id_user and start_reserved between '$start_date' and '$end_date'";
		$res_condition1 = mysqli_query($con,$query_condition1);
		$rows1 = mysqli_num_rows($res_condition1);

		$query_condition2 = "select id_room,start_reserved from rented_rooms where id_room = $id_room and start_reserved between '$start_date' and '$end_date'";
		$res_condition2 = mysqli_query($con,$query_condition2);
		$rows2 = mysqli_num_rows($res_condition2);

		if ($rows1 == 0 and $rows2 == 0) {

			$query = "insert into rented_rooms (id_user,id_room,start_reserved,end_reserved) values (
				'".$id_user."',
				'".$id_room."',
				'".$start."',
				'".$end."')";

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

	public function deleteRooms( Rooms $Rooms ):array{
		
		$con = $this->getConn();	
		
		$query = "delete from rooms where id=".$Rooms->getid()."";

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

	public function deleteUser( Users $Users ):array{
		
		$con = $this->getConn();			

		$query = "delete from users where id=".$Users->getid();		

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
	
	
	public function deleteRentedRooms( RentedRooms $RentedRooms ):array{
		
		$con = $this->getConn();			

		$query = "delete from rented_rooms where id=".$RentedRooms->getid();				

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
	
	public function getUsers():array{
		
		$con = $this->getConn();	
		
		$Users = array();		
		$query = "select * from users";
		$res = mysqli_query($con,$query);		
		
		while($row=mysqli_fetch_assoc($res)) 
		{
			$Users[] = $row;
		}		
		
		return $Users;		
	}

	public function getRooms():array{
		
		$con = $this->getConn();	
		
		$Rooms = array();		
		$query = "select * from rooms";
		$res = mysqli_query($con,$query);		
		
		while($row=mysqli_fetch_assoc($res)) 
		{
			$Rooms[] = $row;
		}		
		
		return $Rooms;		
	}

	public function getFreeRooms():array{

		$con = $this->getConn();	
		
		$Rooms = array();	

		$query = "select id,description from rooms";

		$res = mysqli_query($con,$query);		
		
		while($row=mysqli_fetch_assoc($res)) 
		{
			$Rooms[] = $row;
		}		
		
		return $Rooms;		
	}

	public function getRentedRooms( Users $Users ):array{

		$con = $this->getConn();	
		
		$Rooms = array();	

		$and_user = "";

		$user = $Users->getid();

		if ($user != 0) {
			$and_user = " and id_user = '$user' ";
		}

		$date = date("Y-m-d H:i:s");
		
		$and_date  = " and end_reserved >= '$date' ";			

		$query = "select a.id, b.name , c.description , a.start_reserved, a.end_reserved 
		
		FROM rented_rooms a 

		INNER JOIN users b on a.id_user = b.id

		INNER JOIN rooms c on a.id_room = c.id		
		
		WHERE 1=1 $and_date $and_user ";

		$res = mysqli_query($con,$query);		
		
		while($row=mysqli_fetch_assoc($res)) 
		{
			$Rooms[] = $row;
		}		
		
		return $Rooms;		
	}

	public function user_one_rooms( Rooms $Rooms ):array {
		
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

	public function getUser( Users $Users ):int {

		$con = $this->getConn();

		$query = "select * from users where login = '".$Users->getLogin()."' and password = '".$Users->getPassword()."'";
		
		$res = mysqli_query($con,$query);

		$rows = mysqli_num_rows($res);

		if ($rows>0) {
			
			$row = mysqli_fetch_assoc($res);
			$id_user = $row["id"];

			return $id_user;
		}
		else{
			return $rows;
		}

	}
	
}