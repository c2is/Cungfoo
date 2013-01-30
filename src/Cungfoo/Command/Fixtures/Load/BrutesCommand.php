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

    protected $translatedIds = array();

    protected function configure()
    {
        $this
            ->setName('fixtures:load:brutes')
            ->setDescription('Load brutes fixtures (check droussel for more informations :-)')
            ->addOption('directory', 'dir', InputOption::VALUE_OPTIONAL, 'Give a input directory.', '/app/resources/data/brutes')
            ->addOption('csv_directory', 'csv_dir', InputOption::VALUE_OPTIONAL, 'Give a input directory for CSV (; delimiter) files.', '/app/resources/data/csv')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try
        {
            // Fichiers délimiteur tab (pas de possibilite de sauts de ligne dans les champs)
            /*$this->readCSVFile('photos_camping.csv', 'campingsCallback', null, $input, $output);
            $this->readCSVFile('regions.csv', 'regionsCallback', null, $input, $output);
            $this->readCSVFile('hebergements.csv', 'hebergementsCallback', 'hebergementsFileCallback', $input, $output);*/

            // Fichiers délimiteur ;
            //$this->readCSVFile('types_hebergement.csv', 'typesHebergementCallback', null, $input, $output, true);
            //$this->readCSVFile('photos_campingv2.csv', 'campingsCallback', null, $input, $output, true);
            $this->readCSVFile('activite_i18n_de_rel.csv', 'activitesI18nCallback', null, $input, $output, true, true);
            $this->readCSVFile('activite_i18n_de_rel.csv', 'activitesI18nCallback', null, $input, $output, true);
            $this->readCSVFile('avantage_i18n_de_rel.csv', 'avantagesI18nCallback', null, $input, $output, true, true);
            $this->readCSVFile('avantage_i18n_de_rel.csv', 'avantagesI18nCallback', null, $input, $output, true);
            $this->readCSVFile('baignade_i18n_de_rel.csv', 'baignadesI18nCallback', null, $input, $output, true, true);
            $this->readCSVFile('baignade_i18n_de_rel.csv', 'baignadesI18nCallback', null, $input, $output, true);
            $this->readCSVFile('etablissement_i18n_de_rel.csv', 'etablissementsI18nCallback', null, $input, $output, true, true);
            $this->readCSVFile('etablissement_i18n_de_rel.csv', 'etablissementsI18nCallback', null, $input, $output, true);
            //$this->readCSVFile('etablissement2_i18n_de_rel.csv', 'etablissements2I18nCallback', null, $input, $output, true, true);
            //$this->readCSVFile('etablissement2_i18n_de_rel.csv', 'etablissements2I18nCallback', null, $input, $output, true);
            $this->readCSVFile('idee_weekend_i18n_de_rel.csv', 'ideesWEI18nCallback', null, $input, $output, true, true);
            $this->readCSVFile('idee_weekend_i18n_de_rel.csv', 'ideesWEI18nCallback', null, $input, $output, true);
            $this->readCSVFile('mise_en_avant_i18n_de_rel.csv', 'misesEnAvantI18nCallback', null, $input, $output, true, true);
            $this->readCSVFile('mise_en_avant_i18n_de_rel.csv', 'misesEnAvantI18nCallback', null, $input, $output, true);
            $this->readCSVFile('region_i18n_de_rel.csv', 'regionsI18nCallback', null, $input, $output, true, true);
            $this->readCSVFile('region_i18n_de_rel.csv', 'regionsI18nCallback', null, $input, $output, true);
            $this->readCSVFile('service_complementaire_i18n_de_rel.csv', 'servicesComplementairesI18nCallback', null, $input, $output, true, true);
            $this->readCSVFile('service_complementaire_i18n_de_rel.csv', 'servicesComplementairesI18nCallback', null, $input, $output, true);
            $this->readCSVFile('situation_geographique_i18n_de_rel.csv', 'situationsGeographiquesI18nCallback', null, $input, $output, true, true);
            $this->readCSVFile('situation_geographique_i18n_de_rel.csv', 'situationsGeographiquesI18nCallback', null, $input, $output, true);
            $this->readCSVFile('tag_i18n_de_rel.csv', 'tagsI18nCallback', null, $input, $output, true, true);
            $this->readCSVFile('tag_i18n_de_rel.csv', 'tagsI18nCallback', null, $input, $output, true);
            $this->readCSVFile('thematique_i18n_de_rel.csv', 'thematiquesI18nCallback', null, $input, $output, true, true);
            $this->readCSVFile('thematique_i18n_de_rel.csv', 'thematiquesI18nCallback', null, $input, $output, true);
            $this->readCSVFile('type_hebergement_i18n_de_rel.csv', 'typesHebergementsI18nCallback', null, $input, $output, true, true);
            $this->readCSVFile('type_hebergement_i18n_de_rel.csv', 'typesHebergementsI18nCallback', null, $input, $output, true);
            $this->readCSVFile('ville_i18n_de_rel.csv', 'villesI18nCallback', null, $input, $output, true, true);
            $this->readCSVFile('ville_i18n_de_rel.csv', 'villesI18nCallback', null, $input, $output, true);
        }
        catch (\Exception $exception)
        {
            $output->writeln(sprintf('<info>%s</info> <error>error %s:</error>.', $this->getName(), $exception->getMessage()));

            return false;
        }

        $output->writeln(sprintf('<comment>All</comment> brutes files loaded.'));

        return true;
    }

    protected function readCSVFile($filename, $lineHandler, $fileHandler, $input, $output, $csv = false, $translateIds = false)
    {
        $directory = trim($input->getOption('directory'));
        if ($csv)
        {
            $directory = trim($input->getOption('csv_directory'));
        }
        $file   = sprintf('%s%s/%s', $this->getProjectDirectory(), $directory, $filename);

        $handle = fopen($file, "r");

        if ($handle)
        {
            $buffer = array();
            $unset  = array();

            if ($csv)
            {
                while (($line = fgetcsv($handle, 0, ';')) !== false)
                {
                    $this->$lineHandler($line, $buffer, $unset, $output, $translateIds);
                }
            }
            else
            {
                while (($line = fgets($handle)) !== false)
                {
                    $this->$lineHandler(explode("\t", trim($line, "\n")), $buffer, $unset, $output);
                }
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

    protected function campingsCallback(array $explodedLine, array &$buffer, array &$unset, $output)
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
            $unset[$code] = true;
            return;
        }

        $multimediaObj = \Cungfoo\Model\MultimediaEtablissementQuery::create()
            ->filterByEtablissementId($camping->getId())
            ->filterByImagePath(sprintf('uploads/multimedia_etablissements/%s.jpg', $img))
            ->findOne()
        ;
        if ($multimediaObj) {
            //$output->writeln(sprintf('L\'image %s est deja associee au camping %s' , $img, $camping->getName()));
        } else {
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
            $output->writeln(sprintf('L\'image %s a ete associee au camping %s' , $img, $camping->getName()));
        }
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
            ->setImagePath(sprintf('uploads/regions/%s', $img))
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

    protected function typesHebergementCallback(array $explodedLine, array &$buffer, array &$unset)
    {
        list($code, $presentation, $capaciteHebergement, $dimensions, $agencement, $equipements, $anneeUtilisation, $remarque1, $remarque2, $remarque3) = $explodedLine;

        $typeHebergement = \Cungfoo\Model\TypeHebergementQuery::create()
            ->filterByCode($code)
            ->findOne()
        ;

        if ($typeHebergement) {
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

    protected function activitesI18nCallback(array $explodedLine, array &$buffer, array &$unset, $output, $translateIds = false)
    {
        list($id, $locale, $name, $description, $keywords) = $explodedLine;

        if ($translateIds)
        {
            if ($locale == 'fr')
            {
                $item = \Cungfoo\Model\ActiviteQuery::create()
                    ->useI18nQuery()
                        ->filterByName($name)
                        ->filterByLocale('fr')
                    ->endUse()
                    ->findOne()
                ;

                if ($item) $this->translatedIds['activites'][$id] = $item->getId();
            }
        }
        elseif ($locale == 'de' && isset($this->translatedIds['activites'][$id]))
        {
            $item = \Cungfoo\Model\ActiviteQuery::create()
                ->filterById($this->translatedIds['activites'][$id])
                ->findOne()
            ;

            if (!$item)
            {
                return;
            }

            $item
                ->setLocale($locale)
                ->setName($name)
                ->setDescription($description)
                ->setKeywords($keywords)
                ->save()
            ;
        }
    }

    protected function avantagesI18nCallback(array $explodedLine, array &$buffer, array &$unset, $output, $translateIds = false)
    {
        list($id, $locale, $name, $description) = $explodedLine;

        if ($translateIds)
        {
            if ($locale == 'fr')
            {
                $item = \Cungfoo\Model\AvantageQuery::create()
                    ->useI18nQuery()
                        ->filterByName($name)
                        ->filterByLocale('fr')
                    ->endUse()
                    ->findOne()
                ;

                if ($item) $this->translatedIds['avantages'][$id] = $item->getId();
            }
        }
        elseif ($locale == 'de' && isset($this->translatedIds['avantages'][$id])) {
            $item = \Cungfoo\Model\AvantageQuery::create()
                ->filterById($this->translatedIds['avantages'][$id])
                ->findOne()
            ;

            if (!$item)
            {
                return;
            }

            $item
                ->setLocale($locale)
                ->setName($name)
                ->setDescription($description)
                ->save()
            ;
        }
    }

    protected function baignadesI18nCallback(array $explodedLine, array &$buffer, array &$unset, $output, $translateIds = false)
    {
        list($id, $locale, $name, $description, $keywords) = $explodedLine;

        if ($translateIds)
        {
            if ($locale == 'fr')
            {
                $item = \Cungfoo\Model\BaignadeQuery::create()
                    ->useI18nQuery()
                        ->filterByName($name)
                        ->filterByLocale('fr')
                    ->endUse()
                    ->findOne()
                ;

                if ($item) $this->translatedIds['baignades'][$id] = $item->getId();
            }
        }
        elseif ($locale == 'de' && isset($this->translatedIds['baignades'][$id])) {
            $item = \Cungfoo\Model\BaignadeQuery::create()
                ->filterById($this->translatedIds['baignades'][$id])
                ->findOne()
            ;

            if (!$item)
            {
                return;
            }

            $item
                ->setLocale($locale)
                ->setName($name)
                ->setDescription($description)
                ->setKeywords($keywords)
                ->save()
            ;
        }
    }

    protected function etablissementsI18nCallback(array $explodedLine, array &$buffer, array &$unset, $output, $translateIds = false)
    {
        list($id, $locale, $country, $ouverture_reception, $ouverture_camping, $arrivees_departs, $description, $joker) = $explodedLine;

        if ($translateIds)
        {
            if ($locale == 'fr')
            {
                $item = \Cungfoo\Model\EtablissementQuery::create()
                    ->useI18nQuery()
                        ->filterByDescription($description, \Criteria::LIKE)
                        ->filterByLocale('fr')
                    ->endUse()
                    ->findOne()
                ;

                if ($item) $this->translatedIds['etablissements'][$id] = $item->getId();
            }
        }
        elseif ($locale == 'de' && isset($this->translatedIds['etablissements'][$id])) {
            $item = \Cungfoo\Model\EtablissementQuery::create()
                ->filterById($this->translatedIds['etablissements'][$id])
                ->findOne()
            ;

            if (!$item)
            {
                return;
            }

            $item
                ->setLocale($locale)
                ->setCountry($country)
                ->setOuvertureReception($ouverture_reception)
                ->setOuvertureCamping($ouverture_camping)
                ->setArriveesDeparts($arrivees_departs)
                ->setDescription($description)
                ->save()
            ;
        }
    }

    protected function etablissements2I18nCallback(array $explodedLine, array &$buffer, array &$unset, $output, $translateIds = false)
    {
        list($id, $locale, $country, $ouverture_reception, $ouverture_camping, $arrivees_departs, $description) = $explodedLine;

        if ($translateIds)
        {
            if ($locale == 'fr')
            {
                $item = \Cungfoo\Model\EtablissementQuery::create()
                    ->useI18nQuery()
                        ->filterByDescription($description, \Criteria::LIKE)
                        ->filterByLocale('fr')
                    ->endUse()
                    ->findOne()
                ;

                if ($item) $this->translatedIds['etablissements'][$id] = $item->getId();
            }
        }
        elseif ($locale == 'de' && isset($this->translatedIds['etablissements'][$id])) {
            $item = \Cungfoo\Model\EtablissementQuery::create()
                ->filterById($this->translatedIds['etablissements'][$id])
                ->findOne()
            ;

            if (!$item)
            {
                return;
            }

            $item
                ->setLocale($locale)
                ->setCountry($country)
                ->setOuvertureReception($ouverture_reception)
                ->setOuvertureCamping($ouverture_camping)
                ->setArriveesDeparts($arrivees_departs)
                ->setDescription($description)
                ->save()
            ;
        }
    }

    protected function ideesWEI18nCallback(array $explodedLine, array &$buffer, array &$unset, $output, $translateIds = false)
    {
        list($id, $locale, $titre, $lien) = $explodedLine;

        if ($translateIds)
        {
            if ($locale == 'fr')
            {
                $item = \Cungfoo\Model\IdeeWeekendQuery::create()
                    ->useI18nQuery()
                        ->filterByTitre($titre)
                        ->filterByLocale('fr')
                    ->endUse()
                    ->findOne()
                ;

                if ($item) $this->translatedIds['idees_weekend'][$id] = $item->getId();
            }
        }
        elseif ($locale == 'de' && isset($this->translatedIds['idees_weekend'][$id])) {
            $item = \Cungfoo\Model\IdeeWeekendQuery::create()
                ->filterById($this->translatedIds['idees_weekend'][$id])
                ->findOne()
            ;

            if (!$item)
            {
                return;
            }

            $item
                ->setLocale($locale)
                ->setTitre($titre)
                ->setLien($lien)
                ->save()
            ;
        }
    }

    protected function misesEnAvantI18nCallback(array $explodedLine, array &$buffer, array &$unset, $output, $translateIds = false)
    {
        list($id, $locale, $titre, $accroche, $lien, $titre_lien) = $explodedLine;

        if ($translateIds)
        {
            if ($locale == 'fr')
            {
                $item = \Cungfoo\Model\MiseEnAvantQuery::create()
                    ->useI18nQuery()
                        ->filterByTitre($titre)
                        ->filterByLocale('fr')
                    ->endUse()
                    ->findOne()
                ;

                if ($item) $this->translatedIds['mises_en_avant'][$id] = $item->getId();
            }
        }
        elseif ($locale == 'de' && isset($this->translatedIds['mises_en_avant'][$id])) {
            $item = \Cungfoo\Model\MiseEnAvantQuery::create()
                ->filterById($this->translatedIds['mises_en_avant'][$id])
                ->findOne()
            ;

            if (!$item)
            {
                return;
            }

            $item
                ->setLocale($locale)
                ->setTitre($titre)
                ->setAccroche($accroche)
                ->setLien($lien)
                ->setTitreLien($titre_lien)
                ->save()
            ;
        }
    }

    protected function regionsI18nCallback(array $explodedLine, array &$buffer, array &$unset, $output, $translateIds = false)
    {
        list($id, $locale, $slug, $name, $introduction, $description) = $explodedLine;

        if ($translateIds)
        {
            if ($locale == 'fr')
            {
                $item = \Cungfoo\Model\RegionQuery::create()
                    ->useI18nQuery()
                        ->filterBySlug($slug)
                        ->filterByLocale('fr')
                    ->endUse()
                    ->findOne()
                ;

                if ($item) $this->translatedIds['regions'][$id] = $item->getId();
            }
        }
        elseif ($locale == 'de' && isset($this->translatedIds['regions'][$id])) {
            $item = \Cungfoo\Model\RegionQuery::create()
                ->filterById($this->translatedIds['regions'][$id])
                ->findOne()
            ;

            if (!$item)
            {
                return;
            }

            $item
                ->setLocale($locale)
                ->setSlug($slug)
                ->setName($name)
                ->setIntroduction($introduction)
                ->setDescription($description)
                ->save()
            ;
        }
    }

    protected function servicesComplementairesI18nCallback(array $explodedLine, array &$buffer, array &$unset, $output, $translateIds = false)
    {
        list($id, $locale, $name, $description, $keywords) = $explodedLine;

        if ($translateIds)
        {
            if ($locale == 'fr')
            {
                $item = \Cungfoo\Model\ServiceComplementaireQuery::create()
                    ->useI18nQuery()
                        ->filterByName($name)
                        ->filterByLocale('fr')
                    ->endUse()
                    ->findOne()
                ;

                if ($item) $this->translatedIds['services'][$id] = $item->getId();
            }
        }
        elseif ($locale == 'de' && isset($this->translatedIds['services'][$id])) {
            $item = \Cungfoo\Model\ServiceComplementaireQuery::create()
                ->filterById($this->translatedIds['services'][$id])
                ->findOne()
            ;

            if (!$item)
            {
                return;
            }

            $item
                ->setLocale($locale)
                ->setName($name)
                ->setDescription($description)
                ->setKeywords($keywords)
                ->save()
            ;
        }
    }

    protected function situationsGeographiquesI18nCallback(array $explodedLine, array &$buffer, array &$unset, $output, $translateIds = false)
    {
        list($id, $locale, $name, $description, $keywords) = $explodedLine;

        if ($translateIds)
        {
            if ($locale == 'fr')
            {
                $item = \Cungfoo\Model\SituationGeographiqueQuery::create()
                    ->useI18nQuery()
                        ->filterByName($name)
                        ->filterByLocale('fr')
                    ->endUse()
                    ->findOne()
                ;

                if ($item) $this->translatedIds['situations'][$id] = $item->getId();
            }
        }
        elseif ($locale == 'de' && isset($this->translatedIds['situations'][$id])) {
            $item = \Cungfoo\Model\SituationGeographiqueQuery::create()
                ->filterById($this->translatedIds['situations'][$id])
                ->findOne()
            ;

            if (!$item)
            {
                return;
            }

            $item
                ->setLocale($locale)
                ->setName($name)
                ->setDescription($description)
                ->setKeywords($keywords)
                ->save()
            ;
        }
    }

    protected function tagsI18nCallback(array $explodedLine, array &$buffer, array &$unset, $output, $translateIds = false)
    {
        list($id, $locale, $name) = $explodedLine;

        if ($translateIds)
        {
            if ($locale == 'fr')
            {
                $item = \Cungfoo\Model\TagQuery::create()
                    ->useI18nQuery()
                        ->filterByName($name)
                        ->filterByLocale('fr')
                    ->endUse()
                    ->findOne()
                ;

                if ($item) $this->translatedIds['tags'][$id] = $item->getId();
            }
        }
        elseif ($locale == 'de' && isset($this->translatedIds['tags'][$id])) {
            $item = \Cungfoo\Model\TagQuery::create()
                ->filterById($this->translatedIds['tags'][$id])
                ->findOne()
            ;

            if (!$item)
            {
                return;
            }

            $item
                ->setLocale($locale)
                ->setName($name)
                ->save()
            ;
        }
    }

    protected function thematiquesI18nCallback(array $explodedLine, array &$buffer, array &$unset, $output, $translateIds = false)
    {
        list($id, $locale, $name, $description, $keywords) = $explodedLine;

        if ($translateIds)
        {
            if ($locale == 'fr')
            {
                $item = \Cungfoo\Model\ThematiqueQuery::create()
                    ->useI18nQuery()
                        ->filterByName($name)
                        ->filterByLocale('fr')
                    ->endUse()
                    ->findOne()
                ;

                if ($item) $this->translatedIds['thematiques'][$id] = $item->getId();
            }
        }
        elseif ($locale == 'de' && isset($this->translatedIds['thematiques'][$id])) {
            $item = \Cungfoo\Model\ThematiqueQuery::create()
                ->filterById($this->translatedIds['thematiques'][$id])
                ->findOne()
            ;

            if (!$item)
            {
                return;
            }

            $item
                ->setLocale($locale)
                ->setName($name)
                ->setDescription($description)
                ->setKeywords($keywords)
                ->save()
            ;
        }
    }

    protected function typesHebergementsI18nCallback(array $explodedLine, array &$buffer, array &$unset, $output, $translateIds = false)
    {
        list($id, $locale, $name, $surface, $type_terrasse, $description, $composition, $presentation, $capacite_hebergement, $dimensions, $agencement, $equipements, $annee_utilisation, $remarque_1, $remarque_2, $remarque_3, $remarque_4) = $explodedLine;

        if ($translateIds)
        {
            if ($locale == 'fr')
            {
                $item = \Cungfoo\Model\TypeHebergementQuery::create()
                    ->useI18nQuery()
                        ->filterByName($name)
                        ->filterByLocale('fr')
                    ->endUse()
                    ->findOne()
                ;

                if ($item) $this->translatedIds['types_hebergement'][$id] = $item->getId();
            }
        }
        elseif ($locale == 'de' && isset($this->translatedIds['types_hebergement'][$id])) {
            $item = \Cungfoo\Model\TypeHebergementQuery::create()
                ->filterById($this->translatedIds['types_hebergement'][$id])
                ->findOne()
            ;

            if (!$item)
            {
                return;
            }

            $item
                ->setLocale($locale)
                ->setName($name)
                ->setSurface($surface)
                ->setTypeTerrasse($type_terrasse)
                ->setDescription($description)
                ->setComposition($composition)
                ->setPresentation($presentation)
                ->setCapaciteHebergement($capacite_hebergement)
                ->setDimensions($dimensions)
                ->setAgencement($agencement)
                ->setEquipements($equipements)
                ->setAnneeUtilisation($annee_utilisation)
                ->setRemarque1($remarque_1)
                ->setRemarque2($remarque_2)
                ->setRemarque3($remarque_3)
                ->setRemarque4($remarque_4)
                ->save()
            ;
        }
    }

    protected function villesI18nCallback(array $explodedLine, array &$buffer, array &$unset, $output, $translateIds = false)
    {
        list($id, $locale, $slug, $name, $introduction, $description) = $explodedLine;

        if ($translateIds)
        {
            if ($locale == 'fr')
            {
                $item = \Cungfoo\Model\VilleQuery::create()
                    ->useI18nQuery()
                        ->filterByName($name)
                        ->filterByLocale('fr')
                    ->endUse()
                    ->findOne()
                ;

                if ($item) $this->translatedIds['villes'][$id] = $item->getId();
            }
        }
        elseif ($locale == 'de' && isset($this->translatedIds['villes'][$id])) {
            $item = \Cungfoo\Model\VilleQuery::create()
                ->filterById($this->translatedIds['villes'][$id])
                ->findOne()
            ;

            if (!$item)
            {
                return;
            }

            $item
                ->setLocale($locale)
                ->setSlug($slug)
                ->setName($name)
                ->setIntroduction($introduction)
                ->setDescription($description)
                ->save()
            ;
        }
    }
}
