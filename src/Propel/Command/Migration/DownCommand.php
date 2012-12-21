<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Propel\Command\Migration;

use Cungfoo\Command\Command;

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
class DownCommand extends Command
{
    /**
     * @see Command
     */
    protected function configure()
    {
        $this
            ->setName('propel:migration:down')
            ->setDescription('Runs propel migration script')
        ;
    }

    /**
     * @see Command
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $nbPatchs = (int) trim(file_get_contents(sprintf("%s/migrations", $this->getProjectDirectory())));
        $output->writeln(sprintf("Propel rollback <info>%s migration(s)</info>", $nbPatchs));

        $buffer = '';
        for ($i = 0; $i < $nbPatchs; $i++)
        {
            $buffer .= $this->propelGen('migrate-down');
        }

        if (OutputInterface::VERBOSITY_VERBOSE === $output->getVerbosity())
        {
            $output->write($buffer);
        }

        $output->writeln(sprintf("Propel migrate-down <info>success</info>"));
    }

    protected function propelGen($task)
    {
        $trace = '';

        $builder = new ProcessBuilder(array('./vendor/bin/propel-gen', 'app/config/Propel', $task));
        $builder->setTimeout(null);
        $builder->getProcess()->run(function ($type, $buffer) use (&$trace) {
            $trace .= $buffer;
        });

        return $trace;
    }
}
