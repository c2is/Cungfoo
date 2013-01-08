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
use Cungfoo\Model\TypeHebergement;
use Cungfoo\Model\TypeHebergementI18n;
use Cungfoo\Model\TypeHebergementI18nPeer;
use Cungfoo\Model\TypeHebergementI18nQuery;

/**
 * Base class that represents a query for the 'type_hebergement_i18n' table.
 *
 *
 *
 * @method TypeHebergementI18nQuery orderById($order = Criteria::ASC) Order by the id column
 * @method TypeHebergementI18nQuery orderByLocale($order = Criteria::ASC) Order by the locale column
 * @method TypeHebergementI18nQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method TypeHebergementI18nQuery orderBySlug($order = Criteria::ASC) Order by the slug column
 * @method TypeHebergementI18nQuery orderBySurface($order = Criteria::ASC) Order by the surface column
 * @method TypeHebergementI18nQuery orderByTypeTerrasse($order = Criteria::ASC) Order by the type_terrasse column
 * @method TypeHebergementI18nQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method TypeHebergementI18nQuery orderByComposition($order = Criteria::ASC) Order by the composition column
 * @method TypeHebergementI18nQuery orderByPresentation($order = Criteria::ASC) Order by the presentation column
 * @method TypeHebergementI18nQuery orderByCapaciteHebergement($order = Criteria::ASC) Order by the capacite_hebergement column
 * @method TypeHebergementI18nQuery orderByDimensions($order = Criteria::ASC) Order by the dimensions column
 * @method TypeHebergementI18nQuery orderByAgencement($order = Criteria::ASC) Order by the agencement column
 * @method TypeHebergementI18nQuery orderByEquipements($order = Criteria::ASC) Order by the equipements column
 * @method TypeHebergementI18nQuery orderByAnneeUtilisation($order = Criteria::ASC) Order by the annee_utilisation column
 * @method TypeHebergementI18nQuery orderByRemarque1($order = Criteria::ASC) Order by the remarque_1 column
 * @method TypeHebergementI18nQuery orderByRemarque2($order = Criteria::ASC) Order by the remarque_2 column
 * @method TypeHebergementI18nQuery orderByRemarque3($order = Criteria::ASC) Order by the remarque_3 column
 * @method TypeHebergementI18nQuery orderByRemarque4($order = Criteria::ASC) Order by the remarque_4 column
 *
 * @method TypeHebergementI18nQuery groupById() Group by the id column
 * @method TypeHebergementI18nQuery groupByLocale() Group by the locale column
 * @method TypeHebergementI18nQuery groupByName() Group by the name column
 * @method TypeHebergementI18nQuery groupBySlug() Group by the slug column
 * @method TypeHebergementI18nQuery groupBySurface() Group by the surface column
 * @method TypeHebergementI18nQuery groupByTypeTerrasse() Group by the type_terrasse column
 * @method TypeHebergementI18nQuery groupByDescription() Group by the description column
 * @method TypeHebergementI18nQuery groupByComposition() Group by the composition column
 * @method TypeHebergementI18nQuery groupByPresentation() Group by the presentation column
 * @method TypeHebergementI18nQuery groupByCapaciteHebergement() Group by the capacite_hebergement column
 * @method TypeHebergementI18nQuery groupByDimensions() Group by the dimensions column
 * @method TypeHebergementI18nQuery groupByAgencement() Group by the agencement column
 * @method TypeHebergementI18nQuery groupByEquipements() Group by the equipements column
 * @method TypeHebergementI18nQuery groupByAnneeUtilisation() Group by the annee_utilisation column
 * @method TypeHebergementI18nQuery groupByRemarque1() Group by the remarque_1 column
 * @method TypeHebergementI18nQuery groupByRemarque2() Group by the remarque_2 column
 * @method TypeHebergementI18nQuery groupByRemarque3() Group by the remarque_3 column
 * @method TypeHebergementI18nQuery groupByRemarque4() Group by the remarque_4 column
 *
 * @method TypeHebergementI18nQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method TypeHebergementI18nQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method TypeHebergementI18nQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method TypeHebergementI18nQuery leftJoinTypeHebergement($relationAlias = null) Adds a LEFT JOIN clause to the query using the TypeHebergement relation
 * @method TypeHebergementI18nQuery rightJoinTypeHebergement($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TypeHebergement relation
 * @method TypeHebergementI18nQuery innerJoinTypeHebergement($relationAlias = null) Adds a INNER JOIN clause to the query using the TypeHebergement relation
 *
 * @method TypeHebergementI18n findOne(PropelPDO $con = null) Return the first TypeHebergementI18n matching the query
 * @method TypeHebergementI18n findOneOrCreate(PropelPDO $con = null) Return the first TypeHebergementI18n matching the query, or a new TypeHebergementI18n object populated from the query conditions when no match is found
 *
 * @method TypeHebergementI18n findOneById(int $id) Return the first TypeHebergementI18n filtered by the id column
 * @method TypeHebergementI18n findOneByLocale(string $locale) Return the first TypeHebergementI18n filtered by the locale column
 * @method TypeHebergementI18n findOneByName(string $name) Return the first TypeHebergementI18n filtered by the name column
 * @method TypeHebergementI18n findOneBySlug(string $slug) Return the first TypeHebergementI18n filtered by the slug column
 * @method TypeHebergementI18n findOneBySurface(string $surface) Return the first TypeHebergementI18n filtered by the surface column
 * @method TypeHebergementI18n findOneByTypeTerrasse(string $type_terrasse) Return the first TypeHebergementI18n filtered by the type_terrasse column
 * @method TypeHebergementI18n findOneByDescription(string $description) Return the first TypeHebergementI18n filtered by the description column
 * @method TypeHebergementI18n findOneByComposition(string $composition) Return the first TypeHebergementI18n filtered by the composition column
 * @method TypeHebergementI18n findOneByPresentation(string $presentation) Return the first TypeHebergementI18n filtered by the presentation column
 * @method TypeHebergementI18n findOneByCapaciteHebergement(string $capacite_hebergement) Return the first TypeHebergementI18n filtered by the capacite_hebergement column
 * @method TypeHebergementI18n findOneByDimensions(string $dimensions) Return the first TypeHebergementI18n filtered by the dimensions column
 * @method TypeHebergementI18n findOneByAgencement(string $agencement) Return the first TypeHebergementI18n filtered by the agencement column
 * @method TypeHebergementI18n findOneByEquipements(string $equipements) Return the first TypeHebergementI18n filtered by the equipements column
 * @method TypeHebergementI18n findOneByAnneeUtilisation(string $annee_utilisation) Return the first TypeHebergementI18n filtered by the annee_utilisation column
 * @method TypeHebergementI18n findOneByRemarque1(string $remarque_1) Return the first TypeHebergementI18n filtered by the remarque_1 column
 * @method TypeHebergementI18n findOneByRemarque2(string $remarque_2) Return the first TypeHebergementI18n filtered by the remarque_2 column
 * @method TypeHebergementI18n findOneByRemarque3(string $remarque_3) Return the first TypeHebergementI18n filtered by the remarque_3 column
 * @method TypeHebergementI18n findOneByRemarque4(string $remarque_4) Return the first TypeHebergementI18n filtered by the remarque_4 column
 *
 * @method array findById(int $id) Return TypeHebergementI18n objects filtered by the id column
 * @method array findByLocale(string $locale) Return TypeHebergementI18n objects filtered by the locale column
 * @method array findByName(string $name) Return TypeHebergementI18n objects filtered by the name column
 * @method array findBySlug(string $slug) Return TypeHebergementI18n objects filtered by the slug column
 * @method array findBySurface(string $surface) Return TypeHebergementI18n objects filtered by the surface column
 * @method array findByTypeTerrasse(string $type_terrasse) Return TypeHebergementI18n objects filtered by the type_terrasse column
 * @method array findByDescription(string $description) Return TypeHebergementI18n objects filtered by the description column
 * @method array findByComposition(string $composition) Return TypeHebergementI18n objects filtered by the composition column
 * @method array findByPresentation(string $presentation) Return TypeHebergementI18n objects filtered by the presentation column
 * @method array findByCapaciteHebergement(string $capacite_hebergement) Return TypeHebergementI18n objects filtered by the capacite_hebergement column
 * @method array findByDimensions(string $dimensions) Return TypeHebergementI18n objects filtered by the dimensions column
 * @method array findByAgencement(string $agencement) Return TypeHebergementI18n objects filtered by the agencement column
 * @method array findByEquipements(string $equipements) Return TypeHebergementI18n objects filtered by the equipements column
 * @method array findByAnneeUtilisation(string $annee_utilisation) Return TypeHebergementI18n objects filtered by the annee_utilisation column
 * @method array findByRemarque1(string $remarque_1) Return TypeHebergementI18n objects filtered by the remarque_1 column
 * @method array findByRemarque2(string $remarque_2) Return TypeHebergementI18n objects filtered by the remarque_2 column
 * @method array findByRemarque3(string $remarque_3) Return TypeHebergementI18n objects filtered by the remarque_3 column
 * @method array findByRemarque4(string $remarque_4) Return TypeHebergementI18n objects filtered by the remarque_4 column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseTypeHebergementI18nQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseTypeHebergementI18nQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\TypeHebergementI18n', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new TypeHebergementI18nQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     TypeHebergementI18nQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return TypeHebergementI18nQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof TypeHebergementI18nQuery) {
            return $criteria;
        }
        $query = new TypeHebergementI18nQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array $key Primary key to use for the query
                         A Primary key composition: [$id, $locale]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   TypeHebergementI18n|TypeHebergementI18n[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TypeHebergementI18nPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(TypeHebergementI18nPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return   TypeHebergementI18n A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `locale`, `name`, `slug`, `surface`, `type_terrasse`, `description`, `composition`, `presentation`, `capacite_hebergement`, `dimensions`, `agencement`, `equipements`, `annee_utilisation`, `remarque_1`, `remarque_2`, `remarque_3`, `remarque_4` FROM `type_hebergement_i18n` WHERE `id` = :p0 AND `locale` = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new TypeHebergementI18n();
            $obj->hydrate($row);
            TypeHebergementI18nPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return TypeHebergementI18n|TypeHebergementI18n[]|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|TypeHebergementI18n[]|mixed the list of results, formatted by the current formatter
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
     * @return TypeHebergementI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(TypeHebergementI18nPeer::ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(TypeHebergementI18nPeer::LOCALE, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return TypeHebergementI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(TypeHebergementI18nPeer::ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(TypeHebergementI18nPeer::LOCALE, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @see       filterByTypeHebergement()
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TypeHebergementI18nQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(TypeHebergementI18nPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the locale column
     *
     * Example usage:
     * <code>
     * $query->filterByLocale('fooValue');   // WHERE locale = 'fooValue'
     * $query->filterByLocale('%fooValue%'); // WHERE locale LIKE '%fooValue%'
     * </code>
     *
     * @param     string $locale The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TypeHebergementI18nQuery The current query, for fluid interface
     */
    public function filterByLocale($locale = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($locale)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $locale)) {
                $locale = str_replace('*', '%', $locale);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TypeHebergementI18nPeer::LOCALE, $locale, $comparison);
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
     * @return TypeHebergementI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(TypeHebergementI18nPeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query on the slug column
     *
     * Example usage:
     * <code>
     * $query->filterBySlug('fooValue');   // WHERE slug = 'fooValue'
     * $query->filterBySlug('%fooValue%'); // WHERE slug LIKE '%fooValue%'
     * </code>
     *
     * @param     string $slug The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TypeHebergementI18nQuery The current query, for fluid interface
     */
    public function filterBySlug($slug = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($slug)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $slug)) {
                $slug = str_replace('*', '%', $slug);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TypeHebergementI18nPeer::SLUG, $slug, $comparison);
    }

    /**
     * Filter the query on the surface column
     *
     * Example usage:
     * <code>
     * $query->filterBySurface('fooValue');   // WHERE surface = 'fooValue'
     * $query->filterBySurface('%fooValue%'); // WHERE surface LIKE '%fooValue%'
     * </code>
     *
     * @param     string $surface The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TypeHebergementI18nQuery The current query, for fluid interface
     */
    public function filterBySurface($surface = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($surface)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $surface)) {
                $surface = str_replace('*', '%', $surface);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TypeHebergementI18nPeer::SURFACE, $surface, $comparison);
    }

    /**
     * Filter the query on the type_terrasse column
     *
     * Example usage:
     * <code>
     * $query->filterByTypeTerrasse('fooValue');   // WHERE type_terrasse = 'fooValue'
     * $query->filterByTypeTerrasse('%fooValue%'); // WHERE type_terrasse LIKE '%fooValue%'
     * </code>
     *
     * @param     string $typeTerrasse The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TypeHebergementI18nQuery The current query, for fluid interface
     */
    public function filterByTypeTerrasse($typeTerrasse = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($typeTerrasse)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $typeTerrasse)) {
                $typeTerrasse = str_replace('*', '%', $typeTerrasse);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TypeHebergementI18nPeer::TYPE_TERRASSE, $typeTerrasse, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%'); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TypeHebergementI18nQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $description)) {
                $description = str_replace('*', '%', $description);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TypeHebergementI18nPeer::DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the composition column
     *
     * Example usage:
     * <code>
     * $query->filterByComposition('fooValue');   // WHERE composition = 'fooValue'
     * $query->filterByComposition('%fooValue%'); // WHERE composition LIKE '%fooValue%'
     * </code>
     *
     * @param     string $composition The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TypeHebergementI18nQuery The current query, for fluid interface
     */
    public function filterByComposition($composition = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($composition)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $composition)) {
                $composition = str_replace('*', '%', $composition);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TypeHebergementI18nPeer::COMPOSITION, $composition, $comparison);
    }

    /**
     * Filter the query on the presentation column
     *
     * Example usage:
     * <code>
     * $query->filterByPresentation('fooValue');   // WHERE presentation = 'fooValue'
     * $query->filterByPresentation('%fooValue%'); // WHERE presentation LIKE '%fooValue%'
     * </code>
     *
     * @param     string $presentation The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TypeHebergementI18nQuery The current query, for fluid interface
     */
    public function filterByPresentation($presentation = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($presentation)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $presentation)) {
                $presentation = str_replace('*', '%', $presentation);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TypeHebergementI18nPeer::PRESENTATION, $presentation, $comparison);
    }

    /**
     * Filter the query on the capacite_hebergement column
     *
     * Example usage:
     * <code>
     * $query->filterByCapaciteHebergement('fooValue');   // WHERE capacite_hebergement = 'fooValue'
     * $query->filterByCapaciteHebergement('%fooValue%'); // WHERE capacite_hebergement LIKE '%fooValue%'
     * </code>
     *
     * @param     string $capaciteHebergement The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TypeHebergementI18nQuery The current query, for fluid interface
     */
    public function filterByCapaciteHebergement($capaciteHebergement = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($capaciteHebergement)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $capaciteHebergement)) {
                $capaciteHebergement = str_replace('*', '%', $capaciteHebergement);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TypeHebergementI18nPeer::CAPACITE_HEBERGEMENT, $capaciteHebergement, $comparison);
    }

    /**
     * Filter the query on the dimensions column
     *
     * Example usage:
     * <code>
     * $query->filterByDimensions('fooValue');   // WHERE dimensions = 'fooValue'
     * $query->filterByDimensions('%fooValue%'); // WHERE dimensions LIKE '%fooValue%'
     * </code>
     *
     * @param     string $dimensions The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TypeHebergementI18nQuery The current query, for fluid interface
     */
    public function filterByDimensions($dimensions = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dimensions)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $dimensions)) {
                $dimensions = str_replace('*', '%', $dimensions);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TypeHebergementI18nPeer::DIMENSIONS, $dimensions, $comparison);
    }

    /**
     * Filter the query on the agencement column
     *
     * Example usage:
     * <code>
     * $query->filterByAgencement('fooValue');   // WHERE agencement = 'fooValue'
     * $query->filterByAgencement('%fooValue%'); // WHERE agencement LIKE '%fooValue%'
     * </code>
     *
     * @param     string $agencement The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TypeHebergementI18nQuery The current query, for fluid interface
     */
    public function filterByAgencement($agencement = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($agencement)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $agencement)) {
                $agencement = str_replace('*', '%', $agencement);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TypeHebergementI18nPeer::AGENCEMENT, $agencement, $comparison);
    }

    /**
     * Filter the query on the equipements column
     *
     * Example usage:
     * <code>
     * $query->filterByEquipements('fooValue');   // WHERE equipements = 'fooValue'
     * $query->filterByEquipements('%fooValue%'); // WHERE equipements LIKE '%fooValue%'
     * </code>
     *
     * @param     string $equipements The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TypeHebergementI18nQuery The current query, for fluid interface
     */
    public function filterByEquipements($equipements = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($equipements)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $equipements)) {
                $equipements = str_replace('*', '%', $equipements);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TypeHebergementI18nPeer::EQUIPEMENTS, $equipements, $comparison);
    }

    /**
     * Filter the query on the annee_utilisation column
     *
     * Example usage:
     * <code>
     * $query->filterByAnneeUtilisation('fooValue');   // WHERE annee_utilisation = 'fooValue'
     * $query->filterByAnneeUtilisation('%fooValue%'); // WHERE annee_utilisation LIKE '%fooValue%'
     * </code>
     *
     * @param     string $anneeUtilisation The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TypeHebergementI18nQuery The current query, for fluid interface
     */
    public function filterByAnneeUtilisation($anneeUtilisation = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($anneeUtilisation)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $anneeUtilisation)) {
                $anneeUtilisation = str_replace('*', '%', $anneeUtilisation);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TypeHebergementI18nPeer::ANNEE_UTILISATION, $anneeUtilisation, $comparison);
    }

    /**
     * Filter the query on the remarque_1 column
     *
     * Example usage:
     * <code>
     * $query->filterByRemarque1('fooValue');   // WHERE remarque_1 = 'fooValue'
     * $query->filterByRemarque1('%fooValue%'); // WHERE remarque_1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $remarque1 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TypeHebergementI18nQuery The current query, for fluid interface
     */
    public function filterByRemarque1($remarque1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($remarque1)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $remarque1)) {
                $remarque1 = str_replace('*', '%', $remarque1);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TypeHebergementI18nPeer::REMARQUE_1, $remarque1, $comparison);
    }

    /**
     * Filter the query on the remarque_2 column
     *
     * Example usage:
     * <code>
     * $query->filterByRemarque2('fooValue');   // WHERE remarque_2 = 'fooValue'
     * $query->filterByRemarque2('%fooValue%'); // WHERE remarque_2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $remarque2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TypeHebergementI18nQuery The current query, for fluid interface
     */
    public function filterByRemarque2($remarque2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($remarque2)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $remarque2)) {
                $remarque2 = str_replace('*', '%', $remarque2);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TypeHebergementI18nPeer::REMARQUE_2, $remarque2, $comparison);
    }

    /**
     * Filter the query on the remarque_3 column
     *
     * Example usage:
     * <code>
     * $query->filterByRemarque3('fooValue');   // WHERE remarque_3 = 'fooValue'
     * $query->filterByRemarque3('%fooValue%'); // WHERE remarque_3 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $remarque3 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TypeHebergementI18nQuery The current query, for fluid interface
     */
    public function filterByRemarque3($remarque3 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($remarque3)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $remarque3)) {
                $remarque3 = str_replace('*', '%', $remarque3);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TypeHebergementI18nPeer::REMARQUE_3, $remarque3, $comparison);
    }

    /**
     * Filter the query on the remarque_4 column
     *
     * Example usage:
     * <code>
     * $query->filterByRemarque4('fooValue');   // WHERE remarque_4 = 'fooValue'
     * $query->filterByRemarque4('%fooValue%'); // WHERE remarque_4 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $remarque4 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TypeHebergementI18nQuery The current query, for fluid interface
     */
    public function filterByRemarque4($remarque4 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($remarque4)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $remarque4)) {
                $remarque4 = str_replace('*', '%', $remarque4);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TypeHebergementI18nPeer::REMARQUE_4, $remarque4, $comparison);
    }

    /**
     * Filter the query by a related TypeHebergement object
     *
     * @param   TypeHebergement|PropelObjectCollection $typeHebergement The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TypeHebergementI18nQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTypeHebergement($typeHebergement, $comparison = null)
    {
        if ($typeHebergement instanceof TypeHebergement) {
            return $this
                ->addUsingAlias(TypeHebergementI18nPeer::ID, $typeHebergement->getId(), $comparison);
        } elseif ($typeHebergement instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TypeHebergementI18nPeer::ID, $typeHebergement->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByTypeHebergement() only accepts arguments of type TypeHebergement or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TypeHebergement relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TypeHebergementI18nQuery The current query, for fluid interface
     */
    public function joinTypeHebergement($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TypeHebergement');

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
            $this->addJoinObject($join, 'TypeHebergement');
        }

        return $this;
    }

    /**
     * Use the TypeHebergement relation TypeHebergement object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\TypeHebergementQuery A secondary query class using the current class as primary query
     */
    public function useTypeHebergementQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinTypeHebergement($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TypeHebergement', '\Cungfoo\Model\TypeHebergementQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   TypeHebergementI18n $typeHebergementI18n Object to remove from the list of results
     *
     * @return TypeHebergementI18nQuery The current query, for fluid interface
     */
    public function prune($typeHebergementI18n = null)
    {
        if ($typeHebergementI18n) {
            $this->addCond('pruneCond0', $this->getAliasedColName(TypeHebergementI18nPeer::ID), $typeHebergementI18n->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(TypeHebergementI18nPeer::LOCALE), $typeHebergementI18n->getLocale(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
