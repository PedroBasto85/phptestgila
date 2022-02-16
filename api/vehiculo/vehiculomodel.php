<?php

include '../../config.php';

class vehiculo{  
    
    function select(){
        $pdo = new Conexion();
        $sqlTexto =  'SELECT  categoria.CategoriaDescripcion AS Categoria, marca.MarcaDescripcion, modelo.ModeloDescripcion, vehiculo.Anio, ' .
        ' CONCAT(vehiculo.PotenciaMotor, \'HP\') AS PotenciaMotor ' .
        ' FROM ' .
        ' tbl_vehiculo vehiculo ' .
        ' INNER JOIN cat_categoria categoria ' .
        ' ON vehiculo.CategoriaID = categoria.CategoriaID ' .
        ' INNER JOIN cat_marca marca ' .
        ' ON vehiculo.MarcaID = marca.MarcaID ' .
        ' INNER JOIN cat_modelo modelo ' .
        ' ON vehiculo.ModeloID = modelo.ModeloID ' .
        ' WHERE vehiculo.Vigente = 1 ';
        $sql = $pdo->prepare($sqlTexto);       
        $sql->execute();          
        return $sql;       
    }

    function insert($_CategoriaID,$_MarcaID, $_ModeloID, $_Anio, $_NoLlantas, $_PotenciaMotor, $_Usuario){
        $pdo = new Conexion();
        $date = date('Y-m-d h:i:s');
        $sqlTexto = "INSERT INTO tbl_vehiculo(CategoriaID, MarcaID, ModeloID, Anio, NoLlantas, PotenciaMotor, Vigente, FechaAlta, FechaUM, UsuarioUM) " .
        " VALUES(:CategoriaID, :MarcaID, :ModeloID, :Anio, :NoLlantas, :PotenciaMotor, :Vigente, :FechaAlta, :FechaUM, :UsuarioUM)";

        $sql = $pdo->prepare($sqlTexto);
        $sql->bindValue(':CategoriaID', $_CategoriaID);
        $sql->bindValue(':MarcaID', $_MarcaID);
        $sql->bindValue(':ModeloID', $_ModeloID);
        $sql->bindValue(':Anio', $_Anio);
        $sql->bindValue(':NoLlantas', $_NoLlantas);
        $sql->bindValue(':PotenciaMotor', $_PotenciaMotor);
        $sql->bindValue(':Vigente', 1);
        $sql->bindValue(':FechaAlta', $date);
        $sql->bindValue(':FechaUM', $date);
        $sql->bindValue(':UsuarioUM', $_Usuario);
        $sql->execute();
        $idPost = $pdo->lastInsertId();             
        return $idPost; 
    }
}
