<?php
include_once "Api.php";
include_once "Pais.php";
include_once 'IJson.php';
    class Continente extends Api implements IJson{

        public $paises;
        public $jsonContinente;
        public function __construct($continente)
        {   parent::__construct();
            $this->paises = array();
            $this->jsonContinente = $this->restCountries->byRegion($continente);
                 foreach ($this->jsonContinente as $value){
                $this->paises[]= new Pais($value->name);
                  }
        }

        public function __toString(){           
            foreach ($this->paises as $value) {
                echo $value;
            }
        }

        public function deCode()
        {
            echo json_decode($this->jsonContinente);
        }

    }