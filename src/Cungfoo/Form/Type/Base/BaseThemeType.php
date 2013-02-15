<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'theme' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseThemeType extends AppAwareType
{
    public function getIdType()
    {
        return 'integer';
    }

    public function getIdOptions()
    {
        return array(
            'required' => false,
            'label' => 'theme.id',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
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
            'label' => 'theme.image_path',
        );
    }

    public function getImagePathDeletedType()
    {
        return 'checkbox';
    }

    public function getImagePathDeletedOptions()
    {
        return array(
            'property_path' => false,
            'required' => false,
            'label' => 'theme.image_path_deleted',
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
            'label' => 'theme.active',
        );
    }

    public function getActivitesType()
    {
        return 'model';
    }

    public function getActivitesOptions()
    {
        return array(
            'required' => false,
            'label' => 'theme_activite.activite_id',
            'class' => 'Cungfoo\Model\Activite',
            'multiple' => true,
        );
    }

    public function getBaignadesType()
    {
        return 'model';
    }

    public function getBaignadesOptions()
    {
        return array(
            'required' => false,
            'label' => 'theme_baignade.baignade_id',
            'class' => 'Cungfoo\Model\Baignade',
            'multiple' => true,
        );
    }

    public function getServiceComplementairesType()
    {
        return 'model';
    }

    public function getServiceComplementairesOptions()
    {
        return array(
            'required' => false,
            'label' => 'theme_service_complementaire.service_complementaire_id',
            'class' => 'Cungfoo\Model\ServiceComplementaire',
            'multiple' => true,
        );
    }

    public function getPersonnagesType()
    {
        return 'model';
    }

    public function getPersonnagesOptions()
    {
        return array(
            'required' => false,
            'label' => 'theme_personnage.personnage_id',
            'class' => 'Cungfoo\Model\Personnage',
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
            'label' => 'theme_i18n.name',
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
            'label' => 'theme_i18n.slug',
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
            'label' => 'theme_i18n.introduction',
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
            'label' => 'theme_i18n.description',
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
            'label' => 'theme_i18n.active_locale',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', $this->getIdType(), $this->getIdOptions());
        $builder->add('image_path', $this->getImagePathType(), $this->getImagePathOptions());
        $builder->add('image_path_deleted', $this->getImagePathDeletedType(), $this->getImagePathDeletedOptions());
        $builder->add('active', $this->getActiveType(), $this->getActiveOptions());
        $builder->add('activites', $this->getActivitesType(), $this->getActivitesOptions());
        $builder->add('baignades', $this->getBaignadesType(), $this->getBaignadesOptions());
        $builder->add('service_complementaires', $this->getServiceComplementairesType(), $this->getServiceComplementairesOptions());
        $builder->add('personnages', $this->getPersonnagesType(), $this->getPersonnagesOptions());$builder->add('themeI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\ThemeI18n',
            'label' => 'themeI18ns',
            'required' => false,
            'languages' => array('fr', 'de'),
            'columns' => array(
                'name' => array_merge(array('type' => $this->getNameType()), $this->getNameOptions()),
                'slug' => array_merge(array('type' => $this->getSlugType()), $this->getSlugOptions()),
                'introduction' => array_merge(array('type' => $this->getIntroductionType()), $this->getIntroductionOptions()),
                'description' => array_merge(array('type' => $this->getDescriptionType()), $this->getDescriptionOptions()),
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
            'data_class' => 'Cungfoo\Model\Theme',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Theme';
    }

} // BaseThemeType
