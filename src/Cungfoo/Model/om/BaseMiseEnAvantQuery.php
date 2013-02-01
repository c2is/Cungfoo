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
use Cungfoo\Model\MiseEnAvant;
use Cungfoo\Model\MiseEnAvantI18n;
use Cungfoo\Model\MiseEnAvantPeer;
use Cungfoo\Model\MiseEnAvantQuery;

/**
 * Base class that represents a query for the 'mise_en_avant' table.
 *
 *
 *
 * @method MiseEnAvantQuery orderById($order = Criteria::ASC) Order by the id column
 * @method MiseEnAvantQuery orderByImageFondPath($order = Criteria::ASC) Order by the image_fond_path column
 * @method MiseEnAvantQuery orderByPrix($order = Criteria::ASC) Order by the prix column
 * @method MiseEnAvantQuery orderByIllustrationPath($order = Criteria::ASC) Order by the illustration_path column
 * @method MiseEnAvantQuery orderByDateFinValidite($order = Criteria::ASC) Order by the date_fin_validite column
 * @method MiseEnAvantQuery orderBySortableRank($order = Criteria::ASC) Order by the sortable_rank column
 * @method MiseEnAvantQuery orderByActive($order = Criteria::ASC) Order by the active column
 *
 * @method MiseEnAvantQuery groupById() Group by the id column
 * @method MiseEnAvantQuery groupByImageFondPath() Group by the image_fond_path column
 * @method MiseEnAvantQuery groupByPrix() Group by the prix column
 * @method MiseEnAvantQuery groupByIllustrationPath() Group by the illustration_path column
 * @method MiseEnAvantQuery groupByDateFinValidite() Group by the date_fin_validite column
 * @method MiseEnAvantQuery groupBySortableRank() Group by the sortable_rank column
 * @method MiseEnAvantQuery groupByActive() Group by the active column
 *
 * @method MiseEnAvantQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method MiseEnAvantQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method MiseEnAvantQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method MiseEnAvantQuery leftJoinMiseEnAvantI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the MiseEnAvantI18n relation
 * @method MiseEnAvantQuery rightJoinMiseEnAvantI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MiseEnAvantI18n relation
 * @method MiseEnAvantQuery innerJoinMiseEnAvantI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the MiseEnAvantI18n relation
 *
 * @method MiseEnAvant findOne(PropelPDO $con = null) Return the first MiseEnAvant matching the query
 * @method MiseEnAvant findOneOrCreate(PropelPDO $con = null) Return the first MiseEnAvant matching the query, or a new MiseEnAvant object populated from the query conditions when no match is found
 *
 * @method MiseEnAvant findOneByImageFondPath(string $image_fond_path) Return the first MiseEnAvant filtered by the image_fond_path column
 * @method MiseEnAvant findOneByPrix(string $prix) Return the first MiseEnAvant filtered by the prix column
 * @method MiseEnAvant findOneByIllustrationPath(string $illustration_path) Return the first MiseEnAvant filtered by the illustration_path column
 * @method MiseEnAvant findOneByDateFinValidite(string $date_fin_validite) Return the first MiseEnAvant filtered by the date_fin_validite column
 * @method MiseEnAvant findOneBySortableRank(int $sortable_rank) Return the first MiseEnAvant filtered by the sortable_rank column
 * @method MiseEnAvant findOneByActive(boolean $active) Return the first MiseEnAvant filtered by the active column
 *
 * @method array findById(int $id) Return MiseEnAvant objects filtered by the id column
 * @method array findByImageFondPath(string $image_fond_path) Return MiseEnAvant objects filtered by the image_fond_path column
 * @method array findByPrix(string $prix) Return MiseEnAvant objects filtered by the prix column
 * @method array findByIllustrationPath(string $illustration_path) Return MiseEnAvant objects filtered by the illustration_path column
 * @method array findByDateFinValidite(string $date_fin_validite) Return MiseEnAvant objects filtered by the date_fin_validite column
 * @method array findBySortableRank(int $sortable_rank) Return MiseEnAvant objects filtered by the sortable_rank column
 * @method array findByActive(boolean $active) Return MiseEnAvant objects filtered by the active column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseMiseEnAvantQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseMiseEnAvantQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\MiseEnAvant', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new MiseEnAvantQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     MiseEnAvantQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return MiseEnAvantQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof MiseEnAvantQuery) {
            return $criteria;
        }
        $query = new MiseEnAvantQuery();
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
     * @return   MiseEnAvant|MiseEnAvant[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = MiseEnAvantPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(MiseEnAvantPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   MiseEnAvant A model object, or null if the key is not found
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
     * @return   MiseEnAvant A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `image_fond_path`, `prix`, `illustration_path`, `date_fin_validite`, `sortable_rank`, `active` FROM `mise_en_avant` WHERE `id` = :p0';
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
            $obj = new MiseEnAvant();
            $obj->hydrate($row);
            MiseEnAvantPeer::addInstanceToPool($obj, (string) $key);
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
     * @return MiseEnAvant|MiseEnAvant[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|MiseEnAvant[]|mixed the list of results, formatted by the current formatter
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
     * @return MiseEnAvantQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(MiseEnAvantPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return MiseEnAvantQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(MiseEnAvantPeer::ID, $keys, Criteria::IN);
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
     * @return MiseEnAvantQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(MiseEnAvantPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the image_fond_path column
     *
     * Example usage:
     * <code>
     * $query->filterByImageFondPath('fooValue');   // WHERE image_fond_path = 'fooValue'
     * $query->filterByImageFondPath('%fooValue%'); // WHERE image_fond_path LIKE '%fooValue%'
     * </code>
     *
     * @param     string $imageFondPath The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return MiseEnAvantQuery The current query, for fluid interface
     */
    public function filterByImageFondPath($imageFondPath = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($imageFondPath)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $imageFondPath)) {
                $imageFondPath = str_replace('*', '%', $imageFondPath);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MiseEnAvantPeer::IMAGE_FOND_PATH, $imageFondPath, $comparison);
    }

    /**
     * Filter the query on the prix column
     *
     * Example usage:
     * <code>
     * $query->filterByPrix('fooValue');   // WHERE prix = 'fooValue'
     * $query->filterByPrix('%fooValue%'); // WHERE prix LIKE '%fooValue%'
     * </code>
     *
     * @param     string $prix The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return MiseEnAvantQuery The current query, for fluid interface
     */
    public function filterByPrix($prix = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($prix)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $prix)) {
                $prix = str_replace('*', '%', $prix);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MiseEnAvantPeer::PRIX, $prix, $comparison);
    }

    /**
     * Filter the query on the illustration_path column
     *
     * Example usage:
     * <code>
     * $query->filterByIllustrationPath('fooValue');   // WHERE illustration_path = 'fooValue'
     * $query->filterByIllustrationPath('%fooValue%'); // WHERE illustration_path LIKE '%fooValue%'
     * </code>
     *
     * @param     string $illustrationPath The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return MiseEnAvantQuery The current query, for fluid interface
     */
    public function filterByIllustrationPath($illustrationPath = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($illustrationPath)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $illustrationPath)) {
                $illustrationPath = str_replace('*', '%', $illustrationPath);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MiseEnAvantPeer::ILLUSTRATION_PATH, $illustrationPath, $comparison);
    }

    /**
     * Filter the query on the date_fin_validite column
     *
     * Example usage:
     * <code>
     * $query->filterByDateFinValidite('2011-03-14'); // WHERE date_fin_validite = '2011-03-14'
     * $query->filterByDateFinValidite('now'); // WHERE date_fin_validite = '2011-03-14'
     * $query->filterByDateFinValidite(array('max' => 'yesterday')); // WHERE date_fin_validite > '2011-03-13'
     * </code>
     *
     * @param     mixed $dateFinValidite The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return MiseEnAvantQuery The current query, for fluid interface
     */
    public function filterByDateFinValidite($dateFinValidite = null, $comparison = null)
    {
        if (is_array($dateFinValidite)) {
            $useMinMax = false;
            if (isset($dateFinValidite['min'])) {
                $this->addUsingAlias(MiseEnAvantPeer::DATE_FIN_VALIDITE, $dateFinValidite['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateFinValidite['max'])) {
                $this->addUsingAlias(MiseEnAvantPeer::DATE_FIN_VALIDITE, $dateFinValidite['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MiseEnAvantPeer::DATE_FIN_VALIDITE, $dateFinValidite, $comparison);
    }

    /**
     * Filter the query on the sortable_rank column
     *
     * Example usage:
     * <code>
     * $query->filterBySortableRank(1234); // WHERE sortable_rank = 1234
     * $query->filterBySortableRank(array(12, 34)); // WHERE sortable_rank IN (12, 34)
     * $query->filterBySortableRank(array('min' => 12)); // WHERE sortable_rank > 12
     * </code>
     *
     * @param     mixed $sortableRank The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return MiseEnAvantQuery The current query, for fluid interface
     */
    public function filterBySortableRank($sortableRank = null, $comparison = null)
    {
        if (is_array($sortableRank)) {
            $useMinMax = false;
            if (isset($sortableRank['min'])) {
                $this->addUsingAlias(MiseEnAvantPeer::SORTABLE_RANK, $sortableRank['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sortableRank['max'])) {
                $this->addUsingAlias(MiseEnAvantPeer::SORTABLE_RANK, $sortableRank['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MiseEnAvantPeer::SORTABLE_RANK, $sortableRank, $comparison);
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
     * @return MiseEnAvantQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(MiseEnAvantPeer::ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query by a related MiseEnAvantI18n object
     *
     * @param   MiseEnAvantI18n|PropelObjectCollection $miseEnAvantI18n  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   MiseEnAvantQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByMiseEnAvantI18n($miseEnAvantI18n, $comparison = null)
    {
        if ($miseEnAvantI18n instanceof MiseEnAvantI18n) {
            return $this
                ->addUsingAlias(MiseEnAvantPeer::ID, $miseEnAvantI18n->getId(), $comparison);
        } elseif ($miseEnAvantI18n instanceof PropelObjectCollection) {
            return $this
                ->useMiseEnAvantI18nQuery()
                ->filterByPrimaryKeys($miseEnAvantI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByMiseEnAvantI18n() only accepts arguments of type MiseEnAvantI18n or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the MiseEnAvantI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return MiseEnAvantQuery The current query, for fluid interface
     */
    public function joinMiseEnAvantI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('MiseEnAvantI18n');

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
            $this->addJoinObject($join, 'MiseEnAvantI18n');
        }

        return $this;
    }

    /**
     * Use the MiseEnAvantI18n relation MiseEnAvantI18n object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\MiseEnAvantI18nQuery A secondary query class using the current class as primary query
     */
    public function useMiseEnAvantI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinMiseEnAvantI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MiseEnAvantI18n', '\Cungfoo\Model\MiseEnAvantI18nQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   MiseEnAvant $miseEnAvant Object to remove from the list of results
     *
     * @return MiseEnAvantQuery The current query, for fluid interface
     */
    public function prune($miseEnAvant = null)
    {
        if ($miseEnAvant) {
            $this->addUsingAlias(MiseEnAvantPeer::ID, $miseEnAvant->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // sortable behavior

    /**
     * Filter the query based on a rank in the list
     *
     * @param     integer   $rank rank
     *
     * @return    MiseEnAvantQuery The current query, for fluid interface
     */
    public function filterByRank($rank)
    {
        return $this
            ->addUsingAlias(MiseEnAvantPeer::RANK_COL, $rank, Criteria::EQUAL);
    }

    /**
     * Order the query based on the rank in the list.
     * Using the default $order, returns the item with the lowest rank first
     *
     * @param     string $order either Criteria::ASC (default) or Criteria::DESC
     *
     * @return    MiseEnAvantQuery The current query, for fluid interface
     */
    public function orderByRank($order = Criteria::ASC)
    {
        $order = strtoupper($order);
        switch ($order) {
            case Criteria::ASC:
                return $this->addAscendingOrderByColumn($this->getAliasedColName(MiseEnAvantPeer::RANK_COL));
                break;
            case Criteria::DESC:
                return $this->addDescendingOrderByColumn($this->getAliasedColName(MiseEnAvantPeer::RANK_COL));
                break;
            default:
                throw new PropelException('MiseEnAvantQuery::orderBy() only accepts "asc" or "desc" as argument');
        }
    }

    /**
     * Get an item from the list based on its rank
     *
     * @param     integer   $rank rank
     * @param     PropelPDO $con optional connection
     *
     * @return    MiseEnAvant
     */
    public function findOneByRank($rank, PropelPDO $con = null)
    {
        return $this
            ->filterByRank($rank)
            ->findOne($con);
    }

    /**
     * Returns the list of objects
     *
     * @param      PropelPDO $con	Connection to use.
     *
     * @return     mixed the list of results, formatted by the current formatter
     */
    public function findList($con = null)
    {
        return $this
            ->orderByRank()
            ->find($con);
    }

    /**
     * Get the highest rank
     *
     * @param     PropelPDO optional connection
     *
     * @return    integer highest position
     */
    public function getMaxRank(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(MiseEnAvantPeer::DATABASE_NAME);
        }
        // shift the objects with a position lower than the one of object
        $this->addSelectColumn('MAX(' . MiseEnAvantPeer::RANK_COL . ')');
        $stmt = $this->doSelect($con);

        return $stmt->fetchColumn();
    }

    /**
     * Reorder a set of sortable objects based on a list of id/position
     * Beware that there is no check made on the positions passed
     * So incoherent positions will result in an incoherent list
     *
     * @param     array     $order id => rank pairs
     * @param     PropelPDO $con   optional connection
     *
     * @return    boolean true if the reordering took place, false if a database problem prevented it
     */
    public function reorder(array $order, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(MiseEnAvantPeer::DATABASE_NAME);
        }

        $con->beginTransaction();
        try {
            $ids = array_keys($order);
            $objects = $this->findPks($ids, $con);
            foreach ($objects as $object) {
                $pk = $object->getPrimaryKey();
                if ($object->getSortableRank() != $order[$pk]) {
                    $object->setSortableRank($order[$pk]);
                    $object->save($con);
                }
            }
            $con->commit();

            return true;
        } catch (PropelException $e) {
            $con->rollback();
            throw $e;
        }
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
     * @return    MiseEnAvantQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'MiseEnAvantI18n';

        return $this
            ->joinMiseEnAvantI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    MiseEnAvantQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'fr', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('MiseEnAvantI18n');
        $this->with['MiseEnAvantI18n']->setIsWithOneToMany(false);

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
     * @return    MiseEnAvantI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MiseEnAvantI18n', 'Cungfoo\Model\MiseEnAvantI18nQuery');
    }

}
