<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'category_type_hebergement' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseCategoryTypeHebergementType extends AppAwareType
{
    public function getIdType()
    {
        return 'hidden';
    }

    public function getIdOptions()
    {
        return array(
            'required' => false,
            'label' => 'category_type_hebergement.id',
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
            'label' => 'category_type_hebergement.code',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
        );
    }

    public function getMinimumPriceType()
    {
        return 'text';
    }

    public function getMinimumPriceOptions()
    {
        return array(
            'required' => false,
            'label' => 'category_type_hebergement.minimum_price',
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
            'label' => 'category_type_hebergement.image_menu',
        );
    }

    public function getImageMenuDeletedType()
    {
        return 'checkbox';
    }

    public function getImageMenuDeletedOptions()
    {
        return array(
            'property_path' => false,
            'required' => false,
            'label' => 'category_type_hebergement.image_menu_deleted',
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
            'label' => 'category_type_hebergement.image_page',
        );
    }

    public function getImagePageDeletedType()
    {
        return 'checkbox';
    }

    public function getImagePageDeletedOptions()
    {
        return array(
            'property_path' => false,
            'required' => false,
            'label' => 'category_type_hebergement.image_page_deleted',
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
            'label' => 'category_type_hebergement.created_at',
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
            'label' => 'category_type_hebergement.updated_at',
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
            'label' => 'category_type_hebergement.sortable_rank',
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
            'label' => 'category_type_hebergement.active',
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
            'label' => 'category_type_hebergement_i18n.name',
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
            'label' => 'category_type_hebergement_i18n.slug',
        );
    }

    public function getAccrocheType()
    {
        return 'text';
    }

    public function getAccrocheOptions()
    {
        return array(
            'required' => false,
            'label' => 'category_type_hebergement_i18n.accroche',
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
            'label' => 'category_type_hebergement_i18n.description',
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
            'label' => 'category_type_hebergement_i18n.seo_title',
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
            'label' => 'category_type_hebergement_i18n.seo_description',
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
            'label' => 'category_type_hebergement_i18n.seo_h1',
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
            'label' => 'category_type_hebergement_i18n.seo_keywords',
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
            'label' => 'category_type_hebergement_i18n.active_locale',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', $this->getIdType(), $this->getIdOptions());
        $builder->add('code', $this->getCodeType(), $this->getCodeOptions());
        $builder->add('minimum_price', $this->getMinimumPriceType(), $this->getMinimumPriceOptions());
        $builder->add('image_menu', $this->getImageMenuType(), $this->getImageMenuOptions());
        $builder->add('image_menu_deleted', $this->getImageMenuDeletedType(), $this->getImageMenuDeletedOptions());
        $builder->add('image_page', $this->getImagePageType(), $this->getImagePageOptions());
        $builder->add('image_page_deleted', $this->getImagePageDeletedType(), $this->getImagePageDeletedOptions());
        $builder->add('created_at', $this->getCreatedAtType(), $this->getCreatedAtOptions());
        $builder->add('updated_at', $this->getUpdatedAtType(), $this->getUpdatedAtOptions());
        $builder->add('sortable_rank', $this->getSortableRankType(), $this->getSortableRankOptions());
        $builder->add('active', $this->getActiveType(), $this->getActiveOptions());$builder->add('category_type_hebergementI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\CategoryTypeHebergementI18n',
            'label' => 'category_type_hebergementI18ns',
            'required' => false,
            'languages' => array('fr', 'de'),
            'columns' => array(
                'name' => array_merge(array('type' => $this->getNameType()), $this->getNameOptions()),
                'slug' => array_merge(array('type' => $this->getSlugType()), $this->getSlugOptions()),
                'accroche' => array_merge(array('type' => $this->getAccrocheType()), $this->getAccrocheOptions()),
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
            'data_class' => 'Cungfoo\Model\CategoryTypeHebergement',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'CategoryTypeHebergement';
    }

} // BaseCategoryTypeHebergementType
