<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'type_hebergement_capacite' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseTypeHebergementCapaciteType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'type_hebergement_capacite.id',
            'required' => false,
        ));
        $builder->add('image_menu', 'cungfoo_file', array(
            'constraints' => array(
            ),
            'label' => 'type_hebergement_capacite.image_menu',
            'required' => false,
        ));
        $builder->add('image_menu_deleted', 'checkbox', array(
            'constraints' => array(
            ),
            'property_path' => false,
            'label' => 'type_hebergement_capacite.image_menu_deleted',
            'required' => false,
        ));
        $builder->add('image_page', 'cungfoo_file', array(
            'constraints' => array(
            ),
            'label' => 'type_hebergement_capacite.image_page',
            'required' => false,
        ));
        $builder->add('image_page_deleted', 'checkbox', array(
            'constraints' => array(
            ),
            'property_path' => false,
            'label' => 'type_hebergement_capacite.image_page_deleted',
            'required' => false,
        ));
        $builder->add('active', 'checkbox', array(
            'constraints' => array(
            ),
            'label' => 'type_hebergement_capacite.active',
            'required' => false,
        ));
        $builder->add('sortable_rank', 'integer', array(
            'constraints' => array(
            ),
            'label' => 'type_hebergement_capacite.sortable_rank',
            'required' => false,
        ));
        $builder->add('type_hebergement_capaciteI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\TypeHebergementCapaciteI18n',
            'languages' => array(
                0 => 'fr',
                1 => 'de',
            ),
            'label' => 'type_hebergement_capacite.type_hebergement_capaciteI18ns',
            'columns' => array(
                'name' => array(
                    'required' => false,
                    'label' => 'type_hebergement_capacite.name',
                    'type' => 'text',
                    'constraints' => array(
                        new Assert\NotBlank(),
                    ),
                ),
                'slug' => array(
                    'required' => false,
                    'label' => 'type_hebergement_capacite.slug',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'accroche' => array(
                    'required' => false,
                    'label' => 'type_hebergement_capacite.accroche',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'description' => array(
                    'required' => false,
                    'label' => 'type_hebergement_capacite.description',
                    'type' => 'textarea',
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
            'data_class' => 'Cungfoo\Model\TypeHebergementCapacite',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'TypeHebergementCapacite';
    }

} // BaseTypeHebergementCapaciteType
