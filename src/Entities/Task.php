<?php

declare(strict_types=1);

namespace Bruna\TodoListMvc\Entities;

use Bruna\TodoListMvc\Repositories\TaskRepository;
use DateTime;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;

#[Entity(repositoryClass: TaskRepository::class)]
class Task
{
    #[Column, Id, GeneratedValue]
    public int $id;

    public function __construct(
        #[Column(nullable: false)]
        public string $name,

        #[Column(nullable: true, options: ['default' => null])]
        public ?DateTime $deleteAt = null,

        #[Column(nullable: false, options: ['default' => false])]
        public bool $done = false
    ) {
    }

    public function toggleDone(): void
    {
        $isDone = $this->done;

        if ($isDone) {
            $this->done = false;
        } else {
            $this->done = true;
        }
    }
}
