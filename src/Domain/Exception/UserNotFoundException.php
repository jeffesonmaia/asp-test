<?php

namespace ASPTest\Domain\Exception;

use Exception;

class UserNotFoundException extends Exception
{
    protected $message = 'Usuário não encontrado';
}