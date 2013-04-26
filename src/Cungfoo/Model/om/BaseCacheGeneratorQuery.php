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
use Cungfoo\Model\CacheGenerator;
use Cungfoo\Model\CacheGeneratorI18n;
use Cungfoo\Model\CacheGeneratorPeer;
use Cungfoo\Model\CacheGeneratorQuery;

/**
 * Base class that represents a query for the 'cache_generator' table.
 *
 *
 *
 * @method CacheGeneratorQuery orderById($order = Criteria::ASC) Order by the id column
 * @method CacheGeneratorQuery orderByUrl($order = Criteria::ASC) Order by the url column
 * @method CacheGeneratorQuery orderByCacheTime($order = Criteria::ASC) Order by the cache_time column
 * @method CacheGeneratorQuery orderByCachedAt($order = Criteria::ASC) Order by the cached_at column
 * @method CacheGeneratorQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method CacheGeneratorQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method CacheGeneratorQuery orderByActive($order = Criteria::ASC) Order by the active column
 *
 * @method CacheGeneratorQuery groupById() Group by the id column
 * @method CacheGeneratorQuery groupByUrl() Group by the url column
 * @method CacheGeneratorQuery groupByCacheTime() Group by the cache_time column
 * @method CacheGeneratorQuery groupByCachedAt() Group by the cached_at column
 * @method CacheGeneratorQuery groupByCreatedAt() Group by the created_at column
 * @method CacheGeneratorQuery groupByUpdatedAt() Group by the updated_at column
 * @method CacheGeneratorQuery groupByActive() Group by the active column
 *
 * @method CacheGeneratorQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method CacheGeneratorQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method CacheGeneratorQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method CacheGeneratorQuery leftJoinCacheGeneratorI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the CacheGeneratorI18n relation
 * @method CacheGeneratorQuery rightJoinCacheGeneratorI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CacheGeneratorI18n relation
 * @method CacheGeneratorQuery innerJoinCacheGeneratorI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the CacheGeneratorI18n relation
 *
 * @method CacheGenerator findOne(PropelPDO $con = null) Return the first CacheGenerator matching the query
 * @method CacheGenerator findOneOrCreate(PropelPDO $con = null) Return the first CacheGenerator matching the query, or a new CacheGenerator object populated from the query conditions when no match is found
 *
 * @method CacheGenerator findOneByUrl(string $url) Return the first CacheGenerator filtered by the url column
 * @method CacheGenerator findOneByCacheTime(int $cache_time) Return the first CacheGenerator filtered by the cache_time column
 * @method CacheGenerator findOneByCachedAt(string $cached_at) Return the first CacheGenerator filtered by the cached_at column
 * @method CacheGenerator findOneByCreatedAt(string $created_at) Return the first CacheGenerator filtered by the created_at column
 * @method CacheGenerator findOneByUpdatedAt(string $updated_at) Return the first CacheGenerator filtered by the updated_at column
 * @method CacheGenerator findOneByActive(boolean $active) Return the first CacheGenerator filtered by the active column
 *
 * @method array findById(int $id) Return CacheGenerator objects filtered by the id column
 * @method array findByUrl(string $url) Return CacheGenerator objects filtered by the url column
 * @method array findByCacheTime(int $cache_time) Return CacheGenerator objects filtered by the cache_time column
 * @method array findByCachedAt(string $cached_at) Return CacheGenerator objects filtered by the cached_at column
 * @method array findByCreatedAt(string $created_at) Return CacheGenerator objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return CacheGenerator objects filtered by the updated_at column
 * @method array findByActive(boolean $active) Return CacheGenerator objects filtered by the active column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseCacheGeneratorQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseCacheGeneratorQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\CacheGenerator', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new CacheGeneratorQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     CacheGeneratorQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return CacheGeneratorQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof CacheGeneratorQuery) {
            return $criteria;
        }
        $query = new CacheGeneratorQuery();
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
     * @return   CacheGenerator|CacheGenerator[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CacheGeneratorPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(CacheGeneratorPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   CacheGenerator A model object, or null if the key is not found
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
     * @return   CacheGenerator A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `url`, `cache_time`, `cached_at`, `created_at`, `updated_at`, `active` FROM `cache_generator` WHERE `id` = :p0';
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
            $obj = new CacheGenerator();
            $obj->hydrate($row);
            CacheGeneratorPeer::addInstanceToPool($obj, (string) $key);
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
     * @return CacheGenerator|CacheGenerator[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|CacheGenerator[]|mixed the list of results, formatted by the current formatter
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
     * @return CacheGeneratorQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CacheGeneratorPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return CacheGeneratorQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CacheGeneratorPeer::ID, $keys, Criteria::IN);
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
     * @return CacheGeneratorQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(CacheGeneratorPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the url column
     *
     * Example usage:
     * <code>
     * $query->filterByUrl('fooValue');   // WHERE url = 'fooValue'
     * $query->filterByUrl('%fooValue%'); // WHERE url LIKE '%fooValue%'
     * </code>
     *
     * @param     string $url The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CacheGeneratorQuery The current query, for fluid interface
     */
    public function filterByUrl($url = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($url)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $url)) {
                $url = str_replace('*', '%', $url);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CacheGeneratorPeer::URL, $url, $comparison);
    }

    /**
     * Filter the query on the cache_time column
     *
     * Example usage:
     * <code>
     * $query->filterByCacheTime(1234); // WHERE cache_time = 1234
     * $query->filterByCacheTime(array(12, 34)); // WHERE cache_time IN (12, 34)
     * $query->filterByCacheTime(array('min' => 12)); // WHERE cache_time > 12
     * </code>
     *
     * @param     mixed $cacheTime The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CacheGeneratorQuery The current query, for fluid interface
     */
    public function filterByCacheTime($cacheTime = null, $comparison = null)
    {
        if (is_array($cacheTime)) {
            $useMinMax = false;
            if (isset($cacheTime['min'])) {
                $this->addUsingAlias(CacheGeneratorPeer::CACHE_TIME, $cacheTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cacheTime['max'])) {
                $this->addUsingAlias(CacheGeneratorPeer::CACHE_TIME, $cacheTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CacheGeneratorPeer::CACHE_TIME, $cacheTime, $comparison);
    }

    /**
     * Filter the query on the cached_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCachedAt('2011-03-14'); // WHERE cached_at = '2011-03-14'
     * $query->filterByCachedAt('now'); // WHERE cached_at = '2011-03-14'
     * $query->filterByCachedAt(array('max' => 'yesterday')); // WHERE cached_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $cachedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CacheGeneratorQuery The current query, for fluid interface
     */
    public function filterByCachedAt($cachedAt = null, $comparison = null)
    {
        if (is_array($cachedAt)) {
            $useMinMax = false;
            if (isset($cachedAt['min'])) {
                $this->addUsingAlias(CacheGeneratorPeer::CACHED_AT, $cachedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cachedAt['max'])) {
                $this->addUsingAlias(CacheGeneratorPeer::CACHED_AT, $cachedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CacheGeneratorPeer::CACHED_AT, $cachedAt, $comparison);
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
     * @return CacheGeneratorQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(CacheGeneratorPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(CacheGeneratorPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CacheGeneratorPeer::CREATED_AT, $createdAt, $comparison);
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
     * @return CacheGeneratorQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(CacheGeneratorPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(CacheGeneratorPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CacheGeneratorPeer::UPDATED_AT, $updatedAt, $comparison);
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
     * @return CacheGeneratorQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(CacheGeneratorPeer::ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query by a related CacheGeneratorI18n object
     *
     * @param   CacheGeneratorI18n|PropelObjectCollection $cacheGeneratorI18n  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   CacheGeneratorQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByCacheGeneratorI18n($cacheGeneratorI18n, $comparison = null)
    {
        if ($cacheGeneratorI18n instanceof CacheGeneratorI18n) {
            return $this
                ->addUsingAlias(CacheGeneratorPeer::ID, $cacheGeneratorI18n->getId(), $comparison);
        } elseif ($cacheGeneratorI18n instanceof PropelObjectCollection) {
            return $this
                ->useCacheGeneratorI18nQuery()
                ->filterByPrimaryKeys($cacheGeneratorI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCacheGeneratorI18n() only accepts arguments of type CacheGeneratorI18n or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CacheGeneratorI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return CacheGeneratorQuery The current query, for fluid interface
     */
    public function joinCacheGeneratorI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CacheGeneratorI18n');

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
            $this->addJoinObject($join, 'CacheGeneratorI18n');
        }

        return $this;
    }

    /**
     * Use the CacheGeneratorI18n relation CacheGeneratorI18n object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\CacheGeneratorI18nQuery A secondary query class using the current class as primary query
     */
    public function useCacheGeneratorI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinCacheGeneratorI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CacheGeneratorI18n', '\Cungfoo\Model\CacheGeneratorI18nQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   CacheGenerator $cacheGenerator Object to remove from the list of results
     *
     * @return CacheGeneratorQuery The current query, for fluid interface
     */
    public function prune($cacheGenerator = null)
    {
        if ($cacheGenerator) {
            $this->addUsingAlias(CacheGeneratorPeer::ID, $cacheGenerator->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     CacheGeneratorQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(CacheGeneratorPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     CacheGeneratorQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(CacheGeneratorPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     CacheGeneratorQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(CacheGeneratorPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     CacheGeneratorQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(CacheGeneratorPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     CacheGeneratorQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(CacheGeneratorPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     CacheGeneratorQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(CacheGeneratorPeer::CREATED_AT);
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
     * @return    CacheGeneratorQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'CacheGeneratorI18n';

        return $this
            ->joinCacheGeneratorI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    CacheGeneratorQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'fr', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('CacheGeneratorI18n');
        $this->with['CacheGeneratorI18n']->setIsWithOneToMany(false);

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
     * @return    CacheGeneratorI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CacheGeneratorI18n', 'Cungfoo\Model\CacheGeneratorI18nQuery');
    }

}
