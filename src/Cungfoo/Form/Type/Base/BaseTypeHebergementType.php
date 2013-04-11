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
    public function getIdType()
    {
        return 'hidden';
    }

    public function getIdOptions()
    {
        return array(
            'required' => false,
            'label' => 'type_hebergement.id',
        );
    }

    public function getCodeType()
    {
        return 'text';
    }

    public function getCodeOptions()
    {
        return array(
            'required' => false,
            'label' => 'type_hebergement.code',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
        );
    }

    public function getCategoryTypeHebergementType()
    {
        return 'model';
    }

    public function getCategoryTypeHebergementOptions()
    {
        return array(
            'required' => false,
            'label' => 'type_hebergement.category_type_hebergement_id',
            'class' => 'Cungfoo\Model\CategoryTypeHebergement',
        );
    }

    public function getNombreChambreType()
    {
        return 'integer';
    }

    public function getNombreChambreOptions()
    {
        return array(
            'required' => false,
            'label' => 'type_hebergement.nombre_chambre',
        );
    }

    public function getNombrePlaceType()
    {
        return 'integer';
    }

    public function getNombrePlaceOptions()
    {
        return array(
            'required' => false,
            'label' => 'type_hebergement.nombre_place',
        );
    }

    public function getCreatedAtType()
    {
        return 'datetime';
    }

    public function getCreatedAtOptions()
    {
        return array(
            'required' => false,
            'label' => 'type_hebergement.created_at',
            'widget' => 'single_text',
        );
    }

    public function getUpdatedAtType()
    {
        return 'datetime';
    }

    public function getUpdatedAtOptions()
    {
        return array(
            'required' => false,
            'label' => 'type_hebergement.updated_at',
            'widget' => 'single_text',
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
            'label' => 'type_hebergement.active',
        );
    }

    public function getImageHebergementPathType()
    {
        return 'cungfoo_file';
    }

    public function getImageHebergementPathOptions()
    {
        return array(
            'required' => false,
            'label' => 'type_hebergement.image_hebergement_path',
        );
    }

    public function getImageCompositionPathType()
    {
        return 'cungfoo_file';
    }

    public function getImageCompositionPathOptions()
    {
        return array(
            'required' => false,
            'label' => 'type_hebergement.image_composition_path',
        );
    }

    public function getSliderType()
    {
        return 'cungfoo_file';
    }

    public function getSliderOptions()
    {
        return array(
            'required' => false,
            'label' => 'type_hebergement.slider',
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
            'label' => 'etablissement_type_hebergement.etablissement_id',
            'class' => 'Cungfoo\Model\Etablissement',
            'multiple' => true,
        );
    }

    public function getTypeHebergementCapacitesType()
    {
        return 'model';
    }

    public function getTypeHebergementCapacitesOptions()
    {
        return array(
            'required' => false,
            'label' => 'type_hebergement_type_hebergement_capacite.type_hebergement_capacite_id',
            'class' => 'Cungfoo\Model\TypeHebergementCapacite',
            'multiple' => true,
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
            'label' => 'bon_plan_type_hebergement.bon_plan_id',
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
            'label' => 'type_hebergement_i18n.name',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
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
            'label' => 'type_hebergement_i18n.slug',
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
            'label' => 'type_hebergement_i18n.indice',
        );
    }

    public function getSurfaceType()
    {
        return 'text';
    }

    public function getSurfaceOptions()
    {
        return array(
            'required' => false,
            'label' => 'type_hebergement_i18n.surface',
        );
    }

    public function getTypeTerrasseType()
    {
        return 'text';
    }

    public function getTypeTerrasseOptions()
    {
        return array(
            'required' => false,
            'label' => 'type_hebergement_i18n.type_terrasse',
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
            'label' => 'type_hebergement_i18n.description',
        );
    }

    public function getCompositionType()
    {
        return 'textarea';
    }

    public function getCompositionOptions()
    {
        return array(
            'required' => false,
            'label' => 'type_hebergement_i18n.composition',
        );
    }

    public function getPresentationType()
    {
        return 'textarea';
    }

    public function getPresentationOptions()
    {
        return array(
            'required' => false,
            'label' => 'type_hebergement_i18n.presentation',
        );
    }

    public function getCapaciteHebergementType()
    {
        return 'textarea';
    }

    public function getCapaciteHebergementOptions()
    {
        return array(
            'required' => false,
            'label' => 'type_hebergement_i18n.capacite_hebergement',
        );
    }

    public function getDimensionsType()
    {
        return 'textarea';
    }

    public function getDimensionsOptions()
    {
        return array(
            'required' => false,
            'label' => 'type_hebergement_i18n.dimensions',
        );
    }

    public function getAgencementType()
    {
        return 'textarea';
    }

    public function getAgencementOptions()
    {
        return array(
            'required' => false,
            'label' => 'type_hebergement_i18n.agencement',
        );
    }

    public function getEquipementsType()
    {
        return 'textarea';
    }

    public function getEquipementsOptions()
    {
        return array(
            'required' => false,
            'label' => 'type_hebergement_i18n.equipements',
        );
    }

    public function getAnneeUtilisationType()
    {
        return 'textarea';
    }

    public function getAnneeUtilisationOptions()
    {
        return array(
            'required' => false,
            'label' => 'type_hebergement_i18n.annee_utilisation',
        );
    }

    public function getRemarque1Type()
    {
        return 'textarea';
    }

    public function getRemarque1Options()
    {
        return array(
            'required' => false,
            'label' => 'type_hebergement_i18n.remarque_1',
        );
    }

    public function getRemarque2Type()
    {
        return 'textarea';
    }

    public function getRemarque2Options()
    {
        return array(
            'required' => false,
            'label' => 'type_hebergement_i18n.remarque_2',
        );
    }

    public function getRemarque3Type()
    {
        return 'textarea';
    }

    public function getRemarque3Options()
    {
        return array(
            'required' => false,
            'label' => 'type_hebergement_i18n.remarque_3',
        );
    }

    public function getRemarque4Type()
    {
        return 'textarea';
    }

    public function getRemarque4Options()
    {
        return array(
            'required' => false,
            'label' => 'type_hebergement_i18n.remarque_4',
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
            'label' => 'type_hebergement_i18n.seo_title',
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
            'label' => 'type_hebergement_i18n.seo_description',
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
            'label' => 'type_hebergement_i18n.seo_h1',
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
            'label' => 'type_hebergement_i18n.seo_keywords',
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
            'label' => 'type_hebergement_i18n.active_locale',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', $this->getIdType(), $this->getIdOptions());
        $builder->add('code', $this->getCodeType(), $this->getCodeOptions());
        $builder->add('category_type_hebergement', $this->getCategoryTypeHebergementType(), $this->getCategoryTypeHebergementOptions());
        $builder->add('nombre_chambre', $this->getNombreChambreType(), $this->getNombreChambreOptions());
        $builder->add('nombre_place', $this->getNombrePlaceType(), $this->getNombrePlaceOptions());
        $builder->add('created_at', $this->getCreatedAtType(), $this->getCreatedAtOptions());
        $builder->add('updated_at', $this->getUpdatedAtType(), $this->getUpdatedAtOptions());
        $builder->add('active', $this->getActiveType(), $this->getActiveOptions());
        $builder->add('image_hebergement_path', $this->getImageHebergementPathType(), $this->getImageHebergementPathOptions());
        $builder->add('image_composition_path', $this->getImageCompositionPathType(), $this->getImageCompositionPathOptions());
        $builder->add('slider', $this->getSliderType(), $this->getSliderOptions());
        $builder->add('etablissements', $this->getEtablissementsType(), $this->getEtablissementsOptions());
        $builder->add('type_hebergement_capacites', $this->getTypeHebergementCapacitesType(), $this->getTypeHebergementCapacitesOptions());
        $builder->add('bon_plans', $this->getBonPlansType(), $this->getBonPlansOptions());$builder->add('type_hebergementI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\TypeHebergementI18n',
            'label' => 'type_hebergementI18ns',
            'required' => false,
            'languages' => array('fr', 'de'),
            'columns' => array(
                'name' => array_merge(array('type' => $this->getNameType()), $this->getNameOptions()),
                'slug' => array_merge(array('type' => $this->getSlugType()), $this->getSlugOptions()),
                'indice' => array_merge(array('type' => $this->getIndiceType()), $this->getIndiceOptions()),
                'surface' => array_merge(array('type' => $this->getSurfaceType()), $this->getSurfaceOptions()),
                'type_terrasse' => array_merge(array('type' => $this->getTypeTerrasseType()), $this->getTypeTerrasseOptions()),
                'description' => array_merge(array('type' => $this->getDescriptionType()), $this->getDescriptionOptions()),
                'composition' => array_merge(array('type' => $this->getCompositionType()), $this->getCompositionOptions()),
                'presentation' => array_merge(array('type' => $this->getPresentationType()), $this->getPresentationOptions()),
                'capacite_hebergement' => array_merge(array('type' => $this->getCapaciteHebergementType()), $this->getCapaciteHebergementOptions()),
                'dimensions' => array_merge(array('type' => $this->getDimensionsType()), $this->getDimensionsOptions()),
                'agencement' => array_merge(array('type' => $this->getAgencementType()), $this->getAgencementOptions()),
                'equipements' => array_merge(array('type' => $this->getEquipementsType()), $this->getEquipementsOptions()),
                'annee_utilisation' => array_merge(array('type' => $this->getAnneeUtilisationType()), $this->getAnneeUtilisationOptions()),
                'remarque_1' => array_merge(array('type' => $this->getRemarque1Type()), $this->getRemarque1Options()),
                'remarque_2' => array_merge(array('type' => $this->getRemarque2Type()), $this->getRemarque2Options()),
                'remarque_3' => array_merge(array('type' => $this->getRemarque3Type()), $this->getRemarque3Options()),
                'remarque_4' => array_merge(array('type' => $this->getRemarque4Type()), $this->getRemarque4Options()),
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
