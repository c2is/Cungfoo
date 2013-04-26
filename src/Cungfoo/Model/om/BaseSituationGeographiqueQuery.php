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
use Cungfoo\Model\Etablissement;
use Cungfoo\Model\EtablissementSituationGeographique;
use Cungfoo\Model\SituationGeographique;
use Cungfoo\Model\SituationGeographiqueI18n;
use Cungfoo\Model\SituationGeographiquePeer;
use Cungfoo\Model\SituationGeographiqueQuery;

/**
 * Base class that represents a query for the 'situation_geographique' table.
 *
 *
 *
 * @method SituationGeographiqueQuery orderById($order = Criteria::ASC) Order by the id column
 * @method SituationGeographiqueQuery orderByCode($order = Criteria::ASC) Order by the code column
 * @method SituationGeographiqueQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method SituationGeographiqueQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method SituationGeographiqueQuery orderByActive($order = Criteria::ASC) Order by the active column
 *
 * @method SituationGeographiqueQuery groupById() Group by the id column
 * @method SituationGeographiqueQuery groupByCode() Group by the code column
 * @method SituationGeographiqueQuery groupByCreatedAt() Group by the created_at column
 * @method SituationGeographiqueQuery groupByUpdatedAt() Group by the updated_at column
 * @method SituationGeographiqueQuery groupByActive() Group by the active column
 *
 * @method SituationGeographiqueQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method SituationGeographiqueQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method SituationGeographiqueQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method SituationGeographiqueQuery leftJoinEtablissementSituationGeographique($relationAlias = null) Adds a LEFT JOIN clause to the query using the EtablissementSituationGeographique relation
 * @method SituationGeographiqueQuery rightJoinEtablissementSituationGeographique($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EtablissementSituationGeographique relation
 * @method SituationGeographiqueQuery innerJoinEtablissementSituationGeographique($relationAlias = null) Adds a INNER JOIN clause to the query using the EtablissementSituationGeographique relation
 *
 * @method SituationGeographiqueQuery leftJoinSituationGeographiqueI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the SituationGeographiqueI18n relation
 * @method SituationGeographiqueQuery rightJoinSituationGeographiqueI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SituationGeographiqueI18n relation
 * @method SituationGeographiqueQuery innerJoinSituationGeographiqueI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the SituationGeographiqueI18n relation
 *
 * @method SituationGeographique findOne(PropelPDO $con = null) Return the first SituationGeographique matching the query
 * @method SituationGeographique findOneOrCreate(PropelPDO $con = null) Return the first SituationGeographique matching the query, or a new SituationGeographique object populated from the query conditions when no match is found
 *
 * @method SituationGeographique findOneByCode(string $code) Return the first SituationGeographique filtered by the code column
 * @method SituationGeographique findOneByCreatedAt(string $created_at) Return the first SituationGeographique filtered by the created_at column
 * @method SituationGeographique findOneByUpdatedAt(string $updated_at) Return the first SituationGeographique filtered by the updated_at column
 * @method SituationGeographique findOneByActive(boolean $active) Return the first SituationGeographique filtered by the active column
 *
 * @method array findById(int $id) Return SituationGeographique objects filtered by the id column
 * @method array findByCode(string $code) Return SituationGeographique objects filtered by the code column
 * @method array findByCreatedAt(string $created_at) Return SituationGeographique objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return SituationGeographique objects filtered by the updated_at column
 * @method array findByActive(boolean $active) Return SituationGeographique objects filtered by the active column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseSituationGeographiqueQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseSituationGeographiqueQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\SituationGeographique', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new SituationGeographiqueQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     SituationGeographiqueQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return SituationGeographiqueQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof SituationGeographiqueQuery) {
            return $criteria;
        }
        $query = new SituationGeographiqueQuery();
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
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   SituationGeographique|SituationGeographique[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = SituationGeographiquePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(SituationGeographiquePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return   SituationGeographique A model object, or null if the key is not found
     * @throws   PropelException
     */
     public function findOneById($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return   SituationGeographique A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `code`, `created_at`, `updated_at`, `active` FROM `situation_geographique` WHERE `id` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new SituationGeographique();
            $obj->hydrate($row);
            SituationGeographiquePeer::addInstanceToPool($obj, (string) $key);
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
     * @return SituationGeographique|SituationGeographique[]|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|SituationGeographique[]|mixed the list of results, formatted by the current formatter
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
     * @return SituationGeographiqueQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SituationGeographiquePeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return SituationGeographiqueQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SituationGeographiquePeer::ID, $keys, Criteria::IN);
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
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SituationGeographiqueQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(SituationGeographiquePeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the code column
     *
     * Example usage:
     * <code>
     * $query->filterByCode('fooValue');   // WHERE code = 'fooValue'
     * $query->filterByCode('%fooValue%'); // WHERE code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $code The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SituationGeographiqueQuery The current query, for fluid interface
     */
    public function filterByCode($code = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($code)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $code)) {
                $code = str_replace('*', '%', $code);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SituationGeographiquePeer::CODE, $code, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SituationGeographiqueQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(SituationGeographiquePeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(SituationGeographiquePeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SituationGeographiquePeer::CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SituationGeographiqueQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(SituationGeographiquePeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(SituationGeographiquePeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SituationGeographiquePeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query on the active column
     *
     * Example usage:
     * <code>
     * $query->filterByActive(true); // WHERE active = true
     * $query->filterByActive('yes'); // WHERE active = true
     * </code>
     *
     * @param     boolean|string $active The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SituationGeographiqueQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(SituationGeographiquePeer::ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query by a related EtablissementSituationGeographique object
     *
     * @param   EtablissementSituationGeographique|PropelObjectCollection $etablissementSituationGeographique  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   SituationGeographiqueQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByEtablissementSituationGeographique($etablissementSituationGeographique, $comparison = null)
    {
        if ($etablissementSituationGeographique instanceof EtablissementSituationGeographique) {
            return $this
                ->addUsingAlias(SituationGeographiquePeer::ID, $etablissementSituationGeographique->getSituationGeographiqueId(), $comparison);
        } elseif ($etablissementSituationGeographique instanceof PropelObjectCollection) {
            return $this
                ->useEtablissementSituationGeographiqueQuery()
                ->filterByPrimaryKeys($etablissementSituationGeographique->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEtablissementSituationGeographique() only accepts arguments of type EtablissementSituationGeographique or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EtablissementSituationGeographique relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return SituationGeographiqueQuery The current query, for fluid interface
     */
    public function joinEtablissementSituationGeographique($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EtablissementSituationGeographique');

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
            $this->addJoinObject($join, 'EtablissementSituationGeographique');
        }

        return $this;
    }

    /**
     * Use the EtablissementSituationGeographique relation EtablissementSituationGeographique object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\EtablissementSituationGeographiqueQuery A secondary query class using the current class as primary query
     */
    public function useEtablissementSituationGeographiqueQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEtablissementSituationGeographique($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EtablissementSituationGeographique', '\Cungfoo\Model\EtablissementSituationGeographiqueQuery');
    }

    /**
     * Filter the query by a related SituationGeographiqueI18n object
     *
     * @param   SituationGeographiqueI18n|PropelObjectCollection $situationGeographiqueI18n  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   SituationGeographiqueQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterBySituationGeographiqueI18n($situationGeographiqueI18n, $comparison = null)
    {
        if ($situationGeographiqueI18n instanceof SituationGeographiqueI18n) {
            return $this
                ->addUsingAlias(SituationGeographiquePeer::ID, $situationGeographiqueI18n->getId(), $comparison);
        } elseif ($situationGeographiqueI18n instanceof PropelObjectCollection) {
            return $this
                ->useSituationGeographiqueI18nQuery()
                ->filterByPrimaryKeys($situationGeographiqueI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySituationGeographiqueI18n() only accepts arguments of type SituationGeographiqueI18n or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SituationGeographiqueI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return SituationGeographiqueQuery The current query, for fluid interface
     */
    public function joinSituationGeographiqueI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SituationGeographiqueI18n');

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
            $this->addJoinObject($join, 'SituationGeographiqueI18n');
        }

        return $this;
    }

    /**
     * Use the SituationGeographiqueI18n relation SituationGeographiqueI18n object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\SituationGeographiqueI18nQuery A secondary query class using the current class as primary query
     */
    public function useSituationGeographiqueI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinSituationGeographiqueI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SituationGeographiqueI18n', '\Cungfoo\Model\SituationGeographiqueI18nQuery');
    }

    /**
     * Filter the query by a related Etablissement object
     * using the etablissement_situation_geographique table as cross reference
     *
     * @param   Etablissement $etablissement the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   SituationGeographiqueQuery The current query, for fluid interface
     */
    public function filterByEtablissement($etablissement, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useEtablissementSituationGeographiqueQuery()
            ->filterByEtablissement($etablissement, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   SituationGeographique $situationGeographique Object to remove from the list of results
     *
     * @return SituationGeographiqueQuery The current query, for fluid interface
     */
    public function prune($situationGeographique = null)
    {
        if ($situationGeographique) {
            $this->addUsingAlias(SituationGeographiquePeer::ID, $situationGeographique->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     SituationGeographiqueQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(SituationGeographiquePeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     SituationGeographiqueQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(SituationGeographiquePeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     SituationGeographiqueQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(SituationGeographiquePeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     SituationGeographiqueQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(SituationGeographiquePeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     SituationGeographiqueQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(SituationGeographiquePeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     SituationGeographiqueQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(SituationGeographiquePeer::CREATED_AT);
    }
    // active behavior
    
    
    /**
     * return only active objects
     *
     * @return boolean
     */
    public function findActive($con = null)
    {
        $locale = defined('CURRENT_LANGUAGE') ? CURRENT_LANGUAGE : 'fr';
    
        $this
            ->filterByActive(true)
            ->useI18nQuery($locale, 'i18n_locale')
                ->filterByActiveLocale(true)
                    ->_or()
                ->filterByActiveLocale(null, Criteria::ISNULL)
            ->endUse()
        ;
    
        return parent::find($con);
    }
    // i18n behavior

    /**
     * Adds a JOIN clause to the query using the i18n relation
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    SituationGeographiqueQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'SituationGeographiqueI18n';

        return $this
            ->joinSituationGeographiqueI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    SituationGeographiqueQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'fr', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('SituationGeographiqueI18n');
        $this->with['SituationGeographiqueI18n']->setIsWithOneToMany(false);

        return $this;
    }

    /**
     * Use the I18n relation query object
     *
     * @see       useQuery()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    SituationGeographiqueI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SituationGeographiqueI18n', 'Cungfoo\Model\SituationGeographiqueI18nQuery');
    }

    // crudable behavior
    
    public function filterByTerm($term)
    {
        $term = '%' . $term . '%';
    
        return $this
            ->_or()
            ->useI18nQuery()
            ->filterByName($term, \Criteria::LIKE)
            ->endUse()
        ;
    }
}
