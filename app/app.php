<?php
/**
 * Configuration of our application
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 *
 * @package Cungfoo by C2IS
 */

$app = new Silex\Application();

$app['config'] = function() {
    return new \Cungfoo\Lib\Config(dirname(__DIR__));
};

# ------------------------------------ #
#  T W I G  C O N F I G U R A T I O N  #
# ------------------------------------ #
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path'             => array($app['config']->get('root_dir').'/app/resources/views'),
    'twig.options'          => array('cache' => $app['config']->get('root_dir').'/app/cache'),
    'twig.form.templates'   => array('/Cungfoo/Form/form_custom_layout.html.twig'),
));

$app['twig'] = $app->share($app->extend('twig', function($twig, $app) {
    $twig->addExtension(new \Cungfoo\Lib\Twig\Extension\AssetExtension($app));
    return $twig;
}));

$app['twig_collection_parser'] = new Cungfoo\Lib\Parser\TwigCollectionParser();
$app['twig_object_parser'] = new Cungfoo\Lib\Parser\TwigObjectParser();

# ----------------------------------------- #
#  P R O P E L   C O N F I G U R A T I O N  #
# ----------------------------------------- #
$app->register(new Propel\Silex\PropelServiceProvider(), array(
    'propel.config_file' => $app['config']->get('config_dir').'/Propel/generated/Cungfoo-conf.php',
    'propel.model_path' => $app['config']->get('root_dir').'/src'
));

# --------------------------------- #
#  S E C U R I T Y   M A N A G E R  #
# --------------------------------- #
$app->register(new Silex\Provider\SecurityServiceProvider(), array(
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

$app->register(new Silex\Provider\SessionServiceProvider(), array(
    'session.storage.options' => array('auto_start' => true)
));

# ------------------------------------------- #
#  S O M E   S E R V I C E   P R O V I D E R  #
# ------------------------------------------- #
$app->register(new Silex\Provider\FormServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider());
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\ValidatorServiceProvider());

# ------------------------------- #
#  F O R M  E X T E N S I O N S   #
# ------------------------------- #
$app['form.extensions'] = $app->share($app->extend('form.extensions', function ($extensions) use ($app) {
    $extensions[] = new \Cungfoo\Form\CustomExtension();
    return $extensions;
}));

# ------------------------------------- #
#  T R A N S L A T O R   M A N A G E R  #
# ------------------------------------- #
$app['translator'] = $app->share($app->extend('translator', function($translator, $app) {
    $translator->addLoader('yaml', new Symfony\Component\Translation\Loader\YamlFileLoader());
    foreach ($app['config']->get('languages')['languages'] as $locale => $language) {
        $translator->addResource('yaml', sprintf('%s/Cungfoo/locales/%s.yml', $app['config']->get('config_dir'), $locale), $locale);
    }

    return $translator;
}));

return $app;

