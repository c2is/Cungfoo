<?php

namespace VacancesDirectes\Widget;

use Symfony\Component\HttpFoundation\Request;

use Cungfoo\Model\BonPlanQuery,
    Cungfoo\Widget\AbstractWidget;

class OffresSpecialesWidget extends AbstractWidget
{
    protected function requiredParameters()
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
        $limit = (int) $this->app['request']->query->get('limit', 2);

        $bonsPlans = array();
        if ($etab)
        {
            $bonsPlans = BonPlanQuery::create()
                ->useBonPlanEtablissementQuery()
                    ->filterByEtablissementId($etab)
                ->endUse()
                ->addDateFilters()
                ->limit(2)
                ->findActive()
            ;
        }

        return $this->app['twig']->render('Widget\\offres_speciales.twig', array(
            'bonsPlans' => $bonsPlans
        ));
    }

    public function getMaxAge()
    {
        return $this->app['config']->get('vd_config')['httpcache']['short'];
    }
}