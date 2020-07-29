<?php
include 'vendor/autoload.php';
use \Firebase\JWT\JWT;

include_once "persona.php";




/**
 * Json web token
 * 3 partes
 * 1ra: Header: MetaData, Hash
 * 2da: Payload: Informacion que querramos recordar (nombre latencia, mail)
 * 3ra: Firma: Se genera a partir del payload y del Hash. Tiene token secret
 */

$key = "example key";

$payload = array(
    "iss" => "example.org",
    "aud" => "example.com",
    "iat" => 1356999524,
    "nbf" => 1357000000,
    "nombre" => "juan",
    "email" => "juanpepe@"
);

$jwt = JWT::encode($payload, $key);
echo $jwt;

$headers=getallheaders();
$mitoken = $headers["mi_token"] ?? '';


// eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJleGFtcGxlLm9yZyIsImF1ZCI6ImV4YW1wbGUuY29tIiwiaWF0IjoxMzU2OTk5NTI0LCJuYmYiOjEzNTcwMDAwMDAsIm5vbWJyZSI6Imp1YW4iLCJlbWFpbCI6Imp1YW5wZXBlQCJ9.PIjDeXU4QYmLujoVHG1IdMcqOeOnh7-cD4E5lU7JuIc
try {
    $decoded = JWT::decode($jwt, $key, array('HS256'));
    print_r($decoded);
    
} catch (\Throwable $th) {
    echo $th->getMessage();
}







die();
// $personas = array();

// array_push($personas, new Persona('Pepe'));
// array_push($personas, new Persona('marta'));
// array_push($personas, new Persona('Carlos'));
// array_push($personas, new Persona('Calvo'));

// print_r($personas);


// $file = fopen('files/personas.txt','w');
// $rta = fwrite($file, json_encode($personas));

// fclose($file);
// */

// /*Variables de Sesion
// Duran hasta que el usuario ceirra el navegador 
// */

// /*Variables de Sesion
// Duran hasta que el usuario ceirra el navegador 
// */
// session_start();
// setcookie("nombre","juan",time()+10);
// //$_SESSION['Clave'];
// // print_r($_SESSION);

// $nombre=$_SESSION['nombre'] ?? false;

// if ($nombre==false){
//     $_SESSION['nombre'] = $_GET['nombre'] ?? 'NN';
//     echo "Session guardad";
// }else{
//     echo "hola " . $_SESSION['nombre'];
// }

