<?php

namespace Cungfoo\Model;

use Cungfoo\Model\om\BaseCoordonneesParametrages;


/**
 * Skeleton subclass for representing a row from the 'coordonnees_parametrages' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.Cungfoo.Model
 */
class CoordonneesParametrages extends BaseCoordonneesParametrages
{
    public function __toString()
    {
        return $this->getDescription();
    }
}
