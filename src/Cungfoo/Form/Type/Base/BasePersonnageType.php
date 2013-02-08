<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'personnage' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BasePersonnageType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'personnage.id',
            'required' => false,
        ));
        $builder->add('etablissement_id', 'model', array(
            'class' => '\Cungfoo\Model\Etablissement',
            'constraints' => array(
            ),
            'label' => 'personnage.etablissement_id',
            'required' => false,
        ));
        $builder->add('age', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'personnage.age',
            'required' => false,
        ));
        $builder->add('image_path', 'cungfoo_file', array(
            'constraints' => array(
            ),
            'label' => 'personnage.image_path',
            'required' => false,
        ));
        $builder->add('image_path_deleted', 'checkbox', array(
            'constraints' => array(
            ),
            'property_path' => false,
            'label' => 'personnage.image_path_deleted',
            'required' => false,
        ));
        $builder->add('active', 'checkbox', array(
            'constraints' => array(
            ),
            'label' => 'personnage.active',
            'required' => false,
        ));
        $builder->add('themes', 'model', array(
            'class' => 'Cungfoo\Model\Theme',
            'constraints' => array(
            ),
            'multiple' => true,
            'label' => 'personnage.themes',
            'required' => false,
        ));
        $builder->add('personnageI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\PersonnageI18n',
            'languages' => array(
                0 => 'fr',
                1 => 'de',
            ),
            'label' => 'personnage.personnageI18ns',
            'columns' => array(
                'prenom' => array(
                    'required' => false,
                    'label' => 'personnage.prenom',
                    'type' => 'text',
                    'constraints' => array(
                        new Assert\NotBlank(),
                    ),
                ),
                'active_locale' => array(
                    'required' => false,
                    'label' => 'personnage.active_locale',
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
            'data_class' => 'Cungfoo\Model\Personnage',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Personnage';
    }

} // BasePersonnageType
