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
use Cungfoo\Model\VosVacances;
use Cungfoo\Model\VosVacancesI18n;
use Cungfoo\Model\VosVacancesI18nPeer;
use Cungfoo\Model\VosVacancesI18nQuery;

/**
 * Base class that represents a query for the 'vos_vacances_i18n' table.
 *
 *
 *
 * @method VosVacancesI18nQuery orderById($order = Criteria::ASC) Order by the id column
 * @method VosVacancesI18nQuery orderByLocale($order = Criteria::ASC) Order by the locale column
 * @method VosVacancesI18nQuery orderByTitre($order = Criteria::ASC) Order by the titre column
 * @method VosVacancesI18nQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method VosVacancesI18nQuery orderByPrenom($order = Criteria::ASC) Order by the prenom column
 * @method VosVacancesI18nQuery orderBySeoTitle($order = Criteria::ASC) Order by the seo_title column
 * @method VosVacancesI18nQuery orderBySeoDescription($order = Criteria::ASC) Order by the seo_description column
 * @method VosVacancesI18nQuery orderBySeoH1($order = Criteria::ASC) Order by the seo_h1 column
 * @method VosVacancesI18nQuery orderBySeoKeywords($order = Criteria::ASC) Order by the seo_keywords column
 * @method VosVacancesI18nQuery orderByActiveLocale($order = Criteria::ASC) Order by the active_locale column
 *
 * @method VosVacancesI18nQuery groupById() Group by the id column
 * @method VosVacancesI18nQuery groupByLocale() Group by the locale column
 * @method VosVacancesI18nQuery groupByTitre() Group by the titre column
 * @method VosVacancesI18nQuery groupByDescription() Group by the description column
 * @method VosVacancesI18nQuery groupByPrenom() Group by the prenom column
 * @method VosVacancesI18nQuery groupBySeoTitle() Group by the seo_title column
 * @method VosVacancesI18nQuery groupBySeoDescription() Group by the seo_description column
 * @method VosVacancesI18nQuery groupBySeoH1() Group by the seo_h1 column
 * @method VosVacancesI18nQuery groupBySeoKeywords() Group by the seo_keywords column
 * @method VosVacancesI18nQuery groupByActiveLocale() Group by the active_locale column
 *
 * @method VosVacancesI18nQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method VosVacancesI18nQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method VosVacancesI18nQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method VosVacancesI18nQuery leftJoinVosVacances($relationAlias = null) Adds a LEFT JOIN clause to the query using the VosVacances relation
 * @method VosVacancesI18nQuery rightJoinVosVacances($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VosVacances relation
 * @method VosVacancesI18nQuery innerJoinVosVacances($relationAlias = null) Adds a INNER JOIN clause to the query using the VosVacances relation
 *
 * @method VosVacancesI18n findOne(PropelPDO $con = null) Return the first VosVacancesI18n matching the query
 * @method VosVacancesI18n findOneOrCreate(PropelPDO $con = null) Return the first VosVacancesI18n matching the query, or a new VosVacancesI18n object populated from the query conditions when no match is found
 *
 * @method VosVacancesI18n findOneById(int $id) Return the first VosVacancesI18n filtered by the id column
 * @method VosVacancesI18n findOneByLocale(string $locale) Return the first VosVacancesI18n filtered by the locale column
 * @method VosVacancesI18n findOneByTitre(string $titre) Return the first VosVacancesI18n filtered by the titre column
 * @method VosVacancesI18n findOneByDescription(string $description) Return the first VosVacancesI18n filtered by the description column
 * @method VosVacancesI18n findOneByPrenom(string $prenom) Return the first VosVacancesI18n filtered by the prenom column
 * @method VosVacancesI18n findOneBySeoTitle(string $seo_title) Return the first VosVacancesI18n filtered by the seo_title column
 * @method VosVacancesI18n findOneBySeoDescription(string $seo_description) Return the first VosVacancesI18n filtered by the seo_description column
 * @method VosVacancesI18n findOneBySeoH1(string $seo_h1) Return the first VosVacancesI18n filtered by the seo_h1 column
 * @method VosVacancesI18n findOneBySeoKeywords(string $seo_keywords) Return the first VosVacancesI18n filtered by the seo_keywords column
 * @method VosVacancesI18n findOneByActiveLocale(boolean $active_locale) Return the first VosVacancesI18n filtered by the active_locale column
 *
 * @method array findById(int $id) Return VosVacancesI18n objects filtered by the id column
 * @method array findByLocale(string $locale) Return VosVacancesI18n objects filtered by the locale column
 * @method array findByTitre(string $titre) Return VosVacancesI18n objects filtered by the titre column
 * @method array findByDescription(string $description) Return VosVacancesI18n objects filtered by the description column
 * @method array findByPrenom(string $prenom) Return VosVacancesI18n objects filtered by the prenom column
 * @method array findBySeoTitle(string $seo_title) Return VosVacancesI18n objects filtered by the seo_title column
 * @method array findBySeoDescription(string $seo_description) Return VosVacancesI18n objects filtered by the seo_description column
 * @method array findBySeoH1(string $seo_h1) Return VosVacancesI18n objects filtered by the seo_h1 column
 * @method array findBySeoKeywords(string $seo_keywords) Return VosVacancesI18n objects filtered by the seo_keywords column
 * @method array findByActiveLocale(boolean $active_locale) Return VosVacancesI18n objects filtered by the active_locale column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseVosVacancesI18nQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseVosVacancesI18nQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\VosVacancesI18n', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new VosVacancesI18nQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     VosVacancesI18nQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return VosVacancesI18nQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof VosVacancesI18nQuery) {
            return $criteria;
        }
        $query = new VosVacancesI18nQuery();
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
     * @return   VosVacancesI18n|VosVacancesI18n[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = VosVacancesI18nPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(VosVacancesI18nPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   VosVacancesI18n A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `locale`, `titre`, `description`, `prenom`, `seo_title`, `seo_description`, `seo_h1`, `seo_keywords`, `active_locale` FROM `vos_vacances_i18n` WHERE `id` = :p0 AND `locale` = :p1';
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
            $obj = new VosVacancesI18n();
            $obj->hydrate($row);
            VosVacancesI18nPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return VosVacancesI18n|VosVacancesI18n[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|VosVacancesI18n[]|mixed the list of results, formatted by the current formatter
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
     * @return VosVacancesI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(VosVacancesI18nPeer::ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(VosVacancesI18nPeer::LOCALE, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return VosVacancesI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(VosVacancesI18nPeer::ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(VosVacancesI18nPeer::LOCALE, $key[1], Criteria::EQUAL);
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
     * @see       filterByVosVacances()
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return VosVacancesI18nQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(VosVacancesI18nPeer::ID, $id, $comparison);
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
     * @return VosVacancesI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(VosVacancesI18nPeer::LOCALE, $locale, $comparison);
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
     * @return VosVacancesI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(VosVacancesI18nPeer::TITRE, $titre, $comparison);
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
     * @return VosVacancesI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(VosVacancesI18nPeer::DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the prenom column
     *
     * Example usage:
     * <code>
     * $query->filterByPrenom('fooValue');   // WHERE prenom = 'fooValue'
     * $query->filterByPrenom('%fooValue%'); // WHERE prenom LIKE '%fooValue%'
     * </code>
     *
     * @param     string $prenom The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return VosVacancesI18nQuery The current query, for fluid interface
     */
    public function filterByPrenom($prenom = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($prenom)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $prenom)) {
                $prenom = str_replace('*', '%', $prenom);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(VosVacancesI18nPeer::PRENOM, $prenom, $comparison);
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
     * @return VosVacancesI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(VosVacancesI18nPeer::SEO_TITLE, $seoTitle, $comparison);
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
     * @return VosVacancesI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(VosVacancesI18nPeer::SEO_DESCRIPTION, $seoDescription, $comparison);
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
     * @return VosVacancesI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(VosVacancesI18nPeer::SEO_H1, $seoH1, $comparison);
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
     * @return VosVacancesI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(VosVacancesI18nPeer::SEO_KEYWORDS, $seoKeywords, $comparison);
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
     * @return VosVacancesI18nQuery The current query, for fluid interface
     */
    public function filterByActiveLocale($activeLocale = null, $comparison = null)
    {
        if (is_string($activeLocale)) {
            $active_locale = in_array(strtolower($activeLocale), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(VosVacancesI18nPeer::ACTIVE_LOCALE, $activeLocale, $comparison);
    }

    /**
     * Filter the query by a related VosVacances object
     *
     * @param   VosVacances|PropelObjectCollection $vosVacances The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   VosVacancesI18nQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByVosVacances($vosVacances, $comparison = null)
    {
        if ($vosVacances instanceof VosVacances) {
            return $this
                ->addUsingAlias(VosVacancesI18nPeer::ID, $vosVacances->getId(), $comparison);
        } elseif ($vosVacances instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(VosVacancesI18nPeer::ID, $vosVacances->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByVosVacances() only accepts arguments of type VosVacances or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the VosVacances relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return VosVacancesI18nQuery The current query, for fluid interface
     */
    public function joinVosVacances($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('VosVacances');

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
            $this->addJoinObject($join, 'VosVacances');
        }

        return $this;
    }

    /**
     * Use the VosVacances relation VosVacances object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\VosVacancesQuery A secondary query class using the current class as primary query
     */
    public function useVosVacancesQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinVosVacances($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'VosVacances', '\Cungfoo\Model\VosVacancesQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   VosVacancesI18n $vosVacancesI18n Object to remove from the list of results
     *
     * @return VosVacancesI18nQuery The current query, for fluid interface
     */
    public function prune($vosVacancesI18n = null)
    {
        if ($vosVacancesI18n) {
            $this->addCond('pruneCond0', $this->getAliasedColName(VosVacancesI18nPeer::ID), $vosVacancesI18n->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(VosVacancesI18nPeer::LOCALE), $vosVacancesI18n->getLocale(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
