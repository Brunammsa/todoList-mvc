<?php

use Bruna\TodoListMvc\Controller\FormController;
use Bruna\TodoListMvc\Controller\TaskAddController;
use Bruna\TodoListMvc\Controller\TaskListController;
use Bruna\TodoListMvc\Controller\TaskRemoveController;
use Bruna\TodoListMvc\Controller\TaskUpdateController;

return [
    'GET|/' => TaskListController::class,
    'GET|/new-task' =>FormController::class,
    'POST|/new-task' => TaskAddController::class,
    'GET|/remove-task' => TaskRemoveController::class,
    'GET|/update-task' => FormController::class,
    'POST|/update-task' => TaskUpdateController::class
];