<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'point_interet' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BasePointInteretType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'point_interet.id',
            'required' => false,
        ));
        $builder->add('address', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'point_interet.address',
            'required' => false,
        ));
        $builder->add('address2', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'point_interet.address2',
            'required' => false,
        ));
        $builder->add('zipcode', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'point_interet.zipcode',
            'required' => false,
        ));
        $builder->add('city', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'point_interet.city',
            'required' => false,
        ));
        $builder->add('image', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'point_interet.image',
            'required' => false,
        ));
        $builder->add('etablissements', 'model', array(
            'class' => 'Cungfoo\Model\Etablissement',
            'constraints' => array(
            ),
            'multiple' => true,
            'label' => 'point_interet.etablissements',
            'required' => false,
        ));
        $builder->add('point_interetI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\PointInteretI18n',
            'languages' => array(
                0 => 'fr',
                1 => 'en',
                2 => 'de',
            ),
            'label' => 'point_interet.point_interetI18ns',
            'columns' => array(
                'name' => array(
                    'required' => false,
                    'label' => 'point_interet.name',
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
            'data_class' => 'Cungfoo\Model\PointInteret',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'PointInteret';
    }

} // BasePointInteretType
