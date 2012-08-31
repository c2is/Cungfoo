<?php
/*
 * Configuration of our application
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 *
 * @package Cungfoo by C2IS
 */

$app = new Silex\Application();

$app['config'] = $app->share(function() {
    return new \Cungfoo\Lib\Config(dirname(__DIR__));
});

$app['config']->addParams(array(
    'languages'     => Symfony\Component\Yaml\Yaml::parse(sprintf('%s/languages.yml', $app['config']->get('config_dir')))['languages'],
    'dimensions'    => Symfony\Component\Yaml\Yaml::parse(sprintf('%s/dimensions.yml', $app['config']->get('config_dir')))['dimensions'],
));

/* T W I G  C O N F I G U R A T I O N  */
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

/* P R O P E L   C O N F I G U R A T I O N  */
$app->register(new Propel\Silex\PropelServiceProvider(), array(
    'propel.config_file' => $app['config']->get('config_dir').'/Propel/generated/Cungfoo-conf.php',
    'propel.model_path' => $app['config']->get('root_dir').'/src'
));

$app->register(new Silex\Provider\SessionServiceProvider(), array(
    'session.storage.options' => array('auto_start' => true)
));

/* S O M E   S E R V I C E   P R O V I D E R */
$app->register(new Silex\Provider\FormServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider());
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\ValidatorServiceProvider());

/* F O R M  E X T E N S I O N S  */
$app['form.extensions'] = $app->share($app->extend('form.extensions', function ($extensions) use ($app) {
    $extensions[] = new \Cungfoo\Form\CustomExtension();

    return $extensions;
}));

return $app;
