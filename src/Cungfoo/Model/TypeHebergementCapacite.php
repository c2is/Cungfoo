<?php

namespace Cungfoo\Model;

use Cungfoo\Model\om\BaseTypeHebergementCapacite;


/**
 * Skeleton subclass for representing a row from the 'type_hebergement_capacite' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.Cungfoo.Model
 */
class TypeHebergementCapacite extends BaseTypeHebergementCapacite
{
    public function __toString()
    {
        return $this->getName();
    }

    public function getCategoriesTypeHergement()
    {
        return \Cungfoo\Model\CategoryTypeHebergementQuery::create()
            ->joinWithI18n()
            ->useTypeHebergementQuery()
                ->filterByTypeHebergementCapaciteId($this->getId())
            ->endUse()
            ->distinct()
            ->findActive()
        ;
    }
}
