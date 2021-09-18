<?php
declare(strict_types=1);

use ASPTest\Adapter\Repository\UserRepositoryDatabase;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
//        UserRepositoryDatabase::class => function (ContainerInterface $container) {
//            $userRepositoryDatabase = new UserRepositoryDatabase($container->get(PDO::class));
//            var_dump($userRepositoryDatabase);
//            return $userRepositoryDatabase;
//        },
        UserRepositoryDatabase::class => DI\create()
            ->constructor(DI\get(PDO::class)),
    ]);
};