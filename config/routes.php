<?php

use Bruna\TodoListMvc\Controller\TaskController;


return [
    'GET|/' => [TaskController::class, 'index'],
    'POST|/task' => [TaskController::class, 'add'],
    'DELETE|/task/{id}' => [TaskController::class, 'remove'],
    'PUT|/task' => [TaskController::class. 'update']
];