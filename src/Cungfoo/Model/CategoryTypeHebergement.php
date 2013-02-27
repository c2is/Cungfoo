<?php

namespace Cungfoo\Model;

use Cungfoo\Model\om\BaseCategoryTypeHebergement;


/**
 * Skeleton subclass for representing a row from the 'category_type_hebergement' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.Cungfoo.Model
 */
class CategoryTypeHebergement extends BaseCategoryTypeHebergement
{
    public function __toString()
    {
        return $this->getName();
    }

    public function getCapacitesTypeHebergement()
    {
        return \Cungfoo\Model\TypeHebergementQuery::create()
            ->select('NombrePlace')
            ->useCategoryTypeHebergementQuery()
                ->filterById($this->getId())
            ->endUse()
            ->distinct()
            ->orderBy('NombrePlace')
            ->findActive()
        ;
    }
}
