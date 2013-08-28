<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'destination' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseDestinationType extends AppAwareType
{
    public function getIdType()
    {
        return 'hidden';
    }

    public function getIdOptions()
    {
        return array(
            'required' => false,
            'label' => 'destination.id',
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
            'label' => 'destination.code',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
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
            'label' => 'destination.created_at',
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
            'label' => 'destination.updated_at',
            'widget' => 'single_text',
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
            'label' => 'destination.sortable_rank',
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
            'label' => 'destination.active',
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
            'label' => 'destination.image_detail_1',
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
            'label' => 'destination.image_detail_2',
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
            'label' => 'etablissement_destination.etablissement_id',
            'class' => 'Cungfoo\Model\Etablissement',
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
            'label' => 'destination_i18n.slug',
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
            'label' => 'destination_i18n.name',
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
            'label' => 'destination_i18n.introduction',
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
            'label' => 'destination_i18n.description',
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
            'label' => 'destination_i18n.seo_title',
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
            'label' => 'destination_i18n.seo_description',
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
            'label' => 'destination_i18n.seo_h1',
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
            'label' => 'destination_i18n.seo_keywords',
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
            'label' => 'destination_i18n.active_locale',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', $this->getIdType(), $this->getIdOptions());
        $builder->add('code', $this->getCodeType(), $this->getCodeOptions());
        $builder->add('created_at', $this->getCreatedAtType(), $this->getCreatedAtOptions());
        $builder->add('updated_at', $this->getUpdatedAtType(), $this->getUpdatedAtOptions());
        $builder->add('sortable_rank', $this->getSortableRankType(), $this->getSortableRankOptions());
        $builder->add('active', $this->getActiveType(), $this->getActiveOptions());
        $builder->add('image_detail_1', $this->getImageDetail1Type(), $this->getImageDetail1Options());
        $builder->add('image_detail_2', $this->getImageDetail2Type(), $this->getImageDetail2Options());
        $builder->add('etablissements', $this->getEtablissementsType(), $this->getEtablissementsOptions());$builder->add('destinationI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\DestinationI18n',
            'label' => 'destinationI18ns',
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
            'data_class' => 'Cungfoo\Model\Destination',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Destination';
    }

} // BaseDestinationType
