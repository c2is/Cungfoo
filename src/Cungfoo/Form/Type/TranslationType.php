<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cungfoo\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Event\DataEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Translation type class
 *
 * @author Patrick Kaufmann
 */
class TranslationType extends AbstractType
{
    /**
      * {@inheritdoc}
      */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $columns = $options['columns'];
        $dataClass = $options['data_class'];

        $callable = function(DataEvent $event) use ($builder, $columns, $dataClass) {
            $form = $event->getForm();
            $data = $event->getData();

            if (!$data instanceof $dataClass)
            {
                return;
            }

            //loop over all columns and add the input
            foreach ($columns as $column => $options)
            {
                if ($options == null)
                {
                    $options = array();
                }

                $type = 'text';
                if (array_key_exists('type', $options))
                {
                    $type = $options['type'];
                    unset($options['type']);
                }
                $label = $column;
                if (array_key_exists('label', $options))
                {
                    $label = $options['label'];
                }

                $customOptions = array();
                if (array_key_exists('options', $options))
                {
                    $customOptions = $options['options'];
                }

                $options = array_merge($options, $customOptions);

                $form->add($builder->getFormFactory()->createNamed($column, $type, null, $options));
            }
        };

        $builder->addEventListener(FormEvents::PRE_SET_DATA, $callable);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'translation';
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'columns' => array(),
            'language' => ''
        ));
    }
}
