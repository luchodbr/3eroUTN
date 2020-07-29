<?php

require_once './usuario.php';
require_once './response.php';

include 'vendor/autoload.php';


$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['PATH_INFO'] ?? '';
$path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO']  : '';

$headers=getallheaders();
$mitoken = $headers["mi_token"] ?? '';
$respuesta = new response();

switch ($path) {
    case '/signin':
        if($method == 'POST')
        {
            $email = $_POST['email'] ?? null;
            $clave = $_POST['clave'] ?? null;
            $nombre = $_POST['nombre'] ?? null;
            $apellido = $_POST['apellido'] ?? null;
            $telefono = $_POST['telefono'] ?? null;
            $tipo = $_POST['tipo'] ?? null;

            if (isset($email) && isset($clave) && isset($nombre) && isset($apellido) && isset($telefono) && isset($tipo)) {
                
                 $Usuario = new Usuario($email, $clave, $nombre, $apellido, $telefono, $tipo );
                var_dump($Usuario->Save());
                var_dump($Usuario->Read());
            }
            else{
                echo 'Faltan datos';
            }


        }
        else{
            echo 'error debe ser post';
        }
        break;
    


    case '/login':
        if($method == 'POST')
        {
            $email = $_POST['email'] ?? null;
            $clave = $_POST['clave'] ?? null;

            $Usuario = Usuario::login($email,$clave);
            echo $Usuario;
        }
        else{
            echo 'error debe ser post';
        }
    break;

    case '/detalle':
        if($method == 'GET'){

        }
        else{
            echo 'error debe ser GET';
        }
    break;

    case '/lista':
        if($method == 'GET'){

        }
        else{
            echo 'error debe ser GET';
        }
    break;
    default:
        echo 'metodo no soportado';
        break;
}

