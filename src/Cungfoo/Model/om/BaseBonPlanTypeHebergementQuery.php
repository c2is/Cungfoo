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
use Cungfoo\Model\BonPlanTypeHebergement;
use Cungfoo\Model\BonPlanTypeHebergementPeer;
use Cungfoo\Model\BonPlanTypeHebergementQuery;
use Cungfoo\Model\TypeHebergement;

/**
 * Base class that represents a query for the 'bon_plan_type_hebergement' table.
 *
 *
 *
 * @method BonPlanTypeHebergementQuery orderByBonPlanId($order = Criteria::ASC) Order by the bon_plan_id column
 * @method BonPlanTypeHebergementQuery orderByTypeHebergementId($order = Criteria::ASC) Order by the type_hebergement_id column
 *
 * @method BonPlanTypeHebergementQuery groupByBonPlanId() Group by the bon_plan_id column
 * @method BonPlanTypeHebergementQuery groupByTypeHebergementId() Group by the type_hebergement_id column
 *
 * @method BonPlanTypeHebergementQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method BonPlanTypeHebergementQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method BonPlanTypeHebergementQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method BonPlanTypeHebergementQuery leftJoinBonPlan($relationAlias = null) Adds a LEFT JOIN clause to the query using the BonPlan relation
 * @method BonPlanTypeHebergementQuery rightJoinBonPlan($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BonPlan relation
 * @method BonPlanTypeHebergementQuery innerJoinBonPlan($relationAlias = null) Adds a INNER JOIN clause to the query using the BonPlan relation
 *
 * @method BonPlanTypeHebergementQuery leftJoinTypeHebergement($relationAlias = null) Adds a LEFT JOIN clause to the query using the TypeHebergement relation
 * @method BonPlanTypeHebergementQuery rightJoinTypeHebergement($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TypeHebergement relation
 * @method BonPlanTypeHebergementQuery innerJoinTypeHebergement($relationAlias = null) Adds a INNER JOIN clause to the query using the TypeHebergement relation
 *
 * @method BonPlanTypeHebergement findOne(PropelPDO $con = null) Return the first BonPlanTypeHebergement matching the query
 * @method BonPlanTypeHebergement findOneOrCreate(PropelPDO $con = null) Return the first BonPlanTypeHebergement matching the query, or a new BonPlanTypeHebergement object populated from the query conditions when no match is found
 *
 * @method BonPlanTypeHebergement findOneByBonPlanId(int $bon_plan_id) Return the first BonPlanTypeHebergement filtered by the bon_plan_id column
 * @method BonPlanTypeHebergement findOneByTypeHebergementId(int $type_hebergement_id) Return the first BonPlanTypeHebergement filtered by the type_hebergement_id column
 *
 * @method array findByBonPlanId(int $bon_plan_id) Return BonPlanTypeHebergement objects filtered by the bon_plan_id column
 * @method array findByTypeHebergementId(int $type_hebergement_id) Return BonPlanTypeHebergement objects filtered by the type_hebergement_id column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseBonPlanTypeHebergementQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseBonPlanTypeHebergementQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\BonPlanTypeHebergement', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new BonPlanTypeHebergementQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     BonPlanTypeHebergementQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return BonPlanTypeHebergementQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof BonPlanTypeHebergementQuery) {
            return $criteria;
        }
        $query = new BonPlanTypeHebergementQuery();
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
                         A Primary key composition: [$bon_plan_id, $type_hebergement_id]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   BonPlanTypeHebergement|BonPlanTypeHebergement[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = BonPlanTypeHebergementPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(BonPlanTypeHebergementPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   BonPlanTypeHebergement A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `bon_plan_id`, `type_hebergement_id` FROM `bon_plan_type_hebergement` WHERE `bon_plan_id` = :p0 AND `type_hebergement_id` = :p1';
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
            $obj = new BonPlanTypeHebergement();
            $obj->hydrate($row);
            BonPlanTypeHebergementPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return BonPlanTypeHebergement|BonPlanTypeHebergement[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|BonPlanTypeHebergement[]|mixed the list of results, formatted by the current formatter
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
     * @return BonPlanTypeHebergementQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(BonPlanTypeHebergementPeer::BON_PLAN_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(BonPlanTypeHebergementPeer::TYPE_HEBERGEMENT_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return BonPlanTypeHebergementQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(BonPlanTypeHebergementPeer::BON_PLAN_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(BonPlanTypeHebergementPeer::TYPE_HEBERGEMENT_ID, $key[1], Criteria::EQUAL);
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
     * @return BonPlanTypeHebergementQuery The current query, for fluid interface
     */
    public function filterByBonPlanId($bonPlanId = null, $comparison = null)
    {
        if (is_array($bonPlanId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(BonPlanTypeHebergementPeer::BON_PLAN_ID, $bonPlanId, $comparison);
    }

    /**
     * Filter the query on the type_hebergement_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTypeHebergementId(1234); // WHERE type_hebergement_id = 1234
     * $query->filterByTypeHebergementId(array(12, 34)); // WHERE type_hebergement_id IN (12, 34)
     * $query->filterByTypeHebergementId(array('min' => 12)); // WHERE type_hebergement_id > 12
     * </code>
     *
     * @see       filterByTypeHebergement()
     *
     * @param     mixed $typeHebergementId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BonPlanTypeHebergementQuery The current query, for fluid interface
     */
    public function filterByTypeHebergementId($typeHebergementId = null, $comparison = null)
    {
        if (is_array($typeHebergementId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(BonPlanTypeHebergementPeer::TYPE_HEBERGEMENT_ID, $typeHebergementId, $comparison);
    }

    /**
     * Filter the query by a related BonPlan object
     *
     * @param   BonPlan|PropelObjectCollection $bonPlan The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   BonPlanTypeHebergementQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByBonPlan($bonPlan, $comparison = null)
    {
        if ($bonPlan instanceof BonPlan) {
            return $this
                ->addUsingAlias(BonPlanTypeHebergementPeer::BON_PLAN_ID, $bonPlan->getId(), $comparison);
        } elseif ($bonPlan instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BonPlanTypeHebergementPeer::BON_PLAN_ID, $bonPlan->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return BonPlanTypeHebergementQuery The current query, for fluid interface
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
     * Filter the query by a related TypeHebergement object
     *
     * @param   TypeHebergement|PropelObjectCollection $typeHebergement The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   BonPlanTypeHebergementQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTypeHebergement($typeHebergement, $comparison = null)
    {
        if ($typeHebergement instanceof TypeHebergement) {
            return $this
                ->addUsingAlias(BonPlanTypeHebergementPeer::TYPE_HEBERGEMENT_ID, $typeHebergement->getId(), $comparison);
        } elseif ($typeHebergement instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BonPlanTypeHebergementPeer::TYPE_HEBERGEMENT_ID, $typeHebergement->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByTypeHebergement() only accepts arguments of type TypeHebergement or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TypeHebergement relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return BonPlanTypeHebergementQuery The current query, for fluid interface
     */
    public function joinTypeHebergement($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TypeHebergement');

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
            $this->addJoinObject($join, 'TypeHebergement');
        }

        return $this;
    }

    /**
     * Use the TypeHebergement relation TypeHebergement object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\TypeHebergementQuery A secondary query class using the current class as primary query
     */
    public function useTypeHebergementQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTypeHebergement($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TypeHebergement', '\Cungfoo\Model\TypeHebergementQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   BonPlanTypeHebergement $bonPlanTypeHebergement Object to remove from the list of results
     *
     * @return BonPlanTypeHebergementQuery The current query, for fluid interface
     */
    public function prune($bonPlanTypeHebergement = null)
    {
        if ($bonPlanTypeHebergement) {
            $this->addCond('pruneCond0', $this->getAliasedColName(BonPlanTypeHebergementPeer::BON_PLAN_ID), $bonPlanTypeHebergement->getBonPlanId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(BonPlanTypeHebergementPeer::TYPE_HEBERGEMENT_ID), $bonPlanTypeHebergement->getTypeHebergementId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
