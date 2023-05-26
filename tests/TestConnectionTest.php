<?php

declare(strict_types=1);

namespace Bruna\TodoListMvc\tests;

use Bruna\TodoListMvc\Connection\ConnectionCreator;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../vendor/autoload.php';

class TestConnectionTest extends TestCase
{
    public function testIfReturnsObject(): void
    {
        $pdo = ConnectionCreator::createEntityManager();

        $result = is_object($pdo);

        $expect = true;

        $this->assertEquals($expect, $result);
    }
}