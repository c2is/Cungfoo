<?php
/**
 * Configuration of our application routing
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 *
 * @package Cungfoo by C2IS
 */

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Component\HttpFoundation\JsonResponse,
    Symfony\Component\HttpFoundation\RedirectResponse,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Cungfoo\Lib\Crud\Router as CrudRouter;
use Cungfoo\Form\Type\NewsletterType;
use Cungfoo\Model\Newsletter;

use VacancesDirectes\Controller;

use Resalys\Controller\WrapperController;

$app->before(function(Request $request) use ($app) {
    // gestion de la remonté d'erreurs du formulaire de connexion à mon compte
    $app['login_errors'] = $app['security.last_error']($request);

    // adding newsletter form on global template
    $newsletterObject = new Newsletter();
    $newsletterForm = $app['form.factory']->create(new NewsletterType($app), $newsletterObject);
    $app['twig']->addGlobal('newsletter_form', $newsletterForm->createView());
});


$app->mount('/',                                          new Controller\HomepageController());
$app->mount('/',                                          new Controller\EditoController());
$app->mount('/esi',                                       new Controller\EsiController());
$app->mount('/menu',                                      new Controller\MenuController());
$app->mount('/session',                                   new Controller\SessionController());
$app->mount('/resalys',                                   new WrapperController());
$app->mount('/camping',                                   new Controller\CampingController());
$app->mount('/search_engine',                             new Controller\SearchEngineController());
$app->mount('/search_filter',                             new Controller\SearchFilterController());
$app->mount('/api',                                       new Controller\ApiController());
$app->mount('/widget',                                    new Cungfoo\Controller\WidgetController());
$app->mount('/async',                                     new Controller\AsyncController());
$app->mount('/extra',                                     new Controller\ExtraController());
$app->mount('/' . $app->trans('seo.url.catalogue'),       new Controller\CatalogueController());
$app->mount('/' . $app->trans('seo.url.dispo'),           new Controller\DispoController());
$app->mount('/' . $app->trans('seo.url.couloir.index'),   new Controller\CouloirController());
$app->mount('/' . $app->trans('seo.url.bonsplans'),       new Controller\BonsPlansController());
$app->mount('/' . $app->trans('seo.url.compte.index'),    new Controller\CompteController());
$app->mount('/' . $app->trans('seo.url.weekends'),        new Controller\VosWeekEndsController());
$app->mount('/' . $app->trans('seo.url.lieuVisiter'),     new Controller\FichePOIController());
$app->mount('/' . $app->trans('seo.url.evenement'),       new Controller\FicheEventController());
$app->mount('/' . $app->trans('seo.url.assurance.index'), new Controller\AnnulationController());
$app->mount('/' . $app->trans('seo.url.locations'),       new Controller\LocationsController());
$app->mount('/' . $app->trans('seo.url.destinations') . '/' . $app->trans('seo.url.prefix') . '-region', new Controller\RegionController());
$app->mount('/' . $app->trans('seo.url.destinations') . '/' . $app->trans('seo.url.prefix') . '-departement', new Controller\DepartementController());
$app->mount('/' . $app->trans('seo.url.destinations'), new Controller\DestinationController());
$app->match('/' . $app->trans('seo.url.topCampings'), 'VacancesDirectes\Controller\TopCampingController::indexAction')->bind('top_campings');

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug'])
    {
        return;
    }

    $page = 404 == $code ? '404.twig' : '500.twig';

    return new Response($app['twig']->render($page, array('code' => $code)), $code);
});
