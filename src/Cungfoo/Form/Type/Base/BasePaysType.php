<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'pays' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BasePaysType extends AppAwareType
{
    public function getIdType()
    {
        return 'integer';
    }

    public function getIdOptions()
    {
        return array(
            'required' => false,
            'label' => 'pays.id',
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
            'label' => 'pays.code',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
        );
    }

    public function getImageDetail1Type()
    {
        return 'cungfoo_file';
    }

    public function getImageDetail1Options()
    {
        return array(
            'required' => false,
            'label' => 'pays.image_detail_1',
        );
    }

    public function getImageDetail1DeletedType()
    {
        return 'checkbox';
    }

    public function getImageDetail1DeletedOptions()
    {
        return array(
            'property_path' => false,
            'required' => false,
            'label' => 'pays.image_detail_1_deleted',
        );
    }

    public function getImageDetail2Type()
    {
        return 'cungfoo_file';
    }

    public function getImageDetail2Options()
    {
        return array(
            'required' => false,
            'label' => 'pays.image_detail_2',
        );
    }

    public function getImageDetail2DeletedType()
    {
        return 'checkbox';
    }

    public function getImageDetail2DeletedOptions()
    {
        return array(
            'property_path' => false,
            'required' => false,
            'label' => 'pays.image_detail_2_deleted',
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
            'label' => 'pays.created_at',
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
            'label' => 'pays.updated_at',
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
            'label' => 'pays.active',
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
            'label' => 'pays_i18n.slug',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
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
            'label' => 'pays_i18n.name',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
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
            'label' => 'pays_i18n.introduction',
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
            'label' => 'pays_i18n.description',
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
            'label' => 'pays_i18n.active_locale',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', $this->getIdType(), $this->getIdOptions());
        $builder->add('code', $this->getCodeType(), $this->getCodeOptions());
        $builder->add('image_detail_1', $this->getImageDetail1Type(), $this->getImageDetail1Options());
        $builder->add('image_detail_1_deleted', $this->getImageDetail1DeletedType(), $this->getImageDetail1DeletedOptions());
        $builder->add('image_detail_2', $this->getImageDetail2Type(), $this->getImageDetail2Options());
        $builder->add('image_detail_2_deleted', $this->getImageDetail2DeletedType(), $this->getImageDetail2DeletedOptions());
        $builder->add('created_at', $this->getCreatedAtType(), $this->getCreatedAtOptions());
        $builder->add('updated_at', $this->getUpdatedAtType(), $this->getUpdatedAtOptions());
        $builder->add('active', $this->getActiveType(), $this->getActiveOptions());$builder->add('paysI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\PaysI18n',
            'label' => 'paysI18ns',
            'required' => false,
            'languages' => array('fr', 'de'),
            'columns' => array(
                'slug' => array_merge(array('type' => $this->getSlugType()), $this->getSlugOptions()),
                'name' => array_merge(array('type' => $this->getNameType()), $this->getNameOptions()),
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
            'data_class' => 'Cungfoo\Model\Pays',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Pays';
    }

} // BasePaysType
