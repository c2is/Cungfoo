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
    public function getIdType()
    {
        return 'hidden';
    }

    public function getIdOptions()
    {
        return array(
            'required' => false,
            'label' => 'demande_annulation.id',
        );
    }

    public function getAssureNomType()
    {
        return 'text';
    }

    public function getAssureNomOptions()
    {
        return array(
            'required' => false,
            'label' => 'demande_annulation.assure_nom',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
        );
    }

    public function getAssurePrenomType()
    {
        return 'text';
    }

    public function getAssurePrenomOptions()
    {
        return array(
            'required' => false,
            'label' => 'demande_annulation.assure_prenom',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
        );
    }

    public function getAssureAdresseType()
    {
        return 'textarea';
    }

    public function getAssureAdresseOptions()
    {
        return array(
            'required' => false,
            'label' => 'demande_annulation.assure_adresse',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
        );
    }

    public function getAssureCodePostalType()
    {
        return 'text';
    }

    public function getAssureCodePostalOptions()
    {
        return array(
            'required' => false,
            'label' => 'demande_annulation.assure_code_postal',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
        );
    }

    public function getAssureVilleType()
    {
        return 'text';
    }

    public function getAssureVilleOptions()
    {
        return array(
            'required' => false,
            'label' => 'demande_annulation.assure_ville',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
        );
    }

    public function getAssurePaysType()
    {
        return 'text';
    }

    public function getAssurePaysOptions()
    {
        return array(
            'required' => false,
            'label' => 'demande_annulation.assure_pays',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
        );
    }

    public function getAssureMailType()
    {
        return 'text';
    }

    public function getAssureMailOptions()
    {
        return array(
            'required' => false,
            'label' => 'demande_annulation.assure_mail',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
        );
    }

    public function getAssureTelephoneType()
    {
        return 'text';
    }

    public function getAssureTelephoneOptions()
    {
        return array(
            'required' => false,
            'label' => 'demande_annulation.assure_telephone',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
        );
    }

    public function getEtablissementType()
    {
        return 'model';
    }

    public function getEtablissementOptions()
    {
        return array(
            'required' => false,
            'label' => 'demande_annulation.camping_id',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
            'class' => 'Cungfoo\Model\Etablissement',
        );
    }

    public function getCampingNumResaType()
    {
        return 'text';
    }

    public function getCampingNumResaOptions()
    {
        return array(
            'required' => false,
            'label' => 'demande_annulation.camping_num_resa',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
        );
    }

    public function getCampingMontantSejourType()
    {
        return 'text';
    }

    public function getCampingMontantSejourOptions()
    {
        return array(
            'required' => false,
            'label' => 'demande_annulation.camping_montant_sejour',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
        );
    }

    public function getCampingMontantVerseType()
    {
        return 'text';
    }

    public function getCampingMontantVerseOptions()
    {
        return array(
            'required' => false,
            'label' => 'demande_annulation.camping_montant_verse',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
        );
    }

    public function getSinistreNatureType()
    {
        return 'choice';
    }

    public function getSinistreNatureOptions()
    {
        return array(
            'required' => false,
            'label' => 'demande_annulation.sinistre_nature',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
            'choices' => array(
                        'demande_annulation.sinistre_nature.annulation' => 'demande_annulation.sinistre_nature.annulation',
                        'demande_annulation.sinistre_nature.interruption' => 'demande_annulation.sinistre_nature.interruption',
                    ),
        );
    }

    public function getSinistreSuiteType()
    {
        return 'choice';
    }

    public function getSinistreSuiteOptions()
    {
        return array(
            'required' => false,
            'label' => 'demande_annulation.sinistre_suite',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
            'choices' => array(
                        'demande_annulation.sinistre_suite.maladie' => 'demande_annulation.sinistre_suite.maladie',
                        'demande_annulation.sinistre_suite.accident' => 'demande_annulation.sinistre_suite.accident',
                        'demande_annulation.sinistre_suite.autre' => 'demande_annulation.sinistre_suite.autre',
                    ),
        );
    }

    public function getSinistreDateType()
    {
        return 'text';
    }

    public function getSinistreDateOptions()
    {
        return array(
            'required' => false,
            'label' => 'demande_annulation.sinistre_date',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
        );
    }

    public function getSinistreResumeType()
    {
        return 'textarea';
    }

    public function getSinistreResumeOptions()
    {
        return array(
            'required' => false,
            'label' => 'demande_annulation.sinistre_resume',
            'constraints' => array(
                        new Assert\NotBlank(),
                    ),
        );
    }

    public function getFile1Type()
    {
        return 'cungfoo_file';
    }

    public function getFile1Options()
    {
        return array(
            'required' => false,
            'label' => 'demande_annulation.file_1',
        );
    }

    public function getFile1DeletedType()
    {
        return 'checkbox';
    }

    public function getFile1DeletedOptions()
    {
        return array(
            'property_path' => false,
            'required' => false,
            'label' => 'demande_annulation.file_1_deleted',
        );
    }

    public function getFile2Type()
    {
        return 'cungfoo_file';
    }

    public function getFile2Options()
    {
        return array(
            'required' => false,
            'label' => 'demande_annulation.file_2',
        );
    }

    public function getFile2DeletedType()
    {
        return 'checkbox';
    }

    public function getFile2DeletedOptions()
    {
        return array(
            'property_path' => false,
            'required' => false,
            'label' => 'demande_annulation.file_2_deleted',
        );
    }

    public function getFile3Type()
    {
        return 'cungfoo_file';
    }

    public function getFile3Options()
    {
        return array(
            'required' => false,
            'label' => 'demande_annulation.file_3',
        );
    }

    public function getFile3DeletedType()
    {
        return 'checkbox';
    }

    public function getFile3DeletedOptions()
    {
        return array(
            'property_path' => false,
            'required' => false,
            'label' => 'demande_annulation.file_3_deleted',
        );
    }

    public function getFile4Type()
    {
        return 'cungfoo_file';
    }

    public function getFile4Options()
    {
        return array(
            'required' => false,
            'label' => 'demande_annulation.file_4',
        );
    }

    public function getFile4DeletedType()
    {
        return 'checkbox';
    }

    public function getFile4DeletedOptions()
    {
        return array(
            'property_path' => false,
            'required' => false,
            'label' => 'demande_annulation.file_4_deleted',
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
            'label' => 'demande_annulation.created_at',
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
            'label' => 'demande_annulation.updated_at',
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
            'label' => 'demande_annulation.active',
        );
    }

    public function getSeoTitleType()
    {
        return 'text';
    }

    public function getSeoTitleOptions()
    {
        return array(
            'required' => false,
            'label' => 'demande_annulation_i18n.seo_title',
        );
    }

    public function getSeoDescriptionType()
    {
        return 'textarea';
    }

    public function getSeoDescriptionOptions()
    {
        return array(
            'required' => false,
            'label' => 'demande_annulation_i18n.seo_description',
        );
    }

    public function getSeoH1Type()
    {
        return 'text';
    }

    public function getSeoH1Options()
    {
        return array(
            'required' => false,
            'label' => 'demande_annulation_i18n.seo_h1',
        );
    }

    public function getSeoKeywordsType()
    {
        return 'textarea';
    }

    public function getSeoKeywordsOptions()
    {
        return array(
            'required' => false,
            'label' => 'demande_annulation_i18n.seo_keywords',
        );
    }

    public function getActiveLocaleType()
    {
        return 'checkbox';
    }

    public function getActiveLocaleOptions()
    {
        return array(
            'required' => false,
            'label' => 'demande_annulation_i18n.active_locale',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', $this->getIdType(), $this->getIdOptions());
        $builder->add('assure_nom', $this->getAssureNomType(), $this->getAssureNomOptions());
        $builder->add('assure_prenom', $this->getAssurePrenomType(), $this->getAssurePrenomOptions());
        $builder->add('assure_adresse', $this->getAssureAdresseType(), $this->getAssureAdresseOptions());
        $builder->add('assure_code_postal', $this->getAssureCodePostalType(), $this->getAssureCodePostalOptions());
        $builder->add('assure_ville', $this->getAssureVilleType(), $this->getAssureVilleOptions());
        $builder->add('assure_pays', $this->getAssurePaysType(), $this->getAssurePaysOptions());
        $builder->add('assure_mail', $this->getAssureMailType(), $this->getAssureMailOptions());
        $builder->add('assure_telephone', $this->getAssureTelephoneType(), $this->getAssureTelephoneOptions());
        $builder->add('etablissement', $this->getEtablissementType(), $this->getEtablissementOptions());
        $builder->add('camping_num_resa', $this->getCampingNumResaType(), $this->getCampingNumResaOptions());
        $builder->add('camping_montant_sejour', $this->getCampingMontantSejourType(), $this->getCampingMontantSejourOptions());
        $builder->add('camping_montant_verse', $this->getCampingMontantVerseType(), $this->getCampingMontantVerseOptions());
        $builder->add('sinistre_nature', $this->getSinistreNatureType(), $this->getSinistreNatureOptions());
        $builder->add('sinistre_suite', $this->getSinistreSuiteType(), $this->getSinistreSuiteOptions());
        $builder->add('sinistre_date', $this->getSinistreDateType(), $this->getSinistreDateOptions());
        $builder->add('sinistre_resume', $this->getSinistreResumeType(), $this->getSinistreResumeOptions());
        $builder->add('file_1', $this->getFile1Type(), $this->getFile1Options());
        $builder->add('file_1_deleted', $this->getFile1DeletedType(), $this->getFile1DeletedOptions());
        $builder->add('file_2', $this->getFile2Type(), $this->getFile2Options());
        $builder->add('file_2_deleted', $this->getFile2DeletedType(), $this->getFile2DeletedOptions());
        $builder->add('file_3', $this->getFile3Type(), $this->getFile3Options());
        $builder->add('file_3_deleted', $this->getFile3DeletedType(), $this->getFile3DeletedOptions());
        $builder->add('file_4', $this->getFile4Type(), $this->getFile4Options());
        $builder->add('file_4_deleted', $this->getFile4DeletedType(), $this->getFile4DeletedOptions());
        $builder->add('created_at', $this->getCreatedAtType(), $this->getCreatedAtOptions());
        $builder->add('updated_at', $this->getUpdatedAtType(), $this->getUpdatedAtOptions());
        $builder->add('active', $this->getActiveType(), $this->getActiveOptions());$builder->add('demande_annulationI18ns', 'translation_collection', array(
            'i18n_class' => 'Cungfoo\Model\DemandeAnnulationI18n',
            'label' => 'demande_annulationI18ns',
            'required' => false,
            'languages' => array('fr', 'de'),
            'columns' => array(
                'seo_title' => array_merge(array('type' => $this->getSeoTitleType()), $this->getSeoTitleOptions()),
                'seo_description' => array_merge(array('type' => $this->getSeoDescriptionType()), $this->getSeoDescriptionOptions()),
                'seo_h1' => array_merge(array('type' => $this->getSeoH1Type()), $this->getSeoH1Options()),
                'seo_keywords' => array_merge(array('type' => $this->getSeoKeywordsType()), $this->getSeoKeywordsOptions()),
                'active_locale' => array_merge(array('type' => $this->getActiveLocaleType()), $this->getActiveLocaleOptions()),

            )
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
