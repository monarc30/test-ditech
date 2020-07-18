<?php

	require_once( "../env.php" ) ;
	
	$url = "http://localhost/test_receiv/api/getUsers.php?action=get_all";	
	$client = curl_init($url);
	curl_setopt($client, CURLOPT_RETURNTRANSFER, true);	
	$response = curl_exec($client);
	$result = json_decode($response, true);

	$output = "";
	
	if (count($result) > 0)
	{
		foreach($result as $row)
		{
			$output .= '
			<tr style="text-align:center">
				<td>'.$row['created_date'].'</td>
				<td>'.$row['name'].'</td>
				<td>'.$row['address'].'</td>
				<td>'.$row['cpf'].'</td>
				<td>'.$row['email'].'</td>
				<td>'.$row['birth'].'</td>
				<td><button name="edit" class="btn-primary edit" type=button id="'.$row['id'].'">Edit</button></td>
				<td><button name="delete" class="btn-primary delete" type=button id="'.$row['id'].'">Delete</button></td>  
			</tr>
			';
		}	
	}
	else
	{
		$output .= '
			<tr>
				<td colspan=6>No data results.</td>
			</tr>
		';
	}
	
	echo $output;

?>