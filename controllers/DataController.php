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
                
                if ( $type === 'users' ) {
                    $output .= '
                    <tr style="text-align:center">
                        <td>'.$row['name'].'</td>                        
                        <td>'.$row['email'].'</td>
                        <td>'.$row['login'].'</td>                        
                        <td><button name="edit" class="btn btn-primary edit" type=button id="'.$row['id'].'">Edit</button></td>
                        <td><button name="delete" class="btn btn-danger delete" type=button id="'.$row['id'].'">Delete</button></td>  
                    </tr>
                    ';
                } elseif ( $type === 'id_room' ) {
                    
                    $output .= '<option value='.$row['id'].'>'.$row['description'].'</option>';

                } elseif ( $type === 'rooms' ) {
                    
                    $output .= '
                    <tr style="text-align:center">
                        <td>'.$row['description'].'</td>
                        <td><button name="edit" class="btn btn-primary edit" type=button id="'.$row['id'].'">Edit</button></td>
                        <td><button name="delete" class="btn btn-danger delete" type=button id="'.$row['id'].'">Delete</button></td>  
                    </tr>
                    ';
                } elseif ( $type === 'vendors_sales_form' ) {

                    $sales_total_date += $row['value'];
                    $date = $row['date'];                   
                    
                }

                elseif ( $type === 'rented_rooms' ) {
                    $output .= '
                    <tr style="text-align:center">                    
                        <td>'.$row['name'].'</td>
                        <td>'.$row['description'].'</td>
                        <td>'.$row['start_reserved'].'</td>
                        <td>'.$row['end_reserved'].'</td>                        
                    </tr>';                
                }
                
                elseif ( $type === 'rented_rooms_user' ) {
                    $output .= '
                    <tr style="text-align:center">                    
                        <td>'.$row['name'].'</td>
                        <td>'.$row['description'].'</td>
                        <td>'.$row['start_reserved'].'</td>
                        <td>'.$row['end_reserved'].'</td>
                        <td><button name="delete" class="btn btn-danger delete" type=button id="'.$row['id'].'">Cancelar</button></td>  
                    </tr>';                
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