<?php

/**
 * Définition des variables utilisé
 *
 * @var \Silex\Application $app
 */

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html', array());
})
->bind('homepage')
;

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    $page = 404 == $code ? '404.html' : '500.html';

    return new Response($app['twig']->render($page, array('code' => $code)), $code);
});

$app->mount('/admin/authors', new Cungfoo\Provider\CrudController(
    'author', '\Cungfoo\Model\Author', '\Cungfoo\Model\AuthorType'
));

$app->mount('/admin/documents', new Cungfoo\Provider\CrudController(
    'document', '\Cungfoo\Model\Document', '\Cungfoo\Model\DocumentType'
));

$app->mount('/admin/categories', new Cungfoo\Provider\CrudController(
    'category', '\Cungfoo\Model\Category', '\Cungfoo\Model\CategoryType'
));

$app->mount('/admin/languages', new Cungfoo\Provider\CrudController(
    'language', '\Cungfoo\Model\Language', '\Cungfoo\Model\LanguageType'
));