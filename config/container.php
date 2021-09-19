<?php
declare(strict_types=1);

use ASPTest\Adapter\Repository\Database\UserRepositoryDatabase;
use ASPTest\Domain\Repository\UserRepository;
use ASPTest\Domain\UseCase\CreateNewUser;
use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;

$container = new ContainerBuilder();
$container->addDefinitions([
    'settings' => [
        'db' => [
            'host' => getenv('MYSQL_HOST'),
            'dbname' => getenv('MYSQL_DATABASE'),
            'user' => getenv('MYSQL_USER'),
            'password' => getenv('MYSQL_PASSWORD'),
        ]
    ],
    PDO::class => function (ContainerInterface $container) {
        $config = $container->get('settings')['db'];
        return new \PDO("mysql:host={$config['host']};dbname={$config['dbname']}", $config['user'], $config['password']);
    },
    UserRepository::class => DI\create(UserRepositoryDatabase::class)
        ->constructor(Di\get(PDO::class)),
    CreateNewUser::class => DI\create(CreateNewUser::class)
        ->constructor(Di\get(UserRepository::class)),
]);

return $container->build();