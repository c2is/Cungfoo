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
use Cungfoo\Model\PointInteret;
use Cungfoo\Model\PointInteretI18n;
use Cungfoo\Model\PointInteretI18nPeer;
use Cungfoo\Model\PointInteretI18nQuery;

/**
 * Base class that represents a query for the 'point_interet_i18n' table.
 *
 *
 *
 * @method PointInteretI18nQuery orderById($order = Criteria::ASC) Order by the id column
 * @method PointInteretI18nQuery orderByLocale($order = Criteria::ASC) Order by the locale column
 * @method PointInteretI18nQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method PointInteretI18nQuery orderByPresentation($order = Criteria::ASC) Order by the presentation column
 * @method PointInteretI18nQuery orderByTransport($order = Criteria::ASC) Order by the transport column
 * @method PointInteretI18nQuery orderByCategorie($order = Criteria::ASC) Order by the categorie column
 * @method PointInteretI18nQuery orderByType($order = Criteria::ASC) Order by the type column
 *
 * @method PointInteretI18nQuery groupById() Group by the id column
 * @method PointInteretI18nQuery groupByLocale() Group by the locale column
 * @method PointInteretI18nQuery groupByName() Group by the name column
 * @method PointInteretI18nQuery groupByPresentation() Group by the presentation column
 * @method PointInteretI18nQuery groupByTransport() Group by the transport column
 * @method PointInteretI18nQuery groupByCategorie() Group by the categorie column
 * @method PointInteretI18nQuery groupByType() Group by the type column
 *
 * @method PointInteretI18nQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method PointInteretI18nQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method PointInteretI18nQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method PointInteretI18nQuery leftJoinPointInteret($relationAlias = null) Adds a LEFT JOIN clause to the query using the PointInteret relation
 * @method PointInteretI18nQuery rightJoinPointInteret($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PointInteret relation
 * @method PointInteretI18nQuery innerJoinPointInteret($relationAlias = null) Adds a INNER JOIN clause to the query using the PointInteret relation
 *
 * @method PointInteretI18n findOne(PropelPDO $con = null) Return the first PointInteretI18n matching the query
 * @method PointInteretI18n findOneOrCreate(PropelPDO $con = null) Return the first PointInteretI18n matching the query, or a new PointInteretI18n object populated from the query conditions when no match is found
 *
 * @method PointInteretI18n findOneById(int $id) Return the first PointInteretI18n filtered by the id column
 * @method PointInteretI18n findOneByLocale(string $locale) Return the first PointInteretI18n filtered by the locale column
 * @method PointInteretI18n findOneByName(string $name) Return the first PointInteretI18n filtered by the name column
 * @method PointInteretI18n findOneByPresentation(string $presentation) Return the first PointInteretI18n filtered by the presentation column
 * @method PointInteretI18n findOneByTransport(string $transport) Return the first PointInteretI18n filtered by the transport column
 * @method PointInteretI18n findOneByCategorie(string $categorie) Return the first PointInteretI18n filtered by the categorie column
 * @method PointInteretI18n findOneByType(string $type) Return the first PointInteretI18n filtered by the type column
 *
 * @method array findById(int $id) Return PointInteretI18n objects filtered by the id column
 * @method array findByLocale(string $locale) Return PointInteretI18n objects filtered by the locale column
 * @method array findByName(string $name) Return PointInteretI18n objects filtered by the name column
 * @method array findByPresentation(string $presentation) Return PointInteretI18n objects filtered by the presentation column
 * @method array findByTransport(string $transport) Return PointInteretI18n objects filtered by the transport column
 * @method array findByCategorie(string $categorie) Return PointInteretI18n objects filtered by the categorie column
 * @method array findByType(string $type) Return PointInteretI18n objects filtered by the type column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BasePointInteretI18nQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BasePointInteretI18nQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\PointInteretI18n', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new PointInteretI18nQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     PointInteretI18nQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return PointInteretI18nQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof PointInteretI18nQuery) {
            return $criteria;
        }
        $query = new PointInteretI18nQuery();
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
     * @return   PointInteretI18n|PointInteretI18n[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PointInteretI18nPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(PointInteretI18nPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   PointInteretI18n A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `locale`, `name`, `presentation`, `transport`, `categorie`, `type` FROM `point_interet_i18n` WHERE `id` = :p0 AND `locale` = :p1';
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
            $obj = new PointInteretI18n();
            $obj->hydrate($row);
            PointInteretI18nPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return PointInteretI18n|PointInteretI18n[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|PointInteretI18n[]|mixed the list of results, formatted by the current formatter
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
     * @return PointInteretI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(PointInteretI18nPeer::ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(PointInteretI18nPeer::LOCALE, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return PointInteretI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(PointInteretI18nPeer::ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(PointInteretI18nPeer::LOCALE, $key[1], Criteria::EQUAL);
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
     * @see       filterByPointInteret()
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PointInteretI18nQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(PointInteretI18nPeer::ID, $id, $comparison);
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
     * @return PointInteretI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(PointInteretI18nPeer::LOCALE, $locale, $comparison);
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
     * @return PointInteretI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(PointInteretI18nPeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query on the presentation column
     *
     * Example usage:
     * <code>
     * $query->filterByPresentation('fooValue');   // WHERE presentation = 'fooValue'
     * $query->filterByPresentation('%fooValue%'); // WHERE presentation LIKE '%fooValue%'
     * </code>
     *
     * @param     string $presentation The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PointInteretI18nQuery The current query, for fluid interface
     */
    public function filterByPresentation($presentation = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($presentation)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $presentation)) {
                $presentation = str_replace('*', '%', $presentation);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PointInteretI18nPeer::PRESENTATION, $presentation, $comparison);
    }

    /**
     * Filter the query on the transport column
     *
     * Example usage:
     * <code>
     * $query->filterByTransport('fooValue');   // WHERE transport = 'fooValue'
     * $query->filterByTransport('%fooValue%'); // WHERE transport LIKE '%fooValue%'
     * </code>
     *
     * @param     string $transport The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PointInteretI18nQuery The current query, for fluid interface
     */
    public function filterByTransport($transport = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($transport)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $transport)) {
                $transport = str_replace('*', '%', $transport);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PointInteretI18nPeer::TRANSPORT, $transport, $comparison);
    }

    /**
     * Filter the query on the categorie column
     *
     * Example usage:
     * <code>
     * $query->filterByCategorie('fooValue');   // WHERE categorie = 'fooValue'
     * $query->filterByCategorie('%fooValue%'); // WHERE categorie LIKE '%fooValue%'
     * </code>
     *
     * @param     string $categorie The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PointInteretI18nQuery The current query, for fluid interface
     */
    public function filterByCategorie($categorie = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($categorie)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $categorie)) {
                $categorie = str_replace('*', '%', $categorie);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PointInteretI18nPeer::CATEGORIE, $categorie, $comparison);
    }

    /**
     * Filter the query on the type column
     *
     * Example usage:
     * <code>
     * $query->filterByType('fooValue');   // WHERE type = 'fooValue'
     * $query->filterByType('%fooValue%'); // WHERE type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $type The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PointInteretI18nQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($type)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $type)) {
                $type = str_replace('*', '%', $type);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PointInteretI18nPeer::TYPE, $type, $comparison);
    }

    /**
     * Filter the query by a related PointInteret object
     *
     * @param   PointInteret|PropelObjectCollection $pointInteret The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PointInteretI18nQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByPointInteret($pointInteret, $comparison = null)
    {
        if ($pointInteret instanceof PointInteret) {
            return $this
                ->addUsingAlias(PointInteretI18nPeer::ID, $pointInteret->getId(), $comparison);
        } elseif ($pointInteret instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PointInteretI18nPeer::ID, $pointInteret->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPointInteret() only accepts arguments of type PointInteret or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PointInteret relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PointInteretI18nQuery The current query, for fluid interface
     */
    public function joinPointInteret($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PointInteret');

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
            $this->addJoinObject($join, 'PointInteret');
        }

        return $this;
    }

    /**
     * Use the PointInteret relation PointInteret object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\PointInteretQuery A secondary query class using the current class as primary query
     */
    public function usePointInteretQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinPointInteret($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PointInteret', '\Cungfoo\Model\PointInteretQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   PointInteretI18n $pointInteretI18n Object to remove from the list of results
     *
     * @return PointInteretI18nQuery The current query, for fluid interface
     */
    public function prune($pointInteretI18n = null)
    {
        if ($pointInteretI18n) {
            $this->addCond('pruneCond0', $this->getAliasedColName(PointInteretI18nPeer::ID), $pointInteretI18n->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(PointInteretI18nPeer::LOCALE), $pointInteretI18n->getLocale(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
