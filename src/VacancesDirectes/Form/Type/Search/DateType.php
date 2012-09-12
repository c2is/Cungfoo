<?php

namespace VacancesDirectes\Form\Type\Search;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Symfony\Component\Validator\ExecutionContext;

use Cungfoo\Form\Type\AppAwareType;

class DateType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('date', 'date', array(
            'label' => 'date_search.date',
            'required' => false,
        ));

        $builder->add('destination', 'model', array(
            'class'     => 'Cungfoo\Model\Region',
            'group_by'  => 'pays.name',
            'label'     => 'date_search.destination',
            'required'  => false,
        ));

        $builder->add('ville', 'model', array(
            'class'     => 'Cungfoo\Model\Ville',
            'label'     => 'date_search.ville',
            'required'  => false,
        ));

        $builder->add('camping', 'model', array(
            'class'     => 'Cungfoo\Model\Etablissement',
            'label'     => 'date_search.camping',
            'required'  => false,
        ));

        $builder->add('nbAdultes', 'integer', array(
            'label'     => 'date_search.nb_adultes',
            'required'  => false,
        ));

        $builder->add('nbEnfants', 'integer', array(
            'label'     => 'date_search.nb_enfants',
            'required'  => false,
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
        return 'SearchDate';
    }
}
