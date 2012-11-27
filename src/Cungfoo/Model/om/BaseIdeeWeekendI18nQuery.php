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
use Cungfoo\Model\IdeeWeekend;
use Cungfoo\Model\IdeeWeekendI18n;
use Cungfoo\Model\IdeeWeekendI18nPeer;
use Cungfoo\Model\IdeeWeekendI18nQuery;

/**
 * Base class that represents a query for the 'idee_weekend_i18n' table.
 *
 *
 *
 * @method IdeeWeekendI18nQuery orderById($order = Criteria::ASC) Order by the id column
 * @method IdeeWeekendI18nQuery orderByLocale($order = Criteria::ASC) Order by the locale column
 * @method IdeeWeekendI18nQuery orderByTitre($order = Criteria::ASC) Order by the titre column
 *
 * @method IdeeWeekendI18nQuery groupById() Group by the id column
 * @method IdeeWeekendI18nQuery groupByLocale() Group by the locale column
 * @method IdeeWeekendI18nQuery groupByTitre() Group by the titre column
 *
 * @method IdeeWeekendI18nQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method IdeeWeekendI18nQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method IdeeWeekendI18nQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method IdeeWeekendI18nQuery leftJoinIdeeWeekend($relationAlias = null) Adds a LEFT JOIN clause to the query using the IdeeWeekend relation
 * @method IdeeWeekendI18nQuery rightJoinIdeeWeekend($relationAlias = null) Adds a RIGHT JOIN clause to the query using the IdeeWeekend relation
 * @method IdeeWeekendI18nQuery innerJoinIdeeWeekend($relationAlias = null) Adds a INNER JOIN clause to the query using the IdeeWeekend relation
 *
 * @method IdeeWeekendI18n findOne(PropelPDO $con = null) Return the first IdeeWeekendI18n matching the query
 * @method IdeeWeekendI18n findOneOrCreate(PropelPDO $con = null) Return the first IdeeWeekendI18n matching the query, or a new IdeeWeekendI18n object populated from the query conditions when no match is found
 *
 * @method IdeeWeekendI18n findOneById(int $id) Return the first IdeeWeekendI18n filtered by the id column
 * @method IdeeWeekendI18n findOneByLocale(string $locale) Return the first IdeeWeekendI18n filtered by the locale column
 * @method IdeeWeekendI18n findOneByTitre(string $titre) Return the first IdeeWeekendI18n filtered by the titre column
 *
 * @method array findById(int $id) Return IdeeWeekendI18n objects filtered by the id column
 * @method array findByLocale(string $locale) Return IdeeWeekendI18n objects filtered by the locale column
 * @method array findByTitre(string $titre) Return IdeeWeekendI18n objects filtered by the titre column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseIdeeWeekendI18nQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseIdeeWeekendI18nQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\IdeeWeekendI18n', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new IdeeWeekendI18nQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     IdeeWeekendI18nQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return IdeeWeekendI18nQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof IdeeWeekendI18nQuery) {
            return $criteria;
        }
        $query = new IdeeWeekendI18nQuery();
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
     * @return   IdeeWeekendI18n|IdeeWeekendI18n[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = IdeeWeekendI18nPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(IdeeWeekendI18nPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   IdeeWeekendI18n A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `LOCALE`, `TITRE` FROM `idee_weekend_i18n` WHERE `ID` = :p0 AND `LOCALE` = :p1';
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
            $obj = new IdeeWeekendI18n();
            $obj->hydrate($row);
            IdeeWeekendI18nPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return IdeeWeekendI18n|IdeeWeekendI18n[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|IdeeWeekendI18n[]|mixed the list of results, formatted by the current formatter
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
     * @return IdeeWeekendI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(IdeeWeekendI18nPeer::ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(IdeeWeekendI18nPeer::LOCALE, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return IdeeWeekendI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(IdeeWeekendI18nPeer::ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(IdeeWeekendI18nPeer::LOCALE, $key[1], Criteria::EQUAL);
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
     * @see       filterByIdeeWeekend()
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return IdeeWeekendI18nQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(IdeeWeekendI18nPeer::ID, $id, $comparison);
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
     * @return IdeeWeekendI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(IdeeWeekendI18nPeer::LOCALE, $locale, $comparison);
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
     * @return IdeeWeekendI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(IdeeWeekendI18nPeer::TITRE, $titre, $comparison);
    }

    /**
     * Filter the query by a related IdeeWeekend object
     *
     * @param   IdeeWeekend|PropelObjectCollection $ideeWeekend The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   IdeeWeekendI18nQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByIdeeWeekend($ideeWeekend, $comparison = null)
    {
        if ($ideeWeekend instanceof IdeeWeekend) {
            return $this
                ->addUsingAlias(IdeeWeekendI18nPeer::ID, $ideeWeekend->getId(), $comparison);
        } elseif ($ideeWeekend instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(IdeeWeekendI18nPeer::ID, $ideeWeekend->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByIdeeWeekend() only accepts arguments of type IdeeWeekend or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the IdeeWeekend relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return IdeeWeekendI18nQuery The current query, for fluid interface
     */
    public function joinIdeeWeekend($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('IdeeWeekend');

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
            $this->addJoinObject($join, 'IdeeWeekend');
        }

        return $this;
    }

    /**
     * Use the IdeeWeekend relation IdeeWeekend object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\IdeeWeekendQuery A secondary query class using the current class as primary query
     */
    public function useIdeeWeekendQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinIdeeWeekend($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'IdeeWeekend', '\Cungfoo\Model\IdeeWeekendQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   IdeeWeekendI18n $ideeWeekendI18n Object to remove from the list of results
     *
     * @return IdeeWeekendI18nQuery The current query, for fluid interface
     */
    public function prune($ideeWeekendI18n = null)
    {
        if ($ideeWeekendI18n) {
            $this->addCond('pruneCond0', $this->getAliasedColName(IdeeWeekendI18nPeer::ID), $ideeWeekendI18n->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(IdeeWeekendI18nPeer::LOCALE), $ideeWeekendI18n->getLocale(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
