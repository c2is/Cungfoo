<?php
/**
 * Production application builder
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 *
 * @package Cungfoo by C2IS
 */

$timeSilex  = microtime(true);
$timeResalys = array();

ini_set('display_errors', 0);

// loaded the libraries
require_once __DIR__.'/../vendor/autoload.php';

// Corrige un problème de droits sur les fichiers cache de Twig en préprod (et en prod possiblement)
umask(0002);

// created the application
$app = require __DIR__ . '/../src/VacancesDirectesCe/app.php';

// set environnement
require __DIR__ . '/../app/config/prod.php';

// set security
require __DIR__ . '/../src/VacancesDirectesCe/security.php';

// created the context
require __DIR__ . '/../src/VacancesDirectesCe/context.php';

// load routes code
require __DIR__ . '/../src/VacancesDirectesCe/routes.php';

$app['http_cache']->run();

$timeSilex = microtime(true) - $timeSilex;

if ($_SERVER['REMOTE_ADDR'] == "82.235.17.159") {
    file_put_contents(__DIR__.'/../app/logs/trace.log', "\n\nCUNGFOO TRACE | \n".var_export(array('silex' => $timeSilex, 'resalys' => $timeResalys), true), FILE_APPEND);
}
