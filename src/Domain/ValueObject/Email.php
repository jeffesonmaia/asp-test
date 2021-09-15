<?php

namespace ASPTest\Domain\ValueObject;

class Email
{
    /** @var string */
    private $value;

    public function __construct(string $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new \Error('Email inválido');
        }
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}