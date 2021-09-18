<?php
declare(strict_types=1);

namespace ASPTest\Domain\UseCase\Data;

class PasswordInputData
{
    private int $id;
    private string $password;
    private string $passwordConfirmation;

    public function __construct(int $id, string $password, string $passwordConfirmation)
    {
        $this->id = $id;
        $this->password = $password;
        $this->passwordConfirmation = $passwordConfirmation;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getPasswordConfirmation(): string
    {
        return $this->passwordConfirmation;
    }
}