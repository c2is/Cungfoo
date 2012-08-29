<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'equipement' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseEquipementType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'equipement.id',
            'required' => false,
        ));
        $builder->add('etablissements', 'model', array(
            'class' => 'Cungfoo\Model\Etablissement',
            'constraints' => array(
            ),
            'multiple' => true,
            'label' => 'equipement.etablissements',
            'required' => false,
        ));
        $builder->add('equipementI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\EquipementI18n',
            'languages' => array(
                0 => 'en',
                1 => 'fr',
                2 => 'de',
            ),
            'label' => 'equipement.equipementI18ns',
            'columns' => array(
                'name' => array(
                    'required' => false,
                    'label' => 'equipement.name',
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
            'data_class' => 'Cungfoo\Model\Equipement',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Equipement';
    }

} // BaseEquipementType
