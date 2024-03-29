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
        $etab = $this->app['request']->query->get('etab');
        $limit = min((int) $this->app['request']->query->get('limit', 2), 5);

        $campings = array();
        $trackingCamping = unserialize($this->app['request']->cookies->get('tracking'));

        $nbTrackingCamping = count($trackingCamping);
        for($i = 0; $i < $nbTrackingCamping && count($campings) < 2 && count($campings) < $limit; $i++) {
            if (!$etab || $trackingCamping[$i] != $etab)
            {
                $camping = EtablissementQuery::create()
                    ->filterByCode($trackingCamping[$i])
                    ->filterByActive(true)
                    ->findOne()
                ;

                if ($camping)
                {
                    $campings[] = $camping;
                }
            }
        }

        return $this->app['twig']->render('Widget\\tracking.twig', array(
            'campings' => $campings
        ));
    }
}