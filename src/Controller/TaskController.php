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
        $tasks = $this->taskRepository->findAll();

        require_once __DIR__ . '/../../views/task/index.html.php';
    }

    public function add(): void
    {
        $tarefa = filter_input(INPUT_POST, 'task-name');

        if (!$tarefa) {
            header('Location: /?sucesso=0');
            exit();
        }

        $task = new Task($tarefa);

        $sucess = $this->taskRepository->add($task);

        if (!$sucess) {
            header('Location: /?sucesso=0');
        } else {
            header('Location: /?sucesso=1');
        }
    }

    public function remove(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if (!$id || is_null($id)) {
            header('Location: /?sucesso=0');
            exit();
        }

        $sucess = $this->taskRepository->remove($id);

        if (!$sucess) {
            header('Location: /?sucesso=0');
        } else {
            header('Location: /?sucesso=1');
        }
    }

    public function update(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if (!$id || is_null($id)) {
            header('Location: /?sucesso=0');
            exit();
        }

        $tarefa = filter_input(INPUT_POST, 'new-task');

        if (!$tarefa) {
            header('Location: /?sucesso=0');
            exit();
        }

        $task = new Task($tarefa);
        $task->id = $id;

        $sucess = $this->taskRepository->update($task);

        if ($sucess === false) {
            header('Location: /?sucesso=0');
        } else {
            header('Location: /?sucesso=1');
        }
    }


}
