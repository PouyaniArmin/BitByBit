<?php

namespace App\Core;

use App\Utils\LoggerService;
use Exception;

class Controller
{
    private array $headers = [];
    public string $layout = 'main';
    /**
     * Constructor.
     * Initializes the logger for the Controller.
     */
    public function __construct()
    {
        new LoggerService('ControllerLogger', 'controller');
    }
    /**
     * Set an HTTP header.
     *
     * @param string $key - The header name (e.g., 'Content-Type').
     * @param string $value - The header value (e.g., 'application/json').
     */
    public function setHeaders(string $key, string $value): void
    {
        $this->headers[$key] = $value;
    }
    /**
     * Send all HTTP headers that have been set.
     */
    public function sendHeader(): void
    {
        foreach ($this->headers as $key => $value) {
            header("$key:$value");
        }
    }

    /**
     * Render a view with an optional layout.
     *
     * @param string $view - The view file to render (relative to the views directory).
     * @param array $data - Data to pass to the view (associative array).
     * @return string - Rendered HTML content.
     */
    public function renderView(string $view, array $data = [])
    {
        $this->sendHeader();
        $rv = $this->renderOnlyView($view, $data);
        $rl = $this->renderLayout();
        return str_replace("{{content}}", $rv, $rl);
    }

    /**
     * Render the layout template.
     *
     * @return string - Rendered layout content.
     */
    private function renderLayout()
    {
        ob_start();
        include __DIR__ . "/../view/layouts/{$this->layout}.php";
        return ob_get_clean();
    }
    /**
     * Render the main content of a view.
     *
     * @param string $view - The view file to render.
     * @param array $data - Data to pass to the view.
     * @return string - Rendered view content.
     */
    private function renderOnlyView(string $view, array $data = [])
    {
        extract($data);
        ob_start();
        include __DIR__ . "/../view/$view.php";
        return ob_get_clean();
    }
    /**
     * Redirect to a different URL.
     *
     * @param string $url - The URL to redirect to.
     */
    public function redierctTo($url)
    {
        header('Location:' . $url);
        exit;
    }
}
