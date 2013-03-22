<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'metadata' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseMetadataType extends AppAwareType
{
    public function getIdType()
    {
        return 'hidden';
    }

    public function getIdOptions()
    {
        return array(
            'required' => false,
            'label' => 'metadata.id',
        );
    }

    public function getTableRefType()
    {
        return 'text';
    }

    public function getTableRefOptions()
    {
        return array(
            'required' => false,
            'label' => 'metadata.table_ref',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
        );
    }

    public function getVisuelType()
    {
        return 'cungfoo_file';
    }

    public function getVisuelOptions()
    {
        return array(
            'required' => false,
            'label' => 'metadata.visuel',
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
            'label' => 'metadata_i18n.title',
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
            'label' => 'metadata_i18n.subtitle',
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
            'label' => 'metadata_i18n.accroche',
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
            'label' => 'metadata_i18n.seo_title',
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
            'label' => 'metadata_i18n.seo_description',
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
            'label' => 'metadata_i18n.seo_h1',
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
            'label' => 'metadata_i18n.seo_keywords',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', $this->getIdType(), $this->getIdOptions());
        $builder->add('table_ref', $this->getTableRefType(), $this->getTableRefOptions());
        $builder->add('visuel', $this->getVisuelType(), $this->getVisuelOptions());$builder->add('metadataI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\MetadataI18n',
            'label' => 'metadataI18ns',
            'required' => false,
            'languages' => array('fr', 'de'),
            'columns' => array(
                'title' => array_merge(array('type' => $this->getTitleType()), $this->getTitleOptions()),
                'subtitle' => array_merge(array('type' => $this->getSubtitleType()), $this->getSubtitleOptions()),
                'accroche' => array_merge(array('type' => $this->getAccrocheType()), $this->getAccrocheOptions()),
                'seo_title' => array_merge(array('type' => $this->getSeoTitleType()), $this->getSeoTitleOptions()),
                'seo_description' => array_merge(array('type' => $this->getSeoDescriptionType()), $this->getSeoDescriptionOptions()),
                'seo_h1' => array_merge(array('type' => $this->getSeoH1Type()), $this->getSeoH1Options()),
                'seo_keywords' => array_merge(array('type' => $this->getSeoKeywordsType()), $this->getSeoKeywordsOptions()),

            )
        ));


    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cungfoo\Model\Metadata',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Metadata';
    }

} // BaseMetadataType
