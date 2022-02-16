<?php
include '../../config.php';

interface IClasificacion{   
}

class Categoria implements IClasificacion{

    function select($opcional){
        $pdo = new Conexion();
        $sqlTexto = 'SELECT cat_categoria.CategoriaID, cat_categoria.CategoriaDescripcion FROM cat_categoria WHERE cat_categoria.Vigente = 1';
        $sql = $pdo->prepare($sqlTexto);
        $sql->execute();
        return $sql;
    }
}

class Marca implements IClasificacion {

    function select($CategoriaID){
        $pdo = new Conexion();
        $sqlTexto = 'SELECT cat_marca.MarcaID, cat_marca.MarcaDescripcion FROM cat_marca  WHERE cat_marca.Vigente = 1 AND cat_marca.CategoriaID = :CategoriaID';
        $sql = $pdo->prepare($sqlTexto);
        $sql ->bindValue(':CategoriaID',$CategoriaID);
        $sql->execute();
        return $sql;        
    }
}

class Modelo implements IClasificacion {
    
    function select($MarcaID){  
        $pdo = new Conexion();     
        $sqlTexto = 'SELECT cat_Modelo.ModeloID, cat_modelo.ModeloDescripcion FROM cat_modelo WHERE cat_modelo.Vigente = 1 AND cat_modelo.MarcaID = :MarcaID';
        $sql = $pdo->prepare($sqlTexto);
        $sql ->bindValue(':MarcaID', $MarcaID);
        $sql->execute();
        return $sql;        
    }

}