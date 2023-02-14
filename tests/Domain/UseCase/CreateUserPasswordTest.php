<?php

namespace ASPTest\Tests\Domain\UseCase;

use ASPTest\Domain\Exception\InvalidPasswordException;
use ASPTest\Domain\Exception\UserNotFoundException;
use ASPTest\Domain\UseCase\CreateNewUser;
use ASPTest\Domain\UseCase\CreateUserPassword;
use ASPTest\Domain\UseCase\Data\CreatePasswordInputData;
use ASPTest\Domain\UseCase\Data\CreateUserInputData;
use ASPTest\Domain\UseCase\Data\UserOutputData;
use PHPUnit\Framework\TestCase;

class CreateUserPasswordTest extends TestCase
{
    private CreateUserPassword $createUserPassword;
    private CreateNewUser $createNewUser;

    public function setUp()
    {
        $container = require __DIR__ . '/../../../config/container.php';
        $this->createNewUser = $container->get(CreateNewUser::class);
        $this->createUserPassword = $container->get(CreateUserPassword::class);
    }

    public function testShouldCreateUserPassword()
    {
        $input = CreateUserInputData::create(['firstName' => 'Jeffeson', 'lastName' => 'Pinheiro', 'email' => 'mail@mail.com']);
        $user = $this->createNewUser->execute($input);
        $this->assertInstanceOf(UserOutputData::class, $user);
        $input = CreatePasswordInputData::create(['id' => $user->getId(), 'password' => '123@Abc', 'passwordConfirmation' => '123@Abc']);
        $this->assertTrue($this->createUserPassword->execute($input));
    }

    public function testShouldNotCreateUserPasswordNotFoundUser()
    {
        $this->expectException(UserNotFoundException::class);
        $this->expectExceptionMessage('Usuário não encontrado');
        $input = CreatePasswordInputData::create(['id' => 1234, 'password' => '123@Abc', 'passwordConfirmation' => '123@Abc']);
        $this->createUserPassword->execute($input);
    }

    public function testShouldNorCreateUserPasswordWithInvalidPassword()
    {
        $this->expectException(InvalidPasswordException::class);
        $this->expectExceptionMessage('A senha deve conter no mínimo 6 caracteres, uma letra maiúscula, um número, e um caractere especial');
        $input = CreateUserInputData::create(['firstName' => 'Jeffeson', 'lastName' => 'Pinheiro', 'email' => 'mail@mail.com']);
        $user = $this->createNewUser->execute($input);
        $this->assertInstanceOf(UserOutputData::class, $user);
        $input = CreatePasswordInputData::create(['id' => $user->getId(), 'password' => '123Abc', 'passwordConfirmation' => '123Abc']);
        $this->assertTrue($this->createUserPassword->execute($input));
    }

    public function testShouldNorCreateUserPasswordWithDifferentPasswordAndConfirmation()
    {
        $this->expectException(InvalidPasswordException::class);
        $this->expectExceptionMessage('A senha e confirmação de senha devem ser iguais');
        $input = CreateUserInputData::create(['firstName' => 'Jeffeson', 'lastName' => 'Pinheiro', 'email' => 'mail@mail.com']);
        $user = $this->createNewUser->execute($input);
        $this->assertInstanceOf(UserOutputData::class, $user);
        $input = CreatePasswordInputData::create(['id' => $user->getId(), 'password' => '123@Abc', 'passwordConfirmation' => '123@Abd']);
        $this->assertTrue($this->createUserPassword->execute($input));
    }
}