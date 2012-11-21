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
use Cungfoo\Model\EtablissementThematique;
use Cungfoo\Model\Thematique;
use Cungfoo\Model\ThematiqueI18n;
use Cungfoo\Model\ThematiquePeer;
use Cungfoo\Model\ThematiqueQuery;

/**
 * Base class that represents a query for the 'thematique' table.
 *
 *
 *
 * @method ThematiqueQuery orderById($order = Criteria::ASC) Order by the id column
 * @method ThematiqueQuery orderByCode($order = Criteria::ASC) Order by the code column
 * @method ThematiqueQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method ThematiqueQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method ThematiqueQuery orderByEnabled($order = Criteria::ASC) Order by the enabled column
 *
 * @method ThematiqueQuery groupById() Group by the id column
 * @method ThematiqueQuery groupByCode() Group by the code column
 * @method ThematiqueQuery groupByCreatedAt() Group by the created_at column
 * @method ThematiqueQuery groupByUpdatedAt() Group by the updated_at column
 * @method ThematiqueQuery groupByEnabled() Group by the enabled column
 *
 * @method ThematiqueQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method ThematiqueQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method ThematiqueQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method ThematiqueQuery leftJoinEtablissementThematique($relationAlias = null) Adds a LEFT JOIN clause to the query using the EtablissementThematique relation
 * @method ThematiqueQuery rightJoinEtablissementThematique($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EtablissementThematique relation
 * @method ThematiqueQuery innerJoinEtablissementThematique($relationAlias = null) Adds a INNER JOIN clause to the query using the EtablissementThematique relation
 *
 * @method ThematiqueQuery leftJoinThematiqueI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the ThematiqueI18n relation
 * @method ThematiqueQuery rightJoinThematiqueI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ThematiqueI18n relation
 * @method ThematiqueQuery innerJoinThematiqueI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the ThematiqueI18n relation
 *
 * @method Thematique findOne(PropelPDO $con = null) Return the first Thematique matching the query
 * @method Thematique findOneOrCreate(PropelPDO $con = null) Return the first Thematique matching the query, or a new Thematique object populated from the query conditions when no match is found
 *
 * @method Thematique findOneByCode(string $code) Return the first Thematique filtered by the code column
 * @method Thematique findOneByCreatedAt(string $created_at) Return the first Thematique filtered by the created_at column
 * @method Thematique findOneByUpdatedAt(string $updated_at) Return the first Thematique filtered by the updated_at column
 * @method Thematique findOneByEnabled(boolean $enabled) Return the first Thematique filtered by the enabled column
 *
 * @method array findById(int $id) Return Thematique objects filtered by the id column
 * @method array findByCode(string $code) Return Thematique objects filtered by the code column
 * @method array findByCreatedAt(string $created_at) Return Thematique objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return Thematique objects filtered by the updated_at column
 * @method array findByEnabled(boolean $enabled) Return Thematique objects filtered by the enabled column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseThematiqueQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseThematiqueQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\Thematique', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ThematiqueQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     ThematiqueQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return ThematiqueQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof ThematiqueQuery) {
            return $criteria;
        }
        $query = new ThematiqueQuery();
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
     * @return   Thematique|Thematique[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ThematiquePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(ThematiquePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Thematique A model object, or null if the key is not found
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
     * @return   Thematique A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `CODE`, `CREATED_AT`, `UPDATED_AT`, `ENABLED` FROM `thematique` WHERE `ID` = :p0';
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
            $obj = new Thematique();
            $obj->hydrate($row);
            ThematiquePeer::addInstanceToPool($obj, (string) $key);
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
     * @return Thematique|Thematique[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Thematique[]|mixed the list of results, formatted by the current formatter
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
     * @return ThematiqueQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ThematiquePeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ThematiqueQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ThematiquePeer::ID, $keys, Criteria::IN);
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
     * @return ThematiqueQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(ThematiquePeer::ID, $id, $comparison);
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
     * @return ThematiqueQuery The current query, for fluid interface
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

        return $this->addUsingAlias(ThematiquePeer::CODE, $code, $comparison);
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
     * @return ThematiqueQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(ThematiquePeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ThematiquePeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ThematiquePeer::CREATED_AT, $createdAt, $comparison);
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
     * @return ThematiqueQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(ThematiquePeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(ThematiquePeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ThematiquePeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query on the enabled column
     *
     * Example usage:
     * <code>
     * $query->filterByEnabled(true); // WHERE enabled = true
     * $query->filterByEnabled('yes'); // WHERE enabled = true
     * </code>
     *
     * @param     boolean|string $enabled The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ThematiqueQuery The current query, for fluid interface
     */
    public function filterByEnabled($enabled = null, $comparison = null)
    {
        if (is_string($enabled)) {
            $enabled = in_array(strtolower($enabled), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ThematiquePeer::ENABLED, $enabled, $comparison);
    }

    /**
     * Filter the query by a related EtablissementThematique object
     *
     * @param   EtablissementThematique|PropelObjectCollection $etablissementThematique  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ThematiqueQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByEtablissementThematique($etablissementThematique, $comparison = null)
    {
        if ($etablissementThematique instanceof EtablissementThematique) {
            return $this
                ->addUsingAlias(ThematiquePeer::ID, $etablissementThematique->getThematiqueId(), $comparison);
        } elseif ($etablissementThematique instanceof PropelObjectCollection) {
            return $this
                ->useEtablissementThematiqueQuery()
                ->filterByPrimaryKeys($etablissementThematique->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEtablissementThematique() only accepts arguments of type EtablissementThematique or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EtablissementThematique relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ThematiqueQuery The current query, for fluid interface
     */
    public function joinEtablissementThematique($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EtablissementThematique');

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
            $this->addJoinObject($join, 'EtablissementThematique');
        }

        return $this;
    }

    /**
     * Use the EtablissementThematique relation EtablissementThematique object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\EtablissementThematiqueQuery A secondary query class using the current class as primary query
     */
    public function useEtablissementThematiqueQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEtablissementThematique($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EtablissementThematique', '\Cungfoo\Model\EtablissementThematiqueQuery');
    }

    /**
     * Filter the query by a related ThematiqueI18n object
     *
     * @param   ThematiqueI18n|PropelObjectCollection $thematiqueI18n  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ThematiqueQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByThematiqueI18n($thematiqueI18n, $comparison = null)
    {
        if ($thematiqueI18n instanceof ThematiqueI18n) {
            return $this
                ->addUsingAlias(ThematiquePeer::ID, $thematiqueI18n->getId(), $comparison);
        } elseif ($thematiqueI18n instanceof PropelObjectCollection) {
            return $this
                ->useThematiqueI18nQuery()
                ->filterByPrimaryKeys($thematiqueI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByThematiqueI18n() only accepts arguments of type ThematiqueI18n or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ThematiqueI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ThematiqueQuery The current query, for fluid interface
     */
    public function joinThematiqueI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ThematiqueI18n');

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
            $this->addJoinObject($join, 'ThematiqueI18n');
        }

        return $this;
    }

    /**
     * Use the ThematiqueI18n relation ThematiqueI18n object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\ThematiqueI18nQuery A secondary query class using the current class as primary query
     */
    public function useThematiqueI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinThematiqueI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ThematiqueI18n', '\Cungfoo\Model\ThematiqueI18nQuery');
    }

    /**
     * Filter the query by a related Etablissement object
     * using the etablissement_thematique table as cross reference
     *
     * @param   Etablissement $etablissement the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ThematiqueQuery The current query, for fluid interface
     */
    public function filterByEtablissement($etablissement, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useEtablissementThematiqueQuery()
            ->filterByEtablissement($etablissement, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   Thematique $thematique Object to remove from the list of results
     *
     * @return ThematiqueQuery The current query, for fluid interface
     */
    public function prune($thematique = null)
    {
        if ($thematique) {
            $this->addUsingAlias(ThematiquePeer::ID, $thematique->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     ThematiqueQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(ThematiquePeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     ThematiqueQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(ThematiquePeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     ThematiqueQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(ThematiquePeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     ThematiqueQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(ThematiquePeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     ThematiqueQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(ThematiquePeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     ThematiqueQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(ThematiquePeer::CREATED_AT);
    }
    // i18n behavior

    /**
     * Adds a JOIN clause to the query using the i18n relation
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    ThematiqueQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'ThematiqueI18n';

        return $this
            ->joinThematiqueI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    ThematiqueQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'fr', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('ThematiqueI18n');
        $this->with['ThematiqueI18n']->setIsWithOneToMany(false);

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
     * @return    ThematiqueI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ThematiqueI18n', 'Cungfoo\Model\ThematiqueI18nQuery');
    }

}
