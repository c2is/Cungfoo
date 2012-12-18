<?php

namespace Cungfoo\Model;

use Cungfoo\Model\om\BaseVilleQuery;


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
class VilleQuery extends BaseVilleQuery
{
    public function filterByDestination($isRegion, $code = null)
    {
        return $this
            ->_if($code)
                ->useRegionQuery()
                    ->_if($isRegion)
                        ->filterByCode($code)
                    ->_else()
                        ->usePaysQuery()
                            ->filterByCode($code)
                        ->endUse()
                    ->_endif()
                ->endUse()
            ->_endif()
        ;
    }

    public function findActive($absolute = true, $con = null)
    {
        if ($absolute)
        {
            $this
                ->useRegionQuery()
                    ->filterByActive(true)
                    ->usePaysQuery()
                        ->filterByActive(true)
                    ->endUse()
                ->endUse()
            ;
        }

        return parent::findActive($con);
    }
}
