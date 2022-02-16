<?php
include '../../config.php';

$pdo = new Conexion();

//Recuperar vehiculos
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $tipoCat = $_GET['_tipoCat'];

    if ($tipoCat == 'CATEGORIA') {
        $sqlTexto = 'SELECT cat_categoria.CategoriaID, cat_categoria.CategoriaDescripcion FROM cat_categoria WHERE cat_categoria.Vigente = 1';
        $sql = $pdo->prepare($sqlTexto);
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200");
        echo json_encode($sql->fetchAll());
        exit;
    }

    if ($tipoCat == 'MARCA') {
        $CategoriaID = $_GET['_categoriaID'];
        $sqlTexto = 'SELECT cat_marca.MarcaID, cat_marca.MarcaDescripcion FROM cat_marca  WHERE cat_marca.Vigente = 1 AND cat_marca.CategoriaID = :CategoriaID';
        $sql = $pdo->prepare($sqlTexto);
        $sql ->bindValue(':CategoriaID',$CategoriaID);
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200");
        echo json_encode($sql->fetchAll());
        exit;
    }

    if ($tipoCat == 'MODELO') {
        $MarcaID = $_GET['_marcaID'];
        $sqlTexto = 'SELECT cat_Modelo.ModeloID, cat_modelo.ModeloDescripcion FROM cat_modelo WHERE cat_modelo.Vigente = 1 AND cat_modelo.MarcaID = :MarcaID';
        $sql = $pdo->prepare($sqlTexto);
        $sql ->bindValue(':MarcaID', $MarcaID);
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200");
        echo json_encode($sql->fetchAll());
        exit;
    }


}