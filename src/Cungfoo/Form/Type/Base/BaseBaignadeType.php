<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'baignade' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseBaignadeType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'baignade.id',
            'required' => false,
        ));
        $builder->add('code', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'baignade.code',
            'required' => false,
        ));
        $builder->add('image_path', 'cungfoo_file', array(
            'constraints' => array(
            ),
            'label' => 'baignade.image_path',
            'required' => false,
        ));
        $builder->add('image_path_deleted', 'checkbox', array(
            'constraints' => array(
            ),
            'property_path' => false,
            'label' => 'baignade.image_path_deleted',
            'required' => false,
        ));
        $builder->add('vignette', 'cungfoo_file', array(
            'constraints' => array(
            ),
            'label' => 'baignade.vignette',
            'required' => false,
        ));
        $builder->add('vignette_deleted', 'checkbox', array(
            'constraints' => array(
            ),
            'property_path' => false,
            'label' => 'baignade.vignette_deleted',
            'required' => false,
        ));
        $builder->add('active', 'checkbox', array(
            'constraints' => array(
            ),
            'label' => 'baignade.active',
            'required' => false,
        ));
        $builder->add('etablissements', 'model', array(
            'class' => 'Cungfoo\Model\Etablissement',
            'constraints' => array(
            ),
            'multiple' => true,
            'label' => 'baignade.etablissements',
            'required' => false,
        ));
        $builder->add('themes', 'model', array(
            'class' => 'Cungfoo\Model\Theme',
            'constraints' => array(
            ),
            'multiple' => true,
            'label' => 'baignade.themes',
            'required' => false,
        ));
        $builder->add('baignadeI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\BaignadeI18n',
            'languages' => array(
                0 => 'fr',
                1 => 'de',
            ),
            'label' => 'baignade.baignadeI18ns',
            'columns' => array(
                'name' => array(
                    'required' => false,
                    'label' => 'baignade.name',
                    'type' => 'text',
                    'constraints' => array(
                        new Assert\NotBlank(),
                    ),
                ),
                'description' => array(
                    'required' => false,
                    'label' => 'baignade.description',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'keywords' => array(
                    'required' => false,
                    'label' => 'baignade.keywords',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'active_locale' => array(
                    'required' => false,
                    'label' => 'baignade.active_locale',
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
            'data_class' => 'Cungfoo\Model\Baignade',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Baignade';
    }

} // BaseBaignadeType
