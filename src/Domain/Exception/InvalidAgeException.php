<?php

namespace ASPTest\Domain\Exception;

class InvalidAgeException extends \InvalidArgumentException
{
    protected $message = 'Idade inválida.';
}