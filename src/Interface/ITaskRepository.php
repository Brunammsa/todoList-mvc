<?php

namespace Bruna\TodoListMvc\Interface;

use Bruna\TodoListMvc\Entities\Task;

interface ITaskRepository
{
    public function add(Task $task): bool;
    public function remove(int $id): bool;
    public function update(Task $task): bool;
    public function listAll(): array;
}

