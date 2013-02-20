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
use Cungfoo\Model\EtablissementTypeHebergement;
use Cungfoo\Model\EtablissementTypeHebergementI18n;
use Cungfoo\Model\EtablissementTypeHebergementI18nPeer;
use Cungfoo\Model\EtablissementTypeHebergementI18nQuery;

/**
 * Base class that represents a query for the 'etablissement_type_hebergement_i18n' table.
 *
 *
 *
 * @method EtablissementTypeHebergementI18nQuery orderById($order = Criteria::ASC) Order by the id column
 * @method EtablissementTypeHebergementI18nQuery orderByLocale($order = Criteria::ASC) Order by the locale column
 * @method EtablissementTypeHebergementI18nQuery orderByMinimumPrice($order = Criteria::ASC) Order by the minimum_price column
 * @method EtablissementTypeHebergementI18nQuery orderByMinimumPriceDiscountLabel($order = Criteria::ASC) Order by the minimum_price_discount_label column
 * @method EtablissementTypeHebergementI18nQuery orderByMinimumPriceStartDate($order = Criteria::ASC) Order by the minimum_price_start_date column
 * @method EtablissementTypeHebergementI18nQuery orderByMinimumPriceEndDate($order = Criteria::ASC) Order by the minimum_price_end_date column
 *
 * @method EtablissementTypeHebergementI18nQuery groupById() Group by the id column
 * @method EtablissementTypeHebergementI18nQuery groupByLocale() Group by the locale column
 * @method EtablissementTypeHebergementI18nQuery groupByMinimumPrice() Group by the minimum_price column
 * @method EtablissementTypeHebergementI18nQuery groupByMinimumPriceDiscountLabel() Group by the minimum_price_discount_label column
 * @method EtablissementTypeHebergementI18nQuery groupByMinimumPriceStartDate() Group by the minimum_price_start_date column
 * @method EtablissementTypeHebergementI18nQuery groupByMinimumPriceEndDate() Group by the minimum_price_end_date column
 *
 * @method EtablissementTypeHebergementI18nQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method EtablissementTypeHebergementI18nQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method EtablissementTypeHebergementI18nQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method EtablissementTypeHebergementI18nQuery leftJoinEtablissementTypeHebergement($relationAlias = null) Adds a LEFT JOIN clause to the query using the EtablissementTypeHebergement relation
 * @method EtablissementTypeHebergementI18nQuery rightJoinEtablissementTypeHebergement($relationAlias = null) Adds a RIGHT JOIN clause to the query using the EtablissementTypeHebergement relation
 * @method EtablissementTypeHebergementI18nQuery innerJoinEtablissementTypeHebergement($relationAlias = null) Adds a INNER JOIN clause to the query using the EtablissementTypeHebergement relation
 *
 * @method EtablissementTypeHebergementI18n findOne(PropelPDO $con = null) Return the first EtablissementTypeHebergementI18n matching the query
 * @method EtablissementTypeHebergementI18n findOneOrCreate(PropelPDO $con = null) Return the first EtablissementTypeHebergementI18n matching the query, or a new EtablissementTypeHebergementI18n object populated from the query conditions when no match is found
 *
 * @method EtablissementTypeHebergementI18n findOneById(int $id) Return the first EtablissementTypeHebergementI18n filtered by the id column
 * @method EtablissementTypeHebergementI18n findOneByLocale(string $locale) Return the first EtablissementTypeHebergementI18n filtered by the locale column
 * @method EtablissementTypeHebergementI18n findOneByMinimumPrice(string $minimum_price) Return the first EtablissementTypeHebergementI18n filtered by the minimum_price column
 * @method EtablissementTypeHebergementI18n findOneByMinimumPriceDiscountLabel(string $minimum_price_discount_label) Return the first EtablissementTypeHebergementI18n filtered by the minimum_price_discount_label column
 * @method EtablissementTypeHebergementI18n findOneByMinimumPriceStartDate(string $minimum_price_start_date) Return the first EtablissementTypeHebergementI18n filtered by the minimum_price_start_date column
 * @method EtablissementTypeHebergementI18n findOneByMinimumPriceEndDate(string $minimum_price_end_date) Return the first EtablissementTypeHebergementI18n filtered by the minimum_price_end_date column
 *
 * @method array findById(int $id) Return EtablissementTypeHebergementI18n objects filtered by the id column
 * @method array findByLocale(string $locale) Return EtablissementTypeHebergementI18n objects filtered by the locale column
 * @method array findByMinimumPrice(string $minimum_price) Return EtablissementTypeHebergementI18n objects filtered by the minimum_price column
 * @method array findByMinimumPriceDiscountLabel(string $minimum_price_discount_label) Return EtablissementTypeHebergementI18n objects filtered by the minimum_price_discount_label column
 * @method array findByMinimumPriceStartDate(string $minimum_price_start_date) Return EtablissementTypeHebergementI18n objects filtered by the minimum_price_start_date column
 * @method array findByMinimumPriceEndDate(string $minimum_price_end_date) Return EtablissementTypeHebergementI18n objects filtered by the minimum_price_end_date column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseEtablissementTypeHebergementI18nQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseEtablissementTypeHebergementI18nQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\EtablissementTypeHebergementI18n', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new EtablissementTypeHebergementI18nQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     EtablissementTypeHebergementI18nQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return EtablissementTypeHebergementI18nQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof EtablissementTypeHebergementI18nQuery) {
            return $criteria;
        }
        $query = new EtablissementTypeHebergementI18nQuery();
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
     * @return   EtablissementTypeHebergementI18n|EtablissementTypeHebergementI18n[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = EtablissementTypeHebergementI18nPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(EtablissementTypeHebergementI18nPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   EtablissementTypeHebergementI18n A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `locale`, `minimum_price`, `minimum_price_discount_label`, `minimum_price_start_date`, `minimum_price_end_date` FROM `etablissement_type_hebergement_i18n` WHERE `id` = :p0 AND `locale` = :p1';
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
            $obj = new EtablissementTypeHebergementI18n();
            $obj->hydrate($row);
            EtablissementTypeHebergementI18nPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return EtablissementTypeHebergementI18n|EtablissementTypeHebergementI18n[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|EtablissementTypeHebergementI18n[]|mixed the list of results, formatted by the current formatter
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
     * @return EtablissementTypeHebergementI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(EtablissementTypeHebergementI18nPeer::ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(EtablissementTypeHebergementI18nPeer::LOCALE, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return EtablissementTypeHebergementI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(EtablissementTypeHebergementI18nPeer::ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(EtablissementTypeHebergementI18nPeer::LOCALE, $key[1], Criteria::EQUAL);
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
     * @see       filterByEtablissementTypeHebergement()
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EtablissementTypeHebergementI18nQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(EtablissementTypeHebergementI18nPeer::ID, $id, $comparison);
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
     * @return EtablissementTypeHebergementI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(EtablissementTypeHebergementI18nPeer::LOCALE, $locale, $comparison);
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
     * @return EtablissementTypeHebergementI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(EtablissementTypeHebergementI18nPeer::MINIMUM_PRICE, $minimumPrice, $comparison);
    }

    /**
     * Filter the query on the minimum_price_discount_label column
     *
     * Example usage:
     * <code>
     * $query->filterByMinimumPriceDiscountLabel('fooValue');   // WHERE minimum_price_discount_label = 'fooValue'
     * $query->filterByMinimumPriceDiscountLabel('%fooValue%'); // WHERE minimum_price_discount_label LIKE '%fooValue%'
     * </code>
     *
     * @param     string $minimumPriceDiscountLabel The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EtablissementTypeHebergementI18nQuery The current query, for fluid interface
     */
    public function filterByMinimumPriceDiscountLabel($minimumPriceDiscountLabel = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($minimumPriceDiscountLabel)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $minimumPriceDiscountLabel)) {
                $minimumPriceDiscountLabel = str_replace('*', '%', $minimumPriceDiscountLabel);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(EtablissementTypeHebergementI18nPeer::MINIMUM_PRICE_DISCOUNT_LABEL, $minimumPriceDiscountLabel, $comparison);
    }

    /**
     * Filter the query on the minimum_price_start_date column
     *
     * Example usage:
     * <code>
     * $query->filterByMinimumPriceStartDate('2011-03-14'); // WHERE minimum_price_start_date = '2011-03-14'
     * $query->filterByMinimumPriceStartDate('now'); // WHERE minimum_price_start_date = '2011-03-14'
     * $query->filterByMinimumPriceStartDate(array('max' => 'yesterday')); // WHERE minimum_price_start_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $minimumPriceStartDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EtablissementTypeHebergementI18nQuery The current query, for fluid interface
     */
    public function filterByMinimumPriceStartDate($minimumPriceStartDate = null, $comparison = null)
    {
        if (is_array($minimumPriceStartDate)) {
            $useMinMax = false;
            if (isset($minimumPriceStartDate['min'])) {
                $this->addUsingAlias(EtablissementTypeHebergementI18nPeer::MINIMUM_PRICE_START_DATE, $minimumPriceStartDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($minimumPriceStartDate['max'])) {
                $this->addUsingAlias(EtablissementTypeHebergementI18nPeer::MINIMUM_PRICE_START_DATE, $minimumPriceStartDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EtablissementTypeHebergementI18nPeer::MINIMUM_PRICE_START_DATE, $minimumPriceStartDate, $comparison);
    }

    /**
     * Filter the query on the minimum_price_end_date column
     *
     * Example usage:
     * <code>
     * $query->filterByMinimumPriceEndDate('2011-03-14'); // WHERE minimum_price_end_date = '2011-03-14'
     * $query->filterByMinimumPriceEndDate('now'); // WHERE minimum_price_end_date = '2011-03-14'
     * $query->filterByMinimumPriceEndDate(array('max' => 'yesterday')); // WHERE minimum_price_end_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $minimumPriceEndDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EtablissementTypeHebergementI18nQuery The current query, for fluid interface
     */
    public function filterByMinimumPriceEndDate($minimumPriceEndDate = null, $comparison = null)
    {
        if (is_array($minimumPriceEndDate)) {
            $useMinMax = false;
            if (isset($minimumPriceEndDate['min'])) {
                $this->addUsingAlias(EtablissementTypeHebergementI18nPeer::MINIMUM_PRICE_END_DATE, $minimumPriceEndDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($minimumPriceEndDate['max'])) {
                $this->addUsingAlias(EtablissementTypeHebergementI18nPeer::MINIMUM_PRICE_END_DATE, $minimumPriceEndDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EtablissementTypeHebergementI18nPeer::MINIMUM_PRICE_END_DATE, $minimumPriceEndDate, $comparison);
    }

    /**
     * Filter the query by a related EtablissementTypeHebergement object
     *
     * @param   EtablissementTypeHebergement|PropelObjectCollection $etablissementTypeHebergement The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   EtablissementTypeHebergementI18nQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByEtablissementTypeHebergement($etablissementTypeHebergement, $comparison = null)
    {
        if ($etablissementTypeHebergement instanceof EtablissementTypeHebergement) {
            return $this
                ->addUsingAlias(EtablissementTypeHebergementI18nPeer::ID, $etablissementTypeHebergement->getId(), $comparison);
        } elseif ($etablissementTypeHebergement instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EtablissementTypeHebergementI18nPeer::ID, $etablissementTypeHebergement->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return EtablissementTypeHebergementI18nQuery The current query, for fluid interface
     */
    public function joinEtablissementTypeHebergement($relationAlias = null, $joinType = 'LEFT JOIN')
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
    public function useEtablissementTypeHebergementQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinEtablissementTypeHebergement($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'EtablissementTypeHebergement', '\Cungfoo\Model\EtablissementTypeHebergementQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   EtablissementTypeHebergementI18n $etablissementTypeHebergementI18n Object to remove from the list of results
     *
     * @return EtablissementTypeHebergementI18nQuery The current query, for fluid interface
     */
    public function prune($etablissementTypeHebergementI18n = null)
    {
        if ($etablissementTypeHebergementI18n) {
            $this->addCond('pruneCond0', $this->getAliasedColName(EtablissementTypeHebergementI18nPeer::ID), $etablissementTypeHebergementI18n->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(EtablissementTypeHebergementI18nPeer::LOCALE), $etablissementTypeHebergementI18n->getLocale(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
