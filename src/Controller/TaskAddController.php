<?php

namespace Bruna\TodoListMvc\Controller;

use Bruna\TodoListMvc\Entities\Task;
use Bruna\TodoListMvc\Interface\IController;
use Bruna\TodoListMvc\Repositories\TaskRepository;

class TaskAddController implements IController
{
    public function __construct(private TaskRepository $taskRepository)
    {
    }

    public function process(): void
    {
        $tarefa = filter_input(INPUT_POST, 'new-task');

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
}
