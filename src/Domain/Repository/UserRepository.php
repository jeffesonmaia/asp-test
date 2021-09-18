<?php
declare(strict_types=1);

namespace ASPTest\Domain\Repository;

use ASPTest\Domain\Entity\User;

interface UserRepository
{
    function save(User $user): User;

    function getById(int $id): User;

    function updatePassword(User $user): User;
}