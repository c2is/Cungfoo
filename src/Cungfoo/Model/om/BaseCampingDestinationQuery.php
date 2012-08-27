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
use Cungfoo\Model\Camping;
use Cungfoo\Model\CampingDestination;
use Cungfoo\Model\CampingDestinationPeer;
use Cungfoo\Model\CampingDestinationQuery;
use Cungfoo\Model\Destination;

/**
 * Base class that represents a query for the 'camping_destination' table.
 *
 *
 *
 * @method CampingDestinationQuery orderByCampingId($order = Criteria::ASC) Order by the camping_id column
 * @method CampingDestinationQuery orderByDestinationId($order = Criteria::ASC) Order by the destination_id column
 *
 * @method CampingDestinationQuery groupByCampingId() Group by the camping_id column
 * @method CampingDestinationQuery groupByDestinationId() Group by the destination_id column
 *
 * @method CampingDestinationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method CampingDestinationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method CampingDestinationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method CampingDestinationQuery leftJoinCamping($relationAlias = null) Adds a LEFT JOIN clause to the query using the Camping relation
 * @method CampingDestinationQuery rightJoinCamping($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Camping relation
 * @method CampingDestinationQuery innerJoinCamping($relationAlias = null) Adds a INNER JOIN clause to the query using the Camping relation
 *
 * @method CampingDestinationQuery leftJoinDestination($relationAlias = null) Adds a LEFT JOIN clause to the query using the Destination relation
 * @method CampingDestinationQuery rightJoinDestination($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Destination relation
 * @method CampingDestinationQuery innerJoinDestination($relationAlias = null) Adds a INNER JOIN clause to the query using the Destination relation
 *
 * @method CampingDestination findOne(PropelPDO $con = null) Return the first CampingDestination matching the query
 * @method CampingDestination findOneOrCreate(PropelPDO $con = null) Return the first CampingDestination matching the query, or a new CampingDestination object populated from the query conditions when no match is found
 *
 * @method CampingDestination findOneByCampingId(int $camping_id) Return the first CampingDestination filtered by the camping_id column
 * @method CampingDestination findOneByDestinationId(string $destination_id) Return the first CampingDestination filtered by the destination_id column
 *
 * @method array findByCampingId(int $camping_id) Return CampingDestination objects filtered by the camping_id column
 * @method array findByDestinationId(string $destination_id) Return CampingDestination objects filtered by the destination_id column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseCampingDestinationQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseCampingDestinationQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\CampingDestination', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new CampingDestinationQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     CampingDestinationQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return CampingDestinationQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof CampingDestinationQuery) {
            return $criteria;
        }
        $query = new CampingDestinationQuery();
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
                         A Primary key composition: [$camping_id, $destination_id]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   CampingDestination|CampingDestination[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CampingDestinationPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(CampingDestinationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   CampingDestination A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `CAMPING_ID`, `DESTINATION_ID` FROM `camping_destination` WHERE `CAMPING_ID` = :p0 AND `DESTINATION_ID` = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new CampingDestination();
            $obj->hydrate($row);
            CampingDestinationPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return CampingDestination|CampingDestination[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|CampingDestination[]|mixed the list of results, formatted by the current formatter
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
     * @return CampingDestinationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(CampingDestinationPeer::CAMPING_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(CampingDestinationPeer::DESTINATION_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return CampingDestinationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(CampingDestinationPeer::CAMPING_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(CampingDestinationPeer::DESTINATION_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the camping_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCampingId(1234); // WHERE camping_id = 1234
     * $query->filterByCampingId(array(12, 34)); // WHERE camping_id IN (12, 34)
     * $query->filterByCampingId(array('min' => 12)); // WHERE camping_id > 12
     * </code>
     *
     * @see       filterByCamping()
     *
     * @param     mixed $campingId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CampingDestinationQuery The current query, for fluid interface
     */
    public function filterByCampingId($campingId = null, $comparison = null)
    {
        if (is_array($campingId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(CampingDestinationPeer::CAMPING_ID, $campingId, $comparison);
    }

    /**
     * Filter the query on the destination_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDestinationId('fooValue');   // WHERE destination_id = 'fooValue'
     * $query->filterByDestinationId('%fooValue%'); // WHERE destination_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $destinationId The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CampingDestinationQuery The current query, for fluid interface
     */
    public function filterByDestinationId($destinationId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($destinationId)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $destinationId)) {
                $destinationId = str_replace('*', '%', $destinationId);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CampingDestinationPeer::DESTINATION_ID, $destinationId, $comparison);
    }

    /**
     * Filter the query by a related Camping object
     *
     * @param   Camping|PropelObjectCollection $camping The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   CampingDestinationQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByCamping($camping, $comparison = null)
    {
        if ($camping instanceof Camping) {
            return $this
                ->addUsingAlias(CampingDestinationPeer::CAMPING_ID, $camping->getId(), $comparison);
        } elseif ($camping instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CampingDestinationPeer::CAMPING_ID, $camping->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCamping() only accepts arguments of type Camping or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Camping relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return CampingDestinationQuery The current query, for fluid interface
     */
    public function joinCamping($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Camping');

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
            $this->addJoinObject($join, 'Camping');
        }

        return $this;
    }

    /**
     * Use the Camping relation Camping object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\CampingQuery A secondary query class using the current class as primary query
     */
    public function useCampingQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCamping($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Camping', '\Cungfoo\Model\CampingQuery');
    }

    /**
     * Filter the query by a related Destination object
     *
     * @param   Destination|PropelObjectCollection $destination The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   CampingDestinationQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByDestination($destination, $comparison = null)
    {
        if ($destination instanceof Destination) {
            return $this
                ->addUsingAlias(CampingDestinationPeer::DESTINATION_ID, $destination->getId(), $comparison);
        } elseif ($destination instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CampingDestinationPeer::DESTINATION_ID, $destination->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByDestination() only accepts arguments of type Destination or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Destination relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return CampingDestinationQuery The current query, for fluid interface
     */
    public function joinDestination($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Destination');

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
            $this->addJoinObject($join, 'Destination');
        }

        return $this;
    }

    /**
     * Use the Destination relation Destination object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\DestinationQuery A secondary query class using the current class as primary query
     */
    public function useDestinationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDestination($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Destination', '\Cungfoo\Model\DestinationQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   CampingDestination $campingDestination Object to remove from the list of results
     *
     * @return CampingDestinationQuery The current query, for fluid interface
     */
    public function prune($campingDestination = null)
    {
        if ($campingDestination) {
            $this->addCond('pruneCond0', $this->getAliasedColName(CampingDestinationPeer::CAMPING_ID), $campingDestination->getCampingId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(CampingDestinationPeer::DESTINATION_ID), $campingDestination->getDestinationId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
