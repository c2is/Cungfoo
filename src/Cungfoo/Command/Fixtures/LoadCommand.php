<?php
/**
 * Configuration of our application
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 *
 * @package Cungfoo by C2IS
 */

namespace Cungfoo\Command\Fixtures;

use Cungfoo\Command\Command as BaseCommand;

use Symfony\Component\Console\Input\InputArgument,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Input\ArrayInput,
    Symfony\Component\Console\Input\InputOption,
    Symfony\Component\Console\Output\OutputInterface,
    Symfony\Component\Filesystem\Filesystem,
    Symfony\Component\Yaml\Yaml;

class LoadCommand extends BaseCommand
{
    protected function configure()
    {
        $this
            ->setName('fixtures:load')
            ->setDescription('Load project fixtures')
            ->addOption('directory', 'dir', InputOption::VALUE_OPTIONAL, 'Give a output directory.', '/app/resources/data/fixtures')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $commands = array(
            array('command' => 'propel:fixture:load'),
            array('command' => 'fixture:load:binaries'),
        );

        foreach ($commands as $command)
        {
            if ($this->getApplication()->find($command['command'])->run(new ArrayInput($command), $output) === false)
            {
                return false;
            }
        }

        return true;
    }
}