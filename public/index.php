<?php
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

// Aquí puedes añadir tus rutas
$app->get('/', function ($request, $response, $args) {
    $response->getBody()->write("Hola, bienvenido a rrhh-dismafer");
    return $response;
});

$app->run();