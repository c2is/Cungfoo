<?php

namespace Cungfoo\Model;

use Cungfoo\Model\om\BaseRegionRefQuery;


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
class RegionRefQuery extends BaseRegionRefQuery
{
    public function find($con = null)
    {
        $this
            ->useI18nQuery()
            ->orderByName()
            ->endUse()
        ;

        return parent::find($con);
    }
}
