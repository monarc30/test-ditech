<?php

if (isset($_POST["action"]))
{
	if($_POST["action"] === 'insert')
	{
		$form_data = array(
			'name' => $_POST['name'],
			'email' => $_POST['email'],
			'birth' => $_POST['birth'],
			'password' => $_POST['password'],
		);

		$url = "http://localhost/test_receiv/api/getUsers.php?action=insert";
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
	
	
	if ($_POST["action"] === 'user_one')		
	{
		$id = $_POST["id"];
		$url = "http://localhost/test_receiv/api/getUsers.php?action=user_one&id=".$id."";
		$client = curl_init($url);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);		
		echo $response;	
		
	}	
	
	
	if ($_POST["action"] === 'update') 
	{
		
		$form_data = array(						
			'name' 				=> $_POST['name'],
			'email' 			=> $_POST['email'],
			'birth' 			=> $_POST['birth'],
			'password' 			=> $_POST['password'],
			'id'				=> $_POST['id_user'],
		);
		$url = "http://localhost/test_receiv/api/getUsers.php?action=update";
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
		$url = "http://localhost/test_receiv/api/getUsers.php?action=delete&id=".$id."";
		$client = curl_init($url);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);		
		echo $response;	
		
	}		
	
}

?>