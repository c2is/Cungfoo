<?php

namespace Cungfoo\Model;

use Cungfoo\Model\om\BaseEventPeer;


/**
 * Skeleton subclass for performing query and update operations on the 'event' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.Cungfoo.Model
 */
class EventPeer extends BaseEventPeer
{
    const CATEGORY_SPORTIVE = 'SPO';

    const NO_SORT          = 0;
    const RANDOM_SORT      = 1;
    const SORT_BY_PRIORITY = 2;

    static protected function getLocale()
    {
        if (defined('CURRENT_LANGUAGE'))
        {
            return CURRENT_LANGUAGE;
        }

        return 'fr';
    }

    static public function getForQuery(EventQuery $query, $sort = self::NO_SORT, $count = null, $category = null, $criteriaOperation = null)
    {
        $query
            ->useI18nQuery(self::getLocale())
                ->filterBySlug('', \Criteria::NOT_EQUAL)
                ->filterByDescription('', \Criteria::NOT_EQUAL)
                ->filterByName('', \Criteria::NOT_EQUAL)
            ->endUse()
        ;

        switch ($sort)
        {
            case self::RANDOM_SORT:
                $query->addAscendingOrderByColumn('RAND()');
                break;

            case self::SORT_BY_PRIORITY:
                $query->orderByPriority(\Criteria::ASC);
                break;
        }

        if (!is_null($count))
        {
            $query->limit($count);
        }

        if (!is_null($category))
        {
            $query->filterByCategory($category, (!is_null($criteriaOperation)) ? $criteriaOperation : \Criteria::EQUAL);
        }

        return ($count == 1) ? $query->findOne() : $query->findActive();
    }

    static public function getForEtablissement(Etablissement $etab, $sort = self::NO_SORT, $count = null, $category = null, $criteriaOperation = null)
    {
        if(self::getLocale() == 'de')
        {
            $query = EventQuery::create()
                ->useRegionEventQuery()
                    ->filterByRegionId($etab->getRegion()->getId())
                ->endUse()
            ;
        }
        else
        {
            $query = EventQuery::create()
                ->useEtablissementEventQuery()
                    ->filterByEtablissementId($etab->getId())
                ->endUse()
            ;
        }

        return self::getForQuery($query, $sort, $count, $category, $criteriaOperation);
    }

    static public function getCountForEtablissement(Etablissement $etab, $category = null, $criteriaOperation = null)
    {
        $query = EventQuery::create()
            ->useEtablissementEventQuery()
                ->filterByEtablissementId($etab->getId())
            ->endUse()
        ;

        if (!is_null($category))
        {
            $query->filterByCategory($category, (!is_null($criteriaOperation)) ? $criteriaOperation : \Criteria::EQUAL);
        }

        $query->filterByActive(true);

        return $query->count();
    }

    static public function getForPays(Pays $pays, $sort = self::NO_SORT, $count = null, $category = null, $criteriaOperation = null)
    {
        $query = EventQuery::create()
            ->setDistinct()
            ->useEtablissementEventQuery()
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

        return self::getForQuery($query, $sort, $count, $category, $criteriaOperation);
    }

    static public function getForRegion($region, $sort = self::NO_SORT, $count = null, $category = null, $criteriaOperation = null)
    {
        $query = EventQuery::create()
            ->setDistinct()
            ->useEtablissementEventQuery()
                ->useEtablissementQuery()
                    ->filterByActive(true)
                    ->useVilleQuery()
                        ->filterByActive(true)
                        ->filterByRegion($region)
                    ->endUse()
                ->endUse()
            ->endUse()
        ;

        return self::getForQuery($query, $sort, $count, $category, $criteriaOperation);
    }

    static public function getForDepartement($departement, $sort = self::NO_SORT, $count = null, $category = null, $criteriaOperation = null)
    {
        $query = EventQuery::create()
            ->setDistinct()
            ->useEtablissementEventQuery()
                ->useEtablissementQuery()
                    ->filterByDepartement($departement)
                    ->useDepartementQuery()
                    ->filterByActive(true)
                    ->endUse()
                ->endUse()
            ->endUse()
        ;

        return self::getForQuery($query, $sort, $count, $category, $criteriaOperation);
    }

    static public function getForRegionRef($region, $sort = self::NO_SORT, $count = null, $category = null, $criteriaOperation = null)
    {
        $query = EventQuery::create()
            ->setDistinct()
            ->useEtablissementEventQuery()
                ->useEtablissementQuery()
                    ->filterByActive(true)
                    ->useDepartementQuery()
                        ->filterByActive(true)
                        ->filterByRegionRef($region)
                    ->endUse()
                ->endUse()
            ->endUse()
        ;

        return self::getForQuery($query, $sort, $count, $category, $criteriaOperation);
    }

    static public function getForVille(Ville $ville, $sort = self::NO_SORT, $count = null, $category = null, $criteriaOperation = null)
    {
        $query = EventQuery::create()
            ->setDistinct()
            ->useEtablissementEventQuery()
                ->useEtablissementQuery()
                    ->filterByActive(true)
                    ->filterByVille($ville)
                ->endUse()
            ->endUse()
        ;

        return self::getForQuery($query, $sort, $count, $category, $criteriaOperation);
    }

    static public function getForDestination(Destination $destination, $sort = self::NO_SORT, $count = null, $category = null, $criteriaOperation = null)
    {
        $query = EventQuery::create()
            ->setDistinct()
            ->useEtablissementEventQuery()
                ->useEtablissementQuery()
                    ->filterByActive(true)
                    ->filterByDestination($destination)
                ->endUse()
            ->endUse()
        ;

        return self::getForQuery($query, $sort, $count, $category, $criteriaOperation);
    }
}
