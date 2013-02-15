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
        return 'integer';
    }

    public function getIdOptions()
    {
        return array(
            'required' => false,
            'label' => 'vos_vacances.id',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
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

    public function getImagePathDeletedType()
    {
        return 'checkbox';
    }

    public function getImagePathDeletedOptions()
    {
        return array(
            'property_path' => false,
            'required' => false,
            'label' => 'vos_vacances.image_path_deleted',
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
        $builder->add('image_path', $this->getImagePathType(), $this->getImagePathOptions());
        $builder->add('image_path_deleted', $this->getImagePathDeletedType(), $this->getImagePathDeletedOptions());
        $builder->add('active', $this->getActiveType(), $this->getActiveOptions());$builder->add('vos_vacancesI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\VosVacancesI18n',
            'label' => 'vos_vacancesI18ns',
            'required' => false,
            'languages' => array('fr', 'de'),
            'columns' => array(
                'titre' => array_merge(array('type' => $this->getTitreType()), $this->getTitreOptions()),
                'description' => array_merge(array('type' => $this->getDescriptionType()), $this->getDescriptionOptions()),
                'prenom' => array_merge(array('type' => $this->getPrenomType()), $this->getPrenomOptions()),
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
