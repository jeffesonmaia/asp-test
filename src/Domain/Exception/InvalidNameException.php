<?php

namespace ASPTest\Domain\Exception;

class InvalidNameException extends \InvalidArgumentException
{
    protected $message = 'O nome deve conter no mínimo 2 caracters.';
}