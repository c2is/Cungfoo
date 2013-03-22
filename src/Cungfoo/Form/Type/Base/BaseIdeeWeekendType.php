<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'idee_weekend' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseIdeeWeekendType extends AppAwareType
{
    public function getIdType()
    {
        return 'hidden';
    }

    public function getIdOptions()
    {
        return array(
            'required' => false,
            'label' => 'idee_weekend.id',
        );
    }

    public function getHighlightType()
    {
        return 'checkbox';
    }

    public function getHighlightOptions()
    {
        return array(
            'required' => false,
            'label' => 'idee_weekend.highlight',
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
            'label' => 'idee_weekend.prix',
        );
    }

    public function getHomeType()
    {
        return 'checkbox';
    }

    public function getHomeOptions()
    {
        return array(
            'required' => false,
            'label' => 'idee_weekend.home',
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
            'label' => 'idee_weekend.active',
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
            'label' => 'idee_weekend.image_path',
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
            'label' => 'idee_weekend_i18n.titre',
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
            'label' => 'idee_weekend_i18n.lien',
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
            'label' => 'idee_weekend_i18n.seo_title',
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
            'label' => 'idee_weekend_i18n.seo_description',
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
            'label' => 'idee_weekend_i18n.seo_h1',
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
            'label' => 'idee_weekend_i18n.seo_keywords',
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
            'label' => 'idee_weekend_i18n.active_locale',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', $this->getIdType(), $this->getIdOptions());
        $builder->add('highlight', $this->getHighlightType(), $this->getHighlightOptions());
        $builder->add('prix', $this->getPrixType(), $this->getPrixOptions());
        $builder->add('home', $this->getHomeType(), $this->getHomeOptions());
        $builder->add('active', $this->getActiveType(), $this->getActiveOptions());
        $builder->add('image_path', $this->getImagePathType(), $this->getImagePathOptions());$builder->add('idee_weekendI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\IdeeWeekendI18n',
            'label' => 'idee_weekendI18ns',
            'required' => false,
            'languages' => array('fr', 'de'),
            'columns' => array(
                'titre' => array_merge(array('type' => $this->getTitreType()), $this->getTitreOptions()),
                'lien' => array_merge(array('type' => $this->getLienType()), $this->getLienOptions()),
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
            'data_class' => 'Cungfoo\Model\IdeeWeekend',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'IdeeWeekend';
    }

} // BaseIdeeWeekendType
