<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'demande_identifiant' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseDemandeIdentifiantType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'demande_identifiant.id',
            'required' => false,
        ));
        $builder->add('societe_nom', 'text', array(
            'constraints' => array(
            ),
            'label' => 'demande_identifiant.societe_nom',
            'required' => false,
        ));
        $builder->add('societe_adresse_1', 'text', array(
            'constraints' => array(
            ),
            'label' => 'demande_identifiant.societe_adresse_1',
            'required' => false,
        ));
        $builder->add('societe_adresse_2', 'text', array(
            'constraints' => array(
            ),
            'label' => 'demande_identifiant.societe_adresse_2',
            'required' => false,
        ));
        $builder->add('societe_adresse_3', 'text', array(
            'constraints' => array(
            ),
            'label' => 'demande_identifiant.societe_adresse_3',
            'required' => false,
        ));
        $builder->add('societe_adresse_4', 'text', array(
            'constraints' => array(
            ),
            'label' => 'demande_identifiant.societe_adresse_4',
            'required' => false,
        ));
        $builder->add('societe_telephone', 'text', array(
            'constraints' => array(
            ),
            'label' => 'demande_identifiant.societe_telephone',
            'required' => false,
        ));
        $builder->add('societe_fax', 'text', array(
            'constraints' => array(
            ),
            'label' => 'demande_identifiant.societe_fax',
            'required' => false,
        ));
        $builder->add('contact_prenom', 'text', array(
            'constraints' => array(
            ),
            'label' => 'demande_identifiant.contact_prenom',
            'required' => false,
        ));
        $builder->add('contact_nom', 'text', array(
            'constraints' => array(
            ),
            'label' => 'demande_identifiant.contact_nom',
            'required' => false,
        ));
        $builder->add('contact_telephone', 'text', array(
            'constraints' => array(
            ),
            'label' => 'demande_identifiant.contact_telephone',
            'required' => false,
        ));
        $builder->add('contact_mail', 'text', array(
            'constraints' => array(
            ),
            'label' => 'demande_identifiant.contact_mail',
            'required' => false,
        ));
        $builder->add('permanence', 'text', array(
            'constraints' => array(
            ),
            'label' => 'demande_identifiant.permanence',
            'required' => false,
        ));
        $builder->add('permanence_matin_de', 'text', array(
            'constraints' => array(
            ),
            'label' => 'demande_identifiant.permanence_matin_de',
            'required' => false,
        ));
        $builder->add('permanence_matin_a', 'text', array(
            'constraints' => array(
            ),
            'label' => 'demande_identifiant.permanence_matin_a',
            'required' => false,
        ));
        $builder->add('permanence_apres_midi_de', 'text', array(
            'constraints' => array(
            ),
            'label' => 'demande_identifiant.permanence_apres_midi_de',
            'required' => false,
        ));
        $builder->add('permanence_apres_midi_a', 'text', array(
            'constraints' => array(
            ),
            'label' => 'demande_identifiant.permanence_apres_midi_a',
            'required' => false,
        ));
        $builder->add('client_vc', 'checkbox', array(
            'constraints' => array(
            ),
            'label' => 'demande_identifiant.client_vc',
            'required' => false,
        ));
        $builder->add('client_vc_code', 'text', array(
            'constraints' => array(
            ),
            'label' => 'demande_identifiant.client_vc_code',
            'required' => false,
        ));
        $builder->add('client_vd', 'checkbox', array(
            'constraints' => array(
            ),
            'label' => 'demande_identifiant.client_vd',
            'required' => false,
        ));
        $builder->add('client_vd_code', 'text', array(
            'constraints' => array(
            ),
            'label' => 'demande_identifiant.client_vd_code',
            'required' => false,
        ));
        $builder->add('brochure', 'checkbox', array(
            'constraints' => array(
            ),
            'label' => 'demande_identifiant.brochure',
            'required' => false,
        ));
        $builder->add('identifiant', 'checkbox', array(
            'constraints' => array(
            ),
            'label' => 'demande_identifiant.identifiant',
            'required' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cungfoo\Model\DemandeIdentifiant',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'DemandeIdentifiant';
    }

} // BaseDemandeIdentifiantType
