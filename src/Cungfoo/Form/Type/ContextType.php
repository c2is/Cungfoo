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

    protected function addLocale($builder)
    {
        $localeChoices = array();
        foreach ($this->app['config']->get('languages') as $locale => $language)
        {
            $localeChoices[$locale] = $language['name'];
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
