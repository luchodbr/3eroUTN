<?php

/*Variables de Sesion
Duran hasta que el usuario ceirra el navegador 
*/
session_start();
//$_SESSION['Clave'];
print_r($_SESSION);

$nombre=$_SESSION['nombre'] ?? false;

if ($nombre==false){
    $_SESSION['nombre'] = $_GET['nombre'] ?? 'NN';
    echo "Session guardad";
}else{
    echo "hola" . $_SESSION['nombre'];
}