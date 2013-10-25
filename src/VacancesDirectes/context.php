<?php

use Symfony\Component\HttpFoundation\Request;

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

define('CURRENT_LANGUAGE', $app['context']->get('language'));

// set current language
$app['translator']->setLocale($app['context']->get('language'));

// DREIZEN specifics
if ( CURRENT_LANGUAGE === 'nl' )
{
    if($app['session']->get('resalys_user'))
    {
        if ($app['session']->get('resalys_user')->webuser === 'webres2_part')
        {
            define('DREIZEN', $app['session']->get('resalys_user')->webuser);
        }
        //var_dump($app['session']->get('resalys_user'));
    }
}