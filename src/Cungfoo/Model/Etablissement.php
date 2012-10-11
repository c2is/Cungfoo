<?php

namespace Cungfoo\Model;

use Cungfoo\Model\om\BaseEtablissement;


/**
 * Skeleton subclass for representing a row from the 'etablissement' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.Cungfoo.Model
 */
class Etablissement extends BaseEtablissement
{
    public function __toString()
    {
        return $this->getName();
    }

    public function getDmsCoordinates()
    {
        $utils = new \Cungfoo\Lib\Utils();

        return $utils->decimalToDms((float)$this->getGeoCoordinateX(), (float)$this->getGeoCoordinateY());
    }
}
