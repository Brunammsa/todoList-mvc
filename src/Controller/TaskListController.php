<?php

namespace Bruna\TodoListMvc\Controller;

use Bruna\TodoListMvc\Interface\IController;
use Bruna\TodoListMvc\Repositories\TaskRepository;

class TaskListController implements IController
{
    public function __construct(private TaskRepository $taskRepository)
    {
    }

    public function process(): void
    {
        $tasks = $this->taskRepository->findAll();

        require_once __DIR__ . '/../../views/task/index.html.php';
    }
}
