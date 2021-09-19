<?php
require __DIR__ . '/vendor/autoload.php';

use ASPTest\Adapter\Command\CreateNewUserCommand;
use ASPTest\Domain\UseCase\CreateNewUser;
use DI\ContainerBuilder;
use Symfony\Component\Console\Application;


$containerBuilder = new ContainerBuilder();
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

$container->get(CreateNewUser::class);
$application = new Application();
$application->add(new CreateNewUserCommand(
    $container->get(CreateNewUser::class),
));
$application->run();