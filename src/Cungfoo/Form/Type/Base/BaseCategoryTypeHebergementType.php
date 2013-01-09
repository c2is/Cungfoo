<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'category_type_hebergement' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseCategoryTypeHebergementType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'category_type_hebergement.id',
            'required' => false,
        ));
        $builder->add('code', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'category_type_hebergement.code',
            'required' => false,
        ));
        $builder->add('minimum_price', 'text', array(
            'constraints' => array(
            ),
            'label' => 'category_type_hebergement.minimum_price',
            'required' => false,
        ));
        $builder->add('image_menu', 'cungfoo_file', array(
            'constraints' => array(
            ),
            'label' => 'category_type_hebergement.image_menu',
            'required' => false,
        ));
        $builder->add('image_menu_deleted', 'checkbox', array(
            'constraints' => array(
            ),
            'property_path' => false,
            'label' => 'category_type_hebergement.image_menu_deleted',
            'required' => false,
        ));
        $builder->add('image_page', 'cungfoo_file', array(
            'constraints' => array(
            ),
            'label' => 'category_type_hebergement.image_page',
            'required' => false,
        ));
        $builder->add('image_page_deleted', 'checkbox', array(
            'constraints' => array(
            ),
            'property_path' => false,
            'label' => 'category_type_hebergement.image_page_deleted',
            'required' => false,
        ));
        $builder->add('active', 'checkbox', array(
            'constraints' => array(
            ),
            'label' => 'category_type_hebergement.active',
            'required' => false,
        ));
        $builder->add('sortable_rank', 'integer', array(
            'constraints' => array(
            ),
            'label' => 'category_type_hebergement.sortable_rank',
            'required' => false,
        ));
        $builder->add('category_type_hebergementI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\CategoryTypeHebergementI18n',
            'languages' => array(
                0 => 'fr',
                1 => 'en',
                2 => 'de',
                3 => 'nl',
            ),
            'label' => 'category_type_hebergement.category_type_hebergementI18ns',
            'columns' => array(
                'name' => array(
                    'required' => false,
                    'label' => 'category_type_hebergement.name',
                    'type' => 'text',
                    'constraints' => array(
                        new Assert\NotBlank(),
                    ),
                ),
                'slug' => array(
                    'required' => false,
                    'label' => 'category_type_hebergement.slug',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'accroche' => array(
                    'required' => false,
                    'label' => 'category_type_hebergement.accroche',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'description' => array(
                    'required' => false,
                    'label' => 'category_type_hebergement.description',
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
            'data_class' => 'Cungfoo\Model\CategoryTypeHebergement',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'CategoryTypeHebergement';
    }

} // BaseCategoryTypeHebergementType
