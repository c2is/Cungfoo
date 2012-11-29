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
use Cungfoo\Model\EtablissementPointInteret;
use Cungfoo\Model\PointInteret;
use Cungfoo\Model\PointInteretI18n;
use Cungfoo\Model\PointInteretPeer;
use Cungfoo\Model\PointInteretQuery;

/**
 * Base class that represents a query for the 'point_interet' table.
 *
 *
 *
 * @method PointInteretQuery orderById($order = Criteria::ASC) Order by the id column
 * @method PointInteretQuery orderByCode($order = Criteria::ASC) Order by the code column
 * @method PointInteretQuery orderByAddress($order = Criteria::ASC) Order by the address column
 * @method PointInteretQuery orderByAddress2($order = Criteria::ASC) Order by the address2 column
 * @method PointInteretQuery orderByZipcode($order = Criteria::ASC) Order by the zipcode column
 * @method PointInteretQuery orderByCity($order = Criteria::ASC) Order by the city column
 * @method PointInteretQuery orderByGeoCoordinateX($order = Criteria::ASC) Order by the geo_coordinate_x column
 * @method PointInteretQuery orderByGeoCoordinateY($order = Criteria::ASC) Order by the geo_coordinate_y column
 * @method PointInteretQuery orderByImage($order = Criteria::ASC) Order by the image column
 * @method PointInteretQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method PointInteretQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method PointInteretQuery orderByActive($order = Criteria::ASC) Order by the active column
 *
 * @method PointInteretQuery groupById() Group by the id column
 * @method PointInteretQuery groupByCode() Group by the code column
 * @method PointInteretQuery groupByAddress() Group by the address column
 * @method PointInteretQuery groupByAddress2() Group by the address2 column
 * @method PointInteretQuery groupByZipcode() Group by the zipcode column
 * @method PointInteretQuery groupByCity() Group by the city column
 * @method PointInteretQuery groupByGeoCoordinateX() Group by the geo_coordinate_x column
 * @method PointInteretQuery groupByGeoCoordinateY() Group by the geo_coordinate_y column
 * @method PointInteretQuery groupByImage() Group by the image column
 * @method PointInteretQuery groupByCreatedAt() Group by the created_at column
 * @method PointInteretQuery groupByUpdatedAt() Group by the updated_at column
 * @method PointInteretQuery groupByActive() Group by the active column
 *
 * @method PointInteretQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method PointInteretQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method PointInteretQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method PointInteretQuery leftJoinEtablissementPointInteret($relationAlias = null) Adds a LEFT JOIN clause to the query using the EtablissementPointInteret relation
 * @method PointInteretQuery rightJoinEtablissementPointInteret($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EtablissementPointInteret relation
 * @method PointInteretQuery innerJoinEtablissementPointInteret($relationAlias = null) Adds a INNER JOIN clause to the query using the EtablissementPointInteret relation
 *
 * @method PointInteretQuery leftJoinPointInteretI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the PointInteretI18n relation
 * @method PointInteretQuery rightJoinPointInteretI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PointInteretI18n relation
 * @method PointInteretQuery innerJoinPointInteretI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the PointInteretI18n relation
 *
 * @method PointInteret findOne(PropelPDO $con = null) Return the first PointInteret matching the query
 * @method PointInteret findOneOrCreate(PropelPDO $con = null) Return the first PointInteret matching the query, or a new PointInteret object populated from the query conditions when no match is found
 *
 * @method PointInteret findOneByCode(string $code) Return the first PointInteret filtered by the code column
 * @method PointInteret findOneByAddress(string $address) Return the first PointInteret filtered by the address column
 * @method PointInteret findOneByAddress2(string $address2) Return the first PointInteret filtered by the address2 column
 * @method PointInteret findOneByZipcode(string $zipcode) Return the first PointInteret filtered by the zipcode column
 * @method PointInteret findOneByCity(string $city) Return the first PointInteret filtered by the city column
 * @method PointInteret findOneByGeoCoordinateX(string $geo_coordinate_x) Return the first PointInteret filtered by the geo_coordinate_x column
 * @method PointInteret findOneByGeoCoordinateY(string $geo_coordinate_y) Return the first PointInteret filtered by the geo_coordinate_y column
 * @method PointInteret findOneByImage(string $image) Return the first PointInteret filtered by the image column
 * @method PointInteret findOneByCreatedAt(string $created_at) Return the first PointInteret filtered by the created_at column
 * @method PointInteret findOneByUpdatedAt(string $updated_at) Return the first PointInteret filtered by the updated_at column
 * @method PointInteret findOneByActive(boolean $active) Return the first PointInteret filtered by the active column
 *
 * @method array findById(int $id) Return PointInteret objects filtered by the id column
 * @method array findByCode(string $code) Return PointInteret objects filtered by the code column
 * @method array findByAddress(string $address) Return PointInteret objects filtered by the address column
 * @method array findByAddress2(string $address2) Return PointInteret objects filtered by the address2 column
 * @method array findByZipcode(string $zipcode) Return PointInteret objects filtered by the zipcode column
 * @method array findByCity(string $city) Return PointInteret objects filtered by the city column
 * @method array findByGeoCoordinateX(string $geo_coordinate_x) Return PointInteret objects filtered by the geo_coordinate_x column
 * @method array findByGeoCoordinateY(string $geo_coordinate_y) Return PointInteret objects filtered by the geo_coordinate_y column
 * @method array findByImage(string $image) Return PointInteret objects filtered by the image column
 * @method array findByCreatedAt(string $created_at) Return PointInteret objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return PointInteret objects filtered by the updated_at column
 * @method array findByActive(boolean $active) Return PointInteret objects filtered by the active column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BasePointInteretQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BasePointInteretQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\PointInteret', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new PointInteretQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     PointInteretQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return PointInteretQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof PointInteretQuery) {
            return $criteria;
        }
        $query = new PointInteretQuery();
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
     * @return   PointInteret|PointInteret[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PointInteretPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(PointInteretPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   PointInteret A model object, or null if the key is not found
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
     * @return   PointInteret A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `code`, `address`, `address2`, `zipcode`, `city`, `geo_coordinate_x`, `geo_coordinate_y`, `image`, `created_at`, `updated_at`, `active` FROM `point_interet` WHERE `id` = :p0';
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
            $obj = new PointInteret();
            $obj->hydrate($row);
            PointInteretPeer::addInstanceToPool($obj, (string) $key);
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
     * @return PointInteret|PointInteret[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|PointInteret[]|mixed the list of results, formatted by the current formatter
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
     * @return PointInteretQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PointInteretPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return PointInteretQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PointInteretPeer::ID, $keys, Criteria::IN);
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
     * @return PointInteretQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(PointInteretPeer::ID, $id, $comparison);
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
     * @return PointInteretQuery The current query, for fluid interface
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

        return $this->addUsingAlias(PointInteretPeer::CODE, $code, $comparison);
    }

    /**
     * Filter the query on the address column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress('fooValue');   // WHERE address = 'fooValue'
     * $query->filterByAddress('%fooValue%'); // WHERE address LIKE '%fooValue%'
     * </code>
     *
     * @param     string $address The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PointInteretQuery The current query, for fluid interface
     */
    public function filterByAddress($address = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($address)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $address)) {
                $address = str_replace('*', '%', $address);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PointInteretPeer::ADDRESS, $address, $comparison);
    }

    /**
     * Filter the query on the address2 column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress2('fooValue');   // WHERE address2 = 'fooValue'
     * $query->filterByAddress2('%fooValue%'); // WHERE address2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $address2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PointInteretQuery The current query, for fluid interface
     */
    public function filterByAddress2($address2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($address2)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $address2)) {
                $address2 = str_replace('*', '%', $address2);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PointInteretPeer::ADDRESS2, $address2, $comparison);
    }

    /**
     * Filter the query on the zipcode column
     *
     * Example usage:
     * <code>
     * $query->filterByZipcode('fooValue');   // WHERE zipcode = 'fooValue'
     * $query->filterByZipcode('%fooValue%'); // WHERE zipcode LIKE '%fooValue%'
     * </code>
     *
     * @param     string $zipcode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PointInteretQuery The current query, for fluid interface
     */
    public function filterByZipcode($zipcode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($zipcode)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $zipcode)) {
                $zipcode = str_replace('*', '%', $zipcode);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PointInteretPeer::ZIPCODE, $zipcode, $comparison);
    }

    /**
     * Filter the query on the city column
     *
     * Example usage:
     * <code>
     * $query->filterByCity('fooValue');   // WHERE city = 'fooValue'
     * $query->filterByCity('%fooValue%'); // WHERE city LIKE '%fooValue%'
     * </code>
     *
     * @param     string $city The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PointInteretQuery The current query, for fluid interface
     */
    public function filterByCity($city = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($city)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $city)) {
                $city = str_replace('*', '%', $city);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PointInteretPeer::CITY, $city, $comparison);
    }

    /**
     * Filter the query on the geo_coordinate_x column
     *
     * Example usage:
     * <code>
     * $query->filterByGeoCoordinateX('fooValue');   // WHERE geo_coordinate_x = 'fooValue'
     * $query->filterByGeoCoordinateX('%fooValue%'); // WHERE geo_coordinate_x LIKE '%fooValue%'
     * </code>
     *
     * @param     string $geoCoordinateX The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PointInteretQuery The current query, for fluid interface
     */
    public function filterByGeoCoordinateX($geoCoordinateX = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($geoCoordinateX)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $geoCoordinateX)) {
                $geoCoordinateX = str_replace('*', '%', $geoCoordinateX);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PointInteretPeer::GEO_COORDINATE_X, $geoCoordinateX, $comparison);
    }

    /**
     * Filter the query on the geo_coordinate_y column
     *
     * Example usage:
     * <code>
     * $query->filterByGeoCoordinateY('fooValue');   // WHERE geo_coordinate_y = 'fooValue'
     * $query->filterByGeoCoordinateY('%fooValue%'); // WHERE geo_coordinate_y LIKE '%fooValue%'
     * </code>
     *
     * @param     string $geoCoordinateY The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PointInteretQuery The current query, for fluid interface
     */
    public function filterByGeoCoordinateY($geoCoordinateY = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($geoCoordinateY)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $geoCoordinateY)) {
                $geoCoordinateY = str_replace('*', '%', $geoCoordinateY);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PointInteretPeer::GEO_COORDINATE_Y, $geoCoordinateY, $comparison);
    }

    /**
     * Filter the query on the image column
     *
     * Example usage:
     * <code>
     * $query->filterByImage('fooValue');   // WHERE image = 'fooValue'
     * $query->filterByImage('%fooValue%'); // WHERE image LIKE '%fooValue%'
     * </code>
     *
     * @param     string $image The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PointInteretQuery The current query, for fluid interface
     */
    public function filterByImage($image = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($image)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $image)) {
                $image = str_replace('*', '%', $image);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PointInteretPeer::IMAGE, $image, $comparison);
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
     * @return PointInteretQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(PointInteretPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(PointInteretPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PointInteretPeer::CREATED_AT, $createdAt, $comparison);
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
     * @return PointInteretQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(PointInteretPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(PointInteretPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PointInteretPeer::UPDATED_AT, $updatedAt, $comparison);
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
     * @return PointInteretQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(PointInteretPeer::ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query by a related EtablissementPointInteret object
     *
     * @param   EtablissementPointInteret|PropelObjectCollection $etablissementPointInteret  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PointInteretQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByEtablissementPointInteret($etablissementPointInteret, $comparison = null)
    {
        if ($etablissementPointInteret instanceof EtablissementPointInteret) {
            return $this
                ->addUsingAlias(PointInteretPeer::ID, $etablissementPointInteret->getPointInteretId(), $comparison);
        } elseif ($etablissementPointInteret instanceof PropelObjectCollection) {
            return $this
                ->useEtablissementPointInteretQuery()
                ->filterByPrimaryKeys($etablissementPointInteret->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEtablissementPointInteret() only accepts arguments of type EtablissementPointInteret or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EtablissementPointInteret relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PointInteretQuery The current query, for fluid interface
     */
    public function joinEtablissementPointInteret($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EtablissementPointInteret');

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
            $this->addJoinObject($join, 'EtablissementPointInteret');
        }

        return $this;
    }

    /**
     * Use the EtablissementPointInteret relation EtablissementPointInteret object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\EtablissementPointInteretQuery A secondary query class using the current class as primary query
     */
    public function useEtablissementPointInteretQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEtablissementPointInteret($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EtablissementPointInteret', '\Cungfoo\Model\EtablissementPointInteretQuery');
    }

    /**
     * Filter the query by a related PointInteretI18n object
     *
     * @param   PointInteretI18n|PropelObjectCollection $pointInteretI18n  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PointInteretQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByPointInteretI18n($pointInteretI18n, $comparison = null)
    {
        if ($pointInteretI18n instanceof PointInteretI18n) {
            return $this
                ->addUsingAlias(PointInteretPeer::ID, $pointInteretI18n->getId(), $comparison);
        } elseif ($pointInteretI18n instanceof PropelObjectCollection) {
            return $this
                ->usePointInteretI18nQuery()
                ->filterByPrimaryKeys($pointInteretI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPointInteretI18n() only accepts arguments of type PointInteretI18n or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PointInteretI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PointInteretQuery The current query, for fluid interface
     */
    public function joinPointInteretI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PointInteretI18n');

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
            $this->addJoinObject($join, 'PointInteretI18n');
        }

        return $this;
    }

    /**
     * Use the PointInteretI18n relation PointInteretI18n object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\PointInteretI18nQuery A secondary query class using the current class as primary query
     */
    public function usePointInteretI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinPointInteretI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PointInteretI18n', '\Cungfoo\Model\PointInteretI18nQuery');
    }

    /**
     * Filter the query by a related Etablissement object
     * using the etablissement_point_interet table as cross reference
     *
     * @param   Etablissement $etablissement the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PointInteretQuery The current query, for fluid interface
     */
    public function filterByEtablissement($etablissement, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useEtablissementPointInteretQuery()
            ->filterByEtablissement($etablissement, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   PointInteret $pointInteret Object to remove from the list of results
     *
     * @return PointInteretQuery The current query, for fluid interface
     */
    public function prune($pointInteret = null)
    {
        if ($pointInteret) {
            $this->addUsingAlias(PointInteretPeer::ID, $pointInteret->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     PointInteretQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(PointInteretPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     PointInteretQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(PointInteretPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     PointInteretQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(PointInteretPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     PointInteretQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(PointInteretPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     PointInteretQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(PointInteretPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     PointInteretQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(PointInteretPeer::CREATED_AT);
    }
    // active behavior

    /**
     * return only active objects
     *
     * @return boolean
     */
    public function findActive($con = null)
    {
        $this->filterByActive(true);

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
     * @return    PointInteretQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'PointInteretI18n';

        return $this
            ->joinPointInteretI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    PointInteretQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'fr', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('PointInteretI18n');
        $this->with['PointInteretI18n']->setIsWithOneToMany(false);

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
     * @return    PointInteretI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PointInteretI18n', 'Cungfoo\Model\PointInteretI18nQuery');
    }

}
