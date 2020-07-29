<?php
use \Firebase\JWT\JWT;
    class Autenticar{

        static function GenerarToken($tipo){
            $payload = array(
            "iss" => "example.org",
            "aud" => "example.com",
            "iat" => 1356999524,
            "nbf" => 1357000000,
            "tipo" => $tipo
        );
        $jwt = JWT::encode($payload, "clave123");
        return $jwt;
    }

    static function ValidarToken($token){
        try {
            if( $token == "" || !isset($token))
            {return null;}
            $decoded = JWT::decode($token, "clave123", array('HS256'));
            return $decoded->tipo;
            
        } catch (\Throwable $th) {
            return null;
        }
    }

}