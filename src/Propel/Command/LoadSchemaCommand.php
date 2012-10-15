<?php
namespace Propel\Command;

use Cungfoo\Command\Command,
    Cungfoo\Lib\Utils;

use Symfony\Component\Console\Input\InputArgument,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Input\InputOption,
    Symfony\Component\Console\Output\OutputInterface,
    Symfony\Component\Console\Helper\FormatterHelper;

class LoadSchemaCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('propel:load:schema')
            ->setDescription('Loads MySQL schema')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $utils = new Utils();
        $connexion = $utils->getPropelConnexion($this->getSilexApplication()['propel.config_file']);
        
        $cmd = sprintf("mysql -u%s -p'%s' %s < %s/app/resources/data/sql/Cungfoo.Model.schema.sql",
            $connexion['user'],
            $connexion['password'],
            $connexion['database'],
            $this->getSilexApplication()['config']->getRootDir()
        );

        exec($cmd, $lines, $status);

        if ($status)
        {
            foreach ($lines as $line)
            {
                $output->write($line, true);
            }
            $output->writeln($this->getFormatterHelper()->formatBlock(array('[Propel] Schema loading error'), 'fg=white;bg=red'));

            return false;
        }

        $output->write("MySQL schema <comment>loaded</comment>.", true);

        return true;
    }
}
