<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'portfolio_media' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BasePortfolioMediaType extends AppAwareType
{
    public function getIdType()
    {
        return 'hidden';
    }

    public function getIdOptions()
    {
        return array(
            'required' => false,
            'label' => 'portfolio_media.id',
        );
    }

    public function getFileType()
    {
        return 'text';
    }

    public function getFileOptions()
    {
        return array(
            'required' => false,
            'label' => 'portfolio_media.file',
        );
    }

    public function getWidthType()
    {
        return 'text';
    }

    public function getWidthOptions()
    {
        return array(
            'required' => false,
            'label' => 'portfolio_media.width',
        );
    }

    public function getHeightType()
    {
        return 'text';
    }

    public function getHeightOptions()
    {
        return array(
            'required' => false,
            'label' => 'portfolio_media.height',
        );
    }

    public function getSizeType()
    {
        return 'text';
    }

    public function getSizeOptions()
    {
        return array(
            'required' => false,
            'label' => 'portfolio_media.size',
        );
    }

    public function getTypeType()
    {
        return 'text';
    }

    public function getTypeOptions()
    {
        return array(
            'required' => false,
            'label' => 'portfolio_media.type',
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
            'label' => 'portfolio_media.created_at',
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
            'label' => 'portfolio_media.updated_at',
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
            'label' => 'portfolio_media.active',
        );
    }

    public function getPortfolioTagsType()
    {
        return 'model';
    }

    public function getPortfolioTagsOptions()
    {
        return array(
            'required' => false,
            'label' => 'portfolio_media_tag.tag_id',
            'class' => 'Cungfoo\Model\PortfolioTag',
            'multiple' => true,
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
            'label' => 'portfolio_media_i18n.title',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
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
            'label' => 'portfolio_media_i18n.description',
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
            'label' => 'portfolio_media_i18n.seo_title',
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
            'label' => 'portfolio_media_i18n.seo_description',
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
            'label' => 'portfolio_media_i18n.seo_h1',
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
            'label' => 'portfolio_media_i18n.seo_keywords',
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
            'label' => 'portfolio_media_i18n.active_locale',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', $this->getIdType(), $this->getIdOptions());
        $builder->add('file', $this->getFileType(), $this->getFileOptions());
        $builder->add('width', $this->getWidthType(), $this->getWidthOptions());
        $builder->add('height', $this->getHeightType(), $this->getHeightOptions());
        $builder->add('size', $this->getSizeType(), $this->getSizeOptions());
        $builder->add('type', $this->getTypeType(), $this->getTypeOptions());
        $builder->add('created_at', $this->getCreatedAtType(), $this->getCreatedAtOptions());
        $builder->add('updated_at', $this->getUpdatedAtType(), $this->getUpdatedAtOptions());
        $builder->add('active', $this->getActiveType(), $this->getActiveOptions());
        $builder->add('portfolio_tags', $this->getPortfolioTagsType(), $this->getPortfolioTagsOptions());
        $builder->add('portfolio_mediaI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\PortfolioMediaI18n',
            'label' => 'portfolio_mediaI18ns',
            'required' => false,
            'languages' => array('fr', 'de'),
            'columns' => array(
                'title' => array_merge(array('type' => $this->getTitleType()), $this->getTitleOptions()),
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
            'data_class' => 'Cungfoo\Model\PortfolioMedia',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'PortfolioMedia';
    }

} // BasePortfolioMediaType
