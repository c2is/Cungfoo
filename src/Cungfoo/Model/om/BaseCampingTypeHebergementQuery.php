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
use Cungfoo\Model\CampingTypeHebergement;
use Cungfoo\Model\CampingTypeHebergementPeer;
use Cungfoo\Model\CampingTypeHebergementQuery;
use Cungfoo\Model\TypeHebergement;

/**
 * Base class that represents a query for the 'camping_type_hebergement' table.
 *
 *
 *
 * @method CampingTypeHebergementQuery orderByCampingId($order = Criteria::ASC) Order by the camping_id column
 * @method CampingTypeHebergementQuery orderByTypeHebergementId($order = Criteria::ASC) Order by the type_hebergement_id column
 *
 * @method CampingTypeHebergementQuery groupByCampingId() Group by the camping_id column
 * @method CampingTypeHebergementQuery groupByTypeHebergementId() Group by the type_hebergement_id column
 *
 * @method CampingTypeHebergementQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method CampingTypeHebergementQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method CampingTypeHebergementQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method CampingTypeHebergementQuery leftJoinCamping($relationAlias = null) Adds a LEFT JOIN clause to the query using the Camping relation
 * @method CampingTypeHebergementQuery rightJoinCamping($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Camping relation
 * @method CampingTypeHebergementQuery innerJoinCamping($relationAlias = null) Adds a INNER JOIN clause to the query using the Camping relation
 *
 * @method CampingTypeHebergementQuery leftJoinTypeHebergement($relationAlias = null) Adds a LEFT JOIN clause to the query using the TypeHebergement relation
 * @method CampingTypeHebergementQuery rightJoinTypeHebergement($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TypeHebergement relation
 * @method CampingTypeHebergementQuery innerJoinTypeHebergement($relationAlias = null) Adds a INNER JOIN clause to the query using the TypeHebergement relation
 *
 * @method CampingTypeHebergement findOne(PropelPDO $con = null) Return the first CampingTypeHebergement matching the query
 * @method CampingTypeHebergement findOneOrCreate(PropelPDO $con = null) Return the first CampingTypeHebergement matching the query, or a new CampingTypeHebergement object populated from the query conditions when no match is found
 *
 * @method CampingTypeHebergement findOneByCampingId(int $camping_id) Return the first CampingTypeHebergement filtered by the camping_id column
 * @method CampingTypeHebergement findOneByTypeHebergementId(string $type_hebergement_id) Return the first CampingTypeHebergement filtered by the type_hebergement_id column
 *
 * @method array findByCampingId(int $camping_id) Return CampingTypeHebergement objects filtered by the camping_id column
 * @method array findByTypeHebergementId(string $type_hebergement_id) Return CampingTypeHebergement objects filtered by the type_hebergement_id column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseCampingTypeHebergementQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseCampingTypeHebergementQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\CampingTypeHebergement', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new CampingTypeHebergementQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     CampingTypeHebergementQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return CampingTypeHebergementQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof CampingTypeHebergementQuery) {
            return $criteria;
        }
        $query = new CampingTypeHebergementQuery();
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
                         A Primary key composition: [$camping_id, $type_hebergement_id]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   CampingTypeHebergement|CampingTypeHebergement[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CampingTypeHebergementPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(CampingTypeHebergementPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   CampingTypeHebergement A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `CAMPING_ID`, `TYPE_HEBERGEMENT_ID` FROM `camping_type_hebergement` WHERE `CAMPING_ID` = :p0 AND `TYPE_HEBERGEMENT_ID` = :p1';
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
            $obj = new CampingTypeHebergement();
            $obj->hydrate($row);
            CampingTypeHebergementPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return CampingTypeHebergement|CampingTypeHebergement[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|CampingTypeHebergement[]|mixed the list of results, formatted by the current formatter
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
     * @return CampingTypeHebergementQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(CampingTypeHebergementPeer::CAMPING_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(CampingTypeHebergementPeer::TYPE_HEBERGEMENT_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return CampingTypeHebergementQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(CampingTypeHebergementPeer::CAMPING_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(CampingTypeHebergementPeer::TYPE_HEBERGEMENT_ID, $key[1], Criteria::EQUAL);
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
     * @return CampingTypeHebergementQuery The current query, for fluid interface
     */
    public function filterByCampingId($campingId = null, $comparison = null)
    {
        if (is_array($campingId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(CampingTypeHebergementPeer::CAMPING_ID, $campingId, $comparison);
    }

    /**
     * Filter the query on the type_hebergement_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTypeHebergementId('fooValue');   // WHERE type_hebergement_id = 'fooValue'
     * $query->filterByTypeHebergementId('%fooValue%'); // WHERE type_hebergement_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $typeHebergementId The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CampingTypeHebergementQuery The current query, for fluid interface
     */
    public function filterByTypeHebergementId($typeHebergementId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($typeHebergementId)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $typeHebergementId)) {
                $typeHebergementId = str_replace('*', '%', $typeHebergementId);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CampingTypeHebergementPeer::TYPE_HEBERGEMENT_ID, $typeHebergementId, $comparison);
    }

    /**
     * Filter the query by a related Camping object
     *
     * @param   Camping|PropelObjectCollection $camping The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   CampingTypeHebergementQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByCamping($camping, $comparison = null)
    {
        if ($camping instanceof Camping) {
            return $this
                ->addUsingAlias(CampingTypeHebergementPeer::CAMPING_ID, $camping->getId(), $comparison);
        } elseif ($camping instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CampingTypeHebergementPeer::CAMPING_ID, $camping->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return CampingTypeHebergementQuery The current query, for fluid interface
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
     * Filter the query by a related TypeHebergement object
     *
     * @param   TypeHebergement|PropelObjectCollection $typeHebergement The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   CampingTypeHebergementQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTypeHebergement($typeHebergement, $comparison = null)
    {
        if ($typeHebergement instanceof TypeHebergement) {
            return $this
                ->addUsingAlias(CampingTypeHebergementPeer::TYPE_HEBERGEMENT_ID, $typeHebergement->getId(), $comparison);
        } elseif ($typeHebergement instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CampingTypeHebergementPeer::TYPE_HEBERGEMENT_ID, $typeHebergement->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return CampingTypeHebergementQuery The current query, for fluid interface
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
     * @param   CampingTypeHebergement $campingTypeHebergement Object to remove from the list of results
     *
     * @return CampingTypeHebergementQuery The current query, for fluid interface
     */
    public function prune($campingTypeHebergement = null)
    {
        if ($campingTypeHebergement) {
            $this->addCond('pruneCond0', $this->getAliasedColName(CampingTypeHebergementPeer::CAMPING_ID), $campingTypeHebergement->getCampingId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(CampingTypeHebergementPeer::TYPE_HEBERGEMENT_ID), $campingTypeHebergement->getTypeHebergementId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
