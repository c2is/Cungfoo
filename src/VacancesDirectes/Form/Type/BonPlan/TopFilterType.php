<?php

namespace VacancesDirectes\Form\Type\BonPlan;

use Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\Options,
    Symfony\Component\OptionsResolver\OptionsResolverInterface,
    Symfony\Component\Validator\Constraints as Assert;

use Symfony\Component\Validator\ExecutionContext;

use Cungfoo\Form\Type\AppAwareType,
    Cungfoo\Model\RegionQuery,
    Cungfoo\Model\BonPlanQuery;

class TopFilterType extends AppAwareType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $app = $this->getApplication();

        $category = $options['data'];

        $bonPlans = BonPlanQuery::create()
            ->orderByDateStart()
            ->filterByBonPlanCategorie($category)
            ->findActive()
        ;

        $bonsPlansChoices = array();
        foreach ($bonPlans as $bonPlan) {
            $bonsPlansChoices['dateCrit'.$bonPlan->getId()] = $app->trans('general.du').' '.$bonPlan->getDateStart('d/m/Y').' '.$app->trans('general.au').' '.date('d/m/Y', $bonPlan->getDateEnd());
        }

        $builder->add('bon_plans', 'choice', array(
            'choices'       => $bonsPlansChoices,
            'required'      => false,
            'label'         => 'top_filter.bon_plans',
            'empty_value'   => $app->trans('top_filter.all_bon_plans'),
            'property_path' => false,
        ));

        $regions = RegionQuery::create()
            ->useI18nQuery()
                ->orderByName()
            ->endUse()
            ->findActive()
        ;

        $regionsChoices = array();
        foreach ($regions as $region) {
            $regionsChoices['regCrit'.$region->getId()] = (string) $region;
        }

        $builder->add('regions', 'choice', array(
            'choices'       => $regionsChoices,
            'required'      => false,
            'label'         => 'top_filter.regions',
            'empty_value'   => $app->trans('top_filter.all_regions'),
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
