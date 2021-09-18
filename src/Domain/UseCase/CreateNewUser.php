<?php
declare(strict_types=1);

namespace ASPTest\Domain\UseCase;

use ASPTest\Domain\Entity\User;
use ASPTest\Domain\Repository\UserRepository;
use ASPTest\Domain\UseCase\Data\UserInputData;
use ASPTest\Domain\UseCase\Data\UserOutputData;

class CreateNewUser
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(UserInputData $createUserInputData): UserOutputData
    {
        $user = new User(
            null,
            $createUserInputData->getFirstName(),
            $createUserInputData->getLastName(),
            $createUserInputData->getEmail(),
            $createUserInputData->getAge()
        );
        $this->userRepository->save($user);

        return new UserOutputData(
            $user->getId(),
            $user->getFirstName()->getValue(),
            $user->getLastName()->getValue(),
            $user->getEmail()->getValue(),
            $user->getAge()->getValue()
        );
    }
}