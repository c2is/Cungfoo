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

/* T W I G  C O N F I G U R A T I O N  */
$app['twig.path'] = array(__DIR__.'/View');
$app['twig.form.templates'] = array('Form/form_custom_layout.html.twig');

/*  T R A N S L A T O R   M A N A G E R */
$app['translator'] = $app->share($app->extend('translator',
    function($translator, $app) {
        $translator->addLoader('yaml', new Symfony\Component\Translation\Loader\YamlFileLoader());
        foreach ($app['config']->get('languages') as $locale => $language)
        {
            $translator->addResource('yaml', sprintf('%s/Resalys/locales/%s.yml', $app['config']->get('config_dir'), $locale), $locale);
        }

        return $translator;
    }
));

return $app;

