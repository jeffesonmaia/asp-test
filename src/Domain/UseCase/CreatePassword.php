<?php

use ASPTest\Domain\Repository\UserRepository;

class CreatePassword
{
    /** @var UserRepository */
    private $userRepository;

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