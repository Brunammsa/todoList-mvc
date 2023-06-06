<?php

namespace Bruna\TodoListMvc\Controller;

use Bruna\TodoListMvc\Connection\ConnectionCreator;
use Bruna\TodoListMvc\Repositories\TaskRepository;
use Bruna\TodoListMvc\Entities\Task;
use Bruna\TodoListMvc\Traits\FlashMessageTrait;
use Bruna\TodoListMvc\Traits\HtmlRendererTrait;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class TaskController
{
    use FlashMessageTrait, HtmlRendererTrait;

    public function __construct(private TaskRepository $taskRepository)
    {
    }

    public function index(): ResponseInterface
    {
        $tasks = $this->taskRepository->findBy([
            'deleteAt' => null
        ]);

        $taskDone = $this->taskRepository->findBy([
            'done' => true
        ]);

        $html = $this->renderTemplate('index.html', [
            'tasks' => $tasks,
            'taskDone' => $taskDone
        ]);

        return new Response(200, body: $html);
    }

    public function add(ServerRequestInterface $request): ResponseInterface
    {
        $requestBody = $request->getParsedBody();
        $taskName = filter_var($requestBody['task-name']);

        if (!$taskName) {
            return new Response(302, [
                'Location' => '/'
            ]);
        }

        $task = new Task($taskName);

        $success = $this->taskRepository->add($task);

        if (!$success) {
            $this->addErrorMessage('Erro ao inserir nova tarefa');

            return new Response(302, [
                'Location' => '/'
            ]);
        }

        return new Response(200, [
            'Location' => '/'
        ]);
    }

    public function remove(): ResponseInterface
    {
        $uri = $_SERVER['PATH_INFO'];
        $pattern = '{\w+/(\d+)}';

        if (preg_match($pattern, $uri, $matches)) {

            if (count($matches) < 2) {
                return new Response(302, [
                    'Location' => '/'
                ]);
            }

            $id = $matches[1];
            $this->taskRepository->remove(intval($id));
        }

        return new Response(200, [
            'Location' => '/'
        ]);

    }

    public function update(ServerRequestInterface $request): ResponseInterface
    {
        $entityManager = ConnectionCreator::createEntityManager();
        $taskRepository = $entityManager->getRepository(Task::class);

        if (isset($_POST['checkbox-task']) && $_POST['checkbox-task'] == '1') {
            $taskRepository->toggleDone();
        }

        $queryParams = $request->getQueryParams();
        $id = filter_var($queryParams['id'], FILTER_VALIDATE_INT);

        if (!$id || is_null($id)) {
            return new Response(302, [
                'Location' => '/'
            ]);
        }

        $requestBody = $request->getParsedBody();
        $tarefa = filter_var($requestBody['new-task']);

        if (!$tarefa) {
            return new Response(302, [
                'Location' => '/'
            ]);
        }

        $task = new Task($tarefa);
        $task->id = $id;

        $success = $this->taskRepository->update($task);

        if (!$success) {
            $this->addErrorMessage('Erro ao atualizar tarefa');

            return new Response(302, [
                'Location' => '/'
            ]);
        }

        return new Response(200, [
            'Location' => '/'
        ]);

        echo $this->renderTemplate('index.html');
    }
}
