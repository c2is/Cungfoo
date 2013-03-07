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
    public function getIdType()
    {
        return 'hidden';
    }

    public function getIdOptions()
    {
        return array(
            'required' => false,
            'label' => 'bon_plan.id',
        );
    }

    public function getDateDebutType()
    {
        return 'date';
    }

    public function getDateDebutOptions()
    {
        return array(
            'required' => false,
            'label' => 'bon_plan.date_debut',
            'widget' => 'single_text',
        );
    }

    public function getDateFinType()
    {
        return 'date';
    }

    public function getDateFinOptions()
    {
        return array(
            'required' => false,
            'label' => 'bon_plan.date_fin',
            'widget' => 'single_text',
        );
    }

    public function getPrixType()
    {
        return 'integer';
    }

    public function getPrixOptions()
    {
        return array(
            'required' => false,
            'label' => 'bon_plan.prix',
        );
    }

    public function getPrixBarreType()
    {
        return 'integer';
    }

    public function getPrixBarreOptions()
    {
        return array(
            'required' => false,
            'label' => 'bon_plan.prix_barre',
        );
    }

    public function getActiveCompteurType()
    {
        return 'checkbox';
    }

    public function getActiveCompteurOptions()
    {
        return array(
            'required' => false,
            'label' => 'bon_plan.active_compteur',
        );
    }

    public function getMiseEnAvantType()
    {
        return 'checkbox';
    }

    public function getMiseEnAvantOptions()
    {
        return array(
            'required' => false,
            'label' => 'bon_plan.mise_en_avant',
        );
    }

    public function getPushHomeType()
    {
        return 'checkbox';
    }

    public function getPushHomeOptions()
    {
        return array(
            'required' => false,
            'label' => 'bon_plan.push_home',
        );
    }

    public function getDateStartType()
    {
        return 'date';
    }

    public function getDateStartOptions()
    {
        return array(
            'required' => false,
            'label' => 'bon_plan.date_start',
            'widget' => 'single_text',
        );
    }

    public function getDayStartType()
    {
        return 'choice';
    }

    public function getDayStartOptions()
    {
        return array(
            'required' => false,
            'label' => 'bon_plan.day_start',
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
        );
    }

    public function getDayRangeType()
    {
        return 'choice';
    }

    public function getDayRangeOptions()
    {
        return array(
            'required' => false,
            'label' => 'bon_plan.day_range',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
            'choices' => array(
                        7 => '7',
                        14 => '14',
                        21 => '21',
                    ),
        );
    }

    public function getNbAdultesType()
    {
        return 'integer';
    }

    public function getNbAdultesOptions()
    {
        return array(
            'required' => false,
            'label' => 'bon_plan.nb_adultes',
        );
    }

    public function getNbEnfantsType()
    {
        return 'integer';
    }

    public function getNbEnfantsOptions()
    {
        return array(
            'required' => false,
            'label' => 'bon_plan.nb_enfants',
        );
    }

    public function getPeriodCategoriesType()
    {
        return 'text';
    }

    public function getPeriodCategoriesOptions()
    {
        return array(
            'required' => false,
            'label' => 'bon_plan.period_categories',
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
            'label' => 'bon_plan.active',
        );
    }

    public function getImageMenuType()
    {
        return 'cungfoo_file';
    }

    public function getImageMenuOptions()
    {
        return array(
            'required' => false,
            'label' => 'bon_plan.image_menu',
        );
    }

    public function getImagePageType()
    {
        return 'cungfoo_file';
    }

    public function getImagePageOptions()
    {
        return array(
            'required' => false,
            'label' => 'bon_plan.image_page',
        );
    }

    public function getImageListeType()
    {
        return 'cungfoo_file';
    }

    public function getImageListeOptions()
    {
        return array(
            'required' => false,
            'label' => 'bon_plan.image_liste',
        );
    }

    public function getBonPlanCategoriesType()
    {
        return 'model';
    }

    public function getBonPlanCategoriesOptions()
    {
        return array(
            'required' => false,
            'label' => 'bon_plan_bon_plan_categorie.bon_plan_categorie_id',
            'class' => 'Cungfoo\Model\BonPlanCategorie',
            'multiple' => true,
        );
    }

    public function getEtablissementsType()
    {
        return 'model';
    }

    public function getEtablissementsOptions()
    {
        return array(
            'required' => false,
            'label' => 'bon_plan_etablissement.etablissement_id',
            'class' => 'Cungfoo\Model\Etablissement',
            'multiple' => true,
        );
    }

    public function getRegionsType()
    {
        return 'model';
    }

    public function getRegionsOptions()
    {
        return array(
            'required' => false,
            'label' => 'bon_plan_region.region_id',
            'class' => 'Cungfoo\Model\Region',
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
            'label' => 'bon_plan_i18n.name',
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
            'label' => 'bon_plan_i18n.slug',
        );
    }

    public function getIntroductionType()
    {
        return 'text';
    }

    public function getIntroductionOptions()
    {
        return array(
            'required' => false,
            'label' => 'bon_plan_i18n.introduction',
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
            'label' => 'bon_plan_i18n.description',
        );
    }

    public function getIndiceType()
    {
        return 'text';
    }

    public function getIndiceOptions()
    {
        return array(
            'required' => false,
            'label' => 'bon_plan_i18n.indice',
        );
    }

    public function getIndicePrixType()
    {
        return 'text';
    }

    public function getIndicePrixOptions()
    {
        return array(
            'required' => false,
            'label' => 'bon_plan_i18n.indice_prix',
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
            'label' => 'bon_plan_i18n.seo_title',
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
            'label' => 'bon_plan_i18n.seo_description',
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
            'label' => 'bon_plan_i18n.seo_h1',
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
            'label' => 'bon_plan_i18n.seo_keywords',
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
            'label' => 'bon_plan_i18n.active_locale',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', $this->getIdType(), $this->getIdOptions());
        $builder->add('date_debut', $this->getDateDebutType(), $this->getDateDebutOptions());
        $builder->add('date_fin', $this->getDateFinType(), $this->getDateFinOptions());
        $builder->add('prix', $this->getPrixType(), $this->getPrixOptions());
        $builder->add('prix_barre', $this->getPrixBarreType(), $this->getPrixBarreOptions());
        $builder->add('active_compteur', $this->getActiveCompteurType(), $this->getActiveCompteurOptions());
        $builder->add('mise_en_avant', $this->getMiseEnAvantType(), $this->getMiseEnAvantOptions());
        $builder->add('push_home', $this->getPushHomeType(), $this->getPushHomeOptions());
        $builder->add('date_start', $this->getDateStartType(), $this->getDateStartOptions());
        $builder->add('day_start', $this->getDayStartType(), $this->getDayStartOptions());
        $builder->add('day_range', $this->getDayRangeType(), $this->getDayRangeOptions());
        $builder->add('nb_adultes', $this->getNbAdultesType(), $this->getNbAdultesOptions());
        $builder->add('nb_enfants', $this->getNbEnfantsType(), $this->getNbEnfantsOptions());
        $builder->add('period_categories', $this->getPeriodCategoriesType(), $this->getPeriodCategoriesOptions());
        $builder->add('active', $this->getActiveType(), $this->getActiveOptions());
        $builder->add('image_menu', $this->getImageMenuType(), $this->getImageMenuOptions());
        $builder->add('image_page', $this->getImagePageType(), $this->getImagePageOptions());
        $builder->add('image_liste', $this->getImageListeType(), $this->getImageListeOptions());
        $builder->add('bon_plan_categories', $this->getBonPlanCategoriesType(), $this->getBonPlanCategoriesOptions());
        $builder->add('etablissements', $this->getEtablissementsType(), $this->getEtablissementsOptions());
        $builder->add('regions', $this->getRegionsType(), $this->getRegionsOptions());$builder->add('bon_planI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\BonPlanI18n',
            'label' => 'bon_planI18ns',
            'required' => false,
            'languages' => array('fr', 'de'),
            'columns' => array(
                'name' => array_merge(array('type' => $this->getNameType()), $this->getNameOptions()),
                'slug' => array_merge(array('type' => $this->getSlugType()), $this->getSlugOptions()),
                'introduction' => array_merge(array('type' => $this->getIntroductionType()), $this->getIntroductionOptions()),
                'description' => array_merge(array('type' => $this->getDescriptionType()), $this->getDescriptionOptions()),
                'indice' => array_merge(array('type' => $this->getIndiceType()), $this->getIndiceOptions()),
                'indice_prix' => array_merge(array('type' => $this->getIndicePrixType()), $this->getIndicePrixOptions()),
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
