<?php

namespace Cungfoo\Model;

use Cungfoo\Model\om\BaseDernieresMinutes;


/**
 * Skeleton subclass for representing a row from the 'dernieres_minutes' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.Cungfoo.Model
 */
class DernieresMinutes extends BaseDernieresMinutes
{
    public function getDestinationsCodes()
    {
        $codes = array();

        foreach ($this->getDestinations() as $destination)
        {
            $codes[] = $destination->getCode();
        }

        return implode(',', $codes);
    }

    public function getEtablissementsCodes()
    {
        $codes = array();

        foreach ($this->getEtablissements() as $etablissement)
        {
            $codes[] = $etablissement->getCode();
        }

        return implode(',', $codes);
    }
}
