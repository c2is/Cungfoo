<?php

namespace VacancesDirectes\Widget;

use Symfony\Component\HttpFoundation\Request;

use Cungfoo\Model\BonPlanQuery,
    Cungfoo\Widget\AbstractWidget;

class TrackingWidget extends AbstractWidget
{
    public function getName()
    {
        return 'tracking';
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
                ->filterByDateDebut(array('max' => 'today'))
                ->filterByDateFin(array('min' => 'today'))
                ->findActive()
            ;
        }

        return $this->app['twig']->render('Widget\\tracking.twig', array(
            'bonsPlans' => $bonsPlans
        ));
    }
}