<?php

namespace Bruna\TodoListMvc\Controller;

use Bruna\TodoListMvc\Repositories\TaskRepository;
use Bruna\TodoListMvc\Entities\Task;

class TaskController
{
    public function __construct(private TaskRepository $taskRepository)
    {
    }

    public function index(): void
    {
        $tasks = $this->taskRepository->findBy([
            'deleteAt' => null
        ]);

        require_once __DIR__ . '/../../views/task/index.html.php';
    }

    public function add(): void
    {
        $tarefa = filter_input(INPUT_POST, 'task-name');

        if (!$tarefa) {
            header('Location: /');
            exit();
        }

        $task = new Task($tarefa);

        $sucess = $this->taskRepository->add($task);

        if (!$sucess) {
            header('Location: /');
        } else {
            header('Location: /');
        }
    }

    public function remove(): void
    {
        $uri = $_SERVER['PATH_INFO'];
        $pattern = '{\w+/(\d+)}';

        if (preg_match($pattern, $uri, $matches)) {
            if (count($matches) < 2) {
                header('Location: /');
                exit();
            }

            $id = $matches[1];
            $this->taskRepository->remove(intval($id));
        }
        header('Location: /');
    }

    public function update(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if (!$id || is_null($id)) {
            header('Location: /');
            exit();
        }

        $tarefa = filter_input(INPUT_POST, 'new-task');

        if (!$tarefa) {
            header('Location: /');
            exit();
        }

        $task = new Task($tarefa);
        $task->id = $id;

        $sucess = $this->taskRepository->update($task);

        if ($sucess === false) {
            header('Location: /');
        } else {
            header('Location: /');
        }
    }
}
