<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'bon_plan_categorie' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseBonPlanCategorieType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'bon_plan_categorie.id',
            'required' => false,
        ));
        $builder->add('sortable_rank', 'integer', array(
            'constraints' => array(
            ),
            'label' => 'bon_plan_categorie.sortable_rank',
            'required' => false,
        ));
        $builder->add('active', 'checkbox', array(
            'constraints' => array(
            ),
            'label' => 'bon_plan_categorie.active',
            'required' => false,
        ));
        $builder->add('bon_plans', 'model', array(
            'class' => 'Cungfoo\Model\BonPlan',
            'constraints' => array(
            ),
            'multiple' => true,
            'label' => 'bon_plan_categorie.bon_plans',
            'required' => false,
        ));
        $builder->add('bon_plan_categorieI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\BonPlanCategorieI18n',
            'languages' => array(
                0 => 'fr',
                1 => 'de',
            ),
            'label' => 'bon_plan_categorie.bon_plan_categorieI18ns',
            'columns' => array(
                'name' => array(
                    'required' => false,
                    'label' => 'bon_plan_categorie.name',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'slug' => array(
                    'required' => false,
                    'label' => 'bon_plan_categorie.slug',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'subtitle' => array(
                    'required' => false,
                    'label' => 'bon_plan_categorie.subtitle',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'description' => array(
                    'required' => false,
                    'label' => 'bon_plan_categorie.description',
                    'type' => 'textarea',
                    'constraints' => array(
                    ),
                ),
                'seo_title' => array(
                    'required' => false,
                    'label' => 'bon_plan_categorie.seo_title',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'seo_description' => array(
                    'required' => false,
                    'label' => 'bon_plan_categorie.seo_description',
                    'type' => 'textarea',
                    'constraints' => array(
                    ),
                ),
                'seo_h1' => array(
                    'required' => false,
                    'label' => 'bon_plan_categorie.seo_h1',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'seo_keywords' => array(
                    'required' => false,
                    'label' => 'bon_plan_categorie.seo_keywords',
                    'type' => 'textarea',
                    'constraints' => array(
                    ),
                ),
                'active_locale' => array(
                    'required' => false,
                    'label' => 'bon_plan_categorie.active_locale',
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
            'data_class' => 'Cungfoo\Model\BonPlanCategorie',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'BonPlanCategorie';
    }

} // BaseBonPlanCategorieType
