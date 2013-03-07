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
    'vd_menu'    => Symfony\Component\Yaml\Yaml::parse(sprintf('%s/VacancesDirectes/menu.yml', $app['config']->get('config_dir'))),
    'vd_config'  => Symfony\Component\Yaml\Yaml::parse(sprintf('%s/VacancesDirectes/config.yml', $app['config']->get('config_dir'))),
    'rsl_config' => Symfony\Component\Yaml\Yaml::parse(sprintf('%s/Resalys/client.yml', $app['config']->get('config_dir'))),
));

/* T W I G  C O N F I G U R A T I O N  */
$app['twig.path'] = array(__DIR__.'/View');
$app['twig.form.templates'] = array('Form/form_custom_layout.html.twig');

$app['twig']->getExtension('core')->setNumberFormat(0, '', '');

/*  T R A N S L A T O R   M A N A G E R */
$app['translator'] = $app->share($app->extend('translator',
    function($translator, $app) {
        $translator->addLoader('yaml', new Symfony\Component\Translation\Loader\YamlFileLoader());
        foreach ($app['config']->get('languages') as $locale => $language)
        {
            $translator->addResource('yaml', sprintf('%s/VacancesDirectes/locales/%s.yml', $app['config']->get('config_dir'), $locale), $locale);
        }

        return $translator;
    }
));

$app->register(new \Silex\Provider\SwiftmailerServiceProvider());

$app['swiftmailer.options'] = array(
    'host' => 'smtp.teaser.net',
    'port' => '587',
    'username' => 'serveurs@c2is.fr',
    'password' => 'RiiU879kH',
    'encryption' => null,
    'auth_mode' => null
);

$app->after(function (Symfony\Component\HttpFoundation\Request $request, Symfony\Component\HttpFoundation\Response $response) use ($app) {
    if ($tagUci = $request->query->get('tag_uci')) {
        $dateTime = new \DateTime();
        $dateTime->modify('+4 days');
        $cookie = new Symfony\Component\HttpFoundation\Cookie('vd_tag_uci', $tagUci, $dateTime);

        $response->headers->setCookie($cookie);
    }
});

return $app;

