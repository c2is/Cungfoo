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

use Cungfoo\Command\Command as BaseCommand;

use Symfony\Component\Console\Input\InputArgument,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Input\InputOption,
    Symfony\Component\Console\Output\OutputInterface;

class LoadCommand extends BaseCommand
{
    protected function configure()
    {
        $this
            ->setName('resalys:load')
            ->setDescription('Execute resalys soap request')

            ->addArgument('location', InputArgument::OPTIONAL, 'Give a specific location.')
            ->addArgument('request', InputArgument::OPTIONAL, 'Give a specific request.')

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
            $loader = new \Resalys\Lib\Loader(array(
                'client_configuration'      => $this->getApplication()->getRootDir().'/app/config/Resalys/client.yml',
                'loader_configuration'      => $this->getApplication()->getRootDir().'/app/config/Resalys/loader.yml',
                'languages_configuration'   => $this->getApplication()->getRootDir().'/app/config/languages.yml',
            ));

            // set task informations
            if ($request = $input->getArgument('request'))
            {
                $loader->addRequest($request, true);
            }

            if ($location = $input->getArgument('location'))
            {
                $loader->setLocation($location);
            }

            if ($baseId = $input->getOption('base_id'))
            {
                $loader->setBaseId($baseId);
            }

            if ($username = $input->getOption('username'))
            {
                $loader->setUsername($username);
            }

            if ($password = $input->getOption('password'))
            {
                $loader->setPassword($password);
            }

            if ($languageCode = $input->getOption('language_code'))
            {
                $loader->addLanguageCode($languageCode, true);
            }

            $output->writeln(sprintf('<info>Resalys:load</info> location:      <comment>%s</comment>', $loader->getLocation()));
            $output->writeln(sprintf('<info>Resalys:load</info> base_id:       <comment>%s</comment>', $loader->getBaseId()));
            $output->writeln(sprintf('<info>Resalys:load</info> request:       <comment>%s</comment>', implode(', ', $loader->getRequests())));
            $output->writeln(sprintf('<info>Resalys:load</info> language_code: <comment>%s</comment>', implode(', ', $loader->getLanguageCodes())));

            $loader->run();
        }
        catch (\Exception $exception)
        {
            $output->writeln(sprintf('<info>Resalys:load</info> <error>error %s:</error>.', $exception->getMessage()));
            return false;
        }

        $output->writeln(sprintf('<info>Resalys:load</info> <info>data is loaded :D</info>.'));
        return true;
    }
}