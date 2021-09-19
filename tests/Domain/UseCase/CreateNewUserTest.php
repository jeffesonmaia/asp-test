<?php

namespace ASPTest\Tests\Domain\UseCase;

use ASPTest\Domain\Exception\InvalidAgeException;
use ASPTest\Domain\Exception\InvalidEmailException;
use ASPTest\Domain\Exception\InvalidNameException;
use ASPTest\Domain\UseCase\CreateNewUser;
use ASPTest\Domain\UseCase\Data\CreateUserInputData;
use PHPUnit\Framework\TestCase;

class CreateNewUserTest extends TestCase
{
    private CreateNewUser $createNewUser;

    public function setUp()
    {
        $container = require __DIR__ . '/../../../config/container.php';
        $this->createNewUser = $container->get(CreateNewUser::class);
    }

    public function testShouldCreateUserWithoutAge()
    {
        $input = CreateUserInputData::create(['firstName' => 'Jeffeson', 'lastName' => 'Pinheiro', 'email' => 'mail@mail.com']);
        $user = $this->createNewUser->execute($input);
        $this->assertEquals('Jeffeson', $user->getFirstName());
        $this->assertEquals('Pinheiro', $user->getLastName());
        $this->assertEquals('mail@mail.com', $user->getEmail());
        $this->assertNull($user->getAge());
    }

    public function testShouldCreateUserWithAge()
    {
        $input = CreateUserInputData::create(['firstName' => 'Jeffeson', 'lastName' => 'Pinheiro', 'email' => 'mail@mail.com', 'age' => 19]);
        $user = $this->createNewUser->execute($input);
        $this->assertEquals('Jeffeson', $user->getFirstName());
        $this->assertEquals('Pinheiro', $user->getLastName());
        $this->assertEquals('mail@mail.com', $user->getEmail());
        $this->assertEquals(19, $user->getAge());
    }

    public function testShouldNotCreateUserWithAInvalidEmail()
    {
        $this->expectException(InvalidEmailException::class);
        $this->expectExceptionMessage('Email inválido');
        $input = CreateUserInputData::create(['firstName' => 'Jeffeson', 'lastName' => 'Pinheiro', 'email' => 'mail@mail']);
        $this->createNewUser->execute($input);
    }

    public function testShouldNotCreateUserWithAInvalidFirstName()
    {
        $this->expectException(InvalidNameException::class);
        $this->expectExceptionMessage('O nome deve conter no mínimo 2 caracters.');
        $input = CreateUserInputData::create(['firstName' => 'J', 'lastName' => 'Pinheiro', 'email' => 'mail@mail.com']);
        $this->createNewUser->execute($input);
    }

    public function testShouldNotCreateUserWithAInvalidLastName()
    {
        $this->expectException(InvalidNameException::class);
        $this->expectExceptionMessage('O nome deve conter no mínimo 2 caracters.');
        $input = CreateUserInputData::create(['firstName' => 'Jeffeson', 'lastName' => 'P', 'email' => 'mail@mail.com']);
        $this->createNewUser->execute($input);
    }

    public function testShouldNotCreateUserWithAInvalidAge()
    {
        $this->expectException(InvalidAgeException::class);
        $this->expectExceptionMessage('Idade inválida.');
        $input = CreateUserInputData::create(['firstName' => 'Jeffeson', 'lastName' => 'Pinheiro', 'email' => 'mail@mail.com', 'age' => 190]);
        $this->createNewUser->execute($input);
    }
}