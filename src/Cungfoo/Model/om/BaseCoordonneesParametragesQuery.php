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
use Cungfoo\Model\CoordonneesParametrages;
use Cungfoo\Model\CoordonneesParametragesI18n;
use Cungfoo\Model\CoordonneesParametragesPeer;
use Cungfoo\Model\CoordonneesParametragesQuery;

/**
 * Base class that represents a query for the 'coordonnees_parametrages' table.
 *
 *
 *
 * @method CoordonneesParametragesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method CoordonneesParametragesQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method CoordonneesParametragesQuery orderByValue($order = Criteria::ASC) Order by the value column
 * @method CoordonneesParametragesQuery orderByIsUsine($order = Criteria::ASC) Order by the is_usine column
 * @method CoordonneesParametragesQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method CoordonneesParametragesQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method CoordonneesParametragesQuery orderByActive($order = Criteria::ASC) Order by the active column
 *
 * @method CoordonneesParametragesQuery groupById() Group by the id column
 * @method CoordonneesParametragesQuery groupByName() Group by the name column
 * @method CoordonneesParametragesQuery groupByValue() Group by the value column
 * @method CoordonneesParametragesQuery groupByIsUsine() Group by the is_usine column
 * @method CoordonneesParametragesQuery groupByCreatedAt() Group by the created_at column
 * @method CoordonneesParametragesQuery groupByUpdatedAt() Group by the updated_at column
 * @method CoordonneesParametragesQuery groupByActive() Group by the active column
 *
 * @method CoordonneesParametragesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method CoordonneesParametragesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method CoordonneesParametragesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method CoordonneesParametragesQuery leftJoinCoordonneesParametragesI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the CoordonneesParametragesI18n relation
 * @method CoordonneesParametragesQuery rightJoinCoordonneesParametragesI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CoordonneesParametragesI18n relation
 * @method CoordonneesParametragesQuery innerJoinCoordonneesParametragesI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the CoordonneesParametragesI18n relation
 *
 * @method CoordonneesParametrages findOne(PropelPDO $con = null) Return the first CoordonneesParametrages matching the query
 * @method CoordonneesParametrages findOneOrCreate(PropelPDO $con = null) Return the first CoordonneesParametrages matching the query, or a new CoordonneesParametrages object populated from the query conditions when no match is found
 *
 * @method CoordonneesParametrages findOneByName(int $name) Return the first CoordonneesParametrages filtered by the name column
 * @method CoordonneesParametrages findOneByValue(string $value) Return the first CoordonneesParametrages filtered by the value column
 * @method CoordonneesParametrages findOneByIsUsine(boolean $is_usine) Return the first CoordonneesParametrages filtered by the is_usine column
 * @method CoordonneesParametrages findOneByCreatedAt(string $created_at) Return the first CoordonneesParametrages filtered by the created_at column
 * @method CoordonneesParametrages findOneByUpdatedAt(string $updated_at) Return the first CoordonneesParametrages filtered by the updated_at column
 * @method CoordonneesParametrages findOneByActive(boolean $active) Return the first CoordonneesParametrages filtered by the active column
 *
 * @method array findById(int $id) Return CoordonneesParametrages objects filtered by the id column
 * @method array findByName(int $name) Return CoordonneesParametrages objects filtered by the name column
 * @method array findByValue(string $value) Return CoordonneesParametrages objects filtered by the value column
 * @method array findByIsUsine(boolean $is_usine) Return CoordonneesParametrages objects filtered by the is_usine column
 * @method array findByCreatedAt(string $created_at) Return CoordonneesParametrages objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return CoordonneesParametrages objects filtered by the updated_at column
 * @method array findByActive(boolean $active) Return CoordonneesParametrages objects filtered by the active column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseCoordonneesParametragesQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseCoordonneesParametragesQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\CoordonneesParametrages', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new CoordonneesParametragesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     CoordonneesParametragesQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return CoordonneesParametragesQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof CoordonneesParametragesQuery) {
            return $criteria;
        }
        $query = new CoordonneesParametragesQuery();
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
     * @return   CoordonneesParametrages|CoordonneesParametrages[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CoordonneesParametragesPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(CoordonneesParametragesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   CoordonneesParametrages A model object, or null if the key is not found
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
     * @return   CoordonneesParametrages A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `name`, `value`, `is_usine`, `created_at`, `updated_at`, `active` FROM `coordonnees_parametrages` WHERE `id` = :p0';
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
            $obj = new CoordonneesParametrages();
            $obj->hydrate($row);
            CoordonneesParametragesPeer::addInstanceToPool($obj, (string) $key);
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
     * @return CoordonneesParametrages|CoordonneesParametrages[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|CoordonneesParametrages[]|mixed the list of results, formatted by the current formatter
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
     * @return CoordonneesParametragesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CoordonneesParametragesPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return CoordonneesParametragesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CoordonneesParametragesPeer::ID, $keys, Criteria::IN);
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
     * @return CoordonneesParametragesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(CoordonneesParametragesPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * @param     mixed $name The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CoordonneesParametragesQuery The current query, for fluid interface
     * @throws PropelException - if the value is not accepted by the enum.
     */
    public function filterByName($name = null, $comparison = null)
    {
        $valueSet = CoordonneesParametragesPeer::getValueSet(CoordonneesParametragesPeer::NAME);
        if (is_scalar($name)) {
            if (!in_array($name, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $name));
            }
            $name = array_search($name, $valueSet);
        } elseif (is_array($name)) {
            $convertedValues = array();
            foreach ($name as $value) {
                if (!in_array($value, $valueSet)) {
                    throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $value));
                }
                $convertedValues []= array_search($value, $valueSet);
            }
            $name = $convertedValues;
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CoordonneesParametragesPeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query on the value column
     *
     * Example usage:
     * <code>
     * $query->filterByValue('fooValue');   // WHERE value = 'fooValue'
     * $query->filterByValue('%fooValue%'); // WHERE value LIKE '%fooValue%'
     * </code>
     *
     * @param     string $value The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CoordonneesParametragesQuery The current query, for fluid interface
     */
    public function filterByValue($value = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($value)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $value)) {
                $value = str_replace('*', '%', $value);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CoordonneesParametragesPeer::VALUE, $value, $comparison);
    }

    /**
     * Filter the query on the is_usine column
     *
     * Example usage:
     * <code>
     * $query->filterByIsUsine(true); // WHERE is_usine = true
     * $query->filterByIsUsine('yes'); // WHERE is_usine = true
     * </code>
     *
     * @param     boolean|string $isUsine The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CoordonneesParametragesQuery The current query, for fluid interface
     */
    public function filterByIsUsine($isUsine = null, $comparison = null)
    {
        if (is_string($isUsine)) {
            $is_usine = in_array(strtolower($isUsine), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(CoordonneesParametragesPeer::IS_USINE, $isUsine, $comparison);
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
     * @return CoordonneesParametragesQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(CoordonneesParametragesPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(CoordonneesParametragesPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CoordonneesParametragesPeer::CREATED_AT, $createdAt, $comparison);
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
     * @return CoordonneesParametragesQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(CoordonneesParametragesPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(CoordonneesParametragesPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CoordonneesParametragesPeer::UPDATED_AT, $updatedAt, $comparison);
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
     * @return CoordonneesParametragesQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(CoordonneesParametragesPeer::ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query by a related CoordonneesParametragesI18n object
     *
     * @param   CoordonneesParametragesI18n|PropelObjectCollection $coordonneesParametragesI18n  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   CoordonneesParametragesQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByCoordonneesParametragesI18n($coordonneesParametragesI18n, $comparison = null)
    {
        if ($coordonneesParametragesI18n instanceof CoordonneesParametragesI18n) {
            return $this
                ->addUsingAlias(CoordonneesParametragesPeer::ID, $coordonneesParametragesI18n->getId(), $comparison);
        } elseif ($coordonneesParametragesI18n instanceof PropelObjectCollection) {
            return $this
                ->useCoordonneesParametragesI18nQuery()
                ->filterByPrimaryKeys($coordonneesParametragesI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCoordonneesParametragesI18n() only accepts arguments of type CoordonneesParametragesI18n or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CoordonneesParametragesI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return CoordonneesParametragesQuery The current query, for fluid interface
     */
    public function joinCoordonneesParametragesI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CoordonneesParametragesI18n');

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
            $this->addJoinObject($join, 'CoordonneesParametragesI18n');
        }

        return $this;
    }

    /**
     * Use the CoordonneesParametragesI18n relation CoordonneesParametragesI18n object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\CoordonneesParametragesI18nQuery A secondary query class using the current class as primary query
     */
    public function useCoordonneesParametragesI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinCoordonneesParametragesI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CoordonneesParametragesI18n', '\Cungfoo\Model\CoordonneesParametragesI18nQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   CoordonneesParametrages $coordonneesParametrages Object to remove from the list of results
     *
     * @return CoordonneesParametragesQuery The current query, for fluid interface
     */
    public function prune($coordonneesParametrages = null)
    {
        if ($coordonneesParametrages) {
            $this->addUsingAlias(CoordonneesParametragesPeer::ID, $coordonneesParametrages->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     CoordonneesParametragesQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(CoordonneesParametragesPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     CoordonneesParametragesQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(CoordonneesParametragesPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     CoordonneesParametragesQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(CoordonneesParametragesPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     CoordonneesParametragesQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(CoordonneesParametragesPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     CoordonneesParametragesQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(CoordonneesParametragesPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     CoordonneesParametragesQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(CoordonneesParametragesPeer::CREATED_AT);
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
     * @return    CoordonneesParametragesQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'CoordonneesParametragesI18n';

        return $this
            ->joinCoordonneesParametragesI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    CoordonneesParametragesQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'fr', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('CoordonneesParametragesI18n');
        $this->with['CoordonneesParametragesI18n']->setIsWithOneToMany(false);

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
     * @return    CoordonneesParametragesI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CoordonneesParametragesI18n', 'Cungfoo\Model\CoordonneesParametragesI18nQuery');
    }

}
