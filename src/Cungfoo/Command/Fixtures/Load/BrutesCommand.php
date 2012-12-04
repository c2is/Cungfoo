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

class BrutesCommand extends BaseCommand
{
    protected $buffer;

    protected function configure()
    {
        $this
            ->setName('fixtures:load:brutes')
            ->setDescription('Load brutes fixtures (check droussel for more informations :-)')
            ->addOption('directory', 'dir', InputOption::VALUE_OPTIONAL, 'Give a input directory.', '/app/resources/data/brutes')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try
        {
            $this->readCSVFile('photos_camping.csv', 'campingsCallback', null, $input, $output);
            $this->readCSVFile('regions.csv', 'regionsCallback', null, $input, $output);
            $this->readCSVFile('hebergements.csv', 'hebergementsCallback', 'hebergementsFileCallback', $input, $output);
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

            while (($line = fgets($handle)) !== false)
            {
                $this->$lineHandler(explode("\t", trim($line, "\n")), $buffer, $unset);
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

    protected function campingsCallback(array $explodedLine, array &$buffer, array &$unset)
    {
        list($code, $n, $img, $p1, $p2, $p3, $p4, $p5, $p6, $p7, $p8, $p9, $p10, $p11, $famille, $equitation, $randonnee, $visite, $gastro, $peche, $golf, $eau, $detente, $nature, $sport, $mer, $mariage) = $explodedLine;

        $tag = 1; // camping

        if ($visite || $nature || $mer)
        {
            $tag = 4; // région
        }
        elseif ($equitation || $randonnee || $peche || $golf || $sport)
        {
            $tag = 3; // activité
        }

        $camping = \Cungfoo\Model\EtablissementQuery::create()
            ->filterByCode($code)
            ->findOne()
        ;

        if (!$camping)
        {
            $unset[$camping->getSlug()] = true;
            return;
        }

        $multimedia = new \Cungfoo\Model\MultimediaEtablissement();
        $multimedia
            ->setEtablissementId($camping->getId())
            ->setImagePath(sprintf('uploads/multimedia_etablissements/%s.jpg', $img))
            ->save()
        ;

        $tagMultimedia = new \Cungfoo\Model\MultimediaEtablissementTag();
        $tagMultimedia
            ->setMultimediaEtablissementId($multimedia->getId())
            ->setTagId($tag)
            ->save()
        ;
    }

    protected function regionsCallback(array $explodedLine, array &$buffer, array &$unset)
    {
        list($code, $img) = $explodedLine;

        $region = \Cungfoo\Model\RegionQuery::create()
            ->filterByCode($code)
            ->findOne()
        ;

        if (!$region || !$img)
        {
            $unset[$code] = true;
            return;
        }

        $region
            ->setImagePath(sprintf('uploads/multimedia_etablissements/%s', $img))
            ->save()
        ;
    }

    protected function hebergementsCallback(array $explodedLine, array &$buffer, array &$unset)
    {
        list($code, $description, $img) = $explodedLine;

        $buffer[$code][] = array(
            "desc" => $description,
            "img" => $img,
        );
    }

    protected function hebergementsFileCallback(array $buffer, array &$unset)
    {
        $etabs = \Cungfoo\Model\EtablissementQuery::create()
            ->find()
        ;

        foreach ($etabs as $etab)
        {
            foreach ($etab->getTypeHebergements() as $typeHebergement)
            {
                if (!isset($buffer[$typeHebergement->getCode()]))
                {
                    $unset[$typeHebergement->getCode()] = true;
                    continue;
                }

                foreach ($buffer[$typeHebergement->getCode()] as $item)
                {
                    $multimedia = new \Cungfoo\Model\MultimediaEtablissement();
                    $multimedia
                        ->setEtablissementId($etab->getId())
                        ->setImagePath(sprintf('uploads/multimedia_etablissements/%s.jpg', $item['img']))
                        ->setTitre($item['desc'])
                        ->save()
                    ;

                    $tagMultimedia = new \Cungfoo\Model\MultimediaEtablissementTag();
                    $tagMultimedia
                        ->setMultimediaEtablissementId($multimedia->getId())
                        ->setTagId(2)
                        ->save()
                    ;
                }
            }
        }
    }
}
