<?php
include_once 'catmodel.php';

class apiCatalogo{
    function obtenerLista($tipoLista, $valorFiltro){

        if ($tipoLista == 'categoria'){
            $miLista = new Categoria();
        }
        else if ($tipoLista == 'marca'){
            $miLista = new Marca();
        } 
        else if ($tipoLista == 'modelo') {
            $miLista = new Modelo();
        }
     
        $results = $miLista->select($valorFiltro);
        if ($results -> rowCount()){
            $results -> setFetchMode(PDO::FETCH_ASSOC);  
            $data = $results -> fetchAll(); 
            return json_encode($data);
        }else{
            $response = array("messageID" => "-100", "message" => "Sin Información");                      
            return json_encode($response);            
        }      

    }
}