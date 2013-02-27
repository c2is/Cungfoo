<?php

namespace Cungfoo\Model;

use Cungfoo\Model\om\BaseBonPlanQuery;


/**
 * Skeleton subclass for performing query and update operations on the 'bon_plan' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.Cungfoo.Model
 */
class BonPlanQuery extends BaseBonPlanQuery
{
    public function addDateFilters()
    {
        return $this
            ->condition('dateDeb1', 'bon_plan.date_debut IS NULL')
            ->condition('dateDeb2', 'bon_plan.date_debut = ?', '')
            ->condition('dateDeb3', 'bon_plan.date_debut <= ?', date('Y-m-d'))
            ->combine(array('dateDeb1', 'dateDeb2', 'dateDeb3'), 'or', 'dateDeb')
            ->condition('dateFin1', 'bon_plan.date_fin IS NULL')
            ->condition('dateFin2', 'bon_plan.date_fin = ?', '')
            ->condition('dateFin3', 'bon_plan.date_fin >= ?', date('Y-m-d'))
            ->combine(array('dateFin1', 'dateFin2', 'dateFin3'), 'or', 'dateFin')
        ;
    }
}
