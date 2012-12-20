<?php

/**
 * Définition des variables utilisé
 *
 * @var \Silex\Application $app
 */

use Silex\Provider\MonologServiceProvider;

// include the prod configuration
require __DIR__ . '/prod.php';

// enable the debug mode
$app['debug'] = true;

$app->register(new MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__.'/../logs/cungfoo.log',
));

$app['monolog.name'] = 'Cungfoo';

$app['twig']->enableAutoReload();
$app['twig']->enableDebug();