<?php

declare(strict_types=1);

namespace App;

class Config
{
    protected array $config = [];

    public function __construct(array $env)
    {
        $this->config = [
            "db" => [
                'dbname' => $env["DB_SCHEMA"],
                'user' => $env["DB_USERNAME"],
                'password' => $env["DB_PASSWORD"],
                'host' => $env["DB_HOST"],
                'driver' => $env["DB_DRIVER"] ?? 'pdo_mysql'
            ],
            "mailer" => [
                "dsn" => $env["MAILER_DSN"]
            ]
        ];
    }

    public function __get(string $name)
    {
        return $this->config[$name] ?? null;
    }
}
