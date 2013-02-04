<?php

// defined current version instance
$app['context']->addParam('site', 'site.ce');

// set current language
$app['context']->addParam('language', 'fr');

define('CURRENT_LANGUAGE', $app['context']->get('language'));

// set current language
$app['translator']->setLocale($app['context']->get('language'));
