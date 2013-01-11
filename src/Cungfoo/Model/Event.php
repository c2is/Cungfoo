<?php

namespace Cungfoo\Model;

use Cungfoo\Model\om\BaseEvent;


/**
 * Skeleton subclass for representing a row from the 'event' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.Cungfoo.Model
 */
class Event extends BaseEvent
{
    public function __toString()
    {
        return $this->getName();
    }

    public function getDistanceForEtablissement(Etablissement $etab)
    {
        $distance = EtablissementEventQuery::create()
            ->select('distance')
            ->filterByEtablissementId($etab->getId())
            ->filterByEventId($this->getId())
            ->findOne()
        ;

        return $distance ? $distance : '0';
    }

    public function getEtablissements($criteria = null, PropelPDO $con = null)
    {
        if ($criteria === null)
        {
            $criteria = new \Criteria();
        }

        $criteria->add(EtablissementPeer::ACTIVE, true);

        return parent::getEtablissements($criteria, $con);
    }
}
