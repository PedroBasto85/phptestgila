<?php
include 'loginmodel.php';

class apiLogin{
    
    function getAccess($loginUser, $loginPass){
        $login = new Login();
        $results = $login -> getCredentials($loginUser, $loginPass);
        if ($results -> rowCount()){
            $results -> setFetchMode(PDO::FETCH_ASSOC);  
            $data = $results -> fetchAll(); 
            return json_encode($data);
        }else{
            $response = array("messageID" => "401", "message" => "Datos Incorrectos");                      
            return json_encode($response);            
        }
    }
}