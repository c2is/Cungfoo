<?php

namespace VacancesDirectes\Widget;

use Symfony\Component\HttpFoundation\Request;

use Cungfoo\Model\BonPlanQuery,
    Cungfoo\Widget\AbstractWidget;

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
                ->filterByDateDebut(array('max' => 'today'))
                ->filterByDateFin(array('min' => 'today'))
                ->findActive()
            ;
        }

        return $this->app['twig']->render('Widget\\offres_speciales.twig', array(
            'bonsPlans' => $bonsPlans
        ));
    }
}