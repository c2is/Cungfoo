<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'etablissement' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseEtablissementType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'etablissement.id',
            'required' => false,
        ));
        $builder->add('code', 'integer', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'etablissement.code',
            'required' => false,
        ));
        $builder->add('name', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'etablissement.name',
            'required' => false,
        ));
        $builder->add('address1', 'text', array(
            'constraints' => array(
            ),
            'label' => 'etablissement.address1',
            'required' => false,
        ));
        $builder->add('address2', 'text', array(
            'constraints' => array(
            ),
            'label' => 'etablissement.address2',
            'required' => false,
        ));
        $builder->add('zip', 'text', array(
            'constraints' => array(
            ),
            'label' => 'etablissement.zip',
            'required' => false,
        ));
        $builder->add('city', 'text', array(
            'constraints' => array(
            ),
            'label' => 'etablissement.city',
            'required' => false,
        ));
        $builder->add('mail', 'text', array(
            'constraints' => array(
            ),
            'label' => 'etablissement.mail',
            'required' => false,
        ));
        $builder->add('country_code', 'text', array(
            'constraints' => array(
            ),
            'label' => 'etablissement.country_code',
            'required' => false,
        ));
        $builder->add('phone1', 'text', array(
            'constraints' => array(
            ),
            'label' => 'etablissement.phone1',
            'required' => false,
        ));
        $builder->add('phone2', 'text', array(
            'constraints' => array(
            ),
            'label' => 'etablissement.phone2',
            'required' => false,
        ));
        $builder->add('fax', 'text', array(
            'constraints' => array(
            ),
            'label' => 'etablissement.fax',
            'required' => false,
        ));
        $builder->add('opening_date', 'datetime', array(
            'constraints' => array(
            ),
            'label' => 'etablissement.opening_date',
            'required' => false,
        ));
        $builder->add('closing_date', 'datetime', array(
            'constraints' => array(
            ),
            'label' => 'etablissement.closing_date',
            'required' => false,
        ));
        $builder->add('ville', 'model', array(
            'class' => '\Cungfoo\Model\Ville',
            'constraints' => array(
            ),
            'label' => 'etablissement.ville',
            'required' => false,
        ));
        $builder->add('categorie', 'model', array(
            'class' => '\Cungfoo\Model\Categorie',
            'constraints' => array(
            ),
            'label' => 'etablissement.categorie',
            'required' => false,
        ));
        $builder->add('geo_coordinate_x', 'text', array(
            'constraints' => array(
            ),
            'label' => 'etablissement.geo_coordinate_x',
            'required' => false,
        ));
        $builder->add('geo_coordinate_y', 'text', array(
            'constraints' => array(
            ),
            'label' => 'etablissement.geo_coordinate_y',
            'required' => false,
        ));
        $builder->add('type_hebergements', 'model', array(
            'class' => 'Cungfoo\Model\TypeHebergement',
            'constraints' => array(
            ),
            'multiple' => true,
            'label' => 'etablissement.type_hebergements',
            'required' => false,
        ));
        $builder->add('destinations', 'model', array(
            'class' => 'Cungfoo\Model\Destination',
            'constraints' => array(
            ),
            'multiple' => true,
            'label' => 'etablissement.destinations',
            'required' => false,
        ));
        $builder->add('activites', 'model', array(
            'class' => 'Cungfoo\Model\Activite',
            'constraints' => array(
            ),
            'multiple' => true,
            'label' => 'etablissement.activites',
            'required' => false,
        ));
        $builder->add('service_complementaires', 'model', array(
            'class' => 'Cungfoo\Model\ServiceComplementaire',
            'constraints' => array(
            ),
            'multiple' => true,
            'label' => 'etablissement.service_complementaires',
            'required' => false,
        ));
        $builder->add('etablissementI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\EtablissementI18n',
            'languages' => array(
                0 => 'fr',
                1 => 'en',
                2 => 'de',
            ),
            'label' => 'etablissement.etablissementI18ns',
            'columns' => array(
                'country' => array(
                    'required' => false,
                    'label' => 'etablissement.country',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
            ),
            'required' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cungfoo\Model\Etablissement',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Etablissement';
    }

} // BaseEtablissementType
