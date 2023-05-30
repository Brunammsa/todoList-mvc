<?php

use Bruna\TodoListMvc\Controller\TaskController;


return [
    'GET|/' => [TaskController::class, 'index'],
    'POST|/new-task' => [TaskController::class, 'add'],
    'GET|/remove-task' => [TaskController::class, 'remove'],
    'POST|/update-task' => [TaskController::class. 'update']
];