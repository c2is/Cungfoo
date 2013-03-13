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
use Cungfoo\Model\BonPlan;
use Cungfoo\Model\BonPlanBonPlanCategorie;
use Cungfoo\Model\BonPlanCategorie;
use Cungfoo\Model\BonPlanEtablissement;
use Cungfoo\Model\BonPlanI18n;
use Cungfoo\Model\BonPlanPeer;
use Cungfoo\Model\BonPlanQuery;
use Cungfoo\Model\BonPlanRegion;
use Cungfoo\Model\Etablissement;
use Cungfoo\Model\Region;

/**
 * Base class that represents a query for the 'bon_plan' table.
 *
 *
 *
 * @method BonPlanQuery orderById($order = Criteria::ASC) Order by the id column
 * @method BonPlanQuery orderByDateDebut($order = Criteria::ASC) Order by the date_debut column
 * @method BonPlanQuery orderByDateFin($order = Criteria::ASC) Order by the date_fin column
 * @method BonPlanQuery orderByPrix($order = Criteria::ASC) Order by the prix column
 * @method BonPlanQuery orderByPrixBarre($order = Criteria::ASC) Order by the prix_barre column
 * @method BonPlanQuery orderByImageMenu($order = Criteria::ASC) Order by the image_menu column
 * @method BonPlanQuery orderByImagePage($order = Criteria::ASC) Order by the image_page column
 * @method BonPlanQuery orderByImageListe($order = Criteria::ASC) Order by the image_liste column
 * @method BonPlanQuery orderByActiveCompteur($order = Criteria::ASC) Order by the active_compteur column
 * @method BonPlanQuery orderByMiseEnAvant($order = Criteria::ASC) Order by the mise_en_avant column
 * @method BonPlanQuery orderByPushHome($order = Criteria::ASC) Order by the push_home column
 * @method BonPlanQuery orderByDateStart($order = Criteria::ASC) Order by the date_start column
 * @method BonPlanQuery orderByDayStart($order = Criteria::ASC) Order by the day_start column
 * @method BonPlanQuery orderByDayRange($order = Criteria::ASC) Order by the day_range column
 * @method BonPlanQuery orderByNbAdultes($order = Criteria::ASC) Order by the nb_adultes column
 * @method BonPlanQuery orderByNbEnfants($order = Criteria::ASC) Order by the nb_enfants column
 * @method BonPlanQuery orderByPeriodCategories($order = Criteria::ASC) Order by the period_categories column
 * @method BonPlanQuery orderByActive($order = Criteria::ASC) Order by the active column
 *
 * @method BonPlanQuery groupById() Group by the id column
 * @method BonPlanQuery groupByDateDebut() Group by the date_debut column
 * @method BonPlanQuery groupByDateFin() Group by the date_fin column
 * @method BonPlanQuery groupByPrix() Group by the prix column
 * @method BonPlanQuery groupByPrixBarre() Group by the prix_barre column
 * @method BonPlanQuery groupByImageMenu() Group by the image_menu column
 * @method BonPlanQuery groupByImagePage() Group by the image_page column
 * @method BonPlanQuery groupByImageListe() Group by the image_liste column
 * @method BonPlanQuery groupByActiveCompteur() Group by the active_compteur column
 * @method BonPlanQuery groupByMiseEnAvant() Group by the mise_en_avant column
 * @method BonPlanQuery groupByPushHome() Group by the push_home column
 * @method BonPlanQuery groupByDateStart() Group by the date_start column
 * @method BonPlanQuery groupByDayStart() Group by the day_start column
 * @method BonPlanQuery groupByDayRange() Group by the day_range column
 * @method BonPlanQuery groupByNbAdultes() Group by the nb_adultes column
 * @method BonPlanQuery groupByNbEnfants() Group by the nb_enfants column
 * @method BonPlanQuery groupByPeriodCategories() Group by the period_categories column
 * @method BonPlanQuery groupByActive() Group by the active column
 *
 * @method BonPlanQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method BonPlanQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method BonPlanQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method BonPlanQuery leftJoinBonPlanBonPlanCategorie($relationAlias = null) Adds a LEFT JOIN clause to the query using the BonPlanBonPlanCategorie relation
 * @method BonPlanQuery rightJoinBonPlanBonPlanCategorie($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BonPlanBonPlanCategorie relation
 * @method BonPlanQuery innerJoinBonPlanBonPlanCategorie($relationAlias = null) Adds a INNER JOIN clause to the query using the BonPlanBonPlanCategorie relation
 *
 * @method BonPlanQuery leftJoinBonPlanEtablissement($relationAlias = null) Adds a LEFT JOIN clause to the query using the BonPlanEtablissement relation
 * @method BonPlanQuery rightJoinBonPlanEtablissement($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BonPlanEtablissement relation
 * @method BonPlanQuery innerJoinBonPlanEtablissement($relationAlias = null) Adds a INNER JOIN clause to the query using the BonPlanEtablissement relation
 *
 * @method BonPlanQuery leftJoinBonPlanRegion($relationAlias = null) Adds a LEFT JOIN clause to the query using the BonPlanRegion relation
 * @method BonPlanQuery rightJoinBonPlanRegion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BonPlanRegion relation
 * @method BonPlanQuery innerJoinBonPlanRegion($relationAlias = null) Adds a INNER JOIN clause to the query using the BonPlanRegion relation
 *
 * @method BonPlanQuery leftJoinBonPlanI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the BonPlanI18n relation
 * @method BonPlanQuery rightJoinBonPlanI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BonPlanI18n relation
 * @method BonPlanQuery innerJoinBonPlanI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the BonPlanI18n relation
 *
 * @method BonPlan findOne(PropelPDO $con = null) Return the first BonPlan matching the query
 * @method BonPlan findOneOrCreate(PropelPDO $con = null) Return the first BonPlan matching the query, or a new BonPlan object populated from the query conditions when no match is found
 *
 * @method BonPlan findOneByDateDebut(string $date_debut) Return the first BonPlan filtered by the date_debut column
 * @method BonPlan findOneByDateFin(string $date_fin) Return the first BonPlan filtered by the date_fin column
 * @method BonPlan findOneByPrix(int $prix) Return the first BonPlan filtered by the prix column
 * @method BonPlan findOneByPrixBarre(int $prix_barre) Return the first BonPlan filtered by the prix_barre column
 * @method BonPlan findOneByImageMenu(string $image_menu) Return the first BonPlan filtered by the image_menu column
 * @method BonPlan findOneByImagePage(string $image_page) Return the first BonPlan filtered by the image_page column
 * @method BonPlan findOneByImageListe(string $image_liste) Return the first BonPlan filtered by the image_liste column
 * @method BonPlan findOneByActiveCompteur(boolean $active_compteur) Return the first BonPlan filtered by the active_compteur column
 * @method BonPlan findOneByMiseEnAvant(boolean $mise_en_avant) Return the first BonPlan filtered by the mise_en_avant column
 * @method BonPlan findOneByPushHome(boolean $push_home) Return the first BonPlan filtered by the push_home column
 * @method BonPlan findOneByDateStart(string $date_start) Return the first BonPlan filtered by the date_start column
 * @method BonPlan findOneByDayStart(int $day_start) Return the first BonPlan filtered by the day_start column
 * @method BonPlan findOneByDayRange(int $day_range) Return the first BonPlan filtered by the day_range column
 * @method BonPlan findOneByNbAdultes(int $nb_adultes) Return the first BonPlan filtered by the nb_adultes column
 * @method BonPlan findOneByNbEnfants(int $nb_enfants) Return the first BonPlan filtered by the nb_enfants column
 * @method BonPlan findOneByPeriodCategories(string $period_categories) Return the first BonPlan filtered by the period_categories column
 * @method BonPlan findOneByActive(boolean $active) Return the first BonPlan filtered by the active column
 *
 * @method array findById(int $id) Return BonPlan objects filtered by the id column
 * @method array findByDateDebut(string $date_debut) Return BonPlan objects filtered by the date_debut column
 * @method array findByDateFin(string $date_fin) Return BonPlan objects filtered by the date_fin column
 * @method array findByPrix(int $prix) Return BonPlan objects filtered by the prix column
 * @method array findByPrixBarre(int $prix_barre) Return BonPlan objects filtered by the prix_barre column
 * @method array findByImageMenu(string $image_menu) Return BonPlan objects filtered by the image_menu column
 * @method array findByImagePage(string $image_page) Return BonPlan objects filtered by the image_page column
 * @method array findByImageListe(string $image_liste) Return BonPlan objects filtered by the image_liste column
 * @method array findByActiveCompteur(boolean $active_compteur) Return BonPlan objects filtered by the active_compteur column
 * @method array findByMiseEnAvant(boolean $mise_en_avant) Return BonPlan objects filtered by the mise_en_avant column
 * @method array findByPushHome(boolean $push_home) Return BonPlan objects filtered by the push_home column
 * @method array findByDateStart(string $date_start) Return BonPlan objects filtered by the date_start column
 * @method array findByDayStart(int $day_start) Return BonPlan objects filtered by the day_start column
 * @method array findByDayRange(int $day_range) Return BonPlan objects filtered by the day_range column
 * @method array findByNbAdultes(int $nb_adultes) Return BonPlan objects filtered by the nb_adultes column
 * @method array findByNbEnfants(int $nb_enfants) Return BonPlan objects filtered by the nb_enfants column
 * @method array findByPeriodCategories(string $period_categories) Return BonPlan objects filtered by the period_categories column
 * @method array findByActive(boolean $active) Return BonPlan objects filtered by the active column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseBonPlanQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseBonPlanQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\BonPlan', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new BonPlanQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     BonPlanQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return BonPlanQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof BonPlanQuery) {
            return $criteria;
        }
        $query = new BonPlanQuery();
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
     * @return   BonPlan|BonPlan[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = BonPlanPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(BonPlanPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   BonPlan A model object, or null if the key is not found
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
     * @return   BonPlan A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `date_debut`, `date_fin`, `prix`, `prix_barre`, `image_menu`, `image_page`, `image_liste`, `active_compteur`, `mise_en_avant`, `push_home`, `date_start`, `day_start`, `day_range`, `nb_adultes`, `nb_enfants`, `period_categories`, `active` FROM `bon_plan` WHERE `id` = :p0';
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
            $obj = new BonPlan();
            $obj->hydrate($row);
            BonPlanPeer::addInstanceToPool($obj, (string) $key);
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
     * @return BonPlan|BonPlan[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|BonPlan[]|mixed the list of results, formatted by the current formatter
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
     * @return BonPlanQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(BonPlanPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return BonPlanQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(BonPlanPeer::ID, $keys, Criteria::IN);
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
     * @return BonPlanQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(BonPlanPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the date_debut column
     *
     * Example usage:
     * <code>
     * $query->filterByDateDebut('2011-03-14'); // WHERE date_debut = '2011-03-14'
     * $query->filterByDateDebut('now'); // WHERE date_debut = '2011-03-14'
     * $query->filterByDateDebut(array('max' => 'yesterday')); // WHERE date_debut > '2011-03-13'
     * </code>
     *
     * @param     mixed $dateDebut The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BonPlanQuery The current query, for fluid interface
     */
    public function filterByDateDebut($dateDebut = null, $comparison = null)
    {
        if (is_array($dateDebut)) {
            $useMinMax = false;
            if (isset($dateDebut['min'])) {
                $this->addUsingAlias(BonPlanPeer::DATE_DEBUT, $dateDebut['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateDebut['max'])) {
                $this->addUsingAlias(BonPlanPeer::DATE_DEBUT, $dateDebut['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BonPlanPeer::DATE_DEBUT, $dateDebut, $comparison);
    }

    /**
     * Filter the query on the date_fin column
     *
     * Example usage:
     * <code>
     * $query->filterByDateFin('2011-03-14'); // WHERE date_fin = '2011-03-14'
     * $query->filterByDateFin('now'); // WHERE date_fin = '2011-03-14'
     * $query->filterByDateFin(array('max' => 'yesterday')); // WHERE date_fin > '2011-03-13'
     * </code>
     *
     * @param     mixed $dateFin The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BonPlanQuery The current query, for fluid interface
     */
    public function filterByDateFin($dateFin = null, $comparison = null)
    {
        if (is_array($dateFin)) {
            $useMinMax = false;
            if (isset($dateFin['min'])) {
                $this->addUsingAlias(BonPlanPeer::DATE_FIN, $dateFin['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateFin['max'])) {
                $this->addUsingAlias(BonPlanPeer::DATE_FIN, $dateFin['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BonPlanPeer::DATE_FIN, $dateFin, $comparison);
    }

    /**
     * Filter the query on the prix column
     *
     * Example usage:
     * <code>
     * $query->filterByPrix(1234); // WHERE prix = 1234
     * $query->filterByPrix(array(12, 34)); // WHERE prix IN (12, 34)
     * $query->filterByPrix(array('min' => 12)); // WHERE prix > 12
     * </code>
     *
     * @param     mixed $prix The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BonPlanQuery The current query, for fluid interface
     */
    public function filterByPrix($prix = null, $comparison = null)
    {
        if (is_array($prix)) {
            $useMinMax = false;
            if (isset($prix['min'])) {
                $this->addUsingAlias(BonPlanPeer::PRIX, $prix['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($prix['max'])) {
                $this->addUsingAlias(BonPlanPeer::PRIX, $prix['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BonPlanPeer::PRIX, $prix, $comparison);
    }

    /**
     * Filter the query on the prix_barre column
     *
     * Example usage:
     * <code>
     * $query->filterByPrixBarre(1234); // WHERE prix_barre = 1234
     * $query->filterByPrixBarre(array(12, 34)); // WHERE prix_barre IN (12, 34)
     * $query->filterByPrixBarre(array('min' => 12)); // WHERE prix_barre > 12
     * </code>
     *
     * @param     mixed $prixBarre The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BonPlanQuery The current query, for fluid interface
     */
    public function filterByPrixBarre($prixBarre = null, $comparison = null)
    {
        if (is_array($prixBarre)) {
            $useMinMax = false;
            if (isset($prixBarre['min'])) {
                $this->addUsingAlias(BonPlanPeer::PRIX_BARRE, $prixBarre['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($prixBarre['max'])) {
                $this->addUsingAlias(BonPlanPeer::PRIX_BARRE, $prixBarre['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BonPlanPeer::PRIX_BARRE, $prixBarre, $comparison);
    }

    /**
     * Filter the query on the image_menu column
     *
     * Example usage:
     * <code>
     * $query->filterByImageMenu('fooValue');   // WHERE image_menu = 'fooValue'
     * $query->filterByImageMenu('%fooValue%'); // WHERE image_menu LIKE '%fooValue%'
     * </code>
     *
     * @param     string $imageMenu The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BonPlanQuery The current query, for fluid interface
     */
    public function filterByImageMenu($imageMenu = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($imageMenu)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $imageMenu)) {
                $imageMenu = str_replace('*', '%', $imageMenu);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(BonPlanPeer::IMAGE_MENU, $imageMenu, $comparison);
    }

    /**
     * Filter the query on the image_page column
     *
     * Example usage:
     * <code>
     * $query->filterByImagePage('fooValue');   // WHERE image_page = 'fooValue'
     * $query->filterByImagePage('%fooValue%'); // WHERE image_page LIKE '%fooValue%'
     * </code>
     *
     * @param     string $imagePage The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BonPlanQuery The current query, for fluid interface
     */
    public function filterByImagePage($imagePage = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($imagePage)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $imagePage)) {
                $imagePage = str_replace('*', '%', $imagePage);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(BonPlanPeer::IMAGE_PAGE, $imagePage, $comparison);
    }

    /**
     * Filter the query on the image_liste column
     *
     * Example usage:
     * <code>
     * $query->filterByImageListe('fooValue');   // WHERE image_liste = 'fooValue'
     * $query->filterByImageListe('%fooValue%'); // WHERE image_liste LIKE '%fooValue%'
     * </code>
     *
     * @param     string $imageListe The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BonPlanQuery The current query, for fluid interface
     */
    public function filterByImageListe($imageListe = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($imageListe)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $imageListe)) {
                $imageListe = str_replace('*', '%', $imageListe);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(BonPlanPeer::IMAGE_LISTE, $imageListe, $comparison);
    }

    /**
     * Filter the query on the active_compteur column
     *
     * Example usage:
     * <code>
     * $query->filterByActiveCompteur(true); // WHERE active_compteur = true
     * $query->filterByActiveCompteur('yes'); // WHERE active_compteur = true
     * </code>
     *
     * @param     boolean|string $activeCompteur The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BonPlanQuery The current query, for fluid interface
     */
    public function filterByActiveCompteur($activeCompteur = null, $comparison = null)
    {
        if (is_string($activeCompteur)) {
            $active_compteur = in_array(strtolower($activeCompteur), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(BonPlanPeer::ACTIVE_COMPTEUR, $activeCompteur, $comparison);
    }

    /**
     * Filter the query on the mise_en_avant column
     *
     * Example usage:
     * <code>
     * $query->filterByMiseEnAvant(true); // WHERE mise_en_avant = true
     * $query->filterByMiseEnAvant('yes'); // WHERE mise_en_avant = true
     * </code>
     *
     * @param     boolean|string $miseEnAvant The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BonPlanQuery The current query, for fluid interface
     */
    public function filterByMiseEnAvant($miseEnAvant = null, $comparison = null)
    {
        if (is_string($miseEnAvant)) {
            $mise_en_avant = in_array(strtolower($miseEnAvant), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(BonPlanPeer::MISE_EN_AVANT, $miseEnAvant, $comparison);
    }

    /**
     * Filter the query on the push_home column
     *
     * Example usage:
     * <code>
     * $query->filterByPushHome(true); // WHERE push_home = true
     * $query->filterByPushHome('yes'); // WHERE push_home = true
     * </code>
     *
     * @param     boolean|string $pushHome The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BonPlanQuery The current query, for fluid interface
     */
    public function filterByPushHome($pushHome = null, $comparison = null)
    {
        if (is_string($pushHome)) {
            $push_home = in_array(strtolower($pushHome), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(BonPlanPeer::PUSH_HOME, $pushHome, $comparison);
    }

    /**
     * Filter the query on the date_start column
     *
     * Example usage:
     * <code>
     * $query->filterByDateStart('2011-03-14'); // WHERE date_start = '2011-03-14'
     * $query->filterByDateStart('now'); // WHERE date_start = '2011-03-14'
     * $query->filterByDateStart(array('max' => 'yesterday')); // WHERE date_start > '2011-03-13'
     * </code>
     *
     * @param     mixed $dateStart The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BonPlanQuery The current query, for fluid interface
     */
    public function filterByDateStart($dateStart = null, $comparison = null)
    {
        if (is_array($dateStart)) {
            $useMinMax = false;
            if (isset($dateStart['min'])) {
                $this->addUsingAlias(BonPlanPeer::DATE_START, $dateStart['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateStart['max'])) {
                $this->addUsingAlias(BonPlanPeer::DATE_START, $dateStart['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BonPlanPeer::DATE_START, $dateStart, $comparison);
    }

    /**
     * Filter the query on the day_start column
     *
     * @param     mixed $dayStart The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BonPlanQuery The current query, for fluid interface
     * @throws PropelException - if the value is not accepted by the enum.
     */
    public function filterByDayStart($dayStart = null, $comparison = null)
    {
        $valueSet = BonPlanPeer::getValueSet(BonPlanPeer::DAY_START);
        if (is_scalar($dayStart)) {
            if (!in_array($dayStart, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $dayStart));
            }
            $dayStart = array_search($dayStart, $valueSet);
        } elseif (is_array($dayStart)) {
            $convertedValues = array();
            foreach ($dayStart as $value) {
                if (!in_array($value, $valueSet)) {
                    throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $value));
                }
                $convertedValues []= array_search($value, $valueSet);
            }
            $dayStart = $convertedValues;
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BonPlanPeer::DAY_START, $dayStart, $comparison);
    }

    /**
     * Filter the query on the day_range column
     *
     * @param     mixed $dayRange The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BonPlanQuery The current query, for fluid interface
     * @throws PropelException - if the value is not accepted by the enum.
     */
    public function filterByDayRange($dayRange = null, $comparison = null)
    {
        $valueSet = BonPlanPeer::getValueSet(BonPlanPeer::DAY_RANGE);
        if (is_scalar($dayRange)) {
            if (!in_array($dayRange, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $dayRange));
            }
            $dayRange = array_search($dayRange, $valueSet);
        } elseif (is_array($dayRange)) {
            $convertedValues = array();
            foreach ($dayRange as $value) {
                if (!in_array($value, $valueSet)) {
                    throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $value));
                }
                $convertedValues []= array_search($value, $valueSet);
            }
            $dayRange = $convertedValues;
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BonPlanPeer::DAY_RANGE, $dayRange, $comparison);
    }

    /**
     * Filter the query on the nb_adultes column
     *
     * Example usage:
     * <code>
     * $query->filterByNbAdultes(1234); // WHERE nb_adultes = 1234
     * $query->filterByNbAdultes(array(12, 34)); // WHERE nb_adultes IN (12, 34)
     * $query->filterByNbAdultes(array('min' => 12)); // WHERE nb_adultes > 12
     * </code>
     *
     * @param     mixed $nbAdultes The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BonPlanQuery The current query, for fluid interface
     */
    public function filterByNbAdultes($nbAdultes = null, $comparison = null)
    {
        if (is_array($nbAdultes)) {
            $useMinMax = false;
            if (isset($nbAdultes['min'])) {
                $this->addUsingAlias(BonPlanPeer::NB_ADULTES, $nbAdultes['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($nbAdultes['max'])) {
                $this->addUsingAlias(BonPlanPeer::NB_ADULTES, $nbAdultes['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BonPlanPeer::NB_ADULTES, $nbAdultes, $comparison);
    }

    /**
     * Filter the query on the nb_enfants column
     *
     * Example usage:
     * <code>
     * $query->filterByNbEnfants(1234); // WHERE nb_enfants = 1234
     * $query->filterByNbEnfants(array(12, 34)); // WHERE nb_enfants IN (12, 34)
     * $query->filterByNbEnfants(array('min' => 12)); // WHERE nb_enfants > 12
     * </code>
     *
     * @param     mixed $nbEnfants The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BonPlanQuery The current query, for fluid interface
     */
    public function filterByNbEnfants($nbEnfants = null, $comparison = null)
    {
        if (is_array($nbEnfants)) {
            $useMinMax = false;
            if (isset($nbEnfants['min'])) {
                $this->addUsingAlias(BonPlanPeer::NB_ENFANTS, $nbEnfants['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($nbEnfants['max'])) {
                $this->addUsingAlias(BonPlanPeer::NB_ENFANTS, $nbEnfants['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BonPlanPeer::NB_ENFANTS, $nbEnfants, $comparison);
    }

    /**
     * Filter the query on the period_categories column
     *
     * Example usage:
     * <code>
     * $query->filterByPeriodCategories('fooValue');   // WHERE period_categories = 'fooValue'
     * $query->filterByPeriodCategories('%fooValue%'); // WHERE period_categories LIKE '%fooValue%'
     * </code>
     *
     * @param     string $periodCategories The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BonPlanQuery The current query, for fluid interface
     */
    public function filterByPeriodCategories($periodCategories = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($periodCategories)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $periodCategories)) {
                $periodCategories = str_replace('*', '%', $periodCategories);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(BonPlanPeer::PERIOD_CATEGORIES, $periodCategories, $comparison);
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
     * @return BonPlanQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(BonPlanPeer::ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query by a related BonPlanBonPlanCategorie object
     *
     * @param   BonPlanBonPlanCategorie|PropelObjectCollection $bonPlanBonPlanCategorie  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   BonPlanQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByBonPlanBonPlanCategorie($bonPlanBonPlanCategorie, $comparison = null)
    {
        if ($bonPlanBonPlanCategorie instanceof BonPlanBonPlanCategorie) {
            return $this
                ->addUsingAlias(BonPlanPeer::ID, $bonPlanBonPlanCategorie->getBonPlanId(), $comparison);
        } elseif ($bonPlanBonPlanCategorie instanceof PropelObjectCollection) {
            return $this
                ->useBonPlanBonPlanCategorieQuery()
                ->filterByPrimaryKeys($bonPlanBonPlanCategorie->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBonPlanBonPlanCategorie() only accepts arguments of type BonPlanBonPlanCategorie or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BonPlanBonPlanCategorie relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return BonPlanQuery The current query, for fluid interface
     */
    public function joinBonPlanBonPlanCategorie($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BonPlanBonPlanCategorie');

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
            $this->addJoinObject($join, 'BonPlanBonPlanCategorie');
        }

        return $this;
    }

    /**
     * Use the BonPlanBonPlanCategorie relation BonPlanBonPlanCategorie object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\BonPlanBonPlanCategorieQuery A secondary query class using the current class as primary query
     */
    public function useBonPlanBonPlanCategorieQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBonPlanBonPlanCategorie($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BonPlanBonPlanCategorie', '\Cungfoo\Model\BonPlanBonPlanCategorieQuery');
    }

    /**
     * Filter the query by a related BonPlanEtablissement object
     *
     * @param   BonPlanEtablissement|PropelObjectCollection $bonPlanEtablissement  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   BonPlanQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByBonPlanEtablissement($bonPlanEtablissement, $comparison = null)
    {
        if ($bonPlanEtablissement instanceof BonPlanEtablissement) {
            return $this
                ->addUsingAlias(BonPlanPeer::ID, $bonPlanEtablissement->getBonPlanId(), $comparison);
        } elseif ($bonPlanEtablissement instanceof PropelObjectCollection) {
            return $this
                ->useBonPlanEtablissementQuery()
                ->filterByPrimaryKeys($bonPlanEtablissement->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBonPlanEtablissement() only accepts arguments of type BonPlanEtablissement or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BonPlanEtablissement relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return BonPlanQuery The current query, for fluid interface
     */
    public function joinBonPlanEtablissement($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BonPlanEtablissement');

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
            $this->addJoinObject($join, 'BonPlanEtablissement');
        }

        return $this;
    }

    /**
     * Use the BonPlanEtablissement relation BonPlanEtablissement object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\BonPlanEtablissementQuery A secondary query class using the current class as primary query
     */
    public function useBonPlanEtablissementQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBonPlanEtablissement($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BonPlanEtablissement', '\Cungfoo\Model\BonPlanEtablissementQuery');
    }

    /**
     * Filter the query by a related BonPlanRegion object
     *
     * @param   BonPlanRegion|PropelObjectCollection $bonPlanRegion  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   BonPlanQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByBonPlanRegion($bonPlanRegion, $comparison = null)
    {
        if ($bonPlanRegion instanceof BonPlanRegion) {
            return $this
                ->addUsingAlias(BonPlanPeer::ID, $bonPlanRegion->getBonPlanId(), $comparison);
        } elseif ($bonPlanRegion instanceof PropelObjectCollection) {
            return $this
                ->useBonPlanRegionQuery()
                ->filterByPrimaryKeys($bonPlanRegion->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBonPlanRegion() only accepts arguments of type BonPlanRegion or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BonPlanRegion relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return BonPlanQuery The current query, for fluid interface
     */
    public function joinBonPlanRegion($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BonPlanRegion');

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
            $this->addJoinObject($join, 'BonPlanRegion');
        }

        return $this;
    }

    /**
     * Use the BonPlanRegion relation BonPlanRegion object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\BonPlanRegionQuery A secondary query class using the current class as primary query
     */
    public function useBonPlanRegionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBonPlanRegion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BonPlanRegion', '\Cungfoo\Model\BonPlanRegionQuery');
    }

    /**
     * Filter the query by a related BonPlanI18n object
     *
     * @param   BonPlanI18n|PropelObjectCollection $bonPlanI18n  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   BonPlanQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByBonPlanI18n($bonPlanI18n, $comparison = null)
    {
        if ($bonPlanI18n instanceof BonPlanI18n) {
            return $this
                ->addUsingAlias(BonPlanPeer::ID, $bonPlanI18n->getId(), $comparison);
        } elseif ($bonPlanI18n instanceof PropelObjectCollection) {
            return $this
                ->useBonPlanI18nQuery()
                ->filterByPrimaryKeys($bonPlanI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBonPlanI18n() only accepts arguments of type BonPlanI18n or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BonPlanI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return BonPlanQuery The current query, for fluid interface
     */
    public function joinBonPlanI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BonPlanI18n');

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
            $this->addJoinObject($join, 'BonPlanI18n');
        }

        return $this;
    }

    /**
     * Use the BonPlanI18n relation BonPlanI18n object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\BonPlanI18nQuery A secondary query class using the current class as primary query
     */
    public function useBonPlanI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinBonPlanI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BonPlanI18n', '\Cungfoo\Model\BonPlanI18nQuery');
    }

    /**
     * Filter the query by a related BonPlanCategorie object
     * using the bon_plan_bon_plan_categorie table as cross reference
     *
     * @param   BonPlanCategorie $bonPlanCategorie the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   BonPlanQuery The current query, for fluid interface
     */
    public function filterByBonPlanCategorie($bonPlanCategorie, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useBonPlanBonPlanCategorieQuery()
            ->filterByBonPlanCategorie($bonPlanCategorie, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Etablissement object
     * using the bon_plan_etablissement table as cross reference
     *
     * @param   Etablissement $etablissement the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   BonPlanQuery The current query, for fluid interface
     */
    public function filterByEtablissement($etablissement, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useBonPlanEtablissementQuery()
            ->filterByEtablissement($etablissement, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Region object
     * using the bon_plan_region table as cross reference
     *
     * @param   Region $region the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   BonPlanQuery The current query, for fluid interface
     */
    public function filterByRegion($region, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useBonPlanRegionQuery()
            ->filterByRegion($region, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   BonPlan $bonPlan Object to remove from the list of results
     *
     * @return BonPlanQuery The current query, for fluid interface
     */
    public function prune($bonPlan = null)
    {
        if ($bonPlan) {
            $this->addUsingAlias(BonPlanPeer::ID, $bonPlan->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
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
     * @return    BonPlanQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'BonPlanI18n';

        return $this
            ->joinBonPlanI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    BonPlanQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'fr', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('BonPlanI18n');
        $this->with['BonPlanI18n']->setIsWithOneToMany(false);

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
     * @return    BonPlanI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BonPlanI18n', 'Cungfoo\Model\BonPlanI18nQuery');
    }

}
