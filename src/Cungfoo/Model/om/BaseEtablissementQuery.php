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
use Cungfoo\Model\Destination;
use Cungfoo\Model\Equipement;
use Cungfoo\Model\Etablissement;
use Cungfoo\Model\EtablissementActivite;
use Cungfoo\Model\EtablissementDestination;
use Cungfoo\Model\EtablissementEquipement;
use Cungfoo\Model\EtablissementPeer;
use Cungfoo\Model\EtablissementQuery;
use Cungfoo\Model\EtablissementServiceComplementaire;
use Cungfoo\Model\EtablissementTypeHebergement;
use Cungfoo\Model\ServiceComplementaire;
use Cungfoo\Model\TypeHebergement;
use Cungfoo\Model\Ville;

/**
 * Base class that represents a query for the 'etablissement' table.
 *
 *
 *
 * @method EtablissementQuery orderById($order = Criteria::ASC) Order by the id column
 * @method EtablissementQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method EtablissementQuery orderByAddress1($order = Criteria::ASC) Order by the address1 column
 * @method EtablissementQuery orderByAddress2($order = Criteria::ASC) Order by the address2 column
 * @method EtablissementQuery orderByZip($order = Criteria::ASC) Order by the zip column
 * @method EtablissementQuery orderByCity($order = Criteria::ASC) Order by the city column
 * @method EtablissementQuery orderByMail($order = Criteria::ASC) Order by the mail column
 * @method EtablissementQuery orderByCountry($order = Criteria::ASC) Order by the country column
 * @method EtablissementQuery orderByCountryCode($order = Criteria::ASC) Order by the country_code column
 * @method EtablissementQuery orderByPhone1($order = Criteria::ASC) Order by the phone1 column
 * @method EtablissementQuery orderByPhone2($order = Criteria::ASC) Order by the phone2 column
 * @method EtablissementQuery orderByFax($order = Criteria::ASC) Order by the fax column
 * @method EtablissementQuery orderByVilleId($order = Criteria::ASC) Order by the ville_id column
 *
 * @method EtablissementQuery groupById() Group by the id column
 * @method EtablissementQuery groupByName() Group by the name column
 * @method EtablissementQuery groupByAddress1() Group by the address1 column
 * @method EtablissementQuery groupByAddress2() Group by the address2 column
 * @method EtablissementQuery groupByZip() Group by the zip column
 * @method EtablissementQuery groupByCity() Group by the city column
 * @method EtablissementQuery groupByMail() Group by the mail column
 * @method EtablissementQuery groupByCountry() Group by the country column
 * @method EtablissementQuery groupByCountryCode() Group by the country_code column
 * @method EtablissementQuery groupByPhone1() Group by the phone1 column
 * @method EtablissementQuery groupByPhone2() Group by the phone2 column
 * @method EtablissementQuery groupByFax() Group by the fax column
 * @method EtablissementQuery groupByVilleId() Group by the ville_id column
 *
 * @method EtablissementQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method EtablissementQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method EtablissementQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method EtablissementQuery leftJoinVille($relationAlias = null) Adds a LEFT JOIN clause to the query using the Ville relation
 * @method EtablissementQuery rightJoinVille($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Ville relation
 * @method EtablissementQuery innerJoinVille($relationAlias = null) Adds a INNER JOIN clause to the query using the Ville relation
 *
 * @method EtablissementQuery leftJoinEtablissementTypeHebergement($relationAlias = null) Adds a LEFT JOIN clause to the query using the EtablissementTypeHebergement relation
 * @method EtablissementQuery rightJoinEtablissementTypeHebergement($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EtablissementTypeHebergement relation
 * @method EtablissementQuery innerJoinEtablissementTypeHebergement($relationAlias = null) Adds a INNER JOIN clause to the query using the EtablissementTypeHebergement relation
 *
 * @method EtablissementQuery leftJoinEtablissementDestination($relationAlias = null) Adds a LEFT JOIN clause to the query using the EtablissementDestination relation
 * @method EtablissementQuery rightJoinEtablissementDestination($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EtablissementDestination relation
 * @method EtablissementQuery innerJoinEtablissementDestination($relationAlias = null) Adds a INNER JOIN clause to the query using the EtablissementDestination relation
 *
 * @method EtablissementQuery leftJoinEtablissementActivite($relationAlias = null) Adds a LEFT JOIN clause to the query using the EtablissementActivite relation
 * @method EtablissementQuery rightJoinEtablissementActivite($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EtablissementActivite relation
 * @method EtablissementQuery innerJoinEtablissementActivite($relationAlias = null) Adds a INNER JOIN clause to the query using the EtablissementActivite relation
 *
 * @method EtablissementQuery leftJoinEtablissementEquipement($relationAlias = null) Adds a LEFT JOIN clause to the query using the EtablissementEquipement relation
 * @method EtablissementQuery rightJoinEtablissementEquipement($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EtablissementEquipement relation
 * @method EtablissementQuery innerJoinEtablissementEquipement($relationAlias = null) Adds a INNER JOIN clause to the query using the EtablissementEquipement relation
 *
 * @method EtablissementQuery leftJoinEtablissementServiceComplementaire($relationAlias = null) Adds a LEFT JOIN clause to the query using the EtablissementServiceComplementaire relation
 * @method EtablissementQuery rightJoinEtablissementServiceComplementaire($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EtablissementServiceComplementaire relation
 * @method EtablissementQuery innerJoinEtablissementServiceComplementaire($relationAlias = null) Adds a INNER JOIN clause to the query using the EtablissementServiceComplementaire relation
 *
 * @method Etablissement findOne(PropelPDO $con = null) Return the first Etablissement matching the query
 * @method Etablissement findOneOrCreate(PropelPDO $con = null) Return the first Etablissement matching the query, or a new Etablissement object populated from the query conditions when no match is found
 *
 * @method Etablissement findOneByName(string $name) Return the first Etablissement filtered by the name column
 * @method Etablissement findOneByAddress1(string $address1) Return the first Etablissement filtered by the address1 column
 * @method Etablissement findOneByAddress2(string $address2) Return the first Etablissement filtered by the address2 column
 * @method Etablissement findOneByZip(string $zip) Return the first Etablissement filtered by the zip column
 * @method Etablissement findOneByCity(string $city) Return the first Etablissement filtered by the city column
 * @method Etablissement findOneByMail(string $mail) Return the first Etablissement filtered by the mail column
 * @method Etablissement findOneByCountry(string $country) Return the first Etablissement filtered by the country column
 * @method Etablissement findOneByCountryCode(string $country_code) Return the first Etablissement filtered by the country_code column
 * @method Etablissement findOneByPhone1(string $phone1) Return the first Etablissement filtered by the phone1 column
 * @method Etablissement findOneByPhone2(string $phone2) Return the first Etablissement filtered by the phone2 column
 * @method Etablissement findOneByFax(string $fax) Return the first Etablissement filtered by the fax column
 * @method Etablissement findOneByVilleId(string $ville_id) Return the first Etablissement filtered by the ville_id column
 *
 * @method array findById(int $id) Return Etablissement objects filtered by the id column
 * @method array findByName(string $name) Return Etablissement objects filtered by the name column
 * @method array findByAddress1(string $address1) Return Etablissement objects filtered by the address1 column
 * @method array findByAddress2(string $address2) Return Etablissement objects filtered by the address2 column
 * @method array findByZip(string $zip) Return Etablissement objects filtered by the zip column
 * @method array findByCity(string $city) Return Etablissement objects filtered by the city column
 * @method array findByMail(string $mail) Return Etablissement objects filtered by the mail column
 * @method array findByCountry(string $country) Return Etablissement objects filtered by the country column
 * @method array findByCountryCode(string $country_code) Return Etablissement objects filtered by the country_code column
 * @method array findByPhone1(string $phone1) Return Etablissement objects filtered by the phone1 column
 * @method array findByPhone2(string $phone2) Return Etablissement objects filtered by the phone2 column
 * @method array findByFax(string $fax) Return Etablissement objects filtered by the fax column
 * @method array findByVilleId(string $ville_id) Return Etablissement objects filtered by the ville_id column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseEtablissementQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseEtablissementQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\Etablissement', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new EtablissementQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     EtablissementQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return EtablissementQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof EtablissementQuery) {
            return $criteria;
        }
        $query = new EtablissementQuery();
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
     * @return   Etablissement|Etablissement[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = EtablissementPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(EtablissementPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Etablissement A model object, or null if the key is not found
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
     * @return   Etablissement A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `NAME`, `ADDRESS1`, `ADDRESS2`, `ZIP`, `CITY`, `MAIL`, `COUNTRY`, `COUNTRY_CODE`, `PHONE1`, `PHONE2`, `FAX`, `VILLE_ID` FROM `etablissement` WHERE `ID` = :p0';
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
            $obj = new Etablissement();
            $obj->hydrate($row);
            EtablissementPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Etablissement|Etablissement[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Etablissement[]|mixed the list of results, formatted by the current formatter
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
     * @return EtablissementQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(EtablissementPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return EtablissementQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(EtablissementPeer::ID, $keys, Criteria::IN);
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
     * @return EtablissementQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(EtablissementPeer::ID, $id, $comparison);
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
     * @return EtablissementQuery The current query, for fluid interface
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

        return $this->addUsingAlias(EtablissementPeer::NAME, $name, $comparison);
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
     * @return EtablissementQuery The current query, for fluid interface
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

        return $this->addUsingAlias(EtablissementPeer::ADDRESS1, $address1, $comparison);
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
     * @return EtablissementQuery The current query, for fluid interface
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

        return $this->addUsingAlias(EtablissementPeer::ADDRESS2, $address2, $comparison);
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
     * @return EtablissementQuery The current query, for fluid interface
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

        return $this->addUsingAlias(EtablissementPeer::ZIP, $zip, $comparison);
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
     * @return EtablissementQuery The current query, for fluid interface
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

        return $this->addUsingAlias(EtablissementPeer::CITY, $city, $comparison);
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
     * @return EtablissementQuery The current query, for fluid interface
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

        return $this->addUsingAlias(EtablissementPeer::MAIL, $mail, $comparison);
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
     * @return EtablissementQuery The current query, for fluid interface
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

        return $this->addUsingAlias(EtablissementPeer::COUNTRY, $country, $comparison);
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
     * @return EtablissementQuery The current query, for fluid interface
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

        return $this->addUsingAlias(EtablissementPeer::COUNTRY_CODE, $countryCode, $comparison);
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
     * @return EtablissementQuery The current query, for fluid interface
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

        return $this->addUsingAlias(EtablissementPeer::PHONE1, $phone1, $comparison);
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
     * @return EtablissementQuery The current query, for fluid interface
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

        return $this->addUsingAlias(EtablissementPeer::PHONE2, $phone2, $comparison);
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
     * @return EtablissementQuery The current query, for fluid interface
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

        return $this->addUsingAlias(EtablissementPeer::FAX, $fax, $comparison);
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
     * @return EtablissementQuery The current query, for fluid interface
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

        return $this->addUsingAlias(EtablissementPeer::VILLE_ID, $villeId, $comparison);
    }

    /**
     * Filter the query by a related Ville object
     *
     * @param   Ville|PropelObjectCollection $ville The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   EtablissementQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByVille($ville, $comparison = null)
    {
        if ($ville instanceof Ville) {
            return $this
                ->addUsingAlias(EtablissementPeer::VILLE_ID, $ville->getId(), $comparison);
        } elseif ($ville instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EtablissementPeer::VILLE_ID, $ville->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return EtablissementQuery The current query, for fluid interface
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
     * Filter the query by a related EtablissementTypeHebergement object
     *
     * @param   EtablissementTypeHebergement|PropelObjectCollection $etablissementTypeHebergement  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   EtablissementQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByEtablissementTypeHebergement($etablissementTypeHebergement, $comparison = null)
    {
        if ($etablissementTypeHebergement instanceof EtablissementTypeHebergement) {
            return $this
                ->addUsingAlias(EtablissementPeer::ID, $etablissementTypeHebergement->getEtablissementId(), $comparison);
        } elseif ($etablissementTypeHebergement instanceof PropelObjectCollection) {
            return $this
                ->useEtablissementTypeHebergementQuery()
                ->filterByPrimaryKeys($etablissementTypeHebergement->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEtablissementTypeHebergement() only accepts arguments of type EtablissementTypeHebergement or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EtablissementTypeHebergement relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return EtablissementQuery The current query, for fluid interface
     */
    public function joinEtablissementTypeHebergement($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EtablissementTypeHebergement');

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
            $this->addJoinObject($join, 'EtablissementTypeHebergement');
        }

        return $this;
    }

    /**
     * Use the EtablissementTypeHebergement relation EtablissementTypeHebergement object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\EtablissementTypeHebergementQuery A secondary query class using the current class as primary query
     */
    public function useEtablissementTypeHebergementQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEtablissementTypeHebergement($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EtablissementTypeHebergement', '\Cungfoo\Model\EtablissementTypeHebergementQuery');
    }

    /**
     * Filter the query by a related EtablissementDestination object
     *
     * @param   EtablissementDestination|PropelObjectCollection $etablissementDestination  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   EtablissementQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByEtablissementDestination($etablissementDestination, $comparison = null)
    {
        if ($etablissementDestination instanceof EtablissementDestination) {
            return $this
                ->addUsingAlias(EtablissementPeer::ID, $etablissementDestination->getEtablissementId(), $comparison);
        } elseif ($etablissementDestination instanceof PropelObjectCollection) {
            return $this
                ->useEtablissementDestinationQuery()
                ->filterByPrimaryKeys($etablissementDestination->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEtablissementDestination() only accepts arguments of type EtablissementDestination or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EtablissementDestination relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return EtablissementQuery The current query, for fluid interface
     */
    public function joinEtablissementDestination($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EtablissementDestination');

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
            $this->addJoinObject($join, 'EtablissementDestination');
        }

        return $this;
    }

    /**
     * Use the EtablissementDestination relation EtablissementDestination object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\EtablissementDestinationQuery A secondary query class using the current class as primary query
     */
    public function useEtablissementDestinationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEtablissementDestination($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EtablissementDestination', '\Cungfoo\Model\EtablissementDestinationQuery');
    }

    /**
     * Filter the query by a related EtablissementActivite object
     *
     * @param   EtablissementActivite|PropelObjectCollection $etablissementActivite  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   EtablissementQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByEtablissementActivite($etablissementActivite, $comparison = null)
    {
        if ($etablissementActivite instanceof EtablissementActivite) {
            return $this
                ->addUsingAlias(EtablissementPeer::ID, $etablissementActivite->getEtablissementId(), $comparison);
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
     * @return EtablissementQuery The current query, for fluid interface
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
     * Filter the query by a related EtablissementEquipement object
     *
     * @param   EtablissementEquipement|PropelObjectCollection $etablissementEquipement  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   EtablissementQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByEtablissementEquipement($etablissementEquipement, $comparison = null)
    {
        if ($etablissementEquipement instanceof EtablissementEquipement) {
            return $this
                ->addUsingAlias(EtablissementPeer::ID, $etablissementEquipement->getEtablissementId(), $comparison);
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
     * @return EtablissementQuery The current query, for fluid interface
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
     * Filter the query by a related EtablissementServiceComplementaire object
     *
     * @param   EtablissementServiceComplementaire|PropelObjectCollection $etablissementServiceComplementaire  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   EtablissementQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByEtablissementServiceComplementaire($etablissementServiceComplementaire, $comparison = null)
    {
        if ($etablissementServiceComplementaire instanceof EtablissementServiceComplementaire) {
            return $this
                ->addUsingAlias(EtablissementPeer::ID, $etablissementServiceComplementaire->getEtablissementId(), $comparison);
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
     * @return EtablissementQuery The current query, for fluid interface
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
     * Filter the query by a related TypeHebergement object
     * using the etablissement_type_hebergement table as cross reference
     *
     * @param   TypeHebergement $typeHebergement the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   EtablissementQuery The current query, for fluid interface
     */
    public function filterByTypeHebergement($typeHebergement, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useEtablissementTypeHebergementQuery()
            ->filterByTypeHebergement($typeHebergement, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Destination object
     * using the etablissement_destination table as cross reference
     *
     * @param   Destination $destination the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   EtablissementQuery The current query, for fluid interface
     */
    public function filterByDestination($destination, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useEtablissementDestinationQuery()
            ->filterByDestination($destination, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Activite object
     * using the etablissement_activite table as cross reference
     *
     * @param   Activite $activite the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   EtablissementQuery The current query, for fluid interface
     */
    public function filterByActivite($activite, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useEtablissementActiviteQuery()
            ->filterByActivite($activite, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Equipement object
     * using the etablissement_equipement table as cross reference
     *
     * @param   Equipement $equipement the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   EtablissementQuery The current query, for fluid interface
     */
    public function filterByEquipement($equipement, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useEtablissementEquipementQuery()
            ->filterByEquipement($equipement, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related ServiceComplementaire object
     * using the etablissement_service_complementaire table as cross reference
     *
     * @param   ServiceComplementaire $serviceComplementaire the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   EtablissementQuery The current query, for fluid interface
     */
    public function filterByServiceComplementaire($serviceComplementaire, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useEtablissementServiceComplementaireQuery()
            ->filterByServiceComplementaire($serviceComplementaire, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   Etablissement $etablissement Object to remove from the list of results
     *
     * @return EtablissementQuery The current query, for fluid interface
     */
    public function prune($etablissement = null)
    {
        if ($etablissement) {
            $this->addUsingAlias(EtablissementPeer::ID, $etablissement->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}