<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'etablissement' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseEtablissementType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'etablissement.id',
            'required' => false,
        ));
        $builder->add('code', 'integer', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'etablissement.code',
            'required' => false,
        ));
        $builder->add('slug', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'etablissement.slug',
            'required' => false,
        ));
        $builder->add('name', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'etablissement.name',
            'required' => false,
        ));
        $builder->add('title', 'text', array(
            'constraints' => array(
            ),
            'label' => 'etablissement.title',
            'required' => false,
        ));
        $builder->add('address1', 'text', array(
            'constraints' => array(
            ),
            'label' => 'etablissement.address1',
            'required' => false,
        ));
        $builder->add('address2', 'text', array(
            'constraints' => array(
            ),
            'label' => 'etablissement.address2',
            'required' => false,
        ));
        $builder->add('zip', 'text', array(
            'constraints' => array(
            ),
            'label' => 'etablissement.zip',
            'required' => false,
        ));
        $builder->add('city', 'text', array(
            'constraints' => array(
            ),
            'label' => 'etablissement.city',
            'required' => false,
        ));
        $builder->add('mail', 'text', array(
            'constraints' => array(
            ),
            'label' => 'etablissement.mail',
            'required' => false,
        ));
        $builder->add('country_code', 'text', array(
            'constraints' => array(
            ),
            'label' => 'etablissement.country_code',
            'required' => false,
        ));
        $builder->add('phone1', 'text', array(
            'constraints' => array(
            ),
            'label' => 'etablissement.phone1',
            'required' => false,
        ));
        $builder->add('phone2', 'text', array(
            'constraints' => array(
            ),
            'label' => 'etablissement.phone2',
            'required' => false,
        ));
        $builder->add('fax', 'text', array(
            'constraints' => array(
            ),
            'label' => 'etablissement.fax',
            'required' => false,
        ));
        $builder->add('opening_date', 'datetime', array(
            'constraints' => array(
            ),
            'widget' => 'single_text',
            'label' => 'etablissement.opening_date',
            'required' => false,
        ));
        $builder->add('closing_date', 'datetime', array(
            'constraints' => array(
            ),
            'widget' => 'single_text',
            'label' => 'etablissement.closing_date',
            'required' => false,
        ));
        $builder->add('ville', 'model', array(
            'class' => '\Cungfoo\Model\Ville',
            'constraints' => array(
            ),
            'label' => 'etablissement.ville',
            'required' => false,
        ));
        $builder->add('departement', 'model', array(
            'class' => '\Cungfoo\Model\Departement',
            'constraints' => array(
            ),
            'label' => 'etablissement.departement',
            'required' => false,
        ));
        $builder->add('categorie', 'model', array(
            'class' => '\Cungfoo\Model\Categorie',
            'constraints' => array(
            ),
            'label' => 'etablissement.categorie',
            'required' => false,
        ));
        $builder->add('geo_coordinate_x', 'text', array(
            'constraints' => array(
            ),
            'label' => 'etablissement.geo_coordinate_x',
            'required' => false,
        ));
        $builder->add('geo_coordinate_y', 'text', array(
            'constraints' => array(
            ),
            'label' => 'etablissement.geo_coordinate_y',
            'required' => false,
        ));
        $builder->add('video_path', 'text', array(
            'constraints' => array(
            ),
            'label' => 'etablissement.video_path',
            'required' => false,
        ));
        $builder->add('image_360_path', 'text', array(
            'constraints' => array(
            ),
            'label' => 'etablissement.image_360_path',
            'required' => false,
        ));
        $builder->add('capacite', 'text', array(
            'constraints' => array(
            ),
            'label' => 'etablissement.capacite',
            'required' => false,
        ));
        $builder->add('plan_path', 'cungfoo_file', array(
            'constraints' => array(
            ),
            'label' => 'etablissement.plan_path',
            'required' => false,
        ));
        $builder->add('plan_path_deleted', 'checkbox', array(
            'constraints' => array(
            ),
            'property_path' => false,
            'label' => 'etablissement.plan_path_deleted',
            'required' => false,
        ));
        $builder->add('vignette', 'cungfoo_file', array(
            'constraints' => array(
            ),
            'label' => 'etablissement.vignette',
            'required' => false,
        ));
        $builder->add('vignette_deleted', 'checkbox', array(
            'constraints' => array(
            ),
            'property_path' => false,
            'label' => 'etablissement.vignette_deleted',
            'required' => false,
        ));
        $builder->add('active', 'checkbox', array(
            'constraints' => array(
            ),
            'label' => 'etablissement.active',
            'required' => false,
        ));
        $builder->add('type_hebergements', 'model', array(
            'class' => 'Cungfoo\Model\TypeHebergement',
            'constraints' => array(
            ),
            'multiple' => true,
            'label' => 'etablissement.type_hebergements',
            'required' => false,
        ));
        $builder->add('destinations', 'model', array(
            'class' => 'Cungfoo\Model\Destination',
            'constraints' => array(
            ),
            'multiple' => true,
            'label' => 'etablissement.destinations',
            'required' => false,
        ));
        $builder->add('activites', 'model', array(
            'class' => 'Cungfoo\Model\Activite',
            'constraints' => array(
            ),
            'multiple' => true,
            'label' => 'etablissement.activites',
            'required' => false,
        ));
        $builder->add('service_complementaires', 'model', array(
            'class' => 'Cungfoo\Model\ServiceComplementaire',
            'constraints' => array(
            ),
            'multiple' => true,
            'label' => 'etablissement.service_complementaires',
            'required' => false,
        ));
        $builder->add('situation_geographiques', 'model', array(
            'class' => 'Cungfoo\Model\SituationGeographique',
            'constraints' => array(
            ),
            'multiple' => true,
            'label' => 'etablissement.situation_geographiques',
            'required' => false,
        ));
        $builder->add('baignades', 'model', array(
            'class' => 'Cungfoo\Model\Baignade',
            'constraints' => array(
            ),
            'multiple' => true,
            'label' => 'etablissement.baignades',
            'required' => false,
        ));
        $builder->add('thematiques', 'model', array(
            'class' => 'Cungfoo\Model\Thematique',
            'constraints' => array(
            ),
            'multiple' => true,
            'label' => 'etablissement.thematiques',
            'required' => false,
        ));
        $builder->add('point_interets', 'model', array(
            'class' => 'Cungfoo\Model\PointInteret',
            'constraints' => array(
            ),
            'multiple' => true,
            'label' => 'etablissement.point_interets',
            'required' => false,
        ));
        $builder->add('events', 'model', array(
            'class' => 'Cungfoo\Model\Event',
            'constraints' => array(
            ),
            'multiple' => true,
            'label' => 'etablissement.events',
            'required' => false,
        ));
        $builder->add('bon_plans', 'model', array(
            'class' => 'Cungfoo\Model\BonPlan',
            'constraints' => array(
            ),
            'multiple' => true,
            'label' => 'etablissement.bon_plans',
            'required' => false,
        ));
        $builder->add('etablissementI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\EtablissementI18n',
            'languages' => array(
                0 => 'fr',
                1 => 'de',
            ),
            'label' => 'etablissement.etablissementI18ns',
            'columns' => array(
                'country' => array(
                    'required' => false,
                    'label' => 'etablissement.country',
                    'type' => 'text',
                    'constraints' => array(
                    ),
                ),
                'ouverture_reception' => array(
                    'required' => false,
                    'label' => 'etablissement.ouverture_reception',
                    'type' => 'textarea',
                    'constraints' => array(
                    ),
                ),
                'ouverture_camping' => array(
                    'required' => false,
                    'label' => 'etablissement.ouverture_camping',
                    'type' => 'textarea',
                    'constraints' => array(
                    ),
                ),
                'arrivees_departs' => array(
                    'required' => false,
                    'label' => 'etablissement.arrivees_departs',
                    'type' => 'textarea',
                    'constraints' => array(
                    ),
                ),
                'description' => array(
                    'required' => false,
                    'label' => 'etablissement.description',
                    'type' => 'textrich',
                    'constraints' => array(
                    ),
                ),
                'active_locale' => array(
                    'required' => false,
                    'label' => 'etablissement.active_locale',
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
            'data_class' => 'Cungfoo\Model\Etablissement',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Etablissement';
    }

} // BaseEtablissementType
