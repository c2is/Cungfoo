<?php

namespace VacancesDirectes\Lib;

use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Cungfoo\Model\EtablissementQuery,
    Cungfoo\Model\VilleQuery,
    VacancesDirectes\Form\Type\Search\DateType,
    VacancesDirectes\Form\Data\Search\DateData;

class SearchEngine
{
    protected $app;
    protected $request;
    protected $redirect;
    protected $form;

    public function __construct(Application $app, Request $request)
    {
        $this->app     = $app;
        $this->request = $request;
    }

    public function process($dateData = null)
    {
        $searchDateData = new DateData();
        if($dateData !== null)
        {
            $searchDateData = $dateData;
        }

        // override la session passé en paramètre ($dateData)
        if ('POST' == $this->request->getMethod())
        {
            $searchDateQuery = $this->request->get('SearchDate');

            $searchDateData->destination = $searchDateQuery['destination'];
            $searchDateData->ville       = $searchDateQuery['ville'];
            $searchDateData->camping     = $searchDateQuery['camping'];
            $searchDateData->isCamping   = $searchDateQuery['isCamping'];
        }

        $this->form = $this->app['form.factory']->create(new DateType($this->app), $searchDateData);

        if ('POST' == $this->request->getMethod())
        {
            $this->form->bindRequest($this->request);
            $this->app['session']->set('search_engine_data', $this->form->getData());

            if ($this->form->isValid())
            {
                if ($searchDateData->destination == null && ($searchDateData->camping || $searchDateData->ville))
                {
                    if ($searchDateData->isCamping)
                    {
                        $camping = EtablissementQuery::create()
                            ->filterByCode($searchDateData->camping)
                            ->findOne()
                        ;

                        $searchDateData->destination = $camping->getRegion()->getCode();
                    }
                    else
                    {
                        $ville = VilleQuery::create()
                            ->filterByCode($searchDateData->ville)
                            ->findOne()
                        ;

                        $searchDateData->destination = $ville->getRegion()->getCode();
                    }

                    $this->app['session']->set('search_engine_data', $searchDateData);
                }

                if ($searchDateData->dateDebut && $searchDateData->nbJours)
                {
                    $dateDebut = \DateTime::createFromFormat('d/m/Y', $searchDateData->dateDebut);

                    $urlParams = array(
                        'large'       => $searchDateData->destination,
                        'start_date'  => $dateDebut->format('Y-m-d'),
                        'nb_days'     => $searchDateData->nbJours,
                        'nb_adults'   => $searchDateData->nbAdultes,
                        'nb_children' => $searchDateData->nbEnfants,
                    );

                    if ($searchDateData->camping || $searchDateData->ville)
                    {
                        $urlParams['small'] = $searchDateData->isCamping ? $searchDateData->camping : $searchDateData->ville;
                    }

                    $this->redirect = $this->app['url_generator']->generate('dispo', $urlParams);
                }
                else
                {
                    $this->redirect = $this->app['url_generator']->generate('catalogue', array(
                        'large' => $searchDateData->destination,
                        'small' => $searchDateData->isCamping ? $searchDateData->camping : $searchDateData->ville
                    ));
                }

                return true;
            }
        }

        return false;
    }

    public function getView()
    {
        return $this->form->createView();
    }

    public function getRedirect()
    {
        return $this->redirect;
    }
}
