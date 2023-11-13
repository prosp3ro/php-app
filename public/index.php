<?php

declare(strict_types=1);

use App\Controllers\HomeController;
use App\Controllers\UserController;
use App\Enums\OrderStatusesEnum;
use AttributesRouter\Router;
use Doctrine\DBAL\DriverManager;
use Dotenv\Dotenv;
use Illuminate\Database\Capsule\Manager as Capsule;

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

// $capsule = new Capsule();

// $capsule->addConnection(
//     [
//         "driver" => $_ENV["DB_DRIVER"] ?? "mysql",
//         "host" => $_ENV["DB_HOST"],
//         "database" => $_ENV["DB_SCHEMA"],
//         "username" => $_ENV["DB_USERNAME"],
//         "password" => $_ENV["DB_PASSWORD"],
//         "charset" => "utf8",
//         "collation" => "utf8_unicode_ci",
//         "prefix" => ""
//     ]
// );

// $capsule->setAsGlobal();
// $capsule->bootEloquent();

// $container = new DI\Container();

// (new HomeController)->order(OrderStatusesEnum::PAID);
// die();
// dd((new ReadOnlyPropertyExample("street", "city", "state", "123", "country"))->street);

$doctrineConnectionParams = [
    'dbname' => $_ENV["DB_SCHEMA"],
    'user' => $_ENV["DB_USERNAME"],
    'password' => $_ENV["DB_PASSWORD"],
    'host' => $_ENV["DB_HOST"],
    'driver' => $_ENV["DB_DRIVER"] ?? 'pdo_mysql'
];

$doctrineConnection = DriverManager::getConnection($doctrineConnectionParams);

$queryBuilder = $doctrineConnection->createQueryBuilder();

$result = $queryBuilder->select("*")->from("test")->executeQuery()->fetchAllAssociative();

// $query = $queryBuilder
//     ->select('id', 'email', 'password')
//     ->from('User', 'u')
//     ->where('email = :email')
//     ->setParameter('email', $email)
//     ->getQuery();

// $result = $query->getOneOrNullResult();

dd($result);

$router = new Router(
    [
        HomeController::class,
        UserController::class
    ]
);

// If there is a match, it will return the class and method associated
// to the request as well as route parameters
if ($match = $router->match()) {
    $controller = new $match['class']();
    $controller->{$match['method']}($match['params']);
}
