<?php

namespace Cungfoo\Model;

use Cungfoo\Model\om\BaseRegionQuery;


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
class RegionQuery extends BaseRegionQuery
{
    public function findActive($absolute = true, $con = null)
    {
        if ($absolute)
        {
            $this
                ->usePaysQuery()
                    ->filterByActive(true)
                ->endUse()
            ;
        }

        return parent::findActive($con);
    }
}
