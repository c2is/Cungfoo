<?php

namespace VacancesDirectes\Widget;

use Symfony\Component\HttpFoundation\Request;

use Cungfoo\Model\BonPlanQuery;

class OffresSpecialesWidget extends AbstractWidget
{
    public function requiredParameters()
    {
        return array('etab');
    }

    public function getName()
    {
        return 'offres_speciales';
    }

    public function render()
    {
        $etab = (int) $this->app['request']->query->get('etab');

        $bonsPlans = array();
        if ($etab)
        {
            $bonsPlans = BonPlanQuery::create()
                ->useBonPlanEtablissementQuery()
                    ->filterByEtablissementId($etab)
                ->endUse()
                ->findActive()
            ;
        }

        return $this->app['twig']->render('Widget\\offres_speciales.twig', array(
            'bonsPlans' => $bonsPlans
        ));
    }
}