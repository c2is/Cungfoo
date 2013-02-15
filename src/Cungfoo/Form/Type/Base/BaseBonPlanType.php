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
        $builder->add('image_page', 'cungfoo_file', array(
            'constraints' => array(
            ),
            'label' => 'bon_plan.image_page',
            'required' => false,
        ));
        $builder->add('image_page_deleted', 'checkbox', array(
            'constraints' => array(
            ),
            'property_path' => false,
            'label' => 'bon_plan.image_page_deleted',
            'required' => false,
        ));
        $builder->add('image_liste', 'cungfoo_file', array(
            'constraints' => array(
            ),
            'label' => 'bon_plan.image_liste',
            'required' => false,
        ));
        $builder->add('image_liste_deleted', 'checkbox', array(
            'constraints' => array(
            ),
            'property_path' => false,
            'label' => 'bon_plan.image_liste_deleted',
            'required' => false,
        ));
        $builder->add('active_compteur', 'checkbox', array(
            'constraints' => array(
            ),
            'label' => 'bon_plan.active_compteur',
            'required' => false,
        ));
        $builder->add('mise_en_avant', 'checkbox', array(
            'constraints' => array(
            ),
            'label' => 'bon_plan.mise_en_avant',
            'required' => false,
        ));
        $builder->add('push_home', 'checkbox', array(
            'constraints' => array(
            ),
            'label' => 'bon_plan.push_home',
            'required' => false,
        ));
        $builder->add('date_start', 'date', array(
            'constraints' => array(
            ),
            'widget' => 'single_text',
            'label' => 'bon_plan.date_start',
            'required' => false,
        ));
        $builder->add('day_start', 'choice', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'choices' => array(
                'monday' => 'monday',
                'tuesday' => 'tuesday',
                'wednesday' => 'wednesday',
                'thursday' => 'thursday',
                'friday' => 'friday',
                'saturday' => 'saturday',
                'sunday' => 'sunday',
            ),
            'label' => 'bon_plan.day_start',
            'required' => false,
        ));
        $builder->add('day_range', 'choice', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'choices' => array(
                7 => '7',
                14 => '14',
                21 => '21',
            ),
            'label' => 'bon_plan.day_range',
            'required' => false,
        ));
        $builder->add('nb_adultes', 'integer', array(
            'constraints' => array(
            ),
            'label' => 'bon_plan.nb_adultes',
            'required' => false,
        ));
        $builder->add('nb_enfants', 'integer', array(
            'constraints' => array(
            ),
            'label' => 'bon_plan.nb_enfants',
            'required' => false,
        ));
        $builder->add('period_categories', 'text', array(
            'constraints' => array(
            ),
            'label' => 'bon_plan.period_categories',
            'required' => false,
        ));
        $builder->add('active', 'checkbox', array(
            'constraints' => array(
            ),
            'label' => 'bon_plan.active',
            'required' => false,
        ));
        $builder->add('bon_plan_categories', 'model', array(
            'class' => 'Cungfoo\Model\BonPlanCategorie',
            'constraints' => array(
            ),
            'multiple' => true,
            'label' => 'bon_plan.bon_plan_categories',
            'required' => false,
        ));
        $builder->add('etablissements', 'model', array(
            'class' => 'Cungfoo\Model\Etablissement',
            'constraints' => array(
            ),
            'multiple' => true,
            'label' => 'bon_plan.etablissements',
            'required' => false,
        ));
        $builder->add('regions', 'model', array(
            'class' => 'Cungfoo\Model\Region',
            'constraints' => array(
            ),
            'multiple' => true,
            'label' => 'bon_plan.regions',
            'required' => false,
        ));
        $builder->add('bon_planI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\BonPlanI18n',
            'languages' => array(
                0 => 'fr',
                1 => 'de',
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
                    'type' => 'textarea',
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
                'indice_prix' => array(
                    'required' => false,
                    'label' => 'bon_plan.indice_prix',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'active_locale' => array(
                    'required' => false,
                    'label' => 'bon_plan.active_locale',
                    'type' => 'checkbox',
                    'constraints' => array(
                    ),
                ),
                'seo_title' => array(
                    'required' => false,
                    'label' => 'bon_plan.seo_title',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'seo_description' => array(
                    'required' => false,
                    'label' => 'bon_plan.seo_description',
                    'type' => 'textarea',
                    'constraints' => array(
                    ),
                ),
                'seo_h1' => array(
                    'required' => false,
                    'label' => 'bon_plan.seo_h1',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'seo_keywords' => array(
                    'required' => false,
                    'label' => 'bon_plan.seo_keywords',
                    'type' => 'textarea',
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
