<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'category_type_hebergement' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseCategoryTypeHebergementType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'category_type_hebergement.id',
            'required' => false,
        ));
        $builder->add('category_type_hebergementI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\CategoryTypeHebergementI18n',
            'languages' => array(
                0 => 'en',
                1 => 'fr',
                2 => 'de',
            ),
            'label' => 'category_type_hebergement.category_type_hebergementI18ns',
            'columns' => array(
                'name' => array(
                    'required' => false,
                    'label' => 'category_type_hebergement.name',
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
            'data_class' => 'Cungfoo\Model\CategoryTypeHebergement',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'CategoryTypeHebergement';
    }

} // BaseCategoryTypeHebergementType
