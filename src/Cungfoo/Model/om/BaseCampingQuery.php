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
use Cungfoo\Model\Camping;
use Cungfoo\Model\CampingActivite;
use Cungfoo\Model\CampingDestination;
use Cungfoo\Model\CampingEquipement;
use Cungfoo\Model\CampingPeer;
use Cungfoo\Model\CampingQuery;
use Cungfoo\Model\CampingServiceComplementaire;
use Cungfoo\Model\CampingTypeHebergement;
use Cungfoo\Model\Destination;
use Cungfoo\Model\Equipement;
use Cungfoo\Model\ServiceComplementaire;
use Cungfoo\Model\TypeHebergement;
use Cungfoo\Model\Ville;

/**
 * Base class that represents a query for the 'camping' table.
 *
 *
 *
 * @method CampingQuery orderById($order = Criteria::ASC) Order by the id column
 * @method CampingQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method CampingQuery orderByAddress1($order = Criteria::ASC) Order by the address1 column
 * @method CampingQuery orderByAddress2($order = Criteria::ASC) Order by the address2 column
 * @method CampingQuery orderByZip($order = Criteria::ASC) Order by the zip column
 * @method CampingQuery orderByCity($order = Criteria::ASC) Order by the city column
 * @method CampingQuery orderByMail($order = Criteria::ASC) Order by the mail column
 * @method CampingQuery orderByCountry($order = Criteria::ASC) Order by the country column
 * @method CampingQuery orderByCountryCode($order = Criteria::ASC) Order by the country_code column
 * @method CampingQuery orderByPhone1($order = Criteria::ASC) Order by the phone1 column
 * @method CampingQuery orderByPhone2($order = Criteria::ASC) Order by the phone2 column
 * @method CampingQuery orderByFax($order = Criteria::ASC) Order by the fax column
 * @method CampingQuery orderByVilleId($order = Criteria::ASC) Order by the ville_id column
 *
 * @method CampingQuery groupById() Group by the id column
 * @method CampingQuery groupByName() Group by the name column
 * @method CampingQuery groupByAddress1() Group by the address1 column
 * @method CampingQuery groupByAddress2() Group by the address2 column
 * @method CampingQuery groupByZip() Group by the zip column
 * @method CampingQuery groupByCity() Group by the city column
 * @method CampingQuery groupByMail() Group by the mail column
 * @method CampingQuery groupByCountry() Group by the country column
 * @method CampingQuery groupByCountryCode() Group by the country_code column
 * @method CampingQuery groupByPhone1() Group by the phone1 column
 * @method CampingQuery groupByPhone2() Group by the phone2 column
 * @method CampingQuery groupByFax() Group by the fax column
 * @method CampingQuery groupByVilleId() Group by the ville_id column
 *
 * @method CampingQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method CampingQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method CampingQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method CampingQuery leftJoinVille($relationAlias = null) Adds a LEFT JOIN clause to the query using the Ville relation
 * @method CampingQuery rightJoinVille($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Ville relation
 * @method CampingQuery innerJoinVille($relationAlias = null) Adds a INNER JOIN clause to the query using the Ville relation
 *
 * @method CampingQuery leftJoinCampingTypeHebergement($relationAlias = null) Adds a LEFT JOIN clause to the query using the CampingTypeHebergement relation
 * @method CampingQuery rightJoinCampingTypeHebergement($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CampingTypeHebergement relation
 * @method CampingQuery innerJoinCampingTypeHebergement($relationAlias = null) Adds a INNER JOIN clause to the query using the CampingTypeHebergement relation
 *
 * @method CampingQuery leftJoinCampingDestination($relationAlias = null) Adds a LEFT JOIN clause to the query using the CampingDestination relation
 * @method CampingQuery rightJoinCampingDestination($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CampingDestination relation
 * @method CampingQuery innerJoinCampingDestination($relationAlias = null) Adds a INNER JOIN clause to the query using the CampingDestination relation
 *
 * @method CampingQuery leftJoinCampingActivite($relationAlias = null) Adds a LEFT JOIN clause to the query using the CampingActivite relation
 * @method CampingQuery rightJoinCampingActivite($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CampingActivite relation
 * @method CampingQuery innerJoinCampingActivite($relationAlias = null) Adds a INNER JOIN clause to the query using the CampingActivite relation
 *
 * @method CampingQuery leftJoinCampingEquipement($relationAlias = null) Adds a LEFT JOIN clause to the query using the CampingEquipement relation
 * @method CampingQuery rightJoinCampingEquipement($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CampingEquipement relation
 * @method CampingQuery innerJoinCampingEquipement($relationAlias = null) Adds a INNER JOIN clause to the query using the CampingEquipement relation
 *
 * @method CampingQuery leftJoinCampingServiceComplementaire($relationAlias = null) Adds a LEFT JOIN clause to the query using the CampingServiceComplementaire relation
 * @method CampingQuery rightJoinCampingServiceComplementaire($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CampingServiceComplementaire relation
 * @method CampingQuery innerJoinCampingServiceComplementaire($relationAlias = null) Adds a INNER JOIN clause to the query using the CampingServiceComplementaire relation
 *
 * @method Camping findOne(PropelPDO $con = null) Return the first Camping matching the query
 * @method Camping findOneOrCreate(PropelPDO $con = null) Return the first Camping matching the query, or a new Camping object populated from the query conditions when no match is found
 *
 * @method Camping findOneByName(string $name) Return the first Camping filtered by the name column
 * @method Camping findOneByAddress1(string $address1) Return the first Camping filtered by the address1 column
 * @method Camping findOneByAddress2(string $address2) Return the first Camping filtered by the address2 column
 * @method Camping findOneByZip(string $zip) Return the first Camping filtered by the zip column
 * @method Camping findOneByCity(string $city) Return the first Camping filtered by the city column
 * @method Camping findOneByMail(string $mail) Return the first Camping filtered by the mail column
 * @method Camping findOneByCountry(string $country) Return the first Camping filtered by the country column
 * @method Camping findOneByCountryCode(string $country_code) Return the first Camping filtered by the country_code column
 * @method Camping findOneByPhone1(string $phone1) Return the first Camping filtered by the phone1 column
 * @method Camping findOneByPhone2(string $phone2) Return the first Camping filtered by the phone2 column
 * @method Camping findOneByFax(string $fax) Return the first Camping filtered by the fax column
 * @method Camping findOneByVilleId(string $ville_id) Return the first Camping filtered by the ville_id column
 *
 * @method array findById(int $id) Return Camping objects filtered by the id column
 * @method array findByName(string $name) Return Camping objects filtered by the name column
 * @method array findByAddress1(string $address1) Return Camping objects filtered by the address1 column
 * @method array findByAddress2(string $address2) Return Camping objects filtered by the address2 column
 * @method array findByZip(string $zip) Return Camping objects filtered by the zip column
 * @method array findByCity(string $city) Return Camping objects filtered by the city column
 * @method array findByMail(string $mail) Return Camping objects filtered by the mail column
 * @method array findByCountry(string $country) Return Camping objects filtered by the country column
 * @method array findByCountryCode(string $country_code) Return Camping objects filtered by the country_code column
 * @method array findByPhone1(string $phone1) Return Camping objects filtered by the phone1 column
 * @method array findByPhone2(string $phone2) Return Camping objects filtered by the phone2 column
 * @method array findByFax(string $fax) Return Camping objects filtered by the fax column
 * @method array findByVilleId(string $ville_id) Return Camping objects filtered by the ville_id column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseCampingQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseCampingQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\Camping', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new CampingQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     CampingQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return CampingQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof CampingQuery) {
            return $criteria;
        }
        $query = new CampingQuery();
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
     * @return   Camping|Camping[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CampingPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(CampingPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Camping A model object, or null if the key is not found
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
     * @return   Camping A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `NAME`, `ADDRESS1`, `ADDRESS2`, `ZIP`, `CITY`, `MAIL`, `COUNTRY`, `COUNTRY_CODE`, `PHONE1`, `PHONE2`, `FAX`, `VILLE_ID` FROM `camping` WHERE `ID` = :p0';
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
            $obj = new Camping();
            $obj->hydrate($row);
            CampingPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Camping|Camping[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Camping[]|mixed the list of results, formatted by the current formatter
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
     * @return CampingQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CampingPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return CampingQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CampingPeer::ID, $keys, Criteria::IN);
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
     * @return CampingQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(CampingPeer::ID, $id, $comparison);
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
     * @return CampingQuery The current query, for fluid interface
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

        return $this->addUsingAlias(CampingPeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query on the address1 column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress1('fooValue');   // WHERE address1 = 'fooValue'
     * $query->filterByAddress1('%fooValue%'); // WHERE address1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $address1 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CampingQuery The current query, for fluid interface
     */
    public function filterByAddress1($address1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($address1)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $address1)) {
                $address1 = str_replace('*', '%', $address1);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CampingPeer::ADDRESS1, $address1, $comparison);
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
     * @return CampingQuery The current query, for fluid interface
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

        return $this->addUsingAlias(CampingPeer::ADDRESS2, $address2, $comparison);
    }

    /**
     * Filter the query on the zip column
     *
     * Example usage:
     * <code>
     * $query->filterByZip('fooValue');   // WHERE zip = 'fooValue'
     * $query->filterByZip('%fooValue%'); // WHERE zip LIKE '%fooValue%'
     * </code>
     *
     * @param     string $zip The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CampingQuery The current query, for fluid interface
     */
    public function filterByZip($zip = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($zip)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $zip)) {
                $zip = str_replace('*', '%', $zip);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CampingPeer::ZIP, $zip, $comparison);
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
     * @return CampingQuery The current query, for fluid interface
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

        return $this->addUsingAlias(CampingPeer::CITY, $city, $comparison);
    }

    /**
     * Filter the query on the mail column
     *
     * Example usage:
     * <code>
     * $query->filterByMail('fooValue');   // WHERE mail = 'fooValue'
     * $query->filterByMail('%fooValue%'); // WHERE mail LIKE '%fooValue%'
     * </code>
     *
     * @param     string $mail The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CampingQuery The current query, for fluid interface
     */
    public function filterByMail($mail = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mail)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $mail)) {
                $mail = str_replace('*', '%', $mail);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CampingPeer::MAIL, $mail, $comparison);
    }

    /**
     * Filter the query on the country column
     *
     * Example usage:
     * <code>
     * $query->filterByCountry('fooValue');   // WHERE country = 'fooValue'
     * $query->filterByCountry('%fooValue%'); // WHERE country LIKE '%fooValue%'
     * </code>
     *
     * @param     string $country The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CampingQuery The current query, for fluid interface
     */
    public function filterByCountry($country = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($country)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $country)) {
                $country = str_replace('*', '%', $country);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CampingPeer::COUNTRY, $country, $comparison);
    }

    /**
     * Filter the query on the country_code column
     *
     * Example usage:
     * <code>
     * $query->filterByCountryCode('fooValue');   // WHERE country_code = 'fooValue'
     * $query->filterByCountryCode('%fooValue%'); // WHERE country_code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $countryCode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CampingQuery The current query, for fluid interface
     */
    public function filterByCountryCode($countryCode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($countryCode)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $countryCode)) {
                $countryCode = str_replace('*', '%', $countryCode);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CampingPeer::COUNTRY_CODE, $countryCode, $comparison);
    }

    /**
     * Filter the query on the phone1 column
     *
     * Example usage:
     * <code>
     * $query->filterByPhone1('fooValue');   // WHERE phone1 = 'fooValue'
     * $query->filterByPhone1('%fooValue%'); // WHERE phone1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $phone1 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CampingQuery The current query, for fluid interface
     */
    public function filterByPhone1($phone1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phone1)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $phone1)) {
                $phone1 = str_replace('*', '%', $phone1);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CampingPeer::PHONE1, $phone1, $comparison);
    }

    /**
     * Filter the query on the phone2 column
     *
     * Example usage:
     * <code>
     * $query->filterByPhone2('fooValue');   // WHERE phone2 = 'fooValue'
     * $query->filterByPhone2('%fooValue%'); // WHERE phone2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $phone2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CampingQuery The current query, for fluid interface
     */
    public function filterByPhone2($phone2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phone2)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $phone2)) {
                $phone2 = str_replace('*', '%', $phone2);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CampingPeer::PHONE2, $phone2, $comparison);
    }

    /**
     * Filter the query on the fax column
     *
     * Example usage:
     * <code>
     * $query->filterByFax('fooValue');   // WHERE fax = 'fooValue'
     * $query->filterByFax('%fooValue%'); // WHERE fax LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fax The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CampingQuery The current query, for fluid interface
     */
    public function filterByFax($fax = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fax)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $fax)) {
                $fax = str_replace('*', '%', $fax);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CampingPeer::FAX, $fax, $comparison);
    }

    /**
     * Filter the query on the ville_id column
     *
     * Example usage:
     * <code>
     * $query->filterByVilleId('fooValue');   // WHERE ville_id = 'fooValue'
     * $query->filterByVilleId('%fooValue%'); // WHERE ville_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $villeId The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CampingQuery The current query, for fluid interface
     */
    public function filterByVilleId($villeId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($villeId)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $villeId)) {
                $villeId = str_replace('*', '%', $villeId);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CampingPeer::VILLE_ID, $villeId, $comparison);
    }

    /**
     * Filter the query by a related Ville object
     *
     * @param   Ville|PropelObjectCollection $ville The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   CampingQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByVille($ville, $comparison = null)
    {
        if ($ville instanceof Ville) {
            return $this
                ->addUsingAlias(CampingPeer::VILLE_ID, $ville->getId(), $comparison);
        } elseif ($ville instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CampingPeer::VILLE_ID, $ville->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return CampingQuery The current query, for fluid interface
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
     * Filter the query by a related CampingTypeHebergement object
     *
     * @param   CampingTypeHebergement|PropelObjectCollection $campingTypeHebergement  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   CampingQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByCampingTypeHebergement($campingTypeHebergement, $comparison = null)
    {
        if ($campingTypeHebergement instanceof CampingTypeHebergement) {
            return $this
                ->addUsingAlias(CampingPeer::ID, $campingTypeHebergement->getCampingId(), $comparison);
        } elseif ($campingTypeHebergement instanceof PropelObjectCollection) {
            return $this
                ->useCampingTypeHebergementQuery()
                ->filterByPrimaryKeys($campingTypeHebergement->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCampingTypeHebergement() only accepts arguments of type CampingTypeHebergement or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CampingTypeHebergement relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return CampingQuery The current query, for fluid interface
     */
    public function joinCampingTypeHebergement($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CampingTypeHebergement');

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
            $this->addJoinObject($join, 'CampingTypeHebergement');
        }

        return $this;
    }

    /**
     * Use the CampingTypeHebergement relation CampingTypeHebergement object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\CampingTypeHebergementQuery A secondary query class using the current class as primary query
     */
    public function useCampingTypeHebergementQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCampingTypeHebergement($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CampingTypeHebergement', '\Cungfoo\Model\CampingTypeHebergementQuery');
    }

    /**
     * Filter the query by a related CampingDestination object
     *
     * @param   CampingDestination|PropelObjectCollection $campingDestination  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   CampingQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByCampingDestination($campingDestination, $comparison = null)
    {
        if ($campingDestination instanceof CampingDestination) {
            return $this
                ->addUsingAlias(CampingPeer::ID, $campingDestination->getCampingId(), $comparison);
        } elseif ($campingDestination instanceof PropelObjectCollection) {
            return $this
                ->useCampingDestinationQuery()
                ->filterByPrimaryKeys($campingDestination->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCampingDestination() only accepts arguments of type CampingDestination or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CampingDestination relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return CampingQuery The current query, for fluid interface
     */
    public function joinCampingDestination($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CampingDestination');

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
            $this->addJoinObject($join, 'CampingDestination');
        }

        return $this;
    }

    /**
     * Use the CampingDestination relation CampingDestination object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\CampingDestinationQuery A secondary query class using the current class as primary query
     */
    public function useCampingDestinationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCampingDestination($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CampingDestination', '\Cungfoo\Model\CampingDestinationQuery');
    }

    /**
     * Filter the query by a related CampingActivite object
     *
     * @param   CampingActivite|PropelObjectCollection $campingActivite  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   CampingQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByCampingActivite($campingActivite, $comparison = null)
    {
        if ($campingActivite instanceof CampingActivite) {
            return $this
                ->addUsingAlias(CampingPeer::ID, $campingActivite->getCampingId(), $comparison);
        } elseif ($campingActivite instanceof PropelObjectCollection) {
            return $this
                ->useCampingActiviteQuery()
                ->filterByPrimaryKeys($campingActivite->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCampingActivite() only accepts arguments of type CampingActivite or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CampingActivite relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return CampingQuery The current query, for fluid interface
     */
    public function joinCampingActivite($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CampingActivite');

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
            $this->addJoinObject($join, 'CampingActivite');
        }

        return $this;
    }

    /**
     * Use the CampingActivite relation CampingActivite object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\CampingActiviteQuery A secondary query class using the current class as primary query
     */
    public function useCampingActiviteQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCampingActivite($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CampingActivite', '\Cungfoo\Model\CampingActiviteQuery');
    }

    /**
     * Filter the query by a related CampingEquipement object
     *
     * @param   CampingEquipement|PropelObjectCollection $campingEquipement  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   CampingQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByCampingEquipement($campingEquipement, $comparison = null)
    {
        if ($campingEquipement instanceof CampingEquipement) {
            return $this
                ->addUsingAlias(CampingPeer::ID, $campingEquipement->getCampingId(), $comparison);
        } elseif ($campingEquipement instanceof PropelObjectCollection) {
            return $this
                ->useCampingEquipementQuery()
                ->filterByPrimaryKeys($campingEquipement->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCampingEquipement() only accepts arguments of type CampingEquipement or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CampingEquipement relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return CampingQuery The current query, for fluid interface
     */
    public function joinCampingEquipement($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CampingEquipement');

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
            $this->addJoinObject($join, 'CampingEquipement');
        }

        return $this;
    }

    /**
     * Use the CampingEquipement relation CampingEquipement object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\CampingEquipementQuery A secondary query class using the current class as primary query
     */
    public function useCampingEquipementQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCampingEquipement($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CampingEquipement', '\Cungfoo\Model\CampingEquipementQuery');
    }

    /**
     * Filter the query by a related CampingServiceComplementaire object
     *
     * @param   CampingServiceComplementaire|PropelObjectCollection $campingServiceComplementaire  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   CampingQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByCampingServiceComplementaire($campingServiceComplementaire, $comparison = null)
    {
        if ($campingServiceComplementaire instanceof CampingServiceComplementaire) {
            return $this
                ->addUsingAlias(CampingPeer::ID, $campingServiceComplementaire->getCampingId(), $comparison);
        } elseif ($campingServiceComplementaire instanceof PropelObjectCollection) {
            return $this
                ->useCampingServiceComplementaireQuery()
                ->filterByPrimaryKeys($campingServiceComplementaire->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCampingServiceComplementaire() only accepts arguments of type CampingServiceComplementaire or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CampingServiceComplementaire relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return CampingQuery The current query, for fluid interface
     */
    public function joinCampingServiceComplementaire($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CampingServiceComplementaire');

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
            $this->addJoinObject($join, 'CampingServiceComplementaire');
        }

        return $this;
    }

    /**
     * Use the CampingServiceComplementaire relation CampingServiceComplementaire object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\CampingServiceComplementaireQuery A secondary query class using the current class as primary query
     */
    public function useCampingServiceComplementaireQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCampingServiceComplementaire($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CampingServiceComplementaire', '\Cungfoo\Model\CampingServiceComplementaireQuery');
    }

    /**
     * Filter the query by a related TypeHebergement object
     * using the camping_type_hebergement table as cross reference
     *
     * @param   TypeHebergement $typeHebergement the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   CampingQuery The current query, for fluid interface
     */
    public function filterByTypeHebergement($typeHebergement, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useCampingTypeHebergementQuery()
            ->filterByTypeHebergement($typeHebergement, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Destination object
     * using the camping_destination table as cross reference
     *
     * @param   Destination $destination the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   CampingQuery The current query, for fluid interface
     */
    public function filterByDestination($destination, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useCampingDestinationQuery()
            ->filterByDestination($destination, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Activite object
     * using the camping_activite table as cross reference
     *
     * @param   Activite $activite the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   CampingQuery The current query, for fluid interface
     */
    public function filterByActivite($activite, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useCampingActiviteQuery()
            ->filterByActivite($activite, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Equipement object
     * using the camping_equipement table as cross reference
     *
     * @param   Equipement $equipement the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   CampingQuery The current query, for fluid interface
     */
    public function filterByEquipement($equipement, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useCampingEquipementQuery()
            ->filterByEquipement($equipement, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related ServiceComplementaire object
     * using the camping_service_complementaire table as cross reference
     *
     * @param   ServiceComplementaire $serviceComplementaire the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   CampingQuery The current query, for fluid interface
     */
    public function filterByServiceComplementaire($serviceComplementaire, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useCampingServiceComplementaireQuery()
            ->filterByServiceComplementaire($serviceComplementaire, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   Camping $camping Object to remove from the list of results
     *
     * @return CampingQuery The current query, for fluid interface
     */
    public function prune($camping = null)
    {
        if ($camping) {
            $this->addUsingAlias(CampingPeer::ID, $camping->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
