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
use Cungfoo\Model\Activite;
use Cungfoo\Model\Theme;
use Cungfoo\Model\ThemeActivite;
use Cungfoo\Model\ThemeActivitePeer;
use Cungfoo\Model\ThemeActiviteQuery;

/**
 * Base class that represents a query for the 'theme_activite' table.
 *
 *
 *
 * @method ThemeActiviteQuery orderByThemeId($order = Criteria::ASC) Order by the theme_id column
 * @method ThemeActiviteQuery orderByActiviteId($order = Criteria::ASC) Order by the activite_id column
 *
 * @method ThemeActiviteQuery groupByThemeId() Group by the theme_id column
 * @method ThemeActiviteQuery groupByActiviteId() Group by the activite_id column
 *
 * @method ThemeActiviteQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method ThemeActiviteQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method ThemeActiviteQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method ThemeActiviteQuery leftJoinTheme($relationAlias = null) Adds a LEFT JOIN clause to the query using the Theme relation
 * @method ThemeActiviteQuery rightJoinTheme($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Theme relation
 * @method ThemeActiviteQuery innerJoinTheme($relationAlias = null) Adds a INNER JOIN clause to the query using the Theme relation
 *
 * @method ThemeActiviteQuery leftJoinActivite($relationAlias = null) Adds a LEFT JOIN clause to the query using the Activite relation
 * @method ThemeActiviteQuery rightJoinActivite($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Activite relation
 * @method ThemeActiviteQuery innerJoinActivite($relationAlias = null) Adds a INNER JOIN clause to the query using the Activite relation
 *
 * @method ThemeActivite findOne(PropelPDO $con = null) Return the first ThemeActivite matching the query
 * @method ThemeActivite findOneOrCreate(PropelPDO $con = null) Return the first ThemeActivite matching the query, or a new ThemeActivite object populated from the query conditions when no match is found
 *
 * @method ThemeActivite findOneByThemeId(int $theme_id) Return the first ThemeActivite filtered by the theme_id column
 * @method ThemeActivite findOneByActiviteId(int $activite_id) Return the first ThemeActivite filtered by the activite_id column
 *
 * @method array findByThemeId(int $theme_id) Return ThemeActivite objects filtered by the theme_id column
 * @method array findByActiviteId(int $activite_id) Return ThemeActivite objects filtered by the activite_id column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseThemeActiviteQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseThemeActiviteQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\ThemeActivite', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ThemeActiviteQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     ThemeActiviteQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return ThemeActiviteQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof ThemeActiviteQuery) {
            return $criteria;
        }
        $query = new ThemeActiviteQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array $key Primary key to use for the query
                         A Primary key composition: [$theme_id, $activite_id]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   ThemeActivite|ThemeActivite[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ThemeActivitePeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(ThemeActivitePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return   ThemeActivite A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `theme_id`, `activite_id` FROM `theme_activite` WHERE `theme_id` = :p0 AND `activite_id` = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new ThemeActivite();
            $obj->hydrate($row);
            ThemeActivitePeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return ThemeActivite|ThemeActivite[]|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|ThemeActivite[]|mixed the list of results, formatted by the current formatter
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
     * @return ThemeActiviteQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(ThemeActivitePeer::THEME_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(ThemeActivitePeer::ACTIVITE_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ThemeActiviteQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(ThemeActivitePeer::THEME_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(ThemeActivitePeer::ACTIVITE_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the theme_id column
     *
     * Example usage:
     * <code>
     * $query->filterByThemeId(1234); // WHERE theme_id = 1234
     * $query->filterByThemeId(array(12, 34)); // WHERE theme_id IN (12, 34)
     * $query->filterByThemeId(array('min' => 12)); // WHERE theme_id > 12
     * </code>
     *
     * @see       filterByTheme()
     *
     * @param     mixed $themeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ThemeActiviteQuery The current query, for fluid interface
     */
    public function filterByThemeId($themeId = null, $comparison = null)
    {
        if (is_array($themeId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(ThemeActivitePeer::THEME_ID, $themeId, $comparison);
    }

    /**
     * Filter the query on the activite_id column
     *
     * Example usage:
     * <code>
     * $query->filterByActiviteId(1234); // WHERE activite_id = 1234
     * $query->filterByActiviteId(array(12, 34)); // WHERE activite_id IN (12, 34)
     * $query->filterByActiviteId(array('min' => 12)); // WHERE activite_id > 12
     * </code>
     *
     * @see       filterByActivite()
     *
     * @param     mixed $activiteId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ThemeActiviteQuery The current query, for fluid interface
     */
    public function filterByActiviteId($activiteId = null, $comparison = null)
    {
        if (is_array($activiteId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(ThemeActivitePeer::ACTIVITE_ID, $activiteId, $comparison);
    }

    /**
     * Filter the query by a related Theme object
     *
     * @param   Theme|PropelObjectCollection $theme The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ThemeActiviteQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTheme($theme, $comparison = null)
    {
        if ($theme instanceof Theme) {
            return $this
                ->addUsingAlias(ThemeActivitePeer::THEME_ID, $theme->getId(), $comparison);
        } elseif ($theme instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ThemeActivitePeer::THEME_ID, $theme->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByTheme() only accepts arguments of type Theme or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Theme relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ThemeActiviteQuery The current query, for fluid interface
     */
    public function joinTheme($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Theme');

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
            $this->addJoinObject($join, 'Theme');
        }

        return $this;
    }

    /**
     * Use the Theme relation Theme object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\ThemeQuery A secondary query class using the current class as primary query
     */
    public function useThemeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTheme($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Theme', '\Cungfoo\Model\ThemeQuery');
    }

    /**
     * Filter the query by a related Activite object
     *
     * @param   Activite|PropelObjectCollection $activite The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ThemeActiviteQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByActivite($activite, $comparison = null)
    {
        if ($activite instanceof Activite) {
            return $this
                ->addUsingAlias(ThemeActivitePeer::ACTIVITE_ID, $activite->getId(), $comparison);
        } elseif ($activite instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ThemeActivitePeer::ACTIVITE_ID, $activite->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByActivite() only accepts arguments of type Activite or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Activite relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ThemeActiviteQuery The current query, for fluid interface
     */
    public function joinActivite($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Activite');

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
            $this->addJoinObject($join, 'Activite');
        }

        return $this;
    }

    /**
     * Use the Activite relation Activite object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\ActiviteQuery A secondary query class using the current class as primary query
     */
    public function useActiviteQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinActivite($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Activite', '\Cungfoo\Model\ActiviteQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ThemeActivite $themeActivite Object to remove from the list of results
     *
     * @return ThemeActiviteQuery The current query, for fluid interface
     */
    public function prune($themeActivite = null)
    {
        if ($themeActivite) {
            $this->addCond('pruneCond0', $this->getAliasedColName(ThemeActivitePeer::THEME_ID), $themeActivite->getThemeId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(ThemeActivitePeer::ACTIVITE_ID), $themeActivite->getActiviteId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
