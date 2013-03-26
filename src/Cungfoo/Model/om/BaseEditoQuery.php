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
use Cungfoo\Model\EditoComponent;
use Cungfoo\Model\EditoI18n;
use Cungfoo\Model\EditoPeer;
use Cungfoo\Model\EditoQuery;
use Cungfoo\Model\EditoView;

/**
 * Base class that represents a query for the 'edito' table.
 *
 *
 *
 * @method EditoQuery orderById($order = Criteria::ASC) Order by the id column
 * @method EditoQuery orderByViewId($order = Criteria::ASC) Order by the view_id column
 * @method EditoQuery orderByComponentId($order = Criteria::ASC) Order by the component_id column
 * @method EditoQuery orderBySlug($order = Criteria::ASC) Order by the slug column
 * @method EditoQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method EditoQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method EditoQuery orderByActive($order = Criteria::ASC) Order by the active column
 *
 * @method EditoQuery groupById() Group by the id column
 * @method EditoQuery groupByViewId() Group by the view_id column
 * @method EditoQuery groupByComponentId() Group by the component_id column
 * @method EditoQuery groupBySlug() Group by the slug column
 * @method EditoQuery groupByCreatedAt() Group by the created_at column
 * @method EditoQuery groupByUpdatedAt() Group by the updated_at column
 * @method EditoQuery groupByActive() Group by the active column
 *
 * @method EditoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method EditoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method EditoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method EditoQuery leftJoinEditoView($relationAlias = null) Adds a LEFT JOIN clause to the query using the EditoView relation
 * @method EditoQuery rightJoinEditoView($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EditoView relation
 * @method EditoQuery innerJoinEditoView($relationAlias = null) Adds a INNER JOIN clause to the query using the EditoView relation
 *
 * @method EditoQuery leftJoinEditoComponent($relationAlias = null) Adds a LEFT JOIN clause to the query using the EditoComponent relation
 * @method EditoQuery rightJoinEditoComponent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EditoComponent relation
 * @method EditoQuery innerJoinEditoComponent($relationAlias = null) Adds a INNER JOIN clause to the query using the EditoComponent relation
 *
 * @method EditoQuery leftJoinEditoI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the EditoI18n relation
 * @method EditoQuery rightJoinEditoI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EditoI18n relation
 * @method EditoQuery innerJoinEditoI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the EditoI18n relation
 *
 * @method Edito findOne(PropelPDO $con = null) Return the first Edito matching the query
 * @method Edito findOneOrCreate(PropelPDO $con = null) Return the first Edito matching the query, or a new Edito object populated from the query conditions when no match is found
 *
 * @method Edito findOneByViewId(int $view_id) Return the first Edito filtered by the view_id column
 * @method Edito findOneByComponentId(int $component_id) Return the first Edito filtered by the component_id column
 * @method Edito findOneBySlug(string $slug) Return the first Edito filtered by the slug column
 * @method Edito findOneByCreatedAt(string $created_at) Return the first Edito filtered by the created_at column
 * @method Edito findOneByUpdatedAt(string $updated_at) Return the first Edito filtered by the updated_at column
 * @method Edito findOneByActive(boolean $active) Return the first Edito filtered by the active column
 *
 * @method array findById(int $id) Return Edito objects filtered by the id column
 * @method array findByViewId(int $view_id) Return Edito objects filtered by the view_id column
 * @method array findByComponentId(int $component_id) Return Edito objects filtered by the component_id column
 * @method array findBySlug(string $slug) Return Edito objects filtered by the slug column
 * @method array findByCreatedAt(string $created_at) Return Edito objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return Edito objects filtered by the updated_at column
 * @method array findByActive(boolean $active) Return Edito objects filtered by the active column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseEditoQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseEditoQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\Edito', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new EditoQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     EditoQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return EditoQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof EditoQuery) {
            return $criteria;
        }
        $query = new EditoQuery();
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
     * @return   Edito|Edito[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = EditoPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(EditoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Edito A model object, or null if the key is not found
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
     * @return   Edito A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `view_id`, `component_id`, `slug`, `created_at`, `updated_at`, `active` FROM `edito` WHERE `id` = :p0';
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
            $obj = new Edito();
            $obj->hydrate($row);
            EditoPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Edito|Edito[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Edito[]|mixed the list of results, formatted by the current formatter
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
     * @return EditoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(EditoPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return EditoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(EditoPeer::ID, $keys, Criteria::IN);
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
     * @return EditoQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(EditoPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the view_id column
     *
     * Example usage:
     * <code>
     * $query->filterByViewId(1234); // WHERE view_id = 1234
     * $query->filterByViewId(array(12, 34)); // WHERE view_id IN (12, 34)
     * $query->filterByViewId(array('min' => 12)); // WHERE view_id > 12
     * </code>
     *
     * @see       filterByEditoView()
     *
     * @param     mixed $viewId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EditoQuery The current query, for fluid interface
     */
    public function filterByViewId($viewId = null, $comparison = null)
    {
        if (is_array($viewId)) {
            $useMinMax = false;
            if (isset($viewId['min'])) {
                $this->addUsingAlias(EditoPeer::VIEW_ID, $viewId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($viewId['max'])) {
                $this->addUsingAlias(EditoPeer::VIEW_ID, $viewId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EditoPeer::VIEW_ID, $viewId, $comparison);
    }

    /**
     * Filter the query on the component_id column
     *
     * Example usage:
     * <code>
     * $query->filterByComponentId(1234); // WHERE component_id = 1234
     * $query->filterByComponentId(array(12, 34)); // WHERE component_id IN (12, 34)
     * $query->filterByComponentId(array('min' => 12)); // WHERE component_id > 12
     * </code>
     *
     * @see       filterByEditoComponent()
     *
     * @param     mixed $componentId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EditoQuery The current query, for fluid interface
     */
    public function filterByComponentId($componentId = null, $comparison = null)
    {
        if (is_array($componentId)) {
            $useMinMax = false;
            if (isset($componentId['min'])) {
                $this->addUsingAlias(EditoPeer::COMPONENT_ID, $componentId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($componentId['max'])) {
                $this->addUsingAlias(EditoPeer::COMPONENT_ID, $componentId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EditoPeer::COMPONENT_ID, $componentId, $comparison);
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
     * @return EditoQuery The current query, for fluid interface
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

        return $this->addUsingAlias(EditoPeer::SLUG, $slug, $comparison);
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
     * @return EditoQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(EditoPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(EditoPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EditoPeer::CREATED_AT, $createdAt, $comparison);
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
     * @return EditoQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(EditoPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(EditoPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EditoPeer::UPDATED_AT, $updatedAt, $comparison);
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
     * @return EditoQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(EditoPeer::ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query by a related EditoView object
     *
     * @param   EditoView|PropelObjectCollection $editoView The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   EditoQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByEditoView($editoView, $comparison = null)
    {
        if ($editoView instanceof EditoView) {
            return $this
                ->addUsingAlias(EditoPeer::VIEW_ID, $editoView->getId(), $comparison);
        } elseif ($editoView instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EditoPeer::VIEW_ID, $editoView->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByEditoView() only accepts arguments of type EditoView or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EditoView relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return EditoQuery The current query, for fluid interface
     */
    public function joinEditoView($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EditoView');

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
            $this->addJoinObject($join, 'EditoView');
        }

        return $this;
    }

    /**
     * Use the EditoView relation EditoView object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\EditoViewQuery A secondary query class using the current class as primary query
     */
    public function useEditoViewQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEditoView($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EditoView', '\Cungfoo\Model\EditoViewQuery');
    }

    /**
     * Filter the query by a related EditoComponent object
     *
     * @param   EditoComponent|PropelObjectCollection $editoComponent The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   EditoQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByEditoComponent($editoComponent, $comparison = null)
    {
        if ($editoComponent instanceof EditoComponent) {
            return $this
                ->addUsingAlias(EditoPeer::COMPONENT_ID, $editoComponent->getId(), $comparison);
        } elseif ($editoComponent instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EditoPeer::COMPONENT_ID, $editoComponent->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByEditoComponent() only accepts arguments of type EditoComponent or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EditoComponent relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return EditoQuery The current query, for fluid interface
     */
    public function joinEditoComponent($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EditoComponent');

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
            $this->addJoinObject($join, 'EditoComponent');
        }

        return $this;
    }

    /**
     * Use the EditoComponent relation EditoComponent object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\EditoComponentQuery A secondary query class using the current class as primary query
     */
    public function useEditoComponentQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinEditoComponent($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EditoComponent', '\Cungfoo\Model\EditoComponentQuery');
    }

    /**
     * Filter the query by a related EditoI18n object
     *
     * @param   EditoI18n|PropelObjectCollection $editoI18n  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   EditoQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByEditoI18n($editoI18n, $comparison = null)
    {
        if ($editoI18n instanceof EditoI18n) {
            return $this
                ->addUsingAlias(EditoPeer::ID, $editoI18n->getId(), $comparison);
        } elseif ($editoI18n instanceof PropelObjectCollection) {
            return $this
                ->useEditoI18nQuery()
                ->filterByPrimaryKeys($editoI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEditoI18n() only accepts arguments of type EditoI18n or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EditoI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return EditoQuery The current query, for fluid interface
     */
    public function joinEditoI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EditoI18n');

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
            $this->addJoinObject($join, 'EditoI18n');
        }

        return $this;
    }

    /**
     * Use the EditoI18n relation EditoI18n object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\EditoI18nQuery A secondary query class using the current class as primary query
     */
    public function useEditoI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinEditoI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EditoI18n', '\Cungfoo\Model\EditoI18nQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Edito $edito Object to remove from the list of results
     *
     * @return EditoQuery The current query, for fluid interface
     */
    public function prune($edito = null)
    {
        if ($edito) {
            $this->addUsingAlias(EditoPeer::ID, $edito->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     EditoQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(EditoPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     EditoQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(EditoPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     EditoQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(EditoPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     EditoQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(EditoPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     EditoQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(EditoPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     EditoQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(EditoPeer::CREATED_AT);
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
     * @return    EditoQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'EditoI18n';

        return $this
            ->joinEditoI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    EditoQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'fr', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('EditoI18n');
        $this->with['EditoI18n']->setIsWithOneToMany(false);

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
     * @return    EditoI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EditoI18n', 'Cungfoo\Model\EditoI18nQuery');
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
