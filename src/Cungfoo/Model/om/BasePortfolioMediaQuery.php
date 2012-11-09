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
use Cungfoo\Model\PortfolioMediaPeer;
use Cungfoo\Model\PortfolioMediaQuery;
use Cungfoo\Model\PortfolioMediaTag;
use Cungfoo\Model\PortfolioTag;

/**
 * Base class that represents a query for the 'portfolio_media' table.
 *
 *
 *
 * @method PortfolioMediaQuery orderById($order = Criteria::ASC) Order by the id column
 * @method PortfolioMediaQuery orderByNameOrigin($order = Criteria::ASC) Order by the name_origin column
 * @method PortfolioMediaQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method PortfolioMediaQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method PortfolioMediaQuery orderByPathOrigin($order = Criteria::ASC) Order by the path_origin column
 * @method PortfolioMediaQuery orderByPathMiniature($order = Criteria::ASC) Order by the path_miniature column
 * @method PortfolioMediaQuery orderBySize($order = Criteria::ASC) Order by the size column
 * @method PortfolioMediaQuery orderByType($order = Criteria::ASC) Order by the type column
 * @method PortfolioMediaQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method PortfolioMediaQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method PortfolioMediaQuery groupById() Group by the id column
 * @method PortfolioMediaQuery groupByNameOrigin() Group by the name_origin column
 * @method PortfolioMediaQuery groupByName() Group by the name column
 * @method PortfolioMediaQuery groupByDescription() Group by the description column
 * @method PortfolioMediaQuery groupByPathOrigin() Group by the path_origin column
 * @method PortfolioMediaQuery groupByPathMiniature() Group by the path_miniature column
 * @method PortfolioMediaQuery groupBySize() Group by the size column
 * @method PortfolioMediaQuery groupByType() Group by the type column
 * @method PortfolioMediaQuery groupByCreatedAt() Group by the created_at column
 * @method PortfolioMediaQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method PortfolioMediaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method PortfolioMediaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method PortfolioMediaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method PortfolioMediaQuery leftJoinPortfolioMediaTag($relationAlias = null) Adds a LEFT JOIN clause to the query using the PortfolioMediaTag relation
 * @method PortfolioMediaQuery rightJoinPortfolioMediaTag($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PortfolioMediaTag relation
 * @method PortfolioMediaQuery innerJoinPortfolioMediaTag($relationAlias = null) Adds a INNER JOIN clause to the query using the PortfolioMediaTag relation
 *
 * @method PortfolioMedia findOne(PropelPDO $con = null) Return the first PortfolioMedia matching the query
 * @method PortfolioMedia findOneOrCreate(PropelPDO $con = null) Return the first PortfolioMedia matching the query, or a new PortfolioMedia object populated from the query conditions when no match is found
 *
 * @method PortfolioMedia findOneByNameOrigin(string $name_origin) Return the first PortfolioMedia filtered by the name_origin column
 * @method PortfolioMedia findOneByName(string $name) Return the first PortfolioMedia filtered by the name column
 * @method PortfolioMedia findOneByDescription(string $description) Return the first PortfolioMedia filtered by the description column
 * @method PortfolioMedia findOneByPathOrigin(string $path_origin) Return the first PortfolioMedia filtered by the path_origin column
 * @method PortfolioMedia findOneByPathMiniature(string $path_miniature) Return the first PortfolioMedia filtered by the path_miniature column
 * @method PortfolioMedia findOneBySize(string $size) Return the first PortfolioMedia filtered by the size column
 * @method PortfolioMedia findOneByType(string $type) Return the first PortfolioMedia filtered by the type column
 * @method PortfolioMedia findOneByCreatedAt(string $created_at) Return the first PortfolioMedia filtered by the created_at column
 * @method PortfolioMedia findOneByUpdatedAt(string $updated_at) Return the first PortfolioMedia filtered by the updated_at column
 *
 * @method array findById(int $id) Return PortfolioMedia objects filtered by the id column
 * @method array findByNameOrigin(string $name_origin) Return PortfolioMedia objects filtered by the name_origin column
 * @method array findByName(string $name) Return PortfolioMedia objects filtered by the name column
 * @method array findByDescription(string $description) Return PortfolioMedia objects filtered by the description column
 * @method array findByPathOrigin(string $path_origin) Return PortfolioMedia objects filtered by the path_origin column
 * @method array findByPathMiniature(string $path_miniature) Return PortfolioMedia objects filtered by the path_miniature column
 * @method array findBySize(string $size) Return PortfolioMedia objects filtered by the size column
 * @method array findByType(string $type) Return PortfolioMedia objects filtered by the type column
 * @method array findByCreatedAt(string $created_at) Return PortfolioMedia objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return PortfolioMedia objects filtered by the updated_at column
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
        $sql = 'SELECT `ID`, `NAME_ORIGIN`, `NAME`, `DESCRIPTION`, `PATH_ORIGIN`, `PATH_MINIATURE`, `SIZE`, `TYPE`, `CREATED_AT`, `UPDATED_AT` FROM `portfolio_media` WHERE `ID` = :p0';
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
     * Filter the query on the name_origin column
     *
     * Example usage:
     * <code>
     * $query->filterByNameOrigin('fooValue');   // WHERE name_origin = 'fooValue'
     * $query->filterByNameOrigin('%fooValue%'); // WHERE name_origin LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nameOrigin The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PortfolioMediaQuery The current query, for fluid interface
     */
    public function filterByNameOrigin($nameOrigin = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nameOrigin)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nameOrigin)) {
                $nameOrigin = str_replace('*', '%', $nameOrigin);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PortfolioMediaPeer::NAME_ORIGIN, $nameOrigin, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PortfolioMediaQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PortfolioMediaPeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%'); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PortfolioMediaQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $description)) {
                $description = str_replace('*', '%', $description);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PortfolioMediaPeer::DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the path_origin column
     *
     * Example usage:
     * <code>
     * $query->filterByPathOrigin('fooValue');   // WHERE path_origin = 'fooValue'
     * $query->filterByPathOrigin('%fooValue%'); // WHERE path_origin LIKE '%fooValue%'
     * </code>
     *
     * @param     string $pathOrigin The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PortfolioMediaQuery The current query, for fluid interface
     */
    public function filterByPathOrigin($pathOrigin = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pathOrigin)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $pathOrigin)) {
                $pathOrigin = str_replace('*', '%', $pathOrigin);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PortfolioMediaPeer::PATH_ORIGIN, $pathOrigin, $comparison);
    }

    /**
     * Filter the query on the path_miniature column
     *
     * Example usage:
     * <code>
     * $query->filterByPathMiniature('fooValue');   // WHERE path_miniature = 'fooValue'
     * $query->filterByPathMiniature('%fooValue%'); // WHERE path_miniature LIKE '%fooValue%'
     * </code>
     *
     * @param     string $pathMiniature The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PortfolioMediaQuery The current query, for fluid interface
     */
    public function filterByPathMiniature($pathMiniature = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pathMiniature)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $pathMiniature)) {
                $pathMiniature = str_replace('*', '%', $pathMiniature);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PortfolioMediaPeer::PATH_MINIATURE, $pathMiniature, $comparison);
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
}
