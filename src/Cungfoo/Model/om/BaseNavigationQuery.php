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
use Cungfoo\Model\Navigation;
use Cungfoo\Model\NavigationI18n;
use Cungfoo\Model\NavigationItem;
use Cungfoo\Model\NavigationPeer;
use Cungfoo\Model\NavigationQuery;

/**
 * Base class that represents a query for the 'navigation' table.
 *
 *
 *
 * @method NavigationQuery orderById($order = Criteria::ASC) Order by the id column
 * @method NavigationQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method NavigationQuery orderByActive($order = Criteria::ASC) Order by the active column
 *
 * @method NavigationQuery groupById() Group by the id column
 * @method NavigationQuery groupByName() Group by the name column
 * @method NavigationQuery groupByActive() Group by the active column
 *
 * @method NavigationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method NavigationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method NavigationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method NavigationQuery leftJoinNavigationItem($relationAlias = null) Adds a LEFT JOIN clause to the query using the NavigationItem relation
 * @method NavigationQuery rightJoinNavigationItem($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NavigationItem relation
 * @method NavigationQuery innerJoinNavigationItem($relationAlias = null) Adds a INNER JOIN clause to the query using the NavigationItem relation
 *
 * @method NavigationQuery leftJoinNavigationI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the NavigationI18n relation
 * @method NavigationQuery rightJoinNavigationI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NavigationI18n relation
 * @method NavigationQuery innerJoinNavigationI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the NavigationI18n relation
 *
 * @method Navigation findOne(PropelPDO $con = null) Return the first Navigation matching the query
 * @method Navigation findOneOrCreate(PropelPDO $con = null) Return the first Navigation matching the query, or a new Navigation object populated from the query conditions when no match is found
 *
 * @method Navigation findOneByName(string $name) Return the first Navigation filtered by the name column
 * @method Navigation findOneByActive(boolean $active) Return the first Navigation filtered by the active column
 *
 * @method array findById(int $id) Return Navigation objects filtered by the id column
 * @method array findByName(string $name) Return Navigation objects filtered by the name column
 * @method array findByActive(boolean $active) Return Navigation objects filtered by the active column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseNavigationQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseNavigationQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\Navigation', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new NavigationQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     NavigationQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return NavigationQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof NavigationQuery) {
            return $criteria;
        }
        $query = new NavigationQuery();
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
     * @return   Navigation|Navigation[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = NavigationPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(NavigationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Navigation A model object, or null if the key is not found
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
     * @return   Navigation A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `name`, `active` FROM `navigation` WHERE `id` = :p0';
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
            $obj = new Navigation();
            $obj->hydrate($row);
            NavigationPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Navigation|Navigation[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Navigation[]|mixed the list of results, formatted by the current formatter
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
     * @return NavigationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(NavigationPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return NavigationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(NavigationPeer::ID, $keys, Criteria::IN);
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
     * @return NavigationQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(NavigationPeer::ID, $id, $comparison);
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
     * @return NavigationQuery The current query, for fluid interface
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

        return $this->addUsingAlias(NavigationPeer::NAME, $name, $comparison);
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
     * @return NavigationQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(NavigationPeer::ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query by a related NavigationItem object
     *
     * @param   NavigationItem|PropelObjectCollection $navigationItem  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   NavigationQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByNavigationItem($navigationItem, $comparison = null)
    {
        if ($navigationItem instanceof NavigationItem) {
            return $this
                ->addUsingAlias(NavigationPeer::ID, $navigationItem->getNavigationId(), $comparison);
        } elseif ($navigationItem instanceof PropelObjectCollection) {
            return $this
                ->useNavigationItemQuery()
                ->filterByPrimaryKeys($navigationItem->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByNavigationItem() only accepts arguments of type NavigationItem or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the NavigationItem relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return NavigationQuery The current query, for fluid interface
     */
    public function joinNavigationItem($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('NavigationItem');

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
            $this->addJoinObject($join, 'NavigationItem');
        }

        return $this;
    }

    /**
     * Use the NavigationItem relation NavigationItem object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\NavigationItemQuery A secondary query class using the current class as primary query
     */
    public function useNavigationItemQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinNavigationItem($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'NavigationItem', '\Cungfoo\Model\NavigationItemQuery');
    }

    /**
     * Filter the query by a related NavigationI18n object
     *
     * @param   NavigationI18n|PropelObjectCollection $navigationI18n  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   NavigationQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByNavigationI18n($navigationI18n, $comparison = null)
    {
        if ($navigationI18n instanceof NavigationI18n) {
            return $this
                ->addUsingAlias(NavigationPeer::ID, $navigationI18n->getId(), $comparison);
        } elseif ($navigationI18n instanceof PropelObjectCollection) {
            return $this
                ->useNavigationI18nQuery()
                ->filterByPrimaryKeys($navigationI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByNavigationI18n() only accepts arguments of type NavigationI18n or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the NavigationI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return NavigationQuery The current query, for fluid interface
     */
    public function joinNavigationI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('NavigationI18n');

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
            $this->addJoinObject($join, 'NavigationI18n');
        }

        return $this;
    }

    /**
     * Use the NavigationI18n relation NavigationI18n object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\NavigationI18nQuery A secondary query class using the current class as primary query
     */
    public function useNavigationI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinNavigationI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'NavigationI18n', '\Cungfoo\Model\NavigationI18nQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Navigation $navigation Object to remove from the list of results
     *
     * @return NavigationQuery The current query, for fluid interface
     */
    public function prune($navigation = null)
    {
        if ($navigation) {
            $this->addUsingAlias(NavigationPeer::ID, $navigation->getId(), Criteria::NOT_EQUAL);
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
     * @return    NavigationQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'NavigationI18n';

        return $this
            ->joinNavigationI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    NavigationQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'fr', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('NavigationI18n');
        $this->with['NavigationI18n']->setIsWithOneToMany(false);

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
     * @return    NavigationI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'NavigationI18n', 'Cungfoo\Model\NavigationI18nQuery');
    }

}
