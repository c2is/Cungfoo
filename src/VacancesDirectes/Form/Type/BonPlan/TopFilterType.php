<?php

namespace VacancesDirectes\Form\Type\BonPlan;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Symfony\Component\Validator\ExecutionContext;

use Cungfoo\Form\Type\AppAwareType,
    Cungfoo\Model\BonPlanQuery;

class TopFilterType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $category = $options['data'];

        $bonPlansQuery = BonPlanQuery::create()
            ->filterByBonPlanCategorie($category)
        ;

        $builder->add('bon_plans', 'model', array(
            'required'      => false,
            'label'         => 'top_filter.bon_plans',
            'class'         => 'Cungfoo\Model\BonPlan',
            'query'         => $bonPlansQuery,
            'empty_value'   => false,
            'property_path' => false,
        ));

        $builder->add('regions', 'model', array(
            'required'      => false,
            'label'         => 'top_filter.regions',
            'class'         => 'Cungfoo\Model\Region',
            'empty_value'   => 'top_filter.all_regions',
            'property_path' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'TopFilter';
    }
}
