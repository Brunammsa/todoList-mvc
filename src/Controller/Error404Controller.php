<?php

namespace Bruna\TodoListMvc\Controller;

use Bruna\TodoListMvc\Interface\IController;

class Error404Controller implements IController
{
    public function process(): void
    {
        http_response_code(404);
    }
}
