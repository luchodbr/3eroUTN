<?php

class Datos{

    public $archivo;

    public static function guardar($archivo,$datos){
        $file =fopen($archivo,'a');

        $rta = fwrite($file,$datos);
        fclose($file);
        return $rta;
    }

    public static function guardarJSON($archivo,$objeto){
        //leemos
        $arrayVacio = array();
        $arrayJSON = Datos::leerJSON($archivo)??$arrayVacio;
        array_push($arrayJSON,$objeto);
        //escribimos
        $file=fopen($archivo,'w+');
        $rta = fwrite($file,json_encode($arrayJSON));
        fclose($file);
        return $rta;
    }

    public static function leerTodo($archivo){
        $file =fopen($archivo,'r');
        $lista = array();
        while(!feof($file)){
            
            $linea = fgets($file);
           
            $explode = explode('@',$linea);
            
            if(count($explode)>0){
                array_push($lista,$explode);
            }
        }
       // $rta = fread($file,filesize($archivo));
        fclose($file);
        return $lista;
    }

    public static function leerJSON($archivo){
        if(filesize($archivo)> 0)
        {    
            $file =fopen($archivo,'r');
            $arrayString = fread($file,filesize($archivo));
            $arrayJSON = json_decode($arrayString);
            fclose($file);
            return $arrayJSON;
        }
        return null;
    }
}