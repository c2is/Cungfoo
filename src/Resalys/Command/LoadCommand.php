<?php
/**
 * Configuration of our application
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 *
 * @package Cungfoo by C2IS
 */

namespace Resalys\Command;

use Symfony\Component\Console\Input\InputArgument,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Input\InputOption,
    Symfony\Component\Console\Output\OutputInterface;

use Cungfoo\Command\Command as BaseCommand,
    Resalys\Lib\Client\CatalogueClient,
    Resalys\Lib\Client\PrixClient;

class LoadCommand extends BaseCommand
{
    protected function configure()
    {
        $this
            ->setName('resalys:load')
            ->setDescription('Execute resalys soap request')
            ->addArgument('type', InputArgument::REQUIRED, 'What type of data do you want to load ?')
            ->addOption('language_code', 'l', InputOption::VALUE_OPTIONAL, 'Give a specific language_code or this task execute for all.', null)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try
        {
            $clientClassName = sprintf('Resalys\Lib\Client\%sClient', ucfirst(strtolower($input->getArgument('type'))));
            $client = new $clientClassName($this->getProjectDirectory());

            if ($languageCode = $input->getOption('language_code'))
            {
                $client->addOption('languages', array($languageCode));
            }

            $client->loadData();

        }
        catch (\Exception $exception)
        {
            $output->writeln(sprintf('<info>%s</info> <error>%s:</error>.', $this->getName(), $exception->getMessage()));

            return false;
        }

        $output->writeln(sprintf('<info>%s</info> <info>data (%s) is loaded</info>.', $this->getName(), $input->getArgument('type')));

        return true;
    }
}
