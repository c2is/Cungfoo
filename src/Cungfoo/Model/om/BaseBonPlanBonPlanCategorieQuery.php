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
use Cungfoo\Model\BonPlanBonPlanCategoriePeer;
use Cungfoo\Model\BonPlanBonPlanCategorieQuery;
use Cungfoo\Model\BonPlanCategorie;

/**
 * Base class that represents a query for the 'bon_plan_bon_plan_categorie' table.
 *
 *
 *
 * @method BonPlanBonPlanCategorieQuery orderByBonPlanId($order = Criteria::ASC) Order by the bon_plan_id column
 * @method BonPlanBonPlanCategorieQuery orderByBonPlanCategorieId($order = Criteria::ASC) Order by the bon_plan_categorie_id column
 * @method BonPlanBonPlanCategorieQuery orderBySortableRank($order = Criteria::ASC) Order by the sortable_rank column
 *
 * @method BonPlanBonPlanCategorieQuery groupByBonPlanId() Group by the bon_plan_id column
 * @method BonPlanBonPlanCategorieQuery groupByBonPlanCategorieId() Group by the bon_plan_categorie_id column
 * @method BonPlanBonPlanCategorieQuery groupBySortableRank() Group by the sortable_rank column
 *
 * @method BonPlanBonPlanCategorieQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method BonPlanBonPlanCategorieQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method BonPlanBonPlanCategorieQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method BonPlanBonPlanCategorieQuery leftJoinBonPlan($relationAlias = null) Adds a LEFT JOIN clause to the query using the BonPlan relation
 * @method BonPlanBonPlanCategorieQuery rightJoinBonPlan($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BonPlan relation
 * @method BonPlanBonPlanCategorieQuery innerJoinBonPlan($relationAlias = null) Adds a INNER JOIN clause to the query using the BonPlan relation
 *
 * @method BonPlanBonPlanCategorieQuery leftJoinBonPlanCategorie($relationAlias = null) Adds a LEFT JOIN clause to the query using the BonPlanCategorie relation
 * @method BonPlanBonPlanCategorieQuery rightJoinBonPlanCategorie($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BonPlanCategorie relation
 * @method BonPlanBonPlanCategorieQuery innerJoinBonPlanCategorie($relationAlias = null) Adds a INNER JOIN clause to the query using the BonPlanCategorie relation
 *
 * @method BonPlanBonPlanCategorie findOne(PropelPDO $con = null) Return the first BonPlanBonPlanCategorie matching the query
 * @method BonPlanBonPlanCategorie findOneOrCreate(PropelPDO $con = null) Return the first BonPlanBonPlanCategorie matching the query, or a new BonPlanBonPlanCategorie object populated from the query conditions when no match is found
 *
 * @method BonPlanBonPlanCategorie findOneByBonPlanId(int $bon_plan_id) Return the first BonPlanBonPlanCategorie filtered by the bon_plan_id column
 * @method BonPlanBonPlanCategorie findOneByBonPlanCategorieId(int $bon_plan_categorie_id) Return the first BonPlanBonPlanCategorie filtered by the bon_plan_categorie_id column
 * @method BonPlanBonPlanCategorie findOneBySortableRank(int $sortable_rank) Return the first BonPlanBonPlanCategorie filtered by the sortable_rank column
 *
 * @method array findByBonPlanId(int $bon_plan_id) Return BonPlanBonPlanCategorie objects filtered by the bon_plan_id column
 * @method array findByBonPlanCategorieId(int $bon_plan_categorie_id) Return BonPlanBonPlanCategorie objects filtered by the bon_plan_categorie_id column
 * @method array findBySortableRank(int $sortable_rank) Return BonPlanBonPlanCategorie objects filtered by the sortable_rank column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseBonPlanBonPlanCategorieQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseBonPlanBonPlanCategorieQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\BonPlanBonPlanCategorie', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new BonPlanBonPlanCategorieQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     BonPlanBonPlanCategorieQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return BonPlanBonPlanCategorieQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof BonPlanBonPlanCategorieQuery) {
            return $criteria;
        }
        $query = new BonPlanBonPlanCategorieQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array $key Primary key to use for the query
                         A Primary key composition: [$bon_plan_id, $bon_plan_categorie_id]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   BonPlanBonPlanCategorie|BonPlanBonPlanCategorie[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = BonPlanBonPlanCategoriePeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(BonPlanBonPlanCategoriePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return   BonPlanBonPlanCategorie A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `bon_plan_id`, `bon_plan_categorie_id`, `sortable_rank` FROM `bon_plan_bon_plan_categorie` WHERE `bon_plan_id` = :p0 AND `bon_plan_categorie_id` = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new BonPlanBonPlanCategorie();
            $obj->hydrate($row);
            BonPlanBonPlanCategoriePeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return BonPlanBonPlanCategorie|BonPlanBonPlanCategorie[]|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|BonPlanBonPlanCategorie[]|mixed the list of results, formatted by the current formatter
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
     * @return BonPlanBonPlanCategorieQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(BonPlanBonPlanCategoriePeer::BON_PLAN_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(BonPlanBonPlanCategoriePeer::BON_PLAN_CATEGORIE_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return BonPlanBonPlanCategorieQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(BonPlanBonPlanCategoriePeer::BON_PLAN_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(BonPlanBonPlanCategoriePeer::BON_PLAN_CATEGORIE_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the bon_plan_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBonPlanId(1234); // WHERE bon_plan_id = 1234
     * $query->filterByBonPlanId(array(12, 34)); // WHERE bon_plan_id IN (12, 34)
     * $query->filterByBonPlanId(array('min' => 12)); // WHERE bon_plan_id > 12
     * </code>
     *
     * @see       filterByBonPlan()
     *
     * @param     mixed $bonPlanId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BonPlanBonPlanCategorieQuery The current query, for fluid interface
     */
    public function filterByBonPlanId($bonPlanId = null, $comparison = null)
    {
        if (is_array($bonPlanId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(BonPlanBonPlanCategoriePeer::BON_PLAN_ID, $bonPlanId, $comparison);
    }

    /**
     * Filter the query on the bon_plan_categorie_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBonPlanCategorieId(1234); // WHERE bon_plan_categorie_id = 1234
     * $query->filterByBonPlanCategorieId(array(12, 34)); // WHERE bon_plan_categorie_id IN (12, 34)
     * $query->filterByBonPlanCategorieId(array('min' => 12)); // WHERE bon_plan_categorie_id > 12
     * </code>
     *
     * @see       filterByBonPlanCategorie()
     *
     * @param     mixed $bonPlanCategorieId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BonPlanBonPlanCategorieQuery The current query, for fluid interface
     */
    public function filterByBonPlanCategorieId($bonPlanCategorieId = null, $comparison = null)
    {
        if (is_array($bonPlanCategorieId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(BonPlanBonPlanCategoriePeer::BON_PLAN_CATEGORIE_ID, $bonPlanCategorieId, $comparison);
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
     * @return BonPlanBonPlanCategorieQuery The current query, for fluid interface
     */
    public function filterBySortableRank($sortableRank = null, $comparison = null)
    {
        if (is_array($sortableRank)) {
            $useMinMax = false;
            if (isset($sortableRank['min'])) {
                $this->addUsingAlias(BonPlanBonPlanCategoriePeer::SORTABLE_RANK, $sortableRank['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sortableRank['max'])) {
                $this->addUsingAlias(BonPlanBonPlanCategoriePeer::SORTABLE_RANK, $sortableRank['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BonPlanBonPlanCategoriePeer::SORTABLE_RANK, $sortableRank, $comparison);
    }

    /**
     * Filter the query by a related BonPlan object
     *
     * @param   BonPlan|PropelObjectCollection $bonPlan The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   BonPlanBonPlanCategorieQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByBonPlan($bonPlan, $comparison = null)
    {
        if ($bonPlan instanceof BonPlan) {
            return $this
                ->addUsingAlias(BonPlanBonPlanCategoriePeer::BON_PLAN_ID, $bonPlan->getId(), $comparison);
        } elseif ($bonPlan instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BonPlanBonPlanCategoriePeer::BON_PLAN_ID, $bonPlan->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByBonPlan() only accepts arguments of type BonPlan or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BonPlan relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return BonPlanBonPlanCategorieQuery The current query, for fluid interface
     */
    public function joinBonPlan($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BonPlan');

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
            $this->addJoinObject($join, 'BonPlan');
        }

        return $this;
    }

    /**
     * Use the BonPlan relation BonPlan object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\BonPlanQuery A secondary query class using the current class as primary query
     */
    public function useBonPlanQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBonPlan($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BonPlan', '\Cungfoo\Model\BonPlanQuery');
    }

    /**
     * Filter the query by a related BonPlanCategorie object
     *
     * @param   BonPlanCategorie|PropelObjectCollection $bonPlanCategorie The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   BonPlanBonPlanCategorieQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByBonPlanCategorie($bonPlanCategorie, $comparison = null)
    {
        if ($bonPlanCategorie instanceof BonPlanCategorie) {
            return $this
                ->addUsingAlias(BonPlanBonPlanCategoriePeer::BON_PLAN_CATEGORIE_ID, $bonPlanCategorie->getId(), $comparison);
        } elseif ($bonPlanCategorie instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BonPlanBonPlanCategoriePeer::BON_PLAN_CATEGORIE_ID, $bonPlanCategorie->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByBonPlanCategorie() only accepts arguments of type BonPlanCategorie or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BonPlanCategorie relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return BonPlanBonPlanCategorieQuery The current query, for fluid interface
     */
    public function joinBonPlanCategorie($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BonPlanCategorie');

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
            $this->addJoinObject($join, 'BonPlanCategorie');
        }

        return $this;
    }

    /**
     * Use the BonPlanCategorie relation BonPlanCategorie object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\BonPlanCategorieQuery A secondary query class using the current class as primary query
     */
    public function useBonPlanCategorieQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBonPlanCategorie($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BonPlanCategorie', '\Cungfoo\Model\BonPlanCategorieQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   BonPlanBonPlanCategorie $bonPlanBonPlanCategorie Object to remove from the list of results
     *
     * @return BonPlanBonPlanCategorieQuery The current query, for fluid interface
     */
    public function prune($bonPlanBonPlanCategorie = null)
    {
        if ($bonPlanBonPlanCategorie) {
            $this->addCond('pruneCond0', $this->getAliasedColName(BonPlanBonPlanCategoriePeer::BON_PLAN_ID), $bonPlanBonPlanCategorie->getBonPlanId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(BonPlanBonPlanCategoriePeer::BON_PLAN_CATEGORIE_ID), $bonPlanBonPlanCategorie->getBonPlanCategorieId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    // sortable behavior

    /**
     * Returns the objects in a certain list, from the list scope
     *
     * @param     int $scope		Scope to determine which objects node to return
     *
     * @return    BonPlanBonPlanCategorieQuery The current query, for fluid interface
     */
    public function inList($scope = null)
    {
        return $this->addUsingAlias(BonPlanBonPlanCategoriePeer::SCOPE_COL, $scope, Criteria::EQUAL);
    }

    /**
     * Filter the query based on a rank in the list
     *
     * @param     integer   $rank rank
     * @param     int $scope		Scope to determine which suite to consider
     *
     * @return    BonPlanBonPlanCategorieQuery The current query, for fluid interface
     */
    public function filterByRank($rank, $scope = null)
    {
        return $this
            ->inList($scope)
            ->addUsingAlias(BonPlanBonPlanCategoriePeer::RANK_COL, $rank, Criteria::EQUAL);
    }

    /**
     * Order the query based on the rank in the list.
     * Using the default $order, returns the item with the lowest rank first
     *
     * @param     string $order either Criteria::ASC (default) or Criteria::DESC
     *
     * @return    BonPlanBonPlanCategorieQuery The current query, for fluid interface
     */
    public function orderByRank($order = Criteria::ASC)
    {
        $order = strtoupper($order);
        switch ($order) {
            case Criteria::ASC:
                return $this->addAscendingOrderByColumn($this->getAliasedColName(BonPlanBonPlanCategoriePeer::RANK_COL));
                break;
            case Criteria::DESC:
                return $this->addDescendingOrderByColumn($this->getAliasedColName(BonPlanBonPlanCategoriePeer::RANK_COL));
                break;
            default:
                throw new PropelException('BonPlanBonPlanCategorieQuery::orderBy() only accepts "asc" or "desc" as argument');
        }
    }

    /**
     * Get an item from the list based on its rank
     *
     * @param     integer   $rank rank
     * @param     int $scope		Scope to determine which suite to consider
     * @param     PropelPDO $con optional connection
     *
     * @return    BonPlanBonPlanCategorie
     */
    public function findOneByRank($rank, $scope = null, PropelPDO $con = null)
    {
        return $this
            ->filterByRank($rank, $scope)
            ->findOne($con);
    }

    /**
     * Returns a list of objects
     *
     * @param      int $scope		Scope to determine which list to return
     * @param      PropelPDO $con	Connection to use.
     *
     * @return     mixed the list of results, formatted by the current formatter
     */
    public function findList($scope = null, $con = null)
    {
        return $this
            ->inList($scope)
            ->orderByRank()
            ->find($con);
    }

    /**
     * Get the highest rank
     *
     * @param      int $scope		Scope to determine which suite to consider
     * @param     PropelPDO optional connection
     *
     * @return    integer highest position
     */
    public function getMaxRank($scope = null, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(BonPlanBonPlanCategoriePeer::DATABASE_NAME);
        }
        // shift the objects with a position lower than the one of object
        $this->addSelectColumn('MAX(' . BonPlanBonPlanCategoriePeer::RANK_COL . ')');
        $this->add(BonPlanBonPlanCategoriePeer::SCOPE_COL, $scope, Criteria::EQUAL);
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
            $con = Propel::getConnection(BonPlanBonPlanCategoriePeer::DATABASE_NAME);
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
