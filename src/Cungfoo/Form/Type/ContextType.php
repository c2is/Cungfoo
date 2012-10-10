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
        $this
            ->addDimensions($builder)
            ->addLocale($builder)
            ->addTerm($builder)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Context';
    }

    protected function addDimensions($builder)
    {
        $dimensions = $this->app['config']->get('dimensions');
        foreach ($dimensions as $dimensionName => $dimensionInformation)
        {
            $dimensionQuery = $dimensionInformation['class'] . 'Query';
            $builder->add($dimensionName, 'model', array(
                'class'         => $dimensionInformation['class'],
                'label'         => sprintf('context.%s', $dimensionName),
                'required'      => false,
                'data_class'    => null,
                'data'          => $dimensionQuery::create()->filterById($this->app['context']->get($dimensionName))->findOne(),
                'empty_value'   => sprintf('%s.all', $dimensionName)
            ));
        }

        return $this;
    }

    protected function addLocale($builder)
    {
        $localeChoices = array();
        foreach ($this->app['config']->get('languages') as $locale => $language)
        {
            $localeChoices[$locale] = $language['title'];
        }

        $builder->add('language', 'choice', array(
            'choices'       => $localeChoices,
            'label'         => sprintf('context.languages'),
            'required'      => false,
            'data_class'    => null,
            'data'          => $this->app['context']->get('language'),
            'empty_value'   => null
        ));

        return $this;
    }

    protected function addTerm($builder)
    {
        $builder->add('term', 'text', array(
            'label'         => sprintf('context.term'),
            'required'      => false,
            'data'          => $this->app['context']->get('term')
        ));

        return $this;
    }

} // ContextType
