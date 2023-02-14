<?php
declare(strict_types=1);

namespace ASPTest\Domain\ValueObject;

use ASPTest\Domain\Exception\InvalidEmailException;

class Email
{
    private string $value;

    public function __construct(string $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException();
        }
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}