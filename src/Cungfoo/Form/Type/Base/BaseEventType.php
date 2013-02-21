<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'event' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseEventType extends AppAwareType
{
    public function getIdType()
    {
        return 'integer';
    }

    public function getIdOptions()
    {
        return array(
            'required' => false,
            'label' => 'event.id',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
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
            'label' => 'event.code',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
        );
    }

    public function getCategoryType()
    {
        return 'text';
    }

    public function getCategoryOptions()
    {
        return array(
            'required' => false,
            'label' => 'event.category',
        );
    }

    public function getAddressType()
    {
        return 'text';
    }

    public function getAddressOptions()
    {
        return array(
            'required' => false,
            'label' => 'event.address',
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
            'label' => 'event.address2',
        );
    }

    public function getZipcodeType()
    {
        return 'text';
    }

    public function getZipcodeOptions()
    {
        return array(
            'required' => false,
            'label' => 'event.zipcode',
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
            'label' => 'event.city',
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
            'label' => 'event.geo_coordinate_x',
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
            'label' => 'event.geo_coordinate_y',
        );
    }

    public function getDistanceCampingType()
    {
        return 'text';
    }

    public function getDistanceCampingOptions()
    {
        return array(
            'required' => false,
            'label' => 'event.distance_camping',
        );
    }

    public function getImageType()
    {
        return 'text';
    }

    public function getImageOptions()
    {
        return array(
            'required' => false,
            'label' => 'event.image',
        );
    }

    public function getPriorityType()
    {
        return 'text';
    }

    public function getPriorityOptions()
    {
        return array(
            'required' => false,
            'label' => 'event.priority',
        );
    }

    public function getTelType()
    {
        return 'text';
    }

    public function getTelOptions()
    {
        return array(
            'required' => false,
            'label' => 'event.tel',
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
            'label' => 'event.fax',
        );
    }

    public function getEmailType()
    {
        return 'text';
    }

    public function getEmailOptions()
    {
        return array(
            'required' => false,
            'label' => 'event.email',
        );
    }

    public function getWebsiteType()
    {
        return 'text';
    }

    public function getWebsiteOptions()
    {
        return array(
            'required' => false,
            'label' => 'event.website',
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
            'label' => 'event.created_at',
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
            'label' => 'event.updated_at',
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
            'label' => 'event.active',
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
            'label' => 'etablissement_event.etablissement_id',
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
            'label' => 'region_event.region_id',
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
            'label' => 'event_i18n.name',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
        );
    }

    public function getStrDateType()
    {
        return 'text';
    }

    public function getStrDateOptions()
    {
        return array(
            'required' => false,
            'label' => 'event_i18n.str_date',
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
            'label' => 'event_i18n.subtitle',
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
            'label' => 'event_i18n.description',
        );
    }

    public function getTransportType()
    {
        return 'textarea';
    }

    public function getTransportOptions()
    {
        return array(
            'required' => false,
            'label' => 'event_i18n.transport',
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
            'label' => 'event_i18n.slug',
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
            'label' => 'event_i18n.seo_title',
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
            'label' => 'event_i18n.seo_description',
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
            'label' => 'event_i18n.seo_h1',
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
            'label' => 'event_i18n.seo_keywords',
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
            'label' => 'event_i18n.active_locale',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', $this->getIdType(), $this->getIdOptions());
        $builder->add('code', $this->getCodeType(), $this->getCodeOptions());
        $builder->add('category', $this->getCategoryType(), $this->getCategoryOptions());
        $builder->add('address', $this->getAddressType(), $this->getAddressOptions());
        $builder->add('address2', $this->getAddress2Type(), $this->getAddress2Options());
        $builder->add('zipcode', $this->getZipcodeType(), $this->getZipcodeOptions());
        $builder->add('city', $this->getCityType(), $this->getCityOptions());
        $builder->add('geo_coordinate_x', $this->getGeoCoordinateXType(), $this->getGeoCoordinateXOptions());
        $builder->add('geo_coordinate_y', $this->getGeoCoordinateYType(), $this->getGeoCoordinateYOptions());
        $builder->add('distance_camping', $this->getDistanceCampingType(), $this->getDistanceCampingOptions());
        $builder->add('image', $this->getImageType(), $this->getImageOptions());
        $builder->add('priority', $this->getPriorityType(), $this->getPriorityOptions());
        $builder->add('tel', $this->getTelType(), $this->getTelOptions());
        $builder->add('fax', $this->getFaxType(), $this->getFaxOptions());
        $builder->add('email', $this->getEmailType(), $this->getEmailOptions());
        $builder->add('website', $this->getWebsiteType(), $this->getWebsiteOptions());
        $builder->add('created_at', $this->getCreatedAtType(), $this->getCreatedAtOptions());
        $builder->add('updated_at', $this->getUpdatedAtType(), $this->getUpdatedAtOptions());
        $builder->add('active', $this->getActiveType(), $this->getActiveOptions());
        $builder->add('etablissements', $this->getEtablissementsType(), $this->getEtablissementsOptions());
        $builder->add('regions', $this->getRegionsType(), $this->getRegionsOptions());$builder->add('eventI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\EventI18n',
            'label' => 'eventI18ns',
            'required' => false,
            'languages' => array('fr', 'de'),
            'columns' => array(
                'name' => array_merge(array('type' => $this->getNameType()), $this->getNameOptions()),
                'str_date' => array_merge(array('type' => $this->getStrDateType()), $this->getStrDateOptions()),
                'subtitle' => array_merge(array('type' => $this->getSubtitleType()), $this->getSubtitleOptions()),
                'description' => array_merge(array('type' => $this->getDescriptionType()), $this->getDescriptionOptions()),
                'transport' => array_merge(array('type' => $this->getTransportType()), $this->getTransportOptions()),
                'slug' => array_merge(array('type' => $this->getSlugType()), $this->getSlugOptions()),
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
            'data_class' => 'Cungfoo\Model\Event',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Event';
    }

} // BaseEventType
