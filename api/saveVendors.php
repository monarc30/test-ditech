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
			'name' => $_POST['name'],
			'email' => $_POST['email'],
			'commission' => $_POST['commission'],			
		);

		$param = "?action=insert";

		echo saveController::add( $form_data, $param, $url_api );		
		
	}
	
	
	if ($_POST["action"] === 'vendor_one')		
	{		
		
		$id = $_POST["id"];	
		$param = "?action=vendor_one&id=".$id."";		
		
		echo saveController::getOne( $id, $param, $url_api );		
		
	}	
	
	
	if ($_POST["action"] === 'update') 
	{
		
		$form_data = array(
			'name' => $_POST['name'],
			'email' => $_POST['email'],
			'commission' => $_POST['commission'],	
			'id' => $_POST['id_vendor'],		
		);

		$param = "?action=update";				

		echo saveController::update( $form_data, $param, $url_api );
		
	}


	if ($_POST["action"] === 'delete')		
	{
		$id = $_POST["id"];	
		$param = "?action=delete&id=".$id."";		
		
		echo saveController::delete( $id, $param, $url_api );

		$client = curl_init($url);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);		
		echo $response;	
		
	}		
	
}

?>