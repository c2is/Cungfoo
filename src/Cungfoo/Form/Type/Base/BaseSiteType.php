<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'site' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseSiteType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'site.id',
            'required' => false,
        ));
        $builder->add('name', 'text', array(
            'constraints' => array(
            ),
            'label' => 'site.name',
            'required' => false,
        ));
        $builder->add('order', 'integer', array(
            'constraints' => array(
            ),
            'label' => 'site.order',
            'required' => false,
        ));
        $builder->add('saisons', 'model', array(
            'class' => 'Cungfoo\Model\Saison',
            'constraints' => array(
            ),
            'multiple' => true,
            'label' => 'site.saisons',
            'required' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cungfoo\Model\Site',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Site';
    }

} // BaseSiteType
