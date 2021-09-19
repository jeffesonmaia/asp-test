<?php

namespace ASPTest\Tests\Domain\UseCase;

use ASPTest\Adapter\Repository\Database\UserRepositoryDatabase;
use ASPTest\Domain\UseCase\CreateNewUser;
use ASPTest\Domain\UseCase\Data\CreateUserInputData;
use PDO;
use Phinx\Config\Config;
use Phinx\Console\PhinxApplication;
use Phinx\Migration\Manager;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\NullOutput;

class CreateNewUserTest extends TestCase
{

    public function setUp()
    {
        $container = require __DIR__ . '/Container/bootstrap.php';
    }

    public function testCreateNewUser()
    {
        $input = CreateUserInputData::create(['firstName' => 'Jeffeson', 'lastName' => 'Pinheiro', 'email' => 'mail@mail.com']);
        $user = $this->creatNewUser->execute($input);
        $this->assertEquals('Jeffeson', $user->getFirstName());
        $this->assertEquals('Pinheiro', $user->getLastName());
        $this->assertEquals('mail@mail.com', $user->getEmail());
        $this->assertNull($user->getAge());
    }
}