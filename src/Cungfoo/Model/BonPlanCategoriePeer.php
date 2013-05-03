<?php

namespace Cungfoo\Model;

use Cungfoo\Model\om\BaseBonPlanCategoriePeer;


/**
 * Skeleton subclass for performing query and update operations on the 'bon_plan_categorie' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.Cungfoo.Model
 */
class BonPlanCategoriePeer extends BaseBonPlanCategoriePeer
{
    public static function assertUrl($locale)
    {
        $objects = BonPlanCategorieQuery::create()
            ->useI18nQuery($locale)
            ->endUse()
            ->find()
        ;

        $outputs = array();
        foreach ($objects as $object) {
            $outputs[] = $object->getSlug();
        }

        return implode('|', $outputs);
    }
}
