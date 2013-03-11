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
use Cungfoo\Model\MultimediaTypeHebergement;
use Cungfoo\Model\MultimediaTypeHebergementI18n;
use Cungfoo\Model\MultimediaTypeHebergementPeer;
use Cungfoo\Model\MultimediaTypeHebergementQuery;
use Cungfoo\Model\TypeHebergement;

/**
 * Base class that represents a query for the 'multimedia_type_hebergement' table.
 *
 *
 *
 * @method MultimediaTypeHebergementQuery orderById($order = Criteria::ASC) Order by the id column
 * @method MultimediaTypeHebergementQuery orderByTypeHebergementId($order = Criteria::ASC) Order by the type_hebergement_id column
 * @method MultimediaTypeHebergementQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method MultimediaTypeHebergementQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method MultimediaTypeHebergementQuery orderByActive($order = Criteria::ASC) Order by the active column
 *
 * @method MultimediaTypeHebergementQuery groupById() Group by the id column
 * @method MultimediaTypeHebergementQuery groupByTypeHebergementId() Group by the type_hebergement_id column
 * @method MultimediaTypeHebergementQuery groupByCreatedAt() Group by the created_at column
 * @method MultimediaTypeHebergementQuery groupByUpdatedAt() Group by the updated_at column
 * @method MultimediaTypeHebergementQuery groupByActive() Group by the active column
 *
 * @method MultimediaTypeHebergementQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method MultimediaTypeHebergementQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method MultimediaTypeHebergementQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method MultimediaTypeHebergementQuery leftJoinTypeHebergement($relationAlias = null) Adds a LEFT JOIN clause to the query using the TypeHebergement relation
 * @method MultimediaTypeHebergementQuery rightJoinTypeHebergement($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TypeHebergement relation
 * @method MultimediaTypeHebergementQuery innerJoinTypeHebergement($relationAlias = null) Adds a INNER JOIN clause to the query using the TypeHebergement relation
 *
 * @method MultimediaTypeHebergementQuery leftJoinMultimediaTypeHebergementI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the MultimediaTypeHebergementI18n relation
 * @method MultimediaTypeHebergementQuery rightJoinMultimediaTypeHebergementI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MultimediaTypeHebergementI18n relation
 * @method MultimediaTypeHebergementQuery innerJoinMultimediaTypeHebergementI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the MultimediaTypeHebergementI18n relation
 *
 * @method MultimediaTypeHebergement findOne(PropelPDO $con = null) Return the first MultimediaTypeHebergement matching the query
 * @method MultimediaTypeHebergement findOneOrCreate(PropelPDO $con = null) Return the first MultimediaTypeHebergement matching the query, or a new MultimediaTypeHebergement object populated from the query conditions when no match is found
 *
 * @method MultimediaTypeHebergement findOneByTypeHebergementId(int $type_hebergement_id) Return the first MultimediaTypeHebergement filtered by the type_hebergement_id column
 * @method MultimediaTypeHebergement findOneByCreatedAt(string $created_at) Return the first MultimediaTypeHebergement filtered by the created_at column
 * @method MultimediaTypeHebergement findOneByUpdatedAt(string $updated_at) Return the first MultimediaTypeHebergement filtered by the updated_at column
 * @method MultimediaTypeHebergement findOneByActive(boolean $active) Return the first MultimediaTypeHebergement filtered by the active column
 *
 * @method array findById(int $id) Return MultimediaTypeHebergement objects filtered by the id column
 * @method array findByTypeHebergementId(int $type_hebergement_id) Return MultimediaTypeHebergement objects filtered by the type_hebergement_id column
 * @method array findByCreatedAt(string $created_at) Return MultimediaTypeHebergement objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return MultimediaTypeHebergement objects filtered by the updated_at column
 * @method array findByActive(boolean $active) Return MultimediaTypeHebergement objects filtered by the active column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseMultimediaTypeHebergementQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseMultimediaTypeHebergementQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\MultimediaTypeHebergement', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new MultimediaTypeHebergementQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     MultimediaTypeHebergementQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return MultimediaTypeHebergementQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof MultimediaTypeHebergementQuery) {
            return $criteria;
        }
        $query = new MultimediaTypeHebergementQuery();
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
     * @return   MultimediaTypeHebergement|MultimediaTypeHebergement[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = MultimediaTypeHebergementPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(MultimediaTypeHebergementPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   MultimediaTypeHebergement A model object, or null if the key is not found
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
     * @return   MultimediaTypeHebergement A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `type_hebergement_id`, `created_at`, `updated_at`, `active` FROM `multimedia_type_hebergement` WHERE `id` = :p0';
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
            $obj = new MultimediaTypeHebergement();
            $obj->hydrate($row);
            MultimediaTypeHebergementPeer::addInstanceToPool($obj, (string) $key);
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
     * @return MultimediaTypeHebergement|MultimediaTypeHebergement[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|MultimediaTypeHebergement[]|mixed the list of results, formatted by the current formatter
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
     * @return MultimediaTypeHebergementQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(MultimediaTypeHebergementPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return MultimediaTypeHebergementQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(MultimediaTypeHebergementPeer::ID, $keys, Criteria::IN);
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
     * @return MultimediaTypeHebergementQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(MultimediaTypeHebergementPeer::ID, $id, $comparison);
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
     * @return MultimediaTypeHebergementQuery The current query, for fluid interface
     */
    public function filterByTypeHebergementId($typeHebergementId = null, $comparison = null)
    {
        if (is_array($typeHebergementId)) {
            $useMinMax = false;
            if (isset($typeHebergementId['min'])) {
                $this->addUsingAlias(MultimediaTypeHebergementPeer::TYPE_HEBERGEMENT_ID, $typeHebergementId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($typeHebergementId['max'])) {
                $this->addUsingAlias(MultimediaTypeHebergementPeer::TYPE_HEBERGEMENT_ID, $typeHebergementId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MultimediaTypeHebergementPeer::TYPE_HEBERGEMENT_ID, $typeHebergementId, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return MultimediaTypeHebergementQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(MultimediaTypeHebergementPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(MultimediaTypeHebergementPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MultimediaTypeHebergementPeer::CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return MultimediaTypeHebergementQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(MultimediaTypeHebergementPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(MultimediaTypeHebergementPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MultimediaTypeHebergementPeer::UPDATED_AT, $updatedAt, $comparison);
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
     * @return MultimediaTypeHebergementQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(MultimediaTypeHebergementPeer::ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query by a related TypeHebergement object
     *
     * @param   TypeHebergement|PropelObjectCollection $typeHebergement The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   MultimediaTypeHebergementQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTypeHebergement($typeHebergement, $comparison = null)
    {
        if ($typeHebergement instanceof TypeHebergement) {
            return $this
                ->addUsingAlias(MultimediaTypeHebergementPeer::TYPE_HEBERGEMENT_ID, $typeHebergement->getId(), $comparison);
        } elseif ($typeHebergement instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(MultimediaTypeHebergementPeer::TYPE_HEBERGEMENT_ID, $typeHebergement->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return MultimediaTypeHebergementQuery The current query, for fluid interface
     */
    public function joinTypeHebergement($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useTypeHebergementQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTypeHebergement($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TypeHebergement', '\Cungfoo\Model\TypeHebergementQuery');
    }

    /**
     * Filter the query by a related MultimediaTypeHebergementI18n object
     *
     * @param   MultimediaTypeHebergementI18n|PropelObjectCollection $multimediaTypeHebergementI18n  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   MultimediaTypeHebergementQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByMultimediaTypeHebergementI18n($multimediaTypeHebergementI18n, $comparison = null)
    {
        if ($multimediaTypeHebergementI18n instanceof MultimediaTypeHebergementI18n) {
            return $this
                ->addUsingAlias(MultimediaTypeHebergementPeer::ID, $multimediaTypeHebergementI18n->getId(), $comparison);
        } elseif ($multimediaTypeHebergementI18n instanceof PropelObjectCollection) {
            return $this
                ->useMultimediaTypeHebergementI18nQuery()
                ->filterByPrimaryKeys($multimediaTypeHebergementI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByMultimediaTypeHebergementI18n() only accepts arguments of type MultimediaTypeHebergementI18n or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the MultimediaTypeHebergementI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return MultimediaTypeHebergementQuery The current query, for fluid interface
     */
    public function joinMultimediaTypeHebergementI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('MultimediaTypeHebergementI18n');

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
            $this->addJoinObject($join, 'MultimediaTypeHebergementI18n');
        }

        return $this;
    }

    /**
     * Use the MultimediaTypeHebergementI18n relation MultimediaTypeHebergementI18n object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\MultimediaTypeHebergementI18nQuery A secondary query class using the current class as primary query
     */
    public function useMultimediaTypeHebergementI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinMultimediaTypeHebergementI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MultimediaTypeHebergementI18n', '\Cungfoo\Model\MultimediaTypeHebergementI18nQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   MultimediaTypeHebergement $multimediaTypeHebergement Object to remove from the list of results
     *
     * @return MultimediaTypeHebergementQuery The current query, for fluid interface
     */
    public function prune($multimediaTypeHebergement = null)
    {
        if ($multimediaTypeHebergement) {
            $this->addUsingAlias(MultimediaTypeHebergementPeer::ID, $multimediaTypeHebergement->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     MultimediaTypeHebergementQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(MultimediaTypeHebergementPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     MultimediaTypeHebergementQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(MultimediaTypeHebergementPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     MultimediaTypeHebergementQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(MultimediaTypeHebergementPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     MultimediaTypeHebergementQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(MultimediaTypeHebergementPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     MultimediaTypeHebergementQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(MultimediaTypeHebergementPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     MultimediaTypeHebergementQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(MultimediaTypeHebergementPeer::CREATED_AT);
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
                    ->_or()
                ->filterByActiveLocale(null, Criteria::ISNULL)
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
     * @return    MultimediaTypeHebergementQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'MultimediaTypeHebergementI18n';

        return $this
            ->joinMultimediaTypeHebergementI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    MultimediaTypeHebergementQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'fr', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('MultimediaTypeHebergementI18n');
        $this->with['MultimediaTypeHebergementI18n']->setIsWithOneToMany(false);

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
     * @return    MultimediaTypeHebergementI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MultimediaTypeHebergementI18n', 'Cungfoo\Model\MultimediaTypeHebergementI18nQuery');
    }

}
