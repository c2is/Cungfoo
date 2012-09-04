<?php

$app['context']->addParam('language', isset($_GET['locale']) ? $_GET['locale'] : 'fr');
$app['context']->addParam('site', isset($_GET['site']) ? $_GET['site'] : 'indiv');
$app['context']->addParam('saison', isset($_GET['domaine']) ? $_GET['domaine'] : 'fr');

// set fr default
$app['translator']->setLocale($app['context']->get('language'));