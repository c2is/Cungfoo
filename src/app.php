<?php

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\TranslationServiceProvider;
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

# ------------------------------- #
#  F O R M  E X T E N S I O N S   #
# ------------------------------- #
$app['form.extensions'] = $app->share($app->extend('form.extensions', function ($extensions) use ($app) {
    $extensions[] = new \Cungfoo\Form\CustomExtension();
    return $extensions;
}));

return $app;