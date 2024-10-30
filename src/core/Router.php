<?php

namespace App\Core;

use Exception;
use Reflection;
use ReflectionMethod;
use ReflectionNamedType;

class Router
{
    protected Request $request;
    public array $routers = [];
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function get(string $path, $callback)
    {
        $this->routers['get'][$path] = $callback;
    }

    public function post(string $path, $callback)
    {
        $this->routers['post'][$path] = $callback;
    }

    public function dispacth()
    {
        $path = $this->request->path();
        $method = $this->request->method();
        if (!isset($this->routers[$method])) {
            throw new Exception("Method Not Allowed", 405);
        }
        foreach ($this->routers[$method] as $routeUrl => $callback) {
            $pattern = preg_replace('/\{(\w+)\}/', '(\w+)', $routeUrl);
            if (preg_match('#^' . $pattern . '$#', $path, $matches)) {
                // Pass the captured parameter values as named arguments to the target function
                array_shift($matches); // Only keep named subpattern matches
                if (is_array($callback)) {
                    $controller = new $callback[0];
                    $reflection = new ReflectionMethod($controller, $callback[1]);
                    $paramters = $reflection->getParameters();
                    if (!empty($paramters) && $paramters[0]->gettype() instanceof ReflectionNamedType && $paramters[0]->getType()->getName() === Request::class) {
                        return call_user_func([$controller, $callback[1]], $this->request);
                    } else {
                        return call_user_func_array([$controller, $callback[1]], $matches);
                    }
                }
                if (is_callable($callback)) {
                    return call_user_func($callback);
                }
            }
        }
        throw new Exception("Not Found Page 404", 1);
    }
}
