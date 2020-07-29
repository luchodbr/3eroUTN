<?php
require_once 'persona.php';
include_once 'response.php';
$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['PATH_INFO'] ?? '';
//echo $path;
//var_dump($_SERVER);

$response = new Response();
switch ($path) {
    case '/persona':
        switch ($method) {
            case 'GET':
                $legajo=$_GET['legajo'] ?? 0;
                if($legajo==0){
                    $rta = Persona::find();
                }else{
                    $rta = Persona::find($legajo);
                }
                $response->data = $rta;
                echo json_encode($response);
                break;
                
            case 'POST' :
                $nombre = $_POST['nombre'] ?? null;
                $apellido = $_POST['apellido']?? null;
                $legajo = $_POST['legajo']?? null;

                if(isset($nombre) && isset($apellido) && isset($legajo)){

                   $persona = new Persona($nombre,$apellido,$legajo);

                   $rta =$persona->save();
                    echo $rta;
                   //var_dump($persona);
                }else{
                    echo 'faltan datos';
                }
                break;
            default:
                # code...
                break;
        }
        break;
    case '/alumno':
        switch ($method) {
            case 'GET':
                # mostrar
                break;
            case 'POST' :
                #modificar
                break;
            default:
                # code...
                break;
        }
    break;
    default:
        echo "Metodo no soportado";
        break;
}