<?php

declare(strict_types=1);

namespace Bruna\TodoListMvc\Traits;

trait HtmlRendererTrait
{
    private function renderTemplate(string $templateName, array $context = []): string
    {
        $templatePath =  __DIR__ . '/../../views/task/';

        extract($context);
        ob_start();

        require_once $templatePath . $templateName . '.php';

        return ob_get_clean();
    }
}
