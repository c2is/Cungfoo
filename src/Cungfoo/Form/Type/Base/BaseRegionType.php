<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'region' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseRegionType extends AppAwareType
{
    public function getIdType()
    {
        return 'hidden';
    }

    public function getIdOptions()
    {
        return array(
            'required' => false,
            'label' => 'region.id',
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
            'label' => 'region.code',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
        );
    }

    public function getPaysType()
    {
        return 'model';
    }

    public function getPaysOptions()
    {
        return array(
            'required' => false,
            'label' => 'region.pays_id',
            'class' => 'Cungfoo\Model\Pays',
        );
    }

    public function getDestinationType()
    {
        return 'model';
    }

    public function getDestinationOptions()
    {
        return array(
            'required' => false,
            'label' => 'region.destination_id',
            'class' => 'Cungfoo\Model\Destination',
        );
    }

    public function getMeaHomeType()
    {
        return 'checkbox';
    }

    public function getMeaHomeOptions()
    {
        return array(
            'required' => false,
            'label' => 'region.mea_home',
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
            'label' => 'region.created_at',
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
            'label' => 'region.updated_at',
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
            'label' => 'region.active',
        );
    }

    public function getImagePathType()
    {
        return 'cungfoo_file';
    }

    public function getImagePathOptions()
    {
        return array(
            'required' => false,
            'label' => 'region.image_path',
        );
    }

    public function getImageEncartPathType()
    {
        return 'cungfoo_file';
    }

    public function getImageEncartPathOptions()
    {
        return array(
            'required' => false,
            'label' => 'region.image_encart_path',
        );
    }

    public function getImageEncartPetitePathType()
    {
        return 'cungfoo_file';
    }

    public function getImageEncartPetitePathOptions()
    {
        return array(
            'required' => false,
            'label' => 'region.image_encart_petite_path',
        );
    }

    public function getImageDetail1Type()
    {
        return 'cungfoo_file';
    }

    public function getImageDetail1Options()
    {
        return array(
            'required' => false,
            'label' => 'region.image_detail_1',
        );
    }

    public function getImageDetail2Type()
    {
        return 'cungfoo_file';
    }

    public function getImageDetail2Options()
    {
        return array(
            'required' => false,
            'label' => 'region.image_detail_2',
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
            'label' => 'region_point_interet.point_interet_id',
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
            'label' => 'region_event.event_id',
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
            'label' => 'bon_plan_region.bon_plan_id',
            'class' => 'Cungfoo\Model\BonPlan',
            'multiple' => true,
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
            'label' => 'region_i18n.slug',
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
            'label' => 'region_i18n.name',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
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
            'label' => 'region_i18n.introduction',
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
            'label' => 'region_i18n.description',
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
            'label' => 'region_i18n.seo_title',
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
            'label' => 'region_i18n.seo_description',
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
            'label' => 'region_i18n.seo_h1',
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
            'label' => 'region_i18n.seo_keywords',
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
            'label' => 'region_i18n.active_locale',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', $this->getIdType(), $this->getIdOptions());
        $builder->add('code', $this->getCodeType(), $this->getCodeOptions());
        $builder->add('pays', $this->getPaysType(), $this->getPaysOptions());
        $builder->add('destination', $this->getDestinationType(), $this->getDestinationOptions());
        $builder->add('mea_home', $this->getMeaHomeType(), $this->getMeaHomeOptions());
        $builder->add('created_at', $this->getCreatedAtType(), $this->getCreatedAtOptions());
        $builder->add('updated_at', $this->getUpdatedAtType(), $this->getUpdatedAtOptions());
        $builder->add('active', $this->getActiveType(), $this->getActiveOptions());
        $builder->add('image_path', $this->getImagePathType(), $this->getImagePathOptions());
        $builder->add('image_encart_path', $this->getImageEncartPathType(), $this->getImageEncartPathOptions());
        $builder->add('image_encart_petite_path', $this->getImageEncartPetitePathType(), $this->getImageEncartPetitePathOptions());
        $builder->add('image_detail_1', $this->getImageDetail1Type(), $this->getImageDetail1Options());
        $builder->add('image_detail_2', $this->getImageDetail2Type(), $this->getImageDetail2Options());
        $builder->add('point_interets', $this->getPointInteretsType(), $this->getPointInteretsOptions());
        $builder->add('events', $this->getEventsType(), $this->getEventsOptions());
        $builder->add('bon_plans', $this->getBonPlansType(), $this->getBonPlansOptions());$builder->add('regionI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\RegionI18n',
            'label' => 'regionI18ns',
            'required' => false,
            'languages' => array('fr', 'de', 'nl'),
            'columns' => array(
                'slug' => array_merge(array('type' => $this->getSlugType()), $this->getSlugOptions()),
                'name' => array_merge(array('type' => $this->getNameType()), $this->getNameOptions()),
                'introduction' => array_merge(array('type' => $this->getIntroductionType()), $this->getIntroductionOptions()),
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
            'data_class' => 'Cungfoo\Model\Region',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Region';
    }

} // BaseRegionType
