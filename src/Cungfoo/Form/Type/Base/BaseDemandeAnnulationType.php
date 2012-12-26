<?php

namespace Cungfoo\Form\Type\Base;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

/**
 * Test class for Additional builder enabled on the 'demande_annulation' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type.Base
 */
class BaseDemandeAnnulationType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array(
            'label' => 'demande_annulation.id',
            'required' => false,
        ));
        $builder->add('assure_nom', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'demande_annulation.assure_nom',
            'required' => false,
        ));
        $builder->add('assure_prenom', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'demande_annulation.assure_prenom',
            'required' => false,
        ));
        $builder->add('assure_adresse', 'textarea', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'demande_annulation.assure_adresse',
            'required' => false,
        ));
        $builder->add('assure_code_postal', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'demande_annulation.assure_code_postal',
            'required' => false,
        ));
        $builder->add('assure_ville', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'demande_annulation.assure_ville',
            'required' => false,
        ));
        $builder->add('assure_pays', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'demande_annulation.assure_pays',
            'required' => false,
        ));
        $builder->add('assure_mail', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'demande_annulation.assure_mail',
            'required' => false,
        ));
        $builder->add('assure_telephone', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'demande_annulation.assure_telephone',
            'required' => false,
        ));
        $builder->add('etablissement', 'model', array(
            'class' => '\Cungfoo\Model\Etablissement',
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'demande_annulation.etablissement',
            'required' => false,
        ));
        $builder->add('camping_num_resa', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'demande_annulation.camping_num_resa',
            'required' => false,
        ));
        $builder->add('camping_montant_sejour', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'demande_annulation.camping_montant_sejour',
            'required' => false,
        ));
        $builder->add('camping_montant_verse', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'demande_annulation.camping_montant_verse',
            'required' => false,
        ));
        $builder->add('sinistre_nature', 'choice', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'choices' => array(
                'demande_annulation.sinistre_nature.annulation' => 'demande_annulation.sinistre_nature.annulation',
                'demande_annulation.sinistre_nature.interruption' => 'demande_annulation.sinistre_nature.interruption',
            ),
            'label' => 'demande_annulation.sinistre_nature',
            'required' => false,
        ));
        $builder->add('sinistre_suite', 'choice', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'choices' => array(
                'demande_annulation.sinistre_suite.maladie' => 'demande_annulation.sinistre_suite.maladie',
                'demande_annulation.sinistre_suite.accident' => 'demande_annulation.sinistre_suite.accident',
                'demande_annulation.sinistre_suite.autre' => 'demande_annulation.sinistre_suite.autre',
            ),
            'label' => 'demande_annulation.sinistre_suite',
            'required' => false,
        ));
        $builder->add('sinistre_date', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'demande_annulation.sinistre_date',
            'required' => false,
        ));
        $builder->add('sinistre_resume', 'text', array(
            'constraints' => array(
                new Assert\NotBlank(),
            ),
            'label' => 'demande_annulation.sinistre_resume',
            'required' => false,
        ));
        $builder->add('file_1', 'cungfoo_file', array(
            'constraints' => array(
            ),
            'label' => 'demande_annulation.file_1',
            'required' => false,
        ));
        $builder->add('file_1_deleted', 'checkbox', array(
            'constraints' => array(
            ),
            'property_path' => false,
            'label' => 'demande_annulation.file_1_deleted',
            'required' => false,
        ));
        $builder->add('file_2', 'cungfoo_file', array(
            'constraints' => array(
            ),
            'label' => 'demande_annulation.file_2',
            'required' => false,
        ));
        $builder->add('file_2_deleted', 'checkbox', array(
            'constraints' => array(
            ),
            'property_path' => false,
            'label' => 'demande_annulation.file_2_deleted',
            'required' => false,
        ));
        $builder->add('file_3', 'cungfoo_file', array(
            'constraints' => array(
            ),
            'label' => 'demande_annulation.file_3',
            'required' => false,
        ));
        $builder->add('file_3_deleted', 'checkbox', array(
            'constraints' => array(
            ),
            'property_path' => false,
            'label' => 'demande_annulation.file_3_deleted',
            'required' => false,
        ));
        $builder->add('file_4', 'cungfoo_file', array(
            'constraints' => array(
            ),
            'label' => 'demande_annulation.file_4',
            'required' => false,
        ));
        $builder->add('file_4_deleted', 'checkbox', array(
            'constraints' => array(
            ),
            'property_path' => false,
            'label' => 'demande_annulation.file_4_deleted',
            'required' => false,
        ));
        $builder->add('active', 'checkbox', array(
            'constraints' => array(
            ),
            'label' => 'demande_annulation.active',
            'required' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cungfoo\Model\DemandeAnnulation',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'DemandeAnnulation';
    }

} // BaseDemandeAnnulationType
