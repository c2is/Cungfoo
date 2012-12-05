<?php
namespace Cungfoo\Command\Project\Database;

use Cungfoo\Command\Command;

use Symfony\Component\Console\Input\InputArgument,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Input\InputOption,
    Symfony\Component\Console\Input\ArrayInput,
    Symfony\Component\Console\Output\OutputInterface,
    Symfony\Component\Console\Helper\FormatterHelper;

class SetupCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('project:database:setup')
            ->setDescription('Setup cungfoo config files')
            ->addArgument('mysql_database', InputArgument::REQUIRED, 'Mysql database.')
            ->addArgument('mysql_username', InputArgument::REQUIRED, 'Mysql username.')
            ->addArgument('mysql_password', InputArgument::OPTIONAL, 'Mysql password.', '')
            ->addArgument('mysql_host', InputArgument::OPTIONAL, 'Mysql host.', '127.0.0.1')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $databaseFilename     = sprintf("%s/app/config/Propel/databases.xml", $this->getProjectDirectory());
        $databaseDistFilename = sprintf("%s.dist", $databaseFilename);

        $defaultParameters = array(
            '/##host##/',
            '/##database##/',
            '/##username##/',
            '/##password##/'
        );

        $currentParameters = array(
            $input->getArgument('mysql_host'),
            $input->getArgument('mysql_database'),
            $input->getArgument('mysql_username'),
            $input->getArgument('mysql_password'),
        );

        $databaseConfig = preg_replace($defaultParameters, $currentParameters, file_get_contents($databaseDistFilename));

        file_put_contents($databaseFilename, $databaseConfig);

        return true;
    }
}
