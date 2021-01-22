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
                } elseif ( $type === 'id_user' ) {
                    
                    $output .= '<option value='.$row['id'].'>'.$row['name'].'</option>';

                } elseif ( $type === 'rooms' ) {
                    
                    $output .= '
                    <tr style="text-align:center">
                        <td>'.$row['name'].'</td>                        
                        <td>'.$row['value'].'</td>
                        <td>'.$row['commission'].'</td>
                        <td>'.$row['date'].'</td>
                        <td><button name="edit" class="btn btn-primary edit" type=button id="'.$row['id'].'">Edit</button></td>
                        <td><button name="delete" class="btn btn-danger delete" type=button id="'.$row['id'].'">Delete</button></td>  
                    </tr>
                    ';
                } elseif ( $type === 'vendors_sales_form' ) {

                    $sales_total_date += $row['value'];
                    $date = $row['date'];                   
                    
                }
            }

            if ( $type === 'vendors_sales_form' ) {
                $output .= '
                <tr style="text-align:center">                    
                    <td>'.$date.'</td>                        
                    <td>'.number_format($sales_total_date, 2, '.', '').'</td>    
                </tr>';

                $output .= "
                <tr style=\"text-align:center\">
                    <td colspan=2>
                        <input id=\"save\" class=\"btn btn-primary\" type=\"button\" onclick=\"SendEmail('$date','$sales_total_date')\" value=\"Send Report E-mail\"></input>
                    </td>
                </tr>
                ";
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