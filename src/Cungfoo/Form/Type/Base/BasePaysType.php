<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'pays' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BasePaysType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'pays.id',
            'required' => false,
        ));
        $builder->add('code', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'pays.code',
            'required' => false,
        ));
        $builder->add('paysI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\PaysI18n',
            'languages' => array(
                0 => 'fr',
                1 => 'en',
                2 => 'de',
            ),
            'label' => 'pays.paysI18ns',
            'columns' => array(
                'name' => array(
                    'required' => false,
                    'label' => 'pays.name',
                    'type' => 'text',
                    'constraints' => array(
                        new Assert\NotBlank(),
                    ),
                ),
            ),
            'required' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cungfoo\Model\Pays',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Pays';
    }

} // BasePaysType
