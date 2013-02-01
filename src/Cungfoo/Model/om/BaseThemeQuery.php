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
use Cungfoo\Model\Personnage;
use Cungfoo\Model\ServiceComplementaire;
use Cungfoo\Model\Theme;
use Cungfoo\Model\ThemeActivite;
use Cungfoo\Model\ThemeBaignade;
use Cungfoo\Model\ThemeI18n;
use Cungfoo\Model\ThemePeer;
use Cungfoo\Model\ThemePersonnage;
use Cungfoo\Model\ThemeQuery;
use Cungfoo\Model\ThemeServiceComplementaire;

/**
 * Base class that represents a query for the 'theme' table.
 *
 *
 *
 * @method ThemeQuery orderById($order = Criteria::ASC) Order by the id column
 * @method ThemeQuery orderByImagePath($order = Criteria::ASC) Order by the image_path column
 * @method ThemeQuery orderByActive($order = Criteria::ASC) Order by the active column
 *
 * @method ThemeQuery groupById() Group by the id column
 * @method ThemeQuery groupByImagePath() Group by the image_path column
 * @method ThemeQuery groupByActive() Group by the active column
 *
 * @method ThemeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method ThemeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method ThemeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method ThemeQuery leftJoinThemeActivite($relationAlias = null) Adds a LEFT JOIN clause to the query using the ThemeActivite relation
 * @method ThemeQuery rightJoinThemeActivite($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ThemeActivite relation
 * @method ThemeQuery innerJoinThemeActivite($relationAlias = null) Adds a INNER JOIN clause to the query using the ThemeActivite relation
 *
 * @method ThemeQuery leftJoinThemeBaignade($relationAlias = null) Adds a LEFT JOIN clause to the query using the ThemeBaignade relation
 * @method ThemeQuery rightJoinThemeBaignade($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ThemeBaignade relation
 * @method ThemeQuery innerJoinThemeBaignade($relationAlias = null) Adds a INNER JOIN clause to the query using the ThemeBaignade relation
 *
 * @method ThemeQuery leftJoinThemeServiceComplementaire($relationAlias = null) Adds a LEFT JOIN clause to the query using the ThemeServiceComplementaire relation
 * @method ThemeQuery rightJoinThemeServiceComplementaire($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ThemeServiceComplementaire relation
 * @method ThemeQuery innerJoinThemeServiceComplementaire($relationAlias = null) Adds a INNER JOIN clause to the query using the ThemeServiceComplementaire relation
 *
 * @method ThemeQuery leftJoinThemePersonnage($relationAlias = null) Adds a LEFT JOIN clause to the query using the ThemePersonnage relation
 * @method ThemeQuery rightJoinThemePersonnage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ThemePersonnage relation
 * @method ThemeQuery innerJoinThemePersonnage($relationAlias = null) Adds a INNER JOIN clause to the query using the ThemePersonnage relation
 *
 * @method ThemeQuery leftJoinThemeI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the ThemeI18n relation
 * @method ThemeQuery rightJoinThemeI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ThemeI18n relation
 * @method ThemeQuery innerJoinThemeI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the ThemeI18n relation
 *
 * @method Theme findOne(PropelPDO $con = null) Return the first Theme matching the query
 * @method Theme findOneOrCreate(PropelPDO $con = null) Return the first Theme matching the query, or a new Theme object populated from the query conditions when no match is found
 *
 * @method Theme findOneByImagePath(string $image_path) Return the first Theme filtered by the image_path column
 * @method Theme findOneByActive(boolean $active) Return the first Theme filtered by the active column
 *
 * @method array findById(int $id) Return Theme objects filtered by the id column
 * @method array findByImagePath(string $image_path) Return Theme objects filtered by the image_path column
 * @method array findByActive(boolean $active) Return Theme objects filtered by the active column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseThemeQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseThemeQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\Theme', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ThemeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     ThemeQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return ThemeQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof ThemeQuery) {
            return $criteria;
        }
        $query = new ThemeQuery();
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
     * @return   Theme|Theme[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ThemePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(ThemePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   Theme A model object, or null if the key is not found
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
     * @return   Theme A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `image_path`, `active` FROM `theme` WHERE `id` = :p0';
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
            $obj = new Theme();
            $obj->hydrate($row);
            ThemePeer::addInstanceToPool($obj, (string) $key);
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
     * @return Theme|Theme[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Theme[]|mixed the list of results, formatted by the current formatter
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
     * @return ThemeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ThemePeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ThemeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ThemePeer::ID, $keys, Criteria::IN);
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
     * @return ThemeQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(ThemePeer::ID, $id, $comparison);
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
     * @return ThemeQuery The current query, for fluid interface
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

        return $this->addUsingAlias(ThemePeer::IMAGE_PATH, $imagePath, $comparison);
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
     * @return ThemeQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ThemePeer::ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query by a related ThemeActivite object
     *
     * @param   ThemeActivite|PropelObjectCollection $themeActivite  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ThemeQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByThemeActivite($themeActivite, $comparison = null)
    {
        if ($themeActivite instanceof ThemeActivite) {
            return $this
                ->addUsingAlias(ThemePeer::ID, $themeActivite->getThemeId(), $comparison);
        } elseif ($themeActivite instanceof PropelObjectCollection) {
            return $this
                ->useThemeActiviteQuery()
                ->filterByPrimaryKeys($themeActivite->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByThemeActivite() only accepts arguments of type ThemeActivite or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ThemeActivite relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ThemeQuery The current query, for fluid interface
     */
    public function joinThemeActivite($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ThemeActivite');

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
            $this->addJoinObject($join, 'ThemeActivite');
        }

        return $this;
    }

    /**
     * Use the ThemeActivite relation ThemeActivite object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\ThemeActiviteQuery A secondary query class using the current class as primary query
     */
    public function useThemeActiviteQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinThemeActivite($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ThemeActivite', '\Cungfoo\Model\ThemeActiviteQuery');
    }

    /**
     * Filter the query by a related ThemeBaignade object
     *
     * @param   ThemeBaignade|PropelObjectCollection $themeBaignade  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ThemeQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByThemeBaignade($themeBaignade, $comparison = null)
    {
        if ($themeBaignade instanceof ThemeBaignade) {
            return $this
                ->addUsingAlias(ThemePeer::ID, $themeBaignade->getThemeId(), $comparison);
        } elseif ($themeBaignade instanceof PropelObjectCollection) {
            return $this
                ->useThemeBaignadeQuery()
                ->filterByPrimaryKeys($themeBaignade->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByThemeBaignade() only accepts arguments of type ThemeBaignade or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ThemeBaignade relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ThemeQuery The current query, for fluid interface
     */
    public function joinThemeBaignade($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ThemeBaignade');

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
            $this->addJoinObject($join, 'ThemeBaignade');
        }

        return $this;
    }

    /**
     * Use the ThemeBaignade relation ThemeBaignade object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\ThemeBaignadeQuery A secondary query class using the current class as primary query
     */
    public function useThemeBaignadeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinThemeBaignade($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ThemeBaignade', '\Cungfoo\Model\ThemeBaignadeQuery');
    }

    /**
     * Filter the query by a related ThemeServiceComplementaire object
     *
     * @param   ThemeServiceComplementaire|PropelObjectCollection $themeServiceComplementaire  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ThemeQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByThemeServiceComplementaire($themeServiceComplementaire, $comparison = null)
    {
        if ($themeServiceComplementaire instanceof ThemeServiceComplementaire) {
            return $this
                ->addUsingAlias(ThemePeer::ID, $themeServiceComplementaire->getThemeId(), $comparison);
        } elseif ($themeServiceComplementaire instanceof PropelObjectCollection) {
            return $this
                ->useThemeServiceComplementaireQuery()
                ->filterByPrimaryKeys($themeServiceComplementaire->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByThemeServiceComplementaire() only accepts arguments of type ThemeServiceComplementaire or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ThemeServiceComplementaire relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ThemeQuery The current query, for fluid interface
     */
    public function joinThemeServiceComplementaire($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ThemeServiceComplementaire');

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
            $this->addJoinObject($join, 'ThemeServiceComplementaire');
        }

        return $this;
    }

    /**
     * Use the ThemeServiceComplementaire relation ThemeServiceComplementaire object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\ThemeServiceComplementaireQuery A secondary query class using the current class as primary query
     */
    public function useThemeServiceComplementaireQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinThemeServiceComplementaire($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ThemeServiceComplementaire', '\Cungfoo\Model\ThemeServiceComplementaireQuery');
    }

    /**
     * Filter the query by a related ThemePersonnage object
     *
     * @param   ThemePersonnage|PropelObjectCollection $themePersonnage  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ThemeQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByThemePersonnage($themePersonnage, $comparison = null)
    {
        if ($themePersonnage instanceof ThemePersonnage) {
            return $this
                ->addUsingAlias(ThemePeer::ID, $themePersonnage->getThemeId(), $comparison);
        } elseif ($themePersonnage instanceof PropelObjectCollection) {
            return $this
                ->useThemePersonnageQuery()
                ->filterByPrimaryKeys($themePersonnage->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByThemePersonnage() only accepts arguments of type ThemePersonnage or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ThemePersonnage relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ThemeQuery The current query, for fluid interface
     */
    public function joinThemePersonnage($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ThemePersonnage');

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
            $this->addJoinObject($join, 'ThemePersonnage');
        }

        return $this;
    }

    /**
     * Use the ThemePersonnage relation ThemePersonnage object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\ThemePersonnageQuery A secondary query class using the current class as primary query
     */
    public function useThemePersonnageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinThemePersonnage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ThemePersonnage', '\Cungfoo\Model\ThemePersonnageQuery');
    }

    /**
     * Filter the query by a related ThemeI18n object
     *
     * @param   ThemeI18n|PropelObjectCollection $themeI18n  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ThemeQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByThemeI18n($themeI18n, $comparison = null)
    {
        if ($themeI18n instanceof ThemeI18n) {
            return $this
                ->addUsingAlias(ThemePeer::ID, $themeI18n->getId(), $comparison);
        } elseif ($themeI18n instanceof PropelObjectCollection) {
            return $this
                ->useThemeI18nQuery()
                ->filterByPrimaryKeys($themeI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByThemeI18n() only accepts arguments of type ThemeI18n or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ThemeI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ThemeQuery The current query, for fluid interface
     */
    public function joinThemeI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ThemeI18n');

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
            $this->addJoinObject($join, 'ThemeI18n');
        }

        return $this;
    }

    /**
     * Use the ThemeI18n relation ThemeI18n object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\ThemeI18nQuery A secondary query class using the current class as primary query
     */
    public function useThemeI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinThemeI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ThemeI18n', '\Cungfoo\Model\ThemeI18nQuery');
    }

    /**
     * Filter the query by a related Activite object
     * using the theme_activite table as cross reference
     *
     * @param   Activite $activite the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ThemeQuery The current query, for fluid interface
     */
    public function filterByActivite($activite, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useThemeActiviteQuery()
            ->filterByActivite($activite, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Baignade object
     * using the theme_baignade table as cross reference
     *
     * @param   Baignade $baignade the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ThemeQuery The current query, for fluid interface
     */
    public function filterByBaignade($baignade, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useThemeBaignadeQuery()
            ->filterByBaignade($baignade, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related ServiceComplementaire object
     * using the theme_service_complementaire table as cross reference
     *
     * @param   ServiceComplementaire $serviceComplementaire the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ThemeQuery The current query, for fluid interface
     */
    public function filterByServiceComplementaire($serviceComplementaire, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useThemeServiceComplementaireQuery()
            ->filterByServiceComplementaire($serviceComplementaire, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Personnage object
     * using the theme_personnage table as cross reference
     *
     * @param   Personnage $personnage the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   ThemeQuery The current query, for fluid interface
     */
    public function filterByPersonnage($personnage, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useThemePersonnageQuery()
            ->filterByPersonnage($personnage, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   Theme $theme Object to remove from the list of results
     *
     * @return ThemeQuery The current query, for fluid interface
     */
    public function prune($theme = null)
    {
        if ($theme) {
            $this->addUsingAlias(ThemePeer::ID, $theme->getId(), Criteria::NOT_EQUAL);
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
        $this
            ->filterByActive(true)
            ->useI18nQuery('fr', 'i18n_locale')
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
     * @return    ThemeQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'ThemeI18n';

        return $this
            ->joinThemeI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    ThemeQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'fr', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('ThemeI18n');
        $this->with['ThemeI18n']->setIsWithOneToMany(false);

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
     * @return    ThemeI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ThemeI18n', 'Cungfoo\Model\ThemeI18nQuery');
    }

    // crudable behavior

    public function filterByTerm($term)
    {
        $term = '%' . $term . '%';

        return $this
            ->_or()
            ->useI18nQuery()
            ->filterByName($term, \Criteria::LIKE)
            ->endUse()
        ;
    }
}
