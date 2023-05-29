<?php

namespace Bruna\TodoListMvc\Controller;

use Bruna\TodoListMvc\Interface\IController;
use Bruna\TodoListMvc\Repositories\TaskRepository;

class TaskRemoveController implements IController
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

        $sucess = $this->taskRepository->remove($id);

        if (!$sucess) {
            header('Location: /?sucesso=0');
        } else {
            header('Location: /?sucesso=1');
        }
    }
}
