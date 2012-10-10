<?php

$app['context']->addParam('language', isset($_GET['Context']['language']) ? $_GET['Context']['language'] : 0);
$app['context']->addParam('site', isset($_GET['Context']['site']) ? $_GET['Context']['site'] : 0);
$app['context']->addParam('domaine', isset($_GET['Context']['domaine']) ? $_GET['Context']['domaine'] : 0);
$app['context']->addParam('term', isset($_GET['Context']['term']) ? $_GET['Context']['term'] : '');

// set fr default
$app['translator']->setLocale('fr');
