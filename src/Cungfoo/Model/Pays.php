<?php

namespace Cungfoo\Model;

use Cungfoo\Model\om\BasePays;


/**
 * Skeleton subclass for representing a row from the 'pays' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.Cungfoo.Model
 */
class Pays extends BasePays
{
    public function __toString()
    {
        return $this->getName();
    }

    public function isFrance()
    {
        return $this->getCode() == 'FRA';
    }

    public function getRegionMeaHome()
    {
        return \Cungfoo\Model\RegionQuery::create()
            ->joinWithI18n($this->currentLocale)
            ->filterByPaysId($this->getId())
            ->filterByMeaHome(1)
            ->findActive()
        ;
    }

    public function getDepartementOrderByName(\PropelPDO $con = null)
    {
        return \Cungfoo\Model\DepartementQuery::create()
            ->useRegionRefQuery()
                ->usePaysQuery()
                    ->filterById($this->getId())
                ->endUse()
            ->endUse()
            ->useI18nQuery()
                ->orderByName()
            ->endUse()
            ->findActive($con)
        ;
    }
}
