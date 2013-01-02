<?php

namespace VacancesDirectes\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\Routing\Route;

use Cungfoo\Model\EtablissementQuery,
    Cungfoo\Model\DernieresMinutesQuery;

use VacancesDirectes\Lib\Listing,
    VacancesDirectes\Lib\SearchEngine,
    VacancesDirectes\Lib\SearchParams,
    VacancesDirectes\Lib\Listing\DispoListing;

use Resalys\Lib\Client\DisponibiliteClient;

class EarlyBookingController implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->match('/', function (Application $app, Request $request) {

            $searchEngine = new SearchEngine($app, $request);
            $searchEngine->process();
            if ($searchEngine->getRedirect())
            {
                return $app->redirect($searchEngine->getRedirect());
            }

            $dernieresMinutes = DernieresMinutesQuery::create()
                ->findOne()
            ;

            $baseDate  = $dernieresMinutes->getDateStart('U') ?: date('U');
            $startDate = strtotime('next ' . $dernieresMinutes->getDayStart(), $baseDate);
            $startDate = strtotime('+' . ($dernieresMinutes->getDayRange() - 7) . ' days', $startDate);

            $searchParams = new SearchParams($app);
            $searchParams
                ->setStartDate(date('Y-m-d', $startDate))
                ->setNbDays(7)
                ->addTheme($dernieresMinutes->getDestinationsCodes())
                ->addEtab($dernieresMinutes->getEtablissementsCodes())
                ->setNbAdults(1)
                ->setMaxResults(50)
            ;

            $client = new DisponibiliteClient($app['config']->get('root_dir'));
            $client->addOptions($searchParams->generate());

            $listing = new DispoListing($app);
            $listing->setClient($client);

            $listingContent = $listing->process();

            return $app->renderView('Research\dispo.twig', array(
                'title'           => $app->trans('seo.title.early_booking'),
                'metaDescription' => $app->trans('seo.meta.early_booking'),
                'texteOffre'      => $app->trans('offreSpeciales.texte'),
                'intro'      => $app->trans('offreSpeciales.intro'),
                'h1' => $app->trans('earlyBooking.h1'),
                'list'            => $listingContent,
                'firstEtab'       => reset($listingContent['element']),
                'searchForm'      => $searchEngine->getView(),
            ));
        })
        ->bind('early_booking');

        return $controllers;
    }
}
