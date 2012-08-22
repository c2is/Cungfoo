<?php

namespace Cungfoo\Form\Type;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

/**
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 */
class ContextType extends AppAwareType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $dimensions = $this->app['config']->get('dimensions');
        $context    = $this->app['context'];
        foreach ($dimensions as $dimensionName => $dimensionInformation)
        {
            $dimensionQuery = $dimensionInformation['class'] . 'Query';
            $builder->add($dimensionName, 'model', array(
                'class'         => $dimensionInformation['class'],
                'label'         => sprintf('context.%s', $dimensionName),
                'required'      => false,
                'data_class'    => null,
                'data'          => $dimensionQuery::create()->filterById($context->get($dimensionName))->findOne(),
                'empty_value'   => 'Tous'
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Context';
    }

} // ContextType
