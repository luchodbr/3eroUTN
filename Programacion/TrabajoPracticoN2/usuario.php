<?php

require_once './datos.php';
require_once './Autenticar.php';
 class Usuario{

    public $email;
    public $clave;
    public $nombre;
    public $apellido;
    public $telefono;
    public $tipo;

    public function __construct($em,$clav,$nom,$ap,$tel,$tip){

        $this->email=$em;
        $this->clave=$clav;
        $this->nombre=$nom;
        $this->apellido=$ap;
        $this->telefono=$tel;
        $this->tipo=$tip;
    }


    public function Save(){
    
      return Datos::guardar("usuario.txt",$this);
      
    }
    public function Read(){
        return Datos::leer("usuario.txt");
    }

    public static function login($email, $clave){

      $usuarios = Datos::leer("usuario.txt");
       foreach ($usuarios as $value) {
         if($value->email === $email && $value->clave === $clave )
         {
           return Autenticar::GenerarToken($email,$clave,$value->tipo);
         }
       }
       return false;
    }
 }