<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'vos_vacances' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseVosVacancesType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'vos_vacances.id',
            'required' => false,
        ));
        $builder->add('age', 'text', array(
            'constraints' => array(
            ),
            'label' => 'vos_vacances.age',
            'required' => false,
        ));
        $builder->add('image_path', 'cungfoo_file', array(
            'constraints' => array(
            ),
            'label' => 'vos_vacances.image_path',
            'required' => false,
        ));
        $builder->add('image_path_deleted', 'checkbox', array(
            'constraints' => array(
            ),
            'property_path' => false,
            'label' => 'vos_vacances.image_path_deleted',
            'required' => false,
        ));
        $builder->add('enabled', 'checkbox', array(
            'constraints' => array(
            ),
            'label' => 'vos_vacances.enabled',
            'required' => false,
        ));
        $builder->add('vos_vacancesI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\VosVacancesI18n',
            'languages' => array(
                0 => 'fr',
                1 => 'en',
                2 => 'de',
            ),
            'label' => 'vos_vacances.vos_vacancesI18ns',
            'columns' => array(
                'titre' => array(
                    'required' => false,
                    'label' => 'vos_vacances.titre',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'description' => array(
                    'required' => false,
                    'label' => 'vos_vacances.description',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'prenom' => array(
                    'required' => false,
                    'label' => 'vos_vacances.prenom',
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
            'data_class' => 'Cungfoo\Model\VosVacances',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'VosVacances';
    }

} // BaseVosVacancesType