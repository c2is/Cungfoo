<?php
namespace Cungfoo\Command\Propel;

use Cungfoo\Command\ApplicationAwareCommand;

use Symfony\Component\Console\Input\InputArgument,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Input\InputOption,
    Symfony\Component\Console\Output\OutputInterface;

class GenerateCommand extends ApplicationAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('propel:generate')
            ->setDescription('Generates all classes')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        exec(
            'export PHP_CLASSPATH='.$this->getApplication()->getRootDir().'/vendor/phing/phing/classes &&'
            .$this->getApplication()->getRootDir().'/vendor/propel/propel1/generator/bin/propel-gen config/Propel main',
            $lines,
            $status
        );

        if($status)
        {
            foreach ($lines as $line)
            {
                $output->write($line, true);
            }
            $this->writeSection($output, array('[Propel] Generation error', '', ''), 'fg=white;bg=red');
            return false;
        }
        
        $output->write("Propel classes <comment>generated</comment>.", true);
        return true;
    }
}
