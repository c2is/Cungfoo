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
use Cungfoo\Model\Edito;
use Cungfoo\Model\EditoView;
use Cungfoo\Model\EditoViewI18n;
use Cungfoo\Model\EditoViewPeer;
use Cungfoo\Model\EditoViewQuery;

/**
 * Base class that represents a query for the 'edito_view' table.
 *
 *
 *
 * @method EditoViewQuery orderById($order = Criteria::ASC) Order by the id column
 * @method EditoViewQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method EditoViewQuery orderBySource($order = Criteria::ASC) Order by the source column
 * @method EditoViewQuery orderByPreview($order = Criteria::ASC) Order by the preview column
 * @method EditoViewQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method EditoViewQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method EditoViewQuery orderByActive($order = Criteria::ASC) Order by the active column
 *
 * @method EditoViewQuery groupById() Group by the id column
 * @method EditoViewQuery groupByName() Group by the name column
 * @method EditoViewQuery groupBySource() Group by the source column
 * @method EditoViewQuery groupByPreview() Group by the preview column
 * @method EditoViewQuery groupByCreatedAt() Group by the created_at column
 * @method EditoViewQuery groupByUpdatedAt() Group by the updated_at column
 * @method EditoViewQuery groupByActive() Group by the active column
 *
 * @method EditoViewQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method EditoViewQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method EditoViewQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method EditoViewQuery leftJoinEdito($relationAlias = null) Adds a LEFT JOIN clause to the query using the Edito relation
 * @method EditoViewQuery rightJoinEdito($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Edito relation
 * @method EditoViewQuery innerJoinEdito($relationAlias = null) Adds a INNER JOIN clause to the query using the Edito relation
 *
 * @method EditoViewQuery leftJoinEditoViewI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the EditoViewI18n relation
 * @method EditoViewQuery rightJoinEditoViewI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EditoViewI18n relation
 * @method EditoViewQuery innerJoinEditoViewI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the EditoViewI18n relation
 *
 * @method EditoView findOne(PropelPDO $con = null) Return the first EditoView matching the query
 * @method EditoView findOneOrCreate(PropelPDO $con = null) Return the first EditoView matching the query, or a new EditoView object populated from the query conditions when no match is found
 *
 * @method EditoView findOneByName(string $name) Return the first EditoView filtered by the name column
 * @method EditoView findOneBySource(string $source) Return the first EditoView filtered by the source column
 * @method EditoView findOneByPreview(string $preview) Return the first EditoView filtered by the preview column
 * @method EditoView findOneByCreatedAt(string $created_at) Return the first EditoView filtered by the created_at column
 * @method EditoView findOneByUpdatedAt(string $updated_at) Return the first EditoView filtered by the updated_at column
 * @method EditoView findOneByActive(boolean $active) Return the first EditoView filtered by the active column
 *
 * @method array findById(int $id) Return EditoView objects filtered by the id column
 * @method array findByName(string $name) Return EditoView objects filtered by the name column
 * @method array findBySource(string $source) Return EditoView objects filtered by the source column
 * @method array findByPreview(string $preview) Return EditoView objects filtered by the preview column
 * @method array findByCreatedAt(string $created_at) Return EditoView objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return EditoView objects filtered by the updated_at column
 * @method array findByActive(boolean $active) Return EditoView objects filtered by the active column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseEditoViewQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseEditoViewQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\EditoView', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new EditoViewQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     EditoViewQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return EditoViewQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof EditoViewQuery) {
            return $criteria;
        }
        $query = new EditoViewQuery();
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
     * @return   EditoView|EditoView[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = EditoViewPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(EditoViewPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   EditoView A model object, or null if the key is not found
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
     * @return   EditoView A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `name`, `source`, `preview`, `created_at`, `updated_at`, `active` FROM `edito_view` WHERE `id` = :p0';
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
            $obj = new EditoView();
            $obj->hydrate($row);
            EditoViewPeer::addInstanceToPool($obj, (string) $key);
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
     * @return EditoView|EditoView[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|EditoView[]|mixed the list of results, formatted by the current formatter
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
     * @return EditoViewQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(EditoViewPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return EditoViewQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(EditoViewPeer::ID, $keys, Criteria::IN);
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
     * @return EditoViewQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(EditoViewPeer::ID, $id, $comparison);
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
     * @return EditoViewQuery The current query, for fluid interface
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

        return $this->addUsingAlias(EditoViewPeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query on the source column
     *
     * Example usage:
     * <code>
     * $query->filterBySource('fooValue');   // WHERE source = 'fooValue'
     * $query->filterBySource('%fooValue%'); // WHERE source LIKE '%fooValue%'
     * </code>
     *
     * @param     string $source The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EditoViewQuery The current query, for fluid interface
     */
    public function filterBySource($source = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($source)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $source)) {
                $source = str_replace('*', '%', $source);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(EditoViewPeer::SOURCE, $source, $comparison);
    }

    /**
     * Filter the query on the preview column
     *
     * Example usage:
     * <code>
     * $query->filterByPreview('fooValue');   // WHERE preview = 'fooValue'
     * $query->filterByPreview('%fooValue%'); // WHERE preview LIKE '%fooValue%'
     * </code>
     *
     * @param     string $preview The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EditoViewQuery The current query, for fluid interface
     */
    public function filterByPreview($preview = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($preview)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $preview)) {
                $preview = str_replace('*', '%', $preview);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(EditoViewPeer::PREVIEW, $preview, $comparison);
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
     * @return EditoViewQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(EditoViewPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(EditoViewPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EditoViewPeer::CREATED_AT, $createdAt, $comparison);
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
     * @return EditoViewQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(EditoViewPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(EditoViewPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EditoViewPeer::UPDATED_AT, $updatedAt, $comparison);
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
     * @return EditoViewQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(EditoViewPeer::ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query by a related Edito object
     *
     * @param   Edito|PropelObjectCollection $edito  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   EditoViewQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByEdito($edito, $comparison = null)
    {
        if ($edito instanceof Edito) {
            return $this
                ->addUsingAlias(EditoViewPeer::ID, $edito->getViewId(), $comparison);
        } elseif ($edito instanceof PropelObjectCollection) {
            return $this
                ->useEditoQuery()
                ->filterByPrimaryKeys($edito->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEdito() only accepts arguments of type Edito or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Edito relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return EditoViewQuery The current query, for fluid interface
     */
    public function joinEdito($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Edito');

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
            $this->addJoinObject($join, 'Edito');
        }

        return $this;
    }

    /**
     * Use the Edito relation Edito object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\EditoQuery A secondary query class using the current class as primary query
     */
    public function useEditoQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEdito($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Edito', '\Cungfoo\Model\EditoQuery');
    }

    /**
     * Filter the query by a related EditoViewI18n object
     *
     * @param   EditoViewI18n|PropelObjectCollection $editoViewI18n  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   EditoViewQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByEditoViewI18n($editoViewI18n, $comparison = null)
    {
        if ($editoViewI18n instanceof EditoViewI18n) {
            return $this
                ->addUsingAlias(EditoViewPeer::ID, $editoViewI18n->getId(), $comparison);
        } elseif ($editoViewI18n instanceof PropelObjectCollection) {
            return $this
                ->useEditoViewI18nQuery()
                ->filterByPrimaryKeys($editoViewI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEditoViewI18n() only accepts arguments of type EditoViewI18n or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EditoViewI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return EditoViewQuery The current query, for fluid interface
     */
    public function joinEditoViewI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EditoViewI18n');

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
            $this->addJoinObject($join, 'EditoViewI18n');
        }

        return $this;
    }

    /**
     * Use the EditoViewI18n relation EditoViewI18n object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\EditoViewI18nQuery A secondary query class using the current class as primary query
     */
    public function useEditoViewI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinEditoViewI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EditoViewI18n', '\Cungfoo\Model\EditoViewI18nQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   EditoView $editoView Object to remove from the list of results
     *
     * @return EditoViewQuery The current query, for fluid interface
     */
    public function prune($editoView = null)
    {
        if ($editoView) {
            $this->addUsingAlias(EditoViewPeer::ID, $editoView->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     EditoViewQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(EditoViewPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     EditoViewQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(EditoViewPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     EditoViewQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(EditoViewPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     EditoViewQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(EditoViewPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     EditoViewQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(EditoViewPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     EditoViewQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(EditoViewPeer::CREATED_AT);
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
    // crudable behavior

    public function filterByTerm($term)
    {
        $term = '%' . $term . '%';

        return $this
            ->_or()
            ->filterByName($term, \Criteria::LIKE)
        ;
    }
    // i18n behavior

    /**
     * Adds a JOIN clause to the query using the i18n relation
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    EditoViewQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'EditoViewI18n';

        return $this
            ->joinEditoViewI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    EditoViewQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'fr', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('EditoViewI18n');
        $this->with['EditoViewI18n']->setIsWithOneToMany(false);

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
     * @return    EditoViewI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EditoViewI18n', 'Cungfoo\Model\EditoViewI18nQuery');
    }

}
