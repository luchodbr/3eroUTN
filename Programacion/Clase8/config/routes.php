<?php
use App\Controllers\AlumnosControler;
use Slim\Routing\RouteCollectorProxy;
return function($app){
    $app->group('/alumnos',function(RouteCollectorProxy $group){
        $group->get('[/]',AlumnosControler::class,'getAll');
    });
};