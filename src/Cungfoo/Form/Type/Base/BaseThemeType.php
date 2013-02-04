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
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'theme.id',
            'required' => false,
        ));
        $builder->add('image_path', 'cungfoo_file', array(
            'constraints' => array(
            ),
            'label' => 'theme.image_path',
            'required' => false,
        ));
        $builder->add('image_path_deleted', 'checkbox', array(
            'constraints' => array(
            ),
            'property_path' => false,
            'label' => 'theme.image_path_deleted',
            'required' => false,
        ));
        $builder->add('active', 'checkbox', array(
            'constraints' => array(
            ),
            'label' => 'theme.active',
            'required' => false,
        ));
        $builder->add('activites', 'model', array(
            'class' => 'Cungfoo\Model\Activite',
            'constraints' => array(
            ),
            'multiple' => true,
            'label' => 'theme.activites',
            'required' => false,
        ));
        $builder->add('baignades', 'model', array(
            'class' => 'Cungfoo\Model\Baignade',
            'constraints' => array(
            ),
            'multiple' => true,
            'label' => 'theme.baignades',
            'required' => false,
        ));
        $builder->add('service_complementaires', 'model', array(
            'class' => 'Cungfoo\Model\ServiceComplementaire',
            'constraints' => array(
            ),
            'multiple' => true,
            'label' => 'theme.service_complementaires',
            'required' => false,
        ));
        $builder->add('personnages', 'model', array(
            'class' => 'Cungfoo\Model\Personnage',
            'constraints' => array(
            ),
            'multiple' => true,
            'label' => 'theme.personnages',
            'required' => false,
        ));
        $builder->add('themeI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\ThemeI18n',
            'languages' => array(
                0 => 'fr',
                1 => 'de',
            ),
            'label' => 'theme.themeI18ns',
            'columns' => array(
                'name' => array(
                    'required' => false,
                    'label' => 'theme.name',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'slug' => array(
                    'required' => false,
                    'label' => 'theme.slug',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'introduction' => array(
                    'required' => false,
                    'label' => 'theme.introduction',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'description' => array(
                    'required' => false,
                    'label' => 'theme.description',
                    'type' => 'textarea',
                    'constraints' => array(
                    ),
                ),
                'active_locale' => array(
                    'required' => false,
                    'label' => 'theme.active_locale',
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
