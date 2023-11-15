<?php

declare(strict_types=1);

namespace App;

use AttributesRouter\Router;
use DI\Container;

class App
{
    private static DB $db;
    private Config $config;

    public function __construct(
        protected Container $container,
        protected Router $router
    ) {
    }

    public static function db(): DB
    {
        return static::$db;
    }

    public function boot(): static
    {
        $this->config = new Config($_ENV);

        static::$db = new DB($this->config->db ?? []);

        return $this;
    }

    public function run()
    {
        $this->router->addRoutes(
            [
                HomeController::class,
                UserController::class
            ]
        );

        // If there is a match, it will return the class and method associated
        // to the request as well as route parameters
        if ($match = $this->router->match()) {
            $controller = new $match['class']();
            // $class = $container->get(get_class($controller));
            $controller->{$match['method']}($match['params']);
            // call_user_func_array([$class, $match['method']], [$match['params']]);
        } else {
            http_response_code(404);

            View::create('error/404', [
                "header" => "Not Found | " . APP_NAME
            ])->render();
        }
    }
}
