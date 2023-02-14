<?php

namespace ASPTest\Domain\UseCase\Data;

use InvalidArgumentException;

class CreateUserInputData
{
    private string $firstName;
    private string $lastName;
    private string $email;
    private ?int $age;

    public function __construct(string $firstName, string $lastName, string $email, ?int $age)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->age = $age;
    }

    public static function create(array $data): CreateUserInputData
    {
        if (!is_array($data)) {
            throw new InvalidArgumentException('Nome, Sobrenome e email são obrigatórios');
        }
        if (!array_key_exists('firstName', $data) || !is_string($data['firstName'])) {
            throw new InvalidArgumentException('Nome é obrigatório');
        }
        if (!array_key_exists('lastName', $data) || !is_string($data['lastName'])) {
            throw new InvalidArgumentException('Sobrenome é obrigatório');
        }
        if (!array_key_exists('email', $data) || !is_string($data['email'])) {
            throw new InvalidArgumentException('Email é obrigatório');
        }

        return new self($data['firstName'], $data['lastName'], $data['email'], $data['age'] ?? null);
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
