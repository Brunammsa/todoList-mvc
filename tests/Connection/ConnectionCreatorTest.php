<?php

declare(strict_types=1);

namespace Bruna\TodoListMvc\Tests;

use Bruna\TodoListMvc\Connection\ConnectionCreator;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;

class ConnectionCreatorTest extends TestCase
{
    public function testIfReturnsObject(): void
    {
        $pdo = ConnectionCreator::createEntityManager();

        $this->assertInstanceOf(EntityManager::class, $pdo);
    }
}