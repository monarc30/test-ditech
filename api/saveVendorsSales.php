<?php

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);


require_once ( "../env.php" );

require_once ( "../controllers/saveController.php" ); 

if (isset($_POST["action"]))
{
	if($_POST["action"] === 'insert')
	{
		$form_data = array(
			
			'commission' => $_POST['commission'],
			'value' => $_POST['value'],
			'date' => $_POST['date'],
			'id_vendor' => $_POST['id_vendor']			
		);

		$param = "?action=insert_vendors_sales";				

		echo saveController::add( $form_data, $param, $url_api );
		
	}
	
	
	if ($_POST["action"] === 'vendor_one_vendors_sales')		
	{		
		
		$id = $_POST["id"];	
		$param = "?action=vendor_one_vendors_sales&id=".$id."";				
		
		echo saveController::getOne( $id, $param, $url_api );		
		
	}	
	
	
	if ($_POST["action"] === 'update') 
	{
		$form_data = array(
			'commission' => $_POST['commission'],
			'value' => $_POST['value'],
			'date' => $_POST['date'],
			'id_vendor' => $_POST['id_vendor'],			
			'id' => $_POST['id_vendor_sales'],		
		);

		$param = "?action=update_vendors_sales";				

		echo saveController::update( $form_data, $param, $url_api );
		
	}


	if ($_POST["action"] === 'delete')		
	{
		$id = $_POST["id"];	
		$param = "?action=delete_vendors&id=".$id."";		

		echo saveController::delete( $id, $param, $url_api );

		$client = curl_init($url);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);		
		echo $response;	
		
	}		
	
}

?>