<?php

namespace ASPTest\Tests\Domain\UseCase;

use ASPTest\Adapter\Repository\Database\UserRepositoryDatabase;
use ASPTest\Domain\Repository\UserRepository;
use ASPTest\Domain\UseCase\CreateNewUser;
use ASPTest\Domain\UseCase\Data\UserInputData;
use DI\Container;
use PHPUnit\Framework\TestCase;

class CreateNewUserTest extends TestCase
{
    /** @var UserRepository */
    private $userRepository;
    /** @var \PDO */
    private $pdo;
    /** @var Container */
    private $container;
    /** @var CreateNewUser */
    private $createUser;

    public function setUp()
    {
        $this->userRepository = $this->prophesize(UserRepository::class)->reveal();
        var_dump($this->userRepository instanceof UserRepositoryDatabase);
        $this->createUser = new CreateNewUser($this->userRepository);
//        $this->pdo = $this->prophesize(\PDO::class);
    }

    public function testCreateNewUser()
    {
        $input = new UserInputData('Jeffeson', "Pinheiro", 'mail@mail.com', null);
        $this->createUser->execute($input);
    }
}