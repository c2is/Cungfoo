<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'event' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseEventType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'event.id',
            'required' => false,
        ));
        $builder->add('category', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'event.category',
            'required' => false,
        ));
        $builder->add('title', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'event.title',
            'required' => false,
        ));
        $builder->add('address', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'event.address',
            'required' => false,
        ));
        $builder->add('address2', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'event.address2',
            'required' => false,
        ));
        $builder->add('zipcode', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'event.zipcode',
            'required' => false,
        ));
        $builder->add('city', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'event.city',
            'required' => false,
        ));
        $builder->add('image', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'event.image',
            'required' => false,
        ));
        $builder->add('priority', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'event.priority',
            'required' => false,
        ));
        $builder->add('etablissements', 'model', array(
            'class' => 'Cungfoo\Model\Etablissement',
            'constraints' => array(
            ),
            'multiple' => true,
            'label' => 'event.etablissements',
            'required' => false,
        ));
        $builder->add('eventI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\EventI18n',
            'languages' => array(
                0 => 'fr',
                1 => 'en',
                2 => 'de',
            ),
            'label' => 'event.eventI18ns',
            'columns' => array(
                'str_date' => array(
                    'required' => false,
                    'label' => 'event.str_date',
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
            'data_class' => 'Cungfoo\Model\Event',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Event';
    }

} // BaseEventType
