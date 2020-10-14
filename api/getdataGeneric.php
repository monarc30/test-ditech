<?php

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once ( "../env.php" );
require_once ( "../dao/DataBase.php" ) ;

require_once ( "../models/Vendors.php" );
require_once ( "../models/VendorsSales.php" );

$data = new DataBase( $host, $user, $password, $dbname );

$Vendors = new Vendors();
$VendorsSales = new VendorsSales();

if ($_GET['action'] === "get_all") {
	$res = $data->getVendors();
}

if ($_GET['action'] === "get_all_sales") {
	$res = $data->getVendorsSales();
}

if ($_GET['action'] === "insert") {
	
	$name = $Vendors->setName($_POST['name']);
	$email = $Vendors->setEmail($_POST['email']);
	$commission = $Vendors->setcommission($_POST['commission']);	

	$res = $data->insertVendors( $Vendors );
}

if ($_GET['action'] === "insert_vendors_sales") {	
	
	$commission = $VendorsSales->setcommission($_POST['commission']);
	$value = $VendorsSales->setValue($_POST['value']);
	$date = $VendorsSales->setData($_POST['date']);
	$id_vendor = $VendorsSales->setIdvendor($_POST['id_vendor']);	
	
	$res = $data->insertVendorSales( $VendorsSales );
}

if ($_GET['action'] === "vendor_one") {	
	
	$id_vendor = $Vendors->setid($_GET["id"]);	
	$res = $data->vendor_one( $Vendors );

}

if ($_GET['action'] === "vendor_one_vendors_sales") {

	$id_vendor_sale = $VendorsSales->setid($_GET["id"]);	
	$res = $data->vendor_one_vendors( $VendorsSales );
}

if ($_GET['action'] === "update") {

	$name = $Vendors->setName($_POST['name']);
	$email = $Vendors->setEmail($_POST['email']);
	$commission = $Vendors->setcommission($_POST['commission']);
	$id = $Vendors->setid($_POST['id']);	
	
	$res = $data->altervendor( $Vendors );
}

if ($_GET['action'] === "update_vendors_sales") {

	$commission = $VendorsSales->setCommission($_POST['commission']);
	$value = $VendorsSales->setValue($_POST['value']);
	$date = $VendorsSales->setData($_POST['date']);
	$id_vendor = $VendorsSales->setIdvendor($_POST['id_vendor']);
	$id = $VendorsSales->setid($_POST['id']);

	$res = $data->alterVendorSales( $VendorsSales );
}

if ($_GET['action'] === "delete") {
	
	$id_vendor = $Vendors->setid($_GET["id"]);
	$id_vendor_sales = $VendorsSales->setid($_GET["id"]);

	$res = $data->deleteVendor( $Vendors , $VendorsSales );
}

if ($_GET['action'] === "delete_vendors") {

	$id_vendor_sales = $VendorsSales->setid($_GET["id"]);	
	$res = $data->deleteVendorSales( $VendorsSales );
	
}

echo json_encode($res);

