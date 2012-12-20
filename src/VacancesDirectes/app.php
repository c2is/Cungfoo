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

/* S E C U R I T Y   M A N A G E R */
$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\SecurityServiceProvider());
$app['security.firewalls'] =  array(
    'compte' => array(
        'pattern' => '/compte/',
        'form'    => array(
            'always_use_default_target_path' => true,
            'default_target_path'            => '/compte/',
            'login_path'                     => '/compte/logout',
            'check_path'                     => '/compte/login_check'
        ),
        'logout' => array('logout_path' => '/compte/logout'),
        'users'  => $app->share(function() use ($app) {
            return new \Resalys\Model\UserIndivProvider($app);
        }),
    ),
);
$app['security.access_rules'] = array(
    array('^/compte/', 'ROLE_USER'),
);

$app['security.last_error'] = $app->protect(function (\Symfony\Component\HttpFoundation\Request $request) {
    $errorMessage = "Le login que vous avez saisi est incorrect.\nVeuillez réessayer (vérifiez que le verrouillage des majuscules est désactivé).";

    if ($request->attributes->has(\Symfony\Component\Security\Core\SecurityContextInterface::AUTHENTICATION_ERROR)) {
        return $errorMessage;
    }

    $session = $request->getSession();
    if ($session && $session->has(\Symfony\Component\Security\Core\SecurityContextInterface::AUTHENTICATION_ERROR)) {
        $session->remove(\Symfony\Component\Security\Core\SecurityContextInterface::AUTHENTICATION_ERROR);

        return $errorMessage;
    }
});

$app['security.encoder.digest'] = $app->share(function ($app) {
    return new \Symfony\Component\Security\Core\Encoder\PlaintextPasswordEncoder();
});

return $app;

