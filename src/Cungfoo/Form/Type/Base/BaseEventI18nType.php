<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'event_i18n' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseEventI18nType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'event_i18n.id',
            'required' => false,
        ));
        $builder->add('locale', 'hidden', array(
            'label' => 'event_i18n.locale',
            'required' => false,
        ));
        $builder->add('name', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'event_i18n.name',
            'required' => false,
        ));
        $builder->add('str_date', 'text', array(
            'constraints' => array(
            ),
            'label' => 'event_i18n.str_date',
            'required' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cungfoo\Model\EventI18n',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'EventI18n';
    }

} // BaseEventI18nType
