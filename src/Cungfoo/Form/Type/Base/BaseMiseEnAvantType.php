<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'mise_en_avant' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseMiseEnAvantType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'mise_en_avant.id',
            'required' => false,
        ));
        $builder->add('image_fond_path', 'cungfoo_file', array(
            'constraints' => array(
            ),
            'label' => 'mise_en_avant.image_fond_path',
            'required' => false,
        ));
        $builder->add('image_fond_path_deleted', 'checkbox', array(
            'constraints' => array(
            ),
            'property_path' => false,
            'label' => 'mise_en_avant.image_fond_path_deleted',
            'required' => false,
        ));
        $builder->add('prix', 'text', array(
            'constraints' => array(
            ),
            'label' => 'mise_en_avant.prix',
            'required' => false,
        ));
        $builder->add('illustration_path', 'cungfoo_file', array(
            'constraints' => array(
            ),
            'label' => 'mise_en_avant.illustration_path',
            'required' => false,
        ));
        $builder->add('illustration_path_deleted', 'checkbox', array(
            'constraints' => array(
            ),
            'property_path' => false,
            'label' => 'mise_en_avant.illustration_path_deleted',
            'required' => false,
        ));
        $builder->add('date_fin_validite', 'date', array(
            'constraints' => array(
            ),
            'widget' => 'single_text',
            'label' => 'mise_en_avant.date_fin_validite',
            'required' => false,
        ));
        $builder->add('sortable_rank', 'integer', array(
            'constraints' => array(
            ),
            'label' => 'mise_en_avant.sortable_rank',
            'required' => false,
        ));
        $builder->add('active', 'checkbox', array(
            'constraints' => array(
            ),
            'label' => 'mise_en_avant.active',
            'required' => false,
        ));
        $builder->add('mise_en_avantI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\MiseEnAvantI18n',
            'languages' => array(
                0 => 'fr',
                1 => 'de',
            ),
            'label' => 'mise_en_avant.mise_en_avantI18ns',
            'columns' => array(
                'titre' => array(
                    'required' => false,
                    'label' => 'mise_en_avant.titre',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'accroche' => array(
                    'required' => false,
                    'label' => 'mise_en_avant.accroche',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'lien' => array(
                    'required' => false,
                    'label' => 'mise_en_avant.lien',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'titre_lien' => array(
                    'required' => false,
                    'label' => 'mise_en_avant.titre_lien',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'seo_title' => array(
                    'required' => false,
                    'label' => 'mise_en_avant.seo_title',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'seo_description' => array(
                    'required' => false,
                    'label' => 'mise_en_avant.seo_description',
                    'type' => 'textarea',
                    'constraints' => array(
                    ),
                ),
                'seo_h1' => array(
                    'required' => false,
                    'label' => 'mise_en_avant.seo_h1',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'seo_keywords' => array(
                    'required' => false,
                    'label' => 'mise_en_avant.seo_keywords',
                    'type' => 'textarea',
                    'constraints' => array(
                    ),
                ),
                'active_locale' => array(
                    'required' => false,
                    'label' => 'mise_en_avant.active_locale',
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
            'data_class' => 'Cungfoo\Model\MiseEnAvant',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'MiseEnAvant';
    }

} // BaseMiseEnAvantType
