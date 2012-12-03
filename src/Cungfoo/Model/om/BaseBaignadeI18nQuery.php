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
use Cungfoo\Model\Baignade;
use Cungfoo\Model\BaignadeI18n;
use Cungfoo\Model\BaignadeI18nPeer;
use Cungfoo\Model\BaignadeI18nQuery;

/**
 * Base class that represents a query for the 'baignade_i18n' table.
 *
 *
 *
 * @method BaignadeI18nQuery orderById($order = Criteria::ASC) Order by the id column
 * @method BaignadeI18nQuery orderByLocale($order = Criteria::ASC) Order by the locale column
 * @method BaignadeI18nQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method BaignadeI18nQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method BaignadeI18nQuery orderByKeywords($order = Criteria::ASC) Order by the keywords column
 *
 * @method BaignadeI18nQuery groupById() Group by the id column
 * @method BaignadeI18nQuery groupByLocale() Group by the locale column
 * @method BaignadeI18nQuery groupByName() Group by the name column
 * @method BaignadeI18nQuery groupByDescription() Group by the description column
 * @method BaignadeI18nQuery groupByKeywords() Group by the keywords column
 *
 * @method BaignadeI18nQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method BaignadeI18nQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method BaignadeI18nQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method BaignadeI18nQuery leftJoinBaignade($relationAlias = null) Adds a LEFT JOIN clause to the query using the Baignade relation
 * @method BaignadeI18nQuery rightJoinBaignade($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Baignade relation
 * @method BaignadeI18nQuery innerJoinBaignade($relationAlias = null) Adds a INNER JOIN clause to the query using the Baignade relation
 *
 * @method BaignadeI18n findOne(PropelPDO $con = null) Return the first BaignadeI18n matching the query
 * @method BaignadeI18n findOneOrCreate(PropelPDO $con = null) Return the first BaignadeI18n matching the query, or a new BaignadeI18n object populated from the query conditions when no match is found
 *
 * @method BaignadeI18n findOneById(int $id) Return the first BaignadeI18n filtered by the id column
 * @method BaignadeI18n findOneByLocale(string $locale) Return the first BaignadeI18n filtered by the locale column
 * @method BaignadeI18n findOneByName(string $name) Return the first BaignadeI18n filtered by the name column
 * @method BaignadeI18n findOneByDescription(string $description) Return the first BaignadeI18n filtered by the description column
 * @method BaignadeI18n findOneByKeywords(string $keywords) Return the first BaignadeI18n filtered by the keywords column
 *
 * @method array findById(int $id) Return BaignadeI18n objects filtered by the id column
 * @method array findByLocale(string $locale) Return BaignadeI18n objects filtered by the locale column
 * @method array findByName(string $name) Return BaignadeI18n objects filtered by the name column
 * @method array findByDescription(string $description) Return BaignadeI18n objects filtered by the description column
 * @method array findByKeywords(string $keywords) Return BaignadeI18n objects filtered by the keywords column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseBaignadeI18nQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseBaignadeI18nQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\BaignadeI18n', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new BaignadeI18nQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     BaignadeI18nQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return BaignadeI18nQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof BaignadeI18nQuery) {
            return $criteria;
        }
        $query = new BaignadeI18nQuery();
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
     * @return   BaignadeI18n|BaignadeI18n[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = BaignadeI18nPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(BaignadeI18nPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   BaignadeI18n A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `LOCALE`, `NAME`, `DESCRIPTION`, `KEYWORDS` FROM `baignade_i18n` WHERE `ID` = :p0 AND `LOCALE` = :p1';
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
            $obj = new BaignadeI18n();
            $obj->hydrate($row);
            BaignadeI18nPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return BaignadeI18n|BaignadeI18n[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|BaignadeI18n[]|mixed the list of results, formatted by the current formatter
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
     * @return BaignadeI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(BaignadeI18nPeer::ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(BaignadeI18nPeer::LOCALE, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return BaignadeI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(BaignadeI18nPeer::ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(BaignadeI18nPeer::LOCALE, $key[1], Criteria::EQUAL);
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
     * @see       filterByBaignade()
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BaignadeI18nQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(BaignadeI18nPeer::ID, $id, $comparison);
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
     * @return BaignadeI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(BaignadeI18nPeer::LOCALE, $locale, $comparison);
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
     * @return BaignadeI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(BaignadeI18nPeer::NAME, $name, $comparison);
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
     * @return BaignadeI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(BaignadeI18nPeer::DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the keywords column
     *
     * Example usage:
     * <code>
     * $query->filterByKeywords('fooValue');   // WHERE keywords = 'fooValue'
     * $query->filterByKeywords('%fooValue%'); // WHERE keywords LIKE '%fooValue%'
     * </code>
     *
     * @param     string $keywords The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BaignadeI18nQuery The current query, for fluid interface
     */
    public function filterByKeywords($keywords = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($keywords)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $keywords)) {
                $keywords = str_replace('*', '%', $keywords);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(BaignadeI18nPeer::KEYWORDS, $keywords, $comparison);
    }

    /**
     * Filter the query by a related Baignade object
     *
     * @param   Baignade|PropelObjectCollection $baignade The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   BaignadeI18nQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByBaignade($baignade, $comparison = null)
    {
        if ($baignade instanceof Baignade) {
            return $this
                ->addUsingAlias(BaignadeI18nPeer::ID, $baignade->getId(), $comparison);
        } elseif ($baignade instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BaignadeI18nPeer::ID, $baignade->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByBaignade() only accepts arguments of type Baignade or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Baignade relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return BaignadeI18nQuery The current query, for fluid interface
     */
    public function joinBaignade($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Baignade');

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
            $this->addJoinObject($join, 'Baignade');
        }

        return $this;
    }

    /**
     * Use the Baignade relation Baignade object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\BaignadeQuery A secondary query class using the current class as primary query
     */
    public function useBaignadeQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinBaignade($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Baignade', '\Cungfoo\Model\BaignadeQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   BaignadeI18n $baignadeI18n Object to remove from the list of results
     *
     * @return BaignadeI18nQuery The current query, for fluid interface
     */
    public function prune($baignadeI18n = null)
    {
        if ($baignadeI18n) {
            $this->addCond('pruneCond0', $this->getAliasedColName(BaignadeI18nPeer::ID), $baignadeI18n->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(BaignadeI18nPeer::LOCALE), $baignadeI18n->getLocale(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
