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

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->setAttribute('groups',
            array(
                array(
                    'title'         => 'etablissement.group.resalys',
                    'description'   => 'Données resalys',
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
                        'categorie',
                        'capacite',
                    )
                ),
                array(
                    'title'         => 'etablissement.group.cms',
                    'description'   => 'Données CMS',
                    'content'       => array(
                        'vignette',
                        'vignette_deleted',
                        'plan_path',
                        'plan_path_deleted',
                        'geo_coordinate_x',
                        'geo_coordinate_y',
                        'video_path',
                        'image_360_path',
                        'etablissementI18ns',
                    )
                ),
            )
        );
    }
} // EtablissementType
