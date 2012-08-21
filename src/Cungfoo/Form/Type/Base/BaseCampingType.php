<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'camping' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseCampingType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'camping.id',
            'required' => false,
        ));
        $builder->add('adress', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'camping.adress',
            'required' => false,
        ));
        $builder->add('phone', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'camping.phone',
            'required' => false,
        ));
        $builder->add('site', 'model', array(
            'class' => '\Cungfoo\Model\Site',
            'constraints' => array(
            ),
            'label' => 'camping.site',
            'required' => false,
        ));
        $builder->add('saison', 'model', array(
            'class' => '\Cungfoo\Model\Saison',
            'constraints' => array(
            ),
            'label' => 'camping.saison',
            'required' => false,
        ));
        $builder->add('campingI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\CampingI18n',
            'languages' => array(
                0 => 'fr',
                1 => 'en',
            ),
            'label' => 'camping.campingI18ns',
            'columns' => array(
                'name' => array(
                    'required' => false,
                    'label' => 'camping.name',
                    'type' => 'text',
                    'constraints' => array(
                        new Assert\NotBlank(),
                    ),
                ),
                'description' => array(
                    'required' => false,
                    'label' => 'camping.description',
                    'type' => 'text',
                    'constraints' => array(
                        new Assert\NotBlank(),
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
            'data_class' => 'Cungfoo\Model\Camping',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Camping';
    }

} // BaseCampingType
