<?php
include 'catapi.php';

//Recuperar vehiculos
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    
    $tipoCat = strtolower($_GET['_tipoCat']);
    if (isset($_GET['_filtroID'])){
        $filtroLista = $_GET['_filtroID'];
    }else{
        $filtroLista = 0;
    }

    $listados = new apiCatalogo();    
    $registros = $listados -> obtenerLista($tipoCat,$filtroLista);
    header("HTTP/1.1 200");
    echo $registros;
}