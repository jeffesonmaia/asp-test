<?php

class PasswordInputData
{
    /** @var int */
    private $id;
    /** @var string */
    private $password;
    /** @var string */
    private $passwordConfirmation;

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