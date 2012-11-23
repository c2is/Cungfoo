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
use Cungfoo\Model\Baignade;
use Cungfoo\Model\Etablissement;
use Cungfoo\Model\EtablissementBaignade;
use Cungfoo\Model\EtablissementBaignadePeer;
use Cungfoo\Model\EtablissementBaignadeQuery;

/**
 * Base class that represents a query for the 'etablissement_baignade' table.
 *
 * 
 *
 * @method EtablissementBaignadeQuery orderByEtablissementId($order = Criteria::ASC) Order by the etablissement_id column
 * @method EtablissementBaignadeQuery orderByBaignadeId($order = Criteria::ASC) Order by the baignade_id column
 *
 * @method EtablissementBaignadeQuery groupByEtablissementId() Group by the etablissement_id column
 * @method EtablissementBaignadeQuery groupByBaignadeId() Group by the baignade_id column
 *
 * @method EtablissementBaignadeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method EtablissementBaignadeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method EtablissementBaignadeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method EtablissementBaignadeQuery leftJoinEtablissement($relationAlias = null) Adds a LEFT JOIN clause to the query using the Etablissement relation
 * @method EtablissementBaignadeQuery rightJoinEtablissement($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Etablissement relation
 * @method EtablissementBaignadeQuery innerJoinEtablissement($relationAlias = null) Adds a INNER JOIN clause to the query using the Etablissement relation
 *
 * @method EtablissementBaignadeQuery leftJoinBaignade($relationAlias = null) Adds a LEFT JOIN clause to the query using the Baignade relation
 * @method EtablissementBaignadeQuery rightJoinBaignade($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Baignade relation
 * @method EtablissementBaignadeQuery innerJoinBaignade($relationAlias = null) Adds a INNER JOIN clause to the query using the Baignade relation
 *
 * @method EtablissementBaignade findOne(PropelPDO $con = null) Return the first EtablissementBaignade matching the query
 * @method EtablissementBaignade findOneOrCreate(PropelPDO $con = null) Return the first EtablissementBaignade matching the query, or a new EtablissementBaignade object populated from the query conditions when no match is found
 *
 * @method EtablissementBaignade findOneByEtablissementId(int $etablissement_id) Return the first EtablissementBaignade filtered by the etablissement_id column
 * @method EtablissementBaignade findOneByBaignadeId(int $baignade_id) Return the first EtablissementBaignade filtered by the baignade_id column
 *
 * @method array findByEtablissementId(int $etablissement_id) Return EtablissementBaignade objects filtered by the etablissement_id column
 * @method array findByBaignadeId(int $baignade_id) Return EtablissementBaignade objects filtered by the baignade_id column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseEtablissementBaignadeQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseEtablissementBaignadeQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\EtablissementBaignade', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new EtablissementBaignadeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     EtablissementBaignadeQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return EtablissementBaignadeQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof EtablissementBaignadeQuery) {
            return $criteria;
        }
        $query = new EtablissementBaignadeQuery();
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
                         A Primary key composition: [$etablissement_id, $baignade_id]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   EtablissementBaignade|EtablissementBaignade[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = EtablissementBaignadePeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(EtablissementBaignadePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   EtablissementBaignade A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ETABLISSEMENT_ID`, `BAIGNADE_ID` FROM `etablissement_baignade` WHERE `ETABLISSEMENT_ID` = :p0 AND `BAIGNADE_ID` = :p1';
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
            $obj = new EtablissementBaignade();
            $obj->hydrate($row);
            EtablissementBaignadePeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return EtablissementBaignade|EtablissementBaignade[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|EtablissementBaignade[]|mixed the list of results, formatted by the current formatter
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
     * @return EtablissementBaignadeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(EtablissementBaignadePeer::ETABLISSEMENT_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(EtablissementBaignadePeer::BAIGNADE_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return EtablissementBaignadeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(EtablissementBaignadePeer::ETABLISSEMENT_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(EtablissementBaignadePeer::BAIGNADE_ID, $key[1], Criteria::EQUAL);
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
     * @return EtablissementBaignadeQuery The current query, for fluid interface
     */
    public function filterByEtablissementId($etablissementId = null, $comparison = null)
    {
        if (is_array($etablissementId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(EtablissementBaignadePeer::ETABLISSEMENT_ID, $etablissementId, $comparison);
    }

    /**
     * Filter the query on the baignade_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBaignadeId(1234); // WHERE baignade_id = 1234
     * $query->filterByBaignadeId(array(12, 34)); // WHERE baignade_id IN (12, 34)
     * $query->filterByBaignadeId(array('min' => 12)); // WHERE baignade_id > 12
     * </code>
     *
     * @see       filterByBaignade()
     *
     * @param     mixed $baignadeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EtablissementBaignadeQuery The current query, for fluid interface
     */
    public function filterByBaignadeId($baignadeId = null, $comparison = null)
    {
        if (is_array($baignadeId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(EtablissementBaignadePeer::BAIGNADE_ID, $baignadeId, $comparison);
    }

    /**
     * Filter the query by a related Etablissement object
     *
     * @param   Etablissement|PropelObjectCollection $etablissement The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   EtablissementBaignadeQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByEtablissement($etablissement, $comparison = null)
    {
        if ($etablissement instanceof Etablissement) {
            return $this
                ->addUsingAlias(EtablissementBaignadePeer::ETABLISSEMENT_ID, $etablissement->getId(), $comparison);
        } elseif ($etablissement instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EtablissementBaignadePeer::ETABLISSEMENT_ID, $etablissement->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return EtablissementBaignadeQuery The current query, for fluid interface
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
     * Filter the query by a related Baignade object
     *
     * @param   Baignade|PropelObjectCollection $baignade The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   EtablissementBaignadeQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByBaignade($baignade, $comparison = null)
    {
        if ($baignade instanceof Baignade) {
            return $this
                ->addUsingAlias(EtablissementBaignadePeer::BAIGNADE_ID, $baignade->getId(), $comparison);
        } elseif ($baignade instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EtablissementBaignadePeer::BAIGNADE_ID, $baignade->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByBaignade() only accepts arguments of type Baignade or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Baignade relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return EtablissementBaignadeQuery The current query, for fluid interface
     */
    public function joinBaignade($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Baignade');

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
            $this->addJoinObject($join, 'Baignade');
        }

        return $this;
    }

    /**
     * Use the Baignade relation Baignade object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\BaignadeQuery A secondary query class using the current class as primary query
     */
    public function useBaignadeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBaignade($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Baignade', '\Cungfoo\Model\BaignadeQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   EtablissementBaignade $etablissementBaignade Object to remove from the list of results
     *
     * @return EtablissementBaignadeQuery The current query, for fluid interface
     */
    public function prune($etablissementBaignade = null)
    {
        if ($etablissementBaignade) {
            $this->addCond('pruneCond0', $this->getAliasedColName(EtablissementBaignadePeer::ETABLISSEMENT_ID), $etablissementBaignade->getEtablissementId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(EtablissementBaignadePeer::BAIGNADE_ID), $etablissementBaignade->getBaignadeId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
