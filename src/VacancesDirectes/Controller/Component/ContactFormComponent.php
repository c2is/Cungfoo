<?php

namespace VacancesDirectes\Controller\Component;

use Silex\Application;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Route;

use Cungfoo\Model\CoordonneesContact;
use Cungfoo\Form\Type\CoordonneesContactType;

class ContactFormComponent
{
    public static function render(Application $app, Request $request)
    {
        $object = new CoordonneesContact();
        $form    = $app['form.factory']->create(new CoordonneesContactType($app), $object);

        if ('POST' == $request->getMethod()) {
            $form->bindRequest($request);
            if ($form->isValid()) {
                $object->saveFromCrud($form);

                die('ytres');
            }
        }

        return $app['twig']->render('Component\contact_form.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
