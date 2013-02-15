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
use Cungfoo\Model\Departement;
use Cungfoo\Model\DepartementI18n;
use Cungfoo\Model\DepartementI18nPeer;
use Cungfoo\Model\DepartementI18nQuery;

/**
 * Base class that represents a query for the 'departement_i18n' table.
 *
 *
 *
 * @method DepartementI18nQuery orderById($order = Criteria::ASC) Order by the id column
 * @method DepartementI18nQuery orderByLocale($order = Criteria::ASC) Order by the locale column
 * @method DepartementI18nQuery orderBySlug($order = Criteria::ASC) Order by the slug column
 * @method DepartementI18nQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method DepartementI18nQuery orderByIntroduction($order = Criteria::ASC) Order by the introduction column
 * @method DepartementI18nQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method DepartementI18nQuery orderByActiveLocale($order = Criteria::ASC) Order by the active_locale column
 * @method DepartementI18nQuery orderBySeoTitle($order = Criteria::ASC) Order by the seo_title column
 * @method DepartementI18nQuery orderBySeoDescription($order = Criteria::ASC) Order by the seo_description column
 * @method DepartementI18nQuery orderBySeoH1($order = Criteria::ASC) Order by the seo_h1 column
 * @method DepartementI18nQuery orderBySeoKeywords($order = Criteria::ASC) Order by the seo_keywords column
 *
 * @method DepartementI18nQuery groupById() Group by the id column
 * @method DepartementI18nQuery groupByLocale() Group by the locale column
 * @method DepartementI18nQuery groupBySlug() Group by the slug column
 * @method DepartementI18nQuery groupByName() Group by the name column
 * @method DepartementI18nQuery groupByIntroduction() Group by the introduction column
 * @method DepartementI18nQuery groupByDescription() Group by the description column
 * @method DepartementI18nQuery groupByActiveLocale() Group by the active_locale column
 * @method DepartementI18nQuery groupBySeoTitle() Group by the seo_title column
 * @method DepartementI18nQuery groupBySeoDescription() Group by the seo_description column
 * @method DepartementI18nQuery groupBySeoH1() Group by the seo_h1 column
 * @method DepartementI18nQuery groupBySeoKeywords() Group by the seo_keywords column
 *
 * @method DepartementI18nQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method DepartementI18nQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method DepartementI18nQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method DepartementI18nQuery leftJoinDepartement($relationAlias = null) Adds a LEFT JOIN clause to the query using the Departement relation
 * @method DepartementI18nQuery rightJoinDepartement($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Departement relation
 * @method DepartementI18nQuery innerJoinDepartement($relationAlias = null) Adds a INNER JOIN clause to the query using the Departement relation
 *
 * @method DepartementI18n findOne(PropelPDO $con = null) Return the first DepartementI18n matching the query
 * @method DepartementI18n findOneOrCreate(PropelPDO $con = null) Return the first DepartementI18n matching the query, or a new DepartementI18n object populated from the query conditions when no match is found
 *
 * @method DepartementI18n findOneById(int $id) Return the first DepartementI18n filtered by the id column
 * @method DepartementI18n findOneByLocale(string $locale) Return the first DepartementI18n filtered by the locale column
 * @method DepartementI18n findOneBySlug(string $slug) Return the first DepartementI18n filtered by the slug column
 * @method DepartementI18n findOneByName(string $name) Return the first DepartementI18n filtered by the name column
 * @method DepartementI18n findOneByIntroduction(string $introduction) Return the first DepartementI18n filtered by the introduction column
 * @method DepartementI18n findOneByDescription(string $description) Return the first DepartementI18n filtered by the description column
 * @method DepartementI18n findOneByActiveLocale(boolean $active_locale) Return the first DepartementI18n filtered by the active_locale column
 * @method DepartementI18n findOneBySeoTitle(string $seo_title) Return the first DepartementI18n filtered by the seo_title column
 * @method DepartementI18n findOneBySeoDescription(string $seo_description) Return the first DepartementI18n filtered by the seo_description column
 * @method DepartementI18n findOneBySeoH1(string $seo_h1) Return the first DepartementI18n filtered by the seo_h1 column
 * @method DepartementI18n findOneBySeoKeywords(string $seo_keywords) Return the first DepartementI18n filtered by the seo_keywords column
 *
 * @method array findById(int $id) Return DepartementI18n objects filtered by the id column
 * @method array findByLocale(string $locale) Return DepartementI18n objects filtered by the locale column
 * @method array findBySlug(string $slug) Return DepartementI18n objects filtered by the slug column
 * @method array findByName(string $name) Return DepartementI18n objects filtered by the name column
 * @method array findByIntroduction(string $introduction) Return DepartementI18n objects filtered by the introduction column
 * @method array findByDescription(string $description) Return DepartementI18n objects filtered by the description column
 * @method array findByActiveLocale(boolean $active_locale) Return DepartementI18n objects filtered by the active_locale column
 * @method array findBySeoTitle(string $seo_title) Return DepartementI18n objects filtered by the seo_title column
 * @method array findBySeoDescription(string $seo_description) Return DepartementI18n objects filtered by the seo_description column
 * @method array findBySeoH1(string $seo_h1) Return DepartementI18n objects filtered by the seo_h1 column
 * @method array findBySeoKeywords(string $seo_keywords) Return DepartementI18n objects filtered by the seo_keywords column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseDepartementI18nQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseDepartementI18nQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\DepartementI18n', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new DepartementI18nQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     DepartementI18nQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return DepartementI18nQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof DepartementI18nQuery) {
            return $criteria;
        }
        $query = new DepartementI18nQuery();
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
     * @return   DepartementI18n|DepartementI18n[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = DepartementI18nPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(DepartementI18nPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   DepartementI18n A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `locale`, `slug`, `name`, `introduction`, `description`, `active_locale`, `seo_title`, `seo_description`, `seo_h1`, `seo_keywords` FROM `departement_i18n` WHERE `id` = :p0 AND `locale` = :p1';
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
            $obj = new DepartementI18n();
            $obj->hydrate($row);
            DepartementI18nPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return DepartementI18n|DepartementI18n[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|DepartementI18n[]|mixed the list of results, formatted by the current formatter
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
     * @return DepartementI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(DepartementI18nPeer::ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(DepartementI18nPeer::LOCALE, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return DepartementI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(DepartementI18nPeer::ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(DepartementI18nPeer::LOCALE, $key[1], Criteria::EQUAL);
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
     * @see       filterByDepartement()
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DepartementI18nQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(DepartementI18nPeer::ID, $id, $comparison);
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
     * @return DepartementI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(DepartementI18nPeer::LOCALE, $locale, $comparison);
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
     * @return DepartementI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(DepartementI18nPeer::SLUG, $slug, $comparison);
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
     * @return DepartementI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(DepartementI18nPeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query on the introduction column
     *
     * Example usage:
     * <code>
     * $query->filterByIntroduction('fooValue');   // WHERE introduction = 'fooValue'
     * $query->filterByIntroduction('%fooValue%'); // WHERE introduction LIKE '%fooValue%'
     * </code>
     *
     * @param     string $introduction The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DepartementI18nQuery The current query, for fluid interface
     */
    public function filterByIntroduction($introduction = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($introduction)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $introduction)) {
                $introduction = str_replace('*', '%', $introduction);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DepartementI18nPeer::INTRODUCTION, $introduction, $comparison);
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
     * @return DepartementI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(DepartementI18nPeer::DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the active_locale column
     *
     * Example usage:
     * <code>
     * $query->filterByActiveLocale(true); // WHERE active_locale = true
     * $query->filterByActiveLocale('yes'); // WHERE active_locale = true
     * </code>
     *
     * @param     boolean|string $activeLocale The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DepartementI18nQuery The current query, for fluid interface
     */
    public function filterByActiveLocale($activeLocale = null, $comparison = null)
    {
        if (is_string($activeLocale)) {
            $active_locale = in_array(strtolower($activeLocale), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(DepartementI18nPeer::ACTIVE_LOCALE, $activeLocale, $comparison);
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
     * @return DepartementI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(DepartementI18nPeer::SEO_TITLE, $seoTitle, $comparison);
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
     * @return DepartementI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(DepartementI18nPeer::SEO_DESCRIPTION, $seoDescription, $comparison);
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
     * @return DepartementI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(DepartementI18nPeer::SEO_H1, $seoH1, $comparison);
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
     * @return DepartementI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(DepartementI18nPeer::SEO_KEYWORDS, $seoKeywords, $comparison);
    }

    /**
     * Filter the query by a related Departement object
     *
     * @param   Departement|PropelObjectCollection $departement The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   DepartementI18nQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByDepartement($departement, $comparison = null)
    {
        if ($departement instanceof Departement) {
            return $this
                ->addUsingAlias(DepartementI18nPeer::ID, $departement->getId(), $comparison);
        } elseif ($departement instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DepartementI18nPeer::ID, $departement->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByDepartement() only accepts arguments of type Departement or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Departement relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return DepartementI18nQuery The current query, for fluid interface
     */
    public function joinDepartement($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Departement');

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
            $this->addJoinObject($join, 'Departement');
        }

        return $this;
    }

    /**
     * Use the Departement relation Departement object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\DepartementQuery A secondary query class using the current class as primary query
     */
    public function useDepartementQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinDepartement($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Departement', '\Cungfoo\Model\DepartementQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   DepartementI18n $departementI18n Object to remove from the list of results
     *
     * @return DepartementI18nQuery The current query, for fluid interface
     */
    public function prune($departementI18n = null)
    {
        if ($departementI18n) {
            $this->addCond('pruneCond0', $this->getAliasedColName(DepartementI18nPeer::ID), $departementI18n->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(DepartementI18nPeer::LOCALE), $departementI18n->getLocale(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
