<?php

namespace Magestudy\ConsoleCommand\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FirstTestCommand extends Command
{
    protected function configure()
    {
        $this->setName('magestudy:first_test_command')->setDescription('Same text for description');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $start = microtime(true);
        for ($index = 0; $index < 10000; $index++) {

        }
        $time = microtime(true) - $start;
        $output->writeln('First test command completed by ' . $time . ' seconds;');
    }
}