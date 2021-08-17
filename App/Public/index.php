<?php
use Slim\Factory\AppFactory;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
require '../../vendor/autoload.php';
$app = AppFactory::create();
$app->get('/', function(Request $request, Response $response) {
    $response->getBody()->write("slim is there");
    print_r("ktre");
    return $response;
});
$app->run();