<?php

require_once './usuario.php';
//require_once './pizzas.php';
//require_once './ventas.php';

include 'vendor/autoload.php';


$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['PATH_INFO'] ?? '';
$path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO']  : '';

$headers=getallheaders();
$mitoken = $headers["token"] ?? '';
$respuesta;

switch ($path) {
    case '/usuario':
        if($method == 'POST')
        {
            $email = $_POST['email'] ?? null;
            $clave = $_POST['clave'] ?? null;
            //$tipo = $_POST['tipo'] ?? null;
            
            if ( isset($email) && isset($clave)) {
                
                 $Usuario = new Usuario($email, $clave);
                var_dump($Usuario->Save());
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

             $mitoken = Usuario::login($email,$clave);
            if($mitoken){
                
                echo  'Su token es: '.$mitoken;
            }
            else{
                echo  'Verifique los datos';
            }
        }
        else{
            echo 'error debe ser post';
        }
    break;

    case '/pizzas':
        if($method == 'POST'){

            $precio = $_POST['precio']??null;
            $stock = $_POST['stock']??null;
            $tipo = $_POST['tipo']??null;
            $sabor = $_POST['sabor']??null;
            $foto = $_FILES['foto']??null;

            if($precio && $stock && $tipo && $sabor){
                if(($tipo ==="molde" || $tipo ==="piedra") && ($sabor ==="jamon" ||$sabor ==="muzza" || $sabor ==="napo") ){

                    $pizza = new Pizza($tipo,$precio,$stock,$sabor,$foto);
                    echo  $pizza->guardarPizza($mitoken);
                }else{
                    echo "tipo o sabor no valido";
                }
            }
        }
        elseif($method == 'GET'){
            echo Pizza::leerPizzas($mitoken);
        }
    break;

    
    case '/ventas':
        if($method == 'GET'){
            var_dump(Venta::mostrarVentas($mitoken));   
        }
        elseif($method == 'POST'){
            $tipo = $_POST['tipo']??null;
            $sabor = $_POST['sabor']??null;
            $venta = new Venta($tipo,$sabor,1);
            var_dump($venta->realizarVenta($mitoken));
        }
    break;

    default:
        echo 'metodo no soportado';
        break;
}