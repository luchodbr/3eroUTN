<?php  
    require_once __DIR__ .'/vendor/autoload.php';
    include_once "Pais.php";
    include_once "Continente.php";
    include_once "Api.php";
    use  NNV\RestCountries; 

    // include "Continente.php";

     $country = new Pais("france");
     $continent = new Continente("Asia");
    // echo $country; // en caso de querer listar ciertas propiedades basicas del pais instansiado
    //echo $continent; // en caso de querer listar ciertas propiedades basicas de los paises del continenete instansiado
    //echo Api::getByLanguage("es"); 
    //echo Api::getBySubRegion("eu");
?>
