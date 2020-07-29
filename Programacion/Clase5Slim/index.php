<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();

$app->setBasePath('/Programacion/Clase5Slim');

$app->addErrorMiddleware(true,true,true);

$app->post('/persona', function (Request $request, Response $response){
    
    $body = $request->getParsedBody();

    $file =$_FILES;// $request->getUploadedFiles();
    $rta = array("succes"=>true,
    "data"=>"POST",
    "body"=>$body,
    "files"=> $file["imagenCute"]   );

    $rtaJson= json_encode($rta); 
    $response->getBody()->write($rtaJson);
    


    return $response
    ->withHeader('Content-Type','application/json')
    ->withStatus(200);

});

$app->get('/persona/{id}', function (Request $request, Response $response, array $args) {
    
    $queryString = $request->getQueryParams();

    $headers = $request->getHeaders("token");

    $rta  = array("succes"=> true, "data" => $args, "headers"=> $headers,"query" => $queryString);

    $rtaJson = json_encode($rta);

    $response->getBody()->write($rtaJson);
    

    return $response
    ->withHeader('Content-Type','application/json')
    ->withStatus(200);
});


$app->group('/alumno',function($group){
    $group->get('[/]',function (Request $request, Response $response){
        $response->getBody()->write("alumno[/]");

        return $response
    ->withHeader('Content-Type','application/json')
    ->withStatus(200);
    
    });

});

$app->post('/',function(Request $request, Response $response){

    try{
        $conStr = 'mysql:host=localhost; dbname=prog3';
        $user = 'root';
        $pass ='';
        
        $pdo = new PDO($conStr,$user,$pass);
        $msg="Conexion ok";
    }catch(Throwable $e){
        $msg="error";
    }
});

$app->run();