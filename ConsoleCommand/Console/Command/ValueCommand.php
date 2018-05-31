<?php

namespace Magestudy\ConsoleCommand\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ValueCommand extends Command
{
    const COMMAND_NAME = 'magestudy:fullname';
    const INPUT_KEY_FIRSTNAME = 'firstname';
    const INPUT_KEY_LASTNAME = 'lastname';

    protected function configure()
    {
        $this->setName(self::COMMAND_NAME)->setDescription('Show your fullname');
        $this->addArgument(self::INPUT_KEY_FIRSTNAME, InputArgument::REQUIRED, __('Type a string'));
        $this->addArgument(self::INPUT_KEY_LASTNAME, InputArgument::REQUIRED, __('Type a string'));
        parent::configure();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $firstName = $input->getArgument(self::INPUT_KEY_FIRSTNAME);
            $lastName = $input->getArgument(self::INPUT_KEY_LASTNAME);
            $output->writeln('Your full name is: ' . $firstName . ' ' . $lastName);
        } catch (\Exception $e) {
            $output->writeln('<error>' . $e->getMessage() . '</error>');
        }
    }
}

