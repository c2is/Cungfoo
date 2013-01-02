<?php

namespace VacancesDirectes\Form\Type\Annulation;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert,
    Symfony\Component\Validator\ExecutionContext;

use Cungfoo\Form\Type\AppAwareType,
    Cungfoo\Model\EtablissementQuery;

use VacancesDirectes\Form\Data\Annulation\AnnulationData;

class AnnulationType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $locale = $this->getApplication()['context']->get('language');

        $formConfig = \Symfony\Component\Yaml\Yaml::parse(sprintf('%s/VacancesDirectes/forms/annulation.yml', $this->getApplication()['config']->get('config_dir')));

        $listeCampings = EtablissementQuery::create()
            ->select(array('id', 'name'))
            ->joinWithI18n($locale)
            ->orderBy('name')
            ->findActive()
            ->toArray()
        ;

        $campings = array();
        foreach($listeCampings as $camping) {
            $campings[$camping['id']] = $camping['name'];
        }

        $builder->add('assureNom', 'text', array(
                'label'         => 'annulation.assureNom.label',
                'constraints'   => array(
                    new Assert\NotBlank(array(
                        'message' => 'annulation.assureNom.not_blank'
                    ))
                )
            )
        );
        $builder->add('assurePrenom', 'text', array(
                'label'         => 'annulation.assurePrenom.label',
                'constraints'   => array(
                    new Assert\NotBlank(array(
                        'message' => 'annulation.assurePrenom.not_blank'
                    ))
                )
            )
        );
        $builder->add('assureAdresse', 'text', array(
                'label'         => 'annulation.assureAdresse.label',
                'constraints'   => array(
                    new Assert\NotBlank(array(
                        'message' => 'annulation.assureAdresse.not_blank'
                    ))
                )
            )
        );
        $builder->add('assureCodePostal', 'text', array(
                'label'         => 'annulation.assureCodePostal.label',
                'constraints'   => array(
                    new Assert\NotBlank(array(
                        'message' => 'annulation.assureCodePostal.not_blank'
                    ))
                )
            )
        );
        $builder->add('assureVille', 'text', array(
                'label'         => 'annulation.assureVille.label',
                'constraints'   => array(
                    new Assert\NotBlank(array(
                        'message' => 'annulation.assureVille.not_blank'
                    ))
                )
            )
        );
        $builder->add('assurePays', 'choice', array(
                'label'         => 'annulation.assurePays.label',
                'choices'       => $formConfig['pays'],
                'empty_value'   => 'annulation.assurePays.empty_value',
                'constraints'   => array(
                    new Assert\NotBlank(array(
                        'message' => 'annulation.assurePays.not_blank'
                    )),
                    new Assert\Choice(array(
                        'choices' => $formConfig['pays'],
                        'message' => 'annulation.assurePays.choice'
                    ))
                )
            )
        );
        $builder->add('assureMail', 'text', array(
                'label'         => 'annulation.assureMail.label',
                'constraints'   => array(
                    new Assert\NotBlank(array(
                        'message' => 'annulation.assureMail.not_blank'
                    )),
                    new Assert\Email(array(
                        'message' => 'annulation.assureMail.mail'
                    ))
                )
            )
        );
        $builder->add('assureTelephone', 'text', array(
                'label'         => 'annulation.assureTelephone.label',
                'constraints'   => array(
                    new Assert\NotBlank(array(
                        'message' => 'annulation.assureTelephone.not_blank'
                    ))
                )
            )
        );
        $builder->add('campingMontantSejour', 'text', array(
                'label'         => 'annulation.campingMontantSejour.label',
                'constraints'   => array(
                    new Assert\NotBlank(array(
                        'message' => 'annulation.campingMontantSejour.not_blank'
                    ))
                )
            )
        );
        $builder->add('campingMontantVerse', 'text', array(
                'label'         => 'annulation.campingMontantVerse.label',
                'constraints'   => array(
                    new Assert\NotBlank(array(
                        'message' => 'annulation.campingMontantVerse.not_blank'
                    ))
                )
            )
        );
        $builder->add('campingId', 'choice', array(
                'label'         => 'annulation.campingId.label',
                'choices'       => $campings,
                'empty_value'   => 'annulation.campingId.empty_value',
                'constraints'   => array(
                    new Assert\NotBlank(array(
                        'message' => 'annulation.campingId.not_blank'
                    )),
                    new Assert\Choice(array(
                        'choices' => array_values(array_flip($campings)),
                        'message' => 'annulation.campingId.choice'
                    ))
                )
            )
        );
        $builder->add('campingNumResa', 'text', array(
                'label'         => 'annulation.campingNumResa.label',
                'constraints'   => array(
                    new Assert\NotBlank(array(
                        'message' => 'annulation.campingNumResa.not_blank'
                    ))
                )
            )
        );
        $builder->add('sinistreNature', 'choice', array(
                'label'         => 'annulation.sinistreNature.label',
                'choices'       => $formConfig['naturesSinistre'],
                'expanded'      => true,
                'multiple'      => false,
                'constraints'   => array(
                    new Assert\NotBlank(array(
                        'message' => 'annulation.sinistreNature.not_blank'
                    )),
                    new Assert\Choice(array(
                        'choices' => array_values(array_flip($formConfig['naturesSinistre'])),
                        'message' => 'annulation.sinistreNature.choice'
                    ))
                )
            )
        );
        $builder->add('sinistreSuite', 'choice', array(
                'label'         => 'annulation.sinistreSuite.label',
                'choices'       => $formConfig['suitesSinistre'],
                'expanded'      => true,
                'multiple'      => false,
                'constraints'   => array(
                    new Assert\NotBlank(array(
                        'message' => 'annulation.sinistreSuite.not_blank'
                    )),
                    new Assert\Choice(array(
                        'choices' => array_values(array_flip($formConfig['suitesSinistre'])),
                        'message' => 'annulation.sinistreSuite.choice'
                    ))
                )
            )
        );
        $builder->add('sinistreDate', 'date', array(
                'label'         => 'annulation.sinistreDate.label',
                'widget'        => 'single_text',
                'input'         => 'string',
                'format'        => 'dd/MM/yyyy',
                'constraints'   => array(
                    new Assert\NotBlank(array(
                        'message' => 'annulation.sinistreDate.not_blank'
                    )),
                    new Assert\Date(array(
                        'message' => 'annulation.sinistreDate.date'
                    ))
                )
            )
        );
        $builder->add('sinistreResume', 'textarea', array(
                'label'         => 'annulation.sinistreResume.label',
                'constraints'   => array(
                    new Assert\NotBlank(array(
                        'message' => 'annulation.sinistreResume.not_blank'
                    ))
                )
            )
        );
        $builder->add('file1', 'file', array(
                'required'      => false,
                'constraints'   => array(
                    new Assert\File(array(
                        'maxSize' => '2048k',
                        'mimeTypes' => array(
                            'application/pdf',
                            'application/x-pdf',
                            'application/msword',
                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                            'image/png',
                            'image/jpeg'
                        ),
                        'mimeTypesMessage'              => 'annulation.mimeTypesMessage',
                        'notFoundMessage'               => 'annulation.notFoundMessage',
                        'notReadableMessage'            => 'annulation.notReadableMessage',
                        'uploadIniSizeErrorMessage'     => 'annulation.uploadIniSizeErrorMessage',
                        'uploadFormSizeErrorMessage'    => 'annulation.uploadFormSizeErrorMessage',
                        'uploadErrorMessage'            => 'annulation.uploadErrorMessage',
                    ))
                )
            )
        );
        $builder->add('file2', 'file', array(
                'required'      => false,
                'constraints'   => array(
                    new Assert\File(array(
                        'maxSize' => '2048k',
                        'mimeTypes' => array(
                            'application/pdf',
                            'application/x-pdf',
                            'application/msword',
                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                            'image/png',
                            'image/jpeg'
                        ),
                        'mimeTypesMessage'              => 'annulation.mimeTypesMessage',
                        'notFoundMessage'               => 'annulation.notFoundMessage',
                        'notReadableMessage'            => 'annulation.notReadableMessage',
                        'uploadIniSizeErrorMessage'     => 'annulation.uploadIniSizeErrorMessage',
                        'uploadFormSizeErrorMessage'    => 'annulation.uploadFormSizeErrorMessage',
                        'uploadErrorMessage'            => 'annulation.uploadErrorMessage',
                    ))
                )
            )
        );
        $builder->add('file3', 'file', array(
                'required'      => false,
                'constraints'   => array(
                    new Assert\File(array(
                        'maxSize' => '2048k',
                        'mimeTypes' => array(
                            'application/pdf',
                            'application/x-pdf',
                            'application/msword',
                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                            'image/png',
                            'image/jpeg'
                        ),
                        'mimeTypesMessage'              => 'annulation.mimeTypesMessage',
                        'notFoundMessage'               => 'annulation.notFoundMessage',
                        'notReadableMessage'            => 'annulation.notReadableMessage',
                        'uploadIniSizeErrorMessage'     => 'annulation.uploadIniSizeErrorMessage',
                        'uploadFormSizeErrorMessage'    => 'annulation.uploadFormSizeErrorMessage',
                        'uploadErrorMessage'            => 'annulation.uploadErrorMessage',
                    ))
                )
            )
        );
        $builder->add('file4', 'file', array(
                'required'      => false,
                'constraints'   => array(
                    new Assert\File(array(
                        'maxSize' => '2048k',
                        'mimeTypes' => array(
                            'application/pdf',
                            'application/x-pdf',
                            'application/msword',
                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                            'image/png',
                            'image/jpeg'
                        ),
                        'mimeTypesMessage'              => 'annulation.mimeTypesMessage',
                        'notFoundMessage'               => 'annulation.notFoundMessage',
                        'notReadableMessage'            => 'annulation.notReadableMessage',
                        'uploadIniSizeErrorMessage'     => 'annulation.uploadIniSizeErrorMessage',
                        'uploadFormSizeErrorMessage'    => 'annulation.uploadFormSizeErrorMessage',
                        'uploadErrorMessage'            => 'annulation.uploadErrorMessage',
                    ))
                )
            )
        );
        $builder->add('certifie', 'checkbox', array(
                'label'         => 'annulation.certifie.label',
                'mapped'        => false,
                'constraints'   => array(
                    new Assert\True(array(
                        'message' => 'annulation.certifie.true'
                    ))
                )
            )
        );
    }

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
        return 'Annulation';
    }
}
