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
use Cungfoo\Model\Personnage;
use Cungfoo\Model\PersonnageI18n;
use Cungfoo\Model\PersonnageI18nPeer;
use Cungfoo\Model\PersonnageI18nQuery;

/**
 * Base class that represents a query for the 'personnage_i18n' table.
 *
 *
 *
 * @method PersonnageI18nQuery orderById($order = Criteria::ASC) Order by the id column
 * @method PersonnageI18nQuery orderByLocale($order = Criteria::ASC) Order by the locale column
 * @method PersonnageI18nQuery orderByPrenom($order = Criteria::ASC) Order by the prenom column
 *
 * @method PersonnageI18nQuery groupById() Group by the id column
 * @method PersonnageI18nQuery groupByLocale() Group by the locale column
 * @method PersonnageI18nQuery groupByPrenom() Group by the prenom column
 *
 * @method PersonnageI18nQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method PersonnageI18nQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method PersonnageI18nQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method PersonnageI18nQuery leftJoinPersonnage($relationAlias = null) Adds a LEFT JOIN clause to the query using the Personnage relation
 * @method PersonnageI18nQuery rightJoinPersonnage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Personnage relation
 * @method PersonnageI18nQuery innerJoinPersonnage($relationAlias = null) Adds a INNER JOIN clause to the query using the Personnage relation
 *
 * @method PersonnageI18n findOne(PropelPDO $con = null) Return the first PersonnageI18n matching the query
 * @method PersonnageI18n findOneOrCreate(PropelPDO $con = null) Return the first PersonnageI18n matching the query, or a new PersonnageI18n object populated from the query conditions when no match is found
 *
 * @method PersonnageI18n findOneById(int $id) Return the first PersonnageI18n filtered by the id column
 * @method PersonnageI18n findOneByLocale(string $locale) Return the first PersonnageI18n filtered by the locale column
 * @method PersonnageI18n findOneByPrenom(string $prenom) Return the first PersonnageI18n filtered by the prenom column
 *
 * @method array findById(int $id) Return PersonnageI18n objects filtered by the id column
 * @method array findByLocale(string $locale) Return PersonnageI18n objects filtered by the locale column
 * @method array findByPrenom(string $prenom) Return PersonnageI18n objects filtered by the prenom column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BasePersonnageI18nQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BasePersonnageI18nQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\PersonnageI18n', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new PersonnageI18nQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     PersonnageI18nQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return PersonnageI18nQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof PersonnageI18nQuery) {
            return $criteria;
        }
        $query = new PersonnageI18nQuery();
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
     * @return   PersonnageI18n|PersonnageI18n[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PersonnageI18nPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(PersonnageI18nPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   PersonnageI18n A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `locale`, `prenom` FROM `personnage_i18n` WHERE `id` = :p0 AND `locale` = :p1';
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
            $obj = new PersonnageI18n();
            $obj->hydrate($row);
            PersonnageI18nPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return PersonnageI18n|PersonnageI18n[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|PersonnageI18n[]|mixed the list of results, formatted by the current formatter
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
     * @return PersonnageI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(PersonnageI18nPeer::ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(PersonnageI18nPeer::LOCALE, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return PersonnageI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(PersonnageI18nPeer::ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(PersonnageI18nPeer::LOCALE, $key[1], Criteria::EQUAL);
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
     * @see       filterByPersonnage()
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PersonnageI18nQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(PersonnageI18nPeer::ID, $id, $comparison);
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
     * @return PersonnageI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(PersonnageI18nPeer::LOCALE, $locale, $comparison);
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
     * @return PersonnageI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(PersonnageI18nPeer::PRENOM, $prenom, $comparison);
    }

    /**
     * Filter the query by a related Personnage object
     *
     * @param   Personnage|PropelObjectCollection $personnage The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PersonnageI18nQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByPersonnage($personnage, $comparison = null)
    {
        if ($personnage instanceof Personnage) {
            return $this
                ->addUsingAlias(PersonnageI18nPeer::ID, $personnage->getId(), $comparison);
        } elseif ($personnage instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PersonnageI18nPeer::ID, $personnage->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPersonnage() only accepts arguments of type Personnage or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Personnage relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PersonnageI18nQuery The current query, for fluid interface
     */
    public function joinPersonnage($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Personnage');

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
            $this->addJoinObject($join, 'Personnage');
        }

        return $this;
    }

    /**
     * Use the Personnage relation Personnage object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\PersonnageQuery A secondary query class using the current class as primary query
     */
    public function usePersonnageQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinPersonnage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Personnage', '\Cungfoo\Model\PersonnageQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   PersonnageI18n $personnageI18n Object to remove from the list of results
     *
     * @return PersonnageI18nQuery The current query, for fluid interface
     */
    public function prune($personnageI18n = null)
    {
        if ($personnageI18n) {
            $this->addCond('pruneCond0', $this->getAliasedColName(PersonnageI18nPeer::ID), $personnageI18n->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(PersonnageI18nPeer::LOCALE), $personnageI18n->getLocale(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
