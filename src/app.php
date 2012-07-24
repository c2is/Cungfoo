<?php

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Propel\Silex\PropelServiceProvider;

$app = new Application();

$app['config.root-dir'] = pathinfo(__DIR__)['dirname'];

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

return $app;