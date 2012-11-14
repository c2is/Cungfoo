<?php

namespace Cungfoo\Model;

use Cungfoo\Model\om\BaseEtablissementTypeHebergement;


/**
 * Skeleton subclass for representing a row from the 'etablissement_type_hebergement' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.Cungfoo.Model
 */
class EtablissementTypeHebergement extends BaseEtablissementTypeHebergement
{
    public function __toString()
    {
        return $this->getMinimumPriceDiscountLabel();
    }
}
