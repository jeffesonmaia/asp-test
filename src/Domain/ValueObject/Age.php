<?php
declare(strict_types=1);

namespace ASPTest\Domain\ValueObject;

use ASPTest\Domain\Exception\InvalidAgeException;

class Age
{
    /** @var int|null */
    private $value = null;

    public function __construct(?int $value = null)
    {
        if ($value !== null && $value < 0 || $value > 150) {
            throw new InvalidAgeException();
        }
        $this->value = $value;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }
}