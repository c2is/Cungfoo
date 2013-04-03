<?php
/*
 * Configuration of the security of our admin application
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 *
 * @package Cungfoo by C2IS
 */

/* S E C U R I T Y   M A N A G E R */
$app->register(new Silex\Provider\SecurityServiceProvider());
$app['security.firewalls'] =  array(
    'resalys' => array('pattern' => '^/resalys'),
    'request' => array('pattern' => '^/request'),
    'editos' => array('pattern' => '^/editos'),
    'ce_login' => array('pattern' => '^/login$'),
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
    array('^/request', ''),
    array('^/resalys', '')
);

$app['security.last_error'] = $app->protect(function (\Symfony\Component\HttpFoundation\Request $request) {
    $errorMessage = "Le login que vous avez saisi est incorrect. Veuillez réessayer (vérifiez que le verrouillage des majuscules est désactivé).";

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