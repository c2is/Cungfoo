<?php

namespace Cungfoo\Model;

use Cungfoo\Model\om\BaseVillePeer;


/**
 * Skeleton subclass for performing query and update operations on the 'ville' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.Cungfoo.Model
 */
class VillePeer extends BaseVillePeer
{
    public static function assertUrl($locale = 'fr')
    {
        $objects = VilleQuery::create()
            ->useI18nQuery($locale)
            ->withColumn('ville_i18n.slug', 'slug')
            ->endUse()
            ->select('slug')
            ->findActive()
            ->toArray()
        ;

        return implode('|', $objects);
    }
}
