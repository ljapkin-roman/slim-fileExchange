<?php
use Slim\Factory\AppFactory;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Summit\TwigFunction\FirstFunction as FirstFunction;
use Slim\Views\PhpRenderer as PhpRenderer;
use Summit\Models\Model_Authentication as Model_Auth;
use Summit\Models\Model_Login as Model_Login;
require __DIR__ . '/../../vendor/autoload.php';
require '../Config/eloquent.php';
$container = new \DI\Container();
$settings = require __DIR__ . '/../app/settings.php';
$settings($container);
AppFactory::setContainer($container);


$container->set('view', function () {
    return Twig::create('../templates', []);
});
$app = AppFactory::create();
/*
$app->add(TwigMiddleware::createFromContainer($app));

$middleware = require __DIR__ . '/../app/middleware.php';
$middleware($app);
*/

$app->get('/hello/{name}', function($request, $response, $args) {
    return $this->get('view')->render($response, 'profile.html', [
        'name' => $args['name']
    ]);
});
$app->get('/', function(Request $request, Response $response) {
    return $this->get('view')->render($response, 'bootstrap-gp/index.html');
    return $response;
});
$app->get('/form-control', function (Request $request, Response $response) {
    return $this->get('view')->render($response, 'bootstrap-gp/form-control.html.twig', []);
    return $response;
});

$app->get('/post-control', function (Request $request, Response $response, $args) {
    $renderer = new PhpRenderer('../templates');
    return $renderer->render($response, "template.php", $args);

});

$app->get('/auth', function (Request $request, Response $response, $args) {
    $renderer = new PhpRenderer('../templates');
    return $renderer->render($response, "authentication.php", );

});

$app->get('/login', function (Request $request, Response $response, $args) {
    $renderer = new PhpRenderer('../templates');
    return $renderer->render($response, "login.php", );

});

$app->post('/is-user-exist', function (Request $request, Response $response, $args) {
    $email = htmlentities($request->getParsedBody()['email']);
    $password = htmlentities($request->getParsedBody()['password']);
    $model_login = new Model_Login();
    $dataUser = $model_login->isUserValid($email, $password);
    if (empty($dataUser['errors']))
    {
        $renderer = new PhpRenderer('../templates');
        return $renderer->render($response, "success.php", $dataUser['session']);
    }
    else {
        print_r($dataUser['errors']);
    }

});

$app->post('/validation', function (Request $request, Response $response, $args) {
    $renderer = new PhpRenderer('../templates');
    return $renderer->render($response, 'validation.php', $args);
});

$app->post('/record', function (Request $request, Response $response, $args) {
    $renderer = new PhpRenderer('../templates');
    $model_auth = new Model_Auth();
    $output = $model_auth->validation($_POST);
    if (!empty($output['errors']))
    {
        return $renderer->render($response, "authentication.php", $output);
    }
    $model_auth->do_record($_POST);
    return $renderer->render($response, "success.php", $args);


});


$app->get('/css/style', function (Request $request, Response $response) {
    require '../templates/bootstrap-gp/css/styles.css';
});


$app->post('/download', function(Request $request, Response $response) {
    $response->getBody()->write("post here");
    $target_dir = "/home/roma/slim/src/public/";
    $filepath = $target_dir . basename($_FILES['MYfile']['name']);
    print_r($filepath);
    if (move_uploaded_file($_FILES['MYfile']['tmp_name'], $filepath)) {
        echo "File is valid, and was successfully uploaded.\n";
    } else {
        echo "Possible file upload attack!\n";
    }
    return $response;
});
$app->run();