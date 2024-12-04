<?php

namespace App\Core;

use App\Utils\LoggerService;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class Request extends Vaildation
{
    /**
     * Initialize the Request class and set up a logger
     */
    public function __construct()
    {
        new LoggerService('RequestLogger', 'request');
    }
    /**
     * Retrieve the current URL path without query parameters
     *
     * @return string Sanitized URL path
     */
    public function path(): string
    {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '';
        $position = strpos($url, "?");
        if ($position !== false) {
            $url = substr($url, 0, $position);
        }
        $url = preg_replace('/[^a-zA-Z0-9\/\-\_]/', '', $url);
        if ($url !== '/' && substr($url, -1)) {
            $url = rtrim($url, '/');
        }
        return $url;
    }
    /**
     * Retrieve the HTTP request method in lowercase
     *
     * @return string HTTP request method (e.g., 'get', 'post')
     */
    public function method(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isGet()
    {
        return $this->method() === 'get';
    }
    public function isPost()
    {
        return $this->method() === 'post';
    }
    /**
     * Retrieve the sanitized input data from the request
     *
     * @return array Associative array of sanitized request data
     */
    public function body(): array
    {
        $data = [];

        if ($this->isGet()) {
            foreach ($_GET as $key => $value) {
                $data[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
        }

        if ($this->isPost()) {
            foreach ($_POST as $key => $value) {

                $data[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
        }

        if ($this->isPost() && !empty($_FILES)) {
            foreach ($_FILES as $key => $value) {
                $data[$key] = $value;
            }
        }

        return $data;
    }
}
