<?php
use Slim\Factory\AppFactory;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
require '../vendor/autoload.php';
$container = new \DI\Container();
$settings = require __DIR__ . '/../app/settings.php';
$settings($container);
AppFactory::setContainer($container);

$currentPath = __DIR__ . '/../templates/';
$container->set('view', function () {
    return Twig::create('../templates', []);
});


$app = AppFactory::create();

$app->add(TwigMiddleware::createFromContainer($app));

$middleware = require __DIR__ . '/../app/middleware.php';
$middleware($app);

$app->get('/hello/{name}', function($request, $response, $args) {
    return $this->get('view')->render($response, 'profile.html', [
        'name' => $args['name']
    ]);
});
$app->get('/', function(Request $request, Response $response) {
    $response->getBody()->write("slim is there");
    return $response;
});
$app->run();