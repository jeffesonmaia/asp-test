<?php

namespace ASPTest\Adapter\Command;

use ASPTest\Domain\UseCase\CreateUserPassword;
use ASPTest\Domain\UseCase\Data\CreatePasswordInputData;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class CreateUserPasswordCommand extends Command
{
    protected static $defaultName = 'USER:CREATE-PWD';
    private CreateUserPassword $createUserPassword;

    public function __construct(CreateUserPassword $createUserPassword)
    {
        parent::__construct();
        $this->createUserPassword = $createUserPassword;
    }

    protected function configure()
    {
        $this
            ->setDescription('Criar senha para um usuário')
            ->addArgument('ID', InputArgument::REQUIRED, 'Id do usuário')
            ->setHelp("Este comando cria uma senha para o usuário informado");
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $data = $this->getAnswers($input, $output);
            $this->createUserPassword->execute($data);
            $output->writeln('Senha criada.');
            return Command::SUCCESS;
        } catch (\Throwable $ex) {
            $output->writeln($ex->getMessage());
            return Command::FAILURE;
        }
    }

    private function getAnswers(InputInterface $input, OutputInterface $output): CreatePasswordInputData
    {
        $id = $input->getArgument('ID');
        $helper = $this->getHelper('question');
        $question = new Question('Qual a senha? ');
        $question->setValidator(function ($password) {
            if (strlen($password) === 0) {
                throw new \RuntimeException(
                    'A senha é obrigatório'
                );
            }
            return $password;
        });
        $question->setHidden(true);
        $question->setMaxAttempts(10);
        $password = $helper->ask($input, $output, $question);
        $question = new Question('Informe a senha novamente!');
        $question->setValidator(function ($passwordConfirmation) {
            if (strlen($passwordConfirmation) === 0) {
                throw new \RuntimeException(
                    'A Confirmação da senha é obrigatório'
                );
            }
            return $passwordConfirmation;
        });
        $question->setHidden(true);
        $question->setMaxAttempts(10);
        $passwordConfirmation = $helper->ask($input, $output, $question);

        return new CreatePasswordInputData($id, $password, $passwordConfirmation);
    }
}