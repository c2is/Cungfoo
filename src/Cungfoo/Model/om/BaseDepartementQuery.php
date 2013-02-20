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
use Cungfoo\Model\Departement;
use Cungfoo\Model\DepartementI18n;
use Cungfoo\Model\DepartementPeer;
use Cungfoo\Model\DepartementQuery;
use Cungfoo\Model\Etablissement;
use Cungfoo\Model\RegionRef;

/**
 * Base class that represents a query for the 'departement' table.
 *
 *
 *
 * @method DepartementQuery orderById($order = Criteria::ASC) Order by the id column
 * @method DepartementQuery orderByCode($order = Criteria::ASC) Order by the code column
 * @method DepartementQuery orderByRegionRefId($order = Criteria::ASC) Order by the region_ref_id column
 * @method DepartementQuery orderByImageDetail1($order = Criteria::ASC) Order by the image_detail_1 column
 * @method DepartementQuery orderByImageDetail2($order = Criteria::ASC) Order by the image_detail_2 column
 * @method DepartementQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method DepartementQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method DepartementQuery orderByActive($order = Criteria::ASC) Order by the active column
 *
 * @method DepartementQuery groupById() Group by the id column
 * @method DepartementQuery groupByCode() Group by the code column
 * @method DepartementQuery groupByRegionRefId() Group by the region_ref_id column
 * @method DepartementQuery groupByImageDetail1() Group by the image_detail_1 column
 * @method DepartementQuery groupByImageDetail2() Group by the image_detail_2 column
 * @method DepartementQuery groupByCreatedAt() Group by the created_at column
 * @method DepartementQuery groupByUpdatedAt() Group by the updated_at column
 * @method DepartementQuery groupByActive() Group by the active column
 *
 * @method DepartementQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method DepartementQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method DepartementQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method DepartementQuery leftJoinRegionRef($relationAlias = null) Adds a LEFT JOIN clause to the query using the RegionRef relation
 * @method DepartementQuery rightJoinRegionRef($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RegionRef relation
 * @method DepartementQuery innerJoinRegionRef($relationAlias = null) Adds a INNER JOIN clause to the query using the RegionRef relation
 *
 * @method DepartementQuery leftJoinEtablissement($relationAlias = null) Adds a LEFT JOIN clause to the query using the Etablissement relation
 * @method DepartementQuery rightJoinEtablissement($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Etablissement relation
 * @method DepartementQuery innerJoinEtablissement($relationAlias = null) Adds a INNER JOIN clause to the query using the Etablissement relation
 *
 * @method DepartementQuery leftJoinDepartementI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the DepartementI18n relation
 * @method DepartementQuery rightJoinDepartementI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DepartementI18n relation
 * @method DepartementQuery innerJoinDepartementI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the DepartementI18n relation
 *
 * @method Departement findOne(PropelPDO $con = null) Return the first Departement matching the query
 * @method Departement findOneOrCreate(PropelPDO $con = null) Return the first Departement matching the query, or a new Departement object populated from the query conditions when no match is found
 *
 * @method Departement findOneByCode(string $code) Return the first Departement filtered by the code column
 * @method Departement findOneByRegionRefId(int $region_ref_id) Return the first Departement filtered by the region_ref_id column
 * @method Departement findOneByImageDetail1(string $image_detail_1) Return the first Departement filtered by the image_detail_1 column
 * @method Departement findOneByImageDetail2(string $image_detail_2) Return the first Departement filtered by the image_detail_2 column
 * @method Departement findOneByCreatedAt(string $created_at) Return the first Departement filtered by the created_at column
 * @method Departement findOneByUpdatedAt(string $updated_at) Return the first Departement filtered by the updated_at column
 * @method Departement findOneByActive(boolean $active) Return the first Departement filtered by the active column
 *
 * @method array findById(int $id) Return Departement objects filtered by the id column
 * @method array findByCode(string $code) Return Departement objects filtered by the code column
 * @method array findByRegionRefId(int $region_ref_id) Return Departement objects filtered by the region_ref_id column
 * @method array findByImageDetail1(string $image_detail_1) Return Departement objects filtered by the image_detail_1 column
 * @method array findByImageDetail2(string $image_detail_2) Return Departement objects filtered by the image_detail_2 column
 * @method array findByCreatedAt(string $created_at) Return Departement objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return Departement objects filtered by the updated_at column
 * @method array findByActive(boolean $active) Return Departement objects filtered by the active column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseDepartementQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseDepartementQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\Departement', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new DepartementQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     DepartementQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return DepartementQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof DepartementQuery) {
            return $criteria;
        }
        $query = new DepartementQuery();
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
     * @return   Departement|Departement[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = DepartementPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(DepartementPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Departement A model object, or null if the key is not found
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
     * @return   Departement A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `code`, `region_ref_id`, `image_detail_1`, `image_detail_2`, `created_at`, `updated_at`, `active` FROM `departement` WHERE `id` = :p0';
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
            $obj = new Departement();
            $obj->hydrate($row);
            DepartementPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Departement|Departement[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Departement[]|mixed the list of results, formatted by the current formatter
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
     * @return DepartementQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(DepartementPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return DepartementQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(DepartementPeer::ID, $keys, Criteria::IN);
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
     * @return DepartementQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(DepartementPeer::ID, $id, $comparison);
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
     * @return DepartementQuery The current query, for fluid interface
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

        return $this->addUsingAlias(DepartementPeer::CODE, $code, $comparison);
    }

    /**
     * Filter the query on the region_ref_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRegionRefId(1234); // WHERE region_ref_id = 1234
     * $query->filterByRegionRefId(array(12, 34)); // WHERE region_ref_id IN (12, 34)
     * $query->filterByRegionRefId(array('min' => 12)); // WHERE region_ref_id > 12
     * </code>
     *
     * @see       filterByRegionRef()
     *
     * @param     mixed $regionRefId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DepartementQuery The current query, for fluid interface
     */
    public function filterByRegionRefId($regionRefId = null, $comparison = null)
    {
        if (is_array($regionRefId)) {
            $useMinMax = false;
            if (isset($regionRefId['min'])) {
                $this->addUsingAlias(DepartementPeer::REGION_REF_ID, $regionRefId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($regionRefId['max'])) {
                $this->addUsingAlias(DepartementPeer::REGION_REF_ID, $regionRefId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DepartementPeer::REGION_REF_ID, $regionRefId, $comparison);
    }

    /**
     * Filter the query on the image_detail_1 column
     *
     * Example usage:
     * <code>
     * $query->filterByImageDetail1('fooValue');   // WHERE image_detail_1 = 'fooValue'
     * $query->filterByImageDetail1('%fooValue%'); // WHERE image_detail_1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $imageDetail1 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DepartementQuery The current query, for fluid interface
     */
    public function filterByImageDetail1($imageDetail1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($imageDetail1)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $imageDetail1)) {
                $imageDetail1 = str_replace('*', '%', $imageDetail1);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DepartementPeer::IMAGE_DETAIL_1, $imageDetail1, $comparison);
    }

    /**
     * Filter the query on the image_detail_2 column
     *
     * Example usage:
     * <code>
     * $query->filterByImageDetail2('fooValue');   // WHERE image_detail_2 = 'fooValue'
     * $query->filterByImageDetail2('%fooValue%'); // WHERE image_detail_2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $imageDetail2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DepartementQuery The current query, for fluid interface
     */
    public function filterByImageDetail2($imageDetail2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($imageDetail2)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $imageDetail2)) {
                $imageDetail2 = str_replace('*', '%', $imageDetail2);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DepartementPeer::IMAGE_DETAIL_2, $imageDetail2, $comparison);
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
     * @return DepartementQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(DepartementPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(DepartementPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DepartementPeer::CREATED_AT, $createdAt, $comparison);
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
     * @return DepartementQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(DepartementPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(DepartementPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DepartementPeer::UPDATED_AT, $updatedAt, $comparison);
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
     * @return DepartementQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(DepartementPeer::ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query by a related RegionRef object
     *
     * @param   RegionRef|PropelObjectCollection $regionRef The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   DepartementQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByRegionRef($regionRef, $comparison = null)
    {
        if ($regionRef instanceof RegionRef) {
            return $this
                ->addUsingAlias(DepartementPeer::REGION_REF_ID, $regionRef->getId(), $comparison);
        } elseif ($regionRef instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DepartementPeer::REGION_REF_ID, $regionRef->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByRegionRef() only accepts arguments of type RegionRef or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the RegionRef relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return DepartementQuery The current query, for fluid interface
     */
    public function joinRegionRef($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('RegionRef');

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
            $this->addJoinObject($join, 'RegionRef');
        }

        return $this;
    }

    /**
     * Use the RegionRef relation RegionRef object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\RegionRefQuery A secondary query class using the current class as primary query
     */
    public function useRegionRefQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinRegionRef($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'RegionRef', '\Cungfoo\Model\RegionRefQuery');
    }

    /**
     * Filter the query by a related Etablissement object
     *
     * @param   Etablissement|PropelObjectCollection $etablissement  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   DepartementQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByEtablissement($etablissement, $comparison = null)
    {
        if ($etablissement instanceof Etablissement) {
            return $this
                ->addUsingAlias(DepartementPeer::ID, $etablissement->getDepartementId(), $comparison);
        } elseif ($etablissement instanceof PropelObjectCollection) {
            return $this
                ->useEtablissementQuery()
                ->filterByPrimaryKeys($etablissement->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEtablissement() only accepts arguments of type Etablissement or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Etablissement relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return DepartementQuery The current query, for fluid interface
     */
    public function joinEtablissement($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Etablissement');

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
            $this->addJoinObject($join, 'Etablissement');
        }

        return $this;
    }

    /**
     * Use the Etablissement relation Etablissement object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\EtablissementQuery A secondary query class using the current class as primary query
     */
    public function useEtablissementQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinEtablissement($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Etablissement', '\Cungfoo\Model\EtablissementQuery');
    }

    /**
     * Filter the query by a related DepartementI18n object
     *
     * @param   DepartementI18n|PropelObjectCollection $departementI18n  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   DepartementQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByDepartementI18n($departementI18n, $comparison = null)
    {
        if ($departementI18n instanceof DepartementI18n) {
            return $this
                ->addUsingAlias(DepartementPeer::ID, $departementI18n->getId(), $comparison);
        } elseif ($departementI18n instanceof PropelObjectCollection) {
            return $this
                ->useDepartementI18nQuery()
                ->filterByPrimaryKeys($departementI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByDepartementI18n() only accepts arguments of type DepartementI18n or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the DepartementI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return DepartementQuery The current query, for fluid interface
     */
    public function joinDepartementI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('DepartementI18n');

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
            $this->addJoinObject($join, 'DepartementI18n');
        }

        return $this;
    }

    /**
     * Use the DepartementI18n relation DepartementI18n object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\DepartementI18nQuery A secondary query class using the current class as primary query
     */
    public function useDepartementI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinDepartementI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'DepartementI18n', '\Cungfoo\Model\DepartementI18nQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Departement $departement Object to remove from the list of results
     *
     * @return DepartementQuery The current query, for fluid interface
     */
    public function prune($departement = null)
    {
        if ($departement) {
            $this->addUsingAlias(DepartementPeer::ID, $departement->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     DepartementQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(DepartementPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     DepartementQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(DepartementPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     DepartementQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(DepartementPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     DepartementQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(DepartementPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     DepartementQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(DepartementPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     DepartementQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(DepartementPeer::CREATED_AT);
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
     * @return    DepartementQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'DepartementI18n';

        return $this
            ->joinDepartementI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    DepartementQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'fr', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('DepartementI18n');
        $this->with['DepartementI18n']->setIsWithOneToMany(false);

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
     * @return    DepartementI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'DepartementI18n', 'Cungfoo\Model\DepartementI18nQuery');
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
