<?php
include 'vehiculomodel.php';

class apiVehiculo{
    function obtenerLista(){
        $vehiculos = new vehiculo();
        $results = $vehiculos -> select();
        if ($results -> rowCount()){
            $results -> setFetchMode(PDO::FETCH_ASSOC);  
            $data = $results -> fetchAll(); 
            return json_encode($data);
        }else{
            $response = array("CategoriaID" => "-100", "message" => "Sin Información");                      
            return json_encode($response);            
        }

    }

    function insertarNuevo($CategoriaID,$MarcaID, $ModeloID, $Anio, $NoLlantas, $PotenciaMotor, $Usuario){
        $vehiculos = new vehiculo();
        $idInsert = $vehiculos->insert($CategoriaID,$MarcaID,$ModeloID, $Anio,$NoLlantas,$PotenciaMotor,$Usuario);
        if ($idInsert){
            return true;
        }else{
            return false;
        }        
    }
}