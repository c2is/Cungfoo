<?php
/**
 * Production application builder
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 *
 * @package Cungfoo by C2IS
 */

ini_set('display_errors', 0);

// loaded the libraries
require_once __DIR__.'/../vendor/autoload.php';

// Corrige un problème de droits sur les fichiers cache de Twig en préprod (et en prod possiblement)
umask(0002);

// created the application
$app = require __DIR__ . '/../src/VacancesDirectes/app.php';

// set environnement
require __DIR__ . '/../app/config/prod.php';

// set security
require __DIR__ . '/../src/VacancesDirectes/security.php';

// created the context
require __DIR__ . '/../src/VacancesDirectes/context.php';

// load routes code
require __DIR__ . '/../src/VacancesDirectes/routes.php';

$app['http_cache']->run();
