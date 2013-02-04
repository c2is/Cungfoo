<?php

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
