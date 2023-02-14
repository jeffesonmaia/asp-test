<?php
declare(strict_types=1);

namespace ASPTest\Domain\UseCase;

use ASPTest\Domain\Repository\UserRepository;
use ASPTest\Domain\UseCase\Data\CreatePasswordInputData;

class CreateUserPassword
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(CreatePasswordInputData $passwordInputData): bool
    {
        $user = $this->userRepository->getById($passwordInputData->getId());
        $user->setPassword($passwordInputData->getPassword(), $passwordInputData->getPasswordConfirmation());
        return $this->userRepository->updatePassword($user);
    }
}