<?php

namespace ASPTest\Adapter\Repository\Database;

use ASPTest\Domain\Entity\User;
use ASPTest\Domain\Repository\UserRepository;
use PDO;

class UserRepositoryDatabase implements UserRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @throws \Exception
     */
    function save(User $user): User
    {
        try {
            $sql = "INSERT INTO user (first_name, last_name, email, age) VALUES (?, ?, ?, ?)";
            $statement = $this->pdo->prepare($sql);
            $statement->execute([
                $user->getFirstName()->getValue(),
                $user->getLastName()->getValue(),
                $user->getEmail()->getValue(),
                $user->getAge()->getValue()
            ]);
            if (!$this->pdo->lastInsertId()) {
                throw new \RuntimeException('Usuário não persistido');
            }
            $user->setId((int)$this->pdo->lastInsertId());

            return $user;
        } catch (\Exception $exception) {
            throw new \Exception("Erro ao persistir usuário: " . $exception->getMessage());
        }
    }

    function getById(int $id): User
    {
        // TODO: Implement getById() method.
    }

    function updatePassword(User $user): User
    {
        // TODO: Implement updatePassword() method.
    }
}