<?php

namespace App\Core;

use App\Utils\LoggerService;
use Exception;
use Reflection;
use ReflectionMethod;
use ReflectionNamedType;

class Router
{
    protected Request $request;
    public array $routers = [];

    /**
     * Initializes the Router class and sets up a logger
     *
     * @param Request $request The HTTP request object
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        new LoggerService('RouterLogger', 'router');
    }
    /**
     * Registers a GET route with its callback and optional middlewares
     *
     * @param string $path Route path (e.g., '/users/{id}')
     * @param callable|array $callback Callback function or controller action
     * @param array $middlewares List of middleware classes to execute before the route
     */
    public function get(string $path, $callback, array $middlewares = [])
    {
        $this->routers['get'][$path] = ['callback' => $callback, 'middlewares' => $middlewares];
    }
    /**
     * Registers a POST route with its callback and optional middlewares
     *
     * @param string $path Route path (e.g., '/users')
     * @param callable|array $callback Callback function or controller action
     * @param array $middlewares List of middleware classes to execute before the route
     */
    public function post(string $path, $callback, array $middlewares = [])
    {
        $this->routers['post'][$path] = ['callback' => $callback, 'middlewares' => $middlewares];
    }
    /**
     * Dispatches the current request to the appropriate route
     *
     * @throws Exception If the HTTP method is not allowed or the route is not found
     */
    public function dispacth()
    {
        $path = $this->request->path();
        $method = $this->request->method();
        // Check if the HTTP method is supported
        if (!isset($this->routers[$method])) {
            throw new Exception("Method Not Allowed", 405);
        }
        // Iterate over the routes for the current HTTP method
        foreach ($this->routers[$method] as $routeUrl => $route) {
            // Convert route placeholders (e.g., {id}) to regex patterns
            $pattern = preg_replace('/\{(\w+)\}/', '(\w+)', $routeUrl);
            // Match the route pattern with the current request path
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
                // Remove the full match from the matches array
                array_shift($matches);
                // Handle controller callbacks
                if (is_array($callback)) {
                    $controller = new $callback[0];
                    $reflection = new ReflectionMethod($controller, $callback[1]);
                    $paramters = $reflection->getParameters();
                    // Check if the first parameter is a Request object
                    if (!empty($paramters) && $paramters[0]->getType() instanceof ReflectionNamedType && $paramters[0]->getType()->getName() === Request::class) {
                        return call_user_func([$controller, $callback[1]], $this->request);
                    } else {
                        return call_user_func_array([$controller, $callback[1]], $matches);
                    }
                }
                // Handle callable (e.g., closures or functions) callbacks
                if (is_callable($callback)) {
                    return call_user_func($callback);
                }
            }
        }
        // Route not found: Send a 404 response
        http_response_code(404);
        require __DIR__ . "/../view/notfound.php";
    }
}
