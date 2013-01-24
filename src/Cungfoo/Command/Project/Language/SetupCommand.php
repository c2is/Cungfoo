<?php
namespace Cungfoo\Command\Project\Language;

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
            ->setName('project:language:setup')
            ->setDescription('Setup language config files')
            ->addArgument('domain_fr', InputArgument::REQUIRED, 'Domain name for fr.')
            ->addArgument('domain_de', InputArgument::REQUIRED, 'Domain name for de')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $databaseFilename     = sprintf("%s/app/config/languages.yml", $this->getProjectDirectory());
        $databaseDistFilename = sprintf("%s.dist", $databaseFilename);

        $defaultParameters = array(
            '/##domain_fr##/',
            '/##domain_de##/',
        );

        $currentParameters = array(
            $input->getArgument('domain_fr'),
            $input->getArgument('domain_de'),
        );

        $databaseConfig = preg_replace($defaultParameters, $currentParameters, file_get_contents($databaseDistFilename));

        file_put_contents($databaseFilename, $databaseConfig);

        return true;
    }
}
