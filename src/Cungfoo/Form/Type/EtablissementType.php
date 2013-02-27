<?php

namespace Cungfoo\Form\Type;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\Form\FormView,
    Symfony\Component\Form\FormInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\Base\BaseEtablissementType;

/**
 * Test class for Additional builder enabled on the 'etablissement' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type
 */
class EtablissementType extends BaseEtablissementType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        //$this->getMetadata($options['data_class'])
        //    ->addPropertyConstraint('field1', new Assert\MinLength(5))
        //;
    }

    public function getCodeOptions()
    {
        return array_merge(parent::getCodeOptions(), array('read_only' => true, 'attr' => array(
            'rel'   => "tooltip",
            'title' => "crud.tooltip.resalys",
        )));
    }

    public function getNameOptions()
    {
        return array_merge(parent::getNameOptions(), array('read_only' => true, 'attr' => array(
            'rel'   => "tooltip",
            'title' => "crud.tooltip.resalys",
        )));
    }

    public function getVilleOptions()
    {
        return array_merge(parent::getVilleOptions(), array('read_only' => true, 'attr' => array(
            'rel'   => "tooltip",
            'title' => "crud.tooltip.resalys",
        )));
    }

    public function getDepartementOptions()
    {
        return array_merge(parent::getDepartementOptions(), array('read_only' => true, 'attr' => array(
            'rel'   => "tooltip",
            'title' => "crud.tooltip.resalys",
        )));
    }

    public function getCategorieOptions()
    {
        return array_merge(parent::getCategorieOptions(), array('read_only' => true, 'attr' => array(
            'rel'   => "tooltip",
            'title' => "crud.tooltip.resalys",
        )));
    }

    public function getGeoCoordinateXOptions()
    {
        return array_merge(parent::getGeoCoordinateXOptions(), array('read_only' => true, 'attr' => array(
            'rel'   => "tooltip",
            'title' => "crud.tooltip.resalys",
        )));
    }

    public function getGeoCoordinateYOptions()
    {
        return array_merge(parent::getGeoCoordinateYOptions(), array('read_only' => true, 'attr' => array(
            'rel'   => "tooltip",
            'title' => "crud.tooltip.resalys",
        )));
    }

    public function getCapaciteOptions()
    {
        return array_merge(parent::getCapaciteOptions(), array('read_only' => true, 'attr' => array(
            'rel'   => "tooltip",
            'title' => "crud.tooltip.resalys",
        )));
    }

    public function getAddress1Options()
    {
        return array_merge(parent::getAddress1Options(), array('read_only' => true, 'attr' => array(
            'rel'   => "tooltip",
            'title' => "crud.tooltip.resalys",
        )));
    }

    public function getAddress2Options()
    {
        return array_merge(parent::getAddress2Options(), array('read_only' => true, 'attr' => array(
            'rel'   => "tooltip",
            'title' => "crud.tooltip.resalys",
        )));
    }

    public function getCityOptions()
    {
        return array_merge(parent::getCityOptions(), array('read_only' => true, 'attr' => array(
            'rel'   => "tooltip",
            'title' => "crud.tooltip.resalys",
        )));
    }

    public function getZipOptions()
    {
        return array_merge(parent::getZipOptions(), array('read_only' => true, 'attr' => array(
            'rel'   => "tooltip",
            'title' => "crud.tooltip.resalys",
        )));
    }

    public function getCountryOptions()
    {
        return array_merge(parent::getCountryOptions(), array('read_only' => true, 'attr' => array(
            'rel'   => "tooltip",
            'title' => "crud.tooltip.resalys",
        )));
    }

    public function getCountryCodeOptions()
    {
        return array_merge(parent::getCountryCodeOptions(), array('read_only' => true, 'attr' => array(
            'rel'   => "tooltip",
            'title' => "crud.tooltip.resalys",
        )));
    }

    public function getMailOptions()
    {
        return array_merge(parent::getMailOptions(), array('read_only' => true, 'attr' => array(
            'rel'   => "tooltip",
            'title' => "crud.tooltip.resalys",
        )));
    }

    public function getPhone1Options()
    {
        return array_merge(parent::getPhone1Options(), array('read_only' => true, 'attr' => array(
            'rel'   => "tooltip",
            'title' => "crud.tooltip.resalys",
        )));
    }

    public function getPhone2Options()
    {
        return array_merge(parent::getPhone2Options(), array('read_only' => true, 'attr' => array(
            'rel'   => "tooltip",
            'title' => "crud.tooltip.resalys",
        )));
    }

    public function getFaxOptions()
    {
        return array_merge(parent::getFaxOptions(), array('read_only' => true, 'attr' => array(
            'rel'   => "tooltip",
            'title' => "crud.tooltip.resalys",
        )));
    }

    public function getClosingDateOptions()
    {
        return array_merge(parent::getClosingDateOptions(), array('read_only' => true, 'attr' => array(
            'rel'   => "tooltip",
            'title' => "crud.tooltip.resalys",
        )));
    }

    public function getOpeningDateOptions()
    {
        return array_merge(parent::getOpeningDateOptions(), array('read_only' => true, 'attr' => array(
            'rel'   => "tooltip",
            'title' => "crud.tooltip.resalys",
        )));
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->setAttribute('groups',
            array(
                array(
                    'title'         => 'crud.tab.datas',
                    'content'       => array(
                        'code',
                        'name',
                        'title',
                        'address1',
                        'address2',
                        'zip',
                        'city',
                        'mail',
                        'country_code',
                        'phone1',
                        'phone2',
                        'fax',
                        'opening_date',
                        'closing_date',
                        'ville',
                        'departement',
                        'categorie',
                        'capacite',
                        'geo_coordinate_x',
                        'geo_coordinate_y',
                        'etablissement_related_by_related_1',
                        'etablissement_related_by_related_2',
                        'etablissementI18ns',
                    )
                ),
                array(
                    'title'         => 'crud.tab.medias',
                    'content'       => array(
                        'vignette',
                        'vignette_deleted',
                        'plan_path',
                        'plan_path_deleted',
                        'video_path',
                        'image_360_path',
                    )
                ),
                array(
                    'title'         => 'crud.tab.parameters',
                    'content'       => array(
                        'active',
                    )
                ),
            )
        );
    }
} // EtablissementType
