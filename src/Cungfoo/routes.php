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

$app->get('/', function () use ($app) {
    return $app['twig']->render('admin.twig', array());
})
->bind('admin')
;

$app->get('/login', function(Request $request) use ($app) {
    return $app['twig']->render('login.twig', array(
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
    ));
});

$app->get('/generate-password', function (Request $request) use ($app) {
    $password = $request->query->get('password');
    if (!$password)
    {
        throw new \Exception("No 'password' parameter found.");
    }

    $user            = $app['security']->getToken()->getUser();
    $encoder         = $app['security.encoder_factory']->getEncoder($user);
    $encodedPassword = $encoder->encodePassword($password, $user->getSalt());

    return '<b>password : </b>'.$password.'<br /><b>encoded : </b>'.$encodedPassword;
});

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug'])
    {
        return;
    }

    switch ($code)
    {
        case 403:
            $page = '403.twig';
            break;
        case 404:
            $page = '404.twig';
            break;
        case 500:
            $page = '500.twig';
            break;
        default:
            $page = '404.twig';
            break;
    }

    return new Response($app['twig']->render($page, array('code' => $code)), $code);
});

$crudRouter = new CrudRouter();
$crudRouter->load(sprintf('%s/Cungfoo/crud.yml', $app['config']->get('config_dir')));
$crudController = $crudRouter->getController();

foreach ($crudRouter->getRoutes() as $name => $route)
{
    $app->mount($route['global_prefix'], new $crudController(
        $name, $route['model'], $route['form'], $route['prefix']
    ));
}

$app->mount('/resalys', new \Cungfoo\Controller\ResalysController());
$app->mount('/viafrance', new \Cungfoo\Controller\ViaFranceController());
$app->mount('/jobs', new \Cungfoo\Controller\JobController());
$app->mount('/portfolio', new \Cungfoo\Controller\PortfolioController());
$app->mount('/i18n', new \Cungfoo\Controller\I18nController());
$app->mount('/purge', new \Cungfoo\Controller\PurgeController());
