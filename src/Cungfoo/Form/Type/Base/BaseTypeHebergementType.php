<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'type_hebergement' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseTypeHebergementType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'type_hebergement.id',
            'required' => false,
        ));
        $builder->add('category_type_hebergement', 'model', array(
            'class' => '\Cungfoo\Model\CategoryTypeHebergement',
            'constraints' => array(
            ),
            'label' => 'type_hebergement.category_type_hebergement',
            'required' => false,
        ));
        $builder->add('etablissements', 'model', array(
            'class' => 'Cungfoo\Model\Etablissement',
            'constraints' => array(
            ),
            'multiple' => true,
            'label' => 'type_hebergement.etablissements',
            'required' => false,
        ));
        $builder->add('type_hebergementI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\TypeHebergementI18n',
            'languages' => array(
                0 => 'en',
                1 => 'fr',
                2 => 'de',
            ),
            'label' => 'type_hebergement.type_hebergementI18ns',
            'columns' => array(
                'name' => array(
                    'required' => false,
                    'label' => 'type_hebergement.name',
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
            'data_class' => 'Cungfoo\Model\TypeHebergement',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'TypeHebergement';
    }

} // BaseTypeHebergementType