<?php
declare(strict_types=1);

use ASPTest\Adapter\Repository\Database\UserRepositoryDatabase;
use ASPTest\Domain\Repository\UserRepository;
use ASPTest\Domain\UseCase\CreateNewUser;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        UserRepository::class => DI\create(UserRepositoryDatabase::class)
            ->constructor(Di\get(PDO::class)),
        CreateNewUser::class => DI\create(CreateNewUser::class)
            ->constructor(Di\get(UserRepository::class)),
    ]);
};