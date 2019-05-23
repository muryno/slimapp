<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require '../src/route/config/db.php';

$con=new db();
$con->connection();

$app = new \Slim\App;
$app->get('/user/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");

    return $response;
});
require '../src/route/customer.php';

$app->run();

