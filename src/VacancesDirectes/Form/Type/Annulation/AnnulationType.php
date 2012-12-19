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

        $builder->add('nomAssure', 'text', array(
                'label'         => 'annulation.nomAssure.label',
                'constraints'   => array(
                    new Assert\NotBlank(array(
                        'message' => 'annulation.nomAssure.not_blank'
                    ))
                )
            )
        );
        $builder->add('prenomAssure', 'text', array(
                'label'         => 'annulation.prenomAssure.label',
                'constraints'   => array(
                    new Assert\NotBlank(array(
                        'message' => 'annulation.prenomAssure.not_blank'
                    ))
                )
            )
        );
        $builder->add('adresseAssure', 'text', array(
                'label'         => 'annulation.adresseAssure.label',
                'constraints'   => array(
                    new Assert\NotBlank(array(
                        'message' => 'annulation.adresseAssure.not_blank'
                    ))
                )
            )
        );
        $builder->add('codePostalAssure', 'text', array(
                'label'         => 'annulation.codePostalAssure.label',
                'constraints'   => array(
                    new Assert\NotBlank(array(
                        'message' => 'annulation.codePostalAssure.not_blank'
                    ))
                )
            )
        );
        $builder->add('villeAssure', 'text', array(
                'label'         => 'annulation.villeAssure.label',
                'constraints'   => array(
                    new Assert\NotBlank(array(
                        'message' => 'annulation.villeAssure.not_blank'
                    ))
                )
            )
        );
        $builder->add('paysAssure', 'choice', array(
                'label'         => 'annulation.paysAssure.label',
                'choices'       => $formConfig['pays'],
                'empty_value'   => 'annulation.paysAssure.empty_value',
                'constraints'   => array(
                    new Assert\NotBlank(array(
                        'message' => 'annulation.paysAssure.not_blank'
                    )),
                    new Assert\Choice(array(
                        'choices' => $formConfig['pays'],
                        'message' => 'annulation.paysAssure.choice'
                    ))
                )
            )
        );
        $builder->add('emailAssure', 'text', array(
                'label'         => 'annulation.emailAssure.label',
                'constraints'   => array(
                    new Assert\NotBlank(array(
                        'message' => 'annulation.emailAssure.not_blank'
                    )),
                    new Assert\Email(array(
                        'message' => 'annulation.emailAssure.email'
                    ))
                )
            )
        );
        $builder->add('telephone', 'text', array(
                'label'         => 'annulation.telephone.label',
                'constraints'   => array(
                    new Assert\NotBlank(array(
                        'message' => 'annulation.telephone.not_blank'
                    ))
                )
            )
        );
        $builder->add('montantSejourCamping', 'text', array(
                'label'         => 'annulation.montantSejourCamping.label',
                'constraints'   => array(
                    new Assert\NotBlank(array(
                        'message' => 'annulation.montantSejourCamping.not_blank'
                    ))
                )
            )
        );
        $builder->add('montantVerseCamping', 'text', array(
                'label'         => 'annulation.montantVerseCamping.label',
                'constraints'   => array(
                    new Assert\NotBlank(array(
                        'message' => 'annulation.montantVerseCamping.not_blank'
                    ))
                )
            )
        );
        $builder->add('nomCamping', 'choice', array(
                'label'         => 'annulation.nomCamping.label',
                'choices'       => $campings,
                'empty_value'   => 'annulation.nomCamping.empty_value',
                'constraints'   => array(
                    new Assert\NotBlank(array(
                        'message' => 'annulation.nomCamping.not_blank'
                    )),
                    new Assert\Choice(array(
                        'choices' => array_values(array_flip($campings)),
                        'message' => 'annulation.nomCamping.choice'
                    ))
                )
            )
        );
        $builder->add('departementCamping', 'text', array(
                'label'         => 'annulation.departementCamping.label',
                'constraints'   => array(
                    new Assert\NotBlank(array(
                        'message' => 'annulation.departementCamping.not_blank'
                    ))
                )
            )
        );
        $builder->add('numResaCamping', 'text', array(
                'label'         => 'annulation.numResaCamping.label',
                'constraints'   => array(
                    new Assert\NotBlank(array(
                        'message' => 'annulation.numResaCamping.not_blank'
                    ))
                )
            )
        );
        $builder->add('natureSinistre', 'choice', array(
                'label'         => 'annulation.natureSinistre.label',
                'choices'       => $formConfig['naturesSinistre'],
                'expanded'      => true,
                'multiple'      => false,
                'constraints'   => array(
                    new Assert\NotBlank(array(
                        'message' => 'annulation.natureSinistre.not_blank'
                    )),
                    new Assert\Choice(array(
                        'choices' => array_values(array_flip($formConfig['naturesSinistre'])),
                        'message' => 'annulation.natureSinistre.choice'
                    ))
                )
            )
        );
        $builder->add('suiteSinistre', 'choice', array(
                'label'         => 'annulation.suiteSinistre.label',
                'choices'       => $formConfig['suitesSinistre'],
                'expanded'      => true,
                'multiple'      => false,
                'constraints'   => array(
                    new Assert\NotBlank(array(
                        'message' => 'annulation.suiteSinistre.not_blank'
                    )),
                    new Assert\Choice(array(
                        'choices' => array_values(array_flip($formConfig['suitesSinistre'])),
                        'message' => 'annulation.suiteSinistre.choice'
                    ))
                )
            )
        );
        $builder->add('dateSinistre', 'date', array(
                'label'         => 'annulation.dateSinistre.label',
                'widget'        => 'single_text',
                'input'         => 'string',
                'format'        => 'dd/MM/yyyy',
                'constraints'   => array(
                    new Assert\NotBlank(array(
                        'message' => 'annulation.dateSinistre.not_blank'
                    )),
                    new Assert\Date(array(
                        'message' => 'annulation.dateSinistre.date'
                    ))
                )
            )
        );
        $builder->add('resumeSinistre', 'textarea', array(
                'label'         => 'annulation.resumeSinistre.label',
                'constraints'   => array(
                    new Assert\NotBlank(array(
                        'message' => 'annulation.resumeSinistre.not_blank'
                    ))
                )
            )
        );
        $builder->add('piecesJointes', 'collection', array(
                'type'       => 'file',
                'allow_add'  => true,
                'prototype'  => true,
                'required'   => false,
                'attr'       => array(
                    'accept' => 'image/*',
                    'required'   => false,
                ),
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
            'data_class' => 'VacancesDirectes\Form\Data\Annulation\AnnulationData',
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
