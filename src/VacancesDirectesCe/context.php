<?php

// defined current version instance
$app['context']->addParam('site', 'site.ce');

// set current language
$app['context']->addParam('language', 'fr');

// set current language
$app['translator']->setLocale($app['context']->get('language'));
