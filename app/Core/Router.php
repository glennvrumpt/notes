<?php

namespace App\Core;

class Router
{
    protected array $routes = [];

    public function get(string $uri, string $controller): void
    {
        $this->addRoute('GET', $uri, $controller);
    }

    public function post(string $uri, string $controller): void
    {
        $this->addRoute('POST', $uri, $controller);
    }

    public function delete(string $uri, string $controller): void
    {
        $this->addRoute('DELETE', $uri, $controller);
    }

    public function patch(string $uri, string $controller): void
    {
        $this->addRoute('PATCH', $uri, $controller);
    }

    public function put(string $uri, string $controller): void
    {
        $this->addRoute('PUT', $uri, $controller);
    }

    protected function addRoute(string $method, string $uri, string $controller): void
    {
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
        ];
    }

    public function dispatch(string $currentUri, string $currentMethod): mixed
    {
        foreach ($this->routes as $route) {
            $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_]+)', $route['uri']);
            $pattern = '#^' . $pattern . '$#';

            if (preg_match($pattern, $currentUri, $matches) && $route['method'] === $currentMethod) {
                array_shift($matches);
                return $this->callAction(
                    ...explode('@', $route['controller']),
                    ...$matches
                );
            }
        }
        throw new \Exception('No route defined for this URI.');
    }

    protected function callAction(string $controller, string $action, ...$params): mixed
    {
        $controller = "App\\Controllers\\{$controller}";
        $controller = new $controller;

        if (!method_exists($controller, $action)) {
            throw new \Exception(
                "{$controller} does not respond to the {$action} action."
            );
        }

        return $controller->$action(...$params);
    }

    protected function abort(int $code = 404): never
    {
        http_response_code($code);

        require base_path('views/' . $code . '.php');

        die();
    }
}
