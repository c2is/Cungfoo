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
use Cungfoo\Model\CategoryTypeHebergement;
use Cungfoo\Model\Etablissement;
use Cungfoo\Model\EtablissementTypeHebergement;
use Cungfoo\Model\TypeHebergement;
use Cungfoo\Model\TypeHebergementI18n;
use Cungfoo\Model\TypeHebergementPeer;
use Cungfoo\Model\TypeHebergementQuery;

/**
 * Base class that represents a query for the 'type_hebergement' table.
 *
 *
 *
 * @method TypeHebergementQuery orderById($order = Criteria::ASC) Order by the id column
 * @method TypeHebergementQuery orderByCode($order = Criteria::ASC) Order by the code column
 * @method TypeHebergementQuery orderByCategoryTypeHebergementId($order = Criteria::ASC) Order by the category_type_hebergement_id column
 * @method TypeHebergementQuery orderByNombreChambre($order = Criteria::ASC) Order by the nombre_chambre column
 * @method TypeHebergementQuery orderByNombrePlace($order = Criteria::ASC) Order by the nombre_place column
 * @method TypeHebergementQuery orderByImageHebergementPath($order = Criteria::ASC) Order by the image_hebergement_path column
 * @method TypeHebergementQuery orderByImageCompositionPath($order = Criteria::ASC) Order by the image_composition_path column
 * @method TypeHebergementQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method TypeHebergementQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method TypeHebergementQuery orderByActive($order = Criteria::ASC) Order by the active column
 *
 * @method TypeHebergementQuery groupById() Group by the id column
 * @method TypeHebergementQuery groupByCode() Group by the code column
 * @method TypeHebergementQuery groupByCategoryTypeHebergementId() Group by the category_type_hebergement_id column
 * @method TypeHebergementQuery groupByNombreChambre() Group by the nombre_chambre column
 * @method TypeHebergementQuery groupByNombrePlace() Group by the nombre_place column
 * @method TypeHebergementQuery groupByImageHebergementPath() Group by the image_hebergement_path column
 * @method TypeHebergementQuery groupByImageCompositionPath() Group by the image_composition_path column
 * @method TypeHebergementQuery groupByCreatedAt() Group by the created_at column
 * @method TypeHebergementQuery groupByUpdatedAt() Group by the updated_at column
 * @method TypeHebergementQuery groupByActive() Group by the active column
 *
 * @method TypeHebergementQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method TypeHebergementQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method TypeHebergementQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method TypeHebergementQuery leftJoinCategoryTypeHebergement($relationAlias = null) Adds a LEFT JOIN clause to the query using the CategoryTypeHebergement relation
 * @method TypeHebergementQuery rightJoinCategoryTypeHebergement($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CategoryTypeHebergement relation
 * @method TypeHebergementQuery innerJoinCategoryTypeHebergement($relationAlias = null) Adds a INNER JOIN clause to the query using the CategoryTypeHebergement relation
 *
 * @method TypeHebergementQuery leftJoinEtablissementTypeHebergement($relationAlias = null) Adds a LEFT JOIN clause to the query using the EtablissementTypeHebergement relation
 * @method TypeHebergementQuery rightJoinEtablissementTypeHebergement($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EtablissementTypeHebergement relation
 * @method TypeHebergementQuery innerJoinEtablissementTypeHebergement($relationAlias = null) Adds a INNER JOIN clause to the query using the EtablissementTypeHebergement relation
 *
 * @method TypeHebergementQuery leftJoinTypeHebergementI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the TypeHebergementI18n relation
 * @method TypeHebergementQuery rightJoinTypeHebergementI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TypeHebergementI18n relation
 * @method TypeHebergementQuery innerJoinTypeHebergementI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the TypeHebergementI18n relation
 *
 * @method TypeHebergement findOne(PropelPDO $con = null) Return the first TypeHebergement matching the query
 * @method TypeHebergement findOneOrCreate(PropelPDO $con = null) Return the first TypeHebergement matching the query, or a new TypeHebergement object populated from the query conditions when no match is found
 *
 * @method TypeHebergement findOneByCode(string $code) Return the first TypeHebergement filtered by the code column
 * @method TypeHebergement findOneByCategoryTypeHebergementId(int $category_type_hebergement_id) Return the first TypeHebergement filtered by the category_type_hebergement_id column
 * @method TypeHebergement findOneByNombreChambre(int $nombre_chambre) Return the first TypeHebergement filtered by the nombre_chambre column
 * @method TypeHebergement findOneByNombrePlace(int $nombre_place) Return the first TypeHebergement filtered by the nombre_place column
 * @method TypeHebergement findOneByImageHebergementPath(string $image_hebergement_path) Return the first TypeHebergement filtered by the image_hebergement_path column
 * @method TypeHebergement findOneByImageCompositionPath(string $image_composition_path) Return the first TypeHebergement filtered by the image_composition_path column
 * @method TypeHebergement findOneByCreatedAt(string $created_at) Return the first TypeHebergement filtered by the created_at column
 * @method TypeHebergement findOneByUpdatedAt(string $updated_at) Return the first TypeHebergement filtered by the updated_at column
 * @method TypeHebergement findOneByActive(boolean $active) Return the first TypeHebergement filtered by the active column
 *
 * @method array findById(int $id) Return TypeHebergement objects filtered by the id column
 * @method array findByCode(string $code) Return TypeHebergement objects filtered by the code column
 * @method array findByCategoryTypeHebergementId(int $category_type_hebergement_id) Return TypeHebergement objects filtered by the category_type_hebergement_id column
 * @method array findByNombreChambre(int $nombre_chambre) Return TypeHebergement objects filtered by the nombre_chambre column
 * @method array findByNombrePlace(int $nombre_place) Return TypeHebergement objects filtered by the nombre_place column
 * @method array findByImageHebergementPath(string $image_hebergement_path) Return TypeHebergement objects filtered by the image_hebergement_path column
 * @method array findByImageCompositionPath(string $image_composition_path) Return TypeHebergement objects filtered by the image_composition_path column
 * @method array findByCreatedAt(string $created_at) Return TypeHebergement objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return TypeHebergement objects filtered by the updated_at column
 * @method array findByActive(boolean $active) Return TypeHebergement objects filtered by the active column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseTypeHebergementQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseTypeHebergementQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\TypeHebergement', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new TypeHebergementQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     TypeHebergementQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return TypeHebergementQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof TypeHebergementQuery) {
            return $criteria;
        }
        $query = new TypeHebergementQuery();
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
     * @return   TypeHebergement|TypeHebergement[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TypeHebergementPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(TypeHebergementPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   TypeHebergement A model object, or null if the key is not found
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
     * @return   TypeHebergement A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `code`, `category_type_hebergement_id`, `nombre_chambre`, `nombre_place`, `image_hebergement_path`, `image_composition_path`, `created_at`, `updated_at`, `active` FROM `type_hebergement` WHERE `id` = :p0';
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
            $obj = new TypeHebergement();
            $obj->hydrate($row);
            TypeHebergementPeer::addInstanceToPool($obj, (string) $key);
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
     * @return TypeHebergement|TypeHebergement[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|TypeHebergement[]|mixed the list of results, formatted by the current formatter
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
     * @return TypeHebergementQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TypeHebergementPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return TypeHebergementQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TypeHebergementPeer::ID, $keys, Criteria::IN);
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
     * @return TypeHebergementQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(TypeHebergementPeer::ID, $id, $comparison);
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
     * @return TypeHebergementQuery The current query, for fluid interface
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

        return $this->addUsingAlias(TypeHebergementPeer::CODE, $code, $comparison);
    }

    /**
     * Filter the query on the category_type_hebergement_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCategoryTypeHebergementId(1234); // WHERE category_type_hebergement_id = 1234
     * $query->filterByCategoryTypeHebergementId(array(12, 34)); // WHERE category_type_hebergement_id IN (12, 34)
     * $query->filterByCategoryTypeHebergementId(array('min' => 12)); // WHERE category_type_hebergement_id > 12
     * </code>
     *
     * @see       filterByCategoryTypeHebergement()
     *
     * @param     mixed $categoryTypeHebergementId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TypeHebergementQuery The current query, for fluid interface
     */
    public function filterByCategoryTypeHebergementId($categoryTypeHebergementId = null, $comparison = null)
    {
        if (is_array($categoryTypeHebergementId)) {
            $useMinMax = false;
            if (isset($categoryTypeHebergementId['min'])) {
                $this->addUsingAlias(TypeHebergementPeer::CATEGORY_TYPE_HEBERGEMENT_ID, $categoryTypeHebergementId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($categoryTypeHebergementId['max'])) {
                $this->addUsingAlias(TypeHebergementPeer::CATEGORY_TYPE_HEBERGEMENT_ID, $categoryTypeHebergementId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TypeHebergementPeer::CATEGORY_TYPE_HEBERGEMENT_ID, $categoryTypeHebergementId, $comparison);
    }

    /**
     * Filter the query on the nombre_chambre column
     *
     * Example usage:
     * <code>
     * $query->filterByNombreChambre(1234); // WHERE nombre_chambre = 1234
     * $query->filterByNombreChambre(array(12, 34)); // WHERE nombre_chambre IN (12, 34)
     * $query->filterByNombreChambre(array('min' => 12)); // WHERE nombre_chambre > 12
     * </code>
     *
     * @param     mixed $nombreChambre The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TypeHebergementQuery The current query, for fluid interface
     */
    public function filterByNombreChambre($nombreChambre = null, $comparison = null)
    {
        if (is_array($nombreChambre)) {
            $useMinMax = false;
            if (isset($nombreChambre['min'])) {
                $this->addUsingAlias(TypeHebergementPeer::NOMBRE_CHAMBRE, $nombreChambre['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($nombreChambre['max'])) {
                $this->addUsingAlias(TypeHebergementPeer::NOMBRE_CHAMBRE, $nombreChambre['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TypeHebergementPeer::NOMBRE_CHAMBRE, $nombreChambre, $comparison);
    }

    /**
     * Filter the query on the nombre_place column
     *
     * Example usage:
     * <code>
     * $query->filterByNombrePlace(1234); // WHERE nombre_place = 1234
     * $query->filterByNombrePlace(array(12, 34)); // WHERE nombre_place IN (12, 34)
     * $query->filterByNombrePlace(array('min' => 12)); // WHERE nombre_place > 12
     * </code>
     *
     * @param     mixed $nombrePlace The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TypeHebergementQuery The current query, for fluid interface
     */
    public function filterByNombrePlace($nombrePlace = null, $comparison = null)
    {
        if (is_array($nombrePlace)) {
            $useMinMax = false;
            if (isset($nombrePlace['min'])) {
                $this->addUsingAlias(TypeHebergementPeer::NOMBRE_PLACE, $nombrePlace['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($nombrePlace['max'])) {
                $this->addUsingAlias(TypeHebergementPeer::NOMBRE_PLACE, $nombrePlace['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TypeHebergementPeer::NOMBRE_PLACE, $nombrePlace, $comparison);
    }

    /**
     * Filter the query on the image_hebergement_path column
     *
     * Example usage:
     * <code>
     * $query->filterByImageHebergementPath('fooValue');   // WHERE image_hebergement_path = 'fooValue'
     * $query->filterByImageHebergementPath('%fooValue%'); // WHERE image_hebergement_path LIKE '%fooValue%'
     * </code>
     *
     * @param     string $imageHebergementPath The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TypeHebergementQuery The current query, for fluid interface
     */
    public function filterByImageHebergementPath($imageHebergementPath = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($imageHebergementPath)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $imageHebergementPath)) {
                $imageHebergementPath = str_replace('*', '%', $imageHebergementPath);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TypeHebergementPeer::IMAGE_HEBERGEMENT_PATH, $imageHebergementPath, $comparison);
    }

    /**
     * Filter the query on the image_composition_path column
     *
     * Example usage:
     * <code>
     * $query->filterByImageCompositionPath('fooValue');   // WHERE image_composition_path = 'fooValue'
     * $query->filterByImageCompositionPath('%fooValue%'); // WHERE image_composition_path LIKE '%fooValue%'
     * </code>
     *
     * @param     string $imageCompositionPath The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TypeHebergementQuery The current query, for fluid interface
     */
    public function filterByImageCompositionPath($imageCompositionPath = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($imageCompositionPath)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $imageCompositionPath)) {
                $imageCompositionPath = str_replace('*', '%', $imageCompositionPath);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TypeHebergementPeer::IMAGE_COMPOSITION_PATH, $imageCompositionPath, $comparison);
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
     * @return TypeHebergementQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(TypeHebergementPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(TypeHebergementPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TypeHebergementPeer::CREATED_AT, $createdAt, $comparison);
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
     * @return TypeHebergementQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(TypeHebergementPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(TypeHebergementPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TypeHebergementPeer::UPDATED_AT, $updatedAt, $comparison);
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
     * @return TypeHebergementQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(TypeHebergementPeer::ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query by a related CategoryTypeHebergement object
     *
     * @param   CategoryTypeHebergement|PropelObjectCollection $categoryTypeHebergement The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TypeHebergementQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByCategoryTypeHebergement($categoryTypeHebergement, $comparison = null)
    {
        if ($categoryTypeHebergement instanceof CategoryTypeHebergement) {
            return $this
                ->addUsingAlias(TypeHebergementPeer::CATEGORY_TYPE_HEBERGEMENT_ID, $categoryTypeHebergement->getId(), $comparison);
        } elseif ($categoryTypeHebergement instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TypeHebergementPeer::CATEGORY_TYPE_HEBERGEMENT_ID, $categoryTypeHebergement->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCategoryTypeHebergement() only accepts arguments of type CategoryTypeHebergement or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CategoryTypeHebergement relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TypeHebergementQuery The current query, for fluid interface
     */
    public function joinCategoryTypeHebergement($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CategoryTypeHebergement');

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
            $this->addJoinObject($join, 'CategoryTypeHebergement');
        }

        return $this;
    }

    /**
     * Use the CategoryTypeHebergement relation CategoryTypeHebergement object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\CategoryTypeHebergementQuery A secondary query class using the current class as primary query
     */
    public function useCategoryTypeHebergementQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCategoryTypeHebergement($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CategoryTypeHebergement', '\Cungfoo\Model\CategoryTypeHebergementQuery');
    }

    /**
     * Filter the query by a related EtablissementTypeHebergement object
     *
     * @param   EtablissementTypeHebergement|PropelObjectCollection $etablissementTypeHebergement  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TypeHebergementQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByEtablissementTypeHebergement($etablissementTypeHebergement, $comparison = null)
    {
        if ($etablissementTypeHebergement instanceof EtablissementTypeHebergement) {
            return $this
                ->addUsingAlias(TypeHebergementPeer::ID, $etablissementTypeHebergement->getTypeHebergementId(), $comparison);
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
     * @return TypeHebergementQuery The current query, for fluid interface
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
     * Filter the query by a related TypeHebergementI18n object
     *
     * @param   TypeHebergementI18n|PropelObjectCollection $typeHebergementI18n  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TypeHebergementQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTypeHebergementI18n($typeHebergementI18n, $comparison = null)
    {
        if ($typeHebergementI18n instanceof TypeHebergementI18n) {
            return $this
                ->addUsingAlias(TypeHebergementPeer::ID, $typeHebergementI18n->getId(), $comparison);
        } elseif ($typeHebergementI18n instanceof PropelObjectCollection) {
            return $this
                ->useTypeHebergementI18nQuery()
                ->filterByPrimaryKeys($typeHebergementI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTypeHebergementI18n() only accepts arguments of type TypeHebergementI18n or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TypeHebergementI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TypeHebergementQuery The current query, for fluid interface
     */
    public function joinTypeHebergementI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TypeHebergementI18n');

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
            $this->addJoinObject($join, 'TypeHebergementI18n');
        }

        return $this;
    }

    /**
     * Use the TypeHebergementI18n relation TypeHebergementI18n object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\TypeHebergementI18nQuery A secondary query class using the current class as primary query
     */
    public function useTypeHebergementI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinTypeHebergementI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TypeHebergementI18n', '\Cungfoo\Model\TypeHebergementI18nQuery');
    }

    /**
     * Filter the query by a related Etablissement object
     * using the etablissement_type_hebergement table as cross reference
     *
     * @param   Etablissement $etablissement the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TypeHebergementQuery The current query, for fluid interface
     */
    public function filterByEtablissement($etablissement, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useEtablissementTypeHebergementQuery()
            ->filterByEtablissement($etablissement, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   TypeHebergement $typeHebergement Object to remove from the list of results
     *
     * @return TypeHebergementQuery The current query, for fluid interface
     */
    public function prune($typeHebergement = null)
    {
        if ($typeHebergement) {
            $this->addUsingAlias(TypeHebergementPeer::ID, $typeHebergement->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     TypeHebergementQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(TypeHebergementPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     TypeHebergementQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(TypeHebergementPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     TypeHebergementQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(TypeHebergementPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     TypeHebergementQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(TypeHebergementPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     TypeHebergementQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(TypeHebergementPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     TypeHebergementQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(TypeHebergementPeer::CREATED_AT);
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
     * @return    TypeHebergementQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'TypeHebergementI18n';

        return $this
            ->joinTypeHebergementI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    TypeHebergementQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'fr', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('TypeHebergementI18n');
        $this->with['TypeHebergementI18n']->setIsWithOneToMany(false);

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
     * @return    TypeHebergementI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TypeHebergementI18n', 'Cungfoo\Model\TypeHebergementI18nQuery');
    }

}
