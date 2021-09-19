<?php
declare(strict_types=1);

namespace ASPTest\Domain\Entity;

use ASPTest\Domain\UseCase\Data\CreateUserInputData;
use ASPTest\Domain\ValueObject\Age;
use ASPTest\Domain\ValueObject\Email;
use ASPTest\Domain\ValueObject\Name;
use ASPTest\Domain\ValueObject\Password;

class User
{
    private ?int $id;
    private Name $firstName;
    private Name $lastName;
    private Email $email;
    private Age $age;
    private Password $password;

    public function __construct(?int $id, CreateUserInputData $createUserInputData)
    {
        $this->id = $id;
        $this->firstName = new Name($createUserInputData->getFirstName());
        $this->lastName = new Name($createUserInputData->getLastName());
        $this->email = new Email($createUserInputData->getEmail());
        $this->age = new Age($createUserInputData->getAge());
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): Name
    {
        return $this->firstName;
    }

    public function getLastName(): Name
    {
        return $this->lastName;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getAge(): ?Age
    {
        return $this->age;
    }

    public function getPassword(): Password
    {
        return $this->password;
    }

    public function setPassword(string $password, string $passwordConfirmation): void
    {
        $this->password = new Password($password, $passwordConfirmation);
    }
}