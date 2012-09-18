<?php
/**
 * Configuration of our application
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 *
 * @package Cungfoo by C2IS
 */

namespace Cungfoo\Command\Resalys\Load;

use Symfony\Component\Console\Input\InputArgument,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Input\InputOption,
    Symfony\Component\Console\Output\OutputInterface;

use Cungfoo\Command\Command as BaseCommand,
    Cungfoo\Lib\Resalys\Client\CatalogueClient;

class CatalogueCommand extends BaseCommand
{
    protected function configure()
    {
        $this
            ->setName('resalys:load:catalogue')
            ->setDescription('Execute resalys soap request')
            ->addOption('base_id', 'b', InputOption::VALUE_OPTIONAL, 'Give a specific base_id.', null)
            ->addOption('username', 'u', InputOption::VALUE_OPTIONAL, 'Give a specific base_id.', null)
            ->addOption('password', 'p', InputOption::VALUE_OPTIONAL, 'Give a specific base_id.', null)
            ->addOption('language_code', 'l', InputOption::VALUE_OPTIONAL, 'Give a specific language_code or this task execute for all.', null)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try
        {
            $client = new CatalogueClient($this->getApplication()->getRootDir());

            if ($baseId = $input->getOption('base_id'))
            {
                $client->addOption('base_id', $baseId);
            }

            if ($username = $input->getOption('username'))
            {
                $client->addOption('username', $username);
            }

            if ($password = $input->getOption('password'))
            {
                $client->addOption('password', $password);
            }

            if ($languageCode = $input->getOption('language_code'))
            {
                $client->addOption('languages', array($languageCode));
            }

            $client->loadData();

        }
        catch (\Exception $exception)
        {
            $output->writeln(sprintf('<info>resalys:load:catalogue</info> <error>error %s:</error>.', $exception->getMessage()));
            return false;
        }

        $output->writeln(sprintf('<info>resalys:load:catalogue</info> <info>data is loaded :D</info>.'));
        return true;
    }
}