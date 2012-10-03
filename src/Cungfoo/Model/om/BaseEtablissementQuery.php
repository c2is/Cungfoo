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
use Cungfoo\Model\Baignade;
use Cungfoo\Model\Categorie;
use Cungfoo\Model\Destination;
use Cungfoo\Model\Etablissement;
use Cungfoo\Model\EtablissementActivite;
use Cungfoo\Model\EtablissementBaignade;
use Cungfoo\Model\EtablissementDestination;
use Cungfoo\Model\EtablissementEvent;
use Cungfoo\Model\EtablissementI18n;
use Cungfoo\Model\EtablissementPeer;
use Cungfoo\Model\EtablissementPointInteret;
use Cungfoo\Model\EtablissementQuery;
use Cungfoo\Model\EtablissementServiceComplementaire;
use Cungfoo\Model\EtablissementSituationGeographique;
use Cungfoo\Model\EtablissementThematique;
use Cungfoo\Model\EtablissementTypeHebergement;
use Cungfoo\Model\Event;
use Cungfoo\Model\MultimediaEtablissement;
use Cungfoo\Model\Personnage;
use Cungfoo\Model\PointInteret;
use Cungfoo\Model\ServiceComplementaire;
use Cungfoo\Model\SituationGeographique;
use Cungfoo\Model\Thematique;
use Cungfoo\Model\TypeHebergement;
use Cungfoo\Model\Ville;

