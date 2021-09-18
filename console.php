<?php
require __DIR__ . '/vendor/autoload.php';

use ASPTest\Adapter\Repository\Database\UserRepositoryDatabase;
use DI\ContainerBuilder;


$containerBuilder = new ContainerBuilder();
$containerBuilder->useAutowiring(false);
$containerBuilder->useAnnotations(false);

// Set up settings
$config = require __DIR__ . '/config.php';
$config($containerBuilder);

// Set up settings
$settings = require __DIR__ . '/dependencies.php';
$settings($containerBuilder);

// Set up settings
$repositories = require __DIR__ . '/repositories.php';
$repositories($containerBuilder);

$container = $containerBuilder->build();

$config = $container->get(UserRepositoryDatabase::class);
var_dump($config);