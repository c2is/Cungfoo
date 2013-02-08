<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'ville' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseVilleType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'ville.id',
            'required' => false,
        ));
        $builder->add('code', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'ville.code',
            'required' => false,
        ));
        $builder->add('region_id', 'model', array(
            'class' => '\Cungfoo\Model\Region',
            'constraints' => array(
            ),
            'label' => 'ville.region_id',
            'required' => false,
        ));
        $builder->add('image_detail_1', 'cungfoo_file', array(
            'constraints' => array(
            ),
            'label' => 'ville.image_detail_1',
            'required' => false,
        ));
        $builder->add('image_detail_1_deleted', 'checkbox', array(
            'constraints' => array(
            ),
            'property_path' => false,
            'label' => 'ville.image_detail_1_deleted',
            'required' => false,
        ));
        $builder->add('image_detail_2', 'cungfoo_file', array(
            'constraints' => array(
            ),
            'label' => 'ville.image_detail_2',
            'required' => false,
        ));
        $builder->add('image_detail_2_deleted', 'checkbox', array(
            'constraints' => array(
            ),
            'property_path' => false,
            'label' => 'ville.image_detail_2_deleted',
            'required' => false,
        ));
        $builder->add('active', 'checkbox', array(
            'constraints' => array(
            ),
            'label' => 'ville.active',
            'required' => false,
        ));
        $builder->add('villeI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\VilleI18n',
            'languages' => array(
                0 => 'fr',
                1 => 'de',
            ),
            'label' => 'ville.villeI18ns',
            'columns' => array(
                'slug' => array(
                    'required' => false,
                    'label' => 'ville.slug',
                    'type' => 'text',
                    'constraints' => array(
                        new Assert\NotBlank(),
                    ),
                ),
                'name' => array(
                    'required' => false,
                    'label' => 'ville.name',
                    'type' => 'text',
                    'constraints' => array(
                        new Assert\NotBlank(),
                    ),
                ),
                'introduction' => array(
                    'required' => false,
                    'label' => 'ville.introduction',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'description' => array(
                    'required' => false,
                    'label' => 'ville.description',
                    'type' => 'textarea',
                    'constraints' => array(
                    ),
                ),
                'active_locale' => array(
                    'required' => false,
                    'label' => 'ville.active_locale',
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
            'data_class' => 'Cungfoo\Model\Ville',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Ville';
    }

} // BaseVilleType
