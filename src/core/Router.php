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

    public function get(string $path, $callback, array $middlewares = [])
    {
        $this->routers['get'][$path] = ['callback' => $callback, 'middlewares' => $middlewares];
    }

    public function post(string $path, $callback, array $middlewares = [])
    {
        $this->routers['post'][$path] = ['callback' => $callback, 'middlewares' => $middlewares];
    }

    public function dispacth()
    {
        $path = $this->request->path();
        $method = $this->request->method();
        if (!isset($this->routers[$method])) {
            throw new Exception("Method Not Allowed", 405);
        }

        foreach ($this->routers[$method] as $routeUrl => $route) {
            $pattern = preg_replace('/\{(\w+)\}/', '(\w+)', $routeUrl);
            if (preg_match('#^' . $pattern . '$#', $path, $matches)) {
                foreach ($route['middlewares'] as $middleware) {
                    $middlewareInstance = new $middleware;
                    if (method_exists($middlewareInstance, 'handle')) {
                        $middlewareResult = $middlewareInstance->handle($this->request);
                        if ($middlewareResult === false) {
                            return;
                        }
                    }
                }
                $callback = $route['callback'];
                array_shift($matches);
                if (is_array($callback)) {
                    $controller = new $callback[0];
                    $reflection = new ReflectionMethod($controller, $callback[1]);
                    $paramters = $reflection->getParameters();
                    if (!empty($paramters) && $paramters[0]->getType() instanceof ReflectionNamedType && $paramters[0]->getType()->getName() === Request::class) {
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
