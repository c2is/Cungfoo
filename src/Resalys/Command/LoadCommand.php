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
    Symfony\Component\Console\Output\OutputInterface,
    Symfony\Component\Yaml\Yaml;

class LoadCommand extends BaseCommand
{
    protected $requests         = array();
    protected $location         = null;
    protected $baseId           = null;
    protected $username         = null;
    protected $password         = null;
    protected $languageCodes    = null;

    protected $requestToLoader = array(
        'getAllThemes'              => '\Resalys\Loader\ThemeLoader',
        'getAllRoomTypeCategories'  => '\Resalys\Loader\RoomTypeCategoryLoader',
        'getAllRoomTypes'           => '\Resalys\Loader\RoomTypeLoader',
        'getAllEtabs'               => '\Resalys\Loader\EtabLoader',
    );

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
        $output->writeln('<info>Resalys:load</info> <comment>started</comment>.');

        $this->parseConfiguration($input);

        $output->writeln(sprintf('<info>Resalys:load</info> with location equal <info>%s</info>.', $this->location));
        $output->writeln(sprintf('<info>Resalys:load</info> with base_id  equal <info>%s</info>.', $this->baseId));


        $con = \Propel::getConnection();
        $con->beginTransaction();

        try
        {
            foreach ($this->languageCodes as $languageCode)
            {
                $output->writeln(sprintf('<info>Resalys:load</info> with language_code equal <info>%s</info>.', $languageCode));

                foreach ($this->requests as $request)
                {
                    if (!array_key_exists($request, $this->requestToLoader))
                    {
                        throw new \Exception(sprintf('the `%s` request does not exist', $request));
                    }

                    $loaderClass = $this->requestToLoader[$request];
                    if (!class_exists($loaderClass))
                    {
                        throw new \Exception(sprintf('the `%s` loader does not exist', $loaderClass));
                    }

                    $output->writeln(sprintf('<info>Resalys:load</info> execute <comment>%s</comment> request.', $request));
                    $this->executeLoader($loaderClass, $request, $languageCode, $con);
                }
            }

            $con->commit();
        }
        catch (\SoapFault $exception)
        {
            $con->rollBack();
            $output->writeln(sprintf('<info>Resalys:load</info> <error>%s</error>.', $exception->getMessage()));

            return false;
        }

        $output->writeln(sprintf('<info>Resalys:load</info> <info>success</info>.'));

        return true;
    }

    protected function executeLoader($loaderClass, $request, $languageCode, \PropelPDO $con)
    {
        $client = new $loaderClass($this->location, $this->baseId, $this->username, $this->password, strtoupper($languageCode));
        $client->parseConfigFile(sprintf('%s/app/config/Resalys/loader.yml', $this->getApplication()->getRootDir()));
        $client->getData($request);
        $client->load($languageCode, $con);
    }

    protected function parseConfiguration($input)
    {
        $clientConfigFile = sprintf('%s/app/config/Resalys/client.yml', $this->getApplication()->getRootDir());
        if (!is_file($clientConfigFile))
        {
            throw new \Exception(sprintf('the configuration file `%s` does not exist', $clientConfigFile));
        }

        $configuration = Yaml::parse($clientConfigFile)['client'];

        $this->requests       = $input->getArgument('request') ? array($input->getArgument('request')) : array_keys($this->requestToLoader);
        $this->location       = $input->getArgument('location') ?: $configuration['location'];
        $this->baseId         = $input->getOption('base_id') ?: $configuration['base_id'];
        $this->username       = $input->getOption('username');
        $this->password       = $input->getOption('password');
        $this->languageCodes  = $input->getOption('language_code') ? array($input->getOption('language_code')) : null;

        if ($this->languageCodes === null)
        {
            $this->languageCodes = $this->getLanguageCodes();
        }
    }

    protected function getLanguageCodes()
    {
        $languageConfigFile = sprintf('%s/app/config/languages.yml', $this->getApplication()->getRootDir());
        if (!is_file($languageConfigFile))
        {
            throw new \Exception(sprintf('the languages configuration file `%s` does not exist', $languageConfigFile));
        }

        return array_keys(Yaml::parse($languageConfigFile)['languages']);
    }
}