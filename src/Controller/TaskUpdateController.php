<?php

namespace Bruna\TodoListMvc\Controller;

use Bruna\TodoListMvc\Entities\Task;
use Bruna\TodoListMvc\Interface\IController;
use Bruna\TodoListMvc\Repositories\TaskRepository;

class TaskUpdateController implements IController
{
    public function __construct(private TaskRepository $taskRepository)
    {
    }

    public function process(): void
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
