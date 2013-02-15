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
use Cungfoo\Model\Seo;
use Cungfoo\Model\SeoI18n;
use Cungfoo\Model\SeoPeer;
use Cungfoo\Model\SeoQuery;

/**
 * Base class that represents a query for the 'seo' table.
 *
 *
 *
 * @method SeoQuery orderById($order = Criteria::ASC) Order by the id column
 * @method SeoQuery orderByTableRef($order = Criteria::ASC) Order by the table_ref column
 *
 * @method SeoQuery groupById() Group by the id column
 * @method SeoQuery groupByTableRef() Group by the table_ref column
 *
 * @method SeoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method SeoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method SeoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method SeoQuery leftJoinSeoI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the SeoI18n relation
 * @method SeoQuery rightJoinSeoI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SeoI18n relation
 * @method SeoQuery innerJoinSeoI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the SeoI18n relation
 *
 * @method Seo findOne(PropelPDO $con = null) Return the first Seo matching the query
 * @method Seo findOneOrCreate(PropelPDO $con = null) Return the first Seo matching the query, or a new Seo object populated from the query conditions when no match is found
 *
 * @method Seo findOneByTableRef(string $table_ref) Return the first Seo filtered by the table_ref column
 *
 * @method array findById(int $id) Return Seo objects filtered by the id column
 * @method array findByTableRef(string $table_ref) Return Seo objects filtered by the table_ref column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseSeoQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseSeoQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\Seo', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new SeoQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     SeoQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return SeoQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof SeoQuery) {
            return $criteria;
        }
        $query = new SeoQuery();
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
     * @return   Seo|Seo[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = SeoPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(SeoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Seo A model object, or null if the key is not found
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
     * @return   Seo A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `table_ref` FROM `seo` WHERE `id` = :p0';
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
            $obj = new Seo();
            $obj->hydrate($row);
            SeoPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Seo|Seo[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Seo[]|mixed the list of results, formatted by the current formatter
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
     * @return SeoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SeoPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return SeoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SeoPeer::ID, $keys, Criteria::IN);
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
     * @return SeoQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(SeoPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the table_ref column
     *
     * Example usage:
     * <code>
     * $query->filterByTableRef('fooValue');   // WHERE table_ref = 'fooValue'
     * $query->filterByTableRef('%fooValue%'); // WHERE table_ref LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tableRef The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SeoQuery The current query, for fluid interface
     */
    public function filterByTableRef($tableRef = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tableRef)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tableRef)) {
                $tableRef = str_replace('*', '%', $tableRef);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SeoPeer::TABLE_REF, $tableRef, $comparison);
    }

    /**
     * Filter the query by a related SeoI18n object
     *
     * @param   SeoI18n|PropelObjectCollection $seoI18n  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   SeoQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterBySeoI18n($seoI18n, $comparison = null)
    {
        if ($seoI18n instanceof SeoI18n) {
            return $this
                ->addUsingAlias(SeoPeer::ID, $seoI18n->getId(), $comparison);
        } elseif ($seoI18n instanceof PropelObjectCollection) {
            return $this
                ->useSeoI18nQuery()
                ->filterByPrimaryKeys($seoI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySeoI18n() only accepts arguments of type SeoI18n or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SeoI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return SeoQuery The current query, for fluid interface
     */
    public function joinSeoI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SeoI18n');

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
            $this->addJoinObject($join, 'SeoI18n');
        }

        return $this;
    }

    /**
     * Use the SeoI18n relation SeoI18n object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\SeoI18nQuery A secondary query class using the current class as primary query
     */
    public function useSeoI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinSeoI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SeoI18n', '\Cungfoo\Model\SeoI18nQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Seo $seo Object to remove from the list of results
     *
     * @return SeoQuery The current query, for fluid interface
     */
    public function prune($seo = null)
    {
        if ($seo) {
            $this->addUsingAlias(SeoPeer::ID, $seo->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // i18n behavior

    /**
     * Adds a JOIN clause to the query using the i18n relation
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    SeoQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'SeoI18n';

        return $this
            ->joinSeoI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    SeoQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'fr', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('SeoI18n');
        $this->with['SeoI18n']->setIsWithOneToMany(false);

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
     * @return    SeoI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SeoI18n', 'Cungfoo\Model\SeoI18nQuery');
    }

}
