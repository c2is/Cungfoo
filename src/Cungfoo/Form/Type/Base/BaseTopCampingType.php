<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'top_camping' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseTopCampingType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'top_camping.id',
            'required' => false,
        ));
        $builder->add('etablissement', 'model', array(
            'class' => '\Cungfoo\Model\Etablissement',
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'top_camping.etablissement',
            'required' => false,
        ));
        $builder->add('sortable_rank', 'integer', array(
            'constraints' => array(
            ),
            'label' => 'top_camping.sortable_rank',
            'required' => false,
        ));
        $builder->add('active', 'checkbox', array(
            'constraints' => array(
            ),
            'label' => 'top_camping.active',
            'required' => false,
        ));
        $builder->add('enabled', 'checkbox', array(
            'constraints' => array(
            ),
            'label' => 'top_camping.enabled',
            'required' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cungfoo\Model\TopCamping',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'TopCamping';
    }

} // BaseTopCampingType
