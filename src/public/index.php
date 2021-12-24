<?php
use Slim\Factory\AppFactory;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Summit\TwigFunction\FirstFunction as FirstFunction;
use Slim\Views\PhpRenderer as PhpRenderer;
use Summit\Models\Model_Authentication as Model_Auth;
use Summit\Models\Model_Login as Model_Login;
use Summit\Models\Model_Files;
use Summit\Models\ExampleMiddleware;
use Summit\classes\ThumbImage;
require __DIR__ . '/../../vendor/autoload.php';
require '../Config/eloquent.php';
$container = new \DI\Container();
$settings = require __DIR__ . '/../app/settings.php';
$settings($container);
AppFactory::setContainer($container);

session_start();
$container->set('view', function () {
    return Twig::create('../templates', []);
});
$app = AppFactory::create();
/*
$app->add(TwigMiddleware::createFromContainer($app));

$middleware = require __DIR__ . '/../app/middleware.php';
$middleware($app);
*/


$app->get('/hello', function($request, $response, $args) {
    echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    //print_r($_SERVER['REQUEST_URI']);
    return $response;
});
$app->get('/', function(Request $request, Response $response) {
    $info_user['name'] = 'guest';
    if (!empty($_COOKIE['user_id'])) {
        echo("<br>");
        $id_session = $_COOKIE['PHPSESSID'];
        $set = [];
        if ($_SESSION['PHPSESSID'] == $_COOKIE['PHPSESSID'])
        {
            $set = $_SESSION;
        }
        $info_user['name'] = $_SESSION['name'];
    }
    $renderer = new PhpRenderer('../templates');
    return $renderer->render($response, 'welcome.php', $info_user);

});
$app->get('/form-control', function (Request $request, Response $response) {
    return $this->get('view')->render($response, 'bootstrap-gp/form-control.html.twig', []);
    return $response;
});

$app->get('/begin', function($request, $response, $args) {
    $renderer = new PhpRenderer('../templates');
    return $renderer->render($response, "begin.php", ['session' => $_SESSION]);
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

$app->get('/session', function (Request $request, Response $response, $args) {
    $renderer = new PhpRenderer('../templates');
    return $renderer->render($response, "Basic.php", );
});

$app->get('/get-token', function (Request $request, Response $response, $args) {
    $renderer = new PhpRenderer('../templates');
    return $renderer->render($response, "welcome.php", );
});

$app->post('/is-user-exist', function (Request $request, Response $response, $args) {
    $email = htmlentities($request->getParsedBody()['email']);
    $password = htmlentities($request->getParsedBody()['password']);
    $host = $request->getUri()->getHost();
    $model_login = new Model_Login();
    $dataUser = $model_login->isUserValid($email, $password, $host);
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

$app->get('/name-in-top', function (Request $request, Response $response, $args) {
    $info_user['name'] = 'guest';
    if (!empty($_COOKIE['user_id'])) {
        echo("<br>");
        $id_session = $_COOKIE['PHPSESSID'];
        $set = [];
        if ($_SESSION['PHPSESSID'] == $_COOKIE['PHPSESSID'])
        {
            $set = $_SESSION;
        }
        $info_user['name'] = $_SESSION['name'];
    }
    $renderer = new PhpRenderer('../templates');
    return $renderer->render($response, 'welcome.php', $info_user);
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

$mw = function ($request, $response, $next) {
    $response->getBody()->write('BEFORE');
    $response = $next($request, $response);
    $response->getBody()->write('AFTER');
    return $response;
};

$app->get('/middle', function (Request $request, Response $response, $args) {
      $response->getBody()->write('middleware');
      return $response;
});


$app->post('/download', function(Request $request, Response $response) {
    $user_session = $_COOKIE['PHPSESSID'];
    if ($_SESSION['PHPSESSID'] === $user_session)

    {
        print_r("The session with the id session is exist");
        echo '<br >';
    }
    else {
        print_r("This session in not exist");
        echo '<br >';
        header('Location: http://www.example.com/');
    }

    $target_dir = "/home/roma/slim/src/public/files/";
    $thumb_dir = "/home/roma/slim/src/public/thumb_files/";
    $mime_type = mime_content_type($_FILES['file']['tmp_name']);
    $extension_file = explode('.', $_FILES['file']['name'])[1];
    $random_name = explode('/', $_FILES['file']['tmp_name'])[2] . '.' . $extension_file;
    $filepath = $target_dir . basename($_FILES['file']['tmp_name']) . '.'. $extension_file;
    $thumbName = 'thumb_'.$random_name;
    $thumb_filepath = $thumb_dir . $thumbName;

    if (move_uploaded_file($_FILES['file']['tmp_name'], $filepath)) {
        echo "File is valid, and was successfully uploaded.";
        $im = new ThumbImage($filepath);
        $im->createThumb($thumb_filepath, 100);
        $data = ['mime_type' => $mime_type,
                 'user_id' => $_SESSION['user_id'],
                 'name' => $_FILES['file']['name'],
                 'name_file' => $random_name,
                 'directory_destination' => $target_dir,
                 'thumb_file' => $thumb_filepath
                ];
        $model_file = new Model_Files();
        $model_file->do_record($data);

    } else {
        echo "Possible file upload attack!\n";
    }
    return $response;
});

$app->get('/image', function (Request $request, Response $response) {
    $im = new ThumbImage('files/phpknrrPM.jpg');

});

$app->get('/info', function (Request $request, Response $response) {
    print_r(phpinfo());
});
$app->run();