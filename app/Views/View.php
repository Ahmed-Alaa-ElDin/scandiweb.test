<?php

namespace App\Views;

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
        ob_start();

        $viewPath = VIEW_PATH . '/' .  $this->view . '.php';

        include $viewPath;

        return (string) ob_get_clean();
    }
}
