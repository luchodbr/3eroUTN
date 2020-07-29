<?php
     include_once "Api.php";
     require_once __DIR__ .'/vendor/autoload.php';
     include_once 'IJson.php';
     class Pais extends Api implements IJson{
        public $name;
        public $capital;
        public $continent;
        public $subRegion;
        public $poblacion;
        public $language;
        public $area;
        public $flag;
        public $currency;
        public $jsonPais;

        public function __construct($nombre){
            parent::__construct();
        $this->jsonPais = $this->restCountries->byName($nombre);
        $this->name = $this->jsonPais[0]->name;
        $this->capital = $this->jsonPais[0]->capital;
        $this->continent = $this->jsonPais[0]->region;
        $this->subRegion = $this->jsonPais[0]->subregion;
        $this->poblacion =$this->jsonPais[0]->population;
        $this->language =$this->jsonPais[0]->languages[0]->nativeName;
        $this->area = $this->jsonPais[0]->area;
        $this->flag = $this->jsonPais[0]->flag;
        $this->currency =$this->jsonPais[0]->currencies[0]->name;
        }

        
        public function deCode(){
            echo json_decode($this->jsonPais);
        }

        public function __toString(){
            $salida ="El nombre del pais es " . $this->name 
            ."<br> La capital es " . $this->capital 
            ."<br> Pertenece al continente " . $this->continent 
            ."<br> De la subregion " . $this->subRegion 
            ."<br> Su poblacion es de  " . $this->poblacion 
            ."<br> Su idioma es " . $this->language 
            ."<br> El area del pais es de  " . $this->area 
            ."<br> Su Bandera es  " . $this->flag 
            ."<br> Y la moneda que utilizan es: " . $this->currency ."<br><br>";
            return $salida;

        }
  }