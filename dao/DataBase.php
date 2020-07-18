<?php

class DataBase {
	
	private $host;
	private $user;
	private $pass;
	private $bd;
	private $link;
	private $con;

	public function __construct(){		
	
		$this->host = "localhost";
		$this->user = "root";
		$this->pass = "";
		$this->bd = "teste_api";					
		
	}	
	
	public function getConn() {
		return $this->con = mysqli_connect($this->host, $this->user, $this->pass, $this->bd);
	}
	
	public function set_link($link){
		$this->link = $link;
	}
	
	public function get_link(){
		return $this->link;
    }
	
	public function getEmailByUser($id=null,$email){
		$con = $this->getConn();	

		$and_id = null;
		
		if ($id!=null) 
			$and_id = " and id != $id ";
		
		$query = "select email from users where email='$email' $and_id ";
		$res = mysqli_query($con,$query);
		$rows = mysqli_num_rows($res);
		return $rows;
	}

	public function insertUser(){
		
		$con = $this->getConn();		
		
		if(isset($_POST["email"]))
		{				
			if ($this->getEmailByUser(null,$_POST["email"])==0) {

				$query = "insert into users (name,email,birth,password) values (
					'".$_POST['name']."',
					'".$_POST['email']."',
					'".$_POST['birth']."',
					'".$_POST['password']."')";

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
	
	public function alterUser(){
		
		$con = $this->getConn();
		
		if(isset($_POST["email"]))
		{				
			if ($this->getEmailByUser($_POST['id'],$_POST["email"])==0) {

				$query = "update users set 
				name='".$_POST['name']."',
				email='".$_POST['email']."',
				birth='".$_POST['birth']."',
				password='".$_POST['password']."' where id=".$_POST['id']."";
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
	
	public function deleteUser($id){
		
		$con = $this->getConn();	
		
		$query = "delete from users where id=$id";
		
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
	
	public function getUsers(){
		
		$con = $this->getConn();	
		
		$users = array();		
		$query = "select * from users";
		$res = mysqli_query($con,$query);		
		
		while($row=mysqli_fetch_assoc($res)) 
		{
			$users[] = $row;
		}		
		
		return $users;		
	}
	
	public function user_one($id) {
		
		$con = $this->getConn();			
		$query = "select * from users where id=$id";
		$res = mysqli_query($con,$query);		
		
		if (mysqli_query($con,$query)) {
			while($row=mysqli_fetch_assoc($res)) 
			{
				$users['created_date'] = $row['created_date'];
				$users['name'] = $row['name'];
				$users['email'] = $row['email'];
				$users['birth'] = $row['birth'];
				$users['password'] = $row['password'];
			}		
			
			return $users;		
		}
	}	
}