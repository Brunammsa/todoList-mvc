<?php

namespace Bruna\TodoListMvc\Tests;

use Bruna\TodoListMvc\Entities\Task;
use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase
{
    public function testToggleDone(): void
    {
        $task = new Task(name: 'name', done: false);

        $task->toggleDone();

        $this->assertTrue($task->done);
        
    }

    public function testToggleNotDone(): void
    {
        $taskDone =  new Task(name: 'this task is done', done: true);

        $taskDone->toggleDone();
        
        $this->assertFalse($taskDone->done);
    }
}