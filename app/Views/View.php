<?php

namespace App\Views;

use App\Exceptions\PageNotFoundException;

class View
{
    public function __construct(private string $view, private array $parameters = [])
    {
    }

    public static function make(string $view, array $parameters = []): static
    {
        return new static($view, $parameters);
    }

    public function render(): string
    {
        $viewPath = VIEW_PATH . '/' .  $this->view . '.php';
    
        if (!file_exists($viewPath)) {
            throw new PageNotFoundException();
        }

        foreach ($this->parameters as $key => $value) {
            $$key = $value;
        }

        ob_start();

        include $viewPath;

        return (string) ob_get_clean();
    }
}
