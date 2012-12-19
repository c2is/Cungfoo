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

        $builder->add('assure_pays', 'choice', array(
                'label'         => 'annulation.assure_pays.label',
                'choices'       => array_combine($formConfig['pays'], $formConfig['pays']),
                'empty_value'   => 'annulation.assure_pays.empty_value',
                'constraints'   => array(
                    new Assert\NotBlank(array(
                        'message' => 'annulation.assure_pays.not_blank'
                    )),
                    new Assert\Choice(array(
                        'choices' => $formConfig['pays'],
                        'message' => 'annulation.assure_pays.choice'
                    ))
                )
            )
        );
        $builder->add('assure_mail', 'text', array(
                'label'         => 'annulation.assure_mail.label',
                'constraints'   => array(
                    new Assert\NotBlank(array(
                        'message' => 'annulation.assure_mail.not_blank'
                    )),
                    new Assert\Email(array(
                        'message' => 'annulation.assure_mail.mail'
                    ))
                )
            )
        );
        $builder->add('sinistre_nature', 'choice', array(
                'label'         => 'annulation.sinistre_nature.label',
                'choices'       => array_combine($formConfig['naturesSinistre'], $formConfig['naturesSinistre']),
                'expanded'      => true,
                'multiple'      => false,
                'constraints'   => array(
                    new Assert\NotBlank(array(
                        'message' => 'annulation.sinistre_nature.not_blank'
                    )),
                    new Assert\Choice(array(
                        'choices' => array_values(array_flip($formConfig['naturesSinistre'])),
                        'message' => 'annulation.sinistre_nature.choice'
                    ))
                )
            )
        );
        $builder->add('sinistre_suite', 'choice', array(
                'label'         => 'annulation.sinistre_suite.label',
                'choices'       => array_combine($formConfig['suitesSinistre'], $formConfig['suitesSinistre']),
                'expanded'      => true,
                'multiple'      => false,
                'constraints'   => array(
                    new Assert\NotBlank(array(
                        'message' => 'annulation.sinistre_suite.not_blank'
                    )),
                    new Assert\Choice(array(
                        'choices' => array_values(array_flip($formConfig['suitesSinistre'])),
                        'message' => 'annulation.sinistre_suite.choice'
                    ))
                )
            )
        );
        $builder->add('file_1', 'file', array(
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
        $builder->add('file_2', 'file', array(
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
        $builder->add('file_3', 'file', array(
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
        $builder->add('file_4', 'file', array(
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

} // DemandeAnnulationType
