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
                'constraints'   => array(
                    new Assert\NotBlank()
                )
            )
        );
        $builder->add('prenomAssure', 'text', array(
                'constraints'   => array(
                    new Assert\NotBlank()
                )
            )
        );
        $builder->add('adresseAssure', 'text', array(
                'constraints'   => array(
                    new Assert\NotBlank()
                )
            )
        );
        $builder->add('codePostalAssure', 'text', array(
                'constraints'   => array(
                    new Assert\NotBlank()
                )
            )
        );
        $builder->add('villeAssure', 'text', array(
                'constraints'   => array(
                    new Assert\NotBlank()
                )
            )
        );
        $builder->add('paysAssure', 'choice', array(
                'choices'       => $formConfig['pays'],
                'constraints'   => array(
                    new Assert\NotBlank(),
                    new Assert\Choice(array(
                        'choices' => $formConfig['pays']
                    ))
                )
            )
        );
        $builder->add('emailAssure', 'text', array(
                'constraints'   => array(
                    new Assert\NotBlank(),
                    new Assert\Email()
                )
            )
        );
        $builder->add('telephone', 'text', array(
                'constraints'   => array(
                    new Assert\NotBlank()
                )
            )
        );
        $builder->add('montantSejourCamping', 'text', array(
                'constraints'   => array(
                    new Assert\NotBlank()
                )
            )
        );
        $builder->add('montantVerseCamping', 'text', array(
                'constraints'   => array(
                    new Assert\NotBlank()
                )
            )
        );
        $builder->add('nomCamping', 'choice', array(
                'choices'       => $campings,
                'constraints'   => array(
                    new Assert\NotBlank(),
                    new Assert\Choice(array(
                        'choices' => $campings
                    ))
                )
            )
        );
        $builder->add('departementCamping', 'text', array(
                'constraints'   => array(
                    new Assert\NotBlank()
                )
            )
        );
        $builder->add('numResaCamping', 'text', array(
                'constraints'   => array(
                    new Assert\NotBlank()
                )
            )
        );
        $builder->add('natureSinistre', 'choice', array(
                'choices'       => $formConfig['naturesSinistre'],
                'expanded'      => true,
                'multiple'      => false,
                'constraints'   => array(
                    new Assert\NotBlank(),
                    new Assert\Choice(array(
                        'choices' => $formConfig['naturesSinistre']
                    ))
                )
            )
        );
        $builder->add('suiteSinistre', 'choice', array(
                'choices'       => $formConfig['suitesSinistre'],
                'expanded'      => true,
                'multiple'      => false,
                'constraints'   => array(
                    new Assert\NotBlank(),
                    new Assert\Choice(array(
                        'choices' => $formConfig['suitesSinistre']
                    ))
                )
            )
        );
        $builder->add('dateSinistre', 'date', array(
                'widget'        => 'single_text',
                'input'         => 'string',
                'format'        => 'dd/MM/yyyy',
                'constraints'   => array(
                    new Assert\NotBlank(),
                    new Assert\Date()
                )
            )
        );
        $builder->add('resumeSinistre', 'textarea', array(
                'constraints'   => array(
                    new Assert\NotBlank()
                )
            )
        );
        $builder->add('piecesJointes', 'file', array(
                'constraints'   => array(
                    new Assert\NotBlank()
                )
            )
        );
        $builder->add('certifie', 'checkbox', array(
                'mapped'        => false,
                'constraints'   => array(
                    new Assert\True()
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
