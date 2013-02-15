<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'multimedia_type_hebergement' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseMultimediaTypeHebergementType extends AppAwareType
{
    public function getIdType()
    {
        return 'integer';
    }

    public function getIdOptions()
    {
        return array(
            'required' => false,
            'label' => 'multimedia_type_hebergement.id',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
        );
    }

    public function getTypeHebergementType()
    {
        return 'model';
    }

    public function getTypeHebergementOptions()
    {
        return array(
            'required' => false,
            'label' => 'multimedia_type_hebergement.type_hebergement_id',
            'class' => 'Cungfoo\Model\TypeHebergement',
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
            'label' => 'multimedia_type_hebergement.image_path',
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
            'label' => 'multimedia_type_hebergement.image_path_deleted',
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
            'label' => 'multimedia_type_hebergement.created_at',
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
            'label' => 'multimedia_type_hebergement.updated_at',
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
            'label' => 'multimedia_type_hebergement.active',
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
            'label' => 'multimedia_type_hebergement_i18n.titre',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
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
            'label' => 'multimedia_type_hebergement_i18n.active_locale',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', $this->getIdType(), $this->getIdOptions());
        $builder->add('type_hebergement', $this->getTypeHebergementType(), $this->getTypeHebergementOptions());
        $builder->add('image_path', $this->getImagePathType(), $this->getImagePathOptions());
        $builder->add('image_path_deleted', $this->getImagePathDeletedType(), $this->getImagePathDeletedOptions());
        $builder->add('created_at', $this->getCreatedAtType(), $this->getCreatedAtOptions());
        $builder->add('updated_at', $this->getUpdatedAtType(), $this->getUpdatedAtOptions());
        $builder->add('active', $this->getActiveType(), $this->getActiveOptions());$builder->add('multimedia_type_hebergementI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\MultimediaTypeHebergementI18n',
            'label' => 'multimedia_type_hebergementI18ns',
            'required' => false,
            'languages' => array('fr', 'de'),
            'columns' => array(
                'titre' => array_merge(array('type' => $this->getTitreType()), $this->getTitreOptions()),
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
            'data_class' => 'Cungfoo\Model\MultimediaTypeHebergement',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'MultimediaTypeHebergement';
    }

} // BaseMultimediaTypeHebergementType
