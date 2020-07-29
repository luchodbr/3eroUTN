<?php

class Datos{

    public $archivo;


    public static function guardar($archivo,$objeto){
        //leemos
        $arrayVacio = array();
        $arrayArchivo = Datos::leer($archivo)??$arrayVacio;
     
        array_push($arrayArchivo,$objeto);
        //escribimos
        $file=fopen($archivo,'w');
        $rta = fwrite($file,serialize($arrayArchivo));
        fclose($file);
        return $rta;
    }


    public static function leer($archivo){
        if(filesize($archivo)> 0)
        {    
            $file =fopen($archivo,'r');
            $arrayString = fgets($file);
            $arrayArchivo = unserialize($arrayString);
            fclose($file);
            return $arrayArchivo;
        }
        return null;
    }




    public static function guardarJSON($datos, $actualizar = false ){
        $archivo = 'productos.json';
        if(!$actualizar){
            $arrayJSON = Datos::leerJSON($archivo)??array();
            array_push($arrayJSON, $datos);
            $datos = $arrayJSON;       
        }
        $file = fopen($archivo, 'w+');
        $rta = fwrite($file, json_encode($datos));
        fclose($file);
        return $rta;

    }

    public static function leerJSON(){
        $archivo = './productos.json';
        if(file_exists($archivo) && filesize($archivo) > 0){
            $file = fopen($archivo, 'r');

            $arrayString = fread($file, filesize($archivo));

            $arrayJSON = json_decode($arrayString, true);

            fclose($file);

            return $arrayJSON;
        }
        return null;
    }
}