<?php

namespace ASPTest\Domain\Exception;

class InvalidPasswordException extends \InvalidArgumentException
{
    protected $message = 'A senha deve conter no mínimo 6 caracteres, uma letra maiúscula, um número, e um caractere especial';
}