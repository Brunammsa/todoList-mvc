<?php

namespace Bruna\TodoListMvc\Controller;

use Bruna\TodoListMvc\Interface\IController;
use Bruna\TodoListMvc\Repositories\TaskRepository;


class ListController implements IController
{
    public function __construct(private TaskRepository $taskRepository)
    {
    }

    public function process(): void
    {
        $todoList = $this->taskRepository->listAll();

        require_once __DIR__ . '/../../views/taskList.php';
    }
}
