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
use Cungfoo\Model\BonPlanEtablissement;
use Cungfoo\Model\BonPlanEtablissementPeer;
use Cungfoo\Model\BonPlanEtablissementQuery;
use Cungfoo\Model\Etablissement;

/**
 * Base class that represents a query for the 'bon_plan_etablissement' table.
 *
 *
 *
 * @method BonPlanEtablissementQuery orderByBonPlanId($order = Criteria::ASC) Order by the bon_plan_id column
 * @method BonPlanEtablissementQuery orderByEtablissementId($order = Criteria::ASC) Order by the etablissement_id column
 *
 * @method BonPlanEtablissementQuery groupByBonPlanId() Group by the bon_plan_id column
 * @method BonPlanEtablissementQuery groupByEtablissementId() Group by the etablissement_id column
 *
 * @method BonPlanEtablissementQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method BonPlanEtablissementQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method BonPlanEtablissementQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method BonPlanEtablissementQuery leftJoinBonPlan($relationAlias = null) Adds a LEFT JOIN clause to the query using the BonPlan relation
 * @method BonPlanEtablissementQuery rightJoinBonPlan($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BonPlan relation
 * @method BonPlanEtablissementQuery innerJoinBonPlan($relationAlias = null) Adds a INNER JOIN clause to the query using the BonPlan relation
 *
 * @method BonPlanEtablissementQuery leftJoinEtablissement($relationAlias = null) Adds a LEFT JOIN clause to the query using the Etablissement relation
 * @method BonPlanEtablissementQuery rightJoinEtablissement($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Etablissement relation
 * @method BonPlanEtablissementQuery innerJoinEtablissement($relationAlias = null) Adds a INNER JOIN clause to the query using the Etablissement relation
 *
 * @method BonPlanEtablissement findOne(PropelPDO $con = null) Return the first BonPlanEtablissement matching the query
 * @method BonPlanEtablissement findOneOrCreate(PropelPDO $con = null) Return the first BonPlanEtablissement matching the query, or a new BonPlanEtablissement object populated from the query conditions when no match is found
 *
 * @method BonPlanEtablissement findOneByBonPlanId(int $bon_plan_id) Return the first BonPlanEtablissement filtered by the bon_plan_id column
 * @method BonPlanEtablissement findOneByEtablissementId(int $etablissement_id) Return the first BonPlanEtablissement filtered by the etablissement_id column
 *
 * @method array findByBonPlanId(int $bon_plan_id) Return BonPlanEtablissement objects filtered by the bon_plan_id column
 * @method array findByEtablissementId(int $etablissement_id) Return BonPlanEtablissement objects filtered by the etablissement_id column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseBonPlanEtablissementQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseBonPlanEtablissementQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\BonPlanEtablissement', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new BonPlanEtablissementQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     BonPlanEtablissementQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return BonPlanEtablissementQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof BonPlanEtablissementQuery) {
            return $criteria;
        }
        $query = new BonPlanEtablissementQuery();
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
                         A Primary key composition: [$bon_plan_id, $etablissement_id]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   BonPlanEtablissement|BonPlanEtablissement[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = BonPlanEtablissementPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(BonPlanEtablissementPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   BonPlanEtablissement A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `bon_plan_id`, `etablissement_id` FROM `bon_plan_etablissement` WHERE `bon_plan_id` = :p0 AND `etablissement_id` = :p1';
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
            $obj = new BonPlanEtablissement();
            $obj->hydrate($row);
            BonPlanEtablissementPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return BonPlanEtablissement|BonPlanEtablissement[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|BonPlanEtablissement[]|mixed the list of results, formatted by the current formatter
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
     * @return BonPlanEtablissementQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(BonPlanEtablissementPeer::BON_PLAN_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(BonPlanEtablissementPeer::ETABLISSEMENT_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return BonPlanEtablissementQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(BonPlanEtablissementPeer::BON_PLAN_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(BonPlanEtablissementPeer::ETABLISSEMENT_ID, $key[1], Criteria::EQUAL);
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
     * @return BonPlanEtablissementQuery The current query, for fluid interface
     */
    public function filterByBonPlanId($bonPlanId = null, $comparison = null)
    {
        if (is_array($bonPlanId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(BonPlanEtablissementPeer::BON_PLAN_ID, $bonPlanId, $comparison);
    }

    /**
     * Filter the query on the etablissement_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEtablissementId(1234); // WHERE etablissement_id = 1234
     * $query->filterByEtablissementId(array(12, 34)); // WHERE etablissement_id IN (12, 34)
     * $query->filterByEtablissementId(array('min' => 12)); // WHERE etablissement_id > 12
     * </code>
     *
     * @see       filterByEtablissement()
     *
     * @param     mixed $etablissementId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BonPlanEtablissementQuery The current query, for fluid interface
     */
    public function filterByEtablissementId($etablissementId = null, $comparison = null)
    {
        if (is_array($etablissementId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(BonPlanEtablissementPeer::ETABLISSEMENT_ID, $etablissementId, $comparison);
    }

    /**
     * Filter the query by a related BonPlan object
     *
     * @param   BonPlan|PropelObjectCollection $bonPlan The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   BonPlanEtablissementQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByBonPlan($bonPlan, $comparison = null)
    {
        if ($bonPlan instanceof BonPlan) {
            return $this
                ->addUsingAlias(BonPlanEtablissementPeer::BON_PLAN_ID, $bonPlan->getId(), $comparison);
        } elseif ($bonPlan instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BonPlanEtablissementPeer::BON_PLAN_ID, $bonPlan->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return BonPlanEtablissementQuery The current query, for fluid interface
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
     * Filter the query by a related Etablissement object
     *
     * @param   Etablissement|PropelObjectCollection $etablissement The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   BonPlanEtablissementQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByEtablissement($etablissement, $comparison = null)
    {
        if ($etablissement instanceof Etablissement) {
            return $this
                ->addUsingAlias(BonPlanEtablissementPeer::ETABLISSEMENT_ID, $etablissement->getId(), $comparison);
        } elseif ($etablissement instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BonPlanEtablissementPeer::ETABLISSEMENT_ID, $etablissement->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByEtablissement() only accepts arguments of type Etablissement or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Etablissement relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return BonPlanEtablissementQuery The current query, for fluid interface
     */
    public function joinEtablissement($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Etablissement');

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
            $this->addJoinObject($join, 'Etablissement');
        }

        return $this;
    }

    /**
     * Use the Etablissement relation Etablissement object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\EtablissementQuery A secondary query class using the current class as primary query
     */
    public function useEtablissementQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEtablissement($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Etablissement', '\Cungfoo\Model\EtablissementQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   BonPlanEtablissement $bonPlanEtablissement Object to remove from the list of results
     *
     * @return BonPlanEtablissementQuery The current query, for fluid interface
     */
    public function prune($bonPlanEtablissement = null)
    {
        if ($bonPlanEtablissement) {
            $this->addCond('pruneCond0', $this->getAliasedColName(BonPlanEtablissementPeer::BON_PLAN_ID), $bonPlanEtablissement->getBonPlanId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(BonPlanEtablissementPeer::ETABLISSEMENT_ID), $bonPlanEtablissement->getEtablissementId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
