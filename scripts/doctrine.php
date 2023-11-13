<?php

declare(strict_types=1);

use Doctrine\DBAL\DriverManager;
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

$schema = $doctrineConnection->createSchemaManager();

// var_dump($result);

var_dump($schema->listTableColumns("emails"));
