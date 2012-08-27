<?php

$app['context'] = $app->share(function() {
    return new \Cungfoo\Lib\Context();
});

$app['context']->addParam('language', isset($_GET['Context']['language']) ? $_GET['Context']['language'] : 0);
$app['context']->addParam('site', isset($_GET['Context']['site']) ? $_GET['Context']['site'] : 0);
$app['context']->addParam('saison', isset($_GET['Context']['saison']) ? $_GET['Context']['saison'] : 0);