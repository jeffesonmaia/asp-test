<?php

namespace ASPTest\Adapter\Command;

use ASPTest\Domain\UseCase\CreateNewUser;
use ASPTest\Domain\UseCase\Data\UserInputData;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class CreateNewUserCommand extends Command
{
    protected static $defaultName = 'USER:CREATE';
    private CreateNewUser $createNewUser;

    public function __construct(CreateNewUser $createUserPassword)
    {
        parent::__construct();
        $this->createNewUser = $createUserPassword;
    }

    protected function configure()
    {
        $this
            ->setDescription('Criar um novo usuário')
            ->setHelp("Este comando cria um novo usuário com os dados informados");
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $data = $this->getAnswers($input, $output);
            $user = $this->createNewUser->execute($data);
            $output->writeln(json_encode($user));
            return Command::SUCCESS;
        } catch (\Throwable $ex) {
            $output->writeln($ex->getMessage());
            return Command::FAILURE;
        }
    }

    private function getAnswers(InputInterface $input, OutputInterface $output): UserInputData
    {
        $helper = $this->getHelper('question');
        $question = new Question('Qual o nome?');
        $question->setValidator(function ($firstName) {
            if (strlen($firstName) === 0) {
                throw new \RuntimeException(
                    'O nome é obrigatório'
                );
            }
            return $firstName;
        });
        $question->setMaxAttempts(2);
        $name = $helper->ask($input, $output, $question);
        $question = new Question('Qual o sobrenome?');
        $question->setValidator(function ($lastName) {
            if (strlen($lastName) === 0) {
                throw new \RuntimeException(
                    'O sobrenome é obrigatório'
                );
            }
            return $lastName;
        });
        $question->setMaxAttempts(2);
        $lastName = $helper->ask($input, $output, $question);
        $question = new Question('Qual o email? ');
        $question->setValidator(function ($email) {
            if (strlen($email) === 0) {
                throw new \RuntimeException(
                    'O email é obrigatório'
                );
            }
            return $email;
        });
        $question->setMaxAttempts(2);
        $email = $helper->ask($input, $output, $question);
        $question = new Question('Qual a idade (opcional)? ', null);
        $question->setMaxAttempts(2);
        $age = $helper->ask($input, $output, $question);

        return new UserInputData($name, $lastName, $email, $age);
    }
}