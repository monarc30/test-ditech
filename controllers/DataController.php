<?php

class DataController {   

    public static function getDataGeneric( $param, $url_api, $type ) {
        
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
                
                if ( $type === 'debtors' ) {
                    $output .= '
                    <tr style="text-align:center">
                        <td>'.$row['name'].'</td>
                        <td>'.$row['cpf'].'</td>
                        <td>'.$row['email'].'</td>				
                        <td><button name="edit" class="btn btn-primary edit" type=button id="'.$row['id'].'">Edit</button></td>
                        <td><button name="delete" class="btn btn-danger delete" type=button id="'.$row['id'].'">Delete</button></td>  
                    </tr>
                    ';
                } elseif ( $type === 'id_debtor' ) {
                    
                    $output .= '<option value='.$row['id'].'>'.$row['name'].'</option>';

                } else {
                    
                    $output .= '
                    <tr style="text-align:center">
                        <td>'.$row['description'].'</td>
                        <td>'.$row['value'].'</td>
                        <td>'.$row['date_due'].'</td>				
                        <td><button name="edit" class="btn btn-primary edit" type=button id="'.$row['id'].'">Edit</button></td>
                        <td><button name="delete" class="btn btn-danger delete" type=button id="'.$row['id'].'">Delete</button></td>  
                    </tr>
                    ';
                }
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
        
        return $output;
    
    }    
}