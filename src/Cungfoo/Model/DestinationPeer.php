<?php

namespace Cungfoo\Model;

use Cungfoo\Model\om\BaseDestinationPeer;


/**
 * Skeleton subclass for performing query and update operations on the 'destination' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.Cungfoo.Model
 */
class DestinationPeer extends BaseDestinationPeer
{
    public static function assertUrl()
    {
        $objects = DestinationQuery::create($locale = 'fr')
            ->useI18nQuery($locale)
            ->withColumn('destination_i18n.slug', 'slug')
            ->endUse()
            ->select('slug')
            ->findActive()
            ->toArray()
        ;

        return implode('|', $objects);
    }
}
