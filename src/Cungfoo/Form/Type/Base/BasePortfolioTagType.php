<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'portfolio_tag' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BasePortfolioTagType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'portfolio_tag.id',
            'required' => false,
        ));
        $builder->add('name', 'text', array(
            'constraints' => array(
            ),
            'label' => 'portfolio_tag.name',
            'required' => false,
        ));
        $builder->add('description', 'text', array(
            'constraints' => array(
            ),
            'label' => 'portfolio_tag.description',
            'required' => false,
        ));
        $builder->add('portfolio_medias', 'model', array(
            'class' => 'Cungfoo\Model\PortfolioMedia',
            'constraints' => array(
            ),
            'multiple' => true,
            'label' => 'portfolio_tag.portfolio_medias',
            'required' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cungfoo\Model\PortfolioTag',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'PortfolioTag';
    }

} // BasePortfolioTagType
