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
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\Routing\Loader\YamlFileLoader;

use Cungfoo\Lib\Crud\Router as CrudRouter;


$app->mount('/', new \VacancesDirectes\Controller\HomepageController());
$app->mount('/nos-destinations', new \VacancesDirectes\Controller\DestinationsController());
$app->mount('/les-locations', new \VacancesDirectes\Controller\LocationsController());
$app->mount('/les-bons-plans', new \VacancesDirectes\Controller\BonsPlansController());
$app->mount('/vos-vacances', new \VacancesDirectes\Controller\VacancesController());
$app->mount('/vos-week-ends', new \VacancesDirectes\Controller\WeekendsController());

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug'])
    {
        return;
    }

    $page = 404 == $code ? '404.twig' : '500.twig';

    return new Response($app['twig']->render($page, array('code' => $code)), $code);
});