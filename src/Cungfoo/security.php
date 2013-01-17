<?php
/*
 * Configuration of the security of our admin application
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 *
 * @package Cungfoo by C2IS
 */

use Cungfoo\Lib\Crud\Security as CrudSecurity;

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
            'users'     => Symfony\Component\Yaml\Yaml::parse(sprintf('%s/Cungfoo/users.yml', $app['config']->get('config_dir')))['users'],
        )
    ),
));

$app['config']->security->load(sprintf('%s/Cungfoo/security.yml', $app['config']->get('config_dir')));

$app->before(function() use ($app) {
    if (!$app['config']->security->isGranted())
    {
        $app->abort(403, "No permission to access.");
    }
});
