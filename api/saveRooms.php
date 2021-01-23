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
			
			'description' => $_POST['description'],			
		);

		$param = "?action=insert_rooms";
		
		echo saveController::add( $form_data, $param, $url_api );
		
	}

	if($_POST["action"] === 'select_room')
	{
		
		$date = $_POST['date'];
		
		$start_date = $date;

		$end_date = date('Y-m-d H:i:s',strtotime('+1 hour',strtotime($date)));
		
		$form_data = array(
			
			'id_user' => $_POST['id_user'],			
			'id_room' => $_POST['id_room'],			
			'start_reserved' => $start_date,			
			'end_reserved' => $end_date,			
		);

		$param = "?action=insert_rented_rooms";
		
		echo saveController::add( $form_data, $param, $url_api );
		
	}
	
	
	if ($_POST["action"] === 'user_one_rooms')		
	{		
		
		$id = $_POST["id"];	
		$param = "?action=user_one_rooms&id=".$id."";				
		
		echo saveController::getOne( $id, $param, $url_api );		
		
	}	
	
	
	if ($_POST["action"] === 'update') 
	{
		$form_data = array(
			'description' => $_POST['description'],	
			'id' => $_POST['id_rooms'],		
		);

		$param = "?action=update_rooms";				

		echo saveController::update( $form_data, $param, $url_api );
		
	}


	if ($_POST["action"] === 'delete')		
	{
		$id = $_POST["id"];	
		$param = "?action=delete_users&id=".$id."";		

		echo saveController::delete( $id, $param, $url_api );

		$client = curl_init($url);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);		
		echo $response;	
		
	}		

	if ($_POST["action"] === 'delete_room')		
	{
		$id = $_POST["id"];	
		$param = "?action=delete_room&id=".$id."";				

		echo saveController::delete( $id, $param, $url_api );

		$client = curl_init($url);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);		
		echo $response;	
		
	}		
	
}

?>