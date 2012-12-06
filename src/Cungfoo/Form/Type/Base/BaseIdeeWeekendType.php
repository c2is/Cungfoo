<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'idee_weekend' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseIdeeWeekendType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'idee_weekend.id',
            'required' => false,
        ));
        $builder->add('highlight', 'checkbox', array(
            'constraints' => array(
            ),
            'label' => 'idee_weekend.highlight',
            'required' => false,
        ));
        $builder->add('prix', 'text', array(
            'constraints' => array(
            ),
            'label' => 'idee_weekend.prix',
            'required' => false,
        ));
        $builder->add('home', 'checkbox', array(
            'constraints' => array(
            ),
            'label' => 'idee_weekend.home',
            'required' => false,
        ));
        $builder->add('image_path', 'cungfoo_file', array(
            'constraints' => array(
            ),
            'label' => 'idee_weekend.image_path',
            'required' => false,
        ));
        $builder->add('image_path_deleted', 'checkbox', array(
            'constraints' => array(
            ),
            'property_path' => false,
            'label' => 'idee_weekend.image_path_deleted',
            'required' => false,
        ));
        $builder->add('active', 'checkbox', array(
            'constraints' => array(
            ),
            'label' => 'idee_weekend.active',
            'required' => false,
        ));
        $builder->add('idee_weekendI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\IdeeWeekendI18n',
            'languages' => array(
                0 => 'fr',
                1 => 'en',
                2 => 'de',
                3 => 'nl',
            ),
            'label' => 'idee_weekend.idee_weekendI18ns',
            'columns' => array(
                'titre' => array(
                    'required' => false,
                    'label' => 'idee_weekend.titre',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'lien' => array(
                    'required' => false,
                    'label' => 'idee_weekend.lien',
                    'type' => 'text',
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
            'data_class' => 'Cungfoo\Model\IdeeWeekend',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'IdeeWeekend';
    }

} // BaseIdeeWeekendType
