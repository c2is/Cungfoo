<?php

/**
 * Définition des variables utilisé
 *
 * @var \Silex\Application $app
 */

// include the prod configuration
require __DIR__ . '/prod.php';

// enable the debug mode
$app['debug'] = true;

$app['twig']->enableAutoReload();
$app['twig']->enableDebug();