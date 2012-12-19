<?php

namespace VacancesDirectes\Controller;

use Symfony\Component\HttpFoundation\Request;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use VacancesDirectes\Form\Type\Annulation\AnnulationType,
    VacancesDirectes\Form\Data\Annulation\AnnulationData,
    VacancesDirectes\Lib\SearchEngine;

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

            $annulationData = new AnnulationData();
            $form = $app['form.factory']->create(new AnnulationType($app), $annulationData);

            if ('POST' == $request->getMethod() && $request->request->has('annulationForm'))
            {
                $form->bind($request);

                if($form->isValid()) {
                    $uploadDir = $app['config']->get('root_dir') . '/web/uploads/';
                    $uploadedFiles = array();
echo '<pre>';
die(var_dump($annulationData->piecesJointes));
                    foreach($annulationData->piecesJointes as $file) {
                        $file->move($dir, $file->getClientOriginalName());

                        $extension = $file->guessExtension();
                        $fileName = uniqid();
                        if (!$extension) {
                            // extension cannot be guessed
                            $extension = 'bin';
                        }
                        $uploadedFiles[] = $file->move($uploadDir, $fileName.'.'.$extension);
                    }

                    $body = <<<eof
Nom de l'assuré : {$annulationData->nomAssure}
Prénom de l'assuré : {$annulationData->prenomAssure}
Prénom de l'assuré : {$annulationData->prenomAssure}
Adresse de l'assuré : {$annulationData->adresseAssure}
Code Postal de l'assuré : {$annulationData->codePostalAssure}
Ville de l'assuré : {$annulationData->villeAssure}
Pays de l'assuré : {$annulationData->paysAssure}
Email de l'assuré : {$annulationData->emailAssure}
Téléphone de l'assuré : {$annulationData->telephoneAssure}
Montant du séjour : {$annulationData->montantSejourCamping}
Montant des sommes versées : {$annulationData->montantVerseCamping}
Nom du camping : {$annulationData->nomCamping}
Département du camping : {$annulationData->departementCamping}
N° de réservation du camping : {$annulationData->numResaCamping}
Nature du sinistre : {$annulationData->natureSinistre}
Suite à : {$annulationData->suiteSinistre}
Date du sinistre : {$annulationData->dateSinistre}
Résumé des faits : {$annulationData->resumeSinistre}
eof;

                    $message = \Swift_Message::newInstance()
                        ->setSubject('Un sujet')
                        ->setFrom(array('g.manen@c2is.fr'))
                        ->setTo(array('g.manen@c2is.fr'))
                        ->setBody($body)
                    ;

                    foreach($uploadedFiles as $uploadedFile) {
                        $message->attach(\Swift_Attachment::fromPath($uploadDir . $uploadedFile->getRealPath()));
                    }

                    $app['mailer']->send($message);
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