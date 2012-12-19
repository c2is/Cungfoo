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
                    $annulationData->saveFromCrud($form);

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
Nature du sinistre : {$annulationData->getSinistreNature()}
Suite à : {$annulationData->getSinistreSuite()}
Date du sinistre : {$annulationData->getSinistreDate()}
Résumé des faits : {$annulationData->getSinistreResume()}
eof;

                    $message = \Swift_Message::newInstance()
                        ->setSubject('Un sujet')
                        ->setFrom(array('g.manen@c2is.fr'))
                        ->setTo(array('g.manen@c2is.fr'))
                        ->setBody($body)
                    ;

                    $uploadDir = strstr($annulationData->getUploadRootDir(), $annulationData->getUploadDir(), true);
                    if ($annulationData->getFile1())
                    {
                        $message->attach(\Swift_Attachment::fromPath($uploadDir . $annulationData->getFile1()));
                    }
                    if ($annulationData->getFile1())
                    {
                        $message->attach(\Swift_Attachment::fromPath($uploadDir . $annulationData->getFile2()));
                    }
                    if ($annulationData->getFile1())
                    {
                        $message->attach(\Swift_Attachment::fromPath($uploadDir . $annulationData->getFile3()));
                    }
                    if ($annulationData->getFile1())
                    {
                        $message->attach(\Swift_Attachment::fromPath($uploadDir . $annulationData->getFile4()));
                    }
echo '<pre>';
                    die(var_dump($app['mailer']->send($message)));
                    // TODO : enregistrement en base
                }
            }

            return $app->renderView('Annulation/form.twig', array(
                'searchForm'     => $searchEngine->getView(),
                'annulationForm' => $form->createView(),
            ));
        })
        ->bind('formulaire_annulation');

        return $controllers;
    }
}