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
use Cungfoo\Model\PortfolioMedia;
use Cungfoo\Model\PortfolioUsage;
use Cungfoo\Model\PortfolioUsagePeer;
use Cungfoo\Model\PortfolioUsageQuery;

/**
 * Base class that represents a query for the 'portfolio_usage' table.
 *
 *
 *
 * @method PortfolioUsageQuery orderById($order = Criteria::ASC) Order by the id column
 * @method PortfolioUsageQuery orderByMediaId($order = Criteria::ASC) Order by the media_id column
 * @method PortfolioUsageQuery orderByTableRef($order = Criteria::ASC) Order by the table_ref column
 * @method PortfolioUsageQuery orderByColumnRef($order = Criteria::ASC) Order by the column_ref column
 * @method PortfolioUsageQuery orderByElementId($order = Criteria::ASC) Order by the element_id column
 * @method PortfolioUsageQuery orderBySortableRank($order = Criteria::ASC) Order by the sortable_rank column
 * @method PortfolioUsageQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method PortfolioUsageQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method PortfolioUsageQuery orderByActive($order = Criteria::ASC) Order by the active column
 *
 * @method PortfolioUsageQuery groupById() Group by the id column
 * @method PortfolioUsageQuery groupByMediaId() Group by the media_id column
 * @method PortfolioUsageQuery groupByTableRef() Group by the table_ref column
 * @method PortfolioUsageQuery groupByColumnRef() Group by the column_ref column
 * @method PortfolioUsageQuery groupByElementId() Group by the element_id column
 * @method PortfolioUsageQuery groupBySortableRank() Group by the sortable_rank column
 * @method PortfolioUsageQuery groupByCreatedAt() Group by the created_at column
 * @method PortfolioUsageQuery groupByUpdatedAt() Group by the updated_at column
 * @method PortfolioUsageQuery groupByActive() Group by the active column
 *
 * @method PortfolioUsageQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method PortfolioUsageQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method PortfolioUsageQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method PortfolioUsageQuery leftJoinPortfolioMedia($relationAlias = null) Adds a LEFT JOIN clause to the query using the PortfolioMedia relation
 * @method PortfolioUsageQuery rightJoinPortfolioMedia($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PortfolioMedia relation
 * @method PortfolioUsageQuery innerJoinPortfolioMedia($relationAlias = null) Adds a INNER JOIN clause to the query using the PortfolioMedia relation
 *
 * @method PortfolioUsage findOne(PropelPDO $con = null) Return the first PortfolioUsage matching the query
 * @method PortfolioUsage findOneOrCreate(PropelPDO $con = null) Return the first PortfolioUsage matching the query, or a new PortfolioUsage object populated from the query conditions when no match is found
 *
 * @method PortfolioUsage findOneByMediaId(int $media_id) Return the first PortfolioUsage filtered by the media_id column
 * @method PortfolioUsage findOneByTableRef(string $table_ref) Return the first PortfolioUsage filtered by the table_ref column
 * @method PortfolioUsage findOneByColumnRef(string $column_ref) Return the first PortfolioUsage filtered by the column_ref column
 * @method PortfolioUsage findOneByElementId(int $element_id) Return the first PortfolioUsage filtered by the element_id column
 * @method PortfolioUsage findOneBySortableRank(int $sortable_rank) Return the first PortfolioUsage filtered by the sortable_rank column
 * @method PortfolioUsage findOneByCreatedAt(string $created_at) Return the first PortfolioUsage filtered by the created_at column
 * @method PortfolioUsage findOneByUpdatedAt(string $updated_at) Return the first PortfolioUsage filtered by the updated_at column
 * @method PortfolioUsage findOneByActive(boolean $active) Return the first PortfolioUsage filtered by the active column
 *
 * @method array findById(int $id) Return PortfolioUsage objects filtered by the id column
 * @method array findByMediaId(int $media_id) Return PortfolioUsage objects filtered by the media_id column
 * @method array findByTableRef(string $table_ref) Return PortfolioUsage objects filtered by the table_ref column
 * @method array findByColumnRef(string $column_ref) Return PortfolioUsage objects filtered by the column_ref column
 * @method array findByElementId(int $element_id) Return PortfolioUsage objects filtered by the element_id column
 * @method array findBySortableRank(int $sortable_rank) Return PortfolioUsage objects filtered by the sortable_rank column
 * @method array findByCreatedAt(string $created_at) Return PortfolioUsage objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return PortfolioUsage objects filtered by the updated_at column
 * @method array findByActive(boolean $active) Return PortfolioUsage objects filtered by the active column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BasePortfolioUsageQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BasePortfolioUsageQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\PortfolioUsage', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new PortfolioUsageQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     PortfolioUsageQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return PortfolioUsageQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof PortfolioUsageQuery) {
            return $criteria;
        }
        $query = new PortfolioUsageQuery();
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
     * @return   PortfolioUsage|PortfolioUsage[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PortfolioUsagePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(PortfolioUsagePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   PortfolioUsage A model object, or null if the key is not found
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
     * @return   PortfolioUsage A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `media_id`, `table_ref`, `column_ref`, `element_id`, `sortable_rank`, `created_at`, `updated_at`, `active` FROM `portfolio_usage` WHERE `id` = :p0';
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
            $obj = new PortfolioUsage();
            $obj->hydrate($row);
            PortfolioUsagePeer::addInstanceToPool($obj, (string) $key);
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
     * @return PortfolioUsage|PortfolioUsage[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|PortfolioUsage[]|mixed the list of results, formatted by the current formatter
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
     * @return PortfolioUsageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PortfolioUsagePeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return PortfolioUsageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PortfolioUsagePeer::ID, $keys, Criteria::IN);
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
     * @return PortfolioUsageQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(PortfolioUsagePeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the media_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMediaId(1234); // WHERE media_id = 1234
     * $query->filterByMediaId(array(12, 34)); // WHERE media_id IN (12, 34)
     * $query->filterByMediaId(array('min' => 12)); // WHERE media_id > 12
     * </code>
     *
     * @see       filterByPortfolioMedia()
     *
     * @param     mixed $mediaId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PortfolioUsageQuery The current query, for fluid interface
     */
    public function filterByMediaId($mediaId = null, $comparison = null)
    {
        if (is_array($mediaId)) {
            $useMinMax = false;
            if (isset($mediaId['min'])) {
                $this->addUsingAlias(PortfolioUsagePeer::MEDIA_ID, $mediaId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($mediaId['max'])) {
                $this->addUsingAlias(PortfolioUsagePeer::MEDIA_ID, $mediaId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PortfolioUsagePeer::MEDIA_ID, $mediaId, $comparison);
    }

    /**
     * Filter the query on the table_ref column
     *
     * Example usage:
     * <code>
     * $query->filterByTableRef('fooValue');   // WHERE table_ref = 'fooValue'
     * $query->filterByTableRef('%fooValue%'); // WHERE table_ref LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tableRef The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PortfolioUsageQuery The current query, for fluid interface
     */
    public function filterByTableRef($tableRef = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tableRef)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tableRef)) {
                $tableRef = str_replace('*', '%', $tableRef);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PortfolioUsagePeer::TABLE_REF, $tableRef, $comparison);
    }

    /**
     * Filter the query on the column_ref column
     *
     * Example usage:
     * <code>
     * $query->filterByColumnRef('fooValue');   // WHERE column_ref = 'fooValue'
     * $query->filterByColumnRef('%fooValue%'); // WHERE column_ref LIKE '%fooValue%'
     * </code>
     *
     * @param     string $columnRef The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PortfolioUsageQuery The current query, for fluid interface
     */
    public function filterByColumnRef($columnRef = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($columnRef)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $columnRef)) {
                $columnRef = str_replace('*', '%', $columnRef);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PortfolioUsagePeer::COLUMN_REF, $columnRef, $comparison);
    }

    /**
     * Filter the query on the element_id column
     *
     * Example usage:
     * <code>
     * $query->filterByElementId(1234); // WHERE element_id = 1234
     * $query->filterByElementId(array(12, 34)); // WHERE element_id IN (12, 34)
     * $query->filterByElementId(array('min' => 12)); // WHERE element_id > 12
     * </code>
     *
     * @param     mixed $elementId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PortfolioUsageQuery The current query, for fluid interface
     */
    public function filterByElementId($elementId = null, $comparison = null)
    {
        if (is_array($elementId)) {
            $useMinMax = false;
            if (isset($elementId['min'])) {
                $this->addUsingAlias(PortfolioUsagePeer::ELEMENT_ID, $elementId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($elementId['max'])) {
                $this->addUsingAlias(PortfolioUsagePeer::ELEMENT_ID, $elementId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PortfolioUsagePeer::ELEMENT_ID, $elementId, $comparison);
    }

    /**
     * Filter the query on the sortable_rank column
     *
     * Example usage:
     * <code>
     * $query->filterBySortableRank(1234); // WHERE sortable_rank = 1234
     * $query->filterBySortableRank(array(12, 34)); // WHERE sortable_rank IN (12, 34)
     * $query->filterBySortableRank(array('min' => 12)); // WHERE sortable_rank > 12
     * </code>
     *
     * @param     mixed $sortableRank The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PortfolioUsageQuery The current query, for fluid interface
     */
    public function filterBySortableRank($sortableRank = null, $comparison = null)
    {
        if (is_array($sortableRank)) {
            $useMinMax = false;
            if (isset($sortableRank['min'])) {
                $this->addUsingAlias(PortfolioUsagePeer::SORTABLE_RANK, $sortableRank['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sortableRank['max'])) {
                $this->addUsingAlias(PortfolioUsagePeer::SORTABLE_RANK, $sortableRank['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PortfolioUsagePeer::SORTABLE_RANK, $sortableRank, $comparison);
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
     * @return PortfolioUsageQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(PortfolioUsagePeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(PortfolioUsagePeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PortfolioUsagePeer::CREATED_AT, $createdAt, $comparison);
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
     * @return PortfolioUsageQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(PortfolioUsagePeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(PortfolioUsagePeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PortfolioUsagePeer::UPDATED_AT, $updatedAt, $comparison);
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
     * @return PortfolioUsageQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(PortfolioUsagePeer::ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query by a related PortfolioMedia object
     *
     * @param   PortfolioMedia|PropelObjectCollection $portfolioMedia The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PortfolioUsageQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByPortfolioMedia($portfolioMedia, $comparison = null)
    {
        if ($portfolioMedia instanceof PortfolioMedia) {
            return $this
                ->addUsingAlias(PortfolioUsagePeer::MEDIA_ID, $portfolioMedia->getId(), $comparison);
        } elseif ($portfolioMedia instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PortfolioUsagePeer::MEDIA_ID, $portfolioMedia->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPortfolioMedia() only accepts arguments of type PortfolioMedia or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PortfolioMedia relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PortfolioUsageQuery The current query, for fluid interface
     */
    public function joinPortfolioMedia($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PortfolioMedia');

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
            $this->addJoinObject($join, 'PortfolioMedia');
        }

        return $this;
    }

    /**
     * Use the PortfolioMedia relation PortfolioMedia object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\PortfolioMediaQuery A secondary query class using the current class as primary query
     */
    public function usePortfolioMediaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPortfolioMedia($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PortfolioMedia', '\Cungfoo\Model\PortfolioMediaQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   PortfolioUsage $portfolioUsage Object to remove from the list of results
     *
     * @return PortfolioUsageQuery The current query, for fluid interface
     */
    public function prune($portfolioUsage = null)
    {
        if ($portfolioUsage) {
            $this->addUsingAlias(PortfolioUsagePeer::ID, $portfolioUsage->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // sortable behavior

    /**
     * Filter the query based on a rank in the list
     *
     * @param     integer   $rank rank
     *
     * @return    PortfolioUsageQuery The current query, for fluid interface
     */
    public function filterByRank($rank)
    {
        return $this
            ->addUsingAlias(PortfolioUsagePeer::RANK_COL, $rank, Criteria::EQUAL);
    }

    /**
     * Order the query based on the rank in the list.
     * Using the default $order, returns the item with the lowest rank first
     *
     * @param     string $order either Criteria::ASC (default) or Criteria::DESC
     *
     * @return    PortfolioUsageQuery The current query, for fluid interface
     */
    public function orderByRank($order = Criteria::ASC)
    {
        $order = strtoupper($order);
        switch ($order) {
            case Criteria::ASC:
                return $this->addAscendingOrderByColumn($this->getAliasedColName(PortfolioUsagePeer::RANK_COL));
                break;
            case Criteria::DESC:
                return $this->addDescendingOrderByColumn($this->getAliasedColName(PortfolioUsagePeer::RANK_COL));
                break;
            default:
                throw new PropelException('PortfolioUsageQuery::orderBy() only accepts "asc" or "desc" as argument');
        }
    }

    /**
     * Get an item from the list based on its rank
     *
     * @param     integer   $rank rank
     * @param     PropelPDO $con optional connection
     *
     * @return    PortfolioUsage
     */
    public function findOneByRank($rank, PropelPDO $con = null)
    {
        return $this
            ->filterByRank($rank)
            ->findOne($con);
    }

    /**
     * Returns the list of objects
     *
     * @param      PropelPDO $con	Connection to use.
     *
     * @return     mixed the list of results, formatted by the current formatter
     */
    public function findList($con = null)
    {
        return $this
            ->orderByRank()
            ->find($con);
    }

    /**
     * Get the highest rank
     *
     * @param     PropelPDO optional connection
     *
     * @return    integer highest position
     */
    public function getMaxRank(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(PortfolioUsagePeer::DATABASE_NAME);
        }
        // shift the objects with a position lower than the one of object
        $this->addSelectColumn('MAX(' . PortfolioUsagePeer::RANK_COL . ')');
        $stmt = $this->doSelect($con);

        return $stmt->fetchColumn();
    }

    /**
     * Reorder a set of sortable objects based on a list of id/position
     * Beware that there is no check made on the positions passed
     * So incoherent positions will result in an incoherent list
     *
     * @param     array     $order id => rank pairs
     * @param     PropelPDO $con   optional connection
     *
     * @return    boolean true if the reordering took place, false if a database problem prevented it
     */
    public function reorder(array $order, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(PortfolioUsagePeer::DATABASE_NAME);
        }

        $con->beginTransaction();
        try {
            $ids = array_keys($order);
            $objects = $this->findPks($ids, $con);
            foreach ($objects as $object) {
                $pk = $object->getPrimaryKey();
                if ($object->getSortableRank() != $order[$pk]) {
                    $object->setSortableRank($order[$pk]);
                    $object->save($con);
                }
            }
            $con->commit();

            return true;
        } catch (PropelException $e) {
            $con->rollback();
            throw $e;
        }
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     PortfolioUsageQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(PortfolioUsagePeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     PortfolioUsageQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(PortfolioUsagePeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     PortfolioUsageQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(PortfolioUsagePeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     PortfolioUsageQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(PortfolioUsagePeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     PortfolioUsageQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(PortfolioUsagePeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     PortfolioUsageQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(PortfolioUsagePeer::CREATED_AT);
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
        ;

        return parent::find($con);
    }
}
