<?php
/**
 * Configuration of our application
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 *
 * @package Cungfoo by C2IS
 */

namespace Cungfoo\Command\Fixtures\Load;

use Cungfoo\Command\Command as BaseCommand;

use Symfony\Component\Console\Input\InputArgument,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Input\ArrayInput,
    Symfony\Component\Console\Input\InputOption,
    Symfony\Component\Console\Output\OutputInterface,
    Symfony\Component\Filesystem\Filesystem,
    Symfony\Component\Yaml\Yaml;

class CsvCommand extends BaseCommand
{
    protected $buffer;

    protected function configure()
    {
        $this
            ->setName('fixtures:load:csv')
            ->setDescription('Load CSV fixtures (check droussel for more informations :-)')
            ->addOption('directory', 'dir', InputOption::VALUE_OPTIONAL, 'Give a input directory.', '/app/resources/data/brutes')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try
        {
            $this->readCSVFile('types_hebergement.csv', 'TypesHebergementCallback', null, $input, $output);
        }
        catch (\Exception $exception)
        {
            $output->writeln(sprintf('<info>%s</info> <error>error %s:</error>.', $this->getName(), $exception->getMessage()));

            return false;
        }

        $output->writeln(sprintf('<comment>All</comment> brutes files loaded.'));

        return true;
    }

    protected function readCSVFile($filename, $lineHandler, $fileHandler, $input, $output)
    {
        $file   = sprintf('%s/%s/%s', $this->getProjectDirectory(), trim($input->getOption('directory')), $filename);
        $handle = fopen($file, "r");

        if ($handle)
        {
            $buffer = array();
            $unset  = array();

            while (($line = fgetcsv($handle, 0, ';')) !== false)
            {
                $this->$lineHandler($line, $buffer, $unset);
            }

            if (!is_null($fileHandler))
            {
                $this->$fileHandler($buffer, $unset);
            }

            if (count($unset))
            {
                $output->writeln(sprintf('<info>%s / %s</info> - Unset elements : <comment>%s</comment>', $this->getName(), $filename, implode(',', array_keys($unset))));
                $unset = array();
            }
        }
        if (!feof($handle))
        {
            $output->writeln(sprintf('File error : %s' , $file));
        }
        fclose($handle);
    }

    protected function typesHebergementCallback(array $explodedLine, array &$buffer, array &$unset)
    {
        list($code, $presentation, $capaciteHebergement, $dimensions, $agencement, $equipements, $anneeUtilisation, $remarque1, $remarque2, $remarque3) = $explodedLine;

        $typeHebergement = \Cungfoo\Model\TypeHebergementQuery::create()
            ->filterByCode($code)
            ->findOne()
        ;

        if($typeHebergement) {
            $typeHebergement
                ->setPresentation($presentation)
                ->setCapaciteHebergement($capaciteHebergement)
                ->setDimensions($dimensions)
                ->setAgencement($agencement)
                ->setEquipements($equipements)
                ->setAnneeUtilisation($anneeUtilisation)
                ->setRemarque1($remarque1)
                ->setRemarque2($remarque2)
                ->setRemarque3($remarque3)
                ->save()
            ;
        }
    }
}
