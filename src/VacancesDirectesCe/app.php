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

return $app;

