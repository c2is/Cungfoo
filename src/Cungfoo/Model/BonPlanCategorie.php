<?php

namespace Cungfoo\Model;

use \Criteria;

use Cungfoo\Model\om\BaseBonPlanCategorie;


/**
 * Skeleton subclass for representing a row from the 'bon_plan_categorie' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.Cungfoo.Model
 */
class BonPlanCategorie extends BaseBonPlanCategorie
{
    public function __toString()
    {
        return $this->getName();
    }

    public function getBonPlansActifs($criteria = null, $con = null) {
        return BonPlanQuery::create(null, $criteria)
            ->filterByBonPlanCategorie($this)
            ->useBonPlanBonPlanCategorieQuery()
                ->orderBySortableRank()
            ->endUse()
            ->findActive($con)
        ;
    }

    public function getBonPlansActifsForMenu($criteria = null, $con = null) {
        return BonPlanQuery::create(null, $criteria)
            ->filterByBonPlanCategorie($this)
            ->filterByDateDebut(array('max' => 'today'))
            ->filterByDateFin(array('min' => 'today'))
            ->useBonPlanBonPlanCategorieQuery()
                ->orderBySortableRank()
            ->endUse()
            ->useI18nQuery($this->currentLocale)
                ->filterBySlug('', Criteria::NOT_EQUAL)
            ->endUse()
            ->limit(4)
            ->findActive($con)
        ;
    }
}
