<?php

namespace VacancesDirectesCe\Form\Type;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Cungfoo\Form\Type\AppAwareType;

class AchatLineaireType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nbAdultes', 'hidden', array(
            'required' => true,
        ));

        $builder->add('pays', 'model', array(
            'class' => 'Cungfoo\Model\Pays',
            'label' => 'Pays',
            'required' => false,
            'empty_value' => false
        ));

        $builder->add('region', 'model', array(
            'class' => 'Cungfoo\Model\Region',
            'label' => 'Region',
            'required' => false,
            'empty_value' => false,
        ));

        $builder->add('campings', 'model', array(
            'class' => 'Cungfoo\Model\Etablissement',
            'multiple'  => true,
            'label' => 'Campings',
            'required' => false,
            'empty_value' => false,
        ));

        $builder->add('dateDebut', 'text', array(
            'label' => 'Date de début',
            'required' => false,
        ));

        $builder->add('dateFin', 'text', array(
            'label' => 'Date de fin',
            'required' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'constraints' => new Assert\Callback(array('methods' => array('isValide')))
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'AchatLineaire';
    }

} // BaseActiviteType
