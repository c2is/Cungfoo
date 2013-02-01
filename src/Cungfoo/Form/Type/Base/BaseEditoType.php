<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'edito' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseEditoType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'edito.id',
            'required' => false,
        ));
        $builder->add('slug', 'text', array(
            'constraints' => array(
            ),
            'label' => 'edito.slug',
            'required' => false,
        ));
        $builder->add('active', 'checkbox', array(
            'constraints' => array(
            ),
            'label' => 'edito.active',
            'required' => false,
        ));
        $builder->add('editoI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\EditoI18n',
            'languages' => array(
                0 => 'fr',
                1 => 'de',
            ),
            'label' => 'edito.editoI18ns',
            'columns' => array(
                'name' => array(
                    'required' => false,
                    'label' => 'edito.name',
                    'type' => 'text',
                    'constraints' => array(
                        new Assert\NotBlank(),
                    ),
                ),
                'description' => array(
                    'required' => false,
                    'label' => 'edito.description',
                    'type' => 'textrich',
                    'constraints' => array(
                        new Assert\NotBlank(),
                    ),
                ),
                'active_locale' => array(
                    'required' => false,
                    'label' => 'edito.active_locale',
                    'type' => 'checkbox',
                    'constraints' => array(
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
            'data_class' => 'Cungfoo\Model\Edito',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Edito';
    }

} // BaseEditoType
