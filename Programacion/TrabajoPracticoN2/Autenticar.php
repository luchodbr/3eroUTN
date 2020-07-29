<?php
use \Firebase\JWT\JWT;
    class Autenticar{

        static function GenerarToken($email,$clave,$tipo){
            $payload = array(
            "iss" => "example.org",
            "aud" => "example.com",
            "iat" => 1356999524,
            "nbf" => 1357000000,
            "email" => $email,
            "clave" => $clave,
            "tipo" => $tipo
        );
        $jwt = JWT::encode($payload, "clave123");
        return $jwt;
    }

    static function ValidarToken($token){
        try {
            $decoded = JWT::decode($token, "clave123", array('HS256'));
            return true;
            
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }



    }