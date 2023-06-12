<?php

declare(strict_types=1);

use Bruna\TodoListMvc\Entities\Task;
use Bruna\TodoListMvc\Repositories\TaskRepository;
use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use Bruna\TodoListMvc\Connection\ConnectionCreator;
use League\Plates\Engine;

$builder = new ContainerBuilder();

$builder->addDefinitions([
        TaskRepository::class => function (): TaskRepository {
            $entityManager = ConnectionCreator::createEntityManager();
            $taskRepository = $entityManager->getRepository(Task::class);
            return $taskRepository;
        },
        Engine::class => function () {
            $templatePath = __DIR__ . '/../views';
            return new Engine($templatePath);
        }
    ]);


/** @var ContainerInterface $container */
$container = $builder->build();

return $container;
