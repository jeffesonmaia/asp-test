<?php
declare(strict_types=1);

namespace ASPTest\Domain\UseCase\Data;

use InvalidArgumentException;

class CreatePasswordInputData
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

    public static function create(array $data): CreatePasswordInputData
    {
        if (!is_array($data)) {
            throw new InvalidArgumentException('ID, senha e confirmação de senha são obrigatórios');
        }
        if (!array_key_exists('id', $data) || !is_int($data['id'])) {
            throw new InvalidArgumentException('ID é obrigatório');
        }
        if (!array_key_exists('password', $data) || !is_string($data['password'])) {
            throw new InvalidArgumentException('Senha é obrigatório');
        }
        if (!array_key_exists('passwordConfirmation', $data) || !is_string($data['passwordConfirmation'])) {
            throw new InvalidArgumentException('Confirmação de senha é obrigatório');
        }


        return new self($data['id'], $data['password'], $data['passwordConfirmation']);
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