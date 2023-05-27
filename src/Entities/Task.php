<?php

declare(strict_types=1);

namespace Bruna\TodoListMvc\Entities;

use DateTime;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;

#[Entity]
class Task
{
    #[Column, Id, GeneratedValue]
    public int $id;

    public function __construct(
        #[Column(nullable: false)]
        public string $name,

        #[Column(nullable: true, options:['default'=>null])]
        public ?DateTime $deleteAt,

        #[Column(nullable: false, options:['default'=>false])]
        public bool $done
    ) {
    }
}
