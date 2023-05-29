<?php

namespace Bruna\TodoListMvc\Controller;

use Bruna\TodoListMvc\Interface\IController;
use Bruna\TodoListMvc\Repositories\TaskRepository;

class FormController implements IController
{
    public function __construct(private TaskRepository $taskRepository)
    {
    }

    public function process(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if ($id !== false && !is_null($id)) {
            $task = $this->taskRepository->find($id);
        }

        require_once __DIR__ . '/../../views/form-new-video.php';
    }
}
