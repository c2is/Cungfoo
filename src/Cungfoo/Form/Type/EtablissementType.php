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
        return array_merge(parent::getCodeOptions(), array('disabled' => true));
    }

    public function getNameOptions()
    {
        return array_merge(parent::getNameOptions(), array('disabled' => true));
    }

    public function getVilleOptions()
    {
        return array_merge(parent::getVilleOptions(), array('disabled' => true));
    }

    public function getDepartementOptions()
    {
        return array_merge(parent::getDepartementOptions(), array('disabled' => true));
    }

    public function getCategorieOptions()
    {
        return array_merge(parent::getCategorieOptions(), array('disabled' => true));
    }

    public function getGeoCoordinateXOptions()
    {
        return array_merge(parent::getGeoCoordinateXOptions(), array('disabled' => true));
    }

    public function getGeoCoordinateYOptions()
    {
        return array_merge(parent::getGeoCoordinateYOptions(), array('disabled' => true));
    }

    public function getCapaciteOptions()
    {
        return array_merge(parent::getCapaciteOptions(), array('disabled' => true));
    }

    public function getAddress1Options()
    {
        return array_merge(parent::getAddress1Options(), array('disabled' => true));
    }

    public function getAddress2Options()
    {
        return array_merge(parent::getAddress2Options(), array('disabled' => true));
    }

    public function getCityOptions()
    {
        return array_merge(parent::getCityOptions(), array('disabled' => true));
    }

    public function getZipOptions()
    {
        return array_merge(parent::getZipOptions(), array('disabled' => true));
    }

    public function getCountryOptions()
    {
        return array_merge(parent::getCountryOptions(), array('disabled' => true));
    }

    public function getCountryCodeOptions()
    {
        return array_merge(parent::getCountryCodeOptions(), array('disabled' => true));
    }

    public function getMailOptions()
    {
        return array_merge(parent::getMailOptions(), array('disabled' => true));
    }

    public function getPhone1Options()
    {
        return array_merge(parent::getPhone1Options(), array('disabled' => true));
    }

    public function getPhone2Options()
    {
        return array_merge(parent::getPhone2Options(), array('disabled' => true));
    }

    public function getFaxOptions()
    {
        return array_merge(parent::getFaxOptions(), array('disabled' => true));
    }

    public function getClosingDateOptions()
    {
        return array_merge(parent::getClosingDateOptions(), array('disabled' => true));
    }

    public function getOpeningDateOptions()
    {
        return array_merge(parent::getOpeningDateOptions(), array('disabled' => true));
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
