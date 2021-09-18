<?php
declare(strict_types=1);

namespace ASPTest\Domain\UseCase;

use ASPTest\Domain\Repository\UserRepository;
use ASPTest\Domain\UseCase\Data\PasswordInputData;

class CreatePassword
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(PasswordInputData $passwordInputData): void
    {
        $user = $this->userRepository->getById($passwordInputData->getId());
        $user->setPassword($passwordInputData->getPassword(), $passwordInputData->getPasswordConfirmation());
        $this->userRepository->updatePassword($user);
    }
}