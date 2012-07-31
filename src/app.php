<?php

use Silex\Application;

use Silex\Provider\TwigServiceProvider,
    Silex\Provider\UrlGeneratorServiceProvider,
    Silex\Provider\ValidatorServiceProvider,
    Silex\Provider\FormServiceProvider,
    Silex\Provider\TranslationServiceProvider,
    Silex\Provider\SecurityServiceProvider,
    Silex\Provider\SessionServiceProvider;

use Propel\Silex\PropelServiceProvider;

$app = new Application();

$app['config.root-dir'] = pathinfo(__DIR__)['dirname'];

$app->register(new FormServiceProvider());
$app->register(new TranslationServiceProvider());
$app->register(new UrlGeneratorServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new TwigServiceProvider(), array(
    'twig.path'    => array($app['config.root-dir'].'/templates'),
    'twig.options' => array('cache' => $app['config.root-dir'].'/cache'),
));

$app['twig'] = $app->share($app->extend('twig', function($twig, $app) {
    // add custom globals, filters, tags, ...
    return $twig;
}));

$app->register(new PropelServiceProvider(), array(
    'propel.config_file' => $app['config.root-dir'].'/config/Propel/generated/Cungfoo-conf.php',
    'propel.model_path' => $app['config.root-dir'].'/src'
));

$app['twig_collection_parser'] = new Cungfoo\Parser\TwigCollectionParser();
$app['twig_object_parser'] = new Cungfoo\Parser\TwigObjectParser();

$app->register(new SecurityServiceProvider(), array(
    'security.firewalls' => array(
        'admin_login' => array(
            'pattern' => '^/admin/login$',
        ),
        'admin' => array(
            'pattern'   => '^/admin',
            'form'      => array('login_path' => '/admin/login', 'check_path' => '/admin/login_check'),
            'logout'    => array('logout_path' => '/admin/logout'),
            'users'     => array(
                'admin' => array('ROLE_ADMIN', 'nhDr7OyKlXQju+Ge/WKGrPQ9lPBSUFfpK+B1xqx/+8zLZqRNX0+5G1zBQklXUFy86lCpkAofsExlXiorUcKSNQ=='),
            )
        )
    )
));

$app->register(new SessionServiceProvider(), array(
    'session.storage.options' => array('auto_start' => true)
));

# ------------------------------- #
#  F O R M  E X T E N S I O N S   #
# ------------------------------- #
$app['form.extensions'] = $app->share($app->extend('form.extensions', function ($extensions) use ($app) {
    $extensions[] = new \Cungfoo\Form\CustomExtension();
    return $extensions;
}));

return $app;