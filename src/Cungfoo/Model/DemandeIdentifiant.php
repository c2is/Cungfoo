<?php

namespace Cungfoo\Model;

use Cungfoo\Model\om\BaseDemandeIdentifiant;


/**
 * Skeleton subclass for representing a row from the 'demande_identifiant' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.Cungfoo.Model
 */
class DemandeIdentifiant extends BaseDemandeIdentifiant
{

    public function saveAndSendMail(\Silex\Application $app, \PropelPDO $con = null)
    {
        $body = <<<eof

Nom de la société : {$this->getSocieteNom()}
Adresse : {$this->getSocieteAdresse1()} {$this->getSocieteAdresse2()} {$this->getSocieteAdresse3()} {$this->getSocieteAdresse4()}
Téléphone de la société : {$this->getSocieteTelephone()}
Fax de la société : {$this->getSocieteFax()}
Prénom : {$this->getContactPrenom()}
Nom : {$this->getContactNom()}
Téléphone : {$this->getContactTelephone()}
Email : {$this->getContactMail()}
Permanance : {$this->getPermanence()}
Heure matin : {$this->getPermanenceMatinDe()} {$this->getPermanenceMatinA()}
Heure après midi : {$this->getPermanenceApresMidiDe()} {$this->getPermanenceApresMidiA()}
Déjà client Vacances directes : {$this->getClientVd()}
Code Vacances directes : {$this->getClientVdCode()}
Déjà client Village center : {$this->getClientVc()}
Code Village center : {$this->getClientVcCode()}
Brochure : {$this->getBrochure()}
Identifiant : {$this->getIdentifiant()}

eof;

        $message = \Swift_Message::newInstance()
            ->setSubject($app['config']->get('globale')['demande_identifiant']['sujet'])
            ->setFrom(array($app['config']->get('globale')['demande_identifiant']['from_mail']=>$app['config']->get('globale')['demande_identifiant']['from']))
            ->setTo(array($app['config']->get('globale')['demande_identifiant']['mail']))
            ->setBody($body);

        $app['mailer']->send($message);

        parent::save($con);
    }
}
