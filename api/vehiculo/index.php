<?php
include 'vehiculoapi.php';
session_name("sesionUsuario");
session_start();

$autosmotos = new apiVehiculo();

//Recuperar vehiculos
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    try {        
        $registros = $autosmotos->obtenerLista();
        header('content-type: application/json; charset=utf-8');
        header("HTTP/1.1 200");
        echo $registros;
        exit;
    } catch (Exception $e) {
        header("HTTP/1.1 400");
        echo $e->getMessage();
    }
}

//Insertar vehiculos
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $JSONData = file_get_contents("php://input");
        $dataObject = json_decode($JSONData);

        $_CategoriaID = $dataObject->_CategoriaID;
        $_MarcaID = $dataObject->_MarcaID;
        $_ModeloID = $dataObject->_ModeloID;
        $_Anio = $dataObject->_Anio;
        $_NoLlantas = $dataObject->_NoLlantas;
        $_PotenciaMotor = $dataObject->_PotenciaMotor;
        $_Usuario = $_SESSION['UsuarioID'];       

        $insertado = $autosmotos -> insertarNuevo($_CategoriaID,$_MarcaID,$_ModeloID,$_Anio,$_NoLlantas,$_PotenciaMotor,$_Usuario);
        
        if ($insertado) {
            header("HTTP/1.1 200");
            header('content-type: application/json; charset=utf-8');
            echo 1;
            exit;
        }else{
            header("HTTP/1.1 200");
            header('content-type: application/json; charset=utf-8');
            echo 0;
            exit;  
        }
    } catch (Exception $e) {
        header("HTTP/1.1 400");
        echo json_encode($e->getMessage());
        exit;
    }
}
