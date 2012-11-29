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

    static public function getForEtablissement(Etablissement $etab, $sort = self::NO_SORT, $count = null, $category = null, $criteriaOperation = null)
    {
        $query = EventQuery::create()
            ->useEtablissementEventQuery()
                ->filterByEtablissementId($etab->getId())
            ->endUse()
            ->addAscendingOrderByColumn('RAND()')
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

        return ($count == 1) ? $query->findOne() : $query->find();
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

        return $query->count();
    }

    static public function getForPays(Pays $pays, $sort = self::NO_SORT, $count = null, $category = null, $criteriaOperation = null)
    {
        $query = EventQuery::create()
            ->useEtablissementEventQuery()
            ->useEtablissementQuery()
            ->useVilleQuery()
            ->useRegionQuery()
            ->filterByPays($pays)
            ->endUse()
            ->endUse()
            ->endUse()
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

        return ($count == 1) ? $query->findOne() : $query->find();
    }

    static public function getForRegion(Region $region, $sort = self::NO_SORT, $count = null, $category = null, $criteriaOperation = null)
    {
        $query = EventQuery::create()
            ->useEtablissementEventQuery()
                ->useEtablissementQuery()
                    ->useVilleQuery()
                        ->filterByRegion($region)
                    ->endUse()
                ->endUse()
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

        return ($count == 1) ? $query->findOne() : $query->find();
    }

    static public function getForVille(Ville $ville, $sort = self::NO_SORT, $count = null, $category = null, $criteriaOperation = null)
    {
        $query = EventQuery::create()
            ->useEtablissementEventQuery()
                ->useEtablissementQuery()
                    ->filterByVille($ville)
                ->endUse()
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

        return ($count == 1) ? $query->findOne() : $query->find();
    }
}
