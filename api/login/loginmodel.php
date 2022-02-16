<?php
include '../../config.php';

class Login{  
    function getCredentials($usuario, $pass){
        $pdo = new Conexion();
        $sqlTexto = 'SELECT \'200\' AS messageID, \'Login Correcto\' AS message, sys_usuario.UsuarioID, sys_usuario.UsuarioNombre FROM sys_usuario WHERE sys_usuario.UsuarioAlias = :usuario AND sys_usuario.Contrasenia = :pass AND sys_usuario.Vigente = 1';
        $sql = $pdo->prepare($sqlTexto);
        $sql->bindValue(':usuario', $usuario);
        $sql->bindValue(':pass', $pass);
        $sql->execute();          
        return $sql;       
    }
}
