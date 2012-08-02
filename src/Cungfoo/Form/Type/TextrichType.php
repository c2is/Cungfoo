<?php

namespace Cungfoo\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * TextrichType class.
 *
 * @author Morgan Brunto <brunot.morgan@gmail.com>
 */
class TextrichType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'attr'  => array(
                'rows' => 10,
            )
        ));
    }

    public function getParent()
    {
        return 'textarea';
    }

    public function getName()
    {
        return 'textrich';
    }
}