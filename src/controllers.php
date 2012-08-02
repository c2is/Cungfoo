<?php

/**
 * Définition des variables utilisé
 *
 * @var \Silex\Application $app
 */

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Component\HttpFoundation\JsonResponse,
    Symfony\Component\HttpFoundation\RedirectResponse,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\Routing\Loader\YamlFileLoader;

use Cungfoo\Lib\Crud\Router as CrudRouter;

$app->get('/', function () use ($app) {
    return $app['twig']->render('index.twig', array());
})
->bind('homepage')
;

$app->get('/admin', function () use ($app) {
    return $app['twig']->render('Cungfoo/admin.twig', array());
})
->bind('admin')
;

$app->get('/admin/login', function(Request $request) use ($app) {
    return $app['twig']->render('Cungfoo/login.twig', array(
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
    ));
});

$app->get('/admin/generate-password', function (Request $request) use ($app) {
    $password = $request->query->get('password');
    if(!$password)
    {
        throw new \Exception("No 'password' parameter found.");
    }

    $user            = $app['security']->getToken()->getUser();
    $encoder         = $app['security.encoder_factory']->getEncoder($user);
    $encodedPassword = $encoder->encodePassword($password, $user->getSalt());

    return '<b>password : </b>'.$password.'<br /><b>encoded : </b>'.$encodedPassword;
});

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    $page = 404 == $code ? 'Cungfoo/404.twig' : 'Cungfoo/500.twig';

    return new Response($app['twig']->render($page, array('code' => $code)), $code);
});

$crudRouter = new CrudRouter();
$crudRouter->load(sprintf('%s/config/Cungfoo/crud.yml', $app['config']->get('root_dir')));
$crudController = $crudRouter->getController();

foreach ($crudRouter->getRoutes() as $name => $route)
{
    $app->mount($route['prefix'], new $crudController(
        $name, $route['model'], $route['form']
    ));
}