<?php

namespace Bruna\TodoListMvc\Controller;

use Bruna\TodoListMvc\Connection\ConnectionCreator;
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

        $taskDone = $this->taskRepository->findBy([
            'done' => true
        ]);

        require_once __DIR__ . '/../../views/task/index.html.php';
    }

    public function add(): void
    {
        $taskName = filter_input(INPUT_POST, 'task-name');

        if (!$taskName) {
            header('Location: /');
            exit();
        }

        $task = new Task($taskName);

        $success = $this->taskRepository->add($task);

        if (!$success) {
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
        $entityManager = ConnectionCreator::createEntityManager();
        $taskRepository = $entityManager->getRepository(Task::class);

        if (isset($_POST['checkbox-task']) && $_POST['checkbox-task'] == '1')
        {
            $taskRepository->toggleDone();
        }

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

        $success = $this->taskRepository->update($task);

        if ($success === false) {
            header('Location: /');
        } else {
            header('Location: /');
        }

        require_once __DIR__ . '/../../views/task/index.html.php';
    }
}
