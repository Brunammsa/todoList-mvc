<?php

namespace Bruna\TodoListMvc\Controller;

class Error404Controller
{
    public function process(): void
    {
        http_response_code(404);
    }
}
