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

use VacancesDirectes\Controller;

use Resalys\Controller\WrapperController;

$app->before(function(Request $request) use ($app) {
    // gestion de la remonté d'erreurs du formulaire de connexion à mon compte
    $app['login_errors'] = $app['security.last_error']($request);
});

$app->mount('/',                                      new Controller\HomepageController());
$app->mount('/',                                      new Controller\EditoController());
$app->mount('/menu',                                  new Controller\MenuController());
$app->mount('/camping',                               new Controller\CampingController());
$app->mount('/search_engine',                         new Controller\SearchEngineController());
$app->mount('/catalogue',                             new Controller\CatalogueController());
$app->mount('/dispo',                                 new Controller\DispoController());
$app->mount('/couloir-reservation',                   new Controller\CouloirController());
$app->mount('/resalys',                               new WrapperController());
$app->mount('/destinations/camping-{pays}',           new Controller\DestinationController());
$app->mount('/bons-plans/camping-dernieres-minutes',  new Controller\DernieresMinutesController());
$app->mount('/bons-plans/camping-early-booking',      new Controller\EarlyBookingController());
$app->mount('/bons-plans',                            new Controller\BonsPlansController());
$app->mount('/compte',                                new Controller\CompteController());
$app->mount('/vos-week-ends',                         new Controller\VosWeekEndsController());
$app->mount('/esi',                                   new Controller\EsiController());
//$app->mount('/assurance',                             new Controller\AnnulationController());

$app->match('/top-campings',      'VacancesDirectes\Controller\TopCampingController::indexAction')->bind('top_campings');

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug'])
    {
        return;
    }

    $page = 404 == $code ? '404.twig' : '500.twig';

    return new Response($app['twig']->render($page, array('code' => $code)), $code);
});
