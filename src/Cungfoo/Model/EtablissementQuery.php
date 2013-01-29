<?php

namespace Cungfoo\Model;

use Cungfoo\Model\om\BaseEtablissementQuery;


/**
 * Skeleton subclass for performing query and update operations on the 'etablissement' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.Cungfoo.Model
 */
class EtablissementQuery extends BaseEtablissementQuery
{
    public function filterByDestinationSearch($isRegion, $code = null)
    {
        return $this
            ->_if($code)
                ->useVilleQuery()
                    ->useRegionQuery()
                        ->_if($isRegion)
                            ->filterByCode($code)
                        ->_else()
                            ->usePaysQuery()
                                ->filterByCode($code)
                            ->endUse()
                        ->_endif()
                    ->endUse()
                ->endUse()
            ->_endif()
        ;
    }

    public function find($con = null)
    {
        $this->orderByName();

        return parent::find($con);
    }

    public function findActive($absolute = true, $con = null)
    {
        if ($absolute)
        {
            $this
                ->useVilleQuery()
                    ->filterByActive(true)
                    ->useRegionQuery()
                        ->filterByActive(true)
                        ->usePaysQuery()
                            ->filterByActive(true)
                        ->endUse()
                    ->endUse()
                ->endUse()
            ;
        }

        return parent::findActive($con);
    }
}
