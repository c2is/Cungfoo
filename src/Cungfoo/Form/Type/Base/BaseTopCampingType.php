<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'top_camping' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseTopCampingType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'top_camping.id',
            'required' => false,
        ));
        $builder->add('etablissement', 'model', array(
            'class' => '\Cungfoo\Model\Etablissement',
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'top_camping.etablissement',
            'required' => false,
        ));
        $builder->add('sortable_rank', 'integer', array(
            'constraints' => array(
            ),
            'label' => 'top_camping.sortable_rank',
            'required' => false,
        ));
        $builder->add('active', 'checkbox', array(
            'constraints' => array(
            ),
            'label' => 'top_camping.active',
            'required' => false,
        ));
        $builder->add('top_campingI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\TopCampingI18n',
            'languages' => array(
                0 => 'fr',
                1 => 'de',
            ),
            'label' => 'top_camping.top_campingI18ns',
            'columns' => array(
                'seo_title' => array(
                    'required' => false,
                    'label' => 'top_camping.seo_title',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'seo_description' => array(
                    'required' => false,
                    'label' => 'top_camping.seo_description',
                    'type' => 'textarea',
                    'constraints' => array(
                    ),
                ),
                'seo_h1' => array(
                    'required' => false,
                    'label' => 'top_camping.seo_h1',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'seo_keywords' => array(
                    'required' => false,
                    'label' => 'top_camping.seo_keywords',
                    'type' => 'textarea',
                    'constraints' => array(
                    ),
                ),
                'active_locale' => array(
                    'required' => false,
                    'label' => 'top_camping.active_locale',
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
            'data_class' => 'Cungfoo\Model\TopCamping',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'TopCamping';
    }

} // BaseTopCampingType
