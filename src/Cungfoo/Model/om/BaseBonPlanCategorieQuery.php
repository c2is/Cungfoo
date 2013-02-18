<?php

namespace Cungfoo\Model\om;

use \Criteria;
use \Exception;
use \ModelCriteria;
use \ModelJoin;
use \PDO;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Cungfoo\Model\BonPlan;
use Cungfoo\Model\BonPlanBonPlanCategorie;
use Cungfoo\Model\BonPlanCategorie;
use Cungfoo\Model\BonPlanCategorieI18n;
use Cungfoo\Model\BonPlanCategoriePeer;
use Cungfoo\Model\BonPlanCategorieQuery;

/**
 * Base class that represents a query for the 'bon_plan_categorie' table.
 *
 *
 *
 * @method BonPlanCategorieQuery orderById($order = Criteria::ASC) Order by the id column
 * @method BonPlanCategorieQuery orderBySortableRank($order = Criteria::ASC) Order by the sortable_rank column
 * @method BonPlanCategorieQuery orderByActive($order = Criteria::ASC) Order by the active column
 *
 * @method BonPlanCategorieQuery groupById() Group by the id column
 * @method BonPlanCategorieQuery groupBySortableRank() Group by the sortable_rank column
 * @method BonPlanCategorieQuery groupByActive() Group by the active column
 *
 * @method BonPlanCategorieQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method BonPlanCategorieQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method BonPlanCategorieQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method BonPlanCategorieQuery leftJoinBonPlanBonPlanCategorie($relationAlias = null) Adds a LEFT JOIN clause to the query using the BonPlanBonPlanCategorie relation
 * @method BonPlanCategorieQuery rightJoinBonPlanBonPlanCategorie($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BonPlanBonPlanCategorie relation
 * @method BonPlanCategorieQuery innerJoinBonPlanBonPlanCategorie($relationAlias = null) Adds a INNER JOIN clause to the query using the BonPlanBonPlanCategorie relation
 *
 * @method BonPlanCategorieQuery leftJoinBonPlanCategorieI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the BonPlanCategorieI18n relation
 * @method BonPlanCategorieQuery rightJoinBonPlanCategorieI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BonPlanCategorieI18n relation
 * @method BonPlanCategorieQuery innerJoinBonPlanCategorieI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the BonPlanCategorieI18n relation
 *
 * @method BonPlanCategorie findOne(PropelPDO $con = null) Return the first BonPlanCategorie matching the query
 * @method BonPlanCategorie findOneOrCreate(PropelPDO $con = null) Return the first BonPlanCategorie matching the query, or a new BonPlanCategorie object populated from the query conditions when no match is found
 *
 * @method BonPlanCategorie findOneBySortableRank(int $sortable_rank) Return the first BonPlanCategorie filtered by the sortable_rank column
 * @method BonPlanCategorie findOneByActive(boolean $active) Return the first BonPlanCategorie filtered by the active column
 *
 * @method array findById(int $id) Return BonPlanCategorie objects filtered by the id column
 * @method array findBySortableRank(int $sortable_rank) Return BonPlanCategorie objects filtered by the sortable_rank column
 * @method array findByActive(boolean $active) Return BonPlanCategorie objects filtered by the active column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseBonPlanCategorieQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseBonPlanCategorieQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\BonPlanCategorie', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new BonPlanCategorieQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     BonPlanCategorieQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return BonPlanCategorieQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof BonPlanCategorieQuery) {
            return $criteria;
        }
        $query = new BonPlanCategorieQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   BonPlanCategorie|BonPlanCategorie[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = BonPlanCategoriePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(BonPlanCategoriePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return   BonPlanCategorie A model object, or null if the key is not found
     * @throws   PropelException
     */
     public function findOneById($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return   BonPlanCategorie A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `sortable_rank`, `active` FROM `bon_plan_categorie` WHERE `id` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new BonPlanCategorie();
            $obj->hydrate($row);
            BonPlanCategoriePeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return BonPlanCategorie|BonPlanCategorie[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|BonPlanCategorie[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return BonPlanCategorieQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(BonPlanCategoriePeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return BonPlanCategorieQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(BonPlanCategoriePeer::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BonPlanCategorieQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(BonPlanCategoriePeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the sortable_rank column
     *
     * Example usage:
     * <code>
     * $query->filterBySortableRank(1234); // WHERE sortable_rank = 1234
     * $query->filterBySortableRank(array(12, 34)); // WHERE sortable_rank IN (12, 34)
     * $query->filterBySortableRank(array('min' => 12)); // WHERE sortable_rank > 12
     * </code>
     *
     * @param     mixed $sortableRank The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BonPlanCategorieQuery The current query, for fluid interface
     */
    public function filterBySortableRank($sortableRank = null, $comparison = null)
    {
        if (is_array($sortableRank)) {
            $useMinMax = false;
            if (isset($sortableRank['min'])) {
                $this->addUsingAlias(BonPlanCategoriePeer::SORTABLE_RANK, $sortableRank['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sortableRank['max'])) {
                $this->addUsingAlias(BonPlanCategoriePeer::SORTABLE_RANK, $sortableRank['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BonPlanCategoriePeer::SORTABLE_RANK, $sortableRank, $comparison);
    }

    /**
     * Filter the query on the active column
     *
     * Example usage:
     * <code>
     * $query->filterByActive(true); // WHERE active = true
     * $query->filterByActive('yes'); // WHERE active = true
     * </code>
     *
     * @param     boolean|string $active The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BonPlanCategorieQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(BonPlanCategoriePeer::ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query by a related BonPlanBonPlanCategorie object
     *
     * @param   BonPlanBonPlanCategorie|PropelObjectCollection $bonPlanBonPlanCategorie  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   BonPlanCategorieQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByBonPlanBonPlanCategorie($bonPlanBonPlanCategorie, $comparison = null)
    {
        if ($bonPlanBonPlanCategorie instanceof BonPlanBonPlanCategorie) {
            return $this
                ->addUsingAlias(BonPlanCategoriePeer::ID, $bonPlanBonPlanCategorie->getBonPlanCategorieId(), $comparison);
        } elseif ($bonPlanBonPlanCategorie instanceof PropelObjectCollection) {
            return $this
                ->useBonPlanBonPlanCategorieQuery()
                ->filterByPrimaryKeys($bonPlanBonPlanCategorie->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBonPlanBonPlanCategorie() only accepts arguments of type BonPlanBonPlanCategorie or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BonPlanBonPlanCategorie relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return BonPlanCategorieQuery The current query, for fluid interface
     */
    public function joinBonPlanBonPlanCategorie($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BonPlanBonPlanCategorie');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'BonPlanBonPlanCategorie');
        }

        return $this;
    }

    /**
     * Use the BonPlanBonPlanCategorie relation BonPlanBonPlanCategorie object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\BonPlanBonPlanCategorieQuery A secondary query class using the current class as primary query
     */
    public function useBonPlanBonPlanCategorieQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBonPlanBonPlanCategorie($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BonPlanBonPlanCategorie', '\Cungfoo\Model\BonPlanBonPlanCategorieQuery');
    }

    /**
     * Filter the query by a related BonPlanCategorieI18n object
     *
     * @param   BonPlanCategorieI18n|PropelObjectCollection $bonPlanCategorieI18n  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   BonPlanCategorieQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByBonPlanCategorieI18n($bonPlanCategorieI18n, $comparison = null)
    {
        if ($bonPlanCategorieI18n instanceof BonPlanCategorieI18n) {
            return $this
                ->addUsingAlias(BonPlanCategoriePeer::ID, $bonPlanCategorieI18n->getId(), $comparison);
        } elseif ($bonPlanCategorieI18n instanceof PropelObjectCollection) {
            return $this
                ->useBonPlanCategorieI18nQuery()
                ->filterByPrimaryKeys($bonPlanCategorieI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBonPlanCategorieI18n() only accepts arguments of type BonPlanCategorieI18n or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BonPlanCategorieI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return BonPlanCategorieQuery The current query, for fluid interface
     */
    public function joinBonPlanCategorieI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BonPlanCategorieI18n');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'BonPlanCategorieI18n');
        }

        return $this;
    }

    /**
     * Use the BonPlanCategorieI18n relation BonPlanCategorieI18n object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\BonPlanCategorieI18nQuery A secondary query class using the current class as primary query
     */
    public function useBonPlanCategorieI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinBonPlanCategorieI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BonPlanCategorieI18n', '\Cungfoo\Model\BonPlanCategorieI18nQuery');
    }

    /**
     * Filter the query by a related BonPlan object
     * using the bon_plan_bon_plan_categorie table as cross reference
     *
     * @param   BonPlan $bonPlan the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   BonPlanCategorieQuery The current query, for fluid interface
     */
    public function filterByBonPlan($bonPlan, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useBonPlanBonPlanCategorieQuery()
            ->filterByBonPlan($bonPlan, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   BonPlanCategorie $bonPlanCategorie Object to remove from the list of results
     *
     * @return BonPlanCategorieQuery The current query, for fluid interface
     */
    public function prune($bonPlanCategorie = null)
    {
        if ($bonPlanCategorie) {
            $this->addUsingAlias(BonPlanCategoriePeer::ID, $bonPlanCategorie->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // active behavior


    /**
     * return only active objects
     *
     * @return boolean
     */
    public function findActive($con = null)
    {
        $locale = defined('CURRENT_LANGUAGE') ? CURRENT_LANGUAGE : 'fr';

        $this
            ->filterByActive(true)
            ->useI18nQuery($locale, 'i18n_locale')
                ->filterByActiveLocale(true)
            ->endUse()
        ;

        return parent::find($con);
    }
    // i18n behavior

    /**
     * Adds a JOIN clause to the query using the i18n relation
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    BonPlanCategorieQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'BonPlanCategorieI18n';

        return $this
            ->joinBonPlanCategorieI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    BonPlanCategorieQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'fr', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('BonPlanCategorieI18n');
        $this->with['BonPlanCategorieI18n']->setIsWithOneToMany(false);

        return $this;
    }

    /**
     * Use the I18n relation query object
     *
     * @see       useQuery()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    BonPlanCategorieI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BonPlanCategorieI18n', 'Cungfoo\Model\BonPlanCategorieI18nQuery');
    }

    // sortable behavior

    /**
     * Filter the query based on a rank in the list
     *
     * @param     integer   $rank rank
     *
     * @return    BonPlanCategorieQuery The current query, for fluid interface
     */
    public function filterByRank($rank)
    {
        return $this
            ->addUsingAlias(BonPlanCategoriePeer::RANK_COL, $rank, Criteria::EQUAL);
    }

    /**
     * Order the query based on the rank in the list.
     * Using the default $order, returns the item with the lowest rank first
     *
     * @param     string $order either Criteria::ASC (default) or Criteria::DESC
     *
     * @return    BonPlanCategorieQuery The current query, for fluid interface
     */
    public function orderByRank($order = Criteria::ASC)
    {
        $order = strtoupper($order);
        switch ($order) {
            case Criteria::ASC:
                return $this->addAscendingOrderByColumn($this->getAliasedColName(BonPlanCategoriePeer::RANK_COL));
                break;
            case Criteria::DESC:
                return $this->addDescendingOrderByColumn($this->getAliasedColName(BonPlanCategoriePeer::RANK_COL));
                break;
            default:
                throw new PropelException('BonPlanCategorieQuery::orderBy() only accepts "asc" or "desc" as argument');
        }
    }

    /**
     * Get an item from the list based on its rank
     *
     * @param     integer   $rank rank
     * @param     PropelPDO $con optional connection
     *
     * @return    BonPlanCategorie
     */
    public function findOneByRank($rank, PropelPDO $con = null)
    {
        return $this
            ->filterByRank($rank)
            ->findOne($con);
    }

    /**
     * Returns the list of objects
     *
     * @param      PropelPDO $con	Connection to use.
     *
     * @return     mixed the list of results, formatted by the current formatter
     */
    public function findList($con = null)
    {
        return $this
            ->orderByRank()
            ->find($con);
    }

    /**
     * Get the highest rank
     *
     * @param     PropelPDO optional connection
     *
     * @return    integer highest position
     */
    public function getMaxRank(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(BonPlanCategoriePeer::DATABASE_NAME);
        }
        // shift the objects with a position lower than the one of object
        $this->addSelectColumn('MAX(' . BonPlanCategoriePeer::RANK_COL . ')');
        $stmt = $this->doSelect($con);

        return $stmt->fetchColumn();
    }

    /**
     * Reorder a set of sortable objects based on a list of id/position
     * Beware that there is no check made on the positions passed
     * So incoherent positions will result in an incoherent list
     *
     * @param     array     $order id => rank pairs
     * @param     PropelPDO $con   optional connection
     *
     * @return    boolean true if the reordering took place, false if a database problem prevented it
     */
    public function reorder(array $order, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(BonPlanCategoriePeer::DATABASE_NAME);
        }

        $con->beginTransaction();
        try {
            $ids = array_keys($order);
            $objects = $this->findPks($ids, $con);
            foreach ($objects as $object) {
                $pk = $object->getPrimaryKey();
                if ($object->getSortableRank() != $order[$pk]) {
                    $object->setSortableRank($order[$pk]);
                    $object->save($con);
                }
            }
            $con->commit();

            return true;
        } catch (PropelException $e) {
            $con->rollback();
            throw $e;
        }
    }

}
