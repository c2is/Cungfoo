<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'metadata' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseMetadataType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'metadata.id',
            'required' => false,
        ));
        $builder->add('table_ref', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'metadata.table_ref',
            'required' => false,
        ));
        $builder->add('visuel', 'cungfoo_file', array(
            'constraints' => array(
            ),
            'label' => 'metadata.visuel',
            'required' => false,
        ));
        $builder->add('visuel_deleted', 'checkbox', array(
            'constraints' => array(
            ),
            'property_path' => false,
            'label' => 'metadata.visuel_deleted',
            'required' => false,
        ));
        $builder->add('metadataI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\MetadataI18n',
            'languages' => array(
                0 => 'fr',
                1 => 'de',
            ),
            'label' => 'metadata.metadataI18ns',
            'columns' => array(
                'title' => array(
                    'required' => false,
                    'label' => 'metadata.title',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'subtitle' => array(
                    'required' => false,
                    'label' => 'metadata.subtitle',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'accroche' => array(
                    'required' => false,
                    'label' => 'metadata.accroche',
                    'type' => 'text',
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
            'data_class' => 'Cungfoo\Model\Metadata',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Metadata';
    }

} // BaseMetadataType
