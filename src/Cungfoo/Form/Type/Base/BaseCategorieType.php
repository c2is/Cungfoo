<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'categorie' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseCategorieType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'categorie.id',
            'required' => false,
        ));
        $builder->add('code', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'categorie.code',
            'required' => false,
        ));
        $builder->add('active', 'checkbox', array(
            'constraints' => array(
            ),
            'label' => 'categorie.active',
            'required' => false,
        ));
        $builder->add('categorieI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\CategorieI18n',
            'languages' => array(
                0 => 'fr',
                1 => 'de',
            ),
            'label' => 'categorie.categorieI18ns',
            'columns' => array(
                'name' => array(
                    'required' => false,
                    'label' => 'categorie.name',
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
            'data_class' => 'Cungfoo\Model\Categorie',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Categorie';
    }

} // BaseCategorieType
