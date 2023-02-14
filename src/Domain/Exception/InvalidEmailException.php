<?php

namespace ASPTest\Domain\Exception;

class InvalidEmailException extends \InvalidArgumentException
{
    protected $message = 'Email inválido';
}