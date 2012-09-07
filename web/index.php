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

// created the application
$app = require __DIR__ . '/../src/VacancesDirectes/app.php';

// created the context
require __DIR__ . '/../src/VacancesDirectes/context.php';

// load routes code
require __DIR__ . '/../src/VacancesDirectes/routes.php';

// set environnement
require __DIR__ . '/../app/config/prod.php';

$app['http_cache']->run();
