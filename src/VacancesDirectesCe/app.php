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

/* S E C U R I T Y   M A N A G E R */
$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\SecurityServiceProvider());
$app['security.firewalls'] =  array(
    'ce_login' => array(
        'pattern' => '^/login$',
    ),
    'ce' => array(
        'pattern'   => '/',
        'form'      => array('login_path' => '/login', 'check_path' => '/login_check'),
        'logout'    => array('logout_path' => '/logout'),
        'users' => $app->share(function() use ($app) {
            return new \Resalys\Model\UserProvider($app);
        }),
    ),
);
$app['security.access_rules'] = array(
    array('^/.+$', 'ROLE_USER'),
);

$app['security.last_error'] = $app->protect(function () {
    return "Le login que vous avez saisi est incorrect. Veuillez réessayer (vérifiez que le verrouillage des majuscules est désactivé).";
});

$app['security.encoder.digest'] = $app->share(function ($app) {
    return new \Symfony\Component\Security\Core\Encoder\PlaintextPasswordEncoder();
});

/* T W I G  C O N F I G U R A T I O N  */
$app['twig.path'] = array(__DIR__.'/View');

return $app;

