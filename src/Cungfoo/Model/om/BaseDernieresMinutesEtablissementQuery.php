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
use Cungfoo\Model\DernieresMinutes;
use Cungfoo\Model\DernieresMinutesEtablissement;
use Cungfoo\Model\DernieresMinutesEtablissementPeer;
use Cungfoo\Model\DernieresMinutesEtablissementQuery;
use Cungfoo\Model\Etablissement;

/**
 * Base class that represents a query for the 'dernieres_minutes_etablissement' table.
 *
 *
 *
 * @method DernieresMinutesEtablissementQuery orderByDernieresMinutesId($order = Criteria::ASC) Order by the dernieres_minutes_id column
 * @method DernieresMinutesEtablissementQuery orderByEtablissementId($order = Criteria::ASC) Order by the etablissement_id column
 *
 * @method DernieresMinutesEtablissementQuery groupByDernieresMinutesId() Group by the dernieres_minutes_id column
 * @method DernieresMinutesEtablissementQuery groupByEtablissementId() Group by the etablissement_id column
 *
 * @method DernieresMinutesEtablissementQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method DernieresMinutesEtablissementQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method DernieresMinutesEtablissementQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method DernieresMinutesEtablissementQuery leftJoinDernieresMinutes($relationAlias = null) Adds a LEFT JOIN clause to the query using the DernieresMinutes relation
 * @method DernieresMinutesEtablissementQuery rightJoinDernieresMinutes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DernieresMinutes relation
 * @method DernieresMinutesEtablissementQuery innerJoinDernieresMinutes($relationAlias = null) Adds a INNER JOIN clause to the query using the DernieresMinutes relation
 *
 * @method DernieresMinutesEtablissementQuery leftJoinEtablissement($relationAlias = null) Adds a LEFT JOIN clause to the query using the Etablissement relation
 * @method DernieresMinutesEtablissementQuery rightJoinEtablissement($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Etablissement relation
 * @method DernieresMinutesEtablissementQuery innerJoinEtablissement($relationAlias = null) Adds a INNER JOIN clause to the query using the Etablissement relation
 *
 * @method DernieresMinutesEtablissement findOne(PropelPDO $con = null) Return the first DernieresMinutesEtablissement matching the query
 * @method DernieresMinutesEtablissement findOneOrCreate(PropelPDO $con = null) Return the first DernieresMinutesEtablissement matching the query, or a new DernieresMinutesEtablissement object populated from the query conditions when no match is found
 *
 * @method DernieresMinutesEtablissement findOneByDernieresMinutesId(int $dernieres_minutes_id) Return the first DernieresMinutesEtablissement filtered by the dernieres_minutes_id column
 * @method DernieresMinutesEtablissement findOneByEtablissementId(int $etablissement_id) Return the first DernieresMinutesEtablissement filtered by the etablissement_id column
 *
 * @method array findByDernieresMinutesId(int $dernieres_minutes_id) Return DernieresMinutesEtablissement objects filtered by the dernieres_minutes_id column
 * @method array findByEtablissementId(int $etablissement_id) Return DernieresMinutesEtablissement objects filtered by the etablissement_id column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseDernieresMinutesEtablissementQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseDernieresMinutesEtablissementQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\DernieresMinutesEtablissement', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new DernieresMinutesEtablissementQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     DernieresMinutesEtablissementQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return DernieresMinutesEtablissementQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof DernieresMinutesEtablissementQuery) {
            return $criteria;
        }
        $query = new DernieresMinutesEtablissementQuery();
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
                         A Primary key composition: [$dernieres_minutes_id, $etablissement_id]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   DernieresMinutesEtablissement|DernieresMinutesEtablissement[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = DernieresMinutesEtablissementPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(DernieresMinutesEtablissementPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   DernieresMinutesEtablissement A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `dernieres_minutes_id`, `etablissement_id` FROM `dernieres_minutes_etablissement` WHERE `dernieres_minutes_id` = :p0 AND `etablissement_id` = :p1';
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
            $obj = new DernieresMinutesEtablissement();
            $obj->hydrate($row);
            DernieresMinutesEtablissementPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return DernieresMinutesEtablissement|DernieresMinutesEtablissement[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|DernieresMinutesEtablissement[]|mixed the list of results, formatted by the current formatter
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
     * @return DernieresMinutesEtablissementQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(DernieresMinutesEtablissementPeer::DERNIERES_MINUTES_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(DernieresMinutesEtablissementPeer::ETABLISSEMENT_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return DernieresMinutesEtablissementQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(DernieresMinutesEtablissementPeer::DERNIERES_MINUTES_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(DernieresMinutesEtablissementPeer::ETABLISSEMENT_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the dernieres_minutes_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDernieresMinutesId(1234); // WHERE dernieres_minutes_id = 1234
     * $query->filterByDernieresMinutesId(array(12, 34)); // WHERE dernieres_minutes_id IN (12, 34)
     * $query->filterByDernieresMinutesId(array('min' => 12)); // WHERE dernieres_minutes_id > 12
     * </code>
     *
     * @see       filterByDernieresMinutes()
     *
     * @param     mixed $dernieresMinutesId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DernieresMinutesEtablissementQuery The current query, for fluid interface
     */
    public function filterByDernieresMinutesId($dernieresMinutesId = null, $comparison = null)
    {
        if (is_array($dernieresMinutesId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(DernieresMinutesEtablissementPeer::DERNIERES_MINUTES_ID, $dernieresMinutesId, $comparison);
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
     * @return DernieresMinutesEtablissementQuery The current query, for fluid interface
     */
    public function filterByEtablissementId($etablissementId = null, $comparison = null)
    {
        if (is_array($etablissementId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(DernieresMinutesEtablissementPeer::ETABLISSEMENT_ID, $etablissementId, $comparison);
    }

    /**
     * Filter the query by a related DernieresMinutes object
     *
     * @param   DernieresMinutes|PropelObjectCollection $dernieresMinutes The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   DernieresMinutesEtablissementQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByDernieresMinutes($dernieresMinutes, $comparison = null)
    {
        if ($dernieresMinutes instanceof DernieresMinutes) {
            return $this
                ->addUsingAlias(DernieresMinutesEtablissementPeer::DERNIERES_MINUTES_ID, $dernieresMinutes->getId(), $comparison);
        } elseif ($dernieresMinutes instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DernieresMinutesEtablissementPeer::DERNIERES_MINUTES_ID, $dernieresMinutes->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByDernieresMinutes() only accepts arguments of type DernieresMinutes or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the DernieresMinutes relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return DernieresMinutesEtablissementQuery The current query, for fluid interface
     */
    public function joinDernieresMinutes($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('DernieresMinutes');

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
            $this->addJoinObject($join, 'DernieresMinutes');
        }

        return $this;
    }

    /**
     * Use the DernieresMinutes relation DernieresMinutes object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\DernieresMinutesQuery A secondary query class using the current class as primary query
     */
    public function useDernieresMinutesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDernieresMinutes($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'DernieresMinutes', '\Cungfoo\Model\DernieresMinutesQuery');
    }

    /**
     * Filter the query by a related Etablissement object
     *
     * @param   Etablissement|PropelObjectCollection $etablissement The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   DernieresMinutesEtablissementQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByEtablissement($etablissement, $comparison = null)
    {
        if ($etablissement instanceof Etablissement) {
            return $this
                ->addUsingAlias(DernieresMinutesEtablissementPeer::ETABLISSEMENT_ID, $etablissement->getId(), $comparison);
        } elseif ($etablissement instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DernieresMinutesEtablissementPeer::ETABLISSEMENT_ID, $etablissement->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return DernieresMinutesEtablissementQuery The current query, for fluid interface
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
     * @param   DernieresMinutesEtablissement $dernieresMinutesEtablissement Object to remove from the list of results
     *
     * @return DernieresMinutesEtablissementQuery The current query, for fluid interface
     */
    public function prune($dernieresMinutesEtablissement = null)
    {
        if ($dernieresMinutesEtablissement) {
            $this->addCond('pruneCond0', $this->getAliasedColName(DernieresMinutesEtablissementPeer::DERNIERES_MINUTES_ID), $dernieresMinutesEtablissement->getDernieresMinutesId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(DernieresMinutesEtablissementPeer::ETABLISSEMENT_ID), $dernieresMinutesEtablissement->getEtablissementId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
