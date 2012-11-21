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
use Cungfoo\Model\DernieresMinutes;
use Cungfoo\Model\DernieresMinutesDestination;
use Cungfoo\Model\DernieresMinutesEtablissement;
use Cungfoo\Model\DernieresMinutesPeer;
use Cungfoo\Model\DernieresMinutesQuery;
use Cungfoo\Model\Destination;
use Cungfoo\Model\Etablissement;

/**
 * Base class that represents a query for the 'dernieres_minutes' table.
 *
 *
 *
 * @method DernieresMinutesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method DernieresMinutesQuery orderByDateStart($order = Criteria::ASC) Order by the date_start column
 * @method DernieresMinutesQuery orderByDayStart($order = Criteria::ASC) Order by the day_start column
 * @method DernieresMinutesQuery orderByDayRange($order = Criteria::ASC) Order by the day_range column
 * @method DernieresMinutesQuery orderByActive($order = Criteria::ASC) Order by the active column
 *
 * @method DernieresMinutesQuery groupById() Group by the id column
 * @method DernieresMinutesQuery groupByDateStart() Group by the date_start column
 * @method DernieresMinutesQuery groupByDayStart() Group by the day_start column
 * @method DernieresMinutesQuery groupByDayRange() Group by the day_range column
 * @method DernieresMinutesQuery groupByActive() Group by the active column
 *
 * @method DernieresMinutesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method DernieresMinutesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method DernieresMinutesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method DernieresMinutesQuery leftJoinDernieresMinutesEtablissement($relationAlias = null) Adds a LEFT JOIN clause to the query using the DernieresMinutesEtablissement relation
 * @method DernieresMinutesQuery rightJoinDernieresMinutesEtablissement($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DernieresMinutesEtablissement relation
 * @method DernieresMinutesQuery innerJoinDernieresMinutesEtablissement($relationAlias = null) Adds a INNER JOIN clause to the query using the DernieresMinutesEtablissement relation
 *
 * @method DernieresMinutesQuery leftJoinDernieresMinutesDestination($relationAlias = null) Adds a LEFT JOIN clause to the query using the DernieresMinutesDestination relation
 * @method DernieresMinutesQuery rightJoinDernieresMinutesDestination($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DernieresMinutesDestination relation
 * @method DernieresMinutesQuery innerJoinDernieresMinutesDestination($relationAlias = null) Adds a INNER JOIN clause to the query using the DernieresMinutesDestination relation
 *
 * @method DernieresMinutes findOne(PropelPDO $con = null) Return the first DernieresMinutes matching the query
 * @method DernieresMinutes findOneOrCreate(PropelPDO $con = null) Return the first DernieresMinutes matching the query, or a new DernieresMinutes object populated from the query conditions when no match is found
 *
 * @method DernieresMinutes findOneByDateStart(string $date_start) Return the first DernieresMinutes filtered by the date_start column
 * @method DernieresMinutes findOneByDayStart(int $day_start) Return the first DernieresMinutes filtered by the day_start column
 * @method DernieresMinutes findOneByDayRange(int $day_range) Return the first DernieresMinutes filtered by the day_range column
 * @method DernieresMinutes findOneByActive(boolean $active) Return the first DernieresMinutes filtered by the active column
 *
 * @method array findById(int $id) Return DernieresMinutes objects filtered by the id column
 * @method array findByDateStart(string $date_start) Return DernieresMinutes objects filtered by the date_start column
 * @method array findByDayStart(int $day_start) Return DernieresMinutes objects filtered by the day_start column
 * @method array findByDayRange(int $day_range) Return DernieresMinutes objects filtered by the day_range column
 * @method array findByActive(boolean $active) Return DernieresMinutes objects filtered by the active column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseDernieresMinutesQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseDernieresMinutesQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\DernieresMinutes', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new DernieresMinutesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     DernieresMinutesQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return DernieresMinutesQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof DernieresMinutesQuery) {
            return $criteria;
        }
        $query = new DernieresMinutesQuery();
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
     * @return   DernieresMinutes|DernieresMinutes[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = DernieresMinutesPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(DernieresMinutesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   DernieresMinutes A model object, or null if the key is not found
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
     * @return   DernieresMinutes A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `DATE_START`, `DAY_START`, `DAY_RANGE`, `ACTIVE` FROM `dernieres_minutes` WHERE `ID` = :p0';
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
            $obj = new DernieresMinutes();
            $obj->hydrate($row);
            DernieresMinutesPeer::addInstanceToPool($obj, (string) $key);
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
     * @return DernieresMinutes|DernieresMinutes[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|DernieresMinutes[]|mixed the list of results, formatted by the current formatter
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
     * @return DernieresMinutesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(DernieresMinutesPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return DernieresMinutesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(DernieresMinutesPeer::ID, $keys, Criteria::IN);
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
     * @return DernieresMinutesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(DernieresMinutesPeer::ID, $id, $comparison);
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
     * @return DernieresMinutesQuery The current query, for fluid interface
     */
    public function filterByDateStart($dateStart = null, $comparison = null)
    {
        if (is_array($dateStart)) {
            $useMinMax = false;
            if (isset($dateStart['min'])) {
                $this->addUsingAlias(DernieresMinutesPeer::DATE_START, $dateStart['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateStart['max'])) {
                $this->addUsingAlias(DernieresMinutesPeer::DATE_START, $dateStart['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DernieresMinutesPeer::DATE_START, $dateStart, $comparison);
    }

    /**
     * Filter the query on the day_start column
     *
     * @param     mixed $dayStart The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DernieresMinutesQuery The current query, for fluid interface
     * @throws PropelException - if the value is not accepted by the enum.
     */
    public function filterByDayStart($dayStart = null, $comparison = null)
    {
        $valueSet = DernieresMinutesPeer::getValueSet(DernieresMinutesPeer::DAY_START);
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

        return $this->addUsingAlias(DernieresMinutesPeer::DAY_START, $dayStart, $comparison);
    }

    /**
     * Filter the query on the day_range column
     *
     * @param     mixed $dayRange The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return DernieresMinutesQuery The current query, for fluid interface
     * @throws PropelException - if the value is not accepted by the enum.
     */
    public function filterByDayRange($dayRange = null, $comparison = null)
    {
        $valueSet = DernieresMinutesPeer::getValueSet(DernieresMinutesPeer::DAY_RANGE);
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

        return $this->addUsingAlias(DernieresMinutesPeer::DAY_RANGE, $dayRange, $comparison);
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
     * @return DernieresMinutesQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(DernieresMinutesPeer::ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query by a related DernieresMinutesEtablissement object
     *
     * @param   DernieresMinutesEtablissement|PropelObjectCollection $dernieresMinutesEtablissement  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   DernieresMinutesQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByDernieresMinutesEtablissement($dernieresMinutesEtablissement, $comparison = null)
    {
        if ($dernieresMinutesEtablissement instanceof DernieresMinutesEtablissement) {
            return $this
                ->addUsingAlias(DernieresMinutesPeer::ID, $dernieresMinutesEtablissement->getDernieresMinutesId(), $comparison);
        } elseif ($dernieresMinutesEtablissement instanceof PropelObjectCollection) {
            return $this
                ->useDernieresMinutesEtablissementQuery()
                ->filterByPrimaryKeys($dernieresMinutesEtablissement->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByDernieresMinutesEtablissement() only accepts arguments of type DernieresMinutesEtablissement or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the DernieresMinutesEtablissement relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return DernieresMinutesQuery The current query, for fluid interface
     */
    public function joinDernieresMinutesEtablissement($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('DernieresMinutesEtablissement');

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
            $this->addJoinObject($join, 'DernieresMinutesEtablissement');
        }

        return $this;
    }

    /**
     * Use the DernieresMinutesEtablissement relation DernieresMinutesEtablissement object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\DernieresMinutesEtablissementQuery A secondary query class using the current class as primary query
     */
    public function useDernieresMinutesEtablissementQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDernieresMinutesEtablissement($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'DernieresMinutesEtablissement', '\Cungfoo\Model\DernieresMinutesEtablissementQuery');
    }

    /**
     * Filter the query by a related DernieresMinutesDestination object
     *
     * @param   DernieresMinutesDestination|PropelObjectCollection $dernieresMinutesDestination  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   DernieresMinutesQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByDernieresMinutesDestination($dernieresMinutesDestination, $comparison = null)
    {
        if ($dernieresMinutesDestination instanceof DernieresMinutesDestination) {
            return $this
                ->addUsingAlias(DernieresMinutesPeer::ID, $dernieresMinutesDestination->getDernieresMinutesId(), $comparison);
        } elseif ($dernieresMinutesDestination instanceof PropelObjectCollection) {
            return $this
                ->useDernieresMinutesDestinationQuery()
                ->filterByPrimaryKeys($dernieresMinutesDestination->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByDernieresMinutesDestination() only accepts arguments of type DernieresMinutesDestination or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the DernieresMinutesDestination relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return DernieresMinutesQuery The current query, for fluid interface
     */
    public function joinDernieresMinutesDestination($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('DernieresMinutesDestination');

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
            $this->addJoinObject($join, 'DernieresMinutesDestination');
        }

        return $this;
    }

    /**
     * Use the DernieresMinutesDestination relation DernieresMinutesDestination object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\DernieresMinutesDestinationQuery A secondary query class using the current class as primary query
     */
    public function useDernieresMinutesDestinationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDernieresMinutesDestination($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'DernieresMinutesDestination', '\Cungfoo\Model\DernieresMinutesDestinationQuery');
    }

    /**
     * Filter the query by a related Etablissement object
     * using the dernieres_minutes_etablissement table as cross reference
     *
     * @param   Etablissement $etablissement the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   DernieresMinutesQuery The current query, for fluid interface
     */
    public function filterByEtablissement($etablissement, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useDernieresMinutesEtablissementQuery()
            ->filterByEtablissement($etablissement, $comparison)
            ->endUse();
    }

    /**
     * Filter the query by a related Destination object
     * using the dernieres_minutes_destination table as cross reference
     *
     * @param   Destination $destination the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   DernieresMinutesQuery The current query, for fluid interface
     */
    public function filterByDestination($destination, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useDernieresMinutesDestinationQuery()
            ->filterByDestination($destination, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   DernieresMinutes $dernieresMinutes Object to remove from the list of results
     *
     * @return DernieresMinutesQuery The current query, for fluid interface
     */
    public function prune($dernieresMinutes = null)
    {
        if ($dernieresMinutes) {
            $this->addUsingAlias(DernieresMinutesPeer::ID, $dernieresMinutes->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
