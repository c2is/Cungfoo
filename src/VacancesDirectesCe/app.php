<?php
/*
 * Configuration of our admin application
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 *
 * @package Cungfoo by C2IS
 */

// require default application configuration
$app = require_once __DIR__ . '/../../app/bootstrap.php';

$app['config']->addParams(array(
    'globale'  => Symfony\Component\Yaml\Yaml::parse(sprintf('%s/VacancesDirectesCe/config.yml', $app['config']->get('config_dir'))),
));

/* T W I G  C O N F I G U R A T I O N  */
$app['twig.path'] = array(__DIR__.'/View', __DIR__.'/../Cungfoo/View');

$app['translator'] = $app->share($app->extend('translator',
    function($translator, $app) {
        $translator->addLoader('yaml', new Symfony\Component\Translation\Loader\YamlFileLoader());
        $translator->addResource('yaml', sprintf('%s/Cungfoo/locales/fr.yml', $app['config']->get('config_dir')), 'fr');

        return $translator;
    }
));

$app->register(new \Silex\Provider\SwiftmailerServiceProvider());

$app['swiftmailer.options'] = array(
    'host' => $app['config']->get('settings')['smtp']['host'],
    'port' => $app['config']->get('settings')['smtp']['port'],
    'username' => $app['config']->get('settings')['smtp']['user'],
    'password' => $app['config']->get('settings')['smtp']['pass'],
    'encryption' => null,
    'auth_mode' => null
);


return $app;

