<?php
namespace Resalys\Command\Client;

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
            ->setName('resalys:client:setup')
            ->setDescription('Setup resalys client config file')
            ->addArgument('url', InputArgument::REQUIRED, 'Resalys URL.')
            ->addArgument('base_id', InputArgument::REQUIRED, 'Resalys base id.')
            ->addArgument('campaign', InputArgument::REQUIRED, 'Resalys campaign.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $resalysClientFilename     = sprintf("%s/app/config/Resalys/client.yml", $this->getProjectDirectory());
        $resalysClientDistFilename = sprintf("%s.dist", $resalysClientFilename);

        $defaultParameters = array(
            '/##url##/',
            '/##base_id##/',
            '/##campaign##/',
        );

        $currentParameters = array(
            $input->getArgument('url'),
            $input->getArgument('base_id'),
            $input->getArgument('campaign'),
        );

        $resalysClientConfig = preg_replace($defaultParameters, $currentParameters, file_get_contents($resalysClientDistFilename));

        file_put_contents($resalysClientFilename, $resalysClientConfig);

        return true;
    }
}
