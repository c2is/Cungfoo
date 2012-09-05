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
use Cungfoo\Model\Equipement;
use Cungfoo\Model\EquipementI18n;
use Cungfoo\Model\EquipementPeer;
use Cungfoo\Model\EquipementQuery;
use Cungfoo\Model\Etablissement;
use Cungfoo\Model\EtablissementEquipement;

/**
 * Base class that represents a query for the 'equipement' table.
 *
 *
 *
 * @method EquipementQuery orderById($order = Criteria::ASC) Order by the id column
 * @method EquipementQuery orderByCode($order = Criteria::ASC) Order by the code column
 * @method EquipementQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method EquipementQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method EquipementQuery groupById() Group by the id column
 * @method EquipementQuery groupByCode() Group by the code column
 * @method EquipementQuery groupByCreatedAt() Group by the created_at column
 * @method EquipementQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method EquipementQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method EquipementQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method EquipementQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method EquipementQuery leftJoinEtablissementEquipement($relationAlias = null) Adds a LEFT JOIN clause to the query using the EtablissementEquipement relation
 * @method EquipementQuery rightJoinEtablissementEquipement($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EtablissementEquipement relation
 * @method EquipementQuery innerJoinEtablissementEquipement($relationAlias = null) Adds a INNER JOIN clause to the query using the EtablissementEquipement relation
 *
 * @method EquipementQuery leftJoinEquipementI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the EquipementI18n relation
 * @method EquipementQuery rightJoinEquipementI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EquipementI18n relation
 * @method EquipementQuery innerJoinEquipementI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the EquipementI18n relation
 *
 * @method Equipement findOne(PropelPDO $con = null) Return the first Equipement matching the query
 * @method Equipement findOneOrCreate(PropelPDO $con = null) Return the first Equipement matching the query, or a new Equipement object populated from the query conditions when no match is found
 *
 * @method Equipement findOneByCode(string $code) Return the first Equipement filtered by the code column
 * @method Equipement findOneByCreatedAt(string $created_at) Return the first Equipement filtered by the created_at column
 * @method Equipement findOneByUpdatedAt(string $updated_at) Return the first Equipement filtered by the updated_at column
 *
 * @method array findById(int $id) Return Equipement objects filtered by the id column
 * @method array findByCode(string $code) Return Equipement objects filtered by the code column
 * @method array findByCreatedAt(string $created_at) Return Equipement objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return Equipement objects filtered by the updated_at column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseEquipementQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseEquipementQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\Equipement', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new EquipementQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     EquipementQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return EquipementQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof EquipementQuery) {
            return $criteria;
        }
        $query = new EquipementQuery();
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
     * @return   Equipement|Equipement[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = EquipementPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(EquipementPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Equipement A model object, or null if the key is not found
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
     * @return   Equipement A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `CODE`, `CREATED_AT`, `UPDATED_AT` FROM `equipement` WHERE `ID` = :p0';
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
            $obj = new Equipement();
            $obj->hydrate($row);
            EquipementPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Equipement|Equipement[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Equipement[]|mixed the list of results, formatted by the current formatter
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
     * @return EquipementQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(EquipementPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return EquipementQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(EquipementPeer::ID, $keys, Criteria::IN);
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
     * @return EquipementQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(EquipementPeer::ID, $id, $comparison);
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
     * @return EquipementQuery The current query, for fluid interface
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

        return $this->addUsingAlias(EquipementPeer::CODE, $code, $comparison);
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
     * @return EquipementQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(EquipementPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(EquipementPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EquipementPeer::CREATED_AT, $createdAt, $comparison);
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
     * @return EquipementQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(EquipementPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(EquipementPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EquipementPeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related EtablissementEquipement object
     *
     * @param   EtablissementEquipement|PropelObjectCollection $etablissementEquipement  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   EquipementQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByEtablissementEquipement($etablissementEquipement, $comparison = null)
    {
        if ($etablissementEquipement instanceof EtablissementEquipement) {
            return $this
                ->addUsingAlias(EquipementPeer::ID, $etablissementEquipement->getEquipementId(), $comparison);
        } elseif ($etablissementEquipement instanceof PropelObjectCollection) {
            return $this
                ->useEtablissementEquipementQuery()
                ->filterByPrimaryKeys($etablissementEquipement->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEtablissementEquipement() only accepts arguments of type EtablissementEquipement or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EtablissementEquipement relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return EquipementQuery The current query, for fluid interface
     */
    public function joinEtablissementEquipement($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EtablissementEquipement');

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
            $this->addJoinObject($join, 'EtablissementEquipement');
        }

        return $this;
    }

    /**
     * Use the EtablissementEquipement relation EtablissementEquipement object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\EtablissementEquipementQuery A secondary query class using the current class as primary query
     */
    public function useEtablissementEquipementQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEtablissementEquipement($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EtablissementEquipement', '\Cungfoo\Model\EtablissementEquipementQuery');
    }

    /**
     * Filter the query by a related EquipementI18n object
     *
     * @param   EquipementI18n|PropelObjectCollection $equipementI18n  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   EquipementQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByEquipementI18n($equipementI18n, $comparison = null)
    {
        if ($equipementI18n instanceof EquipementI18n) {
            return $this
                ->addUsingAlias(EquipementPeer::ID, $equipementI18n->getId(), $comparison);
        } elseif ($equipementI18n instanceof PropelObjectCollection) {
            return $this
                ->useEquipementI18nQuery()
                ->filterByPrimaryKeys($equipementI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEquipementI18n() only accepts arguments of type EquipementI18n or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EquipementI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return EquipementQuery The current query, for fluid interface
     */
    public function joinEquipementI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EquipementI18n');

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
            $this->addJoinObject($join, 'EquipementI18n');
        }

        return $this;
    }

    /**
     * Use the EquipementI18n relation EquipementI18n object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\EquipementI18nQuery A secondary query class using the current class as primary query
     */
    public function useEquipementI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinEquipementI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EquipementI18n', '\Cungfoo\Model\EquipementI18nQuery');
    }

    /**
     * Filter the query by a related Etablissement object
     * using the etablissement_equipement table as cross reference
     *
     * @param   Etablissement $etablissement the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   EquipementQuery The current query, for fluid interface
     */
    public function filterByEtablissement($etablissement, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useEtablissementEquipementQuery()
            ->filterByEtablissement($etablissement, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   Equipement $equipement Object to remove from the list of results
     *
     * @return EquipementQuery The current query, for fluid interface
     */
    public function prune($equipement = null)
    {
        if ($equipement) {
            $this->addUsingAlias(EquipementPeer::ID, $equipement->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     EquipementQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(EquipementPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     EquipementQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(EquipementPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     EquipementQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(EquipementPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     EquipementQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(EquipementPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     EquipementQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(EquipementPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     EquipementQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(EquipementPeer::CREATED_AT);
    }
    // i18n behavior

    /**
     * Adds a JOIN clause to the query using the i18n relation
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    EquipementQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'EquipementI18n';

        return $this
            ->joinEquipementI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    EquipementQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'fr', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('EquipementI18n');
        $this->with['EquipementI18n']->setIsWithOneToMany(false);

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
     * @return    EquipementI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EquipementI18n', 'Cungfoo\Model\EquipementI18nQuery');
    }

}
