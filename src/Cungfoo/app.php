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
$app = require_once __DIR__.'/../../app/bootstrap.php';

$app['config']->addParams(array(
    'cungfoo_menu'  => Symfony\Component\Yaml\Yaml::parse(sprintf('%s/Cungfoo/menu.yml', $app['config']->get('config_dir')))['menu'],
));

/* S E C U R I T Y   M A N A G E R */
$app->register(new Silex\Provider\SecurityServiceProvider(), array(
    'security.firewalls' => array(
        'admin_login' => array(
            'pattern' => '^/login$',
        ),
        'admin' => array(
            'pattern'   => '/',
            'form'      => array('login_path' => '/login', 'check_path' => '/login_check'),
            'logout'    => array('logout_path' => '/logout'),
            'users'     => array(
                'admin' => array('ROLE_ADMIN', 'nhDr7OyKlXQju+Ge/WKGrPQ9lPBSUFfpK+B1xqx/+8zLZqRNX0+5G1zBQklXUFy86lCpkAofsExlXiorUcKSNQ=='),
            )
        )
    )
));

/*  T R A N S L A T O R   M A N A G E R */
$app['translator'] = $app->share($app->extend('translator',
    function($translator, $app) {
        $translator->addLoader('yaml', new Symfony\Component\Translation\Loader\YamlFileLoader());
        foreach ($app['config']->get('languages') as $locale => $language)
        {
            $translator->addResource('yaml', sprintf('%s/Cungfoo/locales/%s.yml', $app['config']->get('config_dir'), $locale), $locale);
        }

        return $translator;
    }
));

return $app;

