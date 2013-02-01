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
use Cungfoo\Model\IdeeWeekend;
use Cungfoo\Model\IdeeWeekendI18n;
use Cungfoo\Model\IdeeWeekendPeer;
use Cungfoo\Model\IdeeWeekendQuery;

/**
 * Base class that represents a query for the 'idee_weekend' table.
 *
 *
 *
 * @method IdeeWeekendQuery orderById($order = Criteria::ASC) Order by the id column
 * @method IdeeWeekendQuery orderByHighlight($order = Criteria::ASC) Order by the highlight column
 * @method IdeeWeekendQuery orderByPrix($order = Criteria::ASC) Order by the prix column
 * @method IdeeWeekendQuery orderByHome($order = Criteria::ASC) Order by the home column
 * @method IdeeWeekendQuery orderByImagePath($order = Criteria::ASC) Order by the image_path column
 * @method IdeeWeekendQuery orderByActive($order = Criteria::ASC) Order by the active column
 *
 * @method IdeeWeekendQuery groupById() Group by the id column
 * @method IdeeWeekendQuery groupByHighlight() Group by the highlight column
 * @method IdeeWeekendQuery groupByPrix() Group by the prix column
 * @method IdeeWeekendQuery groupByHome() Group by the home column
 * @method IdeeWeekendQuery groupByImagePath() Group by the image_path column
 * @method IdeeWeekendQuery groupByActive() Group by the active column
 *
 * @method IdeeWeekendQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method IdeeWeekendQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method IdeeWeekendQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method IdeeWeekendQuery leftJoinIdeeWeekendI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the IdeeWeekendI18n relation
 * @method IdeeWeekendQuery rightJoinIdeeWeekendI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the IdeeWeekendI18n relation
 * @method IdeeWeekendQuery innerJoinIdeeWeekendI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the IdeeWeekendI18n relation
 *
 * @method IdeeWeekend findOne(PropelPDO $con = null) Return the first IdeeWeekend matching the query
 * @method IdeeWeekend findOneOrCreate(PropelPDO $con = null) Return the first IdeeWeekend matching the query, or a new IdeeWeekend object populated from the query conditions when no match is found
 *
 * @method IdeeWeekend findOneByHighlight(boolean $highlight) Return the first IdeeWeekend filtered by the highlight column
 * @method IdeeWeekend findOneByPrix(string $prix) Return the first IdeeWeekend filtered by the prix column
 * @method IdeeWeekend findOneByHome(boolean $home) Return the first IdeeWeekend filtered by the home column
 * @method IdeeWeekend findOneByImagePath(string $image_path) Return the first IdeeWeekend filtered by the image_path column
 * @method IdeeWeekend findOneByActive(boolean $active) Return the first IdeeWeekend filtered by the active column
 *
 * @method array findById(int $id) Return IdeeWeekend objects filtered by the id column
 * @method array findByHighlight(boolean $highlight) Return IdeeWeekend objects filtered by the highlight column
 * @method array findByPrix(string $prix) Return IdeeWeekend objects filtered by the prix column
 * @method array findByHome(boolean $home) Return IdeeWeekend objects filtered by the home column
 * @method array findByImagePath(string $image_path) Return IdeeWeekend objects filtered by the image_path column
 * @method array findByActive(boolean $active) Return IdeeWeekend objects filtered by the active column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseIdeeWeekendQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseIdeeWeekendQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\IdeeWeekend', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new IdeeWeekendQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     IdeeWeekendQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return IdeeWeekendQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof IdeeWeekendQuery) {
            return $criteria;
        }
        $query = new IdeeWeekendQuery();
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
     * @return   IdeeWeekend|IdeeWeekend[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = IdeeWeekendPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(IdeeWeekendPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   IdeeWeekend A model object, or null if the key is not found
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
     * @return   IdeeWeekend A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `highlight`, `prix`, `home`, `image_path`, `active` FROM `idee_weekend` WHERE `id` = :p0';
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
            $obj = new IdeeWeekend();
            $obj->hydrate($row);
            IdeeWeekendPeer::addInstanceToPool($obj, (string) $key);
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
     * @return IdeeWeekend|IdeeWeekend[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|IdeeWeekend[]|mixed the list of results, formatted by the current formatter
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
     * @return IdeeWeekendQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(IdeeWeekendPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return IdeeWeekendQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(IdeeWeekendPeer::ID, $keys, Criteria::IN);
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
     * @return IdeeWeekendQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(IdeeWeekendPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the highlight column
     *
     * Example usage:
     * <code>
     * $query->filterByHighlight(true); // WHERE highlight = true
     * $query->filterByHighlight('yes'); // WHERE highlight = true
     * </code>
     *
     * @param     boolean|string $highlight The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return IdeeWeekendQuery The current query, for fluid interface
     */
    public function filterByHighlight($highlight = null, $comparison = null)
    {
        if (is_string($highlight)) {
            $highlight = in_array(strtolower($highlight), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(IdeeWeekendPeer::HIGHLIGHT, $highlight, $comparison);
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
     * @return IdeeWeekendQuery The current query, for fluid interface
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

        return $this->addUsingAlias(IdeeWeekendPeer::PRIX, $prix, $comparison);
    }

    /**
     * Filter the query on the home column
     *
     * Example usage:
     * <code>
     * $query->filterByHome(true); // WHERE home = true
     * $query->filterByHome('yes'); // WHERE home = true
     * </code>
     *
     * @param     boolean|string $home The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return IdeeWeekendQuery The current query, for fluid interface
     */
    public function filterByHome($home = null, $comparison = null)
    {
        if (is_string($home)) {
            $home = in_array(strtolower($home), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(IdeeWeekendPeer::HOME, $home, $comparison);
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
     * @return IdeeWeekendQuery The current query, for fluid interface
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

        return $this->addUsingAlias(IdeeWeekendPeer::IMAGE_PATH, $imagePath, $comparison);
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
     * @return IdeeWeekendQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(IdeeWeekendPeer::ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query by a related IdeeWeekendI18n object
     *
     * @param   IdeeWeekendI18n|PropelObjectCollection $ideeWeekendI18n  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   IdeeWeekendQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByIdeeWeekendI18n($ideeWeekendI18n, $comparison = null)
    {
        if ($ideeWeekendI18n instanceof IdeeWeekendI18n) {
            return $this
                ->addUsingAlias(IdeeWeekendPeer::ID, $ideeWeekendI18n->getId(), $comparison);
        } elseif ($ideeWeekendI18n instanceof PropelObjectCollection) {
            return $this
                ->useIdeeWeekendI18nQuery()
                ->filterByPrimaryKeys($ideeWeekendI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByIdeeWeekendI18n() only accepts arguments of type IdeeWeekendI18n or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the IdeeWeekendI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return IdeeWeekendQuery The current query, for fluid interface
     */
    public function joinIdeeWeekendI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('IdeeWeekendI18n');

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
            $this->addJoinObject($join, 'IdeeWeekendI18n');
        }

        return $this;
    }

    /**
     * Use the IdeeWeekendI18n relation IdeeWeekendI18n object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\IdeeWeekendI18nQuery A secondary query class using the current class as primary query
     */
    public function useIdeeWeekendI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinIdeeWeekendI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'IdeeWeekendI18n', '\Cungfoo\Model\IdeeWeekendI18nQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   IdeeWeekend $ideeWeekend Object to remove from the list of results
     *
     * @return IdeeWeekendQuery The current query, for fluid interface
     */
    public function prune($ideeWeekend = null)
    {
        if ($ideeWeekend) {
            $this->addUsingAlias(IdeeWeekendPeer::ID, $ideeWeekend->getId(), Criteria::NOT_EQUAL);
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
     * @return    IdeeWeekendQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'IdeeWeekendI18n';

        return $this
            ->joinIdeeWeekendI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    IdeeWeekendQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'fr', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('IdeeWeekendI18n');
        $this->with['IdeeWeekendI18n']->setIsWithOneToMany(false);

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
     * @return    IdeeWeekendI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'IdeeWeekendI18n', 'Cungfoo\Model\IdeeWeekendI18nQuery');
    }

}
