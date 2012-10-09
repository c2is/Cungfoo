<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'avantage' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseAvantageType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'avantage.id',
            'required' => false,
        ));
        $builder->add('personnage', 'model', array(
            'class' => '\Cungfoo\Model\Personnage',
            'constraints' => array(
            ),
            'label' => 'avantage.personnage',
            'required' => false,
        ));
        $builder->add('image_path', 'cungfoo_file', array(
            'constraints' => array(
            ),
            'label' => 'avantage.image_path',
            'required' => false,
        ));
        $builder->add('image_path_deleted', 'checkbox', array(
            'constraints' => array(
            ),
            'property_path' => false,
            'label' => 'avantage.image_path_deleted',
            'required' => false,
        ));
        $builder->add('avantageI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\AvantageI18n',
            'languages' => array(
                0 => 'fr',
                1 => 'en',
                2 => 'de',
            ),
            'label' => 'avantage.avantageI18ns',
            'columns' => array(
                'name' => array(
                    'required' => false,
                    'label' => 'avantage.name',
                    'type' => 'text',
                    'constraints' => array(
                        new Assert\NotBlank(),
                    ),
                ),
                'description' => array(
                    'required' => false,
                    'label' => 'avantage.description',
                    'type' => 'textarea',
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
            'data_class' => 'Cungfoo\Model\Avantage',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Avantage';
    }

} // BaseAvantageType
