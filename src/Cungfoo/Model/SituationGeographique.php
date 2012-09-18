<?php

namespace Cungfoo\Model;

use Cungfoo\Model\om\BaseSituationGeographique;


/**
 * Skeleton subclass for representing a row from the 'situation_geographique' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.Cungfoo.Model
 */
class SituationGeographique extends BaseSituationGeographique
{
    public function __toString()
    {
        return $this->getName();
    }
}
