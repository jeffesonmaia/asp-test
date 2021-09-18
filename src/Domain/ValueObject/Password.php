<?php
declare(strict_types=1);

namespace ASPTest\Domain\ValueObject;

class Password
{
    private $key = 'ASPTest';
    private $cost = 10;

    /** @var string */
    private $value;

    public function __construct(string $value, string $valueConfirmation)
    {
        if (!preg_match('/^\S*(?=\S{6,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[^\w])\S*$/', $value)) {
            throw new \Error('A senha deve conter no mínimo 6 caracteres, uma letra maiúscula, um número, e um caractere especial');
        }
        if ($value !== $valueConfirmation) {
            throw new \Error('A senha e confirmação de senha devem ser iguais');
        }
        $this->value = crypt($value, $this->generateSalt($value));
    }

    private function generateSalt(string $value): string
    {
        $mcrypt = $this->generateHashMcrypt($value);
        $hashMcrypt = base64_encode($mcrypt);

        return sprintf('$2a$%d$%s',
            $this->cost,
            substr(strtr($hashMcrypt, '+', '.'), 0, 22)
        );
    }

    private function generateHashMcrypt(string $value): string
    {
        return mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->key, $value, MCRYPT_MODE_ECB);
    }

    public function getValue(): ?int
    {
        return $this->value;
    }
}