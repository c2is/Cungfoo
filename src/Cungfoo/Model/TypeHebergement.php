<?php

namespace Cungfoo\Model;

use Cungfoo\Model\om\BaseTypeHebergement;


/**
 * Skeleton subclass for representing a row from the 'type_hebergement' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.Cungfoo.Model
 */
class TypeHebergement extends BaseTypeHebergement
{
    public function __toString()
    {
        return $this->getName();
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
