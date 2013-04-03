<?php
/*
 * Configuration of our application
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 *
 * @package Cungfoo by C2IS
 */

$app = new Cungfoo\Application();

$app['config'] = $app->share(function() {
    return new \Cungfoo\Lib\Config(dirname(__DIR__));
});

$app['config']->addParams(array(
    'web_dir'   => sprintf('%s/web', $app['config']->get('root_dir')),
    'languages' => Symfony\Component\Yaml\Yaml::parse(sprintf('%s/languages.yml', $app['config']->get('config_dir')))['languages'],
    'version'   => trim(file_get_contents(sprintf('%s/version', $app['config']->get('config_dir')))),
    'security'  => new Cungfoo\Lib\Crud\Security($app),
));
if (file_exists(sprintf('%s/memcache.yml', $app['config']->get('config_dir')))) {
    $app['config']->addParam('memcache', Symfony\Component\Yaml\Yaml::parse(sprintf('%s/memcache.yml', $app['config']->get('config_dir')))['memcache']);
}

/* T W I G  C O N F I G U R A T I O N  */
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path'             => array($app['config']->get('root_dir').'/app/resources/views'),
    'twig.options'          => array('cache' => $app['config']->get('root_dir').'/app/cache'),
    'twig.form.templates'   => array('Form/form_custom_layout.html.twig'),
));

$app['twig'] = $app->share($app->extend('twig', function($twig, $app) {
    $twig->addExtension(new \Cungfoo\Lib\Twig\Extension\AssetExtension($app));
    $twig->addExtension(new Twig_Extension_Debug());
    $twig->addExtension(new Twig_Extensions_Extension_Text());
    $twig->addExtension(new \Cungfoo\Lib\Twig\Extension\DateLocaleExtension($app));
    $twig->addExtension(new \Cungfoo\Lib\Twig\Extension\SerializeExtension($app));
    $twig->addExtension(new \Cungfoo\Lib\Twig\Extension\EsiExtension($app));
    $twig->addExtension(new \Cungfoo\Lib\Twig\Extension\MediaExtension($app));
    $twig->addExtension(new \Cungfoo\Lib\Twig\Extension\MediasExtension($app));
    $twig->addExtension(new \VacancesDirectes\Lib\Twig\Extension\ListPaysExtension($app));
    $twig->addExtension(new \Cungfoo\Lib\Twig\Extension\MetadataExtension($app));

    return $twig;
}));

$app['twig_collection_parser'] = new Cungfoo\Lib\Parser\TwigCollectionParser();
$app['twig_object_parser'] = new Cungfoo\Lib\Parser\TwigObjectParser();

/* P R O P E L   C O N F I G U R A T I O N  */
$app['propel.model_path'] = $app['config']->get('root_dir').'/src';
$app['propel.config_file'] = $app['config']->get('config_dir').'/Propel/generated/Cungfoo-conf.php';
$app->register(new Propel\Silex\PropelServiceProvider());

$app->register(new Silex\Provider\SessionServiceProvider(), array(
    'session.storage.options' => array('auto_start' => true),
));

$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__.'/../logs/cungfoo.log',
));

$app['monolog.name'] = 'Cungfoo';

try {
    // La conf memcache n'est chargée que si le fichier existe ; si elle n'est pas chargée, la méthode get() de config throw une exception, d'où le try/catch
    $memConf = $app['config']->get('memcache');

    $memcache = new Memcache();
    $memcache->addServer($memConf['host'], $memConf['port']);

    $app['session.storage.handler'] = new Symfony\Component\HttpFoundation\Session\Storage\Handler\MemcacheSessionHandler($memcache);
} catch (Exception $e) {
    // Si pas de conf définie, on laisse le StorageHandler par défaut
    $app['monolog']->addError($e->getMessage());
}

/* C O N S O L E */
$app->register(new Knp\Provider\ConsoleServiceProvider(), array(
    'console.name'              => 'Cungfoo',
    'console.version'           => '1.0.0',
    'console.project_directory' => __DIR__.'/..'
));

/* H T T P   C A C H E */
$app->register(new Silex\Provider\HttpCacheServiceProvider(), array(
    'http_cache.cache_dir' => $app['config']->get('root_dir').'/app/cache',
    'http_cache.options'    => array(
        'allow_reload'      => true,
        'allow_revalidate'  => true
    )
));

$app['cache.max_age'] = 3600 * 24 * 90;
$app['cache.expires'] = 3600 * 24 * 90;
$app['cache.defaults'] = array(
    'Cache-Control' => sprintf('public, max-age=%d, s-maxage=%d, must-revalidate, proxy-revalidate', $app['cache.max_age'], $app['cache.max_age']),
    'Expires'       => date('r', time() + $app['cache.expires'])
);


/* S O M E   S E R V I C E   P R O V I D E R */
$app->register(new Silex\Provider\FormServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider());
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\ValidatorServiceProvider());

/* Memcache Provider */
$app->register(new KuiKui\MemcacheServiceProvider\ServiceProvider(), array(
    'memcache.default_duration' => 60
));

/* F O R M  E X T E N S I O N S  */
$app['form.extensions'] = $app->share($app->extend('form.extensions', function ($extensions) use ($app) {
    $extensions[] = new \Cungfoo\Form\CustomExtension();

    return $extensions;
}));

/* C O N T E X T */
$app['context'] = $app->share(function() {
    return new \Cungfoo\Lib\Context();
});

return $app;
