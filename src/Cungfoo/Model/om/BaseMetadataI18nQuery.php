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
use Cungfoo\Model\Metadata;
use Cungfoo\Model\MetadataI18n;
use Cungfoo\Model\MetadataI18nPeer;
use Cungfoo\Model\MetadataI18nQuery;

/**
 * Base class that represents a query for the 'metadata_i18n' table.
 *
 *
 *
 * @method MetadataI18nQuery orderById($order = Criteria::ASC) Order by the id column
 * @method MetadataI18nQuery orderByLocale($order = Criteria::ASC) Order by the locale column
 * @method MetadataI18nQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method MetadataI18nQuery orderBySubtitle($order = Criteria::ASC) Order by the subtitle column
 * @method MetadataI18nQuery orderByAccroche($order = Criteria::ASC) Order by the accroche column
 * @method MetadataI18nQuery orderBySeoTitle($order = Criteria::ASC) Order by the seo_title column
 * @method MetadataI18nQuery orderBySeoDescription($order = Criteria::ASC) Order by the seo_description column
 * @method MetadataI18nQuery orderBySeoH1($order = Criteria::ASC) Order by the seo_h1 column
 * @method MetadataI18nQuery orderBySeoKeywords($order = Criteria::ASC) Order by the seo_keywords column
 *
 * @method MetadataI18nQuery groupById() Group by the id column
 * @method MetadataI18nQuery groupByLocale() Group by the locale column
 * @method MetadataI18nQuery groupByTitle() Group by the title column
 * @method MetadataI18nQuery groupBySubtitle() Group by the subtitle column
 * @method MetadataI18nQuery groupByAccroche() Group by the accroche column
 * @method MetadataI18nQuery groupBySeoTitle() Group by the seo_title column
 * @method MetadataI18nQuery groupBySeoDescription() Group by the seo_description column
 * @method MetadataI18nQuery groupBySeoH1() Group by the seo_h1 column
 * @method MetadataI18nQuery groupBySeoKeywords() Group by the seo_keywords column
 *
 * @method MetadataI18nQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method MetadataI18nQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method MetadataI18nQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method MetadataI18nQuery leftJoinMetadata($relationAlias = null) Adds a LEFT JOIN clause to the query using the Metadata relation
 * @method MetadataI18nQuery rightJoinMetadata($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Metadata relation
 * @method MetadataI18nQuery innerJoinMetadata($relationAlias = null) Adds a INNER JOIN clause to the query using the Metadata relation
 *
 * @method MetadataI18n findOne(PropelPDO $con = null) Return the first MetadataI18n matching the query
 * @method MetadataI18n findOneOrCreate(PropelPDO $con = null) Return the first MetadataI18n matching the query, or a new MetadataI18n object populated from the query conditions when no match is found
 *
 * @method MetadataI18n findOneById(int $id) Return the first MetadataI18n filtered by the id column
 * @method MetadataI18n findOneByLocale(string $locale) Return the first MetadataI18n filtered by the locale column
 * @method MetadataI18n findOneByTitle(string $title) Return the first MetadataI18n filtered by the title column
 * @method MetadataI18n findOneBySubtitle(string $subtitle) Return the first MetadataI18n filtered by the subtitle column
 * @method MetadataI18n findOneByAccroche(string $accroche) Return the first MetadataI18n filtered by the accroche column
 * @method MetadataI18n findOneBySeoTitle(string $seo_title) Return the first MetadataI18n filtered by the seo_title column
 * @method MetadataI18n findOneBySeoDescription(string $seo_description) Return the first MetadataI18n filtered by the seo_description column
 * @method MetadataI18n findOneBySeoH1(string $seo_h1) Return the first MetadataI18n filtered by the seo_h1 column
 * @method MetadataI18n findOneBySeoKeywords(string $seo_keywords) Return the first MetadataI18n filtered by the seo_keywords column
 *
 * @method array findById(int $id) Return MetadataI18n objects filtered by the id column
 * @method array findByLocale(string $locale) Return MetadataI18n objects filtered by the locale column
 * @method array findByTitle(string $title) Return MetadataI18n objects filtered by the title column
 * @method array findBySubtitle(string $subtitle) Return MetadataI18n objects filtered by the subtitle column
 * @method array findByAccroche(string $accroche) Return MetadataI18n objects filtered by the accroche column
 * @method array findBySeoTitle(string $seo_title) Return MetadataI18n objects filtered by the seo_title column
 * @method array findBySeoDescription(string $seo_description) Return MetadataI18n objects filtered by the seo_description column
 * @method array findBySeoH1(string $seo_h1) Return MetadataI18n objects filtered by the seo_h1 column
 * @method array findBySeoKeywords(string $seo_keywords) Return MetadataI18n objects filtered by the seo_keywords column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseMetadataI18nQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseMetadataI18nQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\MetadataI18n', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new MetadataI18nQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     MetadataI18nQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return MetadataI18nQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof MetadataI18nQuery) {
            return $criteria;
        }
        $query = new MetadataI18nQuery();
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
     * @return   MetadataI18n|MetadataI18n[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = MetadataI18nPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(MetadataI18nPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   MetadataI18n A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `locale`, `title`, `subtitle`, `accroche`, `seo_title`, `seo_description`, `seo_h1`, `seo_keywords` FROM `metadata_i18n` WHERE `id` = :p0 AND `locale` = :p1';
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
            $obj = new MetadataI18n();
            $obj->hydrate($row);
            MetadataI18nPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return MetadataI18n|MetadataI18n[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|MetadataI18n[]|mixed the list of results, formatted by the current formatter
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
     * @return MetadataI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(MetadataI18nPeer::ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(MetadataI18nPeer::LOCALE, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return MetadataI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(MetadataI18nPeer::ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(MetadataI18nPeer::LOCALE, $key[1], Criteria::EQUAL);
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
     * @see       filterByMetadata()
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return MetadataI18nQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(MetadataI18nPeer::ID, $id, $comparison);
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
     * @return MetadataI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(MetadataI18nPeer::LOCALE, $locale, $comparison);
    }

    /**
     * Filter the query on the title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
     * $query->filterByTitle('%fooValue%'); // WHERE title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $title The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return MetadataI18nQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $title)) {
                $title = str_replace('*', '%', $title);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MetadataI18nPeer::TITLE, $title, $comparison);
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
     * @return MetadataI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(MetadataI18nPeer::SUBTITLE, $subtitle, $comparison);
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
     * @return MetadataI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(MetadataI18nPeer::ACCROCHE, $accroche, $comparison);
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
     * @return MetadataI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(MetadataI18nPeer::SEO_TITLE, $seoTitle, $comparison);
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
     * @return MetadataI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(MetadataI18nPeer::SEO_DESCRIPTION, $seoDescription, $comparison);
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
     * @return MetadataI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(MetadataI18nPeer::SEO_H1, $seoH1, $comparison);
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
     * @return MetadataI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(MetadataI18nPeer::SEO_KEYWORDS, $seoKeywords, $comparison);
    }

    /**
     * Filter the query by a related Metadata object
     *
     * @param   Metadata|PropelObjectCollection $metadata The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   MetadataI18nQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByMetadata($metadata, $comparison = null)
    {
        if ($metadata instanceof Metadata) {
            return $this
                ->addUsingAlias(MetadataI18nPeer::ID, $metadata->getId(), $comparison);
        } elseif ($metadata instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(MetadataI18nPeer::ID, $metadata->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByMetadata() only accepts arguments of type Metadata or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Metadata relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return MetadataI18nQuery The current query, for fluid interface
     */
    public function joinMetadata($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Metadata');

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
            $this->addJoinObject($join, 'Metadata');
        }

        return $this;
    }

    /**
     * Use the Metadata relation Metadata object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\MetadataQuery A secondary query class using the current class as primary query
     */
    public function useMetadataQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinMetadata($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Metadata', '\Cungfoo\Model\MetadataQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   MetadataI18n $metadataI18n Object to remove from the list of results
     *
     * @return MetadataI18nQuery The current query, for fluid interface
     */
    public function prune($metadataI18n = null)
    {
        if ($metadataI18n) {
            $this->addCond('pruneCond0', $this->getAliasedColName(MetadataI18nPeer::ID), $metadataI18n->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(MetadataI18nPeer::LOCALE), $metadataI18n->getLocale(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
