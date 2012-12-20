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
use Cungfoo\Model\BonPlanCategorie;
use Cungfoo\Model\BonPlanI18n;
use Cungfoo\Model\BonPlanPeer;
use Cungfoo\Model\BonPlanQuery;

/**
 * Base class that represents a query for the 'bon_plan' table.
 *
 *
 *
 * @method BonPlanQuery orderById($order = Criteria::ASC) Order by the id column
 * @method BonPlanQuery orderByBonPlanCategorieId($order = Criteria::ASC) Order by the bon_plan_categorie_id column
 * @method BonPlanQuery orderByDateDebut($order = Criteria::ASC) Order by the date_debut column
 * @method BonPlanQuery orderByDateFin($order = Criteria::ASC) Order by the date_fin column
 * @method BonPlanQuery orderByPrix($order = Criteria::ASC) Order by the prix column
 * @method BonPlanQuery orderByPrixBarre($order = Criteria::ASC) Order by the prix_barre column
 * @method BonPlanQuery orderByImageMenu($order = Criteria::ASC) Order by the image_menu column
 * @method BonPlanQuery orderByActive($order = Criteria::ASC) Order by the active column
 *
 * @method BonPlanQuery groupById() Group by the id column
 * @method BonPlanQuery groupByBonPlanCategorieId() Group by the bon_plan_categorie_id column
 * @method BonPlanQuery groupByDateDebut() Group by the date_debut column
 * @method BonPlanQuery groupByDateFin() Group by the date_fin column
 * @method BonPlanQuery groupByPrix() Group by the prix column
 * @method BonPlanQuery groupByPrixBarre() Group by the prix_barre column
 * @method BonPlanQuery groupByImageMenu() Group by the image_menu column
 * @method BonPlanQuery groupByActive() Group by the active column
 *
 * @method BonPlanQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method BonPlanQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method BonPlanQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method BonPlanQuery leftJoinBonPlanCategorie($relationAlias = null) Adds a LEFT JOIN clause to the query using the BonPlanCategorie relation
 * @method BonPlanQuery rightJoinBonPlanCategorie($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BonPlanCategorie relation
 * @method BonPlanQuery innerJoinBonPlanCategorie($relationAlias = null) Adds a INNER JOIN clause to the query using the BonPlanCategorie relation
 *
 * @method BonPlanQuery leftJoinBonPlanI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the BonPlanI18n relation
 * @method BonPlanQuery rightJoinBonPlanI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BonPlanI18n relation
 * @method BonPlanQuery innerJoinBonPlanI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the BonPlanI18n relation
 *
 * @method BonPlan findOne(PropelPDO $con = null) Return the first BonPlan matching the query
 * @method BonPlan findOneOrCreate(PropelPDO $con = null) Return the first BonPlan matching the query, or a new BonPlan object populated from the query conditions when no match is found
 *
 * @method BonPlan findOneByBonPlanCategorieId(int $bon_plan_categorie_id) Return the first BonPlan filtered by the bon_plan_categorie_id column
 * @method BonPlan findOneByDateDebut(string $date_debut) Return the first BonPlan filtered by the date_debut column
 * @method BonPlan findOneByDateFin(string $date_fin) Return the first BonPlan filtered by the date_fin column
 * @method BonPlan findOneByPrix(int $prix) Return the first BonPlan filtered by the prix column
 * @method BonPlan findOneByPrixBarre(int $prix_barre) Return the first BonPlan filtered by the prix_barre column
 * @method BonPlan findOneByImageMenu(string $image_menu) Return the first BonPlan filtered by the image_menu column
 * @method BonPlan findOneByActive(boolean $active) Return the first BonPlan filtered by the active column
 *
 * @method array findById(int $id) Return BonPlan objects filtered by the id column
 * @method array findByBonPlanCategorieId(int $bon_plan_categorie_id) Return BonPlan objects filtered by the bon_plan_categorie_id column
 * @method array findByDateDebut(string $date_debut) Return BonPlan objects filtered by the date_debut column
 * @method array findByDateFin(string $date_fin) Return BonPlan objects filtered by the date_fin column
 * @method array findByPrix(int $prix) Return BonPlan objects filtered by the prix column
 * @method array findByPrixBarre(int $prix_barre) Return BonPlan objects filtered by the prix_barre column
 * @method array findByImageMenu(string $image_menu) Return BonPlan objects filtered by the image_menu column
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
        $sql = 'SELECT `id`, `bon_plan_categorie_id`, `date_debut`, `date_fin`, `prix`, `prix_barre`, `image_menu`, `active` FROM `bon_plan` WHERE `id` = :p0';
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
     * Filter the query on the bon_plan_categorie_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBonPlanCategorieId(1234); // WHERE bon_plan_categorie_id = 1234
     * $query->filterByBonPlanCategorieId(array(12, 34)); // WHERE bon_plan_categorie_id IN (12, 34)
     * $query->filterByBonPlanCategorieId(array('min' => 12)); // WHERE bon_plan_categorie_id > 12
     * </code>
     *
     * @see       filterByBonPlanCategorie()
     *
     * @param     mixed $bonPlanCategorieId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BonPlanQuery The current query, for fluid interface
     */
    public function filterByBonPlanCategorieId($bonPlanCategorieId = null, $comparison = null)
    {
        if (is_array($bonPlanCategorieId)) {
            $useMinMax = false;
            if (isset($bonPlanCategorieId['min'])) {
                $this->addUsingAlias(BonPlanPeer::BON_PLAN_CATEGORIE_ID, $bonPlanCategorieId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bonPlanCategorieId['max'])) {
                $this->addUsingAlias(BonPlanPeer::BON_PLAN_CATEGORIE_ID, $bonPlanCategorieId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BonPlanPeer::BON_PLAN_CATEGORIE_ID, $bonPlanCategorieId, $comparison);
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
     * Filter the query by a related BonPlanCategorie object
     *
     * @param   BonPlanCategorie|PropelObjectCollection $bonPlanCategorie The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   BonPlanQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByBonPlanCategorie($bonPlanCategorie, $comparison = null)
    {
        if ($bonPlanCategorie instanceof BonPlanCategorie) {
            return $this
                ->addUsingAlias(BonPlanPeer::BON_PLAN_CATEGORIE_ID, $bonPlanCategorie->getId(), $comparison);
        } elseif ($bonPlanCategorie instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BonPlanPeer::BON_PLAN_CATEGORIE_ID, $bonPlanCategorie->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByBonPlanCategorie() only accepts arguments of type BonPlanCategorie or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BonPlanCategorie relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return BonPlanQuery The current query, for fluid interface
     */
    public function joinBonPlanCategorie($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BonPlanCategorie');

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
            $this->addJoinObject($join, 'BonPlanCategorie');
        }

        return $this;
    }

    /**
     * Use the BonPlanCategorie relation BonPlanCategorie object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\BonPlanCategorieQuery A secondary query class using the current class as primary query
     */
    public function useBonPlanCategorieQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBonPlanCategorie($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BonPlanCategorie', '\Cungfoo\Model\BonPlanCategorieQuery');
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
