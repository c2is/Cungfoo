<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'ville' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseVilleType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'ville.id',
            'required' => false,
        ));
        $builder->add('region', 'model', array(
            'class' => '\Cungfoo\Model\Region',
            'constraints' => array(
            ),
            'label' => 'ville.region',
            'required' => false,
        ));
        $builder->add('villeI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\VilleI18n',
            'languages' => array(
                0 => 'fr',
                1 => 'en',
                2 => 'de',
            ),
            'label' => 'ville.villeI18ns',
            'columns' => array(
                'name' => array(
                    'required' => false,
                    'label' => 'ville.name',
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
            'data_class' => 'Cungfoo\Model\Ville',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Ville';
    }

} // BaseVilleType
