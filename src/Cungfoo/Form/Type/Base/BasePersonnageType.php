<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'personnage' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BasePersonnageType extends AppAwareType
{
    public function getIdType()
    {
        return 'hidden';
    }

    public function getIdOptions()
    {
        return array(
            'required' => false,
            'label' => 'personnage.id',
        );
    }

    public function getEtablissementType()
    {
        return 'model';
    }

    public function getEtablissementOptions()
    {
        return array(
            'required' => false,
            'label' => 'personnage.etablissement_id',
            'class' => 'Cungfoo\Model\Etablissement',
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
            'label' => 'personnage.age',
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
            'label' => 'personnage.created_at',
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
            'label' => 'personnage.updated_at',
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
            'label' => 'personnage.active',
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
            'label' => 'personnage.image_path',
        );
    }

    public function getThemesType()
    {
        return 'model';
    }

    public function getThemesOptions()
    {
        return array(
            'required' => false,
            'label' => 'theme_personnage.theme_id',
            'class' => 'Cungfoo\Model\Theme',
            'multiple' => true,
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
            'label' => 'personnage_i18n.prenom',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
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
            'label' => 'personnage_i18n.seo_title',
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
            'label' => 'personnage_i18n.seo_description',
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
            'label' => 'personnage_i18n.seo_h1',
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
            'label' => 'personnage_i18n.seo_keywords',
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
            'label' => 'personnage_i18n.active_locale',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', $this->getIdType(), $this->getIdOptions());
        $builder->add('etablissement', $this->getEtablissementType(), $this->getEtablissementOptions());
        $builder->add('age', $this->getAgeType(), $this->getAgeOptions());
        $builder->add('created_at', $this->getCreatedAtType(), $this->getCreatedAtOptions());
        $builder->add('updated_at', $this->getUpdatedAtType(), $this->getUpdatedAtOptions());
        $builder->add('active', $this->getActiveType(), $this->getActiveOptions());
        $builder->add('image_path', $this->getImagePathType(), $this->getImagePathOptions());
        $builder->add('themes', $this->getThemesType(), $this->getThemesOptions());$builder->add('personnageI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\PersonnageI18n',
            'label' => 'personnageI18ns',
            'required' => false,
            'languages' => array('fr', 'de', 'nl'),
            'columns' => array(
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
            'data_class' => 'Cungfoo\Model\Personnage',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Personnage';
    }

} // BasePersonnageType
