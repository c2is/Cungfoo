<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'seo' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseSeoType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'seo.id',
            'required' => false,
        ));
        $builder->add('table_ref', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'seo.table_ref',
            'required' => false,
        ));
        $builder->add('seoI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\SeoI18n',
            'languages' => array(
                0 => 'fr',
                1 => 'de',
            ),
            'label' => 'seo.seoI18ns',
            'columns' => array(
                'seo_title' => array(
                    'required' => false,
                    'label' => 'seo.seo_title',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'seo_description' => array(
                    'required' => false,
                    'label' => 'seo.seo_description',
                    'type' => 'textarea',
                    'constraints' => array(
                    ),
                ),
                'seo_h1' => array(
                    'required' => false,
                    'label' => 'seo.seo_h1',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'seo_keywords' => array(
                    'required' => false,
                    'label' => 'seo.seo_keywords',
                    'type' => 'textarea',
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
            'data_class' => 'Cungfoo\Model\Seo',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Seo';
    }

} // BaseSeoType
