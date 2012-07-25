<?php

/**
 * This file is part of the PropelBundle package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    MIT License
 */

namespace Cungfoo\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Cungfoo\Form\ChoiceList\ModelChoiceList;
use Cungfoo\Form\DataTransformer\CollectionToArrayTransformer;

/**
 * ModelType class.
 *
 * @author William Durand <william.durand1@gmail.com>
 */
class ModelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($options['multiple']) {
            $builder->addViewTransformer(new CollectionToArrayTransformer(), true);
        }
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $choiceList = function (Options $options) {
            return new ModelChoiceList(
                $options['class'],
                $options['property'],
                $options['choices'],
                $options['query'],
                $options['group_by']
            );
        };

        $resolver->setDefaults(array(
            'template'          => 'choice',
            'multiple'          => false,
            'expanded'          => false,
            'class'             => null,
            'property'          => null,
            'query'             => null,
            'choices'           => null,
            'choice_list'       => $choiceList,
            'group_by'          => null,
            'by_reference'      => false,
        ));
    }

    public function getParent()
    {
        return 'choice';
    }

    public function getName()
    {
        return 'model';
    }
}