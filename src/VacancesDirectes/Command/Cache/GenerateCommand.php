<?php
/**
 * Configuration of our application
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 *
 * @package Cungfoo by C2IS
 */

namespace VacancesDirectes\Command\Cache;

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
            $urls = \Cungfoo\Model\CacheGeneratorQuery::create()
                ->findActive($con)
            ;

            foreach ($urls as $url) {
                if (!$url->getCachedAt() or $url->getCachedAt()->add(new \DateInterval(sprintf('PT%sS', $url->getCacheTime() ?: 1800))) < new \DateTime()) {
                    file_get_contents($url->getUrl());
                    $url->setCachedAt(new \DateTime())->save();
                    $output->writeln(sprintf('<info>%s</info> <comment>called for cache generation</comment>.', $url->getUrl()));
                    sleep(20);
                }
            }

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
