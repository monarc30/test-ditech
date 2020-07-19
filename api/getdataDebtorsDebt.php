<?php

	require_once( "../env.php" ) ;	

	$param = "?action=get_all_debts";
	$url = $url_api.$param;
	
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
				<td>'.$row['id_debtor'].'</td>
				<td>'.$row['value'].'</td>
				<td>'.$row['data_due'].'</td>				
				<td><button name="edit" class="btn btn-primary edit" type=button id="'.$row['id'].'">Edit</button></td>
				<td><button name="delete" class="btn btn-danger delete" type=button id="'.$row['id'].'">Delete</button></td>  
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