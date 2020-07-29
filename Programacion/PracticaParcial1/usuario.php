<?php

require_once './datos.php';
require_once './Autenticar.php';
 class Usuario{

    public $id;
    public $nombre;
    public $dni;
    public $obraSocial;
    public $clave;
    public $tipo;

    public function __construct($nombre,$dni,$obraSocial,$clave,$tip){
        $this->nombre=$nombre;
        $this->dni=$dni;
        $this->obraSocial=$obraSocial;
        $this->clave=$clave;
        $this->tipo=$tip;
    }


    public function Save(){
    
        $arrayVacio = array();
        $arrayJSON = Datos::leer("usuario.txt")??$arrayVacio;
        if($arrayJSON != $arrayVacio)
        {
            foreach ($arrayJSON as $value) {
                if($value->nombre == $this->nombre)
                {
                    return "Ya esta registrado el nombre";
                }
            }
        }
        $this->setId($usuarios);
      Datos::guardar("usuario.txt",$this);
      return "Se ha Registrado el usuario";
      
    }
    private function setId($usuarios){
      if($usuarios){
          $this->id = end($usuarios)->id +1;
      }
      else{
          $this->id = 1;
      }
  }
    public function Read(){
        return Datos::leer("usuario.txt");
    }

    public static function login($nombre, $clave){

      $usuarios = Datos::leer("usuario.txt");
       foreach ($usuarios as $value) {
         if($value->nombre === $nombre && $value->clave === $clave )
         {
           return Autenticar::GenerarToken($value->tipo);
         }
       }
       return false;
    }
 }