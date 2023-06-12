<?php

declare(strict_types=1);

use Bruna\TodoListMvc\Entities\Task;
use Bruna\TodoListMvc\Repositories\TaskRepository;
use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use Bruna\TodoListMvc\Connection\ConnectionCreator;

$builder = new ContainerBuilder();

$builder->addDefinitions([
        TaskRepository::class => function (): TaskRepository {
            $entityManager = ConnectionCreator::createEntityManager();
            $taskRepository = $entityManager->getRepository(Task::class);
            return $taskRepository;
        },
    ]);


/** @var ContainerInterface $container */
$container = $builder->build();

return $container;
