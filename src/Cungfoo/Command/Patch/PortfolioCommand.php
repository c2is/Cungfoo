<?php
namespace Cungfoo\Command\Patch;

use Cungfoo\Command\Command;

use Symfony\Component\Console\Input\InputArgument,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Input\InputOption,
    Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Filesystem\Filesystem,
    Symfony\Component\Finder\Finder;

use Cungfoo\Model\EtablissementQuery;
use Cungfoo\Model\PortfolioMedia;
use Cungfoo\Model\PortfolioMediaQuery;
use Cungfoo\Model\PortfolioUsage;
use Cungfoo\Model\PortfolioTag;
use Cungfoo\Model\PortfolioTagQuery;
use Cungfoo\Model\PortfolioMediaTag;
use Cungfoo\Model\PortfolioTagCategory;
use Cungfoo\Model\TagQuery;

class PortfolioCommand extends Command
{
    protected $imageList = array();
    protected $tagList = array();
    protected $tagImageList = array();

    protected $tagCategoryId = null;

    protected function configure()
    {
        $this
            ->setName('patch:portfolio')
            ->setDescription('Mise en place du portfolio')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $con = \Propel::getConnection();
        $con->beginTransaction();

        try
        {
            $tagCategory = new PortfolioTagCategory();
            $tagCategory
                ->setName('Camping')
                ->setSlug('camping')
                ->save($con)
            ;

            $this->tagCategoryId = $tagCategory->getId();

            $this->process($con, 'Etablissement', 'etablissement', array('plan_path', 'vignette'));
            $this->process($con, 'TypeHebergement', 'type_hebergement', array('image_hebergement_path', 'image_composition_path'));
            $this->process($con, 'TypeHebergementCapacite', 'type_hebergement_capacite', array('image_menu', 'image_page'));
            $this->process($con, 'CategoryTypeHebergement', 'category_type_hebergement', array('image_menu', 'image_page'));
            $this->process($con, 'Ville', 'ville', array('image_detail_1', 'image_detail_2'));
            $this->process($con, 'Region', 'region', array('image_path', 'image_encart_path', 'image_encart_petite_path', 'image_detail_1', 'image_detail_2'));
            $this->process($con, 'RegionRef', 'region_ref', array('image_detail_1', 'image_detail_2'));
            $this->process($con, 'Departement', 'departement', array('image_detail_1', 'image_detail_2'));
            $this->process($con, 'Pays', 'pays', array('image_detail_1', 'image_detail_2'));
            $this->process($con, 'Destination', 'destination', array('image_detail_1', 'image_detail_2'));
            $this->process($con, 'Activite', 'activite', array('image_path', 'vignette'));
            $this->process($con, 'Baignade', 'baignade', array('image_path', 'vignette'));
            $this->process($con, 'Thematique', 'thematique', array('image_path'));
            $this->process($con, 'ServiceComplementaire', 'service_complementaire', array('image_path', 'vignette'));
            $this->process($con, 'Personnage', 'personnage', array('image_path'));
            $this->process($con, 'Avantage', 'avantage', array('image_path'));
            $this->process($con, 'MultimediaEtablissement', 'etablissement', array('image_path'));
            $this->process($con, 'MiseEnAvant', 'mise_en_avant', array('image_fond_path', 'illustration_path'));
            $this->process($con, 'VosVacances', 'vos_vacances', array('image_path'));
            $this->process($con, 'IdeeWeekend', 'idee_weekend', array('image_path'));
            $this->process($con, 'Theme', 'theme', array('image_path'));
            $this->process($con, 'BonPlan', 'bon_plan', array('image_menu', 'image_page', 'image_liste'));
            $this->process($con, 'DemandeAnnulation', 'demande_annulation', array('file_1', 'file_2', 'file_3', 'file_4'));

            $con->commit();
        }
        catch (\Exception $e)
        {
            $con->rollback();
            throw new \Exception($e->getMessage().'\n'.$e->getTraceAsString(), 1);

        }

        return true;
    }

