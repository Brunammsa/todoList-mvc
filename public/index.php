<?php

declare(strict_types=1);

use Bruna\TodoListMvc\Controller\Error404Controller;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;
use Psr\Http\Message\ResponseInterface;

require_once __DIR__ . './../vendor/autoload.php';

$routes = require_once __DIR__ . '/../config/routes.php';

/** @var \Psr\Container\ContainerInterface $diContainer */
$diContainer = require_once __DIR__ . '/../config/dependencies.php';


$pathInfo = $_SERVER['PATH_INFO'] ?? '/';
$httpMethod = $_SERVER['REQUEST_METHOD'];

if ($httpMethod === 'POST' && isset($_REQUEST['_method']) && $_REQUEST['_method'] == 'delete') {
    $httpMethod = 'DELETE';
}

$pathInfo = preg_replace('/\d+/i', '{id}', $pathInfo);

$key = "$httpMethod|$pathInfo";

// if ($pathInfo !== '/') {
//     echo '<pre>';
//     var_dump($key);
//     exit;
// }

if (array_key_exists($key, $routes)) {
    $controllerClasse = $routes[$key][0];
    $methodName = $routes[$key][1];

    $controller = $diContainer->get($controllerClasse);
} else {
    $controller = new Error404Controller();
}

$psr17Factory = new Psr17Factory();

$creator = new ServerRequestCreator(
    $psr17Factory, // ServerRequestFactory
    $psr17Factory, // UriFactory
    $psr17Factory, // UploadedFileFactory
    $psr17Factory  // StreamFactory
);

$request = $creator->fromGlobals();

/** @var ResponseInterface $response */

$response = $controller->$methodName($request);

http_response_code($response->getStatusCode());

foreach ($response->getHeaders() as $name => $values) {
    foreach ($values as $value) {
        header(sprintf('%s: %s', $name, $value), false);
    }
}

echo $response->getBody();
