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

            $this->generateTheme(\Cungfoo\Model\PaysQuery::create(), $languages, $con);
            $output->writeln(sprintf('<info>%s</info> slug added on <comment>pays</comment> table.', $this->getName()));

            $this->generateThemeCms($languages, $con);
            $output->writeln(sprintf('<info>%s</info> slug added on <comment>theme</comment> table.', $this->getName()));

            $this->generateTheme(\Cungfoo\Model\TypeHebergementQuery::create(), $languages, $con);
            $output->writeln(sprintf('<info>%s</info> slug added on <comment>type hebergement</comment> table.', $this->getName()));

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
                ->joinWithI18n($language)
                ->find($con)
            ;

            foreach ($objects as $object)
            {
                $object
                    ->setSlug($utils->slugify($object->getName()))
                    ->save($con)
                ;
            }
        }
    }
    protected function generateThemeCms($languages, \PropelPDO $con)
    {
        $utils = new \Cungfoo\Lib\Utils();
        $themes = \Cungfoo\Model\ThemeQuery::create()->find($con);

        foreach ($themes as $theme)
        {
            $theme
                ->setSlug($utils->slugify($theme->getName()))
                ->save($con)
            ;
        }
    }
}
