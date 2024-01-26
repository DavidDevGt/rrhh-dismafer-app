<?php
use Slim\Routing\RouteCollectorProxy;

$app->group('/', function (RouteCollectorProxy $group) {
    $group->get('', function ($request, $response, $args) {
        return $this->get('view')->render($response, 'layout.php', [
            // Aquí puedes pasar variables a tu plantilla
        ]);
    });
});
