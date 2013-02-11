<?php

namespace Cungfoo\Model;

use Cungfoo\Model\om\BasePaysPeer;


/**
 * Skeleton subclass for performing query and update operations on the 'pays' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.Cungfoo.Model
 */
class PaysPeer extends BasePaysPeer
{
    public static function assertUrl()
    {
        $objects = PaysQuery::create()
            ->useI18nQuery()
            ->withColumn('pays_i18n.slug', 'slug')
            ->endUse()
            ->select('slug')
            ->findActive()
            ->toArray()
        ;

        return implode('|', $objects);
    }
}
