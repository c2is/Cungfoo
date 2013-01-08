<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'type_hebergement' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseTypeHebergementType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'type_hebergement.id',
            'required' => false,
        ));
        $builder->add('code', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'type_hebergement.code',
            'required' => false,
        ));
        $builder->add('category_type_hebergement', 'model', array(
            'class' => '\Cungfoo\Model\CategoryTypeHebergement',
            'constraints' => array(
            ),
            'label' => 'type_hebergement.category_type_hebergement',
            'required' => false,
        ));
        $builder->add('nombre_chambre', 'integer', array(
            'constraints' => array(
            ),
            'label' => 'type_hebergement.nombre_chambre',
            'required' => false,
        ));
        $builder->add('nombre_place', 'integer', array(
            'constraints' => array(
            ),
            'label' => 'type_hebergement.nombre_place',
            'required' => false,
        ));
        $builder->add('image_hebergement_path', 'cungfoo_file', array(
            'constraints' => array(
            ),
            'label' => 'type_hebergement.image_hebergement_path',
            'required' => false,
        ));
        $builder->add('image_hebergement_path_deleted', 'checkbox', array(
            'constraints' => array(
            ),
            'property_path' => false,
            'label' => 'type_hebergement.image_hebergement_path_deleted',
            'required' => false,
        ));
        $builder->add('image_composition_path', 'cungfoo_file', array(
            'constraints' => array(
            ),
            'label' => 'type_hebergement.image_composition_path',
            'required' => false,
        ));
        $builder->add('image_composition_path_deleted', 'checkbox', array(
            'constraints' => array(
            ),
            'property_path' => false,
            'label' => 'type_hebergement.image_composition_path_deleted',
            'required' => false,
        ));
        $builder->add('active', 'checkbox', array(
            'constraints' => array(
            ),
            'label' => 'type_hebergement.active',
            'required' => false,
        ));
        $builder->add('etablissements', 'model', array(
            'class' => 'Cungfoo\Model\Etablissement',
            'constraints' => array(
            ),
            'multiple' => true,
            'label' => 'type_hebergement.etablissements',
            'required' => false,
        ));
        $builder->add('type_hebergementI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\TypeHebergementI18n',
            'languages' => array(
                0 => 'fr',
                1 => 'en',
                2 => 'de',
                3 => 'nl',
            ),
            'label' => 'type_hebergement.type_hebergementI18ns',
            'columns' => array(
                'name' => array(
                    'required' => false,
                    'label' => 'type_hebergement.name',
                    'type' => 'text',
                    'constraints' => array(
                        new Assert\NotBlank(),
                    ),
                ),
                'slug' => array(
                    'required' => false,
                    'label' => 'type_hebergement.slug',
                    'type' => 'text',
                    'constraints' => array(
                        new Assert\NotBlank(),
                    ),
                ),
                'surface' => array(
                    'required' => false,
                    'label' => 'type_hebergement.surface',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'type_terrasse' => array(
                    'required' => false,
                    'label' => 'type_hebergement.type_terrasse',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'description' => array(
                    'required' => false,
                    'label' => 'type_hebergement.description',
                    'type' => 'textarea',
                    'constraints' => array(
                    ),
                ),
                'composition' => array(
                    'required' => false,
                    'label' => 'type_hebergement.composition',
                    'type' => 'textarea',
                    'constraints' => array(
                    ),
                ),
                'presentation' => array(
                    'required' => false,
                    'label' => 'type_hebergement.presentation',
                    'type' => 'textarea',
                    'constraints' => array(
                    ),
                ),
                'capacite_hebergement' => array(
                    'required' => false,
                    'label' => 'type_hebergement.capacite_hebergement',
                    'type' => 'textarea',
                    'constraints' => array(
                    ),
                ),
                'dimensions' => array(
                    'required' => false,
                    'label' => 'type_hebergement.dimensions',
                    'type' => 'textarea',
                    'constraints' => array(
                    ),
                ),
                'agencement' => array(
                    'required' => false,
                    'label' => 'type_hebergement.agencement',
                    'type' => 'textarea',
                    'constraints' => array(
                    ),
                ),
                'equipements' => array(
                    'required' => false,
                    'label' => 'type_hebergement.equipements',
                    'type' => 'textarea',
                    'constraints' => array(
                    ),
                ),
                'annee_utilisation' => array(
                    'required' => false,
                    'label' => 'type_hebergement.annee_utilisation',
                    'type' => 'textarea',
                    'constraints' => array(
                    ),
                ),
                'remarque_1' => array(
                    'required' => false,
                    'label' => 'type_hebergement.remarque_1',
                    'type' => 'textarea',
                    'constraints' => array(
                    ),
                ),
                'remarque_2' => array(
                    'required' => false,
                    'label' => 'type_hebergement.remarque_2',
                    'type' => 'textarea',
                    'constraints' => array(
                    ),
                ),
                'remarque_3' => array(
                    'required' => false,
                    'label' => 'type_hebergement.remarque_3',
                    'type' => 'textarea',
                    'constraints' => array(
                    ),
                ),
                'remarque_4' => array(
                    'required' => false,
                    'label' => 'type_hebergement.remarque_4',
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
            'data_class' => 'Cungfoo\Model\TypeHebergement',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'TypeHebergement';
    }

} // BaseTypeHebergementType
