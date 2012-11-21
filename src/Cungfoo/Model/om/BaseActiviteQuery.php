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
use Cungfoo\Model\Activite;
use Cungfoo\Model\ActiviteI18n;
use Cungfoo\Model\ActivitePeer;
use Cungfoo\Model\ActiviteQuery;
use Cungfoo\Model\Etablissement;
use Cungfoo\Model\EtablissementActivite;

/**
 * Base class that represents a query for the 'activite' table.
 *
 *
 *
 * @method ActiviteQuery orderById($order = Criteria::ASC) Order by the id column
 * @method ActiviteQuery orderByCode($order = Criteria::ASC) Order by the code column
 * @method ActiviteQuery orderByImagePath($order = Criteria::ASC) Order by the image_path column
 * @method ActiviteQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method ActiviteQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method ActiviteQuery orderByEnabled($order = Criteria::ASC) Order by the enabled column
 *
 * @method ActiviteQuery groupById() Group by the id column
 * @method ActiviteQuery groupByCode() Group by the code column
 * @method ActiviteQuery groupByImagePath() Group by the image_path column
 * @method ActiviteQuery groupByCreatedAt() Group by the created_at column
 * @method ActiviteQuery groupByUpdatedAt() Group by the updated_at column
 * @method ActiviteQuery groupByEnabled() Group by the enabled column
 *
 * @method ActiviteQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method ActiviteQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method ActiviteQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method ActiviteQuery leftJoinEtablissementActivite($relationAlias = null) Adds a LEFT JOIN clause to the query using the EtablissementActivite relation
 * @method ActiviteQuery rightJoinEtablissementActivite($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EtablissementActivite relation
 * @method ActiviteQuery innerJoinEtablissementActivite($relationAlias = null) Adds a INNER JOIN clause to the query using the EtablissementActivite relation
 *
 * @method ActiviteQuery leftJoinActiviteI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the ActiviteI18n relation
 * @method ActiviteQuery rightJoinActiviteI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ActiviteI18n relation
 * @method ActiviteQuery innerJoinActiviteI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the ActiviteI18n relation
 *
 * @method Activite findOne(PropelPDO $con = null) Return the first Activite matching the query
 * @method Activite findOneOrCreate(PropelPDO $con = null) Return the first Activite matching the query, or a new Activite object populated from the query conditions when no match is found
 *
 * @method Activite findOneByCode(string $code) Return the first Activite filtered by the code column
 * @method Activite findOneByImagePath(string $image_path) Return the first Activite filtered by the image_path column
 * @method Activite findOneByCreatedAt(string $created_at) Return the first Activite filtered by the created_at column
 * @method Activite findOneByUpdatedAt(string $updated_at) Return the first Activite filtered by the updated_at column
 * @method Activite findOneByEnabled(boolean $enabled) Return the first Activite filtered by the enabled column
 *
 * @method array findById(int $id) Return Activite objects filtered by the id column
 * @method array findByCode(string $code) Return Activite objects filtered by the code column
 * @method array findByImagePath(string $image_path) Return Activite objects filtered by the image_path column
 * @method array findByCreatedAt(string $created_at) Return Activite objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return Activite objects filtered by the updated_at column
 * @method array findByEnabled(boolean $enabled) Return Activite objects filtered by the enabled column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseActiviteQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseActiviteQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\Activite', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ActiviteQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     ActiviteQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return ActiviteQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof ActiviteQuery) {
            return $criteria;
        }
        $query = new ActiviteQuery();
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
     * @return   Activite|Activite[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ActivitePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(ActivitePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Activite A model object, or null if the key is not found
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
     * @return   Activite A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `CODE`, `IMAGE_PATH`, `CREATED_AT`, `UPDATED_AT`, `ENABLED` FROM `activite` WHERE `ID` = :p0';
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
            $obj = new Activite();
            $obj->hydrate($row);
            ActivitePeer::addInstanceToPool($obj, (string) $key);
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
     * @return Activite|Activite[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Activite[]|mixed the list of results, formatted by the current formatter
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
     * @return ActiviteQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ActivitePeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ActiviteQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ActivitePeer::ID, $keys, Criteria::IN);
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
     * @return ActiviteQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(ActivitePeer::ID, $id, $comparison);
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
     * @return ActiviteQuery The current query, for fluid interface
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

        return $this->addUsingAlias(ActivitePeer::CODE, $code, $comparison);
    }

    /**
     * Filter the query on the image_path column
     *
     * Example usage:
     * <code>
     * $query->filterByImagePath('fooValue');   // WHERE image_path = 'fooValue'
     * $query->filterByImagePath('%fooValue%'); // WHERE image_path LIKE '%fooValue%'
     * </code>
     *
     * @param     string $imagePath The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ActiviteQuery The current query, for fluid interface
     */
    public function filterByImagePath($imagePath = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($imagePath)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $imagePath)) {
                $imagePath = str_replace('*', '%', $imagePath);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ActivitePeer::IMAGE_PATH, $imagePath, $comparison);
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
     * @return ActiviteQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(ActivitePeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ActivitePeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ActivitePeer::CREATED_AT, $createdAt, $comparison);
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
     * @return ActiviteQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(ActivitePeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(ActivitePeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ActivitePeer::UPDATED_AT, $updatedAt, $comparison);
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
     * @return ActiviteQuery The current query, for fluid interface
     */
    public function filterByEnabled($enabled = null, $comparison = null)
    {
        if (is_string($enabled)) {
            $enabled = in_array(strtolower($enabled), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ActivitePeer::ENABLED, $enabled, $comparison);
    }

    /**
     * Filter the query by a related EtablissementActivite object
     *
     * @param   EtablissementActivite|PropelObjectCollection $etablissementActivite  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ActiviteQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByEtablissementActivite($etablissementActivite, $comparison = null)
    {
        if ($etablissementActivite instanceof EtablissementActivite) {
            return $this
                ->addUsingAlias(ActivitePeer::ID, $etablissementActivite->getActiviteId(), $comparison);
        } elseif ($etablissementActivite instanceof PropelObjectCollection) {
            return $this
                ->useEtablissementActiviteQuery()
                ->filterByPrimaryKeys($etablissementActivite->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEtablissementActivite() only accepts arguments of type EtablissementActivite or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EtablissementActivite relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ActiviteQuery The current query, for fluid interface
     */
    public function joinEtablissementActivite($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EtablissementActivite');

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
            $this->addJoinObject($join, 'EtablissementActivite');
        }

        return $this;
    }

    /**
     * Use the EtablissementActivite relation EtablissementActivite object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\EtablissementActiviteQuery A secondary query class using the current class as primary query
     */
    public function useEtablissementActiviteQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEtablissementActivite($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EtablissementActivite', '\Cungfoo\Model\EtablissementActiviteQuery');
    }

    /**
     * Filter the query by a related ActiviteI18n object
     *
     * @param   ActiviteI18n|PropelObjectCollection $activiteI18n  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ActiviteQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByActiviteI18n($activiteI18n, $comparison = null)
    {
        if ($activiteI18n instanceof ActiviteI18n) {
            return $this
                ->addUsingAlias(ActivitePeer::ID, $activiteI18n->getId(), $comparison);
        } elseif ($activiteI18n instanceof PropelObjectCollection) {
            return $this
                ->useActiviteI18nQuery()
                ->filterByPrimaryKeys($activiteI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByActiviteI18n() only accepts arguments of type ActiviteI18n or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ActiviteI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ActiviteQuery The current query, for fluid interface
     */
    public function joinActiviteI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ActiviteI18n');

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
            $this->addJoinObject($join, 'ActiviteI18n');
        }

        return $this;
    }

    /**
     * Use the ActiviteI18n relation ActiviteI18n object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\ActiviteI18nQuery A secondary query class using the current class as primary query
     */
    public function useActiviteI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinActiviteI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ActiviteI18n', '\Cungfoo\Model\ActiviteI18nQuery');
    }

    /**
     * Filter the query by a related Etablissement object
     * using the etablissement_activite table as cross reference
     *
     * @param   Etablissement $etablissement the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ActiviteQuery The current query, for fluid interface
     */
    public function filterByEtablissement($etablissement, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useEtablissementActiviteQuery()
            ->filterByEtablissement($etablissement, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   Activite $activite Object to remove from the list of results
     *
     * @return ActiviteQuery The current query, for fluid interface
     */
    public function prune($activite = null)
    {
        if ($activite) {
            $this->addUsingAlias(ActivitePeer::ID, $activite->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     ActiviteQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(ActivitePeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     ActiviteQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(ActivitePeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     ActiviteQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(ActivitePeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     ActiviteQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(ActivitePeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     ActiviteQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(ActivitePeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     ActiviteQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(ActivitePeer::CREATED_AT);
    }
    // i18n behavior

    /**
     * Adds a JOIN clause to the query using the i18n relation
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    ActiviteQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'ActiviteI18n';

        return $this
            ->joinActiviteI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    ActiviteQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'fr', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('ActiviteI18n');
        $this->with['ActiviteI18n']->setIsWithOneToMany(false);

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
     * @return    ActiviteI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ActiviteI18n', 'Cungfoo\Model\ActiviteI18nQuery');
    }

}
