<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'etablissement' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseEtablissementType extends AppAwareType
{
    public function getIdType()
    {
        return 'integer';
    }

    public function getIdOptions()
    {
        return array(
            'required' => false,
            'label' => 'etablissement.id',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
        );
    }

    public function getCodeType()
    {
        return 'integer';
    }

    public function getCodeOptions()
    {
        return array(
            'required' => false,
            'label' => 'etablissement.code',
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
            'label' => 'etablissement.slug',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
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
            'label' => 'etablissement.name',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
        );
    }

    public function getTitleType()
    {
        return 'text';
    }

    public function getTitleOptions()
    {
        return array(
            'required' => false,
            'label' => 'etablissement.title',
        );
    }

    public function getAddress1Type()
    {
        return 'text';
    }

    public function getAddress1Options()
    {
        return array(
            'required' => false,
            'label' => 'etablissement.address1',
        );
    }

    public function getAddress2Type()
    {
        return 'text';
    }

    public function getAddress2Options()
    {
        return array(
            'required' => false,
            'label' => 'etablissement.address2',
        );
    }

    public function getZipType()
    {
        return 'text';
    }

    public function getZipOptions()
    {
        return array(
            'required' => false,
            'label' => 'etablissement.zip',
        );
    }

    public function getCityType()
    {
        return 'text';
    }

    public function getCityOptions()
    {
        return array(
            'required' => false,
            'label' => 'etablissement.city',
        );
    }

    public function getMailType()
    {
        return 'text';
    }

    public function getMailOptions()
    {
        return array(
            'required' => false,
            'label' => 'etablissement.mail',
        );
    }

    public function getCountryCodeType()
    {
        return 'text';
    }

    public function getCountryCodeOptions()
    {
        return array(
            'required' => false,
            'label' => 'etablissement.country_code',
        );
    }

    public function getPhone1Type()
    {
        return 'text';
    }

    public function getPhone1Options()
    {
        return array(
            'required' => false,
            'label' => 'etablissement.phone1',
        );
    }

    public function getPhone2Type()
    {
        return 'text';
    }

    public function getPhone2Options()
    {
        return array(
            'required' => false,
            'label' => 'etablissement.phone2',
        );
    }

    public function getFaxType()
    {
        return 'text';
    }

    public function getFaxOptions()
    {
        return array(
            'required' => false,
            'label' => 'etablissement.fax',
        );
    }

    public function getOpeningDateType()
    {
        return 'datetime';
    }

    public function getOpeningDateOptions()
    {
        return array(
            'required' => false,
            'label' => 'etablissement.opening_date',
            'widget' => 'single_text',
        );
    }

    public function getClosingDateType()
    {
        return 'datetime';
    }

    public function getClosingDateOptions()
    {
        return array(
            'required' => false,
            'label' => 'etablissement.closing_date',
            'widget' => 'single_text',
        );
    }

    public function getVilleType()
    {
        return 'model';
    }

    public function getVilleOptions()
    {
        return array(
            'required' => false,
            'label' => 'etablissement.ville_id',
            'class' => 'Cungfoo\Model\Ville',
        );
    }

    public function getDepartementType()
    {
        return 'model';
    }

    public function getDepartementOptions()
    {
        return array(
            'required' => false,
            'label' => 'etablissement.departement_id',
            'class' => 'Cungfoo\Model\Departement',
        );
    }

    public function getCategorieType()
    {
        return 'model';
    }

    public function getCategorieOptions()
    {
        return array(
            'required' => false,
            'label' => 'etablissement.categorie_id',
            'class' => 'Cungfoo\Model\Categorie',
        );
    }

    public function getGeoCoordinateXType()
    {
        return 'text';
    }

    public function getGeoCoordinateXOptions()
    {
        return array(
            'required' => false,
            'label' => 'etablissement.geo_coordinate_x',
        );
    }

    public function getGeoCoordinateYType()
    {
        return 'text';
    }

    public function getGeoCoordinateYOptions()
    {
        return array(
            'required' => false,
            'label' => 'etablissement.geo_coordinate_y',
        );
    }

    public function getVideoPathType()
    {
        return 'text';
    }

    public function getVideoPathOptions()
    {
        return array(
            'required' => false,
            'label' => 'etablissement.video_path',
        );
    }

    public function getImage360PathType()
    {
        return 'text';
    }

    public function getImage360PathOptions()
    {
        return array(
            'required' => false,
            'label' => 'etablissement.image_360_path',
        );
    }

    public function getCapaciteType()
    {
        return 'text';
    }

    public function getCapaciteOptions()
    {
        return array(
            'required' => false,
            'label' => 'etablissement.capacite',
        );
    }

    public function getPlanPathType()
    {
        return 'cungfoo_file';
    }

    public function getPlanPathOptions()
    {
        return array(
            'required' => false,
            'label' => 'etablissement.plan_path',
        );
    }

    public function getPlanPathDeletedType()
    {
        return 'checkbox';
    }

    public function getPlanPathDeletedOptions()
    {
        return array(
            'property_path' => false,
            'required' => false,
            'label' => 'etablissement.plan_path_deleted',
        );
    }

    public function getVignetteType()
    {
        return 'cungfoo_file';
    }

    public function getVignetteOptions()
    {
        return array(
            'required' => false,
            'label' => 'etablissement.vignette',
        );
    }

    public function getVignetteDeletedType()
    {
        return 'checkbox';
    }

    public function getVignetteDeletedOptions()
    {
        return array(
            'property_path' => false,
            'required' => false,
            'label' => 'etablissement.vignette_deleted',
        );
    }

    public function getEtablissementRelatedByRelated1Type()
    {
        return 'model';
    }

    public function getEtablissementRelatedByRelated1Options()
    {
        return array(
            'required' => false,
            'label' => 'etablissement.related_1',
            'class' => 'Cungfoo\Model\Etablissement',
        );
    }

    public function getEtablissementRelatedByRelated2Type()
    {
        return 'model';
    }

    public function getEtablissementRelatedByRelated2Options()
    {
        return array(
            'required' => false,
            'label' => 'etablissement.related_2',
            'class' => 'Cungfoo\Model\Etablissement',
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
            'label' => 'etablissement.created_at',
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
            'label' => 'etablissement.updated_at',
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
            'label' => 'etablissement.active',
        );
    }

    public function getTypeHebergementsType()
    {
        return 'model';
    }

    public function getTypeHebergementsOptions()
    {
        return array(
            'required' => false,
            'label' => 'etablissement_type_hebergement.type_hebergement_id',
            'class' => 'Cungfoo\Model\TypeHebergement',
            'multiple' => true,
        );
    }

    public function getDestinationsType()
    {
        return 'model';
    }

    public function getDestinationsOptions()
    {
        return array(
            'required' => false,
            'label' => 'etablissement_destination.destination_id',
            'class' => 'Cungfoo\Model\Destination',
            'multiple' => true,
        );
    }

    public function getActivitesType()
    {
        return 'model';
    }

    public function getActivitesOptions()
    {
        return array(
            'required' => false,
            'label' => 'etablissement_activite.activite_id',
            'class' => 'Cungfoo\Model\Activite',
            'multiple' => true,
        );
    }

    public function getServiceComplementairesType()
    {
        return 'model';
    }

    public function getServiceComplementairesOptions()
    {
        return array(
            'required' => false,
            'label' => 'etablissement_service_complementaire.service_complementaire_id',
            'class' => 'Cungfoo\Model\ServiceComplementaire',
            'multiple' => true,
        );
    }

    public function getSituationGeographiquesType()
    {
        return 'model';
    }

    public function getSituationGeographiquesOptions()
    {
        return array(
            'required' => false,
            'label' => 'etablissement_situation_geographique.situation_geographique_id',
            'class' => 'Cungfoo\Model\SituationGeographique',
            'multiple' => true,
        );
    }

    public function getBaignadesType()
    {
        return 'model';
    }

    public function getBaignadesOptions()
    {
        return array(
            'required' => false,
            'label' => 'etablissement_baignade.baignade_id',
            'class' => 'Cungfoo\Model\Baignade',
            'multiple' => true,
        );
    }

    public function getThematiquesType()
    {
        return 'model';
    }

    public function getThematiquesOptions()
    {
        return array(
            'required' => false,
            'label' => 'etablissement_thematique.thematique_id',
            'class' => 'Cungfoo\Model\Thematique',
            'multiple' => true,
        );
    }

    public function getPointInteretsType()
    {
        return 'model';
    }

    public function getPointInteretsOptions()
    {
        return array(
            'required' => false,
            'label' => 'etablissement_point_interet.point_interet_id',
            'class' => 'Cungfoo\Model\PointInteret',
            'multiple' => true,
        );
    }

    public function getEventsType()
    {
        return 'model';
    }

    public function getEventsOptions()
    {
        return array(
            'required' => false,
            'label' => 'etablissement_event.event_id',
            'class' => 'Cungfoo\Model\Event',
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
            'label' => 'bon_plan_etablissement.bon_plan_id',
            'class' => 'Cungfoo\Model\BonPlan',
            'multiple' => true,
        );
    }

    public function getCountryType()
    {
        return 'text';
    }

    public function getCountryOptions()
    {
        return array(
            'required' => false,
            'label' => 'etablissement_i18n.country',
        );
    }

    public function getOuvertureReceptionType()
    {
        return 'textarea';
    }

    public function getOuvertureReceptionOptions()
    {
        return array(
            'required' => false,
            'label' => 'etablissement_i18n.ouverture_reception',
        );
    }

    public function getOuvertureCampingType()
    {
        return 'textarea';
    }

    public function getOuvertureCampingOptions()
    {
        return array(
            'required' => false,
            'label' => 'etablissement_i18n.ouverture_camping',
        );
    }

    public function getArriveesDepartsType()
    {
        return 'textarea';
    }

    public function getArriveesDepartsOptions()
    {
        return array(
            'required' => false,
            'label' => 'etablissement_i18n.arrivees_departs',
        );
    }

    public function getDescriptionType()
    {
        return 'textrich';
    }

    public function getDescriptionOptions()
    {
        return array(
            'required' => false,
            'label' => 'etablissement_i18n.description',
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
            'label' => 'etablissement_i18n.seo_title',
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
            'label' => 'etablissement_i18n.seo_description',
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
            'label' => 'etablissement_i18n.seo_h1',
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
            'label' => 'etablissement_i18n.seo_keywords',
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
            'label' => 'etablissement_i18n.active_locale',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', $this->getIdType(), $this->getIdOptions());
        $builder->add('code', $this->getCodeType(), $this->getCodeOptions());
        $builder->add('slug', $this->getSlugType(), $this->getSlugOptions());
        $builder->add('name', $this->getNameType(), $this->getNameOptions());
        $builder->add('title', $this->getTitleType(), $this->getTitleOptions());
        $builder->add('address1', $this->getAddress1Type(), $this->getAddress1Options());
        $builder->add('address2', $this->getAddress2Type(), $this->getAddress2Options());
        $builder->add('zip', $this->getZipType(), $this->getZipOptions());
        $builder->add('city', $this->getCityType(), $this->getCityOptions());
        $builder->add('mail', $this->getMailType(), $this->getMailOptions());
        $builder->add('country_code', $this->getCountryCodeType(), $this->getCountryCodeOptions());
        $builder->add('phone1', $this->getPhone1Type(), $this->getPhone1Options());
        $builder->add('phone2', $this->getPhone2Type(), $this->getPhone2Options());
        $builder->add('fax', $this->getFaxType(), $this->getFaxOptions());
        $builder->add('opening_date', $this->getOpeningDateType(), $this->getOpeningDateOptions());
        $builder->add('closing_date', $this->getClosingDateType(), $this->getClosingDateOptions());
        $builder->add('ville', $this->getVilleType(), $this->getVilleOptions());
        $builder->add('departement', $this->getDepartementType(), $this->getDepartementOptions());
        $builder->add('categorie', $this->getCategorieType(), $this->getCategorieOptions());
        $builder->add('geo_coordinate_x', $this->getGeoCoordinateXType(), $this->getGeoCoordinateXOptions());
        $builder->add('geo_coordinate_y', $this->getGeoCoordinateYType(), $this->getGeoCoordinateYOptions());
        $builder->add('video_path', $this->getVideoPathType(), $this->getVideoPathOptions());
        $builder->add('image_360_path', $this->getImage360PathType(), $this->getImage360PathOptions());
        $builder->add('capacite', $this->getCapaciteType(), $this->getCapaciteOptions());
        $builder->add('plan_path', $this->getPlanPathType(), $this->getPlanPathOptions());
        $builder->add('plan_path_deleted', $this->getPlanPathDeletedType(), $this->getPlanPathDeletedOptions());
        $builder->add('vignette', $this->getVignetteType(), $this->getVignetteOptions());
        $builder->add('vignette_deleted', $this->getVignetteDeletedType(), $this->getVignetteDeletedOptions());
        $builder->add('etablissement_related_by_related_1', $this->getEtablissementRelatedByRelated1Type(), $this->getEtablissementRelatedByRelated1Options());
        $builder->add('etablissement_related_by_related_2', $this->getEtablissementRelatedByRelated2Type(), $this->getEtablissementRelatedByRelated2Options());
        $builder->add('created_at', $this->getCreatedAtType(), $this->getCreatedAtOptions());
        $builder->add('updated_at', $this->getUpdatedAtType(), $this->getUpdatedAtOptions());
        $builder->add('active', $this->getActiveType(), $this->getActiveOptions());
        $builder->add('type_hebergements', $this->getTypeHebergementsType(), $this->getTypeHebergementsOptions());
        $builder->add('destinations', $this->getDestinationsType(), $this->getDestinationsOptions());
        $builder->add('activites', $this->getActivitesType(), $this->getActivitesOptions());
        $builder->add('service_complementaires', $this->getServiceComplementairesType(), $this->getServiceComplementairesOptions());
        $builder->add('situation_geographiques', $this->getSituationGeographiquesType(), $this->getSituationGeographiquesOptions());
        $builder->add('baignades', $this->getBaignadesType(), $this->getBaignadesOptions());
        $builder->add('thematiques', $this->getThematiquesType(), $this->getThematiquesOptions());
        $builder->add('point_interets', $this->getPointInteretsType(), $this->getPointInteretsOptions());
        $builder->add('events', $this->getEventsType(), $this->getEventsOptions());
        $builder->add('bon_plans', $this->getBonPlansType(), $this->getBonPlansOptions());$builder->add('etablissementI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\EtablissementI18n',
            'label' => 'etablissementI18ns',
            'required' => false,
            'languages' => array('fr', 'de'),
            'columns' => array(
                'country' => array_merge(array('type' => $this->getCountryType()), $this->getCountryOptions()),
                'ouverture_reception' => array_merge(array('type' => $this->getOuvertureReceptionType()), $this->getOuvertureReceptionOptions()),
                'ouverture_camping' => array_merge(array('type' => $this->getOuvertureCampingType()), $this->getOuvertureCampingOptions()),
                'arrivees_departs' => array_merge(array('type' => $this->getArriveesDepartsType()), $this->getArriveesDepartsOptions()),
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
            'data_class' => 'Cungfoo\Model\Etablissement',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Etablissement';
    }

} // BaseEtablissementType
