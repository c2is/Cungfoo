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
    public function getIdType()
    {
        return 'integer';
    }

    public function getIdOptions()
    {
        return array(
            'required' => false,
            'label' => 'demande_identifiant.id',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
        );
    }

    public function getSocieteNomType()
    {
        return 'text';
    }

    public function getSocieteNomOptions()
    {
        return array(
            'required' => false,
            'label' => 'demande_identifiant.societe_nom',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
        );
    }

    public function getSocieteAdresse1Type()
    {
        return 'text';
    }

    public function getSocieteAdresse1Options()
    {
        return array(
            'required' => false,
            'label' => 'demande_identifiant.societe_adresse_1',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
        );
    }

    public function getSocieteAdresse2Type()
    {
        return 'text';
    }

    public function getSocieteAdresse2Options()
    {
        return array(
            'required' => false,
            'label' => 'demande_identifiant.societe_adresse_2',
        );
    }

    public function getSocieteAdresse3Type()
    {
        return 'text';
    }

    public function getSocieteAdresse3Options()
    {
        return array(
            'required' => false,
            'label' => 'demande_identifiant.societe_adresse_3',
        );
    }

    public function getSocieteAdresse4Type()
    {
        return 'text';
    }

    public function getSocieteAdresse4Options()
    {
        return array(
            'required' => false,
            'label' => 'demande_identifiant.societe_adresse_4',
        );
    }

    public function getSocieteTelephoneType()
    {
        return 'text';
    }

    public function getSocieteTelephoneOptions()
    {
        return array(
            'required' => false,
            'label' => 'demande_identifiant.societe_telephone',
        );
    }

    public function getSocieteFaxType()
    {
        return 'text';
    }

    public function getSocieteFaxOptions()
    {
        return array(
            'required' => false,
            'label' => 'demande_identifiant.societe_fax',
        );
    }

    public function getContactPrenomType()
    {
        return 'text';
    }

    public function getContactPrenomOptions()
    {
        return array(
            'required' => false,
            'label' => 'demande_identifiant.contact_prenom',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
        );
    }

    public function getContactNomType()
    {
        return 'text';
    }

    public function getContactNomOptions()
    {
        return array(
            'required' => false,
            'label' => 'demande_identifiant.contact_nom',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
        );
    }

    public function getContactTelephoneType()
    {
        return 'text';
    }

    public function getContactTelephoneOptions()
    {
        return array(
            'required' => false,
            'label' => 'demande_identifiant.contact_telephone',
        );
    }

    public function getContactMailType()
    {
        return 'text';
    }

    public function getContactMailOptions()
    {
        return array(
            'required' => false,
            'label' => 'demande_identifiant.contact_mail',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
        );
    }

    public function getPermanenceType()
    {
        return 'text';
    }

    public function getPermanenceOptions()
    {
        return array(
            'required' => false,
            'label' => 'demande_identifiant.permanence',
        );
    }

    public function getPermanenceMatinDeType()
    {
        return 'text';
    }

    public function getPermanenceMatinDeOptions()
    {
        return array(
            'required' => false,
            'label' => 'demande_identifiant.permanence_matin_de',
        );
    }

    public function getPermanenceMatinAType()
    {
        return 'text';
    }

    public function getPermanenceMatinAOptions()
    {
        return array(
            'required' => false,
            'label' => 'demande_identifiant.permanence_matin_a',
        );
    }

    public function getPermanenceApresMidiDeType()
    {
        return 'text';
    }

    public function getPermanenceApresMidiDeOptions()
    {
        return array(
            'required' => false,
            'label' => 'demande_identifiant.permanence_apres_midi_de',
        );
    }

    public function getPermanenceApresMidiAType()
    {
        return 'text';
    }

    public function getPermanenceApresMidiAOptions()
    {
        return array(
            'required' => false,
            'label' => 'demande_identifiant.permanence_apres_midi_a',
        );
    }

    public function getClientVcType()
    {
        return 'checkbox';
    }

    public function getClientVcOptions()
    {
        return array(
            'required' => false,
            'label' => 'demande_identifiant.client_vc',
        );
    }

    public function getClientVcCodeType()
    {
        return 'text';
    }

    public function getClientVcCodeOptions()
    {
        return array(
            'required' => false,
            'label' => 'demande_identifiant.client_vc_code',
        );
    }

    public function getClientVdType()
    {
        return 'checkbox';
    }

    public function getClientVdOptions()
    {
        return array(
            'required' => false,
            'label' => 'demande_identifiant.client_vd',
        );
    }

    public function getClientVdCodeType()
    {
        return 'text';
    }

    public function getClientVdCodeOptions()
    {
        return array(
            'required' => false,
            'label' => 'demande_identifiant.client_vd_code',
        );
    }

    public function getBrochureType()
    {
        return 'checkbox';
    }

    public function getBrochureOptions()
    {
        return array(
            'required' => false,
            'label' => 'demande_identifiant.brochure',
        );
    }

    public function getIdentifiantType()
    {
        return 'checkbox';
    }

    public function getIdentifiantOptions()
    {
        return array(
            'required' => false,
            'label' => 'demande_identifiant.identifiant',
        );
    }

    public function getCreatedAtType()
    {
        return 'datetime';
    }

    public function getCreatedAtOptions()
    {
        return array(
            'required' => false,
            'label' => 'demande_identifiant.created_at',
            'widget' => 'single_text',
        );
    }

    public function getUpdatedAtType()
    {
        return 'datetime';
    }

    public function getUpdatedAtOptions()
    {
        return array(
            'required' => false,
            'label' => 'demande_identifiant.updated_at',
            'widget' => 'single_text',
        );
    }

    public function getActiveType()
    {
        return 'checkbox';
    }

    public function getActiveOptions()
    {
        return array(
            'required' => false,
            'label' => 'demande_identifiant.active',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', $this->getIdType(), $this->getIdOptions());
        $builder->add('societe_nom', $this->getSocieteNomType(), $this->getSocieteNomOptions());
        $builder->add('societe_adresse_1', $this->getSocieteAdresse1Type(), $this->getSocieteAdresse1Options());
        $builder->add('societe_adresse_2', $this->getSocieteAdresse2Type(), $this->getSocieteAdresse2Options());
        $builder->add('societe_adresse_3', $this->getSocieteAdresse3Type(), $this->getSocieteAdresse3Options());
        $builder->add('societe_adresse_4', $this->getSocieteAdresse4Type(), $this->getSocieteAdresse4Options());
        $builder->add('societe_telephone', $this->getSocieteTelephoneType(), $this->getSocieteTelephoneOptions());
        $builder->add('societe_fax', $this->getSocieteFaxType(), $this->getSocieteFaxOptions());
        $builder->add('contact_prenom', $this->getContactPrenomType(), $this->getContactPrenomOptions());
        $builder->add('contact_nom', $this->getContactNomType(), $this->getContactNomOptions());
        $builder->add('contact_telephone', $this->getContactTelephoneType(), $this->getContactTelephoneOptions());
        $builder->add('contact_mail', $this->getContactMailType(), $this->getContactMailOptions());
        $builder->add('permanence', $this->getPermanenceType(), $this->getPermanenceOptions());
        $builder->add('permanence_matin_de', $this->getPermanenceMatinDeType(), $this->getPermanenceMatinDeOptions());
        $builder->add('permanence_matin_a', $this->getPermanenceMatinAType(), $this->getPermanenceMatinAOptions());
        $builder->add('permanence_apres_midi_de', $this->getPermanenceApresMidiDeType(), $this->getPermanenceApresMidiDeOptions());
        $builder->add('permanence_apres_midi_a', $this->getPermanenceApresMidiAType(), $this->getPermanenceApresMidiAOptions());
        $builder->add('client_vc', $this->getClientVcType(), $this->getClientVcOptions());
        $builder->add('client_vc_code', $this->getClientVcCodeType(), $this->getClientVcCodeOptions());
        $builder->add('client_vd', $this->getClientVdType(), $this->getClientVdOptions());
        $builder->add('client_vd_code', $this->getClientVdCodeType(), $this->getClientVdCodeOptions());
        $builder->add('brochure', $this->getBrochureType(), $this->getBrochureOptions());
        $builder->add('identifiant', $this->getIdentifiantType(), $this->getIdentifiantOptions());
        $builder->add('created_at', $this->getCreatedAtType(), $this->getCreatedAtOptions());
        $builder->add('updated_at', $this->getUpdatedAtType(), $this->getUpdatedAtOptions());
        $builder->add('active', $this->getActiveType(), $this->getActiveOptions());
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
