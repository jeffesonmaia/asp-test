<?php
declare(strict_types=1);

namespace ASPTest\Domain\Entity;

use ASPTest\Domain\ValueObject\Age;
use ASPTest\Domain\ValueObject\Email;
use ASPTest\Domain\ValueObject\Name;
use ASPTest\Domain\ValueObject\Password;

class User
{
    /** @var int */
    private $id;
    /** @var Name */
    private $firstName;
    /** @var Name */
    private $lastName;
    /** @var Email */
    private $email;
    /** @var Age */
    private $age;
    /** @var Password */
    private $password;

    public function __construct(?int $id, string $firstName, string $lastName, string $email, ?int $age)
    {
        $this->id = $id;
        $this->firstName = new Name($firstName);
        $this->lastName = new Name($lastName);
        $this->email = new Email($email);
        $this->age = new Age($age);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
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