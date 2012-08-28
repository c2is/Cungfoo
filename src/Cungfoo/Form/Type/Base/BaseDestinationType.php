<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'destination' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseDestinationType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'destination.id',
            'required' => false,
        ));
        $builder->add('campings', 'model', array(
            'class' => 'Cungfoo\Model\Camping',
            'constraints' => array(
            ),
            'multiple' => true,
            'label' => 'destination.campings',
            'required' => false,
        ));
        $builder->add('destinationI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\DestinationI18n',
            'languages' => array(
                0 => 'en',
                1 => 'fr',
                2 => 'de',
            ),
            'label' => 'destination.destinationI18ns',
            'columns' => array(
                'name' => array(
                    'required' => false,
                    'label' => 'destination.name',
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
            'data_class' => 'Cungfoo\Model\Destination',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Destination';
    }

} // BaseDestinationType
