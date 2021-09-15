<?php
declare(strict_types=1);

use ASPTest\Adapter\Repository\Database\UserRepositoryDatabase;
use ASPTest\Domain\Repository\UserRepository;
use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        PDO::class => function (ContainerInterface $container) {
            $config = $container->get('settings')['db'];

            return new \PDO("mysql:host={$config['host']};dbname={$config['dbname']}", $config['user'], $config['password']);
        },
    ]);

    $containerBuilder->addDefinitions([
        UserRepository::class => \DI\autowire(UserRepositoryDatabase::class),
    ]);
};