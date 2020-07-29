<?php
require_once __DIR__ .'/../vendor/autoload.php';
use Slim\Factory\AppFactory;

$app = AppFactory::create();
$app->setBasePath("/Clase8/public");



return $app;