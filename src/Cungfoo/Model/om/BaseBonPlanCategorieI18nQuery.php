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
use Cungfoo\Model\BonPlanCategorie;
use Cungfoo\Model\BonPlanCategorieI18n;
use Cungfoo\Model\BonPlanCategorieI18nPeer;
use Cungfoo\Model\BonPlanCategorieI18nQuery;

/**
 * Base class that represents a query for the 'bon_plan_categorie_i18n' table.
 *
 *
 *
 * @method BonPlanCategorieI18nQuery orderById($order = Criteria::ASC) Order by the id column
 * @method BonPlanCategorieI18nQuery orderByLocale($order = Criteria::ASC) Order by the locale column
 * @method BonPlanCategorieI18nQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method BonPlanCategorieI18nQuery orderBySlug($order = Criteria::ASC) Order by the slug column
 * @method BonPlanCategorieI18nQuery orderBySubtitle($order = Criteria::ASC) Order by the subtitle column
 * @method BonPlanCategorieI18nQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method BonPlanCategorieI18nQuery orderBySeoTitle($order = Criteria::ASC) Order by the seo_title column
 * @method BonPlanCategorieI18nQuery orderBySeoDescription($order = Criteria::ASC) Order by the seo_description column
 * @method BonPlanCategorieI18nQuery orderBySeoH1($order = Criteria::ASC) Order by the seo_h1 column
 * @method BonPlanCategorieI18nQuery orderBySeoKeywords($order = Criteria::ASC) Order by the seo_keywords column
 * @method BonPlanCategorieI18nQuery orderByActiveLocale($order = Criteria::ASC) Order by the active_locale column
 *
 * @method BonPlanCategorieI18nQuery groupById() Group by the id column
 * @method BonPlanCategorieI18nQuery groupByLocale() Group by the locale column
 * @method BonPlanCategorieI18nQuery groupByName() Group by the name column
 * @method BonPlanCategorieI18nQuery groupBySlug() Group by the slug column
 * @method BonPlanCategorieI18nQuery groupBySubtitle() Group by the subtitle column
 * @method BonPlanCategorieI18nQuery groupByDescription() Group by the description column
 * @method BonPlanCategorieI18nQuery groupBySeoTitle() Group by the seo_title column
 * @method BonPlanCategorieI18nQuery groupBySeoDescription() Group by the seo_description column
 * @method BonPlanCategorieI18nQuery groupBySeoH1() Group by the seo_h1 column
 * @method BonPlanCategorieI18nQuery groupBySeoKeywords() Group by the seo_keywords column
 * @method BonPlanCategorieI18nQuery groupByActiveLocale() Group by the active_locale column
 *
 * @method BonPlanCategorieI18nQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method BonPlanCategorieI18nQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method BonPlanCategorieI18nQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method BonPlanCategorieI18nQuery leftJoinBonPlanCategorie($relationAlias = null) Adds a LEFT JOIN clause to the query using the BonPlanCategorie relation
 * @method BonPlanCategorieI18nQuery rightJoinBonPlanCategorie($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BonPlanCategorie relation
 * @method BonPlanCategorieI18nQuery innerJoinBonPlanCategorie($relationAlias = null) Adds a INNER JOIN clause to the query using the BonPlanCategorie relation
 *
 * @method BonPlanCategorieI18n findOne(PropelPDO $con = null) Return the first BonPlanCategorieI18n matching the query
 * @method BonPlanCategorieI18n findOneOrCreate(PropelPDO $con = null) Return the first BonPlanCategorieI18n matching the query, or a new BonPlanCategorieI18n object populated from the query conditions when no match is found
 *
 * @method BonPlanCategorieI18n findOneById(int $id) Return the first BonPlanCategorieI18n filtered by the id column
 * @method BonPlanCategorieI18n findOneByLocale(string $locale) Return the first BonPlanCategorieI18n filtered by the locale column
 * @method BonPlanCategorieI18n findOneByName(string $name) Return the first BonPlanCategorieI18n filtered by the name column
 * @method BonPlanCategorieI18n findOneBySlug(string $slug) Return the first BonPlanCategorieI18n filtered by the slug column
 * @method BonPlanCategorieI18n findOneBySubtitle(string $subtitle) Return the first BonPlanCategorieI18n filtered by the subtitle column
 * @method BonPlanCategorieI18n findOneByDescription(string $description) Return the first BonPlanCategorieI18n filtered by the description column
 * @method BonPlanCategorieI18n findOneBySeoTitle(string $seo_title) Return the first BonPlanCategorieI18n filtered by the seo_title column
 * @method BonPlanCategorieI18n findOneBySeoDescription(string $seo_description) Return the first BonPlanCategorieI18n filtered by the seo_description column
 * @method BonPlanCategorieI18n findOneBySeoH1(string $seo_h1) Return the first BonPlanCategorieI18n filtered by the seo_h1 column
 * @method BonPlanCategorieI18n findOneBySeoKeywords(string $seo_keywords) Return the first BonPlanCategorieI18n filtered by the seo_keywords column
 * @method BonPlanCategorieI18n findOneByActiveLocale(boolean $active_locale) Return the first BonPlanCategorieI18n filtered by the active_locale column
 *
 * @method array findById(int $id) Return BonPlanCategorieI18n objects filtered by the id column
 * @method array findByLocale(string $locale) Return BonPlanCategorieI18n objects filtered by the locale column
 * @method array findByName(string $name) Return BonPlanCategorieI18n objects filtered by the name column
 * @method array findBySlug(string $slug) Return BonPlanCategorieI18n objects filtered by the slug column
 * @method array findBySubtitle(string $subtitle) Return BonPlanCategorieI18n objects filtered by the subtitle column
 * @method array findByDescription(string $description) Return BonPlanCategorieI18n objects filtered by the description column
 * @method array findBySeoTitle(string $seo_title) Return BonPlanCategorieI18n objects filtered by the seo_title column
 * @method array findBySeoDescription(string $seo_description) Return BonPlanCategorieI18n objects filtered by the seo_description column
 * @method array findBySeoH1(string $seo_h1) Return BonPlanCategorieI18n objects filtered by the seo_h1 column
 * @method array findBySeoKeywords(string $seo_keywords) Return BonPlanCategorieI18n objects filtered by the seo_keywords column
 * @method array findByActiveLocale(boolean $active_locale) Return BonPlanCategorieI18n objects filtered by the active_locale column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseBonPlanCategorieI18nQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseBonPlanCategorieI18nQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\BonPlanCategorieI18n', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new BonPlanCategorieI18nQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     BonPlanCategorieI18nQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return BonPlanCategorieI18nQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof BonPlanCategorieI18nQuery) {
            return $criteria;
        }
        $query = new BonPlanCategorieI18nQuery();
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
     * @return   BonPlanCategorieI18n|BonPlanCategorieI18n[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = BonPlanCategorieI18nPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(BonPlanCategorieI18nPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   BonPlanCategorieI18n A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `locale`, `name`, `slug`, `subtitle`, `description`, `seo_title`, `seo_description`, `seo_h1`, `seo_keywords`, `active_locale` FROM `bon_plan_categorie_i18n` WHERE `id` = :p0 AND `locale` = :p1';
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
            $obj = new BonPlanCategorieI18n();
            $obj->hydrate($row);
            BonPlanCategorieI18nPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return BonPlanCategorieI18n|BonPlanCategorieI18n[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|BonPlanCategorieI18n[]|mixed the list of results, formatted by the current formatter
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
     * @return BonPlanCategorieI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(BonPlanCategorieI18nPeer::ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(BonPlanCategorieI18nPeer::LOCALE, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return BonPlanCategorieI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(BonPlanCategorieI18nPeer::ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(BonPlanCategorieI18nPeer::LOCALE, $key[1], Criteria::EQUAL);
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
     * @see       filterByBonPlanCategorie()
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BonPlanCategorieI18nQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(BonPlanCategorieI18nPeer::ID, $id, $comparison);
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
     * @return BonPlanCategorieI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(BonPlanCategorieI18nPeer::LOCALE, $locale, $comparison);
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
     * @return BonPlanCategorieI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(BonPlanCategorieI18nPeer::NAME, $name, $comparison);
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
     * @return BonPlanCategorieI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(BonPlanCategorieI18nPeer::SLUG, $slug, $comparison);
    }

    /**
     * Filter the query on the subtitle column
     *
     * Example usage:
     * <code>
     * $query->filterBySubtitle('fooValue');   // WHERE subtitle = 'fooValue'
     * $query->filterBySubtitle('%fooValue%'); // WHERE subtitle LIKE '%fooValue%'
     * </code>
     *
     * @param     string $subtitle The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BonPlanCategorieI18nQuery The current query, for fluid interface
     */
    public function filterBySubtitle($subtitle = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($subtitle)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $subtitle)) {
                $subtitle = str_replace('*', '%', $subtitle);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(BonPlanCategorieI18nPeer::SUBTITLE, $subtitle, $comparison);
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
     * @return BonPlanCategorieI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(BonPlanCategorieI18nPeer::DESCRIPTION, $description, $comparison);
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
     * @return BonPlanCategorieI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(BonPlanCategorieI18nPeer::SEO_TITLE, $seoTitle, $comparison);
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
     * @return BonPlanCategorieI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(BonPlanCategorieI18nPeer::SEO_DESCRIPTION, $seoDescription, $comparison);
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
     * @return BonPlanCategorieI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(BonPlanCategorieI18nPeer::SEO_H1, $seoH1, $comparison);
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
     * @return BonPlanCategorieI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(BonPlanCategorieI18nPeer::SEO_KEYWORDS, $seoKeywords, $comparison);
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
     * @return BonPlanCategorieI18nQuery The current query, for fluid interface
     */
    public function filterByActiveLocale($activeLocale = null, $comparison = null)
    {
        if (is_string($activeLocale)) {
            $active_locale = in_array(strtolower($activeLocale), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(BonPlanCategorieI18nPeer::ACTIVE_LOCALE, $activeLocale, $comparison);
    }

    /**
     * Filter the query by a related BonPlanCategorie object
     *
     * @param   BonPlanCategorie|PropelObjectCollection $bonPlanCategorie The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   BonPlanCategorieI18nQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByBonPlanCategorie($bonPlanCategorie, $comparison = null)
    {
        if ($bonPlanCategorie instanceof BonPlanCategorie) {
            return $this
                ->addUsingAlias(BonPlanCategorieI18nPeer::ID, $bonPlanCategorie->getId(), $comparison);
        } elseif ($bonPlanCategorie instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BonPlanCategorieI18nPeer::ID, $bonPlanCategorie->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByBonPlanCategorie() only accepts arguments of type BonPlanCategorie or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BonPlanCategorie relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return BonPlanCategorieI18nQuery The current query, for fluid interface
     */
    public function joinBonPlanCategorie($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BonPlanCategorie');

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
            $this->addJoinObject($join, 'BonPlanCategorie');
        }

        return $this;
    }

    /**
     * Use the BonPlanCategorie relation BonPlanCategorie object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\BonPlanCategorieQuery A secondary query class using the current class as primary query
     */
    public function useBonPlanCategorieQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinBonPlanCategorie($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BonPlanCategorie', '\Cungfoo\Model\BonPlanCategorieQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   BonPlanCategorieI18n $bonPlanCategorieI18n Object to remove from the list of results
     *
     * @return BonPlanCategorieI18nQuery The current query, for fluid interface
     */
    public function prune($bonPlanCategorieI18n = null)
    {
        if ($bonPlanCategorieI18n) {
            $this->addCond('pruneCond0', $this->getAliasedColName(BonPlanCategorieI18nPeer::ID), $bonPlanCategorieI18n->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(BonPlanCategorieI18nPeer::LOCALE), $bonPlanCategorieI18n->getLocale(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
