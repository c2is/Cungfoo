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
    protected function configure()
    {
        $this
            ->setName('fixtures:load:brutes')
            ->setDescription('Load brutes fixtures (check fgallardo for more informations :-)')
            ->addOption('directory', 'dir', InputOption::VALUE_OPTIONAL, 'Give a input directory.', '/app/resources/data/brutes')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $con = \Propel::getConnection();

        try
        {
            $this->loadPhotosCamping($input, $output, $con);
            $this->loadPhotosHebergement($input, $output, $con);
        }
        catch (\Exception $exception)
        {
            $output->writeln(sprintf('<info>%s</info> <error>error %s:</error>.', $this->getName(), $exception->getMessage()));

            return false;
        }

        $output->writeln(sprintf('<comment>All</comment> brutes files loaded.'));

        return true;
    }

    protected function loadPhotosCamping($input, $output, $con)
    {
        $fileToLoad = sprintf('%s/%s/photos_camping.csv', $this->getProjectDirectory(), trim($input->getOption('directory')));

        $handle = @fopen($fileToLoad, "r");
        if ($handle)
        {
            while (($buffer = fgets($handle)) !== false)
            {
                list($idCamping, $n, $imgPath, $p1, $p2, $p3, $p4, $p5, $p6, $p7, $p8, $p9, $p10, $p11, $famille, $equitation, $randonnee, $visite, $gastro, $peche, $golf, $eau, $detente, $nature, $sport, $mer, $mariage) = split("\t", trim($buffer, "\n"));

                $tag = 1; // camping

                if ($visite || $nature || $mer)
                {
                    $tag = 4; // région
                }
                elseif ($equitation || $randonnee || $peche || $golf || $sport)
                {
                    $tag = 3; // activité
                }
                // Récupération de l'établissement correspondant
                $camping = \Cungfoo\Model\EtablissementQuery::create()
                    ->filterByCode($idCamping)
                    ->findOne()
                ;

                if (!$camping)
                {
                    continue;
                }

                // Si établissement trouvé
                $multimedia = new \Cungfoo\Model\MultimediaEtablissement();
                $multimedia
                    ->setEtablissementId($camping->getId())
                    ->setImagePath(sprintf('uploads/multimedia_etablissements/%s.jpg', $imgPath))
                    ->save()
                ;

                $tagMultimedia = new \Cungfoo\Model\MultimediaEtablissementTag();
                $tagMultimedia
                    ->setMultimediaEtablissementId($multimedia->getId())
                    ->setTagId($tag)
                    ->save()
                ;
            }
            if (!feof($handle))
            {
                $output->writeln(sprintf('Erreur de lecture du fichier %s' , $fileToLoad));
            }
            fclose($handle);
        }
    }

     protected function loadPhotosHebergement($input, $output, $con)
    {
        $fileToLoad = sprintf('%s/%s/hebergements.csv', $this->getProjectDirectory(), trim($input->getOption('directory')));

        $handle = @fopen($fileToLoad, "r");
        if ($handle)
        {
            $content = array();
            while (($buffer = fgets($handle)) !== false)
            {
                list($idHebergement, $description, $imgPath) = split("\t", trim($buffer, "\n"));

                $content[$idHebergement][] = array(
                    "desc" => $description,
                    "img" => $imgPath
                );
            }
            if (!feof($handle))
            {
                $output->writeln(sprintf('Erreur de lecture du fichier %s' , $fileToLoad));
            }
            fclose($handle);

            if (count($content))
            {
                $unsetType = array();

                $etabs = \Cungfoo\Model\EtablissementQuery::create()
                    ->find()
                ;

                foreach ($etabs as $etab)
                {
                    foreach ($etab->getTypeHebergements() as $typeHebergement)
                    {
                        if (!isset($content[$typeHebergement->getCode()]))
                        {
                            $unsetType[$typeHebergement->getCode()] = true;
                            continue;
                        }

                        foreach ($content[$typeHebergement->getCode()] as $item)
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

                if (count($unsetType))
                {
                    $output->writeln(sprintf('<info>%s</info> Type(s) etablissement non géré(s) : <comment>%s</comment>', $this->getName(), implode(',', array_keys($unsetType))));
                }
            }
        }
    }
}
