<?php

namespace VacancesDirectes\Widget;

use Symfony\Component\HttpFoundation\Request;

use Cungfoo\Model\EtablissementQuery,
    Cungfoo\Widget\AbstractWidget;

class RelatedWidget extends AbstractWidget
{
    public function requiredParameters()
    {
        return array('etab');
    }

    public function getName()
    {
        return 'related';
    }

    public function render()
    {
        $etab = $this->app['request']->query->get('etab');

        $etabObj = EtablissementQuery::create()
            ->filterByCode($etab)
            ->findOne()
        ;

        $campings = array();
        if ($etabObj)
        {
            $campings = EtablissementQuery::create()
                ->filterById($etabObj->getRelated1())
                ->_or()
                ->filterById($etabObj->getRelated2())
                ->findActive()
            ;
        }

        return $this->app['twig']->render('Widget\\related.twig', array(
            'campings' => $campings
        ));
    }
}