<?php

class saveController {

	public static function add( array $form_data, string $param, string $url_api ):string {

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
				return 'insert';
			}
			else if($result[$keys]['success'] === '2') 
			{
				return 'error2';
			}
			else
			{
				return 'error';
			}
		}		
		
	}

	public static function getOne( int $id, string $param, string $url_api ):string {

		$url = $url_api.$param;
		$client = curl_init($url);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);		
		return $response;	
		
	}
	
	public static function update( array $form_data, string $param, string $url_api ):string {		
			
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
				return 'update';
			}
			else
			{
				return 'error';
			}		
		}

	}

	public static function delete( int $id, string $param, string $url_api ):string {

		$url = $url_api.$param;
		$client = curl_init($url);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);				
		return $response;			
	}
}

?>