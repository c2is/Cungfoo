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
use Cungfoo\Model\EtablissementServiceComplementaire;
use Cungfoo\Model\ServiceComplementaire;
use Cungfoo\Model\ServiceComplementaireI18n;
use Cungfoo\Model\ServiceComplementairePeer;
use Cungfoo\Model\ServiceComplementaireQuery;

/**
 * Base class that represents a query for the 'service_complementaire' table.
 *
 *
 *
 * @method ServiceComplementaireQuery orderById($order = Criteria::ASC) Order by the id column
 * @method ServiceComplementaireQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method ServiceComplementaireQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method ServiceComplementaireQuery groupById() Group by the id column
 * @method ServiceComplementaireQuery groupByCreatedAt() Group by the created_at column
 * @method ServiceComplementaireQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method ServiceComplementaireQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method ServiceComplementaireQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method ServiceComplementaireQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method ServiceComplementaireQuery leftJoinEtablissementServiceComplementaire($relationAlias = null) Adds a LEFT JOIN clause to the query using the EtablissementServiceComplementaire relation
 * @method ServiceComplementaireQuery rightJoinEtablissementServiceComplementaire($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EtablissementServiceComplementaire relation
 * @method ServiceComplementaireQuery innerJoinEtablissementServiceComplementaire($relationAlias = null) Adds a INNER JOIN clause to the query using the EtablissementServiceComplementaire relation
 *
 * @method ServiceComplementaireQuery leftJoinServiceComplementaireI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the ServiceComplementaireI18n relation
 * @method ServiceComplementaireQuery rightJoinServiceComplementaireI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ServiceComplementaireI18n relation
 * @method ServiceComplementaireQuery innerJoinServiceComplementaireI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the ServiceComplementaireI18n relation
 *
 * @method ServiceComplementaire findOne(PropelPDO $con = null) Return the first ServiceComplementaire matching the query
 * @method ServiceComplementaire findOneOrCreate(PropelPDO $con = null) Return the first ServiceComplementaire matching the query, or a new ServiceComplementaire object populated from the query conditions when no match is found
 *
 * @method ServiceComplementaire findOneByCreatedAt(string $created_at) Return the first ServiceComplementaire filtered by the created_at column
 * @method ServiceComplementaire findOneByUpdatedAt(string $updated_at) Return the first ServiceComplementaire filtered by the updated_at column
 *
 * @method array findById(string $id) Return ServiceComplementaire objects filtered by the id column
 * @method array findByCreatedAt(string $created_at) Return ServiceComplementaire objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return ServiceComplementaire objects filtered by the updated_at column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseServiceComplementaireQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseServiceComplementaireQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\ServiceComplementaire', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ServiceComplementaireQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     ServiceComplementaireQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return ServiceComplementaireQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof ServiceComplementaireQuery) {
            return $criteria;
        }
        $query = new ServiceComplementaireQuery();
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
     * @return   ServiceComplementaire|ServiceComplementaire[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ServiceComplementairePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(ServiceComplementairePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   ServiceComplementaire A model object, or null if the key is not found
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
     * @return   ServiceComplementaire A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `CREATED_AT`, `UPDATED_AT` FROM `service_complementaire` WHERE `ID` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new ServiceComplementaire();
            $obj->hydrate($row);
            ServiceComplementairePeer::addInstanceToPool($obj, (string) $key);
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
     * @return ServiceComplementaire|ServiceComplementaire[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|ServiceComplementaire[]|mixed the list of results, formatted by the current formatter
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
     * @return ServiceComplementaireQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ServiceComplementairePeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ServiceComplementaireQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ServiceComplementairePeer::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById('fooValue');   // WHERE id = 'fooValue'
     * $query->filterById('%fooValue%'); // WHERE id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $id The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ServiceComplementaireQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($id)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $id)) {
                $id = str_replace('*', '%', $id);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ServiceComplementairePeer::ID, $id, $comparison);
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
     * @return ServiceComplementaireQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(ServiceComplementairePeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ServiceComplementairePeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ServiceComplementairePeer::CREATED_AT, $createdAt, $comparison);
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
     * @return ServiceComplementaireQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(ServiceComplementairePeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(ServiceComplementairePeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ServiceComplementairePeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related EtablissementServiceComplementaire object
     *
     * @param   EtablissementServiceComplementaire|PropelObjectCollection $etablissementServiceComplementaire  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ServiceComplementaireQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByEtablissementServiceComplementaire($etablissementServiceComplementaire, $comparison = null)
    {
        if ($etablissementServiceComplementaire instanceof EtablissementServiceComplementaire) {
            return $this
                ->addUsingAlias(ServiceComplementairePeer::ID, $etablissementServiceComplementaire->getServiceComplementaireId(), $comparison);
        } elseif ($etablissementServiceComplementaire instanceof PropelObjectCollection) {
            return $this
                ->useEtablissementServiceComplementaireQuery()
                ->filterByPrimaryKeys($etablissementServiceComplementaire->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEtablissementServiceComplementaire() only accepts arguments of type EtablissementServiceComplementaire or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EtablissementServiceComplementaire relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ServiceComplementaireQuery The current query, for fluid interface
     */
    public function joinEtablissementServiceComplementaire($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EtablissementServiceComplementaire');

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
            $this->addJoinObject($join, 'EtablissementServiceComplementaire');
        }

        return $this;
    }

    /**
     * Use the EtablissementServiceComplementaire relation EtablissementServiceComplementaire object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\EtablissementServiceComplementaireQuery A secondary query class using the current class as primary query
     */
    public function useEtablissementServiceComplementaireQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEtablissementServiceComplementaire($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EtablissementServiceComplementaire', '\Cungfoo\Model\EtablissementServiceComplementaireQuery');
    }

    /**
     * Filter the query by a related ServiceComplementaireI18n object
     *
     * @param   ServiceComplementaireI18n|PropelObjectCollection $serviceComplementaireI18n  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ServiceComplementaireQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByServiceComplementaireI18n($serviceComplementaireI18n, $comparison = null)
    {
        if ($serviceComplementaireI18n instanceof ServiceComplementaireI18n) {
            return $this
                ->addUsingAlias(ServiceComplementairePeer::ID, $serviceComplementaireI18n->getId(), $comparison);
        } elseif ($serviceComplementaireI18n instanceof PropelObjectCollection) {
            return $this
                ->useServiceComplementaireI18nQuery()
                ->filterByPrimaryKeys($serviceComplementaireI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByServiceComplementaireI18n() only accepts arguments of type ServiceComplementaireI18n or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ServiceComplementaireI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ServiceComplementaireQuery The current query, for fluid interface
     */
    public function joinServiceComplementaireI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ServiceComplementaireI18n');

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
            $this->addJoinObject($join, 'ServiceComplementaireI18n');
        }

        return $this;
    }

    /**
     * Use the ServiceComplementaireI18n relation ServiceComplementaireI18n object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\ServiceComplementaireI18nQuery A secondary query class using the current class as primary query
     */
    public function useServiceComplementaireI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinServiceComplementaireI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ServiceComplementaireI18n', '\Cungfoo\Model\ServiceComplementaireI18nQuery');
    }

    /**
     * Filter the query by a related Etablissement object
     * using the etablissement_service_complementaire table as cross reference
     *
     * @param   Etablissement $etablissement the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ServiceComplementaireQuery The current query, for fluid interface
     */
    public function filterByEtablissement($etablissement, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useEtablissementServiceComplementaireQuery()
            ->filterByEtablissement($etablissement, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   ServiceComplementaire $serviceComplementaire Object to remove from the list of results
     *
     * @return ServiceComplementaireQuery The current query, for fluid interface
     */
    public function prune($serviceComplementaire = null)
    {
        if ($serviceComplementaire) {
            $this->addUsingAlias(ServiceComplementairePeer::ID, $serviceComplementaire->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     ServiceComplementaireQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(ServiceComplementairePeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     ServiceComplementaireQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(ServiceComplementairePeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     ServiceComplementaireQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(ServiceComplementairePeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     ServiceComplementaireQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(ServiceComplementairePeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     ServiceComplementaireQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(ServiceComplementairePeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     ServiceComplementaireQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(ServiceComplementairePeer::CREATED_AT);
    }
    // i18n behavior

    /**
     * Adds a JOIN clause to the query using the i18n relation
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    ServiceComplementaireQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'ServiceComplementaireI18n';

        return $this
            ->joinServiceComplementaireI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    ServiceComplementaireQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'fr', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('ServiceComplementaireI18n');
        $this->with['ServiceComplementaireI18n']->setIsWithOneToMany(false);

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
     * @return    ServiceComplementaireI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ServiceComplementaireI18n', 'Cungfoo\Model\ServiceComplementaireI18nQuery');
    }

}
