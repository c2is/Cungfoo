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
        $message = \Swift_Message::newInstance()
            ->setSubject('[YourSite] Feedback')
            ->setFrom(array('morgan.brunot@c2is.fr'))
            ->setTo(array('florent.gallardo@c2is.fr'))
            ->setBody($this->getSocieteNom());

        $app['mailer']->send($message);

        parent::save($con);
    }
}
