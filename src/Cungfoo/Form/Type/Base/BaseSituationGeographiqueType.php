<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'situation_geographique' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseSituationGeographiqueType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'situation_geographique.id',
            'required' => false,
        ));
        $builder->add('code', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'situation_geographique.code',
            'required' => false,
        ));
        $builder->add('active', 'checkbox', array(
            'constraints' => array(
            ),
            'label' => 'situation_geographique.active',
            'required' => false,
        ));
        $builder->add('etablissements', 'model', array(
            'class' => 'Cungfoo\Model\Etablissement',
            'constraints' => array(
            ),
            'multiple' => true,
            'label' => 'situation_geographique.etablissements',
            'required' => false,
        ));
        $builder->add('situation_geographiqueI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\SituationGeographiqueI18n',
            'languages' => array(
                0 => 'fr',
                1 => 'de',
            ),
            'label' => 'situation_geographique.situation_geographiqueI18ns',
            'columns' => array(
                'name' => array(
                    'required' => false,
                    'label' => 'situation_geographique.name',
                    'type' => 'text',
                    'constraints' => array(
                        new Assert\NotBlank(),
                    ),
                ),
                'description' => array(
                    'required' => false,
                    'label' => 'situation_geographique.description',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'keywords' => array(
                    'required' => false,
                    'label' => 'situation_geographique.keywords',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'seo_title' => array(
                    'required' => false,
                    'label' => 'situation_geographique.seo_title',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'seo_description' => array(
                    'required' => false,
                    'label' => 'situation_geographique.seo_description',
                    'type' => 'textarea',
                    'constraints' => array(
                    ),
                ),
                'seo_h1' => array(
                    'required' => false,
                    'label' => 'situation_geographique.seo_h1',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'seo_keywords' => array(
                    'required' => false,
                    'label' => 'situation_geographique.seo_keywords',
                    'type' => 'textarea',
                    'constraints' => array(
                    ),
                ),
                'active_locale' => array(
                    'required' => false,
                    'label' => 'situation_geographique.active_locale',
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
            'data_class' => 'Cungfoo\Model\SituationGeographique',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'SituationGeographique';
    }

} // BaseSituationGeographiqueType
