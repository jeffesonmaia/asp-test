<?php
declare(strict_types=1);

namespace ASPTest\Domain\ValueObject;

class Name
{
    /** @var string */
    private $value;

    public function __construct(string $value)
    {
        if (strlen($value) < 2 || strlen($value) > 35) {
            throw new \Error('O nome deve conter no mínimo 2 caracters.');
        }
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}