    protected function process($con, $model, $table, $options)
    {
        $result = call_user_func('\\Cungfoo\\Model\\'.$model.'Query::create')->select(array_merge(array('id'), $options))->find($con)->toArray();

        foreach ($result as $value) {
            $elementId = $value['id'];
            foreach ($options as $option) {
                $this->insertMedia($con, $elementId, $this->getImage($value[$option]));

                switch ($model) {
                    case 'MultimediaEtablissement':
                        $elementId = EtablissementQuery::create()
                            ->select('id')
                            ->useMultimediaEtablissementQuery()
                                ->filterById($elementId)
                            ->endUse()
                            ->findOne($con)
                        ;

                        $this->insertMediaUsage($con, $elementId, $table, 'slider', $this->getImage($value[$option], true));

                        $tags = TagQuery::create()
                            ->select('slug')
                            ->useMultimediaEtablissementTagQuery()
                                ->filterByMultimediaEtablissementId($elementId)
                            ->endUse()
                            ->find($con)
                        ;

                        foreach ($tags as $tag) {
                            $this->insertTag($con, $this->getTag($tag));
                            $this->insertMediaTag($con, $this->getImage($value[$option], true), $this->getTag($tag, true));
                        }
                        break;

                    default:
                        $this->insertTag($con, $this->getTag($table));
                        $this->insertMediaUsage($con, $elementId, $table, $option, $this->getImage($value[$option], true));
                        break;
                }
            }
        }
    }

    protected function insertMedia($con, $elementId, $image)
    {
        if (!$image) return;

        $title = str_replace(array(end(explode('.', addslashes($image))), '-', '.'), array('', ' ', ''), addslashes($image));

        $media = new PortfolioMedia();
        $media
            ->setLocale('fr')
            ->setFile('portfolio/'.addslashes($image))
            ->setTitle($title)
            ->setLocale('de')
            ->setFile('portfolio/'.addslashes($image))
            ->setTitle($title)
            ->setActive(true)
            ->save($con)
        ;

        $this->imageList[$image] = $media->getId();
    }

    protected function insertMediaUsage($con, $elementId, $table, $column, $image)
    {
        if (!$image) return;

        $mediaId = $this->imageList[$image];

        $usage = new PortfolioUsage();
        $usage
            ->setMediaId($mediaId)
            ->setTableRef($table)
            ->setColumnRef($column)
            ->setElementId($elementId)
            ->setActive(true)
            ->save($con)
        ;
    }

    protected function insertTag($con, $tag)
    {
        if (!$tag) return;

        $tagObject = new PortfolioTag();
        $tagObject
            ->setCategoryId($this->tagCategoryId)
            ->setLocale('fr')
            ->setName($tag)
            ->setSlug($tag)
            ->setLocale('de')
            ->setName($tag)
            ->setSlug($tag)
            ->setActive(true)
            ->save($con)
        ;

        $this->tagList[$tag] = $tagObject->getId();
    }

    protected function insertMediaTag($con, $image, $tag)
    {
        if (!$image) return;

        $mediaId = $this->imageList[$image];

        if (!$tag) return;

        $tagId = $this->tagList[$tag];

        if (in_array($mediaId, $this->tagImageList[$tag])) return;

        $this->tagImageList[$tag][] = $mediaId;

        $mediaTag = new PortfolioMediaTag();
        $mediaTag
            ->setMediaId($mediaId)
            ->setTagId($tagId)
            ->save($con)
        ;
    }

    protected function getImage($field, $override = false)
    {
        $imageArray = explode('/', $field);
        $image = end($imageArray);

        if (!$image) {
            return '';
        }

        if (array_key_exists($image, $this->imageList)) {
            return $override ? $image : '';
        }

        $this->imageList[$image] = 0;

        $fs = new Filesystem();
        $source = $this->getProjectDirectory().'/web/'.$field;
        $destination = $this->getProjectDirectory().'/web/portfolio/'.$image;
        if (file_exists($source) && is_file($source)) {
            $fs->copy($source, $destination);
        }

        return $image;
    }

    protected function getTag($tag, $override = false)
    {
        if (array_key_exists($tag, $this->tagList)) {
            return $override ? $tag : '';
        }

        $this->tagImageList[$tag] = array();

        $this->tagList[$tag] = 0;

        return $tag;
    }
}
