<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'region_ref' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseRegionRefType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'region_ref.id',
            'required' => false,
        ));
        $builder->add('code', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'region_ref.code',
            'required' => false,
        ));
        $builder->add('pays', 'model', array(
            'class' => '\Cungfoo\Model\Pays',
            'constraints' => array(
            ),
            'label' => 'region_ref.pays',
            'required' => false,
        ));
        $builder->add('image_detail_1', 'cungfoo_file', array(
            'constraints' => array(
            ),
            'label' => 'region_ref.image_detail_1',
            'required' => false,
        ));
        $builder->add('image_detail_1_deleted', 'checkbox', array(
            'constraints' => array(
            ),
            'property_path' => false,
            'label' => 'region_ref.image_detail_1_deleted',
            'required' => false,
        ));
        $builder->add('image_detail_2', 'cungfoo_file', array(
            'constraints' => array(
            ),
            'label' => 'region_ref.image_detail_2',
            'required' => false,
        ));
        $builder->add('image_detail_2_deleted', 'checkbox', array(
            'constraints' => array(
            ),
            'property_path' => false,
            'label' => 'region_ref.image_detail_2_deleted',
            'required' => false,
        ));
        $builder->add('active', 'checkbox', array(
            'constraints' => array(
            ),
            'label' => 'region_ref.active',
            'required' => false,
        ));
        $builder->add('region_refI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\RegionRefI18n',
            'languages' => array(
                0 => 'fr',
                1 => 'de',
            ),
            'label' => 'region_ref.region_refI18ns',
            'columns' => array(
                'slug' => array(
                    'required' => false,
                    'label' => 'region_ref.slug',
                    'type' => 'text',
                    'constraints' => array(
                        new Assert\NotBlank(),
                    ),
                ),
                'name' => array(
                    'required' => false,
                    'label' => 'region_ref.name',
                    'type' => 'text',
                    'constraints' => array(
                        new Assert\NotBlank(),
                    ),
                ),
                'introduction' => array(
                    'required' => false,
                    'label' => 'region_ref.introduction',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'description' => array(
                    'required' => false,
                    'label' => 'region_ref.description',
                    'type' => 'textarea',
                    'constraints' => array(
                    ),
                ),
                'seo_title' => array(
                    'required' => false,
                    'label' => 'region_ref.seo_title',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'seo_description' => array(
                    'required' => false,
                    'label' => 'region_ref.seo_description',
                    'type' => 'textarea',
                    'constraints' => array(
                    ),
                ),
                'seo_h1' => array(
                    'required' => false,
                    'label' => 'region_ref.seo_h1',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'seo_keywords' => array(
                    'required' => false,
                    'label' => 'region_ref.seo_keywords',
                    'type' => 'textarea',
                    'constraints' => array(
                    ),
                ),
                'active_locale' => array(
                    'required' => false,
                    'label' => 'region_ref.active_locale',
                    'type' => 'checkbox',
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
            'data_class' => 'Cungfoo\Model\RegionRef',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'RegionRef';
    }

} // BaseRegionRefType
