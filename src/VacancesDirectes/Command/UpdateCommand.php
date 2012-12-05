<?php
namespace VacancesDirectes\Command;

use Cungfoo\Command\Command;

use Symfony\Component\Console\Input\InputArgument,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Input\InputOption,
    Symfony\Component\Console\Input\ArrayInput,
    Symfony\Component\Console\Output\OutputInterface,
    Symfony\Component\Console\Helper\FormatterHelper;

class UpdateCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('vacancesdirectes:update')
            ->setDescription('Update Vacances directes from externals services.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $commands = array(
            array('command' => 'resalys:load', 'type' => 'catalogue'),
            array('command' => 'resalys:load', 'type' => 'prix'),
            array('command' => 'viafrance:load:events'),
            array('command' => 'viafrance:load:poi'),
            array('command' => 'vacancesdirectes:load:etablissement:coordinates'),
            array('command' => 'vacancesdirectes:slug:generate'),
            array('command' => 'vacancesdirectes:database:check-integrity'),
        );

        foreach ($commands as $command)
        {
            if ($this->getApplication()->find($command['command'])->run(new ArrayInput($command), $output) === false)
            {
                return false;
            }
        }
        $output->writeln('Project <comment>updated</comment>.');

        return true;
    }
}
