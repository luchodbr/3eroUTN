<?php
     require_once __DIR__ .'/vendor/autoload.php';
     use  NNV\RestCountries; 
     include_once "Pais.php";

       class Api{
        protected  $restCountries;

       public function __construct(){

        $this->restCountries = new RestCountries;
       }

       public static function getByLanguage($language){
        $api = new RestCountries;
        $var = $api->byLanguage($language);
        for($i=0; $i < count($var) ; $i++){
            echo  new Pais($var[$i]->name) ;
        }
      }

      public static function getBySubRegion($subRegion){
              $api = new RestCountries;
              $var = $api->byRegionalBloc($subRegion);
              for($i=0; $i < count($var) ; $i++){
                  echo new Pais($var[$i]->name);
              }
      }
      //  public static function GetPaises()
      //  {
      //      return   $this->restCountries->all();
      //  }

      //  public  function GetPaisByContinent($region)
      //  {
      //      return   $this->restCountries->byRegion($region);
      //  }
       
      //  public  function GetBySubregion($subRegion){
      //      return   $this->restCountries->byRegionalBloc($subRegion);
      //  }

      //  public  function GetByLenguage($lenguaje){
      //      return   $this->restCountries->byLanguage($lenguaje);
      //  }

      //  public  function GetByCapital($capital){
      //      return   $this->restCountries->byCapitalCity($capital);
      //  }
      //  public  function GetByName($name)
      //  {
      //      return   $this->restCountries->byName($name);
      //  }
       
    }
    ?>


