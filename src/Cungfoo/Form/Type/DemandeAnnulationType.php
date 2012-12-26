<?php

namespace Cungfoo\Form\Type;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\Base\BaseDemandeAnnulationType,
    Cungfoo\Model\EtablissementQuery;

/**
 * Test class for Additional builder enabled on the 'demande_annulation' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Form.Type
 */
class DemandeAnnulationType extends BaseDemandeAnnulationType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

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

        $builder->add('etablissement', 'model', array(
                'label'             => 'demande_annulation.etablissement.label',
                'class'             => '\Cungfoo\Model\Etablissement',
                'empty_value'       => 'demande_annulation.etablissement.empty_value',
                'constraints'       => array(
                    new Assert\NotBlank(),
                ),
            )
        );
        $builder->add('assure_pays', 'choice', array(
                'label'         => 'demande_annulation.assure_pays.label',
                'choices'       => array_combine($formConfig['pays'], $formConfig['pays']),
                'empty_value'   => 'demande_annulation.assure_pays.empty_value',
                'constraints'   => array(
                    new Assert\NotBlank(array(
                        'message' => 'demande_annulation.assure_pays.not_blank'
                    )),
                    new Assert\Choice(array(
                        'choices' => $formConfig['pays'],
                        'message' => 'demande_annulation.assure_pays.choice'
                    ))
                )
            )
        );
        $builder->add('assure_mail', 'text', array(
                'label'         => 'demande_annulation.assure_mail.label',
                'constraints'   => array(
                    new Assert\NotBlank(array(
                        'message' => 'demande_annulation.assure_mail.not_blank'
                    )),
                    new Assert\Email(array(
                        'message' => 'demande_annulation.assure_mail.mail'
                    ))
                )
            )
        );
        $builder->add('sinistre_nature', 'choice', array(
                'label'         => 'demande_annulation.sinistre_nature.label',
                'choices'       => array_combine($formConfig['naturesSinistre'], $formConfig['naturesSinistre']),
                'expanded'      => true,
                'multiple'      => false,
                'constraints'   => array(
                    new Assert\NotBlank(array(
                        'message' => 'demande_annulation.sinistre_nature.not_blank'
                    )),
                    new Assert\Choice(array(
                        'choices' => array_values(array_flip($formConfig['naturesSinistre'])),
                        'message' => 'demande_annulation.sinistre_nature.choice'
                    ))
                )
            )
        );
        $builder->add('sinistre_suite', 'choice', array(
                'label'         => 'demande_annulation.sinistre_suite.label',
                'choices'       => array_combine($formConfig['suitesSinistre'], $formConfig['suitesSinistre']),
                'expanded'      => true,
                'multiple'      => false,
                'constraints'   => array(
                    new Assert\NotBlank(array(
                        'message' => 'demande_annulation.sinistre_suite.not_blank'
                    )),
                    new Assert\Choice(array(
                        'choices' => array_values(array_flip($formConfig['suitesSinistre'])),
                        'message' => 'demande_annulation.sinistre_suite.choice'
                    ))
                )
            )
        );
        $builder->add('file_1', 'file', array(
                'label'         => 'demande_annulation.file_1',
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
                        'mimeTypesMessage'              => 'demande_annulation.files.mimeTypesMessage',
                        'notFoundMessage'               => 'demande_annulation.files.notFoundMessage',
                        'notReadableMessage'            => 'demande_annulation.files.notReadableMessage',
                        'uploadIniSizeErrorMessage'     => 'demande_annulation.files.uploadIniSizeErrorMessage',
                        'uploadFormSizeErrorMessage'    => 'demande_annulation.files.uploadFormSizeErrorMessage',
                        'uploadErrorMessage'            => 'demande_annulation.files.uploadErrorMessage',
                    ))
                )
            )
        );
        $builder->add('file_2', 'file', array(
                'label'         => 'demande_annulation.file_2',
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
                        'mimeTypesMessage'              => 'demande_annulation.files.mimeTypesMessage',
                        'notFoundMessage'               => 'demande_annulation.files.notFoundMessage',
                        'notReadableMessage'            => 'demande_annulation.files.notReadableMessage',
                        'uploadIniSizeErrorMessage'     => 'demande_annulation.files.uploadIniSizeErrorMessage',
                        'uploadFormSizeErrorMessage'    => 'demande_annulation.files.uploadFormSizeErrorMessage',
                        'uploadErrorMessage'            => 'demande_annulation.files.uploadErrorMessage',
                    ))
                )
            )
        );
        $builder->add('file_3', 'file', array(
                'label'         => 'demande_annulation.file_3',
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
                        'mimeTypesMessage'              => 'demande_annulation.files.mimeTypesMessage',
                        'notFoundMessage'               => 'demande_annulation.files.notFoundMessage',
                        'notReadableMessage'            => 'demande_annulation.files.notReadableMessage',
                        'uploadIniSizeErrorMessage'     => 'demande_annulation.files.uploadIniSizeErrorMessage',
                        'uploadFormSizeErrorMessage'    => 'demande_annulation.files.uploadFormSizeErrorMessage',
                        'uploadErrorMessage'            => 'demande_annulation.files.uploadErrorMessage',
                    ))
                )
            )
        );
        $builder->add('file_4', 'file', array(
                'label'         => 'demande_annulation.file_4',
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
                        'mimeTypesMessage'              => 'demande_annulation.files.mimeTypesMessage',
                        'notFoundMessage'               => 'demande_annulation.files.notFoundMessage',
                        'notReadableMessage'            => 'demande_annulation.files.notReadableMessage',
                        'uploadIniSizeErrorMessage'     => 'demande_annulation.files.uploadIniSizeErrorMessage',
                        'uploadFormSizeErrorMessage'    => 'demande_annulation.files.uploadFormSizeErrorMessage',
                        'uploadErrorMessage'            => 'demande_annulation.files.uploadErrorMessage',
                    ))
                )
            )
        );
        $builder->add('certifie', 'checkbox', array(
                'label'         => 'demande_annulation.certifie.label',
                'mapped'        => false,
                'constraints'   => array(
                    new Assert\True(array(
                        'message' => 'demande_annulation.certifie.true'
                    ))
                )
            )
        );
    }

} // DemandeAnnulationType
