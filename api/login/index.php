<?php
include_once 'loginapi.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    try {
        $usuario = '';
        $pass = '';
        if (isset($_GET['usuario'])) {
            $usuario = $_GET['usuario'];
        }
        if (isset($_GET['password'])) {
            $pass = $_GET['password'];
        }
        if (($usuario != '') && ($pass != '')) {
            $access = new apiLogin();
            $credentials = $access->getAccess($usuario, $pass);
            $creds = json_decode($credentials, true);
            if ($creds[0]['messageID'] == '200') {
                iniciarSesion();
                header("HTTP/1.1 200 Credenciales Correctas");
                echo $credentials;
            } else {
                header("HTTP/1.1 401 Credenciales Incorrectas");
                echo $credentials;
            }
            exit;
        } else {
            $response = array("messageID" => "400", "message" => "Forbidden");
            header("HTTP/1.1 400");
            echo json_encode($response);
            exit;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function iniciarSesion()
{
    session_name('sesionUsuario');
    session_start();
    $_SESSION['autenticado'] = 'SI';
    $_SESSION['UsuarioID'] = '1';
}
