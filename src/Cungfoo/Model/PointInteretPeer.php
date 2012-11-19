<?php

namespace Cungfoo\Model;

use Cungfoo\Model\om\BasePointInteretPeer;


/**
 * Skeleton subclass for performing query and update operations on the 'point_interet' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.Cungfoo.Model
 */
class PointInteretPeer extends BasePointInteretPeer
{
    const NO_SORT     = 0;
    const RANDOM_SORT = 1;

    static public function getForEtablissement(Etablissement $etab, $sort = self::NO_SORT, $count = null)
    {
        $query = PointInteretQuery::create()
            ->useEtablissementPointInteretQuery()
                ->filterByEtablissementId($etab->getId())
            ->endUse()
        ;

        if ($sort == self::RANDOM_SORT)
        {
            $query->addAscendingOrderByColumn('RAND()');
        }

        if (!is_null($count))
        {
            $query->limit($count);
        }

        return ($count == 1) ? $query->findOne() : $query->find();
    }

    static public function getCountForEtablissement(Etablissement $etab)
    {
        return PointInteretQuery::create()
            ->useEtablissementPointInteretQuery()
                ->filterByEtablissementId($etab->getId())
            ->endUse()
            ->count()
        ;
    }
}
