<?php

declare(strict_types=1);

namespace App;

class App
{
    public static Container $container;

    public function __construct(
        protected Router $router,
        protected array $request
    ) {
    }

    public function run(): void
    {
        try {
            $this->router->resolve(
                $this->request["uri"],
                $this->request["method"]
            );
        } catch (\Exception) {
            http_response_code(404);

            View::create('error/404', [
                "header" => "Not Found | " . APP_NAME
            ])->render();
        }

    }
}
