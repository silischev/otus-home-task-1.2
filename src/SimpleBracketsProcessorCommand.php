<?php

namespace Asil\Otus\HomeTask_1_2;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SimpleBracketsProcessorCommand extends Command
{
    /**
     * Configures the argument and options
     */
    protected function configure()
    {
        $this->setName('processor');
        $this->addArgument('filePath', InputArgument::REQUIRED, 'Please enter the input file path');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $path = $input->getArgument('filePath');
        if (!is_file($path)) {
            $output->writeln('File not found');
            return 0;
        }

        try {
            $line = file_get_contents($path);
            $result = (new \Asil\Otus\HomeTask_1_1\SimpleBracketsProcessor($line))->processBracketLine();

            if ($result) {
                $output->writeln('String is valid');
            } else {
                $output->writeln('String is invalid');
            }
        } catch (\LengthException|\InvalidArgumentException|\Throwable $e) {
            $output->writeln($e->getMessage());
        }

        return 1;
    }
}