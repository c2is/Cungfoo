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
        $builder->add('pays', 'model', array(
            'class' => '\Cungfoo\Model\Pays',
            'constraints' => array(
            ),
            'label' => 'region.pays',
            'required' => false,
        ));
        $builder->add('regionI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\RegionI18n',
            'languages' => array(
                0 => 'en',
                1 => 'fr',
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