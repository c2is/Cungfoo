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
            ->setName('vacancesdirectes:slug:generate')
            ->setDescription('Generate tables slug')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(sprintf('<info>%s</info> <comment>started</comment>.', $this->getName()));

        $con = \Propel::getConnection();
        $con->beginTransaction();

        try
        {
            $languages = array_keys($this->getSilexApplication()['config']->get('languages'));

            $this->generateEtablissements($con);
            $output->writeln(sprintf('<info>%s</info> slug added on <comment>etablissement</comment> table.', $this->getName()));

            $this->generateTheme(\Cungfoo\Model\VilleQuery::create(), $languages, $con);
            $output->writeln(sprintf('<info>%s</info> slug added on <comment>ville</comment> table.', $this->getName()));

            $this->generateTheme(\Cungfoo\Model\RegionQuery::create(), $languages, $con);
            $output->writeln(sprintf('<info>%s</info> slug added on <comment>region</comment> table.', $this->getName()));

            $this->generateTheme(\Cungfoo\Model\RegionRefQuery::create(), $languages, $con);
            $output->writeln(sprintf('<info>%s</info> slug added on <comment>region ref</comment> table.', $this->getName()));

            $this->generateTheme(\Cungfoo\Model\DepartementQuery::create(), $languages, $con);
            $output->writeln(sprintf('<info>%s</info> slug added on <comment>departement</comment> table.', $this->getName()));

            $this->generateTheme(\Cungfoo\Model\PaysQuery::create(), $languages, $con);
            $output->writeln(sprintf('<info>%s</info> slug added on <comment>pays</comment> table.', $this->getName()));

            $this->generateThemeCms($languages, $con);
            $output->writeln(sprintf('<info>%s</info> slug added on <comment>theme</comment> table.', $this->getName()));

            $this->generatePOI($languages, $con);
            $output->writeln(sprintf('<info>%s</info> slug added on <comment>POI</comment> table.', $this->getName()));

            $this->generateEvent($languages, $con);
            $output->writeln(sprintf('<info>%s</info> slug added on <comment>Event</comment> table.', $this->getName()));

            $this->generateTheme(\Cungfoo\Model\TypeHebergementQuery::create(), $languages, $con);
            $output->writeln(sprintf('<info>%s</info> slug added on <comment>type hebergement</comment> table.', $this->getName()));

            $this->generateTheme(\Cungfoo\Model\CategoryTypeHebergementQuery::create(), $languages, $con);
            $output->writeln(sprintf('<info>%s</info> slug added on <comment>catégorie type hebergement</comment> table.', $this->getName()));

            $this->generateTheme(\Cungfoo\Model\TypeHebergementCapaciteQuery::create(), $languages, $con);
            $output->writeln(sprintf('<info>%s</info> slug added on <comment>capacité type hebergement</comment> table.', $this->getName()));

            $this->generateTheme(\Cungfoo\Model\BonPlanQuery::create(), $languages, $con);
            $output->writeln(sprintf('<info>%s</info> slug added on <comment>bon plan</comment> table.', $this->getName()));

            $this->generateTheme(\Cungfoo\Model\BonPlanCategorieQuery::create(), $languages, $con);
            $output->writeln(sprintf('<info>%s</info> slug added on <comment>bon plan catégorie</comment> table.', $this->getName()));

            $this->generateTheme(\Cungfoo\Model\DestinationQuery::create(), $languages, $con);
            $output->writeln(sprintf('<info>%s</info> slug added on <comment>destination</comment> table.', $this->getName()));

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

    protected function generateEtablissements(\PropelPDO $con)
    {
        $utils = new \Cungfoo\Lib\Utils();
        $etablissements = \Cungfoo\Model\EtablissementQuery::create()->find($con);

        foreach ($etablissements as $etablissement)
        {
            $etablissement
                ->setSlug($utils->slugify($etablissement->getName()))
                ->save($con)
            ;
        }
    }
    protected function generateTheme($query, $languages, \PropelPDO $con)
    {
        $utils = new \Cungfoo\Lib\Utils();

        foreach ($languages as $language)
        {
            $objects = $query
                ->find($con)
            ;

            foreach ($objects as $object)
            {
                $object
                    ->setLocale($language)
                    ->setSlug($utils->slugify($object->getName()))
                    ->save($con)
                ;
            }
        }
    }
    protected function generateThemeCms($languages, \PropelPDO $con)
    {
        $utils = new \Cungfoo\Lib\Utils();
        $query = \Cungfoo\Model\ThemeQuery::create();


        foreach ($languages as $language)
        {
            $objects = $query
                ->find($con)
            ;

            foreach ($objects as $theme)
            {
                $theme
                    ->setLocale($language)
                    ->setSlug($utils->slugify($theme->getName()))
                    ->save($con)
                ;
            }
        }
    }

    protected function generatePOI($languages, \PropelPDO $con)
    {
        $utils = new \Cungfoo\Lib\Utils();
        $query = \Cungfoo\Model\PointInteretQuery::create();


        foreach ($languages as $language)
        {
            $objects = $query
                ->find($con)
            ;

            foreach ($objects as $poi)
            {
                $poi
                    ->setLocale($language)
                    ->setSlug($utils->slugify($poi->getName()))
                    ->save($con)
                ;
            }
        }
    }

    protected function generateEvent($languages, \PropelPDO $con)
    {
        $utils = new \Cungfoo\Lib\Utils();
        $query = \Cungfoo\Model\EventQuery::create();

        foreach ($languages as $language)
        {
            $objects = $query
                ->find($con)
            ;

            foreach ($objects as $event)
            {
                $event
                    ->setLocale($language)
                    ->setSlug($utils->slugify($event->getName()))
                    ->save($con)
                ;
            }
        }
    }
}
