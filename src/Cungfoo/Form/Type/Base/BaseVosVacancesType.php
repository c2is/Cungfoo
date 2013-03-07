<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'vos_vacances' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseVosVacancesType extends AppAwareType
{
    public function getIdType()
    {
        return 'hidden';
    }

    public function getIdOptions()
    {
        return array(
            'required' => false,
            'label' => 'vos_vacances.id',
        );
    }

    public function getAgeType()
    {
        return 'text';
    }

    public function getAgeOptions()
    {
        return array(
            'required' => false,
            'label' => 'vos_vacances.age',
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
            'label' => 'vos_vacances.active',
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
            'label' => 'vos_vacances.image_path',
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
            'label' => 'vos_vacances_i18n.titre',
        );
    }

    public function getDescriptionType()
    {
        return 'text';
    }

    public function getDescriptionOptions()
    {
        return array(
            'required' => false,
            'label' => 'vos_vacances_i18n.description',
        );
    }

    public function getPrenomType()
    {
        return 'text';
    }

    public function getPrenomOptions()
    {
        return array(
            'required' => false,
            'label' => 'vos_vacances_i18n.prenom',
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
            'label' => 'vos_vacances_i18n.seo_title',
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
            'label' => 'vos_vacances_i18n.seo_description',
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
            'label' => 'vos_vacances_i18n.seo_h1',
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
            'label' => 'vos_vacances_i18n.seo_keywords',
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
            'label' => 'vos_vacances_i18n.active_locale',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', $this->getIdType(), $this->getIdOptions());
        $builder->add('age', $this->getAgeType(), $this->getAgeOptions());
        $builder->add('active', $this->getActiveType(), $this->getActiveOptions());
        $builder->add('image_path', $this->getImagePathType(), $this->getImagePathOptions());$builder->add('vos_vacancesI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\VosVacancesI18n',
            'label' => 'vos_vacancesI18ns',
            'required' => false,
            'languages' => array('fr', 'de'),
            'columns' => array(
                'titre' => array_merge(array('type' => $this->getTitreType()), $this->getTitreOptions()),
                'description' => array_merge(array('type' => $this->getDescriptionType()), $this->getDescriptionOptions()),
                'prenom' => array_merge(array('type' => $this->getPrenomType()), $this->getPrenomOptions()),
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
            'data_class' => 'Cungfoo\Model\VosVacances',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'VosVacances';
    }

} // BaseVosVacancesType
