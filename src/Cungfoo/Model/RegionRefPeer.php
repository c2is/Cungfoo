<?php

namespace Cungfoo\Model;

use Cungfoo\Model\om\BaseRegionRefPeer;


/**
 * Skeleton subclass for performing query and update operations on the 'region_ref' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.Cungfoo.Model
 */
class RegionRefPeer extends BaseRegionRefPeer
{
    public static function assertUrl($locale = 'fr')
    {
        $objects = RegionRefQuery::create()
            ->useI18nQuery($locale)
            ->withColumn('region_ref_i18n.slug', 'slug')
            ->endUse()
            ->select('slug')
            ->findActive()
            ->toArray()
        ;

        return implode('|', $objects);
    }
}
