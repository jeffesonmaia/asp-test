<?php
declare(strict_types=1);

namespace ASPTest\Domain\ValueObject;

use ASPTest\Domain\Exception\InvalidNameException;

class Name
{
    /** @var string */
    private $value;

    public function __construct(string $value)
    {
        if (strlen($value) < 2 || strlen($value) > 35) {
            throw new InvalidNameException();
        }
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}