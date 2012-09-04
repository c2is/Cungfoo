<?php
/*
 * Configuration of our context application
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 *
 * @package Cungfoo by C2IS
 */
$app['context']->addParam('site', isset($_GET['site']) ? $_GET['site'] : 'indiv');
$app['context']->addParam('domaine', isset($_GET['domaine']) ? $_GET['domaine'] : 'fr');

$app['context']->addParam('language', isset($_GET['domaine']) ? $_GET['domaine'] : $app['context']->get('domaine'));

// set fr default
$app['translator']->setLocale($app['context']->get('language'));