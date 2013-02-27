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

        return $query
            ->useI18nQuery(self::getLocale())
                ->filterByActiveLocale(true)
            ->endUse()
            ->filterByActive(true)
            ->count()
        ;
    }

    static public function getForPays(Pays $pays, $sort = self::NO_SORT, $count = null)
    {
        if(self::getLocale() == 'de')
        {
            $query = PointInteretQuery::create()
                ->useRegionPointInteretQuery()
                    ->useRegionQuery()
                        ->filterByActive(true)
                        ->filterByPays($pays)
                    ->endUse()
                ->endUse()
            ;
        }
        else
        {
            $query = PointInteretQuery::create()
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
        }

        $query->setDistinct();

        return self::getForQuery($query, $sort, $count);
    }

    static public function getCountForPays(Pays $pays)
    {
        if(self::getLocale() == 'de')
        {
            $query = PointInteretQuery::create()
                ->useRegionPointInteretQuery()
                    ->useRegionQuery()
                        ->filterByActive(true)
                        ->filterByPays($pays)
                    ->endUse()
                ->endUse()
            ;
        }
        else
        {
            $query = PointInteretQuery::create()
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
        }

        return $query
            ->setDistinct()
            ->filterByActive(true)
            ->count()
            ;
    }

    static public function getForRegion($region, $sort = self::NO_SORT, $count = null)
    {
        if(self::getLocale() == 'de')
        {
            $query = PointInteretQuery::create()
                ->useRegionPointInteretQuery()
                    ->filterByRegion($region)
                ->endUse()
            ;
        }
        else
        {
            $query = PointInteretQuery::create()
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
        }

        $query->setDistinct();

        return self::getForQuery($query, $sort, $count);
    }

    static public function getCountForRegion($region)
    {
        if(self::getLocale() == 'de')
        {
            $query = PointInteretQuery::create()
                ->useRegionPointInteretQuery()
                    ->filterByRegion($region)
                ->endUse()
            ;
        }
        else
        {
            $query = PointInteretQuery::create()
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
        }

        return $query
            ->setDistinct()
            ->filterByActive(true)
            ->count()
        ;
    }

    static public function getForRegionRef($region, $sort = self::NO_SORT, $count = null)
    {
        if(self::getLocale() == 'de')
        {
            $query = PointInteretQuery::create()
                ->useRegionPointInteretQuery()
                    ->useRegionQuery()
                        ->filterByActive(true)
                        ->useVilleQuery()
                            ->filterByActive(true)
                            ->useEtablissementQuery()
                                ->filterByActive(true)
                                ->useDepartementQuery()
                                    ->filterByActive(true)
                                    ->filterByRegionRef($region)
                                ->endUse()
                            ->endUse()
                        ->endUse()
                    ->endUse()
                ->endUse()
            ;
        }
        else
        {
            $query = PointInteretQuery::create()
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
        }

        $query->setDistinct();

        return self::getForQuery($query, $sort, $count);
    }

    static public function getCountForRegionRef($region)
    {
        if(self::getLocale() == 'de')
        {
            $query = PointInteretQuery::create()
                ->useRegionPointInteretQuery()
                    ->useRegionQuery()
                        ->filterByActive(true)
                        ->useVilleQuery()
                            ->filterByActive(true)
                            ->useEtablissementQuery()
                                ->filterByActive(true)
                                ->useDepartementQuery()
                                    ->filterByActive(true)
                                    ->filterByRegionRef($region)
                                ->endUse()
                            ->endUse()
                        ->endUse()
                    ->endUse()
                ->endUse()
            ;
        }
        else
        {
            $query = PointInteretQuery::create()
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
        }

        return $query
            ->setDistinct()
            ->filterByActive(true)
            ->count()
        ;
    }

    static public function getForDepartement($departement, $sort = self::NO_SORT, $count = null)
    {
        if(self::getLocale() == 'de')
        {
            $query = PointInteretQuery::create()
                ->useRegionPointInteretQuery()
                    ->useRegionQuery()
                        ->filterByActive(true)
                        ->useVilleQuery()
                            ->filterByActive(true)
                            ->useEtablissementQuery()
                                ->filterByActive(true)
                                ->filterByDepartement($departement)
                            ->endUse()
                        ->endUse()
                    ->endUse()
                ->endUse()
            ;
        }
        else
        {
            $query = PointInteretQuery::create()
                ->useEtablissementPointInteretQuery()
                    ->useEtablissementQuery()
                        ->filterByDepartement($departement)
                        ->useDepartementQuery()
                            ->filterByActive(true)
                        ->endUse()
                    ->endUse()
                ->endUse()
            ;
        }

        $query->setDistinct();

        return self::getForQuery($query, $sort, $count);
    }

    static public function getCountForDepartement($departement, $sort = self::NO_SORT, $count = null)
    {
        if(self::getLocale() == 'de')
        {
            $query = PointInteretQuery::create()
                ->useRegionPointInteretQuery()
                    ->useRegionQuery()
                        ->filterByActive(true)
                        ->useVilleQuery()
                            ->filterByActive(true)
                            ->useEtablissementQuery()
                                ->filterByActive(true)
                                ->filterByDepartement($departement)
                            ->endUse()
                        ->endUse()
                    ->endUse()
                ->endUse()
            ;
        }
        else
        {
            $query = PointInteretQuery::create()
                ->useEtablissementPointInteretQuery()
                    ->useEtablissementQuery()
                        ->filterByDepartement($departement)
                        ->useDepartementQuery()
                            ->filterByActive(true)
                        ->endUse()
                    ->endUse()
                ->endUse()
            ;
        }

        $query
            ->setDistinct()
            ->count()
        ;
    }

    static public function getForVille(Ville $ville, $sort = self::NO_SORT, $count = null)
    {
        if(self::getLocale() == 'de')
        {
            $query = PointInteretQuery::create()
                ->useRegionPointInteretQuery()
                    ->useRegionQuery()
                        ->filterByActive(true)
                            ->filterByVille($ville)
                        ->endUse()
                    ->endUse()
                ->endUse()
            ;
        }
        else
        {
            $query = PointInteretQuery::create()
                ->useEtablissementPointInteretQuery()
                    ->useEtablissementQuery()
                        ->filterByActive(true)
                        ->filterByVille($ville)
                    ->endUse()
                ->endUse()
            ;
        }

        $query->setDistinct();

        return self::getForQuery($query, $sort, $count);
    }

    static public function getCountForVille(Ville $ville)
    {
        if(self::getLocale() == 'de')
        {
            $query = PointInteretQuery::create()
                ->useRegionPointInteretQuery()
                    ->useRegionQuery()
                        ->filterByActive(true)
                            ->filterByVille($ville)
                        ->endUse()
                    ->endUse()
                ->endUse()
            ;
        }
        else
        {
            $query = PointInteretQuery::create()
                ->useEtablissementPointInteretQuery()
                    ->useEtablissementQuery()
                        ->filterByActive(true)
                        ->filterByVille($ville)
                    ->endUse()
                ->endUse()
            ;
        }

        $query
            ->setDistinct()
            ->filterByActive(true)
            ->count()
        ;
    }

    static public function getForDestination(Destination $destination, $sort = self::NO_SORT, $count = null)
    {
        if(self::getLocale() == 'de')
        {
            $query = PointInteretQuery::create()
                ->useRegionPointInteretQuery()
                    ->useRegionQuery()
                        ->filterByActive(true)
                        ->useVilleQuery()
                            ->filterByActive(true)
                            ->useEtablissementQuery()
                                ->filterByActive(true)
                                ->filterByDestination($destination)
                            ->endUse()
                        ->endUse()
                    ->endUse()
                ->endUse()
            ;
        }
        else
        {
            $query = PointInteretQuery::create()
                ->useEtablissementPointInteretQuery()
                    ->useEtablissementQuery()
                        ->filterByActive(true)
                        ->filterByDestination($destination)
                    ->endUse()
                ->endUse()
            ;
        }

        $query->setDistinct();

        return self::getForQuery($query, $sort, $count);
    }

    static public function getCountForDestination(Destination $destination)
    {
        if(self::getLocale() == 'de')
        {
            $query = PointInteretQuery::create()
                ->useRegionPointInteretQuery()
                    ->useRegionQuery()
                        ->filterByActive(true)
                        ->useVilleQuery()
                            ->filterByActive(true)
                            ->useEtablissementQuery()
                                ->filterByActive(true)
                                ->filterByDestination($destination)
                            ->endUse()
                        ->endUse()
                    ->endUse()
                ->endUse()
            ;
        }
        else
        {
            $query = PointInteretQuery::create()
                ->useEtablissementPointInteretQuery()
                    ->useEtablissementQuery()
                        ->filterByActive(true)
                        ->filterByDestination($destination)
                    ->endUse()
                ->endUse()
            ;
        }

        return PointInteretQuery::create()
            ->setDistinct()
            ->filterByActive(true)
            ->count()
        ;
    }
}
