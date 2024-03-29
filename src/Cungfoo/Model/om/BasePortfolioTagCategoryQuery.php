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
use Cungfoo\Model\PortfolioTag;
use Cungfoo\Model\PortfolioTagCategory;
use Cungfoo\Model\PortfolioTagCategoryI18n;
use Cungfoo\Model\PortfolioTagCategoryPeer;
use Cungfoo\Model\PortfolioTagCategoryQuery;

/**
 * Base class that represents a query for the 'portfolio_tag_category' table.
 *
 *
 *
 * @method PortfolioTagCategoryQuery orderById($order = Criteria::ASC) Order by the id column
 * @method PortfolioTagCategoryQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method PortfolioTagCategoryQuery orderBySlug($order = Criteria::ASC) Order by the slug column
 * @method PortfolioTagCategoryQuery orderByActive($order = Criteria::ASC) Order by the active column
 *
 * @method PortfolioTagCategoryQuery groupById() Group by the id column
 * @method PortfolioTagCategoryQuery groupByName() Group by the name column
 * @method PortfolioTagCategoryQuery groupBySlug() Group by the slug column
 * @method PortfolioTagCategoryQuery groupByActive() Group by the active column
 *
 * @method PortfolioTagCategoryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method PortfolioTagCategoryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method PortfolioTagCategoryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method PortfolioTagCategoryQuery leftJoinPortfolioTag($relationAlias = null) Adds a LEFT JOIN clause to the query using the PortfolioTag relation
 * @method PortfolioTagCategoryQuery rightJoinPortfolioTag($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PortfolioTag relation
 * @method PortfolioTagCategoryQuery innerJoinPortfolioTag($relationAlias = null) Adds a INNER JOIN clause to the query using the PortfolioTag relation
 *
 * @method PortfolioTagCategoryQuery leftJoinPortfolioTagCategoryI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the PortfolioTagCategoryI18n relation
 * @method PortfolioTagCategoryQuery rightJoinPortfolioTagCategoryI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PortfolioTagCategoryI18n relation
 * @method PortfolioTagCategoryQuery innerJoinPortfolioTagCategoryI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the PortfolioTagCategoryI18n relation
 *
 * @method PortfolioTagCategory findOne(PropelPDO $con = null) Return the first PortfolioTagCategory matching the query
 * @method PortfolioTagCategory findOneOrCreate(PropelPDO $con = null) Return the first PortfolioTagCategory matching the query, or a new PortfolioTagCategory object populated from the query conditions when no match is found
 *
 * @method PortfolioTagCategory findOneByName(string $name) Return the first PortfolioTagCategory filtered by the name column
 * @method PortfolioTagCategory findOneBySlug(string $slug) Return the first PortfolioTagCategory filtered by the slug column
 * @method PortfolioTagCategory findOneByActive(boolean $active) Return the first PortfolioTagCategory filtered by the active column
 *
 * @method array findById(int $id) Return PortfolioTagCategory objects filtered by the id column
 * @method array findByName(string $name) Return PortfolioTagCategory objects filtered by the name column
 * @method array findBySlug(string $slug) Return PortfolioTagCategory objects filtered by the slug column
 * @method array findByActive(boolean $active) Return PortfolioTagCategory objects filtered by the active column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BasePortfolioTagCategoryQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BasePortfolioTagCategoryQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\PortfolioTagCategory', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new PortfolioTagCategoryQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     PortfolioTagCategoryQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return PortfolioTagCategoryQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof PortfolioTagCategoryQuery) {
            return $criteria;
        }
        $query = new PortfolioTagCategoryQuery();
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
     * @return   PortfolioTagCategory|PortfolioTagCategory[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PortfolioTagCategoryPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(PortfolioTagCategoryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   PortfolioTagCategory A model object, or null if the key is not found
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
     * @return   PortfolioTagCategory A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `name`, `slug`, `active` FROM `portfolio_tag_category` WHERE `id` = :p0';
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
            $obj = new PortfolioTagCategory();
            $obj->hydrate($row);
            PortfolioTagCategoryPeer::addInstanceToPool($obj, (string) $key);
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
     * @return PortfolioTagCategory|PortfolioTagCategory[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|PortfolioTagCategory[]|mixed the list of results, formatted by the current formatter
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
     * @return PortfolioTagCategoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PortfolioTagCategoryPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return PortfolioTagCategoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PortfolioTagCategoryPeer::ID, $keys, Criteria::IN);
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
     * @return PortfolioTagCategoryQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(PortfolioTagCategoryPeer::ID, $id, $comparison);
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
     * @return PortfolioTagCategoryQuery The current query, for fluid interface
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

        return $this->addUsingAlias(PortfolioTagCategoryPeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query on the slug column
     *
     * Example usage:
     * <code>
     * $query->filterBySlug('fooValue');   // WHERE slug = 'fooValue'
     * $query->filterBySlug('%fooValue%'); // WHERE slug LIKE '%fooValue%'
     * </code>
     *
     * @param     string $slug The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PortfolioTagCategoryQuery The current query, for fluid interface
     */
    public function filterBySlug($slug = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($slug)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $slug)) {
                $slug = str_replace('*', '%', $slug);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PortfolioTagCategoryPeer::SLUG, $slug, $comparison);
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
     * @return PortfolioTagCategoryQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(PortfolioTagCategoryPeer::ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query by a related PortfolioTag object
     *
     * @param   PortfolioTag|PropelObjectCollection $portfolioTag  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PortfolioTagCategoryQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByPortfolioTag($portfolioTag, $comparison = null)
    {
        if ($portfolioTag instanceof PortfolioTag) {
            return $this
                ->addUsingAlias(PortfolioTagCategoryPeer::ID, $portfolioTag->getCategoryId(), $comparison);
        } elseif ($portfolioTag instanceof PropelObjectCollection) {
            return $this
                ->usePortfolioTagQuery()
                ->filterByPrimaryKeys($portfolioTag->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPortfolioTag() only accepts arguments of type PortfolioTag or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PortfolioTag relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PortfolioTagCategoryQuery The current query, for fluid interface
     */
    public function joinPortfolioTag($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PortfolioTag');

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
            $this->addJoinObject($join, 'PortfolioTag');
        }

        return $this;
    }

    /**
     * Use the PortfolioTag relation PortfolioTag object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\PortfolioTagQuery A secondary query class using the current class as primary query
     */
    public function usePortfolioTagQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPortfolioTag($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PortfolioTag', '\Cungfoo\Model\PortfolioTagQuery');
    }

    /**
     * Filter the query by a related PortfolioTagCategoryI18n object
     *
     * @param   PortfolioTagCategoryI18n|PropelObjectCollection $portfolioTagCategoryI18n  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PortfolioTagCategoryQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByPortfolioTagCategoryI18n($portfolioTagCategoryI18n, $comparison = null)
    {
        if ($portfolioTagCategoryI18n instanceof PortfolioTagCategoryI18n) {
            return $this
                ->addUsingAlias(PortfolioTagCategoryPeer::ID, $portfolioTagCategoryI18n->getId(), $comparison);
        } elseif ($portfolioTagCategoryI18n instanceof PropelObjectCollection) {
            return $this
                ->usePortfolioTagCategoryI18nQuery()
                ->filterByPrimaryKeys($portfolioTagCategoryI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPortfolioTagCategoryI18n() only accepts arguments of type PortfolioTagCategoryI18n or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PortfolioTagCategoryI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PortfolioTagCategoryQuery The current query, for fluid interface
     */
    public function joinPortfolioTagCategoryI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PortfolioTagCategoryI18n');

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
            $this->addJoinObject($join, 'PortfolioTagCategoryI18n');
        }

        return $this;
    }

    /**
     * Use the PortfolioTagCategoryI18n relation PortfolioTagCategoryI18n object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\PortfolioTagCategoryI18nQuery A secondary query class using the current class as primary query
     */
    public function usePortfolioTagCategoryI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinPortfolioTagCategoryI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PortfolioTagCategoryI18n', '\Cungfoo\Model\PortfolioTagCategoryI18nQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   PortfolioTagCategory $portfolioTagCategory Object to remove from the list of results
     *
     * @return PortfolioTagCategoryQuery The current query, for fluid interface
     */
    public function prune($portfolioTagCategory = null)
    {
        if ($portfolioTagCategory) {
            $this->addUsingAlias(PortfolioTagCategoryPeer::ID, $portfolioTagCategory->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
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
     * @return    PortfolioTagCategoryQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'PortfolioTagCategoryI18n';

        return $this
            ->joinPortfolioTagCategoryI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    PortfolioTagCategoryQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'fr', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('PortfolioTagCategoryI18n');
        $this->with['PortfolioTagCategoryI18n']->setIsWithOneToMany(false);

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
     * @return    PortfolioTagCategoryI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PortfolioTagCategoryI18n', 'Cungfoo\Model\PortfolioTagCategoryI18nQuery');
    }

}
