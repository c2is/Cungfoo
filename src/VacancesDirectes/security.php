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
$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\SecurityServiceProvider());
$app['security.firewalls'] =  array(
    'compte' => array(
        'pattern' => '/compte/',
        'form'    => array(
            'always_use_default_target_path' => true,
            'default_target_path'            => '/' . $app->trans('seo.url.compte.index') . '/',
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

$app['security.last_error'] = $app->protect(function (\Symfony\Component\HttpFoundation\Request $request) use ($app) {
    $errorMessage = $app->trans("compte.login.error");

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