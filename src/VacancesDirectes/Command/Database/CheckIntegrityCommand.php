<?php
/**
 * Configuration of our application
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 *
 * @package Cungfoo by C2IS
 */

namespace VacancesDirectes\Command\Database;

use Cungfoo\Command\Command as BaseCommand,
    Cungfoo\Model\EtablissementQuery;

use Symfony\Component\Console\Input\InputArgument,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Input\InputOption,
    Symfony\Component\Console\Output\OutputInterface,
    Symfony\Component\Yaml\Yaml;

class CheckIntegrityCommand extends BaseCommand
{
    protected function configure()
    {
        $this
            ->setName('vacancesdirectes:database:check-integrity')
            ->setDescription('Checks wether campings are associated with a city, cities with a region, regions with a country and deactivates those that are not')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(sprintf('<info>%s</info> <comment>started</comment>.', $this->getName()));

        $con = \Propel::getConnection();
        $con->beginTransaction();

        try
        {
            $items = \Cungfoo\Model\RegionQuery::create()
                ->usePaysQuery()
                    ->filterByActive(false)
                    ->_or()
                    ->filterById(null, \Criteria::ISNULL)
                ->endUse()
                ->find($con)
            ;
            foreach($items as $item)
            {
                $item->setActive(false);
                $item->save();
            }

            $notActives = \Cungfoo\Model\RegionQuery::create()
                ->filterByActive(false)
                ->find()
            ;


            foreach($notActives as $notActive)
            {
                $output->writeln(sprintf('<info>%s</info> region <comment>%s - %s</comment> is unactive.', $this->getName(), $notActive->getCode(), $notActive->getName()));
            }

            $items = \Cungfoo\Model\VilleQuery::create()
                ->useRegionQuery()
                    ->filterByActive(false)
                    ->_or()
                    ->filterById(null, \Criteria::ISNULL)
                ->endUse()
                ->find($con)
            ;
            foreach($items as $item)
            {
                $item->setActive(true);
                $item->save();
            }

            $notActives = \Cungfoo\Model\VilleQuery::create()
                ->filterByActive(false)
                ->find()
            ;


            foreach($notActives as $notActive)
            {
                $output->writeln(sprintf('<info>%s</info> ville <comment>%s - %s</comment> is unactive.', $this->getName(), $notActive->getCode(), $notActive->getName()));
            }

            $items = \Cungfoo\Model\EtablissementQuery::create()
                ->useVilleQuery()
                    ->filterByActive(false)
                    ->_or()
                    ->filterById(null, \Criteria::ISNULL)
                ->endUse()
                ->find($con)
            ;
            foreach($items as $item)
            {
                $item->setActive(true);
                $item->save();
            }

            $notActives = \Cungfoo\Model\EtablissementQuery::create()
                ->filterByActive(false)
                ->find()
            ;


            foreach($notActives as $notActive)
            {
                $output->writeln(sprintf('<info>%s</info> camping <comment>%s - %s</comment> is unactive.', $this->getName(), $notActive->getCode(), $notActive->getName()));
            }

            $items = \Cungfoo\Model\EtablissementQuery::create()
                ->filterByName("%(Hôtel)", \Criteria::LIKE)
                ->find($con)
            ;
            foreach($items as $item)
            {
                $item->setActive(false);
                $item->save();
            }

            $items = \Cungfoo\Model\EtablissementQuery::create()
                ->filterByName("%(Résidence)", \Criteria::LIKE)
                ->find($con)
            ;
            foreach($items as $item)
            {
                $item->setActive(false);
                $item->save();
            }

            $items = \Cungfoo\Model\TopCampingQuery::create()
                ->useEtablissementQuery()
                    ->filterByActive(true)
                ->endUse()
                ->find($con)
            ;
            foreach($items as $item)
            {
                $item->setActive(true);
                $item->save();
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
