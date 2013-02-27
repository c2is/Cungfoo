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
    public function getIdType()
    {
        return 'hidden';
    }

    public function getIdOptions()
    {
        return array(
            'required' => false,
            'label' => 'bon_plan_categorie.id',
        );
    }

    public function getSortableRankType()
    {
        return 'integer';
    }

    public function getSortableRankOptions()
    {
        return array(
            'required' => false,
            'label' => 'bon_plan_categorie.sortable_rank',
        );
    }

    public function getActiveType()
    {
        return 'checkbox';
    }

    public function getActiveOptions()
    {
        return array(
            'required' => false,
            'label' => 'bon_plan_categorie.active',
        );
    }

    public function getBonPlansType()
    {
        return 'model';
    }

    public function getBonPlansOptions()
    {
        return array(
            'required' => false,
            'label' => 'bon_plan_bon_plan_categorie.bon_plan_id',
            'class' => 'Cungfoo\Model\BonPlan',
            'multiple' => true,
        );
    }

    public function getNameType()
    {
        return 'text';
    }

    public function getNameOptions()
    {
        return array(
            'required' => false,
            'label' => 'bon_plan_categorie_i18n.name',
        );
    }

    public function getSlugType()
    {
        return 'text';
    }

    public function getSlugOptions()
    {
        return array(
            'required' => false,
            'label' => 'bon_plan_categorie_i18n.slug',
        );
    }

    public function getSubtitleType()
    {
        return 'text';
    }

    public function getSubtitleOptions()
    {
        return array(
            'required' => false,
            'label' => 'bon_plan_categorie_i18n.subtitle',
        );
    }

    public function getDescriptionType()
    {
        return 'textarea';
    }

    public function getDescriptionOptions()
    {
        return array(
            'required' => false,
            'label' => 'bon_plan_categorie_i18n.description',
        );
    }

    public function getSeoTitleType()
    {
        return 'text';
    }

    public function getSeoTitleOptions()
    {
        return array(
            'required' => false,
            'label' => 'bon_plan_categorie_i18n.seo_title',
        );
    }

    public function getSeoDescriptionType()
    {
        return 'textarea';
    }

    public function getSeoDescriptionOptions()
    {
        return array(
            'required' => false,
            'label' => 'bon_plan_categorie_i18n.seo_description',
        );
    }

    public function getSeoH1Type()
    {
        return 'text';
    }

    public function getSeoH1Options()
    {
        return array(
            'required' => false,
            'label' => 'bon_plan_categorie_i18n.seo_h1',
        );
    }

    public function getSeoKeywordsType()
    {
        return 'textarea';
    }

    public function getSeoKeywordsOptions()
    {
        return array(
            'required' => false,
            'label' => 'bon_plan_categorie_i18n.seo_keywords',
        );
    }

    public function getActiveLocaleType()
    {
        return 'checkbox';
    }

    public function getActiveLocaleOptions()
    {
        return array(
            'required' => false,
            'label' => 'bon_plan_categorie_i18n.active_locale',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', $this->getIdType(), $this->getIdOptions());
        $builder->add('sortable_rank', $this->getSortableRankType(), $this->getSortableRankOptions());
        $builder->add('active', $this->getActiveType(), $this->getActiveOptions());
        $builder->add('bon_plans', $this->getBonPlansType(), $this->getBonPlansOptions());$builder->add('bon_plan_categorieI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\BonPlanCategorieI18n',
            'label' => 'bon_plan_categorieI18ns',
            'required' => false,
            'languages' => array('fr', 'de'),
            'columns' => array(
                'name' => array_merge(array('type' => $this->getNameType()), $this->getNameOptions()),
                'slug' => array_merge(array('type' => $this->getSlugType()), $this->getSlugOptions()),
                'subtitle' => array_merge(array('type' => $this->getSubtitleType()), $this->getSubtitleOptions()),
                'description' => array_merge(array('type' => $this->getDescriptionType()), $this->getDescriptionOptions()),
                'seo_title' => array_merge(array('type' => $this->getSeoTitleType()), $this->getSeoTitleOptions()),
                'seo_description' => array_merge(array('type' => $this->getSeoDescriptionType()), $this->getSeoDescriptionOptions()),
                'seo_h1' => array_merge(array('type' => $this->getSeoH1Type()), $this->getSeoH1Options()),
                'seo_keywords' => array_merge(array('type' => $this->getSeoKeywordsType()), $this->getSeoKeywordsOptions()),
                'active_locale' => array_merge(array('type' => $this->getActiveLocaleType()), $this->getActiveLocaleOptions()),

            )
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
