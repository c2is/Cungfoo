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
use Cungfoo\Model\BonPlan;
use Cungfoo\Model\BonPlanI18n;
use Cungfoo\Model\BonPlanI18nPeer;
use Cungfoo\Model\BonPlanI18nQuery;

/**
 * Base class that represents a query for the 'bon_plan_i18n' table.
 *
 *
 *
 * @method BonPlanI18nQuery orderById($order = Criteria::ASC) Order by the id column
 * @method BonPlanI18nQuery orderByLocale($order = Criteria::ASC) Order by the locale column
 * @method BonPlanI18nQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method BonPlanI18nQuery orderBySlug($order = Criteria::ASC) Order by the slug column
 * @method BonPlanI18nQuery orderByIntroduction($order = Criteria::ASC) Order by the introduction column
 * @method BonPlanI18nQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method BonPlanI18nQuery orderByIndice($order = Criteria::ASC) Order by the indice column
 * @method BonPlanI18nQuery orderByIndicePrix($order = Criteria::ASC) Order by the indice_prix column
 *
 * @method BonPlanI18nQuery groupById() Group by the id column
 * @method BonPlanI18nQuery groupByLocale() Group by the locale column
 * @method BonPlanI18nQuery groupByName() Group by the name column
 * @method BonPlanI18nQuery groupBySlug() Group by the slug column
 * @method BonPlanI18nQuery groupByIntroduction() Group by the introduction column
 * @method BonPlanI18nQuery groupByDescription() Group by the description column
 * @method BonPlanI18nQuery groupByIndice() Group by the indice column
 * @method BonPlanI18nQuery groupByIndicePrix() Group by the indice_prix column
 *
 * @method BonPlanI18nQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method BonPlanI18nQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method BonPlanI18nQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method BonPlanI18nQuery leftJoinBonPlan($relationAlias = null) Adds a LEFT JOIN clause to the query using the BonPlan relation
 * @method BonPlanI18nQuery rightJoinBonPlan($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BonPlan relation
 * @method BonPlanI18nQuery innerJoinBonPlan($relationAlias = null) Adds a INNER JOIN clause to the query using the BonPlan relation
 *
 * @method BonPlanI18n findOne(PropelPDO $con = null) Return the first BonPlanI18n matching the query
 * @method BonPlanI18n findOneOrCreate(PropelPDO $con = null) Return the first BonPlanI18n matching the query, or a new BonPlanI18n object populated from the query conditions when no match is found
 *
 * @method BonPlanI18n findOneById(int $id) Return the first BonPlanI18n filtered by the id column
 * @method BonPlanI18n findOneByLocale(string $locale) Return the first BonPlanI18n filtered by the locale column
 * @method BonPlanI18n findOneByName(string $name) Return the first BonPlanI18n filtered by the name column
 * @method BonPlanI18n findOneBySlug(string $slug) Return the first BonPlanI18n filtered by the slug column
 * @method BonPlanI18n findOneByIntroduction(string $introduction) Return the first BonPlanI18n filtered by the introduction column
 * @method BonPlanI18n findOneByDescription(string $description) Return the first BonPlanI18n filtered by the description column
 * @method BonPlanI18n findOneByIndice(string $indice) Return the first BonPlanI18n filtered by the indice column
 * @method BonPlanI18n findOneByIndicePrix(string $indice_prix) Return the first BonPlanI18n filtered by the indice_prix column
 *
 * @method array findById(int $id) Return BonPlanI18n objects filtered by the id column
 * @method array findByLocale(string $locale) Return BonPlanI18n objects filtered by the locale column
 * @method array findByName(string $name) Return BonPlanI18n objects filtered by the name column
 * @method array findBySlug(string $slug) Return BonPlanI18n objects filtered by the slug column
 * @method array findByIntroduction(string $introduction) Return BonPlanI18n objects filtered by the introduction column
 * @method array findByDescription(string $description) Return BonPlanI18n objects filtered by the description column
 * @method array findByIndice(string $indice) Return BonPlanI18n objects filtered by the indice column
 * @method array findByIndicePrix(string $indice_prix) Return BonPlanI18n objects filtered by the indice_prix column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseBonPlanI18nQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseBonPlanI18nQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\BonPlanI18n', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new BonPlanI18nQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     BonPlanI18nQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return BonPlanI18nQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof BonPlanI18nQuery) {
            return $criteria;
        }
        $query = new BonPlanI18nQuery();
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
     * @return   BonPlanI18n|BonPlanI18n[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = BonPlanI18nPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(BonPlanI18nPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   BonPlanI18n A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `locale`, `name`, `slug`, `introduction`, `description`, `indice`, `indice_prix` FROM `bon_plan_i18n` WHERE `id` = :p0 AND `locale` = :p1';
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
            $obj = new BonPlanI18n();
            $obj->hydrate($row);
            BonPlanI18nPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return BonPlanI18n|BonPlanI18n[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|BonPlanI18n[]|mixed the list of results, formatted by the current formatter
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
     * @return BonPlanI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(BonPlanI18nPeer::ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(BonPlanI18nPeer::LOCALE, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return BonPlanI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(BonPlanI18nPeer::ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(BonPlanI18nPeer::LOCALE, $key[1], Criteria::EQUAL);
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
     * @see       filterByBonPlan()
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BonPlanI18nQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(BonPlanI18nPeer::ID, $id, $comparison);
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
     * @return BonPlanI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(BonPlanI18nPeer::LOCALE, $locale, $comparison);
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
     * @return BonPlanI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(BonPlanI18nPeer::NAME, $name, $comparison);
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
     * @return BonPlanI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(BonPlanI18nPeer::SLUG, $slug, $comparison);
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
     * @return BonPlanI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(BonPlanI18nPeer::INTRODUCTION, $introduction, $comparison);
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
     * @return BonPlanI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(BonPlanI18nPeer::DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the indice column
     *
     * Example usage:
     * <code>
     * $query->filterByIndice('fooValue');   // WHERE indice = 'fooValue'
     * $query->filterByIndice('%fooValue%'); // WHERE indice LIKE '%fooValue%'
     * </code>
     *
     * @param     string $indice The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BonPlanI18nQuery The current query, for fluid interface
     */
    public function filterByIndice($indice = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($indice)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $indice)) {
                $indice = str_replace('*', '%', $indice);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(BonPlanI18nPeer::INDICE, $indice, $comparison);
    }

    /**
     * Filter the query on the indice_prix column
     *
     * Example usage:
     * <code>
     * $query->filterByIndicePrix('fooValue');   // WHERE indice_prix = 'fooValue'
     * $query->filterByIndicePrix('%fooValue%'); // WHERE indice_prix LIKE '%fooValue%'
     * </code>
     *
     * @param     string $indicePrix The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BonPlanI18nQuery The current query, for fluid interface
     */
    public function filterByIndicePrix($indicePrix = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($indicePrix)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $indicePrix)) {
                $indicePrix = str_replace('*', '%', $indicePrix);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(BonPlanI18nPeer::INDICE_PRIX, $indicePrix, $comparison);
    }

    /**
     * Filter the query by a related BonPlan object
     *
     * @param   BonPlan|PropelObjectCollection $bonPlan The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   BonPlanI18nQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByBonPlan($bonPlan, $comparison = null)
    {
        if ($bonPlan instanceof BonPlan) {
            return $this
                ->addUsingAlias(BonPlanI18nPeer::ID, $bonPlan->getId(), $comparison);
        } elseif ($bonPlan instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BonPlanI18nPeer::ID, $bonPlan->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByBonPlan() only accepts arguments of type BonPlan or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BonPlan relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return BonPlanI18nQuery The current query, for fluid interface
     */
    public function joinBonPlan($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BonPlan');

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
            $this->addJoinObject($join, 'BonPlan');
        }

        return $this;
    }

    /**
     * Use the BonPlan relation BonPlan object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\BonPlanQuery A secondary query class using the current class as primary query
     */
    public function useBonPlanQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinBonPlan($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BonPlan', '\Cungfoo\Model\BonPlanQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   BonPlanI18n $bonPlanI18n Object to remove from the list of results
     *
     * @return BonPlanI18nQuery The current query, for fluid interface
     */
    public function prune($bonPlanI18n = null)
    {
        if ($bonPlanI18n) {
            $this->addCond('pruneCond0', $this->getAliasedColName(BonPlanI18nPeer::ID), $bonPlanI18n->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(BonPlanI18nPeer::LOCALE), $bonPlanI18n->getLocale(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}