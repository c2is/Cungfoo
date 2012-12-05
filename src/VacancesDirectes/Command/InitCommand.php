<?php
namespace VacancesDirectes\Command;

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
            ->setName('vacancesdirectes:init')
            ->setDescription('Init Vacances directes')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $commands = array(
            array('command' => 'propel:load:schema'),
            array('command' => 'vacancesdirectes:update'),
            array('command' => 'fixtures:load:brutes'),
            array('command' => 'fixtures:load:vendor'),
        );

        foreach ($commands as $command)
        {
            if ($this->getApplication()->find($command['command'])->run(new ArrayInput($command), $output) === false)
            {
                return false;
            }
        }
        $output->writeln('Project <comment>initialized</comment>.');

        return true;
    }
}
