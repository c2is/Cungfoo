<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'portfolio_media' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BasePortfolioMediaType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'portfolio_media.id',
            'required' => false,
        ));
        $builder->add('name_origin', 'text', array(
            'constraints' => array(
            ),
            'label' => 'portfolio_media.name_origin',
            'required' => false,
        ));
        $builder->add('name', 'text', array(
            'constraints' => array(
            ),
            'label' => 'portfolio_media.name',
            'required' => false,
        ));
        $builder->add('path_origin', 'text', array(
            'constraints' => array(
            ),
            'label' => 'portfolio_media.path_origin',
            'required' => false,
        ));
        $builder->add('path_miniature', 'text', array(
            'constraints' => array(
            ),
            'label' => 'portfolio_media.path_miniature',
            'required' => false,
        ));
        $builder->add('size', 'text', array(
            'constraints' => array(
            ),
            'label' => 'portfolio_media.size',
            'required' => false,
        ));
        $builder->add('type', 'text', array(
            'constraints' => array(
            ),
            'label' => 'portfolio_media.type',
            'required' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cungfoo\Model\PortfolioMedia',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'PortfolioMedia';
    }

} // BasePortfolioMediaType
