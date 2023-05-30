<?php

declare(strict_types=1);

use Bruna\TodoListMvc\Connection\ConnectionCreator;
use Bruna\TodoListMvc\Controller\Error404Controller;
use Bruna\TodoListMvc\Entities\Task;

require_once __DIR__ . './../vendor/autoload.php';

$entityManager = ConnectionCreator::createEntityManager();
$taskRepository = $entityManager->getRepository(Task::class);

$routes = require_once __DIR__ . '/../config/routes.php';

$pathInfo = $_SERVER['PATH_INFO'] ?? '/';
$httpMethod = $_SERVER['REQUEST_METHOD'];

$key = "$httpMethod|$pathInfo";

if (array_key_exists($key, $routes)) {
    $controllerClasse = $routes[$key][0];
    $methodName = $routes[$key][1];

    $controller = new $controllerClasse($taskRepository);
} else {
    $controller = new Error404Controller();
}

$controller->$methodName();