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
    case '/usuario':
        if($method == 'POST')
        {
            $nombre = $_POST['nombre'] ?? null;
            $dni = $_POST['dni'] ?? null;
            $obraSocial = $_POST['obraSocial'] ?? null;
            $clave = $_POST['clave'] ?? null;
            $tipo = $_POST['tipo'] ?? null;

            if ( isset($nombre) && isset($dni) && isset($obraSocial) && isset($clave) && isset($tipo)) {
                
                 $Usuario = new Usuario($nombre, $dni, $obraSocial, $clave, $tipo);
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
            $nombre = $_POST['nombre'] ?? null;
            $clave = $_POST['clave'] ?? null;

            $mitoken = Usuario::login($nombre,$clave);
            //echo $mitoken;
            echo Autenticar::ValidarToken($mitoken);
        }
        else{
            echo 'error debe ser post';
        }
    break;

    case '/stock':
        if($method == 'POST'){

        }
        elseif($method == 'GET'){
            
        }
    break;

    
    case '/ventas':
        if($method == 'GET'){

        }
        elseif($method == 'POST'){
            

        }
    break;

    default:
        echo 'metodo no soportado';
        break;
}