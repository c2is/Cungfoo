<?php

namespace VacancesDirectes\Lib;

use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use VacancesDirectes\Form\Type\Search\DateType,
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

    public function process()
    {
        $searchDateData = new DateData();
        $this->form = $this->app['form.factory']->create(new DateType($this->app), $searchDateData);

        if ('POST' == $this->request->getMethod())
        {
            $this->form->bind($this->request->get($this->form->getName()));

            if ($this->form->isValid())
            {
                if ($searchDateData->dateDebut && $searchDateData->dateFin)
                {
                    $dateDebut = \DateTime::createFromFormat('d/m/Y', $searchDateData->dateDebut);
                    $dateFin = \DateTime::createFromFormat('d/m/Y', $searchDateData->dateFin);

                    $this->redirect = $this->app['url_generator']->generate('dispo', array(
                        'large'       => $searchDateData->destination,
                        'small'       => $searchDateData->isCamping ? $searchDateData->camping : $searchDateData->ville,
                        'start_date'  => $dateDebut->format('Y-m-d'),
                        'end_date'    => $dateFin->format('Y-m-d'),
                        'nb_adults'   => $searchDateData->nbAdultes,
                        'nb_children' => $searchDateData->nbEnfants,
                    ));
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
