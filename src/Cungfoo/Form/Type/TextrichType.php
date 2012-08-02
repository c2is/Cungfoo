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