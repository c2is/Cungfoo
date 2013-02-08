<?php

namespace Cungfoo\Model;

use Cungfoo\Model\om\BaseEtablissementPeer;


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
class EtablissementPeer extends BaseEtablissementPeer
{
    const NO_SORT     = 0;
    const RANDOM_SORT = 1;

    public static function getNameOrderByName($locale = 'fr', \PropelPDO $con = null)
    {
        return \Cungfoo\Model\EtablissementQuery::create()
            ->joinWithI18n($locale)
            ->orderByName()
            ->findActive($con)
        ;
    }

    public static function getForPays(Pays $pays, $sort = self::NO_SORT, $count = null)
    {
        $query = EtablissementQuery::create()
            ->useVilleQuery()
                ->useRegionQuery()
                    ->filterByPays($pays)
                ->endUse()
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

        return ($count == 1) ? $query->findOne() : $query->findActive();
    }

    public static function getForRegion($region, $sort = self::NO_SORT, $count = null)
    {
        $query = EtablissementQuery::create()
            ->_if(get_class($region) == "Cungfoo\\Model\\Region")
            ->useVilleQuery()
                ->filterByActive(true)
                ->filterByRegion($region)
            ->endUse()
            ->_else()
            ->useDepartementQuery()
                ->filterByActive(true)
                ->filterByRegionRef($region)
            ->endUse()
            ->_endif()
        ;

        if ($sort == self::RANDOM_SORT)
        {
            $query->addAscendingOrderByColumn('RAND()');
        }

        if (!is_null($count))
        {
            $query->limit($count);
        }

        return ($count == 1) ? $query->findOne() : $query->findActive();
    }

    public static function getForVille(Ville $ville, $sort = self::NO_SORT, $count = null)
    {
        $query = EtablissementQuery::create()
            ->filterByVille($ville)
        ;

        if ($sort == self::RANDOM_SORT)
        {
            $query->addAscendingOrderByColumn('RAND()');
        }

        if (!is_null($count))
        {
            $query->limit($count);
        }

        return ($count == 1) ? $query->findOne() : $query->findActive();
    }

    public static function getNbEtablissements()
    {
        return EtablissementQuery::create()
            ->findActive()
            ->count()
        ;
    }

    public static function getForDestination(Destination $destination, $sort = self::NO_SORT, $count = null)
    {
        $query = EtablissementQuery::create()
            ->filterByDestination($destination)
        ;

        if ($sort == self::RANDOM_SORT)
        {
            $query->addAscendingOrderByColumn('RAND()');
        }

        if (!is_null($count))
        {
            $query->limit($count);
        }

        return ($count == 1) ? $query->findOne() : $query->findActive();
    }
}
