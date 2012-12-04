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

    public static function getNameOrderByName(\PropelPDO $con = null)
    {
        return \Cungfoo\Model\EtablissementQuery::create()
            ->orderByName()
            ->select(array('Id', 'Code', 'Name'))
            ->find($con)
        ;
    }

    public static function getNameOrderByVille($locale = BaseEtablissementPeer::DEFAULT_LOCALE, \PropelPDO $con = null)
    {
        return \Cungfoo\Model\EtablissementQuery::create()
            ->leftJoinVille()
            ->useVilleQuery()
                ->leftJoinVilleI18n()
                ->useVilleI18nQuery()
                    ->filterByLocale($locale)
                    ->orderByName()
                ->endUse()
                ->leftJoinRegion()
                ->useRegionQuery()
                    ->useRegionI18nQuery()
                        ->filterByLocale($locale)
                        ->orderByName()
                    ->endUse()
                ->endUse()
            ->endUse()
            ->select(array('Id', 'Code', 'Region.Id', 'RegionI18n.Name', 'Ville.Id', 'VilleI18n.Name', 'Name'))
            ->find($con)
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

        return ($count == 1) ? $query->findOne() : $query->find();
    }

    public static function getForRegion(Region $region, $sort = self::NO_SORT, $count = null)
    {
        $query = EtablissementQuery::create()
            ->useVilleQuery()
                ->filterByRegion($region)
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

        return ($count == 1) ? $query->findOne() : $query->find();
    }
}
