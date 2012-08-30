<?php
namespace Cungfoo\Command\Project;

use Cungfoo\Command\Command;

use Symfony\Component\Console\Input\InputArgument,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Input\InputOption,
    Symfony\Component\Console\Input\ArrayInput,
    Symfony\Component\Console\Output\OutputInterface,
    Symfony\Component\Console\Helper\FormatterHelper;

class InitCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('project:init')
            ->setDescription('Init project')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $commands = array();
        $commands[] = array('command' => 'propel:generate');
        $commands[] = array('command' => 'propel:fixture:load');
        $commands[] = array('command' => 'logs:clear');
        $commands[] = array('command' => 'cache:clear');

        foreach ($commands as $command)
        {
            if (!$this->getApplication()->find($command['command'])->run(new ArrayInput($command), $output))
            {
                return false;
            }
        }
        $output->writeln('Project <comment>initialized</comment>.');

        return true;
    }
}