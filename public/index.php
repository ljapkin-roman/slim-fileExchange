<?php
use Slim\Factory\AppFactory;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Twig\Loader\ArrayLoader;
use Twig\Loader\FilesystemLoader;
require '../vendor/autoload.php';
$container = new \DI\Container();
$settings = require __DIR__ . '/../app/settings.php';
$settings($container);
AppFactory::setContainer($container);
$app = AppFactory::create();

$middleware = require __DIR__ . '/../app/middleware.php';
$middleware($app);

$app->get('/', function(Request $request, Response $response) {
    $response->getBody()->write("slim is there");
    return $response;
});
$app->get('/hello', \App\Action\HelloAction::class);

$app->run();