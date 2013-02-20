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

    static protected function getLocale()
    {
        if (defined('CURRENT_LANGUAGE'))
        {
            return CURRENT_LANGUAGE;
        }

        return 'fr';
    }

    static public function getForQuery(PointInteretQuery $query, $sort = self::NO_SORT, $count = null)
    {
        $query
            ->useI18nQuery(self::getLocale())
                ->filterBySlug('', \Criteria::NOT_EQUAL)
                ->filterByName('', \Criteria::NOT_EQUAL)
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

        $query->filterByActive(true);

        return ($count == 1) ? $query->findOne() : $query->findActive();
    }

    static public function getForEtablissement(Etablissement $etab, $sort = self::NO_SORT, $count = null)
    {
        if(self::getLocale() == 'de')
        {
            $query = PointInteretQuery::create()
                ->useRegionPointInteretQuery()
                    ->filterByRegionId($etab->getRegion()->getId())
                ->endUse()
            ;
        }
        else
        {
            $query = PointInteretQuery::create()
                ->useEtablissementPointInteretQuery()
                    ->filterByEtablissementId($etab->getId())
                ->endUse()
            ;
        }

        return self::getForQuery($query, $sort, $count);
    }

    static public function getCountForEtablissement(Etablissement $etab)
    {
        return PointInteretQuery::create()
            ->useEtablissementPointInteretQuery()
                ->filterByEtablissementId($etab->getId())
            ->endUse()
            ->filterByActive(true)
            ->count()
        ;
    }

    static public function getForPays(Pays $pays, $sort = self::NO_SORT, $count = null)
    {
        $query = PointInteretQuery::create()
            ->setDistinct()
            ->useEtablissementPointInteretQuery()
                ->useEtablissementQuery()
                    ->filterByActive(true)
                    ->useVilleQuery()
                        ->filterByActive(true)
                        ->useRegionQuery()
                            ->filterByActive(true)
                            ->filterByPays($pays)
                        ->endUse()
                    ->endUse()
                ->endUse()
            ->endUse()
        ;

        return self::getForQuery($query, $sort, $count);
    }

    static public function getCountForPays(Pays $pays)
    {
        return PointInteretQuery::create()
            ->setDistinct()
            ->useEtablissementPointInteretQuery()
                ->useEtablissementQuery()
                    ->filterByActive(true)
                    ->useVilleQuery()
                        ->filterByActive(true)
                        ->useRegionQuery()
                            ->filterByActive(true)
                            ->filterByPays($pays)
                        ->endUse()
                    ->endUse()
                ->endUse()
            ->endUse()
            ->filterByActive(true)
            ->count()
            ;
    }

    static public function getForRegion($region, $sort = self::NO_SORT, $count = null)
    {
        $query = PointInteretQuery::create()
            ->setDistinct()
            ->useEtablissementPointInteretQuery()
                ->useEtablissementQuery()
                    ->filterByActive(true)
                    ->useVilleQuery()
                        ->filterByActive(true)
                        ->filterByRegion($region)
                    ->endUse()
                ->endUse()
            ->endUse()
        ;

        return self::getForQuery($query, $sort, $count);
    }

    static public function getCountForRegion($region)
    {
        return PointInteretQuery::create()
            ->setDistinct()
            ->useEtablissementPointInteretQuery()
                ->useEtablissementQuery()
                    ->filterByActive(true)
                    ->useVilleQuery()
                        ->filterByActive(true)
                        ->filterByRegion($region)
                    ->endUse()
                ->endUse()
            ->endUse()
            ->filterByActive(true)
            ->count()
            ;
    }

    static public function getForRegionRef($region, $sort = self::NO_SORT, $count = null)
    {
        $query = PointInteretQuery::create()
            ->setDistinct()
            ->useEtablissementPointInteretQuery()
                ->useEtablissementQuery()
                    ->filterByActive(true)
                    ->useDepartementQuery()
                        ->filterByActive(true)
                        ->filterByRegionRef($region)
                    ->endUse()
                ->endUse()
            ->endUse()
        ;

        return self::getForQuery($query, $sort, $count);
    }

    static public function getCountForRegionRef($region)
    {
        return PointInteretQuery::create()
            ->setDistinct()
            ->useEtablissementPointInteretQuery()
                ->useEtablissementQuery()
                    ->filterByActive(true)
                    ->useDepartementQuery()
                        ->filterByActive(true)
                        ->filterByRegionRef($region)
                    ->endUse()
                ->endUse()
            ->endUse()
            ->filterByActive(true)
            ->count()
            ;
    }

    static public function getForDepartement($departement, $sort = self::NO_SORT, $count = null)
    {
        $query = PointInteretQuery::create()
            ->setDistinct()
            ->useEtablissementPointInteretQuery()
                ->useEtablissementQuery()
                    ->filterByDepartement($departement)
                    ->useDepartementQuery()
                    ->filterByActive(true)
                    ->endUse()
                ->endUse()
            ->endUse()
        ;

        return self::getForQuery($query, $sort, $count);
    }

    static public function getCountForDepartement($departement, $sort = self::NO_SORT, $count = null)
    {
        return PointInteretQuery::create()
            ->setDistinct()
            ->useEtablissementPointInteretQuery()
                ->useEtablissementQuery()
                    ->filterByDepartement($departement)
                    ->useDepartementQuery()
                    ->filterByActive(true)
                    ->endUse()
                ->endUse()
            ->endUse()
            ->count()
        ;
    }

    static public function getForVille(Ville $ville, $sort = self::NO_SORT, $count = null)
    {
        $query = PointInteretQuery::create()
            ->setDistinct()
            ->useEtablissementPointInteretQuery()
                ->useEtablissementQuery()
                    ->filterByActive(true)
                    ->filterByVille($ville)
                ->endUse()
            ->endUse()
        ;

        return self::getForQuery($query, $sort, $count);
    }

    static public function getCountForVille(Ville $ville)
    {
        return PointInteretQuery::create()
            ->setDistinct()
            ->useEtablissementPointInteretQuery()
                ->useEtablissementQuery()
                    ->filterByActive(true)
                    ->filterByVille($ville)
                ->endUse()
            ->endUse()
            ->filterByActive(true)
            ->count()
            ;
    }

    static public function getForDestination(Destination $destination, $sort = self::NO_SORT, $count = null)
    {
        $query = PointInteretQuery::create()
            ->setDistinct()
            ->useEtablissementPointInteretQuery()
                ->useEtablissementQuery()
                    ->filterByActive(true)
                    ->filterByDestination($destination)
                ->endUse()
            ->endUse()
        ;

        return self::getForQuery($query, $sort, $count);
    }

    static public function getCountForDestination(Destination $destination)
    {
        return PointInteretQuery::create()
            ->setDistinct()
            ->useEtablissementPointInteretQuery()
                ->useEtablissementQuery()
                    ->filterByActive(true)
                    ->filterByDestination($destination)
                ->endUse()
            ->endUse()
            ->filterByActive(true)
            ->count()
            ;
    }
}
