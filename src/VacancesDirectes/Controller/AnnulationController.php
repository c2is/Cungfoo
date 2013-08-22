<?php

namespace VacancesDirectes\Controller;

use Symfony\Component\HttpFoundation\Request;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Cungfoo\Model\DemandeAnnulation,
    Cungfoo\Form\Type\DemandeAnnulationType;

use VacancesDirectes\Lib\SearchEngine;

class AnnulationController implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->match('/', function (Request $request) use ($app) {
            // Formulaire de recherche
            $searchEngine = new SearchEngine($app, $request);
            $searchEngine->process();

            if ($searchEngine->getRedirect())
            {
                return $app->redirect($searchEngine->getRedirect());
            }

            $annulationData = new DemandeAnnulation();

            $form = $app['form.factory']->create(new DemandeAnnulationType($app), $annulationData);

            if ('POST' == $request->getMethod() && $request->request->has('annulationForm'))
            {
                $form->bind($request);
                if ($form->isValid()) {
                    $annulationData->setActive(true);
                    $annulationData->saveFromCrud($form);
				    if($annulationData->getGroupes()) $groupes = 'oui';
					else $groupes = 'non';
                    $body = <<<eof
Nom de l'assuré : {$annulationData->getAssureNom()}
Prénom de l'assuré : {$annulationData->getAssurePrenom()}
Adresse de l'assuré : {$annulationData->getAssureAdresse()}
Code Postal de l'assuré : {$annulationData->getAssureCodePostal()}
Ville de l'assuré : {$annulationData->getAssureVille()}
Pays de l'assuré : {$app->trans($annulationData->getAssurePays())}
Email de l'assuré : {$annulationData->getAssureMail()}
Téléphone de l'assuré : {$annulationData->getAssureTelephone()}
Montant du séjour : {$annulationData->getCampingMontantSejour()}
Montant des sommes versées : {$annulationData->getCampingMontantVerse()}
Nom du camping : {$annulationData->getEtablissement()->getName()}
N° de réservation du camping : {$annulationData->getCampingNumResa()}
Demande d'annulation partiel pour les groupes : {$groupes}
Nature du sinistre : {$app->trans($annulationData->getSinistreNature())}
Suite à : {$app->trans($annulationData->getSinistreSuite())}
Date du sinistre : {$annulationData->getSinistreDate()}
Résumé des faits : {$annulationData->getSinistreResume()}
eof;

                    $message = \Swift_Message::newInstance()
                        ->setSubject($app['config']->get('vd_config')['demande_annulation']['sujet'])
                        ->setFrom(array($app['config']->get('vd_config')['demande_annulation']['from_mail'] => $app['config']->get('vd_config')['demande_annulation']['from']))
                        ->setTo(array($app['config']->get('vd_config')['demande_annulation']['mail']))
                        ->setBody($body)
                    ;

                    $uploadDir = strstr($annulationData->getUploadRootDir(), $annulationData->getUploadDir(), true);
                    if ($annulationData->getFile1())
                    {
                        $message->attach(\Swift_Attachment::fromPath($uploadDir . $annulationData->getFile1()));
                    }
                    if ($annulationData->getFile2())
                    {
                        $message->attach(\Swift_Attachment::fromPath($uploadDir . $annulationData->getFile2()));
                    }
                    if ($annulationData->getFile3())
                    {
                        $message->attach(\Swift_Attachment::fromPath($uploadDir . $annulationData->getFile3()));
                    }
                    if ($annulationData->getFile4())
                    {
                        $message->attach(\Swift_Attachment::fromPath($uploadDir . $annulationData->getFile4()));
                    }

                    $app['mailer']->send($message);

                    return $app->redirect($app->path('demande_annulation_confirmation'));
                }
            }

            return $app->renderView('Annulation/form.twig', array(
                'searchForm'     => $searchEngine->getView(),
                'annulationForm' => $form->createView(),
            ));
        })
        ->bind('demande_annulation_form');

        $controllers->match('/' . $app->trans('seo.url.assurance.confirmation'), function (Request $request) use ($app) {
            // Formulaire de recherche
            $searchEngine = new SearchEngine($app, $request);
            $searchEngine->process();

            if ($searchEngine->getRedirect())
            {
                return $app->redirect($searchEngine->getRedirect());
            }

            return $app->renderView('Annulation/confirmation.twig', array(
                'searchForm'     => $searchEngine->getView(),
            ));
        })
        ->bind('demande_annulation_confirmation');

        return $controllers;
    }
}
