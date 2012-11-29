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
use Cungfoo\Model\Etablissement;
use Cungfoo\Model\EtablissementPointInteret;
use Cungfoo\Model\EtablissementPointInteretPeer;
use Cungfoo\Model\EtablissementPointInteretQuery;
use Cungfoo\Model\PointInteret;

/**
 * Base class that represents a query for the 'etablissement_point_interet' table.
 *
 *
 *
 * @method EtablissementPointInteretQuery orderByEtablissementId($order = Criteria::ASC) Order by the etablissement_id column
 * @method EtablissementPointInteretQuery orderByPointInteretId($order = Criteria::ASC) Order by the point_interet_id column
 * @method EtablissementPointInteretQuery orderByDistance($order = Criteria::ASC) Order by the distance column
 *
 * @method EtablissementPointInteretQuery groupByEtablissementId() Group by the etablissement_id column
 * @method EtablissementPointInteretQuery groupByPointInteretId() Group by the point_interet_id column
 * @method EtablissementPointInteretQuery groupByDistance() Group by the distance column
 *
 * @method EtablissementPointInteretQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method EtablissementPointInteretQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method EtablissementPointInteretQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method EtablissementPointInteretQuery leftJoinEtablissement($relationAlias = null) Adds a LEFT JOIN clause to the query using the Etablissement relation
 * @method EtablissementPointInteretQuery rightJoinEtablissement($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Etablissement relation
 * @method EtablissementPointInteretQuery innerJoinEtablissement($relationAlias = null) Adds a INNER JOIN clause to the query using the Etablissement relation
 *
 * @method EtablissementPointInteretQuery leftJoinPointInteret($relationAlias = null) Adds a LEFT JOIN clause to the query using the PointInteret relation
 * @method EtablissementPointInteretQuery rightJoinPointInteret($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PointInteret relation
 * @method EtablissementPointInteretQuery innerJoinPointInteret($relationAlias = null) Adds a INNER JOIN clause to the query using the PointInteret relation
 *
 * @method EtablissementPointInteret findOne(PropelPDO $con = null) Return the first EtablissementPointInteret matching the query
 * @method EtablissementPointInteret findOneOrCreate(PropelPDO $con = null) Return the first EtablissementPointInteret matching the query, or a new EtablissementPointInteret object populated from the query conditions when no match is found
 *
 * @method EtablissementPointInteret findOneByEtablissementId(int $etablissement_id) Return the first EtablissementPointInteret filtered by the etablissement_id column
 * @method EtablissementPointInteret findOneByPointInteretId(int $point_interet_id) Return the first EtablissementPointInteret filtered by the point_interet_id column
 * @method EtablissementPointInteret findOneByDistance(string $distance) Return the first EtablissementPointInteret filtered by the distance column
 *
 * @method array findByEtablissementId(int $etablissement_id) Return EtablissementPointInteret objects filtered by the etablissement_id column
 * @method array findByPointInteretId(int $point_interet_id) Return EtablissementPointInteret objects filtered by the point_interet_id column
 * @method array findByDistance(string $distance) Return EtablissementPointInteret objects filtered by the distance column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseEtablissementPointInteretQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseEtablissementPointInteretQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\EtablissementPointInteret', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new EtablissementPointInteretQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     EtablissementPointInteretQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return EtablissementPointInteretQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof EtablissementPointInteretQuery) {
            return $criteria;
        }
        $query = new EtablissementPointInteretQuery();
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
                         A Primary key composition: [$etablissement_id, $point_interet_id]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   EtablissementPointInteret|EtablissementPointInteret[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = EtablissementPointInteretPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(EtablissementPointInteretPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   EtablissementPointInteret A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `etablissement_id`, `point_interet_id`, `distance` FROM `etablissement_point_interet` WHERE `etablissement_id` = :p0 AND `point_interet_id` = :p1';
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
            $obj = new EtablissementPointInteret();
            $obj->hydrate($row);
            EtablissementPointInteretPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return EtablissementPointInteret|EtablissementPointInteret[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|EtablissementPointInteret[]|mixed the list of results, formatted by the current formatter
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
     * @return EtablissementPointInteretQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(EtablissementPointInteretPeer::ETABLISSEMENT_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(EtablissementPointInteretPeer::POINT_INTERET_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return EtablissementPointInteretQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(EtablissementPointInteretPeer::ETABLISSEMENT_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(EtablissementPointInteretPeer::POINT_INTERET_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @return EtablissementPointInteretQuery The current query, for fluid interface
     */
    public function filterByEtablissementId($etablissementId = null, $comparison = null)
    {
        if (is_array($etablissementId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(EtablissementPointInteretPeer::ETABLISSEMENT_ID, $etablissementId, $comparison);
    }

    /**
     * Filter the query on the point_interet_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPointInteretId(1234); // WHERE point_interet_id = 1234
     * $query->filterByPointInteretId(array(12, 34)); // WHERE point_interet_id IN (12, 34)
     * $query->filterByPointInteretId(array('min' => 12)); // WHERE point_interet_id > 12
     * </code>
     *
     * @see       filterByPointInteret()
     *
     * @param     mixed $pointInteretId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EtablissementPointInteretQuery The current query, for fluid interface
     */
    public function filterByPointInteretId($pointInteretId = null, $comparison = null)
    {
        if (is_array($pointInteretId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(EtablissementPointInteretPeer::POINT_INTERET_ID, $pointInteretId, $comparison);
    }

    /**
     * Filter the query on the distance column
     *
     * Example usage:
     * <code>
     * $query->filterByDistance('fooValue');   // WHERE distance = 'fooValue'
     * $query->filterByDistance('%fooValue%'); // WHERE distance LIKE '%fooValue%'
     * </code>
     *
     * @param     string $distance The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EtablissementPointInteretQuery The current query, for fluid interface
     */
    public function filterByDistance($distance = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($distance)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $distance)) {
                $distance = str_replace('*', '%', $distance);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(EtablissementPointInteretPeer::DISTANCE, $distance, $comparison);
    }

    /**
     * Filter the query by a related Etablissement object
     *
     * @param   Etablissement|PropelObjectCollection $etablissement The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   EtablissementPointInteretQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByEtablissement($etablissement, $comparison = null)
    {
        if ($etablissement instanceof Etablissement) {
            return $this
                ->addUsingAlias(EtablissementPointInteretPeer::ETABLISSEMENT_ID, $etablissement->getId(), $comparison);
        } elseif ($etablissement instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EtablissementPointInteretPeer::ETABLISSEMENT_ID, $etablissement->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return EtablissementPointInteretQuery The current query, for fluid interface
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
     * Filter the query by a related PointInteret object
     *
     * @param   PointInteret|PropelObjectCollection $pointInteret The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   EtablissementPointInteretQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByPointInteret($pointInteret, $comparison = null)
    {
        if ($pointInteret instanceof PointInteret) {
            return $this
                ->addUsingAlias(EtablissementPointInteretPeer::POINT_INTERET_ID, $pointInteret->getId(), $comparison);
        } elseif ($pointInteret instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EtablissementPointInteretPeer::POINT_INTERET_ID, $pointInteret->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPointInteret() only accepts arguments of type PointInteret or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PointInteret relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return EtablissementPointInteretQuery The current query, for fluid interface
     */
    public function joinPointInteret($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PointInteret');

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
            $this->addJoinObject($join, 'PointInteret');
        }

        return $this;
    }

    /**
     * Use the PointInteret relation PointInteret object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\PointInteretQuery A secondary query class using the current class as primary query
     */
    public function usePointInteretQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPointInteret($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PointInteret', '\Cungfoo\Model\PointInteretQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   EtablissementPointInteret $etablissementPointInteret Object to remove from the list of results
     *
     * @return EtablissementPointInteretQuery The current query, for fluid interface
     */
    public function prune($etablissementPointInteret = null)
    {
        if ($etablissementPointInteret) {
            $this->addCond('pruneCond0', $this->getAliasedColName(EtablissementPointInteretPeer::ETABLISSEMENT_ID), $etablissementPointInteret->getEtablissementId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(EtablissementPointInteretPeer::POINT_INTERET_ID), $etablissementPointInteret->getPointInteretId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
