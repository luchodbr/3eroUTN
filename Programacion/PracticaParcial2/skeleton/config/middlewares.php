<?php
use Slim\App;
use App\Middleware\TokenValidateMid;
use App\Middleware\AfterMiddleware;


return function (App $app) {
    $app->addBodyParsingMiddleware();

    // $app->add(new BeforeMiddleware());
    //$app->add(BeforeMiddleware::class);
     $app->add(new AfterMiddleware());
    
};