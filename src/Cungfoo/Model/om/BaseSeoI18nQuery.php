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
use Cungfoo\Model\SeoI18nPeer;
use Cungfoo\Model\SeoI18nQuery;

/**
 * Base class that represents a query for the 'seo_i18n' table.
 *
 *
 *
 * @method SeoI18nQuery orderById($order = Criteria::ASC) Order by the id column
 * @method SeoI18nQuery orderByLocale($order = Criteria::ASC) Order by the locale column
 * @method SeoI18nQuery orderBySeoTitle($order = Criteria::ASC) Order by the seo_title column
 * @method SeoI18nQuery orderBySeoDescription($order = Criteria::ASC) Order by the seo_description column
 * @method SeoI18nQuery orderBySeoH1($order = Criteria::ASC) Order by the seo_h1 column
 * @method SeoI18nQuery orderBySeoKeywords($order = Criteria::ASC) Order by the seo_keywords column
 *
 * @method SeoI18nQuery groupById() Group by the id column
 * @method SeoI18nQuery groupByLocale() Group by the locale column
 * @method SeoI18nQuery groupBySeoTitle() Group by the seo_title column
 * @method SeoI18nQuery groupBySeoDescription() Group by the seo_description column
 * @method SeoI18nQuery groupBySeoH1() Group by the seo_h1 column
 * @method SeoI18nQuery groupBySeoKeywords() Group by the seo_keywords column
 *
 * @method SeoI18nQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method SeoI18nQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method SeoI18nQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method SeoI18nQuery leftJoinSeo($relationAlias = null) Adds a LEFT JOIN clause to the query using the Seo relation
 * @method SeoI18nQuery rightJoinSeo($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Seo relation
 * @method SeoI18nQuery innerJoinSeo($relationAlias = null) Adds a INNER JOIN clause to the query using the Seo relation
 *
 * @method SeoI18n findOne(PropelPDO $con = null) Return the first SeoI18n matching the query
 * @method SeoI18n findOneOrCreate(PropelPDO $con = null) Return the first SeoI18n matching the query, or a new SeoI18n object populated from the query conditions when no match is found
 *
 * @method SeoI18n findOneById(int $id) Return the first SeoI18n filtered by the id column
 * @method SeoI18n findOneByLocale(string $locale) Return the first SeoI18n filtered by the locale column
 * @method SeoI18n findOneBySeoTitle(string $seo_title) Return the first SeoI18n filtered by the seo_title column
 * @method SeoI18n findOneBySeoDescription(string $seo_description) Return the first SeoI18n filtered by the seo_description column
 * @method SeoI18n findOneBySeoH1(string $seo_h1) Return the first SeoI18n filtered by the seo_h1 column
 * @method SeoI18n findOneBySeoKeywords(string $seo_keywords) Return the first SeoI18n filtered by the seo_keywords column
 *
 * @method array findById(int $id) Return SeoI18n objects filtered by the id column
 * @method array findByLocale(string $locale) Return SeoI18n objects filtered by the locale column
 * @method array findBySeoTitle(string $seo_title) Return SeoI18n objects filtered by the seo_title column
 * @method array findBySeoDescription(string $seo_description) Return SeoI18n objects filtered by the seo_description column
 * @method array findBySeoH1(string $seo_h1) Return SeoI18n objects filtered by the seo_h1 column
 * @method array findBySeoKeywords(string $seo_keywords) Return SeoI18n objects filtered by the seo_keywords column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseSeoI18nQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseSeoI18nQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\SeoI18n', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new SeoI18nQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     SeoI18nQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return SeoI18nQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof SeoI18nQuery) {
            return $criteria;
        }
        $query = new SeoI18nQuery();
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
                         A Primary key composition: [$id, $locale]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   SeoI18n|SeoI18n[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = SeoI18nPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(SeoI18nPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   SeoI18n A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `locale`, `seo_title`, `seo_description`, `seo_h1`, `seo_keywords` FROM `seo_i18n` WHERE `id` = :p0 AND `locale` = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new SeoI18n();
            $obj->hydrate($row);
            SeoI18nPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return SeoI18n|SeoI18n[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|SeoI18n[]|mixed the list of results, formatted by the current formatter
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
     * @return SeoI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(SeoI18nPeer::ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(SeoI18nPeer::LOCALE, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return SeoI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(SeoI18nPeer::ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(SeoI18nPeer::LOCALE, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @see       filterBySeo()
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SeoI18nQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(SeoI18nPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the locale column
     *
     * Example usage:
     * <code>
     * $query->filterByLocale('fooValue');   // WHERE locale = 'fooValue'
     * $query->filterByLocale('%fooValue%'); // WHERE locale LIKE '%fooValue%'
     * </code>
     *
     * @param     string $locale The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SeoI18nQuery The current query, for fluid interface
     */
    public function filterByLocale($locale = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($locale)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $locale)) {
                $locale = str_replace('*', '%', $locale);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SeoI18nPeer::LOCALE, $locale, $comparison);
    }

    /**
     * Filter the query on the seo_title column
     *
     * Example usage:
     * <code>
     * $query->filterBySeoTitle('fooValue');   // WHERE seo_title = 'fooValue'
     * $query->filterBySeoTitle('%fooValue%'); // WHERE seo_title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $seoTitle The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SeoI18nQuery The current query, for fluid interface
     */
    public function filterBySeoTitle($seoTitle = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($seoTitle)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $seoTitle)) {
                $seoTitle = str_replace('*', '%', $seoTitle);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SeoI18nPeer::SEO_TITLE, $seoTitle, $comparison);
    }

    /**
     * Filter the query on the seo_description column
     *
     * Example usage:
     * <code>
     * $query->filterBySeoDescription('fooValue');   // WHERE seo_description = 'fooValue'
     * $query->filterBySeoDescription('%fooValue%'); // WHERE seo_description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $seoDescription The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SeoI18nQuery The current query, for fluid interface
     */
    public function filterBySeoDescription($seoDescription = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($seoDescription)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $seoDescription)) {
                $seoDescription = str_replace('*', '%', $seoDescription);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SeoI18nPeer::SEO_DESCRIPTION, $seoDescription, $comparison);
    }

    /**
     * Filter the query on the seo_h1 column
     *
     * Example usage:
     * <code>
     * $query->filterBySeoH1('fooValue');   // WHERE seo_h1 = 'fooValue'
     * $query->filterBySeoH1('%fooValue%'); // WHERE seo_h1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $seoH1 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SeoI18nQuery The current query, for fluid interface
     */
    public function filterBySeoH1($seoH1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($seoH1)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $seoH1)) {
                $seoH1 = str_replace('*', '%', $seoH1);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SeoI18nPeer::SEO_H1, $seoH1, $comparison);
    }

    /**
     * Filter the query on the seo_keywords column
     *
     * Example usage:
     * <code>
     * $query->filterBySeoKeywords('fooValue');   // WHERE seo_keywords = 'fooValue'
     * $query->filterBySeoKeywords('%fooValue%'); // WHERE seo_keywords LIKE '%fooValue%'
     * </code>
     *
     * @param     string $seoKeywords The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SeoI18nQuery The current query, for fluid interface
     */
    public function filterBySeoKeywords($seoKeywords = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($seoKeywords)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $seoKeywords)) {
                $seoKeywords = str_replace('*', '%', $seoKeywords);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SeoI18nPeer::SEO_KEYWORDS, $seoKeywords, $comparison);
    }

    /**
     * Filter the query by a related Seo object
     *
     * @param   Seo|PropelObjectCollection $seo The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   SeoI18nQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterBySeo($seo, $comparison = null)
    {
        if ($seo instanceof Seo) {
            return $this
                ->addUsingAlias(SeoI18nPeer::ID, $seo->getId(), $comparison);
        } elseif ($seo instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SeoI18nPeer::ID, $seo->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBySeo() only accepts arguments of type Seo or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Seo relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return SeoI18nQuery The current query, for fluid interface
     */
    public function joinSeo($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Seo');

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
            $this->addJoinObject($join, 'Seo');
        }

        return $this;
    }

    /**
     * Use the Seo relation Seo object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\SeoQuery A secondary query class using the current class as primary query
     */
    public function useSeoQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinSeo($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Seo', '\Cungfoo\Model\SeoQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   SeoI18n $seoI18n Object to remove from the list of results
     *
     * @return SeoI18nQuery The current query, for fluid interface
     */
    public function prune($seoI18n = null)
    {
        if ($seoI18n) {
            $this->addCond('pruneCond0', $this->getAliasedColName(SeoI18nPeer::ID), $seoI18n->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(SeoI18nPeer::LOCALE), $seoI18n->getLocale(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
