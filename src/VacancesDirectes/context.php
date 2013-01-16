<?php

// defined current version instance
$app['context']->addParam('site', 'site.individual');

// set current locale by domain name
$app['context']->addParam('language', 'fr');
foreach ($app['config']->get('languages') as $locale => $language)
{
    if ($_SERVER['SERVER_NAME'] == $language['domain'])
    {
        $app['context']->addParam('language', $locale);
    }
}

// set current language
$app['translator']->setLocale($app['context']->get('language'));