/**
 * Base class that represents a query for the 'etablissement' table.
 *
 *
 *
 * @method EtablissementQuery orderById($order = Criteria::ASC) Order by the id column
 * @method EtablissementQuery orderByCode($order = Criteria::ASC) Order by the code column
 * @method EtablissementQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method EtablissementQuery orderByAddress1($order = Criteria::ASC) Order by the address1 column
 * @method EtablissementQuery orderByAddress2($order = Criteria::ASC) Order by the address2 column
 * @method EtablissementQuery orderByZip($order = Criteria::ASC) Order by the zip column
 * @method EtablissementQuery orderByCity($order = Criteria::ASC) Order by the city column
 * @method EtablissementQuery orderByMail($order = Criteria::ASC) Order by the mail column
 * @method EtablissementQuery orderByCountryCode($order = Criteria::ASC) Order by the country_code column
 * @method EtablissementQuery orderByPhone1($order = Criteria::ASC) Order by the phone1 column
 * @method EtablissementQuery orderByPhone2($order = Criteria::ASC) Order by the phone2 column
 * @method EtablissementQuery orderByFax($order = Criteria::ASC) Order by the fax column
 * @method EtablissementQuery orderByOpeningDate($order = Criteria::ASC) Order by the opening_date column
 * @method EtablissementQuery orderByClosingDate($order = Criteria::ASC) Order by the closing_date column
 * @method EtablissementQuery orderByVilleId($order = Criteria::ASC) Order by the ville_id column
 * @method EtablissementQuery orderByCategorieId($order = Criteria::ASC) Order by the categorie_id column
 * @method EtablissementQuery orderByGeoCoordinateX($order = Criteria::ASC) Order by the geo_coordinate_x column
 * @method EtablissementQuery orderByGeoCoordinateY($order = Criteria::ASC) Order by the geo_coordinate_y column
 * @method EtablissementQuery orderByMinimumPrice($order = Criteria::ASC) Order by the minimum_price column
 * @method EtablissementQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method EtablissementQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method EtablissementQuery groupById() Group by the id column
 * @method EtablissementQuery groupByCode() Group by the code column
 * @method EtablissementQuery groupByName() Group by the name column
 * @method EtablissementQuery groupByAddress1() Group by the address1 column
 * @method EtablissementQuery groupByAddress2() Group by the address2 column
 * @method EtablissementQuery groupByZip() Group by the zip column
 * @method EtablissementQuery groupByCity() Group by the city column
 * @method EtablissementQuery groupByMail() Group by the mail column
 * @method EtablissementQuery groupByCountryCode() Group by the country_code column
 * @method EtablissementQuery groupByPhone1() Group by the phone1 column
 * @method EtablissementQuery groupByPhone2() Group by the phone2 column
 * @method EtablissementQuery groupByFax() Group by the fax column
 * @method EtablissementQuery groupByOpeningDate() Group by the opening_date column
 * @method EtablissementQuery groupByClosingDate() Group by the closing_date column
 * @method EtablissementQuery groupByVilleId() Group by the ville_id column
 * @method EtablissementQuery groupByCategorieId() Group by the categorie_id column
 * @method EtablissementQuery groupByGeoCoordinateX() Group by the geo_coordinate_x column
 * @method EtablissementQuery groupByGeoCoordinateY() Group by the geo_coordinate_y column
 * @method EtablissementQuery groupByMinimumPrice() Group by the minimum_price column
 * @method EtablissementQuery groupByCreatedAt() Group by the created_at column
 * @method EtablissementQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method EtablissementQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method EtablissementQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method EtablissementQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method EtablissementQuery leftJoinVille($relationAlias = null) Adds a LEFT JOIN clause to the query using the Ville relation
 * @method EtablissementQuery rightJoinVille($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Ville relation
 * @method EtablissementQuery innerJoinVille($relationAlias = null) Adds a INNER JOIN clause to the query using the Ville relation
 *
 * @method EtablissementQuery leftJoinCategorie($relationAlias = null) Adds a LEFT JOIN clause to the query using the Categorie relation
 * @method EtablissementQuery rightJoinCategorie($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Categorie relation
 * @method EtablissementQuery innerJoinCategorie($relationAlias = null) Adds a INNER JOIN clause to the query using the Categorie relation
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
 * @method EtablissementQuery leftJoinEtablissementServiceComplementaire($relationAlias = null) Adds a LEFT JOIN clause to the query using the EtablissementServiceComplementaire relation
 * @method EtablissementQuery rightJoinEtablissementServiceComplementaire($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EtablissementServiceComplementaire relation
 * @method EtablissementQuery innerJoinEtablissementServiceComplementaire($relationAlias = null) Adds a INNER JOIN clause to the query using the EtablissementServiceComplementaire relation
 *
 * @method EtablissementQuery leftJoinEtablissementSituationGeographique($relationAlias = null) Adds a LEFT JOIN clause to the query using the EtablissementSituationGeographique relation
 * @method EtablissementQuery rightJoinEtablissementSituationGeographique($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EtablissementSituationGeographique relation
 * @method EtablissementQuery innerJoinEtablissementSituationGeographique($relationAlias = null) Adds a INNER JOIN clause to the query using the EtablissementSituationGeographique relation
 *
 * @method EtablissementQuery leftJoinEtablissementBaignade($relationAlias = null) Adds a LEFT JOIN clause to the query using the EtablissementBaignade relation
 * @method EtablissementQuery rightJoinEtablissementBaignade($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EtablissementBaignade relation
 * @method EtablissementQuery innerJoinEtablissementBaignade($relationAlias = null) Adds a INNER JOIN clause to the query using the EtablissementBaignade relation
 *
 * @method EtablissementQuery leftJoinEtablissementThematique($relationAlias = null) Adds a LEFT JOIN clause to the query using the EtablissementThematique relation
 * @method EtablissementQuery rightJoinEtablissementThematique($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EtablissementThematique relation
 * @method EtablissementQuery innerJoinEtablissementThematique($relationAlias = null) Adds a INNER JOIN clause to the query using the EtablissementThematique relation
 *
 * @method EtablissementQuery leftJoinEtablissementPointInteret($relationAlias = null) Adds a LEFT JOIN clause to the query using the EtablissementPointInteret relation
 * @method EtablissementQuery rightJoinEtablissementPointInteret($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EtablissementPointInteret relation
 * @method EtablissementQuery innerJoinEtablissementPointInteret($relationAlias = null) Adds a INNER JOIN clause to the query using the EtablissementPointInteret relation
 *
 * @method EtablissementQuery leftJoinEtablissementEvent($relationAlias = null) Adds a LEFT JOIN clause to the query using the EtablissementEvent relation
 * @method EtablissementQuery rightJoinEtablissementEvent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EtablissementEvent relation
 * @method EtablissementQuery innerJoinEtablissementEvent($relationAlias = null) Adds a INNER JOIN clause to the query using the EtablissementEvent relation
 *
 * @method EtablissementQuery leftJoinPersonnage($relationAlias = null) Adds a LEFT JOIN clause to the query using the Personnage relation
 * @method EtablissementQuery rightJoinPersonnage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Personnage relation
 * @method EtablissementQuery innerJoinPersonnage($relationAlias = null) Adds a INNER JOIN clause to the query using the Personnage relation
 *
 * @method EtablissementQuery leftJoinMultimediaEtablissement($relationAlias = null) Adds a LEFT JOIN clause to the query using the MultimediaEtablissement relation
 * @method EtablissementQuery rightJoinMultimediaEtablissement($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MultimediaEtablissement relation
 * @method EtablissementQuery innerJoinMultimediaEtablissement($relationAlias = null) Adds a INNER JOIN clause to the query using the MultimediaEtablissement relation
 *
 * @method EtablissementQuery leftJoinEtablissementI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the EtablissementI18n relation
 * @method EtablissementQuery rightJoinEtablissementI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EtablissementI18n relation
 * @method EtablissementQuery innerJoinEtablissementI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the EtablissementI18n relation
 *
 * @method Etablissement findOne(PropelPDO $con = null) Return the first Etablissement matching the query
 * @method Etablissement findOneOrCreate(PropelPDO $con = null) Return the first Etablissement matching the query, or a new Etablissement object populated from the query conditions when no match is found
 *
 * @method Etablissement findOneByCode(int $code) Return the first Etablissement filtered by the code column
 * @method Etablissement findOneByName(string $name) Return the first Etablissement filtered by the name column
 * @method Etablissement findOneByAddress1(string $address1) Return the first Etablissement filtered by the address1 column
 * @method Etablissement findOneByAddress2(string $address2) Return the first Etablissement filtered by the address2 column
 * @method Etablissement findOneByZip(string $zip) Return the first Etablissement filtered by the zip column
 * @method Etablissement findOneByCity(string $city) Return the first Etablissement filtered by the city column
 * @method Etablissement findOneByMail(string $mail) Return the first Etablissement filtered by the mail column
 * @method Etablissement findOneByCountryCode(string $country_code) Return the first Etablissement filtered by the country_code column
 * @method Etablissement findOneByPhone1(string $phone1) Return the first Etablissement filtered by the phone1 column
 * @method Etablissement findOneByPhone2(string $phone2) Return the first Etablissement filtered by the phone2 column
 * @method Etablissement findOneByFax(string $fax) Return the first Etablissement filtered by the fax column
 * @method Etablissement findOneByOpeningDate(string $opening_date) Return the first Etablissement filtered by the opening_date column
 * @method Etablissement findOneByClosingDate(string $closing_date) Return the first Etablissement filtered by the closing_date column
 * @method Etablissement findOneByVilleId(int $ville_id) Return the first Etablissement filtered by the ville_id column
 * @method Etablissement findOneByCategorieId(int $categorie_id) Return the first Etablissement filtered by the categorie_id column
 * @method Etablissement findOneByGeoCoordinateX(string $geo_coordinate_x) Return the first Etablissement filtered by the geo_coordinate_x column
 * @method Etablissement findOneByGeoCoordinateY(string $geo_coordinate_y) Return the first Etablissement filtered by the geo_coordinate_y column
 * @method Etablissement findOneByMinimumPrice(string $minimum_price) Return the first Etablissement filtered by the minimum_price column
 * @method Etablissement findOneByCreatedAt(string $created_at) Return the first Etablissement filtered by the created_at column
 * @method Etablissement findOneByUpdatedAt(string $updated_at) Return the first Etablissement filtered by the updated_at column
 *
 * @method array findById(int $id) Return Etablissement objects filtered by the id column
 * @method array findByCode(int $code) Return Etablissement objects filtered by the code column
 * @method array findByName(string $name) Return Etablissement objects filtered by the name column
 * @method array findByAddress1(string $address1) Return Etablissement objects filtered by the address1 column
 * @method array findByAddress2(string $address2) Return Etablissement objects filtered by the address2 column
 * @method array findByZip(string $zip) Return Etablissement objects filtered by the zip column
 * @method array findByCity(string $city) Return Etablissement objects filtered by the city column
 * @method array findByMail(string $mail) Return Etablissement objects filtered by the mail column
 * @method array findByCountryCode(string $country_code) Return Etablissement objects filtered by the country_code column
 * @method array findByPhone1(string $phone1) Return Etablissement objects filtered by the phone1 column
 * @method array findByPhone2(string $phone2) Return Etablissement objects filtered by the phone2 column
 * @method array findByFax(string $fax) Return Etablissement objects filtered by the fax column
 * @method array findByOpeningDate(string $opening_date) Return Etablissement objects filtered by the opening_date column
 * @method array findByClosingDate(string $closing_date) Return Etablissement objects filtered by the closing_date column
 * @method array findByVilleId(int $ville_id) Return Etablissement objects filtered by the ville_id column
 * @method array findByCategorieId(int $categorie_id) Return Etablissement objects filtered by the categorie_id column
 * @method array findByGeoCoordinateX(string $geo_coordinate_x) Return Etablissement objects filtered by the geo_coordinate_x column
 * @method array findByGeoCoordinateY(string $geo_coordinate_y) Return Etablissement objects filtered by the geo_coordinate_y column
 * @method array findByMinimumPrice(string $minimum_price) Return Etablissement objects filtered by the minimum_price column
 * @method array findByCreatedAt(string $created_at) Return Etablissement objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return Etablissement objects filtered by the updated_at column
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
        $sql = 'SELECT `ID`, `CODE`, `NAME`, `ADDRESS1`, `ADDRESS2`, `ZIP`, `CITY`, `MAIL`, `COUNTRY_CODE`, `PHONE1`, `PHONE2`, `FAX`, `OPENING_DATE`, `CLOSING_DATE`, `VILLE_ID`, `CATEGORIE_ID`, `GEO_COORDINATE_X`, `GEO_COORDINATE_Y`, `MINIMUM_PRICE`, `CREATED_AT`, `UPDATED_AT` FROM `etablissement` WHERE `ID` = :p0';
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
     * Filter the query on the code column
     *
     * Example usage:
     * <code>
     * $query->filterByCode(1234); // WHERE code = 1234
     * $query->filterByCode(array(12, 34)); // WHERE code IN (12, 34)
     * $query->filterByCode(array('min' => 12)); // WHERE code > 12
     * </code>
     *
     * @param     mixed $code The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EtablissementQuery The current query, for fluid interface
     */
    public function filterByCode($code = null, $comparison = null)
    {
        if (is_array($code)) {
            $useMinMax = false;
            if (isset($code['min'])) {
                $this->addUsingAlias(EtablissementPeer::CODE, $code['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($code['max'])) {
                $this->addUsingAlias(EtablissementPeer::CODE, $code['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EtablissementPeer::CODE, $code, $comparison);
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
     * Filter the query on the opening_date column
     *
     * Example usage:
     * <code>
     * $query->filterByOpeningDate('2011-03-14'); // WHERE opening_date = '2011-03-14'
     * $query->filterByOpeningDate('now'); // WHERE opening_date = '2011-03-14'
     * $query->filterByOpeningDate(array('max' => 'yesterday')); // WHERE opening_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $openingDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EtablissementQuery The current query, for fluid interface
     */
    public function filterByOpeningDate($openingDate = null, $comparison = null)
    {
        if (is_array($openingDate)) {
            $useMinMax = false;
            if (isset($openingDate['min'])) {
                $this->addUsingAlias(EtablissementPeer::OPENING_DATE, $openingDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($openingDate['max'])) {
                $this->addUsingAlias(EtablissementPeer::OPENING_DATE, $openingDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EtablissementPeer::OPENING_DATE, $openingDate, $comparison);
    }

    /**
     * Filter the query on the closing_date column
     *
     * Example usage:
     * <code>
     * $query->filterByClosingDate('2011-03-14'); // WHERE closing_date = '2011-03-14'
     * $query->filterByClosingDate('now'); // WHERE closing_date = '2011-03-14'
     * $query->filterByClosingDate(array('max' => 'yesterday')); // WHERE closing_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $closingDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EtablissementQuery The current query, for fluid interface
     */
    public function filterByClosingDate($closingDate = null, $comparison = null)
    {
        if (is_array($closingDate)) {
            $useMinMax = false;
            if (isset($closingDate['min'])) {
                $this->addUsingAlias(EtablissementPeer::CLOSING_DATE, $closingDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($closingDate['max'])) {
                $this->addUsingAlias(EtablissementPeer::CLOSING_DATE, $closingDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EtablissementPeer::CLOSING_DATE, $closingDate, $comparison);
    }

    /**
     * Filter the query on the ville_id column
     *
     * Example usage:
     * <code>
     * $query->filterByVilleId(1234); // WHERE ville_id = 1234
     * $query->filterByVilleId(array(12, 34)); // WHERE ville_id IN (12, 34)
     * $query->filterByVilleId(array('min' => 12)); // WHERE ville_id > 12
     * </code>
     *
     * @see       filterByVille()
     *
     * @param     mixed $villeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EtablissementQuery The current query, for fluid interface
     */
    public function filterByVilleId($villeId = null, $comparison = null)
    {
        if (is_array($villeId)) {
            $useMinMax = false;
            if (isset($villeId['min'])) {
                $this->addUsingAlias(EtablissementPeer::VILLE_ID, $villeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($villeId['max'])) {
                $this->addUsingAlias(EtablissementPeer::VILLE_ID, $villeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EtablissementPeer::VILLE_ID, $villeId, $comparison);
    }

    /**
     * Filter the query on the categorie_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCategorieId(1234); // WHERE categorie_id = 1234
     * $query->filterByCategorieId(array(12, 34)); // WHERE categorie_id IN (12, 34)
     * $query->filterByCategorieId(array('min' => 12)); // WHERE categorie_id > 12
     * </code>
     *
     * @see       filterByCategorie()
     *
     * @param     mixed $categorieId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EtablissementQuery The current query, for fluid interface
     */
    public function filterByCategorieId($categorieId = null, $comparison = null)
    {
        if (is_array($categorieId)) {
            $useMinMax = false;
            if (isset($categorieId['min'])) {
                $this->addUsingAlias(EtablissementPeer::CATEGORIE_ID, $categorieId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($categorieId['max'])) {
                $this->addUsingAlias(EtablissementPeer::CATEGORIE_ID, $categorieId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EtablissementPeer::CATEGORIE_ID, $categorieId, $comparison);
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
     * @return EtablissementQuery The current query, for fluid interface
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

        return $this->addUsingAlias(EtablissementPeer::GEO_COORDINATE_X, $geoCoordinateX, $comparison);
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
     * @return EtablissementQuery The current query, for fluid interface
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

        return $this->addUsingAlias(EtablissementPeer::GEO_COORDINATE_Y, $geoCoordinateY, $comparison);
    }

    /**
     * Filter the query on the minimum_price column
     *
     * Example usage:
     * <code>
     * $query->filterByMinimumPrice('fooValue');   // WHERE minimum_price = 'fooValue'
     * $query->filterByMinimumPrice('%fooValue%'); // WHERE minimum_price LIKE '%fooValue%'
     * </code>
     *
     * @param     string $minimumPrice The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EtablissementQuery The current query, for fluid interface
     */
    public function filterByMinimumPrice($minimumPrice = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($minimumPrice)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $minimumPrice)) {
                $minimumPrice = str_replace('*', '%', $minimumPrice);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(EtablissementPeer::MINIMUM_PRICE, $minimumPrice, $comparison);
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
     * @return EtablissementQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(EtablissementPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(EtablissementPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EtablissementPeer::CREATED_AT, $createdAt, $comparison);
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
     * @return EtablissementQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(EtablissementPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(EtablissementPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EtablissementPeer::UPDATED_AT, $updatedAt, $comparison);
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
     * Filter the query by a related Categorie object
     *
     * @param   Categorie|PropelObjectCollection $categorie The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   EtablissementQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByCategorie($categorie, $comparison = null)
    {
        if ($categorie instanceof Categorie) {
            return $this
                ->addUsingAlias(EtablissementPeer::CATEGORIE_ID, $categorie->getId(), $comparison);
        } elseif ($categorie instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EtablissementPeer::CATEGORIE_ID, $categorie->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCategorie() only accepts arguments of type Categorie or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Categorie relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return EtablissementQuery The current query, for fluid interface
     */
    public function joinCategorie($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Categorie');

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
            $this->addJoinObject($join, 'Categorie');
        }

        return $this;
    }

    /**
     * Use the Categorie relation Categorie object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\CategorieQuery A secondary query class using the current class as primary query
     */
    public function useCategorieQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCategorie($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Categorie', '\Cungfoo\Model\CategorieQuery');
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
     * Filter the query by a related EtablissementSituationGeographique object
     *
     * @param   EtablissementSituationGeographique|PropelObjectCollection $etablissementSituationGeographique  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   EtablissementQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByEtablissementSituationGeographique($etablissementSituationGeographique, $comparison = null)
    {
        if ($etablissementSituationGeographique instanceof EtablissementSituationGeographique) {
            return $this
                ->addUsingAlias(EtablissementPeer::ID, $etablissementSituationGeographique->getEtablissementId(), $comparison);
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
     * @return EtablissementQuery The current query, for fluid interface
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
     * Filter the query by a related EtablissementBaignade object
     *
     * @param   EtablissementBaignade|PropelObjectCollection $etablissementBaignade  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   EtablissementQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByEtablissementBaignade($etablissementBaignade, $comparison = null)
    {
        if ($etablissementBaignade instanceof EtablissementBaignade) {
            return $this
                ->addUsingAlias(EtablissementPeer::ID, $etablissementBaignade->getEtablissementId(), $comparison);
        } elseif ($etablissementBaignade instanceof PropelObjectCollection) {
            return $this
                ->useEtablissementBaignadeQuery()
                ->filterByPrimaryKeys($etablissementBaignade->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEtablissementBaignade() only accepts arguments of type EtablissementBaignade or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EtablissementBaignade relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return EtablissementQuery The current query, for fluid interface
     */
    public function joinEtablissementBaignade($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EtablissementBaignade');

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
            $this->addJoinObject($join, 'EtablissementBaignade');
        }

        return $this;
    }

    /**
     * Use the EtablissementBaignade relation EtablissementBaignade object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\EtablissementBaignadeQuery A secondary query class using the current class as primary query
     */
    public function useEtablissementBaignadeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEtablissementBaignade($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EtablissementBaignade', '\Cungfoo\Model\EtablissementBaignadeQuery');
    }

    /**
     * Filter the query by a related EtablissementThematique object
     *
     * @param   EtablissementThematique|PropelObjectCollection $etablissementThematique  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   EtablissementQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByEtablissementThematique($etablissementThematique, $comparison = null)
    {
        if ($etablissementThematique instanceof EtablissementThematique) {
            return $this
                ->addUsingAlias(EtablissementPeer::ID, $etablissementThematique->getEtablissementId(), $comparison);
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
     * @return EtablissementQuery The current query, for fluid interface
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
     * Filter the query by a related EtablissementPointInteret object
     *
     * @param   EtablissementPointInteret|PropelObjectCollection $etablissementPointInteret  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   EtablissementQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByEtablissementPointInteret($etablissementPointInteret, $comparison = null)
    {
        if ($etablissementPointInteret instanceof EtablissementPointInteret) {
            return $this
                ->addUsingAlias(EtablissementPeer::ID, $etablissementPointInteret->getEtablissementId(), $comparison);
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
     * @return EtablissementQuery The current query, for fluid interface
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
     * Filter the query by a related EtablissementEvent object
     *
     * @param   EtablissementEvent|PropelObjectCollection $etablissementEvent  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   EtablissementQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByEtablissementEvent($etablissementEvent, $comparison = null)
    {
        if ($etablissementEvent instanceof EtablissementEvent) {
            return $this
                ->addUsingAlias(EtablissementPeer::ID, $etablissementEvent->getEtablissementId(), $comparison);
        } elseif ($etablissementEvent instanceof PropelObjectCollection) {
            return $this
                ->useEtablissementEventQuery()
                ->filterByPrimaryKeys($etablissementEvent->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEtablissementEvent() only accepts arguments of type EtablissementEvent or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EtablissementEvent relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return EtablissementQuery The current query, for fluid interface
     */
    public function joinEtablissementEvent($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EtablissementEvent');

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
            $this->addJoinObject($join, 'EtablissementEvent');
        }

        return $this;
    }

    /**
     * Use the EtablissementEvent relation EtablissementEvent object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\EtablissementEventQuery A secondary query class using the current class as primary query
     */
    public function useEtablissementEventQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEtablissementEvent($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EtablissementEvent', '\Cungfoo\Model\EtablissementEventQuery');
    }

    /**
     * Filter the query by a related Personnage object
     *
     * @param   Personnage|PropelObjectCollection $personnage  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   EtablissementQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByPersonnage($personnage, $comparison = null)
    {
        if ($personnage instanceof Personnage) {
            return $this
                ->addUsingAlias(EtablissementPeer::ID, $personnage->getEtablissementId(), $comparison);
        } elseif ($personnage instanceof PropelObjectCollection) {
            return $this
                ->usePersonnageQuery()
                ->filterByPrimaryKeys($personnage->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPersonnage() only accepts arguments of type Personnage or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Personnage relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return EtablissementQuery The current query, for fluid interface
     */
    public function joinPersonnage($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Personnage');

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
            $this->addJoinObject($join, 'Personnage');
        }

        return $this;
    }

    /**
     * Use the Personnage relation Personnage object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\PersonnageQuery A secondary query class using the current class as primary query
     */
    public function usePersonnageQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPersonnage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Personnage', '\Cungfoo\Model\PersonnageQuery');
    }

    /**
     * Filter the query by a related MultimediaEtablissement object
     *
     * @param   MultimediaEtablissement|PropelObjectCollection $multimediaEtablissement  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   EtablissementQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByMultimediaEtablissement($multimediaEtablissement, $comparison = null)
    {
        if ($multimediaEtablissement instanceof MultimediaEtablissement) {
            return $this
                ->addUsingAlias(EtablissementPeer::ID, $multimediaEtablissement->getEtablissementId(), $comparison);
        } elseif ($multimediaEtablissement instanceof PropelObjectCollection) {
            return $this
                ->useMultimediaEtablissementQuery()
                ->filterByPrimaryKeys($multimediaEtablissement->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByMultimediaEtablissement() only accepts arguments of type MultimediaEtablissement or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the MultimediaEtablissement relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return EtablissementQuery The current query, for fluid interface
     */
    public function joinMultimediaEtablissement($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('MultimediaEtablissement');

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
            $this->addJoinObject($join, 'MultimediaEtablissement');
        }

        return $this;
    }

    /**
     * Use the MultimediaEtablissement relation MultimediaEtablissement object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\MultimediaEtablissementQuery A secondary query class using the current class as primary query
     */
    public function useMultimediaEtablissementQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinMultimediaEtablissement($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MultimediaEtablissement', '\Cungfoo\Model\MultimediaEtablissementQuery');
    }

    /**
     * Filter the query by a related EtablissementI18n object
     *
     * @param   EtablissementI18n|PropelObjectCollection $etablissementI18n  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   EtablissementQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByEtablissementI18n($etablissementI18n, $comparison = null)
    {
        if ($etablissementI18n instanceof EtablissementI18n) {
            return $this
                ->addUsingAlias(EtablissementPeer::ID, $etablissementI18n->getId(), $comparison);
        } elseif ($etablissementI18n instanceof PropelObjectCollection) {
            return $this
                ->useEtablissementI18nQuery()
                ->filterByPrimaryKeys($etablissementI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEtablissementI18n() only accepts arguments of type EtablissementI18n or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the EtablissementI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return EtablissementQuery The current query, for fluid interface
     */
    public function joinEtablissementI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('EtablissementI18n');

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
            $this->addJoinObject($join, 'EtablissementI18n');
        }

        return $this;
    }

    /**
     * Use the EtablissementI18n relation EtablissementI18n object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\EtablissementI18nQuery A secondary query class using the current class as primary query
     */
    public function useEtablissementI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinEtablissementI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EtablissementI18n', '\Cungfoo\Model\EtablissementI18nQuery');
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
     * Filter the query by a related SituationGeographique object
     * using the etablissement_situation_geographique table as cross reference
     *
     * @param   SituationGeographique $situationGeographique the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   EtablissementQuery The current query, for fluid interface
     */
    public function filterBySituationGeographique($situationGeographique, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useEtablissementSituationGeographiqueQuery()
            ->filterBySituationGeographique($situationGeographique, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Baignade object
     * using the etablissement_baignade table as cross reference
     *
     * @param   Baignade $baignade the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   EtablissementQuery The current query, for fluid interface
     */
    public function filterByBaignade($baignade, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useEtablissementBaignadeQuery()
            ->filterByBaignade($baignade, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Thematique object
     * using the etablissement_thematique table as cross reference
     *
     * @param   Thematique $thematique the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   EtablissementQuery The current query, for fluid interface
     */
    public function filterByThematique($thematique, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useEtablissementThematiqueQuery()
            ->filterByThematique($thematique, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related PointInteret object
     * using the etablissement_point_interet table as cross reference
     *
     * @param   PointInteret $pointInteret the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   EtablissementQuery The current query, for fluid interface
     */
    public function filterByPointInteret($pointInteret, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useEtablissementPointInteretQuery()
            ->filterByPointInteret($pointInteret, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Event object
     * using the etablissement_event table as cross reference
     *
     * @param   Event $event the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   EtablissementQuery The current query, for fluid interface
     */
    public function filterByEvent($event, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useEtablissementEventQuery()
            ->filterByEvent($event, $comparison)
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

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     EtablissementQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(EtablissementPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     EtablissementQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(EtablissementPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     EtablissementQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(EtablissementPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     EtablissementQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(EtablissementPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     EtablissementQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(EtablissementPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     EtablissementQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(EtablissementPeer::CREATED_AT);
    }
    // i18n behavior

    /**
     * Adds a JOIN clause to the query using the i18n relation
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    EtablissementQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'EtablissementI18n';

        return $this
            ->joinEtablissementI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    EtablissementQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'fr', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('EtablissementI18n');
        $this->with['EtablissementI18n']->setIsWithOneToMany(false);

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
     * @return    EtablissementI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EtablissementI18n', 'Cungfoo\Model\EtablissementI18nQuery');
    }

}
