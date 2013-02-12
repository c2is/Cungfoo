<?php

namespace Cungfoo\Model;

use Cungfoo\Model\om\BaseRegionPeer;


/**
 * Skeleton subclass for performing query and update operations on the 'region' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.Cungfoo.Model
 */
class RegionPeer extends BaseRegionPeer
{
    public static function assertUrl()
    {
        $objects = RegionQuery::create()
            ->useI18nQuery()
            ->withColumn('region_i18n.slug', 'slug')
            ->endUse()
            ->select('slug')
            ->findActive()
            ->toArray()
        ;

        return implode('|', $objects);
    }
}
