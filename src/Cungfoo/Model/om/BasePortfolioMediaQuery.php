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
use Cungfoo\Model\PortfolioMediaI18n;
use Cungfoo\Model\PortfolioMediaPeer;
use Cungfoo\Model\PortfolioMediaQuery;
use Cungfoo\Model\PortfolioMediaTag;
use Cungfoo\Model\PortfolioTag;
use Cungfoo\Model\PortfolioUsage;

/**
 * Base class that represents a query for the 'portfolio_media' table.
 *
 *
 *
 * @method PortfolioMediaQuery orderById($order = Criteria::ASC) Order by the id column
 * @method PortfolioMediaQuery orderByFile($order = Criteria::ASC) Order by the file column
 * @method PortfolioMediaQuery orderByWidth($order = Criteria::ASC) Order by the width column
 * @method PortfolioMediaQuery orderByHeight($order = Criteria::ASC) Order by the height column
 * @method PortfolioMediaQuery orderBySize($order = Criteria::ASC) Order by the size column
 * @method PortfolioMediaQuery orderByType($order = Criteria::ASC) Order by the type column
 * @method PortfolioMediaQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method PortfolioMediaQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method PortfolioMediaQuery orderByActive($order = Criteria::ASC) Order by the active column
 *
 * @method PortfolioMediaQuery groupById() Group by the id column
 * @method PortfolioMediaQuery groupByFile() Group by the file column
 * @method PortfolioMediaQuery groupByWidth() Group by the width column
 * @method PortfolioMediaQuery groupByHeight() Group by the height column
 * @method PortfolioMediaQuery groupBySize() Group by the size column
 * @method PortfolioMediaQuery groupByType() Group by the type column
 * @method PortfolioMediaQuery groupByCreatedAt() Group by the created_at column
 * @method PortfolioMediaQuery groupByUpdatedAt() Group by the updated_at column
 * @method PortfolioMediaQuery groupByActive() Group by the active column
 *
 * @method PortfolioMediaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method PortfolioMediaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method PortfolioMediaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method PortfolioMediaQuery leftJoinPortfolioMediaTag($relationAlias = null) Adds a LEFT JOIN clause to the query using the PortfolioMediaTag relation
 * @method PortfolioMediaQuery rightJoinPortfolioMediaTag($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PortfolioMediaTag relation
 * @method PortfolioMediaQuery innerJoinPortfolioMediaTag($relationAlias = null) Adds a INNER JOIN clause to the query using the PortfolioMediaTag relation
 *
 * @method PortfolioMediaQuery leftJoinPortfolioUsage($relationAlias = null) Adds a LEFT JOIN clause to the query using the PortfolioUsage relation
 * @method PortfolioMediaQuery rightJoinPortfolioUsage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PortfolioUsage relation
 * @method PortfolioMediaQuery innerJoinPortfolioUsage($relationAlias = null) Adds a INNER JOIN clause to the query using the PortfolioUsage relation
 *
 * @method PortfolioMediaQuery leftJoinPortfolioMediaI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the PortfolioMediaI18n relation
 * @method PortfolioMediaQuery rightJoinPortfolioMediaI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PortfolioMediaI18n relation
 * @method PortfolioMediaQuery innerJoinPortfolioMediaI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the PortfolioMediaI18n relation
 *
 * @method PortfolioMedia findOne(PropelPDO $con = null) Return the first PortfolioMedia matching the query
 * @method PortfolioMedia findOneOrCreate(PropelPDO $con = null) Return the first PortfolioMedia matching the query, or a new PortfolioMedia object populated from the query conditions when no match is found
 *
 * @method PortfolioMedia findOneByFile(string $file) Return the first PortfolioMedia filtered by the file column
 * @method PortfolioMedia findOneByWidth(string $width) Return the first PortfolioMedia filtered by the width column
 * @method PortfolioMedia findOneByHeight(string $height) Return the first PortfolioMedia filtered by the height column
 * @method PortfolioMedia findOneBySize(string $size) Return the first PortfolioMedia filtered by the size column
 * @method PortfolioMedia findOneByType(string $type) Return the first PortfolioMedia filtered by the type column
 * @method PortfolioMedia findOneByCreatedAt(string $created_at) Return the first PortfolioMedia filtered by the created_at column
 * @method PortfolioMedia findOneByUpdatedAt(string $updated_at) Return the first PortfolioMedia filtered by the updated_at column
 * @method PortfolioMedia findOneByActive(boolean $active) Return the first PortfolioMedia filtered by the active column
 *
 * @method array findById(int $id) Return PortfolioMedia objects filtered by the id column
 * @method array findByFile(string $file) Return PortfolioMedia objects filtered by the file column
 * @method array findByWidth(string $width) Return PortfolioMedia objects filtered by the width column
 * @method array findByHeight(string $height) Return PortfolioMedia objects filtered by the height column
 * @method array findBySize(string $size) Return PortfolioMedia objects filtered by the size column
 * @method array findByType(string $type) Return PortfolioMedia objects filtered by the type column
 * @method array findByCreatedAt(string $created_at) Return PortfolioMedia objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return PortfolioMedia objects filtered by the updated_at column
 * @method array findByActive(boolean $active) Return PortfolioMedia objects filtered by the active column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BasePortfolioMediaQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BasePortfolioMediaQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\PortfolioMedia', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new PortfolioMediaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     PortfolioMediaQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return PortfolioMediaQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof PortfolioMediaQuery) {
            return $criteria;
        }
        $query = new PortfolioMediaQuery();
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
     * @return   PortfolioMedia|PortfolioMedia[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PortfolioMediaPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(PortfolioMediaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   PortfolioMedia A model object, or null if the key is not found
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
     * @return   PortfolioMedia A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `file`, `width`, `height`, `size`, `type`, `created_at`, `updated_at`, `active` FROM `portfolio_media` WHERE `id` = :p0';
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
            $obj = new PortfolioMedia();
            $obj->hydrate($row);
            PortfolioMediaPeer::addInstanceToPool($obj, (string) $key);
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
     * @return PortfolioMedia|PortfolioMedia[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|PortfolioMedia[]|mixed the list of results, formatted by the current formatter
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
     * @return PortfolioMediaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PortfolioMediaPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return PortfolioMediaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PortfolioMediaPeer::ID, $keys, Criteria::IN);
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
     * @return PortfolioMediaQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(PortfolioMediaPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the file column
     *
     * Example usage:
     * <code>
     * $query->filterByFile('fooValue');   // WHERE file = 'fooValue'
     * $query->filterByFile('%fooValue%'); // WHERE file LIKE '%fooValue%'
     * </code>
     *
     * @param     string $file The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PortfolioMediaQuery The current query, for fluid interface
     */
    public function filterByFile($file = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($file)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $file)) {
                $file = str_replace('*', '%', $file);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PortfolioMediaPeer::FILE, $file, $comparison);
    }

    /**
     * Filter the query on the width column
     *
     * Example usage:
     * <code>
     * $query->filterByWidth('fooValue');   // WHERE width = 'fooValue'
     * $query->filterByWidth('%fooValue%'); // WHERE width LIKE '%fooValue%'
     * </code>
     *
     * @param     string $width The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PortfolioMediaQuery The current query, for fluid interface
     */
    public function filterByWidth($width = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($width)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $width)) {
                $width = str_replace('*', '%', $width);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PortfolioMediaPeer::WIDTH, $width, $comparison);
    }

    /**
     * Filter the query on the height column
     *
     * Example usage:
     * <code>
     * $query->filterByHeight('fooValue');   // WHERE height = 'fooValue'
     * $query->filterByHeight('%fooValue%'); // WHERE height LIKE '%fooValue%'
     * </code>
     *
     * @param     string $height The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PortfolioMediaQuery The current query, for fluid interface
     */
    public function filterByHeight($height = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($height)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $height)) {
                $height = str_replace('*', '%', $height);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PortfolioMediaPeer::HEIGHT, $height, $comparison);
    }

    /**
     * Filter the query on the size column
     *
     * Example usage:
     * <code>
     * $query->filterBySize('fooValue');   // WHERE size = 'fooValue'
     * $query->filterBySize('%fooValue%'); // WHERE size LIKE '%fooValue%'
     * </code>
     *
     * @param     string $size The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PortfolioMediaQuery The current query, for fluid interface
     */
    public function filterBySize($size = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($size)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $size)) {
                $size = str_replace('*', '%', $size);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PortfolioMediaPeer::SIZE, $size, $comparison);
    }

    /**
     * Filter the query on the type column
     *
     * Example usage:
     * <code>
     * $query->filterByType('fooValue');   // WHERE type = 'fooValue'
     * $query->filterByType('%fooValue%'); // WHERE type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $type The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PortfolioMediaQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($type)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $type)) {
                $type = str_replace('*', '%', $type);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PortfolioMediaPeer::TYPE, $type, $comparison);
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
     * @return PortfolioMediaQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(PortfolioMediaPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(PortfolioMediaPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PortfolioMediaPeer::CREATED_AT, $createdAt, $comparison);
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
     * @return PortfolioMediaQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(PortfolioMediaPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(PortfolioMediaPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PortfolioMediaPeer::UPDATED_AT, $updatedAt, $comparison);
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
     * @return PortfolioMediaQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(PortfolioMediaPeer::ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query by a related PortfolioMediaTag object
     *
     * @param   PortfolioMediaTag|PropelObjectCollection $portfolioMediaTag  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PortfolioMediaQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByPortfolioMediaTag($portfolioMediaTag, $comparison = null)
    {
        if ($portfolioMediaTag instanceof PortfolioMediaTag) {
            return $this
                ->addUsingAlias(PortfolioMediaPeer::ID, $portfolioMediaTag->getMediaId(), $comparison);
        } elseif ($portfolioMediaTag instanceof PropelObjectCollection) {
            return $this
                ->usePortfolioMediaTagQuery()
                ->filterByPrimaryKeys($portfolioMediaTag->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPortfolioMediaTag() only accepts arguments of type PortfolioMediaTag or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PortfolioMediaTag relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PortfolioMediaQuery The current query, for fluid interface
     */
    public function joinPortfolioMediaTag($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PortfolioMediaTag');

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
            $this->addJoinObject($join, 'PortfolioMediaTag');
        }

        return $this;
    }

    /**
     * Use the PortfolioMediaTag relation PortfolioMediaTag object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\PortfolioMediaTagQuery A secondary query class using the current class as primary query
     */
    public function usePortfolioMediaTagQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPortfolioMediaTag($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PortfolioMediaTag', '\Cungfoo\Model\PortfolioMediaTagQuery');
    }

    /**
     * Filter the query by a related PortfolioUsage object
     *
     * @param   PortfolioUsage|PropelObjectCollection $portfolioUsage  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PortfolioMediaQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByPortfolioUsage($portfolioUsage, $comparison = null)
    {
        if ($portfolioUsage instanceof PortfolioUsage) {
            return $this
                ->addUsingAlias(PortfolioMediaPeer::ID, $portfolioUsage->getMediaId(), $comparison);
        } elseif ($portfolioUsage instanceof PropelObjectCollection) {
            return $this
                ->usePortfolioUsageQuery()
                ->filterByPrimaryKeys($portfolioUsage->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPortfolioUsage() only accepts arguments of type PortfolioUsage or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PortfolioUsage relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PortfolioMediaQuery The current query, for fluid interface
     */
    public function joinPortfolioUsage($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PortfolioUsage');

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
            $this->addJoinObject($join, 'PortfolioUsage');
        }

        return $this;
    }

    /**
     * Use the PortfolioUsage relation PortfolioUsage object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\PortfolioUsageQuery A secondary query class using the current class as primary query
     */
    public function usePortfolioUsageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPortfolioUsage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PortfolioUsage', '\Cungfoo\Model\PortfolioUsageQuery');
    }

    /**
     * Filter the query by a related PortfolioMediaI18n object
     *
     * @param   PortfolioMediaI18n|PropelObjectCollection $portfolioMediaI18n  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PortfolioMediaQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByPortfolioMediaI18n($portfolioMediaI18n, $comparison = null)
    {
        if ($portfolioMediaI18n instanceof PortfolioMediaI18n) {
            return $this
                ->addUsingAlias(PortfolioMediaPeer::ID, $portfolioMediaI18n->getId(), $comparison);
        } elseif ($portfolioMediaI18n instanceof PropelObjectCollection) {
            return $this
                ->usePortfolioMediaI18nQuery()
                ->filterByPrimaryKeys($portfolioMediaI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPortfolioMediaI18n() only accepts arguments of type PortfolioMediaI18n or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PortfolioMediaI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PortfolioMediaQuery The current query, for fluid interface
     */
    public function joinPortfolioMediaI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PortfolioMediaI18n');

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
            $this->addJoinObject($join, 'PortfolioMediaI18n');
        }

        return $this;
    }

    /**
     * Use the PortfolioMediaI18n relation PortfolioMediaI18n object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\PortfolioMediaI18nQuery A secondary query class using the current class as primary query
     */
    public function usePortfolioMediaI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinPortfolioMediaI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PortfolioMediaI18n', '\Cungfoo\Model\PortfolioMediaI18nQuery');
    }

    /**
     * Filter the query by a related PortfolioTag object
     * using the portfolio_media_tag table as cross reference
     *
     * @param   PortfolioTag $portfolioTag the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PortfolioMediaQuery The current query, for fluid interface
     */
    public function filterByPortfolioTag($portfolioTag, $comparison = Criteria::EQUAL)
    {
        return $this
            ->usePortfolioMediaTagQuery()
            ->filterByPortfolioTag($portfolioTag, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   PortfolioMedia $portfolioMedia Object to remove from the list of results
     *
     * @return PortfolioMediaQuery The current query, for fluid interface
     */
    public function prune($portfolioMedia = null)
    {
        if ($portfolioMedia) {
            $this->addUsingAlias(PortfolioMediaPeer::ID, $portfolioMedia->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     PortfolioMediaQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(PortfolioMediaPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     PortfolioMediaQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(PortfolioMediaPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     PortfolioMediaQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(PortfolioMediaPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     PortfolioMediaQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(PortfolioMediaPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     PortfolioMediaQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(PortfolioMediaPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     PortfolioMediaQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(PortfolioMediaPeer::CREATED_AT);
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
     * @return    PortfolioMediaQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'PortfolioMediaI18n';

        return $this
            ->joinPortfolioMediaI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    PortfolioMediaQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'fr', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('PortfolioMediaI18n');
        $this->with['PortfolioMediaI18n']->setIsWithOneToMany(false);

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
     * @return    PortfolioMediaI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PortfolioMediaI18n', 'Cungfoo\Model\PortfolioMediaI18nQuery');
    }

}
