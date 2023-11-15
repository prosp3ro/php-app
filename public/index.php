<?php

declare(strict_types=1);

use App\App;
use AttributesRouter\Router;
use Dotenv\Dotenv;

define('ROOT', dirname(__DIR__));
define('PARTIALS', ROOT . "/templates/partials");
define('STORAGE_PATH', ROOT . "/storage");
define('VIEW_PATH', ROOT . "/templates/views");
define('APP_NAME', $_ENV["APP_NAME"] ?? "App");

require_once ROOT . "/vendor/autoload.php";

$repository = \Dotenv\Repository\RepositoryBuilder::createWithNoAdapters()
    ->addAdapter(\Dotenv\Repository\Adapter\EnvConstAdapter::class)
    ->addWriter(\Dotenv\Repository\Adapter\PutenvAdapter::class)
    ->immutable()
    ->make();

$dotenv = Dotenv::create($repository, ROOT);
$dotenv->load();

include_once ROOT . "/utils/debug.php";

set_exception_handler(
    function (Throwable $exception) {
        if (is_callable("showException")) {
            showException($exception);
        }
    }
);

ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

session_set_cookie_params(
    [
        "lifetime" => 86400 * 7,
        "domain" => "127.0.0.3",
        "path" => "/",
        "secure" => true,
        "httponly" => true
    ]
);

session_start();

// (new HomeController)->order(OrderStatusesEnum::PAID);
// dd((new ReadOnlyPropertyExample("street", "city", "state", "123", "country"))->street);

$container = new DI\Container();
$router = new Router();

(new App($container, $router))->boot()->run();
