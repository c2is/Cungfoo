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
class UpCommand extends Command
{
    /**
     * @see Command
     */
    protected function configure()
    {
        $this
            ->setName('propel:migration:up')
            ->setDescription('Runs propel migration script')
        ;
    }

    /**
     * @see Command
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // génération du fichier qui inidique le nombre de patchs executés lors d'un déploiement
        $buffer = $this->propelGen('status');

        preg_match("/\[propel-migration-status\] ([1-9*]) migrations? needs? to be executed/", $buffer, $matches);

        $nbPatchs = 0;
        if (count($matches) > 1)
        {
            $nbPatchs = (int) $matches[1];
        }

        file_put_contents(sprintf("%s/migrations", $this->getProjectDirectory()), $nbPatchs);
        $output->writeln(sprintf("Propel passed <info>%s migration(s)</info>", $nbPatchs));

        $buffer = $this->propelGen('migrate');
        if (OutputInterface::VERBOSITY_VERBOSE === $output->getVerbosity())
        {
            $output->write($buffer);
        }

        $output->writeln(sprintf("Propel %s <info>success</info>", 'up'));
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
