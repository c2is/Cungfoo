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
use Cungfoo\Model\Pays;
use Cungfoo\Model\PaysI18n;
use Cungfoo\Model\PaysPeer;
use Cungfoo\Model\PaysQuery;
use Cungfoo\Model\Region;

/**
 * Base class that represents a query for the 'pays' table.
 *
 *
 *
 * @method PaysQuery orderById($order = Criteria::ASC) Order by the id column
 * @method PaysQuery orderByCode($order = Criteria::ASC) Order by the code column
 * @method PaysQuery orderByImageDetail1($order = Criteria::ASC) Order by the image_detail_1 column
 * @method PaysQuery orderByImageDetail2($order = Criteria::ASC) Order by the image_detail_2 column
 * @method PaysQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method PaysQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method PaysQuery orderByActive($order = Criteria::ASC) Order by the active column
 *
 * @method PaysQuery groupById() Group by the id column
 * @method PaysQuery groupByCode() Group by the code column
 * @method PaysQuery groupByImageDetail1() Group by the image_detail_1 column
 * @method PaysQuery groupByImageDetail2() Group by the image_detail_2 column
 * @method PaysQuery groupByCreatedAt() Group by the created_at column
 * @method PaysQuery groupByUpdatedAt() Group by the updated_at column
 * @method PaysQuery groupByActive() Group by the active column
 *
 * @method PaysQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method PaysQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method PaysQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method PaysQuery leftJoinRegion($relationAlias = null) Adds a LEFT JOIN clause to the query using the Region relation
 * @method PaysQuery rightJoinRegion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Region relation
 * @method PaysQuery innerJoinRegion($relationAlias = null) Adds a INNER JOIN clause to the query using the Region relation
 *
 * @method PaysQuery leftJoinPaysI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the PaysI18n relation
 * @method PaysQuery rightJoinPaysI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PaysI18n relation
 * @method PaysQuery innerJoinPaysI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the PaysI18n relation
 *
 * @method Pays findOne(PropelPDO $con = null) Return the first Pays matching the query
 * @method Pays findOneOrCreate(PropelPDO $con = null) Return the first Pays matching the query, or a new Pays object populated from the query conditions when no match is found
 *
 * @method Pays findOneByCode(string $code) Return the first Pays filtered by the code column
 * @method Pays findOneByImageDetail1(string $image_detail_1) Return the first Pays filtered by the image_detail_1 column
 * @method Pays findOneByImageDetail2(string $image_detail_2) Return the first Pays filtered by the image_detail_2 column
 * @method Pays findOneByCreatedAt(string $created_at) Return the first Pays filtered by the created_at column
 * @method Pays findOneByUpdatedAt(string $updated_at) Return the first Pays filtered by the updated_at column
 * @method Pays findOneByActive(boolean $active) Return the first Pays filtered by the active column
 *
 * @method array findById(int $id) Return Pays objects filtered by the id column
 * @method array findByCode(string $code) Return Pays objects filtered by the code column
 * @method array findByImageDetail1(string $image_detail_1) Return Pays objects filtered by the image_detail_1 column
 * @method array findByImageDetail2(string $image_detail_2) Return Pays objects filtered by the image_detail_2 column
 * @method array findByCreatedAt(string $created_at) Return Pays objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return Pays objects filtered by the updated_at column
 * @method array findByActive(boolean $active) Return Pays objects filtered by the active column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BasePaysQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BasePaysQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\Pays', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new PaysQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     PaysQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return PaysQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof PaysQuery) {
            return $criteria;
        }
        $query = new PaysQuery();
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
     * @return   Pays|Pays[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PaysPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(PaysPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Pays A model object, or null if the key is not found
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
     * @return   Pays A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `code`, `image_detail_1`, `image_detail_2`, `created_at`, `updated_at`, `active` FROM `pays` WHERE `id` = :p0';
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
            $obj = new Pays();
            $obj->hydrate($row);
            PaysPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Pays|Pays[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Pays[]|mixed the list of results, formatted by the current formatter
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
     * @return PaysQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PaysPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return PaysQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PaysPeer::ID, $keys, Criteria::IN);
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
     * @return PaysQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(PaysPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the code column
     *
     * Example usage:
     * <code>
     * $query->filterByCode('fooValue');   // WHERE code = 'fooValue'
     * $query->filterByCode('%fooValue%'); // WHERE code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $code The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PaysQuery The current query, for fluid interface
     */
    public function filterByCode($code = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($code)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $code)) {
                $code = str_replace('*', '%', $code);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PaysPeer::CODE, $code, $comparison);
    }

    /**
     * Filter the query on the image_detail_1 column
     *
     * Example usage:
     * <code>
     * $query->filterByImageDetail1('fooValue');   // WHERE image_detail_1 = 'fooValue'
     * $query->filterByImageDetail1('%fooValue%'); // WHERE image_detail_1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $imageDetail1 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PaysQuery The current query, for fluid interface
     */
    public function filterByImageDetail1($imageDetail1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($imageDetail1)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $imageDetail1)) {
                $imageDetail1 = str_replace('*', '%', $imageDetail1);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PaysPeer::IMAGE_DETAIL_1, $imageDetail1, $comparison);
    }

    /**
     * Filter the query on the image_detail_2 column
     *
     * Example usage:
     * <code>
     * $query->filterByImageDetail2('fooValue');   // WHERE image_detail_2 = 'fooValue'
     * $query->filterByImageDetail2('%fooValue%'); // WHERE image_detail_2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $imageDetail2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PaysQuery The current query, for fluid interface
     */
    public function filterByImageDetail2($imageDetail2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($imageDetail2)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $imageDetail2)) {
                $imageDetail2 = str_replace('*', '%', $imageDetail2);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PaysPeer::IMAGE_DETAIL_2, $imageDetail2, $comparison);
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
     * @return PaysQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(PaysPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(PaysPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PaysPeer::CREATED_AT, $createdAt, $comparison);
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
     * @return PaysQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(PaysPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(PaysPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PaysPeer::UPDATED_AT, $updatedAt, $comparison);
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
     * @return PaysQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(PaysPeer::ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query by a related Region object
     *
     * @param   Region|PropelObjectCollection $region  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PaysQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByRegion($region, $comparison = null)
    {
        if ($region instanceof Region) {
            return $this
                ->addUsingAlias(PaysPeer::ID, $region->getPaysId(), $comparison);
        } elseif ($region instanceof PropelObjectCollection) {
            return $this
                ->useRegionQuery()
                ->filterByPrimaryKeys($region->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByRegion() only accepts arguments of type Region or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Region relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PaysQuery The current query, for fluid interface
     */
    public function joinRegion($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Region');

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
            $this->addJoinObject($join, 'Region');
        }

        return $this;
    }

    /**
     * Use the Region relation Region object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\RegionQuery A secondary query class using the current class as primary query
     */
    public function useRegionQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinRegion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Region', '\Cungfoo\Model\RegionQuery');
    }

    /**
     * Filter the query by a related PaysI18n object
     *
     * @param   PaysI18n|PropelObjectCollection $paysI18n  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PaysQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByPaysI18n($paysI18n, $comparison = null)
    {
        if ($paysI18n instanceof PaysI18n) {
            return $this
                ->addUsingAlias(PaysPeer::ID, $paysI18n->getId(), $comparison);
        } elseif ($paysI18n instanceof PropelObjectCollection) {
            return $this
                ->usePaysI18nQuery()
                ->filterByPrimaryKeys($paysI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPaysI18n() only accepts arguments of type PaysI18n or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PaysI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PaysQuery The current query, for fluid interface
     */
    public function joinPaysI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PaysI18n');

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
            $this->addJoinObject($join, 'PaysI18n');
        }

        return $this;
    }

    /**
     * Use the PaysI18n relation PaysI18n object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\PaysI18nQuery A secondary query class using the current class as primary query
     */
    public function usePaysI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinPaysI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PaysI18n', '\Cungfoo\Model\PaysI18nQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Pays $pays Object to remove from the list of results
     *
     * @return PaysQuery The current query, for fluid interface
     */
    public function prune($pays = null)
    {
        if ($pays) {
            $this->addUsingAlias(PaysPeer::ID, $pays->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     PaysQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(PaysPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     PaysQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(PaysPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     PaysQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(PaysPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     PaysQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(PaysPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     PaysQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(PaysPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     PaysQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(PaysPeer::CREATED_AT);
    }
    // active behavior
    
    /**
     * return only active objects
     *
     * @return boolean
     */
    public function findActive($con = null)
    {
        $this->filterByActive(true);
    
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
     * @return    PaysQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'PaysI18n';

        return $this
            ->joinPaysI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    PaysQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'fr', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('PaysI18n');
        $this->with['PaysI18n']->setIsWithOneToMany(false);

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
     * @return    PaysI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PaysI18n', 'Cungfoo\Model\PaysI18nQuery');
    }

    // crudable behavior
    
    public function filterByTerm($term)
    {
        $term = '%' . $term . '%';
    
        return $this
            ->_or()
            ->useI18nQuery()
            ->filterByName($term, \Criteria::LIKE)
            ->endUse()
        ;
    }
}
