<?php

require_once ( "../env.php" );

require_once ( "../controllers/saveController.php" ); 

if (isset($_POST["action"]))
{
	if($_POST["action"] === 'insert')
	{
		$form_data = array(
			
			'description' => $_POST['description'],
			'value' => $_POST['value'],
			'date_due' => $_POST['date_due'],
			'id_debtor' => $_POST['id_debtor']			
		);

		$param = "?action=insert_debtors_debt";				

		echo saveController::add( $form_data, $param, $url_api );
		
	}
	
	
	if ($_POST["action"] === 'debtor_one_debtors_debt')		
	{		
		
		$id = $_POST["id"];	
		$param = "?action=debtor_one_debtors_debt&id=".$id."";		
		
		echo saveController::getOne( $id, $param, $url_api );		
		
	}	
	
	
	if ($_POST["action"] === 'update') 
	{
		$form_data = array(
			'description' => $_POST['description'],
			'value' => $_POST['value'],
			'date_due' => $_POST['date_due'],
			'id_debtor' => $_POST['id_debtor'],			
			'id' => $_POST['id_debtor_debt'],		
		);

		$param = "?action=update_debtors_debt";				

		echo saveController::update( $form_data, $param, $url_api );
		
	}


	if ($_POST["action"] === 'delete')		
	{
		$id = $_POST["id"];	
		$param = "?action=delete_debtors&id=".$id."";		
		
		echo saveController::delete( $id, $param, $url_api );

		$client = curl_init($url);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);		
		echo $response;	
		
	}		
	
}

?>