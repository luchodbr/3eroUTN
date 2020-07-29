<?php

include_once 'vendor/autoload.php';

use \Firebase\JWT\JWT;

class Auth{

    public static function generarToken($id, $tipo){
        $payload = array(
            "iss" => "http://example.org",
            "aud" => "http://example.com",
            "iat" => "1356999524",
            "nbf" => "1357000000",
            "iss" => "http://example.org",
            "id" => $id,
            "tipo" => $tipo
        );

        $jwt = JWT::encode($payload, "clave_secreta");

        return $jwt;
    }

    public static function validarToken($token){
        if(empty($token) || $token === ""){
            return null;
        }
        try{
            $decodificado = JWT::decode($token, "clave_secreta", ['HS256']);
            return $decodificado;
        }
        catch (Exception $e){
            return null;
        }
    }
    
}