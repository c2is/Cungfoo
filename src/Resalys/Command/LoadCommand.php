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
    Symfony\Component\Console\Input\ArrayInput,
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
        $defaultSocketTimeout = ini_get('default_socket_timeout');

        try
        {
            ini_set('default_socket_timeout', 60);

            $clientClassName = sprintf('Resalys\Lib\Client\%sClient', ucfirst(strtolower($input->getArgument('type'))));
            $client = new $clientClassName($this->getProjectDirectory());

            if ($languageCode = $input->getOption('language_code'))
            {
                $client->addOption('languages', array($languageCode));
            }

            $client->loadData();

            ini_set('default_socket_timeout', $defaultSocketTimeout);
        }
        catch (\Exception $exception)
        {
            ini_set('default_socket_timeout', $defaultSocketTimeout);

            $output->writeln(sprintf('<info>%s</info> <error>%s:</error>.', $this->getName(), $exception->getMessage()));

            return false;
        }

        $commands = array(
            array('command' => 'vacancesdirectes:database:check-integrity'),
            array('command' => 'vacancesdirectes:slug:generate'),
        );

        foreach ($commands as $command)
        {
            if ($this->getApplication()->find($command['command'])->run(new ArrayInput($command), $output) === false)
            {
                return false;
            }
        }

        $output->writeln(sprintf('<info>%s</info> <info>data (%s) is loaded</info>.', $this->getName(), $input->getArgument('type')));

        return true;
    }
}
