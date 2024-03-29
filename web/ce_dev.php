<?php
/**
 * Development application builder
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 *
 * @package Cungfoo by C2IS
 */

use Symfony\Component\ClassLoader\DebugClassLoader;
use Symfony\Component\HttpKernel\Debug\ErrorHandler;
use Symfony\Component\HttpKernel\Debug\ExceptionHandler;

ini_set('display_errors', 0);

// loaded the libraries
require_once __DIR__.'/../vendor/autoload.php';

ini_set('display_errors', 1);
error_reporting(-1);
DebugClassLoader::enable();
ErrorHandler::register();
if ('cli' !== php_sapi_name())
{
    ExceptionHandler::register();
}

// Corrige un problème de droits sur les fichiers cache de Twig en préprod (et en prod possiblement)
umask(0002);

// created the application
$app = require __DIR__ . '/../src/VacancesDirectesCe/app.php';

// set environnement
require __DIR__ . '/../app/config/dev.php';

// set security
require __DIR__ . '/../src/VacancesDirectesCe/security.php';

// created the context
require __DIR__ . '/../src/VacancesDirectesCe/context.php';

// load routes code
require __DIR__ . '/../src/VacancesDirectesCe/routes.php';

$app->run();