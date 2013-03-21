<?php

// Date in the past
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
// always modified
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
// HTTP/1.1
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
// HTTP/1.0
header("Pragma: no-cache");

// defined current version instance
$app['context']->addParam('site', 'site.admin');

// term parameter used on context crud lsit
$app['context']->addParam('term', isset($_GET['Context']['term']) ? $_GET['Context']['term'] : '');

// set current locale by domain name
$app['context']->addParam('language', 'fr');
foreach ($app['config']->get('languages') as $locale => $language)
{
    if ($_SERVER['SERVER_NAME'] == $language['domain'])
    {
        $app['context']->addParam('language', $locale);
    }
}

define('CURRENT_LANGUAGE', $app['context']->get('language'));

// set fr default
$app['translator']->setLocale($app['context']->get('language'));
