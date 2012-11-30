<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'dernieres_minutes' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseDernieresMinutesType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'dernieres_minutes.id',
            'required' => false,
        ));
        $builder->add('date_start', 'date', array(
            'constraints' => array(
            ),
            'widget' => 'single_text',
            'label' => 'dernieres_minutes.date_start',
            'required' => false,
        ));
        $builder->add('day_start', 'choice', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'choices' => array(
                'monday' => 'monday',
                'tuesday' => 'tuesday',
                'wednesday' => 'wednesday',
                'thursday' => 'thursday',
                'friday' => 'friday',
                'saturday' => 'saturday',
                'sunday' => 'sunday',
            ),
            'label' => 'dernieres_minutes.day_start',
            'required' => false,
        ));
        $builder->add('day_range', 'choice', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'choices' => array(
                7 => '7',
                14 => '14',
                21 => '21',
            ),
            'label' => 'dernieres_minutes.day_range',
            'required' => false,
        ));
        $builder->add('active', 'checkbox', array(
            'constraints' => array(
            ),
            'label' => 'dernieres_minutes.active',
            'required' => false,
        ));
        $builder->add('enabled', 'checkbox', array(
            'constraints' => array(
            ),
            'label' => 'dernieres_minutes.enabled',
            'required' => false,
        ));
        $builder->add('etablissements', 'model', array(
            'class' => 'Cungfoo\Model\Etablissement',
            'constraints' => array(
            ),
            'multiple' => true,
            'label' => 'dernieres_minutes.etablissements',
            'required' => false,
        ));
        $builder->add('destinations', 'model', array(
            'class' => 'Cungfoo\Model\Destination',
            'constraints' => array(
            ),
            'multiple' => true,
            'label' => 'dernieres_minutes.destinations',
            'required' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cungfoo\Model\DernieresMinutes',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'DernieresMinutes';
    }

} // BaseDernieresMinutesType
