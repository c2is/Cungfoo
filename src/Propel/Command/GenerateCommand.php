<?php
namespace Propel\Command;

use Cungfoo\Command\Command;

use Symfony\Component\Console\Input\InputArgument,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Input\InputOption,
    Symfony\Component\Console\Output\OutputInterface,
    Symfony\Component\Console\Helper\FormatterHelper;

class GenerateCommand extends Command
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
            .$this->getApplication()->getRootDir().'/vendor/propel/propel1/generator/bin/propel-gen app/config/Propel main',
            $lines,
            $status
        );

        if ($status)
        {
            foreach ($lines as $line)
            {
                $output->write($line, true);
            }
            $output->writeln($this->getFormatterHelper()->formatBlock(array('[Propel] Generation error'), 'fg=white;bg=red'));

            return false;
        }

        $output->write("Propel classes <comment>generated</comment>.", true);

        return true;
    }
}
