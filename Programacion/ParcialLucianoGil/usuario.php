<?php

require_once './datos.php';
require_once './Autenticar.php';
 class Usuario{

    public $email;
    public $clave;
    public $tipo;

    public function __construct($email,$clave){
        $this->email=$email;
        $this->clave=$clave;
       // $this->tipo=$tip;
    }


    public function Save(){
    
        $arrayVacio = array();
        $arrayJSON = Datos::leer("usuario.txt")??$arrayVacio;
        if($arrayJSON != $arrayVacio)
        {
            foreach ($arrayJSON as $value) {
                if($value->email == $this->email)
                {
                    return "Ya esta registrado este email";
                }
            }
        }
      Datos::guardar("usuario.txt",$this);
      return "Se ha Registrado el usuario";
      
    }



    public static function login($email, $clave){

      $usuarios = Datos::leer("usuario.txt");
      if($usuarios){
        //var_dump($usuarios);
        foreach($usuarios as $value){
            if($value->email === $email && $value->clave === $clave){
                return Autenticar::generarToken($value->tipo,$value->email);
            }
        }
    }
    return false;
  }
    
 }