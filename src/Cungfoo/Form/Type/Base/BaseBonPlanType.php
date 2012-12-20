<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'bon_plan' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseBonPlanType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'bon_plan.id',
            'required' => false,
        ));
        $builder->add('bon_plan_categorie', 'model', array(
            'class' => '\Cungfoo\Model\BonPlanCategorie',
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'bon_plan.bon_plan_categorie',
            'required' => false,
        ));
        $builder->add('date_debut', 'date', array(
            'constraints' => array(
            ),
            'widget' => 'single_text',
            'label' => 'bon_plan.date_debut',
            'required' => false,
        ));
        $builder->add('date_fin', 'date', array(
            'constraints' => array(
            ),
            'widget' => 'single_text',
            'label' => 'bon_plan.date_fin',
            'required' => false,
        ));
        $builder->add('prix', 'integer', array(
            'constraints' => array(
            ),
            'label' => 'bon_plan.prix',
            'required' => false,
        ));
        $builder->add('prix_barre', 'integer', array(
            'constraints' => array(
            ),
            'label' => 'bon_plan.prix_barre',
            'required' => false,
        ));
        $builder->add('image_menu', 'cungfoo_file', array(
            'constraints' => array(
            ),
            'label' => 'bon_plan.image_menu',
            'required' => false,
        ));
        $builder->add('image_menu_deleted', 'checkbox', array(
            'constraints' => array(
            ),
            'property_path' => false,
            'label' => 'bon_plan.image_menu_deleted',
            'required' => false,
        ));
        $builder->add('active', 'checkbox', array(
            'constraints' => array(
            ),
            'label' => 'bon_plan.active',
            'required' => false,
        ));
        $builder->add('bon_planI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\BonPlanI18n',
            'languages' => array(
                0 => 'fr',
                1 => 'en',
                2 => 'de',
                3 => 'nl',
            ),
            'label' => 'bon_plan.bon_planI18ns',
            'columns' => array(
                'name' => array(
                    'required' => false,
                    'label' => 'bon_plan.name',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'slug' => array(
                    'required' => false,
                    'label' => 'bon_plan.slug',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'introduction' => array(
                    'required' => false,
                    'label' => 'bon_plan.introduction',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'description' => array(
                    'required' => false,
                    'label' => 'bon_plan.description',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'indice' => array(
                    'required' => false,
                    'label' => 'bon_plan.indice',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'image_page' => array(
                    'required' => false,
                    'label' => 'bon_plan.image_page',
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
            'data_class' => 'Cungfoo\Model\BonPlan',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'BonPlan';
    }

} // BaseBonPlanType
