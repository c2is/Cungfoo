<?php

namespace VacancesDirectes\Widget;

use Symfony\Component\HttpFoundation\Request;

use Cungfoo\Model\EtablissementQuery,
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

        $trackingCamping = $this->app['session']->get('tracking.camping');
        if($etab && ($key = array_search($etab, $trackingCamping)) !== false) {
            unset($trackingCamping[$key]);
        }

        $campings = EtablissementQuery::create()
            ->filterByCode($trackingCamping, \Criteria::IN)
            ->findActive()
        ;

        return $this->app['twig']->render('Widget\\tracking.twig', array(
            'trackingCamping' => $campings
        ));
    }
}