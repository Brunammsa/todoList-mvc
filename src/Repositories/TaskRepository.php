<?php

declare(strict_types=1);

namespace Bruna\TodoListMvc\Repositories;

use Bruna\TodoListMvc\Connection\ConnectionCreator;
use Bruna\TodoListMvc\Entities\Task;
use DateTime;
use Doctrine\ORM\EntityRepository;

class TaskRepository extends EntityRepository
{
    public function add(Task $task): bool
    {
        $entityManager = ConnectionCreator::createEntityManager();

        try {
            $entityManager->persist($task);
            $entityManager->flush();
            return true;
        } catch (\Throwable $e) {
            return false;
        }
    }

    public function remove(int $id): bool
    {
        $entityManager = ConnectionCreator::createEntityManager();

        $taskRepository = $entityManager->getRepository(Task::class);
        $task = $taskRepository->find($id);

        if (!$task) {
            return false;
        }

        $task->deleteAt = new DateTime();

        try {
            $entityManager->flush();
            return true;
        } catch (\Throwable $e) {
            return false;
        }
    }

    public function update(Task $task): bool
    {
        $entityManager = ConnectionCreator::createEntityManager();
        $taskRepository = $entityManager->getRepository(Task::class);

        $taskEntity = $taskRepository->find($task->id);
        $taskEntity->setNameTask($task->name);
        $taskEntity->setDeleteAt($task->deleteAt);
        $taskEntity->setDoneTask($task->done);

        try {
            $entityManager->persist($taskEntity);
            $entityManager->flush();
            return true;
        } catch (\Throwable $e) {
            return false;
        }
    }
}
