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

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug'])
    {
        return;
    }

    $page = 404 == $code ? '404.twig' : '500.twig';

    return new Response($app['twig']->render($page, array('code' => $code)), $code);
});