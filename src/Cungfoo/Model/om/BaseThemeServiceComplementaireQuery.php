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
use Cungfoo\Model\ServiceComplementaire;
use Cungfoo\Model\Theme;
use Cungfoo\Model\ThemeServiceComplementaire;
use Cungfoo\Model\ThemeServiceComplementairePeer;
use Cungfoo\Model\ThemeServiceComplementaireQuery;

/**
 * Base class that represents a query for the 'theme_service_complementaire' table.
 *
 *
 *
 * @method ThemeServiceComplementaireQuery orderByThemeId($order = Criteria::ASC) Order by the theme_id column
 * @method ThemeServiceComplementaireQuery orderByServiceComplementaireId($order = Criteria::ASC) Order by the service_complementaire_id column
 *
 * @method ThemeServiceComplementaireQuery groupByThemeId() Group by the theme_id column
 * @method ThemeServiceComplementaireQuery groupByServiceComplementaireId() Group by the service_complementaire_id column
 *
 * @method ThemeServiceComplementaireQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method ThemeServiceComplementaireQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method ThemeServiceComplementaireQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method ThemeServiceComplementaireQuery leftJoinTheme($relationAlias = null) Adds a LEFT JOIN clause to the query using the Theme relation
 * @method ThemeServiceComplementaireQuery rightJoinTheme($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Theme relation
 * @method ThemeServiceComplementaireQuery innerJoinTheme($relationAlias = null) Adds a INNER JOIN clause to the query using the Theme relation
 *
 * @method ThemeServiceComplementaireQuery leftJoinServiceComplementaire($relationAlias = null) Adds a LEFT JOIN clause to the query using the ServiceComplementaire relation
 * @method ThemeServiceComplementaireQuery rightJoinServiceComplementaire($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ServiceComplementaire relation
 * @method ThemeServiceComplementaireQuery innerJoinServiceComplementaire($relationAlias = null) Adds a INNER JOIN clause to the query using the ServiceComplementaire relation
 *
 * @method ThemeServiceComplementaire findOne(PropelPDO $con = null) Return the first ThemeServiceComplementaire matching the query
 * @method ThemeServiceComplementaire findOneOrCreate(PropelPDO $con = null) Return the first ThemeServiceComplementaire matching the query, or a new ThemeServiceComplementaire object populated from the query conditions when no match is found
 *
 * @method ThemeServiceComplementaire findOneByThemeId(int $theme_id) Return the first ThemeServiceComplementaire filtered by the theme_id column
 * @method ThemeServiceComplementaire findOneByServiceComplementaireId(int $service_complementaire_id) Return the first ThemeServiceComplementaire filtered by the service_complementaire_id column
 *
 * @method array findByThemeId(int $theme_id) Return ThemeServiceComplementaire objects filtered by the theme_id column
 * @method array findByServiceComplementaireId(int $service_complementaire_id) Return ThemeServiceComplementaire objects filtered by the service_complementaire_id column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseThemeServiceComplementaireQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseThemeServiceComplementaireQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\ThemeServiceComplementaire', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ThemeServiceComplementaireQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     ThemeServiceComplementaireQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return ThemeServiceComplementaireQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof ThemeServiceComplementaireQuery) {
            return $criteria;
        }
        $query = new ThemeServiceComplementaireQuery();
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
                         A Primary key composition: [$theme_id, $service_complementaire_id]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   ThemeServiceComplementaire|ThemeServiceComplementaire[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ThemeServiceComplementairePeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(ThemeServiceComplementairePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   ThemeServiceComplementaire A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `theme_id`, `service_complementaire_id` FROM `theme_service_complementaire` WHERE `theme_id` = :p0 AND `service_complementaire_id` = :p1';
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
            $obj = new ThemeServiceComplementaire();
            $obj->hydrate($row);
            ThemeServiceComplementairePeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return ThemeServiceComplementaire|ThemeServiceComplementaire[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|ThemeServiceComplementaire[]|mixed the list of results, formatted by the current formatter
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
     * @return ThemeServiceComplementaireQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(ThemeServiceComplementairePeer::THEME_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(ThemeServiceComplementairePeer::SERVICE_COMPLEMENTAIRE_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ThemeServiceComplementaireQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(ThemeServiceComplementairePeer::THEME_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(ThemeServiceComplementairePeer::SERVICE_COMPLEMENTAIRE_ID, $key[1], Criteria::EQUAL);
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
     * @return ThemeServiceComplementaireQuery The current query, for fluid interface
     */
    public function filterByThemeId($themeId = null, $comparison = null)
    {
        if (is_array($themeId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(ThemeServiceComplementairePeer::THEME_ID, $themeId, $comparison);
    }

    /**
     * Filter the query on the service_complementaire_id column
     *
     * Example usage:
     * <code>
     * $query->filterByServiceComplementaireId(1234); // WHERE service_complementaire_id = 1234
     * $query->filterByServiceComplementaireId(array(12, 34)); // WHERE service_complementaire_id IN (12, 34)
     * $query->filterByServiceComplementaireId(array('min' => 12)); // WHERE service_complementaire_id > 12
     * </code>
     *
     * @see       filterByServiceComplementaire()
     *
     * @param     mixed $serviceComplementaireId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ThemeServiceComplementaireQuery The current query, for fluid interface
     */
    public function filterByServiceComplementaireId($serviceComplementaireId = null, $comparison = null)
    {
        if (is_array($serviceComplementaireId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(ThemeServiceComplementairePeer::SERVICE_COMPLEMENTAIRE_ID, $serviceComplementaireId, $comparison);
    }

    /**
     * Filter the query by a related Theme object
     *
     * @param   Theme|PropelObjectCollection $theme The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ThemeServiceComplementaireQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTheme($theme, $comparison = null)
    {
        if ($theme instanceof Theme) {
            return $this
                ->addUsingAlias(ThemeServiceComplementairePeer::THEME_ID, $theme->getId(), $comparison);
        } elseif ($theme instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ThemeServiceComplementairePeer::THEME_ID, $theme->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return ThemeServiceComplementaireQuery The current query, for fluid interface
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
     * Filter the query by a related ServiceComplementaire object
     *
     * @param   ServiceComplementaire|PropelObjectCollection $serviceComplementaire The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ThemeServiceComplementaireQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByServiceComplementaire($serviceComplementaire, $comparison = null)
    {
        if ($serviceComplementaire instanceof ServiceComplementaire) {
            return $this
                ->addUsingAlias(ThemeServiceComplementairePeer::SERVICE_COMPLEMENTAIRE_ID, $serviceComplementaire->getId(), $comparison);
        } elseif ($serviceComplementaire instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ThemeServiceComplementairePeer::SERVICE_COMPLEMENTAIRE_ID, $serviceComplementaire->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByServiceComplementaire() only accepts arguments of type ServiceComplementaire or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ServiceComplementaire relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ThemeServiceComplementaireQuery The current query, for fluid interface
     */
    public function joinServiceComplementaire($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ServiceComplementaire');

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
            $this->addJoinObject($join, 'ServiceComplementaire');
        }

        return $this;
    }

    /**
     * Use the ServiceComplementaire relation ServiceComplementaire object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\ServiceComplementaireQuery A secondary query class using the current class as primary query
     */
    public function useServiceComplementaireQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinServiceComplementaire($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ServiceComplementaire', '\Cungfoo\Model\ServiceComplementaireQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ThemeServiceComplementaire $themeServiceComplementaire Object to remove from the list of results
     *
     * @return ThemeServiceComplementaireQuery The current query, for fluid interface
     */
    public function prune($themeServiceComplementaire = null)
    {
        if ($themeServiceComplementaire) {
            $this->addCond('pruneCond0', $this->getAliasedColName(ThemeServiceComplementairePeer::THEME_ID), $themeServiceComplementaire->getThemeId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(ThemeServiceComplementairePeer::SERVICE_COMPLEMENTAIRE_ID), $themeServiceComplementaire->getServiceComplementaireId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
