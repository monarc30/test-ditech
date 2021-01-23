<?php

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once ( "../env.php" );
require_once ( "../dao/DataBase.php" ) ;

require_once ( "../models/Users.php" );
require_once ( "../models/Rooms.php" );
require_once ( "../models/Email.php" );

$data = new DataBase( $host, $user, $password, $dbname );

$Users = new Users();
$Rooms = new Rooms();
$Email = new Email();

if ($_GET['action'] === "get_all") {
	$res = $data->getUsers();
}

if ($_GET['action'] === "get_all_rooms") {
	$res = $data->getRooms();
}

if ($_GET['action'] === "insert") {
	
	$name = $Users->setName($_POST['name']);
	$email = $Users->setEmail($_POST['email']);	
	$login = $Users->setLogin($_POST['login']);	
	$password = $Users->setPassword($_POST['password']);	

	$res = $data->insertUsers( $Users );
}

if ($_GET['action'] === "insert_rooms") {	

	$description = $Rooms->setdescription($_POST['description']);
	$res = $data->insertRooms( $Rooms );
}

if ($_GET['action'] === "user_one") {	
	
	$id_user = $Users->setid($_GET["id"]);	
	$res = $data->user_one( $Users );

}

if ($_GET['action'] === "user_one_rooms") {

	$id_room = $Rooms->setid($_GET["id"]);	
	$res = $data->user_one_rooms( $Rooms );
}

if ($_GET['action'] === "update") {	

	$name = $Users->setName($_POST['name']);
	$email = $Users->setEmail($_POST['email']);	
	$login = $Users->setLogin($_POST['login']);	
	$password = $Users->setPassword($_POST['password']);	
	$id = $Users->setid($_POST['id']);	
	$res = $data->alteruser( $Users );
}

if ($_GET['action'] === "update_rooms") {

	$commission = $VendorsSales->setCommission($_POST['commission']);
	$value = $VendorsSales->setValue($_POST['value']);
	$date = $VendorsSales->setData($_POST['date']);
	$id_vendor = $VendorsSales->setIdvendor($_POST['id_vendor']);
	$id = $VendorsSales->setid($_POST['id']);

	$res = $data->alterVendorSales( $VendorsSales );
}

if ($_GET['action'] === "delete") {
	
	$id_user = $Users->setid($_GET["id"]);
	$id_rooms = $Rooms->setid($_GET["id"]);

	$res = $data->deleteUser( $Users , $Rooms );
}

if ($_GET['action'] === "delete_users") {

	$id_rooms = $Rooms->setid($_GET["id"]);	
	$res = $data->deleteRooms( $Rooms );
	
}

if ($_GET['action'] === "get_user_by_date") {

	$date = $_GET["date"];
	$res = $data->getRooms( $date );

}

if ($_GET['action'] === "sendEMail") {

	$email = $Email->setEmail($_POST['email']);
	$date = $Email->setDate($_POST['date']);
	$total = $Email->setTotal($_POST['total']);	
	$subject = $Email->setSubject("Daily Sales - Test Tray");	
	$res = $data->sendEmail( $Email );
}

echo json_encode($res);

