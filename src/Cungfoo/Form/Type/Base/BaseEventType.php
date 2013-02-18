<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'event' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseEventType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'event.id',
            'required' => false,
        ));
        $builder->add('code', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'event.code',
            'required' => false,
        ));
        $builder->add('category', 'text', array(
            'constraints' => array(
            ),
            'label' => 'event.category',
            'required' => false,
        ));
        $builder->add('address', 'text', array(
            'constraints' => array(
            ),
            'label' => 'event.address',
            'required' => false,
        ));
        $builder->add('address2', 'text', array(
            'constraints' => array(
            ),
            'label' => 'event.address2',
            'required' => false,
        ));
        $builder->add('zipcode', 'text', array(
            'constraints' => array(
            ),
            'label' => 'event.zipcode',
            'required' => false,
        ));
        $builder->add('city', 'text', array(
            'constraints' => array(
            ),
            'label' => 'event.city',
            'required' => false,
        ));
        $builder->add('geo_coordinate_x', 'text', array(
            'constraints' => array(
            ),
            'label' => 'event.geo_coordinate_x',
            'required' => false,
        ));
        $builder->add('geo_coordinate_y', 'text', array(
            'constraints' => array(
            ),
            'label' => 'event.geo_coordinate_y',
            'required' => false,
        ));
        $builder->add('distance_camping', 'text', array(
            'constraints' => array(
            ),
            'label' => 'event.distance_camping',
            'required' => false,
        ));
        $builder->add('image', 'text', array(
            'constraints' => array(
            ),
            'label' => 'event.image',
            'required' => false,
        ));
        $builder->add('priority', 'text', array(
            'constraints' => array(
            ),
            'label' => 'event.priority',
            'required' => false,
        ));
        $builder->add('tel', 'text', array(
            'constraints' => array(
            ),
            'label' => 'event.tel',
            'required' => false,
        ));
        $builder->add('fax', 'text', array(
            'constraints' => array(
            ),
            'label' => 'event.fax',
            'required' => false,
        ));
        $builder->add('email', 'text', array(
            'constraints' => array(
            ),
            'label' => 'event.email',
            'required' => false,
        ));
        $builder->add('website', 'text', array(
            'constraints' => array(
            ),
            'label' => 'event.website',
            'required' => false,
        ));
        $builder->add('active', 'checkbox', array(
            'constraints' => array(
            ),
            'label' => 'event.active',
            'required' => false,
        ));
        $builder->add('etablissements', 'model', array(
            'class' => 'Cungfoo\Model\Etablissement',
            'constraints' => array(
            ),
            'multiple' => true,
            'label' => 'event.etablissements',
            'required' => false,
        ));
        $builder->add('regions', 'model', array(
            'class' => 'Cungfoo\Model\Region',
            'constraints' => array(
            ),
            'multiple' => true,
            'label' => 'event.regions',
            'required' => false,
        ));
        $builder->add('eventI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\EventI18n',
            'languages' => array(
                0 => 'fr',
                1 => 'de',
            ),
            'label' => 'event.eventI18ns',
            'columns' => array(
                'name' => array(
                    'required' => false,
                    'label' => 'event.name',
                    'type' => 'text',
                    'constraints' => array(
                        new Assert\NotBlank(),
                    ),
                ),
                'str_date' => array(
                    'required' => false,
                    'label' => 'event.str_date',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'subtitle' => array(
                    'required' => false,
                    'label' => 'event.subtitle',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'description' => array(
                    'required' => false,
                    'label' => 'event.description',
                    'type' => 'textarea',
                    'constraints' => array(
                    ),
                ),
                'transport' => array(
                    'required' => false,
                    'label' => 'event.transport',
                    'type' => 'textarea',
                    'constraints' => array(
                    ),
                ),
                'slug' => array(
                    'required' => false,
                    'label' => 'event.slug',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'seo_title' => array(
                    'required' => false,
                    'label' => 'event.seo_title',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'seo_description' => array(
                    'required' => false,
                    'label' => 'event.seo_description',
                    'type' => 'textarea',
                    'constraints' => array(
                    ),
                ),
                'seo_h1' => array(
                    'required' => false,
                    'label' => 'event.seo_h1',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'seo_keywords' => array(
                    'required' => false,
                    'label' => 'event.seo_keywords',
                    'type' => 'textarea',
                    'constraints' => array(
                    ),
                ),
                'active_locale' => array(
                    'required' => false,
                    'label' => 'event.active_locale',
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
            'data_class' => 'Cungfoo\Model\Event',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Event';
    }

} // BaseEventType
