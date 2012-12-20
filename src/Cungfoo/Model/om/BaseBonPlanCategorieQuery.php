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
 * @method BonPlanCategorieQuery orderByOrder($order = Criteria::ASC) Order by the order column
 * @method BonPlanCategorieQuery orderByActive($order = Criteria::ASC) Order by the active column
 *
 * @method BonPlanCategorieQuery groupById() Group by the id column
 * @method BonPlanCategorieQuery groupByOrder() Group by the order column
 * @method BonPlanCategorieQuery groupByActive() Group by the active column
 *
 * @method BonPlanCategorieQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method BonPlanCategorieQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method BonPlanCategorieQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method BonPlanCategorieQuery leftJoinBonPlan($relationAlias = null) Adds a LEFT JOIN clause to the query using the BonPlan relation
 * @method BonPlanCategorieQuery rightJoinBonPlan($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BonPlan relation
 * @method BonPlanCategorieQuery innerJoinBonPlan($relationAlias = null) Adds a INNER JOIN clause to the query using the BonPlan relation
 *
 * @method BonPlanCategorieQuery leftJoinBonPlanCategorieI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the BonPlanCategorieI18n relation
 * @method BonPlanCategorieQuery rightJoinBonPlanCategorieI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BonPlanCategorieI18n relation
 * @method BonPlanCategorieQuery innerJoinBonPlanCategorieI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the BonPlanCategorieI18n relation
 *
 * @method BonPlanCategorie findOne(PropelPDO $con = null) Return the first BonPlanCategorie matching the query
 * @method BonPlanCategorie findOneOrCreate(PropelPDO $con = null) Return the first BonPlanCategorie matching the query, or a new BonPlanCategorie object populated from the query conditions when no match is found
 *
 * @method BonPlanCategorie findOneByOrder(int $order) Return the first BonPlanCategorie filtered by the order column
 * @method BonPlanCategorie findOneByActive(boolean $active) Return the first BonPlanCategorie filtered by the active column
 *
 * @method array findById(int $id) Return BonPlanCategorie objects filtered by the id column
 * @method array findByOrder(int $order) Return BonPlanCategorie objects filtered by the order column
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
        $sql = 'SELECT `id`, `order`, `active` FROM `bon_plan_categorie` WHERE `id` = :p0';
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
     * Filter the query on the order column
     *
     * Example usage:
     * <code>
     * $query->filterByOrder(1234); // WHERE order = 1234
     * $query->filterByOrder(array(12, 34)); // WHERE order IN (12, 34)
     * $query->filterByOrder(array('min' => 12)); // WHERE order > 12
     * </code>
     *
     * @param     mixed $order The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BonPlanCategorieQuery The current query, for fluid interface
     */
    public function filterByOrder($order = null, $comparison = null)
    {
        if (is_array($order)) {
            $useMinMax = false;
            if (isset($order['min'])) {
                $this->addUsingAlias(BonPlanCategoriePeer::ORDER, $order['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($order['max'])) {
                $this->addUsingAlias(BonPlanCategoriePeer::ORDER, $order['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BonPlanCategoriePeer::ORDER, $order, $comparison);
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
     * Filter the query by a related BonPlan object
     *
     * @param   BonPlan|PropelObjectCollection $bonPlan  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   BonPlanCategorieQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByBonPlan($bonPlan, $comparison = null)
    {
        if ($bonPlan instanceof BonPlan) {
            return $this
                ->addUsingAlias(BonPlanCategoriePeer::ID, $bonPlan->getBonPlanCategorieId(), $comparison);
        } elseif ($bonPlan instanceof PropelObjectCollection) {
            return $this
                ->useBonPlanQuery()
                ->filterByPrimaryKeys($bonPlan->getPrimaryKeys())
                ->endUse();
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
     * @return BonPlanCategorieQuery The current query, for fluid interface
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
        $this->filterByActive(true);

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

}
