<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'mise_en_avant' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseMiseEnAvantType extends AppAwareType
{
    public function getIdType()
    {
        return 'integer';
    }

    public function getIdOptions()
    {
        return array(
            'required' => false,
            'label' => 'mise_en_avant.id',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
        );
    }

    public function getImageFondPathType()
    {
        return 'cungfoo_file';
    }

    public function getImageFondPathOptions()
    {
        return array(
            'required' => false,
            'label' => 'mise_en_avant.image_fond_path',
        );
    }

    public function getImageFondPathDeletedType()
    {
        return 'checkbox';
    }

    public function getImageFondPathDeletedOptions()
    {
        return array(
            'property_path' => false,
            'required' => false,
            'label' => 'mise_en_avant.image_fond_path_deleted',
        );
    }

    public function getPrixType()
    {
        return 'text';
    }

    public function getPrixOptions()
    {
        return array(
            'required' => false,
            'label' => 'mise_en_avant.prix',
        );
    }

    public function getIllustrationPathType()
    {
        return 'cungfoo_file';
    }

    public function getIllustrationPathOptions()
    {
        return array(
            'required' => false,
            'label' => 'mise_en_avant.illustration_path',
        );
    }

    public function getIllustrationPathDeletedType()
    {
        return 'checkbox';
    }

    public function getIllustrationPathDeletedOptions()
    {
        return array(
            'property_path' => false,
            'required' => false,
            'label' => 'mise_en_avant.illustration_path_deleted',
        );
    }

    public function getDateFinValiditeType()
    {
        return 'date';
    }

    public function getDateFinValiditeOptions()
    {
        return array(
            'required' => false,
            'label' => 'mise_en_avant.date_fin_validite',
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
            'label' => 'mise_en_avant.sortable_rank',
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
            'label' => 'mise_en_avant.active',
        );
    }

    public function getTitreType()
    {
        return 'text';
    }

    public function getTitreOptions()
    {
        return array(
            'required' => false,
            'label' => 'mise_en_avant_i18n.titre',
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
            'label' => 'mise_en_avant_i18n.accroche',
        );
    }

    public function getLienType()
    {
        return 'text';
    }

    public function getLienOptions()
    {
        return array(
            'required' => false,
            'label' => 'mise_en_avant_i18n.lien',
        );
    }

    public function getTitreLienType()
    {
        return 'text';
    }

    public function getTitreLienOptions()
    {
        return array(
            'required' => false,
            'label' => 'mise_en_avant_i18n.titre_lien',
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
            'label' => 'mise_en_avant_i18n.seo_title',
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
            'label' => 'mise_en_avant_i18n.seo_description',
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
            'label' => 'mise_en_avant_i18n.seo_h1',
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
            'label' => 'mise_en_avant_i18n.seo_keywords',
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
            'label' => 'mise_en_avant_i18n.active_locale',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', $this->getIdType(), $this->getIdOptions());
        $builder->add('image_fond_path', $this->getImageFondPathType(), $this->getImageFondPathOptions());
        $builder->add('image_fond_path_deleted', $this->getImageFondPathDeletedType(), $this->getImageFondPathDeletedOptions());
        $builder->add('prix', $this->getPrixType(), $this->getPrixOptions());
        $builder->add('illustration_path', $this->getIllustrationPathType(), $this->getIllustrationPathOptions());
        $builder->add('illustration_path_deleted', $this->getIllustrationPathDeletedType(), $this->getIllustrationPathDeletedOptions());
        $builder->add('date_fin_validite', $this->getDateFinValiditeType(), $this->getDateFinValiditeOptions());
        $builder->add('sortable_rank', $this->getSortableRankType(), $this->getSortableRankOptions());
        $builder->add('active', $this->getActiveType(), $this->getActiveOptions());$builder->add('mise_en_avantI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\MiseEnAvantI18n',
            'label' => 'mise_en_avantI18ns',
            'required' => false,
            'languages' => array('fr', 'de'),
            'columns' => array(
                'titre' => array_merge(array('type' => $this->getTitreType()), $this->getTitreOptions()),
                'accroche' => array_merge(array('type' => $this->getAccrocheType()), $this->getAccrocheOptions()),
                'lien' => array_merge(array('type' => $this->getLienType()), $this->getLienOptions()),
                'titre_lien' => array_merge(array('type' => $this->getTitreLienType()), $this->getTitreLienOptions()),
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
            'data_class' => 'Cungfoo\Model\MiseEnAvant',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'MiseEnAvant';
    }

} // BaseMiseEnAvantType
