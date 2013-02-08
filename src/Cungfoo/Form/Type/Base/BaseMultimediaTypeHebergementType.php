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
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'multimedia_type_hebergement.id',
            'required' => false,
        ));
        $builder->add('type_hebergement_id', 'model', array(
            'class' => '\Cungfoo\Model\TypeHebergement',
            'constraints' => array(
            ),
            'label' => 'multimedia_type_hebergement.type_hebergement_id',
            'required' => false,
        ));
        $builder->add('image_path', 'cungfoo_file', array(
            'constraints' => array(
            ),
            'label' => 'multimedia_type_hebergement.image_path',
            'required' => false,
        ));
        $builder->add('image_path_deleted', 'checkbox', array(
            'constraints' => array(
            ),
            'property_path' => false,
            'label' => 'multimedia_type_hebergement.image_path_deleted',
            'required' => false,
        ));
        $builder->add('active', 'checkbox', array(
            'constraints' => array(
            ),
            'label' => 'multimedia_type_hebergement.active',
            'required' => false,
        ));
        $builder->add('multimedia_type_hebergementI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\MultimediaTypeHebergementI18n',
            'languages' => array(
                0 => 'fr',
                1 => 'de',
            ),
            'label' => 'multimedia_type_hebergement.multimedia_type_hebergementI18ns',
            'columns' => array(
                'titre' => array(
                    'required' => false,
                    'label' => 'multimedia_type_hebergement.titre',
                    'type' => 'text',
                    'constraints' => array(
                        new Assert\NotBlank(),
                    ),
                ),
                'active_locale' => array(
                    'required' => false,
                    'label' => 'multimedia_type_hebergement.active_locale',
                    'type' => 'checkbox',
                    'constraints' => array(
                    ),
                ),
            ),
            'required' => false,
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
