<?php

use Slim\Routing\RouteCollectorProxy;
use App\Controllers\UsuariosController;
use App\Controllers\MascotaController;
use App\Controllers\TurnoController;
use App\Middleware\TokenValidateMid;
use App\Middleware\TurnoValidateMiddleware;

//use App\Middleware\TokenValidateMiddleware;

return function ($app) {
    $app->group('/usuarios', function (RouteCollectorProxy $group) {
        $group->get('[/]', UsuariosController::class . ':getAll');
         $group->post('/login', UsuariosController::class . ':login'); //anda ok pq no me dejan dos rutas post
         $group->post('/registro', UsuariosController::class . ':add');//->add(UsuarioValidateMiddleware::class);
        // $group->get('/:id', UsuarioController::class . ':getAll');
        // $group->put('/:id', AlumnosController::class . ':getAll')->add(TokenValidateMiddleware::class);
        // $group->delete('/:id', AlumnosController::class . ':getAll');
    })
    // ->add(new BeforeMiddleware())
    ;

      $app->group('/mascotas', function (RouteCollectorProxy $group) {
         $group->get('[/]',MascotaController::class . ':getAll')->add(TokenValidateMid::class);
        // $group->get('/:id', AlumnosController::class . ':getAll');
        $group->post('[/]',MascotaController::class . ':add')->add(TokenValidateMid::class);
    //     $group->put('/:id', AlumnosController::class . ':getAll');
    //     $group->delete('/:id', AlumnosController::class . ':getAll');
    });

    $app->group('/turnos/mascotas', function (RouteCollectorProxy $group) {
        $group->get('[/]',TurnoController::class . ':getAll')->add(TokenValidateMid::class);
        $group->get('/:id', TurnoController::class . ':getId')->add(TokenValidateMid::class);    
       $group->post('[/]',TurnoController::class . ':add')->add(TokenValidateMid::class)->add(TurnoValidateMiddleware::class);
   //     $group->put('/:id', AlumnosController::class . ':getAll');
   //     $group->delete('/:id', AlumnosController::class . ':getAll');
   });
    // $app->group('/materias', function (RouteCollectorProxy $group) {
    //     $group->get('[/]', AlumnosController::class . ':getAll');
    //     $group->get('/:id', AlumnosController::class . ':getAll');
    //     $group->post('[/]', AlumnosController::class . ':getAll');
    //     $group->put('/:id', AlumnosController::class . ':getAll');
    //     $group->delete('/:id', AlumnosController::class . ':getAll');
    // });

};