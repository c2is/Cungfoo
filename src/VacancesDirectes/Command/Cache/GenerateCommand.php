<?php
/**
 * Configuration of our application
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 *
 * @package Cungfoo by C2IS
 */

namespace VacancesDirectes\Command\Slug;

use Cungfoo\Command\Command as BaseCommand;

use Symfony\Component\Console\Input\InputArgument,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Input\InputOption,
    Symfony\Component\Console\Output\OutputInterface,
    Symfony\Component\Yaml\Yaml;

class GenerateCommand extends BaseCommand
{
    protected function configure()
    {
        $this
            ->setName('vacancesdirectes:cache:generate')
            ->setDescription('Generates cache')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(sprintf('<info>%s</info> <comment>started</comment>.', $this->getName()));

        $con = \Propel::getConnection();
        $con->beginTransaction();

        try
        {
            
            $con->commit();
        }
        catch (\Exception $exception)
        {
            $con->rollBack();
            throw $exception;
        }

        $output->writeln(sprintf('<info>%s</info> <comment>success</comment>.', $this->getName()));

        return true;
    }
}
