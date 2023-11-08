<?php

declare(strict_types=1);

namespace App;

class Router
{
    private array $routes = [];

    public function __construct(private Container $container)
    {
    }

    public function register(string $requestMethod, string $route, callable|array $action): self
    {
        $this->routes[$requestMethod][$route] = $action;

        return $this;
    }

    public function get(string $route, callable|array $action): self
    {
        return $this->register("get", $route, $action);
    }

    public function post(string $route, callable|array $action): self
    {
        return $this->register("post", $route, $action);
    }

    public function put(string $route, callable|array $action): self
    {
        return $this->register("put", $route, $action);
    }

    public function patch(string $route, callable|array $action): self
    {
        return $this->register("patch", $route, $action);
    }

    public function delete(string $route, callable|array $action): self
    {
        return $this->register("delete", $route, $action);
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function resolve(string $requestUri, string $requestMethod)
    {
        $requestUri = strtok($requestUri, "?");
        $requestMethod = strtolower($requestMethod);

        $action = $this->routes[$requestMethod][urldecode($requestUri)] ?? null;

        if (! $action) {
            throw new \Exception("Route not found.");
        }

        if (is_callable($action)) {
            return call_user_func($action);
        }

        [$class, $method] = $action;

        if (class_exists($class)) {
            $class = $this->container->get($class);

            if (method_exists($class, $method)) {
                return call_user_func_array([$class, $method], []);
            }
        }

        throw new \Exception("Route not found.");
    }
}
