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

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug'])
    {
        return;
    }

    $page = 404 == $code ? '404.twig' : '500.twig';

    return new Response($app['twig']->render($page, array('code' => $code)), $code);
});

$app->get('/login', function(Request $request) use ($app) {
    return $app['twig']->render('login.twig', array(
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
    ));
})
->bind('login')
;

$app->get('/', function(Request $request) use ($app) {
    return $app->redirect($app['url_generator']->generate('achat_packages'));
})
->bind('homepage')
;

$app->mount('/resalys', new \Resalys\Controller\WrapperController());
$app->mount('/achat', new \VacancesDirectesCe\Controller\AchatController());
$app->mount('/camping', new \VacancesDirectesCe\Controller\CampingController());