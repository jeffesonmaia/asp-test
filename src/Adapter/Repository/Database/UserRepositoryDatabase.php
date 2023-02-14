<?php

namespace ASPTest\Adapter\Repository\Database;

use ASPTest\Domain\Entity\User;
use ASPTest\Domain\Exception\UserNotFoundException;
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

    /**
     * @throws UserNotFoundException
     */
    function getById(int $id): User
    {
        $sql = "SELECT id, first_name, last_name, email, age FROM user WHERE ID = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([$id]);
        $result = $statement->fetch(\PDO::FETCH_ASSOC);
        if (!$result) {
            throw new UserNotFoundException("Usuário não encontrado");
        }

        return new User(
            $result['id'],
            $result['first_name'],
            $result['last_name'],
            $result['email'],
            $result['age'] ?? null
        );
    }

    function updatePassword(User $user): bool
    {
        $sql = "UPDATE user SET password = ? WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $result = $statement->execute([
            $user->getPassword()->getValue(),
            $user->getId(),
        ]);
        if ($result === null) {
            throw new \RuntimeException('Erro ao salvar o password do usuário');
        }

        return true;
    }
}