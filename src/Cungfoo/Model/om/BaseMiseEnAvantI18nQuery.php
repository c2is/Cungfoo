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
use Cungfoo\Model\MiseEnAvant;
use Cungfoo\Model\MiseEnAvantI18n;
use Cungfoo\Model\MiseEnAvantI18nPeer;
use Cungfoo\Model\MiseEnAvantI18nQuery;

/**
 * Base class that represents a query for the 'mise_en_avant_i18n' table.
 *
 *
 *
 * @method MiseEnAvantI18nQuery orderById($order = Criteria::ASC) Order by the id column
 * @method MiseEnAvantI18nQuery orderByLocale($order = Criteria::ASC) Order by the locale column
 * @method MiseEnAvantI18nQuery orderByTitre($order = Criteria::ASC) Order by the titre column
 * @method MiseEnAvantI18nQuery orderByAccroche($order = Criteria::ASC) Order by the accroche column
 * @method MiseEnAvantI18nQuery orderByLien($order = Criteria::ASC) Order by the lien column
 * @method MiseEnAvantI18nQuery orderByTitreLien($order = Criteria::ASC) Order by the titre_lien column
 * @method MiseEnAvantI18nQuery orderBySeoTitle($order = Criteria::ASC) Order by the seo_title column
 * @method MiseEnAvantI18nQuery orderBySeoDescription($order = Criteria::ASC) Order by the seo_description column
 * @method MiseEnAvantI18nQuery orderBySeoH1($order = Criteria::ASC) Order by the seo_h1 column
 * @method MiseEnAvantI18nQuery orderBySeoKeywords($order = Criteria::ASC) Order by the seo_keywords column
 * @method MiseEnAvantI18nQuery orderByActiveLocale($order = Criteria::ASC) Order by the active_locale column
 *
 * @method MiseEnAvantI18nQuery groupById() Group by the id column
 * @method MiseEnAvantI18nQuery groupByLocale() Group by the locale column
 * @method MiseEnAvantI18nQuery groupByTitre() Group by the titre column
 * @method MiseEnAvantI18nQuery groupByAccroche() Group by the accroche column
 * @method MiseEnAvantI18nQuery groupByLien() Group by the lien column
 * @method MiseEnAvantI18nQuery groupByTitreLien() Group by the titre_lien column
 * @method MiseEnAvantI18nQuery groupBySeoTitle() Group by the seo_title column
 * @method MiseEnAvantI18nQuery groupBySeoDescription() Group by the seo_description column
 * @method MiseEnAvantI18nQuery groupBySeoH1() Group by the seo_h1 column
 * @method MiseEnAvantI18nQuery groupBySeoKeywords() Group by the seo_keywords column
 * @method MiseEnAvantI18nQuery groupByActiveLocale() Group by the active_locale column
 *
 * @method MiseEnAvantI18nQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method MiseEnAvantI18nQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method MiseEnAvantI18nQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method MiseEnAvantI18nQuery leftJoinMiseEnAvant($relationAlias = null) Adds a LEFT JOIN clause to the query using the MiseEnAvant relation
 * @method MiseEnAvantI18nQuery rightJoinMiseEnAvant($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MiseEnAvant relation
 * @method MiseEnAvantI18nQuery innerJoinMiseEnAvant($relationAlias = null) Adds a INNER JOIN clause to the query using the MiseEnAvant relation
 *
 * @method MiseEnAvantI18n findOne(PropelPDO $con = null) Return the first MiseEnAvantI18n matching the query
 * @method MiseEnAvantI18n findOneOrCreate(PropelPDO $con = null) Return the first MiseEnAvantI18n matching the query, or a new MiseEnAvantI18n object populated from the query conditions when no match is found
 *
 * @method MiseEnAvantI18n findOneById(int $id) Return the first MiseEnAvantI18n filtered by the id column
 * @method MiseEnAvantI18n findOneByLocale(string $locale) Return the first MiseEnAvantI18n filtered by the locale column
 * @method MiseEnAvantI18n findOneByTitre(string $titre) Return the first MiseEnAvantI18n filtered by the titre column
 * @method MiseEnAvantI18n findOneByAccroche(string $accroche) Return the first MiseEnAvantI18n filtered by the accroche column
 * @method MiseEnAvantI18n findOneByLien(string $lien) Return the first MiseEnAvantI18n filtered by the lien column
 * @method MiseEnAvantI18n findOneByTitreLien(string $titre_lien) Return the first MiseEnAvantI18n filtered by the titre_lien column
 * @method MiseEnAvantI18n findOneBySeoTitle(string $seo_title) Return the first MiseEnAvantI18n filtered by the seo_title column
 * @method MiseEnAvantI18n findOneBySeoDescription(string $seo_description) Return the first MiseEnAvantI18n filtered by the seo_description column
 * @method MiseEnAvantI18n findOneBySeoH1(string $seo_h1) Return the first MiseEnAvantI18n filtered by the seo_h1 column
 * @method MiseEnAvantI18n findOneBySeoKeywords(string $seo_keywords) Return the first MiseEnAvantI18n filtered by the seo_keywords column
 * @method MiseEnAvantI18n findOneByActiveLocale(boolean $active_locale) Return the first MiseEnAvantI18n filtered by the active_locale column
 *
 * @method array findById(int $id) Return MiseEnAvantI18n objects filtered by the id column
 * @method array findByLocale(string $locale) Return MiseEnAvantI18n objects filtered by the locale column
 * @method array findByTitre(string $titre) Return MiseEnAvantI18n objects filtered by the titre column
 * @method array findByAccroche(string $accroche) Return MiseEnAvantI18n objects filtered by the accroche column
 * @method array findByLien(string $lien) Return MiseEnAvantI18n objects filtered by the lien column
 * @method array findByTitreLien(string $titre_lien) Return MiseEnAvantI18n objects filtered by the titre_lien column
 * @method array findBySeoTitle(string $seo_title) Return MiseEnAvantI18n objects filtered by the seo_title column
 * @method array findBySeoDescription(string $seo_description) Return MiseEnAvantI18n objects filtered by the seo_description column
 * @method array findBySeoH1(string $seo_h1) Return MiseEnAvantI18n objects filtered by the seo_h1 column
 * @method array findBySeoKeywords(string $seo_keywords) Return MiseEnAvantI18n objects filtered by the seo_keywords column
 * @method array findByActiveLocale(boolean $active_locale) Return MiseEnAvantI18n objects filtered by the active_locale column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseMiseEnAvantI18nQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseMiseEnAvantI18nQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\MiseEnAvantI18n', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new MiseEnAvantI18nQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     MiseEnAvantI18nQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return MiseEnAvantI18nQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof MiseEnAvantI18nQuery) {
            return $criteria;
        }
        $query = new MiseEnAvantI18nQuery();
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
     * @return   MiseEnAvantI18n|MiseEnAvantI18n[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = MiseEnAvantI18nPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(MiseEnAvantI18nPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   MiseEnAvantI18n A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `locale`, `titre`, `accroche`, `lien`, `titre_lien`, `seo_title`, `seo_description`, `seo_h1`, `seo_keywords`, `active_locale` FROM `mise_en_avant_i18n` WHERE `id` = :p0 AND `locale` = :p1';
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
            $obj = new MiseEnAvantI18n();
            $obj->hydrate($row);
            MiseEnAvantI18nPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return MiseEnAvantI18n|MiseEnAvantI18n[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|MiseEnAvantI18n[]|mixed the list of results, formatted by the current formatter
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
     * @return MiseEnAvantI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(MiseEnAvantI18nPeer::ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(MiseEnAvantI18nPeer::LOCALE, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return MiseEnAvantI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(MiseEnAvantI18nPeer::ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(MiseEnAvantI18nPeer::LOCALE, $key[1], Criteria::EQUAL);
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
     * @see       filterByMiseEnAvant()
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return MiseEnAvantI18nQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(MiseEnAvantI18nPeer::ID, $id, $comparison);
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
     * @return MiseEnAvantI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(MiseEnAvantI18nPeer::LOCALE, $locale, $comparison);
    }

    /**
     * Filter the query on the titre column
     *
     * Example usage:
     * <code>
     * $query->filterByTitre('fooValue');   // WHERE titre = 'fooValue'
     * $query->filterByTitre('%fooValue%'); // WHERE titre LIKE '%fooValue%'
     * </code>
     *
     * @param     string $titre The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return MiseEnAvantI18nQuery The current query, for fluid interface
     */
    public function filterByTitre($titre = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($titre)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $titre)) {
                $titre = str_replace('*', '%', $titre);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MiseEnAvantI18nPeer::TITRE, $titre, $comparison);
    }

    /**
     * Filter the query on the accroche column
     *
     * Example usage:
     * <code>
     * $query->filterByAccroche('fooValue');   // WHERE accroche = 'fooValue'
     * $query->filterByAccroche('%fooValue%'); // WHERE accroche LIKE '%fooValue%'
     * </code>
     *
     * @param     string $accroche The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return MiseEnAvantI18nQuery The current query, for fluid interface
     */
    public function filterByAccroche($accroche = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($accroche)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $accroche)) {
                $accroche = str_replace('*', '%', $accroche);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MiseEnAvantI18nPeer::ACCROCHE, $accroche, $comparison);
    }

    /**
     * Filter the query on the lien column
     *
     * Example usage:
     * <code>
     * $query->filterByLien('fooValue');   // WHERE lien = 'fooValue'
     * $query->filterByLien('%fooValue%'); // WHERE lien LIKE '%fooValue%'
     * </code>
     *
     * @param     string $lien The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return MiseEnAvantI18nQuery The current query, for fluid interface
     */
    public function filterByLien($lien = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lien)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $lien)) {
                $lien = str_replace('*', '%', $lien);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MiseEnAvantI18nPeer::LIEN, $lien, $comparison);
    }

    /**
     * Filter the query on the titre_lien column
     *
     * Example usage:
     * <code>
     * $query->filterByTitreLien('fooValue');   // WHERE titre_lien = 'fooValue'
     * $query->filterByTitreLien('%fooValue%'); // WHERE titre_lien LIKE '%fooValue%'
     * </code>
     *
     * @param     string $titreLien The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return MiseEnAvantI18nQuery The current query, for fluid interface
     */
    public function filterByTitreLien($titreLien = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($titreLien)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $titreLien)) {
                $titreLien = str_replace('*', '%', $titreLien);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MiseEnAvantI18nPeer::TITRE_LIEN, $titreLien, $comparison);
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
     * @return MiseEnAvantI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(MiseEnAvantI18nPeer::SEO_TITLE, $seoTitle, $comparison);
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
     * @return MiseEnAvantI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(MiseEnAvantI18nPeer::SEO_DESCRIPTION, $seoDescription, $comparison);
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
     * @return MiseEnAvantI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(MiseEnAvantI18nPeer::SEO_H1, $seoH1, $comparison);
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
     * @return MiseEnAvantI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(MiseEnAvantI18nPeer::SEO_KEYWORDS, $seoKeywords, $comparison);
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
     * @return MiseEnAvantI18nQuery The current query, for fluid interface
     */
    public function filterByActiveLocale($activeLocale = null, $comparison = null)
    {
        if (is_string($activeLocale)) {
            $active_locale = in_array(strtolower($activeLocale), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(MiseEnAvantI18nPeer::ACTIVE_LOCALE, $activeLocale, $comparison);
    }

    /**
     * Filter the query by a related MiseEnAvant object
     *
     * @param   MiseEnAvant|PropelObjectCollection $miseEnAvant The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   MiseEnAvantI18nQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByMiseEnAvant($miseEnAvant, $comparison = null)
    {
        if ($miseEnAvant instanceof MiseEnAvant) {
            return $this
                ->addUsingAlias(MiseEnAvantI18nPeer::ID, $miseEnAvant->getId(), $comparison);
        } elseif ($miseEnAvant instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(MiseEnAvantI18nPeer::ID, $miseEnAvant->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByMiseEnAvant() only accepts arguments of type MiseEnAvant or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the MiseEnAvant relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return MiseEnAvantI18nQuery The current query, for fluid interface
     */
    public function joinMiseEnAvant($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('MiseEnAvant');

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
            $this->addJoinObject($join, 'MiseEnAvant');
        }

        return $this;
    }

    /**
     * Use the MiseEnAvant relation MiseEnAvant object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\MiseEnAvantQuery A secondary query class using the current class as primary query
     */
    public function useMiseEnAvantQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinMiseEnAvant($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MiseEnAvant', '\Cungfoo\Model\MiseEnAvantQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   MiseEnAvantI18n $miseEnAvantI18n Object to remove from the list of results
     *
     * @return MiseEnAvantI18nQuery The current query, for fluid interface
     */
    public function prune($miseEnAvantI18n = null)
    {
        if ($miseEnAvantI18n) {
            $this->addCond('pruneCond0', $this->getAliasedColName(MiseEnAvantI18nPeer::ID), $miseEnAvantI18n->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(MiseEnAvantI18nPeer::LOCALE), $miseEnAvantI18n->getLocale(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
