<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'activite' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseActiviteType extends AppAwareType
{
    public function getIdType()
    {
        return 'integer';
    }

    public function getIdOptions()
    {
        return array(
            'required' => false,
            'label' => 'activite.id',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
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
            'label' => 'activite.code',
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
            'label' => 'activite.image_path',
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
            'label' => 'activite.image_path_deleted',
        );
    }

    public function getVignetteType()
    {
        return 'cungfoo_file';
    }

    public function getVignetteOptions()
    {
        return array(
            'required' => false,
            'label' => 'activite.vignette',
        );
    }

    public function getVignetteDeletedType()
    {
        return 'checkbox';
    }

    public function getVignetteDeletedOptions()
    {
        return array(
            'property_path' => false,
            'required' => false,
            'label' => 'activite.vignette_deleted',
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
            'label' => 'activite.created_at',
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
            'label' => 'activite.updated_at',
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
            'label' => 'activite.active',
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
            'label' => 'etablissement_activite.etablissement_id',
            'class' => 'Cungfoo\Model\Etablissement',
            'multiple' => true,
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
            'label' => 'theme_activite.theme_id',
            'class' => 'Cungfoo\Model\Theme',
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
            'label' => 'activite_i18n.name',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
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
            'label' => 'activite_i18n.description',
        );
    }

    public function getKeywordsType()
    {
        return 'text';
    }

    public function getKeywordsOptions()
    {
        return array(
            'required' => false,
            'label' => 'activite_i18n.keywords',
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
            'label' => 'activite_i18n.active_locale',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', $this->getIdType(), $this->getIdOptions());
        $builder->add('code', $this->getCodeType(), $this->getCodeOptions());
        $builder->add('image_path', $this->getImagePathType(), $this->getImagePathOptions());
        $builder->add('image_path_deleted', $this->getImagePathDeletedType(), $this->getImagePathDeletedOptions());
        $builder->add('vignette', $this->getVignetteType(), $this->getVignetteOptions());
        $builder->add('vignette_deleted', $this->getVignetteDeletedType(), $this->getVignetteDeletedOptions());
        $builder->add('created_at', $this->getCreatedAtType(), $this->getCreatedAtOptions());
        $builder->add('updated_at', $this->getUpdatedAtType(), $this->getUpdatedAtOptions());
        $builder->add('active', $this->getActiveType(), $this->getActiveOptions());
        $builder->add('etablissements', $this->getEtablissementsType(), $this->getEtablissementsOptions());
        $builder->add('themes', $this->getThemesType(), $this->getThemesOptions());$builder->add('activiteI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\ActiviteI18n',
            'label' => 'activiteI18ns',
            'required' => false,
            'languages' => array('fr', 'de'),
            'columns' => array(
                'name' => array_merge(array('type' => $this->getNameType()), $this->getNameOptions()),
                'description' => array_merge(array('type' => $this->getDescriptionType()), $this->getDescriptionOptions()),
                'keywords' => array_merge(array('type' => $this->getKeywordsType()), $this->getKeywordsOptions()),
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
            'data_class' => 'Cungfoo\Model\Activite',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Activite';
    }

} // BaseActiviteType
