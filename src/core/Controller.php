<?php

namespace App\Core;

use Exception;

class Controller
{
    private array $headers = [];
    public string $layout = 'main';
    public function setHeadres(string $key, string $value): void
    {
        $this->headers[$key] = $value;
    }
    public function sendHeader(): void
    {
        foreach ($this->headers as $key => $value) {
            header("$key:$value");
        }
    }


    public function renderView(string $view, array $data = [])
    {
        $this->sendHeader();
        $rv = $this->renderOnlyView($view, $data);
        $rl = $this->renderLayout();
        return str_replace("{{content}}", $rv, $rl);
    }

    private function renderLayout()
    {
        ob_start();
        $this->includeFileIfExists(__DIR__ . "/../view/layouts/{$this->layout}.php");
        return ob_get_clean();
    }
    private function renderOnlyView(string $view, array $data = [])
    {
        extract($data);
        ob_start();
        $this->includeFileIfExists(__DIR__ . "/../view/$view.php");
        return ob_get_clean();
    }

    private function includeFileIfExists($file)
    {
        if (!file_exists($file)) {
            throw new Exception("Error Not Found File $file", 1);
        }
        include $file;
    }
}
