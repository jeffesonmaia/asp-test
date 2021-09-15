<?php

class UserOutputData
{
    /** @var int */
    private $id;
    /** @var string $firstName */
    private $firstName;
    /** @var string $lastName */
    private $lastName;
    /** @var string $email */
    private $email;
    /** @var int $age */
    private $age;

    public function __construct(int $id, string $firstName, string $lastName, string $email, ?int $age)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->age = $age;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }
}
