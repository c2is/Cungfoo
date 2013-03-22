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
use Cungfoo\Model\PortfolioMediaTag;
use Cungfoo\Model\PortfolioTag;
use Cungfoo\Model\PortfolioTagCategory;
use Cungfoo\Model\PortfolioTagI18n;
use Cungfoo\Model\PortfolioTagPeer;
use Cungfoo\Model\PortfolioTagQuery;

/**
 * Base class that represents a query for the 'portfolio_tag' table.
 *
 *
 *
 * @method PortfolioTagQuery orderById($order = Criteria::ASC) Order by the id column
 * @method PortfolioTagQuery orderByCategoryId($order = Criteria::ASC) Order by the category_id column
 * @method PortfolioTagQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method PortfolioTagQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method PortfolioTagQuery orderByActive($order = Criteria::ASC) Order by the active column
 *
 * @method PortfolioTagQuery groupById() Group by the id column
 * @method PortfolioTagQuery groupByCategoryId() Group by the category_id column
 * @method PortfolioTagQuery groupByCreatedAt() Group by the created_at column
 * @method PortfolioTagQuery groupByUpdatedAt() Group by the updated_at column
 * @method PortfolioTagQuery groupByActive() Group by the active column
 *
 * @method PortfolioTagQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method PortfolioTagQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method PortfolioTagQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method PortfolioTagQuery leftJoinPortfolioTagCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the PortfolioTagCategory relation
 * @method PortfolioTagQuery rightJoinPortfolioTagCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PortfolioTagCategory relation
 * @method PortfolioTagQuery innerJoinPortfolioTagCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the PortfolioTagCategory relation
 *
 * @method PortfolioTagQuery leftJoinPortfolioMediaTag($relationAlias = null) Adds a LEFT JOIN clause to the query using the PortfolioMediaTag relation
 * @method PortfolioTagQuery rightJoinPortfolioMediaTag($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PortfolioMediaTag relation
 * @method PortfolioTagQuery innerJoinPortfolioMediaTag($relationAlias = null) Adds a INNER JOIN clause to the query using the PortfolioMediaTag relation
 *
 * @method PortfolioTagQuery leftJoinPortfolioTagI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the PortfolioTagI18n relation
 * @method PortfolioTagQuery rightJoinPortfolioTagI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PortfolioTagI18n relation
 * @method PortfolioTagQuery innerJoinPortfolioTagI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the PortfolioTagI18n relation
 *
 * @method PortfolioTag findOne(PropelPDO $con = null) Return the first PortfolioTag matching the query
 * @method PortfolioTag findOneOrCreate(PropelPDO $con = null) Return the first PortfolioTag matching the query, or a new PortfolioTag object populated from the query conditions when no match is found
 *
 * @method PortfolioTag findOneByCategoryId(int $category_id) Return the first PortfolioTag filtered by the category_id column
 * @method PortfolioTag findOneByCreatedAt(string $created_at) Return the first PortfolioTag filtered by the created_at column
 * @method PortfolioTag findOneByUpdatedAt(string $updated_at) Return the first PortfolioTag filtered by the updated_at column
 * @method PortfolioTag findOneByActive(boolean $active) Return the first PortfolioTag filtered by the active column
 *
 * @method array findById(int $id) Return PortfolioTag objects filtered by the id column
 * @method array findByCategoryId(int $category_id) Return PortfolioTag objects filtered by the category_id column
 * @method array findByCreatedAt(string $created_at) Return PortfolioTag objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return PortfolioTag objects filtered by the updated_at column
 * @method array findByActive(boolean $active) Return PortfolioTag objects filtered by the active column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BasePortfolioTagQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BasePortfolioTagQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\PortfolioTag', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new PortfolioTagQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     PortfolioTagQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return PortfolioTagQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof PortfolioTagQuery) {
            return $criteria;
        }
        $query = new PortfolioTagQuery();
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
     * @return   PortfolioTag|PortfolioTag[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PortfolioTagPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(PortfolioTagPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   PortfolioTag A model object, or null if the key is not found
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
     * @return   PortfolioTag A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `category_id`, `created_at`, `updated_at`, `active` FROM `portfolio_tag` WHERE `id` = :p0';
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
            $obj = new PortfolioTag();
            $obj->hydrate($row);
            PortfolioTagPeer::addInstanceToPool($obj, (string) $key);
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
     * @return PortfolioTag|PortfolioTag[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|PortfolioTag[]|mixed the list of results, formatted by the current formatter
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
     * @return PortfolioTagQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PortfolioTagPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return PortfolioTagQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PortfolioTagPeer::ID, $keys, Criteria::IN);
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
     * @return PortfolioTagQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(PortfolioTagPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the category_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCategoryId(1234); // WHERE category_id = 1234
     * $query->filterByCategoryId(array(12, 34)); // WHERE category_id IN (12, 34)
     * $query->filterByCategoryId(array('min' => 12)); // WHERE category_id > 12
     * </code>
     *
     * @see       filterByPortfolioTagCategory()
     *
     * @param     mixed $categoryId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PortfolioTagQuery The current query, for fluid interface
     */
    public function filterByCategoryId($categoryId = null, $comparison = null)
    {
        if (is_array($categoryId)) {
            $useMinMax = false;
            if (isset($categoryId['min'])) {
                $this->addUsingAlias(PortfolioTagPeer::CATEGORY_ID, $categoryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($categoryId['max'])) {
                $this->addUsingAlias(PortfolioTagPeer::CATEGORY_ID, $categoryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PortfolioTagPeer::CATEGORY_ID, $categoryId, $comparison);
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
     * @return PortfolioTagQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(PortfolioTagPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(PortfolioTagPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PortfolioTagPeer::CREATED_AT, $createdAt, $comparison);
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
     * @return PortfolioTagQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(PortfolioTagPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(PortfolioTagPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PortfolioTagPeer::UPDATED_AT, $updatedAt, $comparison);
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
     * @return PortfolioTagQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(PortfolioTagPeer::ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query by a related PortfolioTagCategory object
     *
     * @param   PortfolioTagCategory|PropelObjectCollection $portfolioTagCategory The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PortfolioTagQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByPortfolioTagCategory($portfolioTagCategory, $comparison = null)
    {
        if ($portfolioTagCategory instanceof PortfolioTagCategory) {
            return $this
                ->addUsingAlias(PortfolioTagPeer::CATEGORY_ID, $portfolioTagCategory->getId(), $comparison);
        } elseif ($portfolioTagCategory instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PortfolioTagPeer::CATEGORY_ID, $portfolioTagCategory->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPortfolioTagCategory() only accepts arguments of type PortfolioTagCategory or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PortfolioTagCategory relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PortfolioTagQuery The current query, for fluid interface
     */
    public function joinPortfolioTagCategory($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PortfolioTagCategory');

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
            $this->addJoinObject($join, 'PortfolioTagCategory');
        }

        return $this;
    }

    /**
     * Use the PortfolioTagCategory relation PortfolioTagCategory object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\PortfolioTagCategoryQuery A secondary query class using the current class as primary query
     */
    public function usePortfolioTagCategoryQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPortfolioTagCategory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PortfolioTagCategory', '\Cungfoo\Model\PortfolioTagCategoryQuery');
    }

    /**
     * Filter the query by a related PortfolioMediaTag object
     *
     * @param   PortfolioMediaTag|PropelObjectCollection $portfolioMediaTag  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PortfolioTagQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByPortfolioMediaTag($portfolioMediaTag, $comparison = null)
    {
        if ($portfolioMediaTag instanceof PortfolioMediaTag) {
            return $this
                ->addUsingAlias(PortfolioTagPeer::ID, $portfolioMediaTag->getTagId(), $comparison);
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
     * @return PortfolioTagQuery The current query, for fluid interface
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
     * Filter the query by a related PortfolioTagI18n object
     *
     * @param   PortfolioTagI18n|PropelObjectCollection $portfolioTagI18n  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PortfolioTagQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByPortfolioTagI18n($portfolioTagI18n, $comparison = null)
    {
        if ($portfolioTagI18n instanceof PortfolioTagI18n) {
            return $this
                ->addUsingAlias(PortfolioTagPeer::ID, $portfolioTagI18n->getId(), $comparison);
        } elseif ($portfolioTagI18n instanceof PropelObjectCollection) {
            return $this
                ->usePortfolioTagI18nQuery()
                ->filterByPrimaryKeys($portfolioTagI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPortfolioTagI18n() only accepts arguments of type PortfolioTagI18n or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PortfolioTagI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PortfolioTagQuery The current query, for fluid interface
     */
    public function joinPortfolioTagI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PortfolioTagI18n');

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
            $this->addJoinObject($join, 'PortfolioTagI18n');
        }

        return $this;
    }

    /**
     * Use the PortfolioTagI18n relation PortfolioTagI18n object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\PortfolioTagI18nQuery A secondary query class using the current class as primary query
     */
    public function usePortfolioTagI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinPortfolioTagI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PortfolioTagI18n', '\Cungfoo\Model\PortfolioTagI18nQuery');
    }

    /**
     * Filter the query by a related PortfolioMedia object
     * using the portfolio_media_tag table as cross reference
     *
     * @param   PortfolioMedia $portfolioMedia the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PortfolioTagQuery The current query, for fluid interface
     */
    public function filterByPortfolioMedia($portfolioMedia, $comparison = Criteria::EQUAL)
    {
        return $this
            ->usePortfolioMediaTagQuery()
            ->filterByPortfolioMedia($portfolioMedia, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   PortfolioTag $portfolioTag Object to remove from the list of results
     *
     * @return PortfolioTagQuery The current query, for fluid interface
     */
    public function prune($portfolioTag = null)
    {
        if ($portfolioTag) {
            $this->addUsingAlias(PortfolioTagPeer::ID, $portfolioTag->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     PortfolioTagQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(PortfolioTagPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     PortfolioTagQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(PortfolioTagPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     PortfolioTagQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(PortfolioTagPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     PortfolioTagQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(PortfolioTagPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     PortfolioTagQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(PortfolioTagPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     PortfolioTagQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(PortfolioTagPeer::CREATED_AT);
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
     * @return    PortfolioTagQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'PortfolioTagI18n';

        return $this
            ->joinPortfolioTagI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    PortfolioTagQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'fr', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('PortfolioTagI18n');
        $this->with['PortfolioTagI18n']->setIsWithOneToMany(false);

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
     * @return    PortfolioTagI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PortfolioTagI18n', 'Cungfoo\Model\PortfolioTagI18nQuery');
    }

}
