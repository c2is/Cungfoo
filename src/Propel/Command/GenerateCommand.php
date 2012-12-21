<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Propel\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\ProcessBuilder;

/**
 * Runs propel-gen script
 *
 * @author Morgan Brunot <brunot.morgan@gmail.com>
 */
class GenerateCommand extends Command
{
    /**
     * @see Command
     */
    protected function configure()
    {
        $this
            ->setName('propel:generate')
            ->setDescription('Runs propel-gen script')
            ->setDefinition(array(
                new InputArgument('task', InputArgument::OPTIONAL, 'Taskname', 'main'),
            ))
            ->setHelp(<<<EOF
The <info>%command.name%</info> runs propel-gen script with main task:
  <info>%command.full_name%</info>

To change default propel task use the <info>task</info> option:
  * Generate sql structure:
    %command.full_name% <info>sql</info>

  * Generate om:
    %command.full_name% <info>om</info>

  * Insert data sql:
    %command.full_name% <info>insert-sql</info>

  * Generate migration patch (propel migration class):
    %command.full_name% <info>diff</info>

  * Migrate up:
    %command.full_name% <info>migrate</info>

  * Migrate down:
    %command.full_name% <info>migrate-down</info>
EOF
            )
        ;
    }

    /**
     * @see Command
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $builder = new ProcessBuilder(array('./vendor/bin/propel-gen', 'app/config/Propel', $input->getArgument('task')));
        $builder->setTimeout(null);
        $builder->getProcess()->run(function ($type, $buffer) use ($output) {
            if (OutputInterface::VERBOSITY_VERBOSE === $output->getVerbosity())
            {
                $output->write($buffer);
            }
        });

        $output->writeln(sprintf("Propel %s <info>success</info>", $input->getArgument('task')));
    }
}
