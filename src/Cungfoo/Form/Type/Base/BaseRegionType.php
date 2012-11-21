<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'region' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseRegionType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'region.id',
            'required' => false,
        ));
        $builder->add('code', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'region.code',
            'required' => false,
        ));
        $builder->add('image_path', 'cungfoo_file', array(
            'constraints' => array(
            ),
            'label' => 'region.image_path',
            'required' => false,
        ));
        $builder->add('image_path_deleted', 'checkbox', array(
            'constraints' => array(
            ),
            'property_path' => false,
            'label' => 'region.image_path_deleted',
            'required' => false,
        ));
        $builder->add('image_encart_path', 'cungfoo_file', array(
            'constraints' => array(
            ),
            'label' => 'region.image_encart_path',
            'required' => false,
        ));
        $builder->add('image_encart_path_deleted', 'checkbox', array(
            'constraints' => array(
            ),
            'property_path' => false,
            'label' => 'region.image_encart_path_deleted',
            'required' => false,
        ));
        $builder->add('image_encart_petite_path', 'cungfoo_file', array(
            'constraints' => array(
            ),
            'label' => 'region.image_encart_petite_path',
            'required' => false,
        ));
        $builder->add('image_encart_petite_path_deleted', 'checkbox', array(
            'constraints' => array(
            ),
            'property_path' => false,
            'label' => 'region.image_encart_petite_path_deleted',
            'required' => false,
        ));
        $builder->add('pays', 'model', array(
            'class' => '\Cungfoo\Model\Pays',
            'constraints' => array(
            ),
            'label' => 'region.pays',
            'required' => false,
        ));
        $builder->add('mea_home', 'checkbox', array(
            'constraints' => array(
            ),
            'label' => 'region.mea_home',
            'required' => false,
        ));
        $builder->add('enabled', 'checkbox', array(
            'constraints' => array(
            ),
            'label' => 'region.enabled',
            'required' => false,
        ));
        $builder->add('regionI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\RegionI18n',
            'languages' => array(
                0 => 'fr',
                1 => 'en',
                2 => 'de',
            ),
            'label' => 'region.regionI18ns',
            'columns' => array(
                'name' => array(
                    'required' => false,
                    'label' => 'region.name',
                    'type' => 'text',
                    'constraints' => array(
                        new Assert\NotBlank(),
                    ),
                ),
                'description' => array(
                    'required' => false,
                    'label' => 'region.description',
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
            'data_class' => 'Cungfoo\Model\Region',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Region';
    }

} // BaseRegionType
