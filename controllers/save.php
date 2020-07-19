<?php

require_once ( "../env.php" );

if (isset($_POST["action"]))
{
	if($_POST["action"] === 'insert')
	{
		$form_data = array(
			'name' => $_POST['name'],
			'address' => $_POST['address'],
			'cpf' => $_POST['cpf'],
			'email' => $_POST['email'],
			'birth' => $_POST['birth'],			
		);

		$param = "?action=insert";		
		$url = $url_api.$param;

		$client = curl_init($url);
		curl_setopt($client, CURLOPT_POST, true);		
		curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);		
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);				
		curl_close($client);	

		$result = json_decode($response, true);	

		foreach($result as $keys => $values)
		{
			if($result[$keys]['success'] === '1')
			{
				echo 'insert';
			}
			else if($result[$keys]['success'] === '2') 
			{
				echo 'error2';
			}
			else
			{
				echo 'error';
			}
		}
		
	}
	
	
	if ($_POST["action"] === 'debtor_one')		
	{		
		
		$id = $_POST["id"];	
		$param = "?action=debtor_one&id=".$id."";		
		$url = $url_api.$param;
		$client = curl_init($url);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);		
		echo $response;	
		
	}	
	
	
	if ($_POST["action"] === 'update') 
	{
		
		$form_data = array(
			'name' => $_POST['name'],
			'address' => $_POST['address'],
			'cpf' => $_POST['cpf'],
			'email' => $_POST['email'],
			'birth' => $_POST['birth'],	
			'id' => $_POST['id_debtor'],		
		);

		$param = "?action=update";		
		$url = $url_api.$param;

		$client = curl_init($url);
		
		curl_setopt($client, CURLOPT_POST, true);
		curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		
		$response = curl_exec($client);		

		curl_close($client);
		$result = json_decode($response, true);
		foreach($result as $keys => $values){
			if($result[$keys]['success'] === '1')
			{
				echo 'update';
			}
			else
			{
				echo 'error';
			}		
		}		
	}


	if ($_POST["action"] === 'delete')		
	{
		$id = $_POST["id"];	
		$param = "?action=delete&id=".$id."";		
		$url = $url_api.$param;
		$client = curl_init($url);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);		
		echo $response;	
		
	}		
	
}

?>