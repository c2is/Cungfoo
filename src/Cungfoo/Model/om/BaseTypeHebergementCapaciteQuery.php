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
use Cungfoo\Model\TypeHebergement;
use Cungfoo\Model\TypeHebergementCapacite;
use Cungfoo\Model\TypeHebergementCapaciteI18n;
use Cungfoo\Model\TypeHebergementCapacitePeer;
use Cungfoo\Model\TypeHebergementCapaciteQuery;

/**
 * Base class that represents a query for the 'type_hebergement_capacite' table.
 *
 *
 *
 * @method TypeHebergementCapaciteQuery orderById($order = Criteria::ASC) Order by the id column
 * @method TypeHebergementCapaciteQuery orderByImageMenu($order = Criteria::ASC) Order by the image_menu column
 * @method TypeHebergementCapaciteQuery orderByImagePage($order = Criteria::ASC) Order by the image_page column
 * @method TypeHebergementCapaciteQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method TypeHebergementCapaciteQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method TypeHebergementCapaciteQuery orderByActive($order = Criteria::ASC) Order by the active column
 * @method TypeHebergementCapaciteQuery orderBySortableRank($order = Criteria::ASC) Order by the sortable_rank column
 *
 * @method TypeHebergementCapaciteQuery groupById() Group by the id column
 * @method TypeHebergementCapaciteQuery groupByImageMenu() Group by the image_menu column
 * @method TypeHebergementCapaciteQuery groupByImagePage() Group by the image_page column
 * @method TypeHebergementCapaciteQuery groupByCreatedAt() Group by the created_at column
 * @method TypeHebergementCapaciteQuery groupByUpdatedAt() Group by the updated_at column
 * @method TypeHebergementCapaciteQuery groupByActive() Group by the active column
 * @method TypeHebergementCapaciteQuery groupBySortableRank() Group by the sortable_rank column
 *
 * @method TypeHebergementCapaciteQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method TypeHebergementCapaciteQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method TypeHebergementCapaciteQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method TypeHebergementCapaciteQuery leftJoinTypeHebergement($relationAlias = null) Adds a LEFT JOIN clause to the query using the TypeHebergement relation
 * @method TypeHebergementCapaciteQuery rightJoinTypeHebergement($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TypeHebergement relation
 * @method TypeHebergementCapaciteQuery innerJoinTypeHebergement($relationAlias = null) Adds a INNER JOIN clause to the query using the TypeHebergement relation
 *
 * @method TypeHebergementCapaciteQuery leftJoinTypeHebergementCapaciteI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the TypeHebergementCapaciteI18n relation
 * @method TypeHebergementCapaciteQuery rightJoinTypeHebergementCapaciteI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TypeHebergementCapaciteI18n relation
 * @method TypeHebergementCapaciteQuery innerJoinTypeHebergementCapaciteI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the TypeHebergementCapaciteI18n relation
 *
 * @method TypeHebergementCapacite findOne(PropelPDO $con = null) Return the first TypeHebergementCapacite matching the query
 * @method TypeHebergementCapacite findOneOrCreate(PropelPDO $con = null) Return the first TypeHebergementCapacite matching the query, or a new TypeHebergementCapacite object populated from the query conditions when no match is found
 *
 * @method TypeHebergementCapacite findOneByImageMenu(string $image_menu) Return the first TypeHebergementCapacite filtered by the image_menu column
 * @method TypeHebergementCapacite findOneByImagePage(string $image_page) Return the first TypeHebergementCapacite filtered by the image_page column
 * @method TypeHebergementCapacite findOneByCreatedAt(string $created_at) Return the first TypeHebergementCapacite filtered by the created_at column
 * @method TypeHebergementCapacite findOneByUpdatedAt(string $updated_at) Return the first TypeHebergementCapacite filtered by the updated_at column
 * @method TypeHebergementCapacite findOneByActive(boolean $active) Return the first TypeHebergementCapacite filtered by the active column
 * @method TypeHebergementCapacite findOneBySortableRank(int $sortable_rank) Return the first TypeHebergementCapacite filtered by the sortable_rank column
 *
 * @method array findById(int $id) Return TypeHebergementCapacite objects filtered by the id column
 * @method array findByImageMenu(string $image_menu) Return TypeHebergementCapacite objects filtered by the image_menu column
 * @method array findByImagePage(string $image_page) Return TypeHebergementCapacite objects filtered by the image_page column
 * @method array findByCreatedAt(string $created_at) Return TypeHebergementCapacite objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return TypeHebergementCapacite objects filtered by the updated_at column
 * @method array findByActive(boolean $active) Return TypeHebergementCapacite objects filtered by the active column
 * @method array findBySortableRank(int $sortable_rank) Return TypeHebergementCapacite objects filtered by the sortable_rank column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseTypeHebergementCapaciteQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseTypeHebergementCapaciteQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\TypeHebergementCapacite', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new TypeHebergementCapaciteQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     TypeHebergementCapaciteQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return TypeHebergementCapaciteQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof TypeHebergementCapaciteQuery) {
            return $criteria;
        }
        $query = new TypeHebergementCapaciteQuery();
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
     * @return   TypeHebergementCapacite|TypeHebergementCapacite[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TypeHebergementCapacitePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(TypeHebergementCapacitePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   TypeHebergementCapacite A model object, or null if the key is not found
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
     * @return   TypeHebergementCapacite A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `image_menu`, `image_page`, `created_at`, `updated_at`, `active`, `sortable_rank` FROM `type_hebergement_capacite` WHERE `id` = :p0';
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
            $obj = new TypeHebergementCapacite();
            $obj->hydrate($row);
            TypeHebergementCapacitePeer::addInstanceToPool($obj, (string) $key);
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
     * @return TypeHebergementCapacite|TypeHebergementCapacite[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|TypeHebergementCapacite[]|mixed the list of results, formatted by the current formatter
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
     * @return TypeHebergementCapaciteQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TypeHebergementCapacitePeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return TypeHebergementCapaciteQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TypeHebergementCapacitePeer::ID, $keys, Criteria::IN);
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
     * @return TypeHebergementCapaciteQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(TypeHebergementCapacitePeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the image_menu column
     *
     * Example usage:
     * <code>
     * $query->filterByImageMenu('fooValue');   // WHERE image_menu = 'fooValue'
     * $query->filterByImageMenu('%fooValue%'); // WHERE image_menu LIKE '%fooValue%'
     * </code>
     *
     * @param     string $imageMenu The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TypeHebergementCapaciteQuery The current query, for fluid interface
     */
    public function filterByImageMenu($imageMenu = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($imageMenu)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $imageMenu)) {
                $imageMenu = str_replace('*', '%', $imageMenu);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TypeHebergementCapacitePeer::IMAGE_MENU, $imageMenu, $comparison);
    }

    /**
     * Filter the query on the image_page column
     *
     * Example usage:
     * <code>
     * $query->filterByImagePage('fooValue');   // WHERE image_page = 'fooValue'
     * $query->filterByImagePage('%fooValue%'); // WHERE image_page LIKE '%fooValue%'
     * </code>
     *
     * @param     string $imagePage The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TypeHebergementCapaciteQuery The current query, for fluid interface
     */
    public function filterByImagePage($imagePage = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($imagePage)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $imagePage)) {
                $imagePage = str_replace('*', '%', $imagePage);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TypeHebergementCapacitePeer::IMAGE_PAGE, $imagePage, $comparison);
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
     * @return TypeHebergementCapaciteQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(TypeHebergementCapacitePeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(TypeHebergementCapacitePeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TypeHebergementCapacitePeer::CREATED_AT, $createdAt, $comparison);
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
     * @return TypeHebergementCapaciteQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(TypeHebergementCapacitePeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(TypeHebergementCapacitePeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TypeHebergementCapacitePeer::UPDATED_AT, $updatedAt, $comparison);
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
     * @return TypeHebergementCapaciteQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(TypeHebergementCapacitePeer::ACTIVE, $active, $comparison);
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
     * @return TypeHebergementCapaciteQuery The current query, for fluid interface
     */
    public function filterBySortableRank($sortableRank = null, $comparison = null)
    {
        if (is_array($sortableRank)) {
            $useMinMax = false;
            if (isset($sortableRank['min'])) {
                $this->addUsingAlias(TypeHebergementCapacitePeer::SORTABLE_RANK, $sortableRank['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sortableRank['max'])) {
                $this->addUsingAlias(TypeHebergementCapacitePeer::SORTABLE_RANK, $sortableRank['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TypeHebergementCapacitePeer::SORTABLE_RANK, $sortableRank, $comparison);
    }

    /**
     * Filter the query by a related TypeHebergement object
     *
     * @param   TypeHebergement|PropelObjectCollection $typeHebergement  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TypeHebergementCapaciteQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTypeHebergement($typeHebergement, $comparison = null)
    {
        if ($typeHebergement instanceof TypeHebergement) {
            return $this
                ->addUsingAlias(TypeHebergementCapacitePeer::ID, $typeHebergement->getTypeHebergementCapaciteId(), $comparison);
        } elseif ($typeHebergement instanceof PropelObjectCollection) {
            return $this
                ->useTypeHebergementQuery()
                ->filterByPrimaryKeys($typeHebergement->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTypeHebergement() only accepts arguments of type TypeHebergement or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TypeHebergement relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TypeHebergementCapaciteQuery The current query, for fluid interface
     */
    public function joinTypeHebergement($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TypeHebergement');

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
            $this->addJoinObject($join, 'TypeHebergement');
        }

        return $this;
    }

    /**
     * Use the TypeHebergement relation TypeHebergement object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\TypeHebergementQuery A secondary query class using the current class as primary query
     */
    public function useTypeHebergementQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTypeHebergement($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TypeHebergement', '\Cungfoo\Model\TypeHebergementQuery');
    }

    /**
     * Filter the query by a related TypeHebergementCapaciteI18n object
     *
     * @param   TypeHebergementCapaciteI18n|PropelObjectCollection $typeHebergementCapaciteI18n  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TypeHebergementCapaciteQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTypeHebergementCapaciteI18n($typeHebergementCapaciteI18n, $comparison = null)
    {
        if ($typeHebergementCapaciteI18n instanceof TypeHebergementCapaciteI18n) {
            return $this
                ->addUsingAlias(TypeHebergementCapacitePeer::ID, $typeHebergementCapaciteI18n->getId(), $comparison);
        } elseif ($typeHebergementCapaciteI18n instanceof PropelObjectCollection) {
            return $this
                ->useTypeHebergementCapaciteI18nQuery()
                ->filterByPrimaryKeys($typeHebergementCapaciteI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTypeHebergementCapaciteI18n() only accepts arguments of type TypeHebergementCapaciteI18n or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TypeHebergementCapaciteI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TypeHebergementCapaciteQuery The current query, for fluid interface
     */
    public function joinTypeHebergementCapaciteI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TypeHebergementCapaciteI18n');

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
            $this->addJoinObject($join, 'TypeHebergementCapaciteI18n');
        }

        return $this;
    }

    /**
     * Use the TypeHebergementCapaciteI18n relation TypeHebergementCapaciteI18n object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\TypeHebergementCapaciteI18nQuery A secondary query class using the current class as primary query
     */
    public function useTypeHebergementCapaciteI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinTypeHebergementCapaciteI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TypeHebergementCapaciteI18n', '\Cungfoo\Model\TypeHebergementCapaciteI18nQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   TypeHebergementCapacite $typeHebergementCapacite Object to remove from the list of results
     *
     * @return TypeHebergementCapaciteQuery The current query, for fluid interface
     */
    public function prune($typeHebergementCapacite = null)
    {
        if ($typeHebergementCapacite) {
            $this->addUsingAlias(TypeHebergementCapacitePeer::ID, $typeHebergementCapacite->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     TypeHebergementCapaciteQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(TypeHebergementCapacitePeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     TypeHebergementCapaciteQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(TypeHebergementCapacitePeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     TypeHebergementCapaciteQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(TypeHebergementCapacitePeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     TypeHebergementCapaciteQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(TypeHebergementCapacitePeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     TypeHebergementCapaciteQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(TypeHebergementCapacitePeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     TypeHebergementCapaciteQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(TypeHebergementCapacitePeer::CREATED_AT);
    }
    // active behavior

    /**
     * return only active objects
     *
     * @return boolean
     */
    public function findActive($con = null)
    {
        $this->filterByActive(true);

        return parent::find($con);
    }

    // sortable behavior

    /**
     * Filter the query based on a rank in the list
     *
     * @param     integer   $rank rank
     *
     * @return    TypeHebergementCapaciteQuery The current query, for fluid interface
     */
    public function filterByRank($rank)
    {
        return $this
            ->addUsingAlias(TypeHebergementCapacitePeer::RANK_COL, $rank, Criteria::EQUAL);
    }

    /**
     * Order the query based on the rank in the list.
     * Using the default $order, returns the item with the lowest rank first
     *
     * @param     string $order either Criteria::ASC (default) or Criteria::DESC
     *
     * @return    TypeHebergementCapaciteQuery The current query, for fluid interface
     */
    public function orderByRank($order = Criteria::ASC)
    {
        $order = strtoupper($order);
        switch ($order) {
            case Criteria::ASC:
                return $this->addAscendingOrderByColumn($this->getAliasedColName(TypeHebergementCapacitePeer::RANK_COL));
                break;
            case Criteria::DESC:
                return $this->addDescendingOrderByColumn($this->getAliasedColName(TypeHebergementCapacitePeer::RANK_COL));
                break;
            default:
                throw new PropelException('TypeHebergementCapaciteQuery::orderBy() only accepts "asc" or "desc" as argument');
        }
    }

    /**
     * Get an item from the list based on its rank
     *
     * @param     integer   $rank rank
     * @param     PropelPDO $con optional connection
     *
     * @return    TypeHebergementCapacite
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
            $con = Propel::getConnection(TypeHebergementCapacitePeer::DATABASE_NAME);
        }
        // shift the objects with a position lower than the one of object
        $this->addSelectColumn('MAX(' . TypeHebergementCapacitePeer::RANK_COL . ')');
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
            $con = Propel::getConnection(TypeHebergementCapacitePeer::DATABASE_NAME);
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

    // i18n behavior

    /**
     * Adds a JOIN clause to the query using the i18n relation
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    TypeHebergementCapaciteQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'TypeHebergementCapaciteI18n';

        return $this
            ->joinTypeHebergementCapaciteI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    TypeHebergementCapaciteQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'fr', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('TypeHebergementCapaciteI18n');
        $this->with['TypeHebergementCapaciteI18n']->setIsWithOneToMany(false);

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
     * @return    TypeHebergementCapaciteI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TypeHebergementCapaciteI18n', 'Cungfoo\Model\TypeHebergementCapaciteI18nQuery');
    }

}
