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
use Cungfoo\Model\Pays;
use Cungfoo\Model\Region;
use Cungfoo\Model\RegionI18n;
use Cungfoo\Model\RegionPeer;
use Cungfoo\Model\RegionQuery;
use Cungfoo\Model\Ville;

/**
 * Base class that represents a query for the 'region' table.
 *
 * 
 *
 * @method RegionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method RegionQuery orderByCode($order = Criteria::ASC) Order by the code column
 * @method RegionQuery orderByImagePath($order = Criteria::ASC) Order by the image_path column
 * @method RegionQuery orderByImageEncartPath($order = Criteria::ASC) Order by the image_encart_path column
 * @method RegionQuery orderByImageEncartPetitePath($order = Criteria::ASC) Order by the image_encart_petite_path column
 * @method RegionQuery orderByPaysId($order = Criteria::ASC) Order by the pays_id column
 * @method RegionQuery orderByMeaHome($order = Criteria::ASC) Order by the mea_home column
 * @method RegionQuery orderByImageDetail1($order = Criteria::ASC) Order by the image_detail_1 column
 * @method RegionQuery orderByImageDetail2($order = Criteria::ASC) Order by the image_detail_2 column
 * @method RegionQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method RegionQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method RegionQuery orderByEnabled($order = Criteria::ASC) Order by the enabled column
 *
 * @method RegionQuery groupById() Group by the id column
 * @method RegionQuery groupByCode() Group by the code column
 * @method RegionQuery groupByImagePath() Group by the image_path column
 * @method RegionQuery groupByImageEncartPath() Group by the image_encart_path column
 * @method RegionQuery groupByImageEncartPetitePath() Group by the image_encart_petite_path column
 * @method RegionQuery groupByPaysId() Group by the pays_id column
 * @method RegionQuery groupByMeaHome() Group by the mea_home column
 * @method RegionQuery groupByImageDetail1() Group by the image_detail_1 column
 * @method RegionQuery groupByImageDetail2() Group by the image_detail_2 column
 * @method RegionQuery groupByCreatedAt() Group by the created_at column
 * @method RegionQuery groupByUpdatedAt() Group by the updated_at column
 * @method RegionQuery groupByEnabled() Group by the enabled column
 *
 * @method RegionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method RegionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method RegionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method RegionQuery leftJoinPays($relationAlias = null) Adds a LEFT JOIN clause to the query using the Pays relation
 * @method RegionQuery rightJoinPays($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Pays relation
 * @method RegionQuery innerJoinPays($relationAlias = null) Adds a INNER JOIN clause to the query using the Pays relation
 *
 * @method RegionQuery leftJoinVille($relationAlias = null) Adds a LEFT JOIN clause to the query using the Ville relation
 * @method RegionQuery rightJoinVille($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Ville relation
 * @method RegionQuery innerJoinVille($relationAlias = null) Adds a INNER JOIN clause to the query using the Ville relation
 *
 * @method RegionQuery leftJoinRegionI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the RegionI18n relation
 * @method RegionQuery rightJoinRegionI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RegionI18n relation
 * @method RegionQuery innerJoinRegionI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the RegionI18n relation
 *
 * @method Region findOne(PropelPDO $con = null) Return the first Region matching the query
 * @method Region findOneOrCreate(PropelPDO $con = null) Return the first Region matching the query, or a new Region object populated from the query conditions when no match is found
 *
 * @method Region findOneByCode(string $code) Return the first Region filtered by the code column
 * @method Region findOneByImagePath(string $image_path) Return the first Region filtered by the image_path column
 * @method Region findOneByImageEncartPath(string $image_encart_path) Return the first Region filtered by the image_encart_path column
 * @method Region findOneByImageEncartPetitePath(string $image_encart_petite_path) Return the first Region filtered by the image_encart_petite_path column
 * @method Region findOneByPaysId(int $pays_id) Return the first Region filtered by the pays_id column
 * @method Region findOneByMeaHome(boolean $mea_home) Return the first Region filtered by the mea_home column
 * @method Region findOneByImageDetail1(string $image_detail_1) Return the first Region filtered by the image_detail_1 column
 * @method Region findOneByImageDetail2(string $image_detail_2) Return the first Region filtered by the image_detail_2 column
 * @method Region findOneByCreatedAt(string $created_at) Return the first Region filtered by the created_at column
 * @method Region findOneByUpdatedAt(string $updated_at) Return the first Region filtered by the updated_at column
 * @method Region findOneByEnabled(boolean $enabled) Return the first Region filtered by the enabled column
 *
 * @method array findById(int $id) Return Region objects filtered by the id column
 * @method array findByCode(string $code) Return Region objects filtered by the code column
 * @method array findByImagePath(string $image_path) Return Region objects filtered by the image_path column
 * @method array findByImageEncartPath(string $image_encart_path) Return Region objects filtered by the image_encart_path column
 * @method array findByImageEncartPetitePath(string $image_encart_petite_path) Return Region objects filtered by the image_encart_petite_path column
 * @method array findByPaysId(int $pays_id) Return Region objects filtered by the pays_id column
 * @method array findByMeaHome(boolean $mea_home) Return Region objects filtered by the mea_home column
 * @method array findByImageDetail1(string $image_detail_1) Return Region objects filtered by the image_detail_1 column
 * @method array findByImageDetail2(string $image_detail_2) Return Region objects filtered by the image_detail_2 column
 * @method array findByCreatedAt(string $created_at) Return Region objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return Region objects filtered by the updated_at column
 * @method array findByEnabled(boolean $enabled) Return Region objects filtered by the enabled column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseRegionQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseRegionQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\Region', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new RegionQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     RegionQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return RegionQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof RegionQuery) {
            return $criteria;
        }
        $query = new RegionQuery();
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
     * @return   Region|Region[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = RegionPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(RegionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Region A model object, or null if the key is not found
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
     * @return   Region A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `CODE`, `IMAGE_PATH`, `IMAGE_ENCART_PATH`, `IMAGE_ENCART_PETITE_PATH`, `PAYS_ID`, `MEA_HOME`, `IMAGE_DETAIL_1`, `IMAGE_DETAIL_2`, `CREATED_AT`, `UPDATED_AT`, `ENABLED` FROM `region` WHERE `ID` = :p0';
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
            $obj = new Region();
            $obj->hydrate($row);
            RegionPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Region|Region[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Region[]|mixed the list of results, formatted by the current formatter
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
     * @return RegionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(RegionPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return RegionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(RegionPeer::ID, $keys, Criteria::IN);
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
     * @return RegionQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(RegionPeer::ID, $id, $comparison);
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
     * @return RegionQuery The current query, for fluid interface
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

        return $this->addUsingAlias(RegionPeer::CODE, $code, $comparison);
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
     * @return RegionQuery The current query, for fluid interface
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

        return $this->addUsingAlias(RegionPeer::IMAGE_PATH, $imagePath, $comparison);
    }

    /**
     * Filter the query on the image_encart_path column
     *
     * Example usage:
     * <code>
     * $query->filterByImageEncartPath('fooValue');   // WHERE image_encart_path = 'fooValue'
     * $query->filterByImageEncartPath('%fooValue%'); // WHERE image_encart_path LIKE '%fooValue%'
     * </code>
     *
     * @param     string $imageEncartPath The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RegionQuery The current query, for fluid interface
     */
    public function filterByImageEncartPath($imageEncartPath = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($imageEncartPath)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $imageEncartPath)) {
                $imageEncartPath = str_replace('*', '%', $imageEncartPath);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RegionPeer::IMAGE_ENCART_PATH, $imageEncartPath, $comparison);
    }

    /**
     * Filter the query on the image_encart_petite_path column
     *
     * Example usage:
     * <code>
     * $query->filterByImageEncartPetitePath('fooValue');   // WHERE image_encart_petite_path = 'fooValue'
     * $query->filterByImageEncartPetitePath('%fooValue%'); // WHERE image_encart_petite_path LIKE '%fooValue%'
     * </code>
     *
     * @param     string $imageEncartPetitePath The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RegionQuery The current query, for fluid interface
     */
    public function filterByImageEncartPetitePath($imageEncartPetitePath = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($imageEncartPetitePath)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $imageEncartPetitePath)) {
                $imageEncartPetitePath = str_replace('*', '%', $imageEncartPetitePath);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RegionPeer::IMAGE_ENCART_PETITE_PATH, $imageEncartPetitePath, $comparison);
    }

    /**
     * Filter the query on the pays_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPaysId(1234); // WHERE pays_id = 1234
     * $query->filterByPaysId(array(12, 34)); // WHERE pays_id IN (12, 34)
     * $query->filterByPaysId(array('min' => 12)); // WHERE pays_id > 12
     * </code>
     *
     * @see       filterByPays()
     *
     * @param     mixed $paysId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RegionQuery The current query, for fluid interface
     */
    public function filterByPaysId($paysId = null, $comparison = null)
    {
        if (is_array($paysId)) {
            $useMinMax = false;
            if (isset($paysId['min'])) {
                $this->addUsingAlias(RegionPeer::PAYS_ID, $paysId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($paysId['max'])) {
                $this->addUsingAlias(RegionPeer::PAYS_ID, $paysId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RegionPeer::PAYS_ID, $paysId, $comparison);
    }

    /**
     * Filter the query on the mea_home column
     *
     * Example usage:
     * <code>
     * $query->filterByMeaHome(true); // WHERE mea_home = true
     * $query->filterByMeaHome('yes'); // WHERE mea_home = true
     * </code>
     *
     * @param     boolean|string $meaHome The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RegionQuery The current query, for fluid interface
     */
    public function filterByMeaHome($meaHome = null, $comparison = null)
    {
        if (is_string($meaHome)) {
            $mea_home = in_array(strtolower($meaHome), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(RegionPeer::MEA_HOME, $meaHome, $comparison);
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
     * @return RegionQuery The current query, for fluid interface
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

        return $this->addUsingAlias(RegionPeer::IMAGE_DETAIL_1, $imageDetail1, $comparison);
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
     * @return RegionQuery The current query, for fluid interface
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

        return $this->addUsingAlias(RegionPeer::IMAGE_DETAIL_2, $imageDetail2, $comparison);
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
     * @return RegionQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(RegionPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(RegionPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RegionPeer::CREATED_AT, $createdAt, $comparison);
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
     * @return RegionQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(RegionPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(RegionPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RegionPeer::UPDATED_AT, $updatedAt, $comparison);
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
     * @return RegionQuery The current query, for fluid interface
     */
    public function filterByEnabled($enabled = null, $comparison = null)
    {
        if (is_string($enabled)) {
            $enabled = in_array(strtolower($enabled), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(RegionPeer::ENABLED, $enabled, $comparison);
    }

    /**
     * Filter the query by a related Pays object
     *
     * @param   Pays|PropelObjectCollection $pays The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   RegionQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByPays($pays, $comparison = null)
    {
        if ($pays instanceof Pays) {
            return $this
                ->addUsingAlias(RegionPeer::PAYS_ID, $pays->getId(), $comparison);
        } elseif ($pays instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RegionPeer::PAYS_ID, $pays->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPays() only accepts arguments of type Pays or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Pays relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return RegionQuery The current query, for fluid interface
     */
    public function joinPays($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Pays');

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
            $this->addJoinObject($join, 'Pays');
        }

        return $this;
    }

    /**
     * Use the Pays relation Pays object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\PaysQuery A secondary query class using the current class as primary query
     */
    public function usePaysQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPays($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Pays', '\Cungfoo\Model\PaysQuery');
    }

    /**
     * Filter the query by a related Ville object
     *
     * @param   Ville|PropelObjectCollection $ville  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   RegionQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByVille($ville, $comparison = null)
    {
        if ($ville instanceof Ville) {
            return $this
                ->addUsingAlias(RegionPeer::ID, $ville->getRegionId(), $comparison);
        } elseif ($ville instanceof PropelObjectCollection) {
            return $this
                ->useVilleQuery()
                ->filterByPrimaryKeys($ville->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByVille() only accepts arguments of type Ville or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Ville relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return RegionQuery The current query, for fluid interface
     */
    public function joinVille($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Ville');

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
            $this->addJoinObject($join, 'Ville');
        }

        return $this;
    }

    /**
     * Use the Ville relation Ville object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\VilleQuery A secondary query class using the current class as primary query
     */
    public function useVilleQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinVille($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Ville', '\Cungfoo\Model\VilleQuery');
    }

    /**
     * Filter the query by a related RegionI18n object
     *
     * @param   RegionI18n|PropelObjectCollection $regionI18n  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   RegionQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByRegionI18n($regionI18n, $comparison = null)
    {
        if ($regionI18n instanceof RegionI18n) {
            return $this
                ->addUsingAlias(RegionPeer::ID, $regionI18n->getId(), $comparison);
        } elseif ($regionI18n instanceof PropelObjectCollection) {
            return $this
                ->useRegionI18nQuery()
                ->filterByPrimaryKeys($regionI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByRegionI18n() only accepts arguments of type RegionI18n or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the RegionI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return RegionQuery The current query, for fluid interface
     */
    public function joinRegionI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('RegionI18n');

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
            $this->addJoinObject($join, 'RegionI18n');
        }

        return $this;
    }

    /**
     * Use the RegionI18n relation RegionI18n object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\RegionI18nQuery A secondary query class using the current class as primary query
     */
    public function useRegionI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinRegionI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'RegionI18n', '\Cungfoo\Model\RegionI18nQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Region $region Object to remove from the list of results
     *
     * @return RegionQuery The current query, for fluid interface
     */
    public function prune($region = null)
    {
        if ($region) {
            $this->addUsingAlias(RegionPeer::ID, $region->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior
    
    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     RegionQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(RegionPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }
    
    /**
     * Order by update date desc
     *
     * @return     RegionQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(RegionPeer::UPDATED_AT);
    }
    
    /**
     * Order by update date asc
     *
     * @return     RegionQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(RegionPeer::UPDATED_AT);
    }
    
    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     RegionQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(RegionPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }
    
    /**
     * Order by create date desc
     *
     * @return     RegionQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(RegionPeer::CREATED_AT);
    }
    
    /**
     * Order by create date asc
     *
     * @return     RegionQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(RegionPeer::CREATED_AT);
    }
    // i18n behavior
    
    /**
     * Adds a JOIN clause to the query using the i18n relation
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    RegionQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'RegionI18n';
    
        return $this
            ->joinRegionI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }
    
    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    RegionQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'fr', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('RegionI18n');
        $this->with['RegionI18n']->setIsWithOneToMany(false);
    
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
     * @return    RegionI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'RegionI18n', 'Cungfoo\Model\RegionI18nQuery');
    }

}
