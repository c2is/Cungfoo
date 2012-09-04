<?php
/*
 * Configuration of our context application
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 *
 * @package Cungfoo by C2IS
 */
$app['context']->addParam('site', isset($_GET['site']) ? $_GET['site'] : 'site.individual');
$app['context']->addParam('domaine', isset($_GET['domaine']) ? $_GET['domaine'] : 'fr');
$app['context']->addParam('language', isset($_GET['domaine']) ? $_GET['domaine'] : $app['context']->get('domaine'));

// check if domain is allow for this site
if (!in_array($app['context']->get('domaine'), $app['config']->get('dimensions')['site'][$app['context']->get('site')]['domaines']))
{
    throw new \Exception(sprintf("`%s` domain is not allow for `%s` domain.", $app['context']->get('domaine'), $app['context']->get('site')));
}

// set current language
$app['translator']->setLocale($app['context']->get('language'));