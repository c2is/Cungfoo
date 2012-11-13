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
use Cungfoo\Model\Etablissement;
use Cungfoo\Model\EtablissementI18n;
use Cungfoo\Model\EtablissementI18nPeer;
use Cungfoo\Model\EtablissementI18nQuery;

/**
 * Base class that represents a query for the 'etablissement_i18n' table.
 *
 *
 *
 * @method EtablissementI18nQuery orderById($order = Criteria::ASC) Order by the id column
 * @method EtablissementI18nQuery orderByLocale($order = Criteria::ASC) Order by the locale column
 * @method EtablissementI18nQuery orderByCountry($order = Criteria::ASC) Order by the country column
 * @method EtablissementI18nQuery orderByOuvertureReception($order = Criteria::ASC) Order by the ouverture_reception column
 * @method EtablissementI18nQuery orderByOuvertureCamping($order = Criteria::ASC) Order by the ouverture_camping column
 * @method EtablissementI18nQuery orderByArriveesDeparts($order = Criteria::ASC) Order by the arrivees_departs column
 *
 * @method EtablissementI18nQuery groupById() Group by the id column
 * @method EtablissementI18nQuery groupByLocale() Group by the locale column
 * @method EtablissementI18nQuery groupByCountry() Group by the country column
 * @method EtablissementI18nQuery groupByOuvertureReception() Group by the ouverture_reception column
 * @method EtablissementI18nQuery groupByOuvertureCamping() Group by the ouverture_camping column
 * @method EtablissementI18nQuery groupByArriveesDeparts() Group by the arrivees_departs column
 *
 * @method EtablissementI18nQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method EtablissementI18nQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method EtablissementI18nQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method EtablissementI18nQuery leftJoinEtablissement($relationAlias = null) Adds a LEFT JOIN clause to the query using the Etablissement relation
 * @method EtablissementI18nQuery rightJoinEtablissement($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Etablissement relation
 * @method EtablissementI18nQuery innerJoinEtablissement($relationAlias = null) Adds a INNER JOIN clause to the query using the Etablissement relation
 *
 * @method EtablissementI18n findOne(PropelPDO $con = null) Return the first EtablissementI18n matching the query
 * @method EtablissementI18n findOneOrCreate(PropelPDO $con = null) Return the first EtablissementI18n matching the query, or a new EtablissementI18n object populated from the query conditions when no match is found
 *
 * @method EtablissementI18n findOneById(int $id) Return the first EtablissementI18n filtered by the id column
 * @method EtablissementI18n findOneByLocale(string $locale) Return the first EtablissementI18n filtered by the locale column
 * @method EtablissementI18n findOneByCountry(string $country) Return the first EtablissementI18n filtered by the country column
 * @method EtablissementI18n findOneByOuvertureReception(string $ouverture_reception) Return the first EtablissementI18n filtered by the ouverture_reception column
 * @method EtablissementI18n findOneByOuvertureCamping(string $ouverture_camping) Return the first EtablissementI18n filtered by the ouverture_camping column
 * @method EtablissementI18n findOneByArriveesDeparts(string $arrivees_departs) Return the first EtablissementI18n filtered by the arrivees_departs column
 *
 * @method array findById(int $id) Return EtablissementI18n objects filtered by the id column
 * @method array findByLocale(string $locale) Return EtablissementI18n objects filtered by the locale column
 * @method array findByCountry(string $country) Return EtablissementI18n objects filtered by the country column
 * @method array findByOuvertureReception(string $ouverture_reception) Return EtablissementI18n objects filtered by the ouverture_reception column
 * @method array findByOuvertureCamping(string $ouverture_camping) Return EtablissementI18n objects filtered by the ouverture_camping column
 * @method array findByArriveesDeparts(string $arrivees_departs) Return EtablissementI18n objects filtered by the arrivees_departs column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseEtablissementI18nQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseEtablissementI18nQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\EtablissementI18n', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new EtablissementI18nQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     EtablissementI18nQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return EtablissementI18nQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof EtablissementI18nQuery) {
            return $criteria;
        }
        $query = new EtablissementI18nQuery();
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
     * @return   EtablissementI18n|EtablissementI18n[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = EtablissementI18nPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(EtablissementI18nPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   EtablissementI18n A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `LOCALE`, `COUNTRY`, `OUVERTURE_RECEPTION`, `OUVERTURE_CAMPING`, `ARRIVEES_DEPARTS` FROM `etablissement_i18n` WHERE `ID` = :p0 AND `LOCALE` = :p1';
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
            $obj = new EtablissementI18n();
            $obj->hydrate($row);
            EtablissementI18nPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return EtablissementI18n|EtablissementI18n[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|EtablissementI18n[]|mixed the list of results, formatted by the current formatter
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
     * @return EtablissementI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(EtablissementI18nPeer::ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(EtablissementI18nPeer::LOCALE, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return EtablissementI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(EtablissementI18nPeer::ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(EtablissementI18nPeer::LOCALE, $key[1], Criteria::EQUAL);
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
     * @see       filterByEtablissement()
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EtablissementI18nQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(EtablissementI18nPeer::ID, $id, $comparison);
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
     * @return EtablissementI18nQuery The current query, for fluid interface
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

        return $this->addUsingAlias(EtablissementI18nPeer::LOCALE, $locale, $comparison);
    }

    /**
     * Filter the query on the country column
     *
     * Example usage:
     * <code>
     * $query->filterByCountry('fooValue');   // WHERE country = 'fooValue'
     * $query->filterByCountry('%fooValue%'); // WHERE country LIKE '%fooValue%'
     * </code>
     *
     * @param     string $country The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EtablissementI18nQuery The current query, for fluid interface
     */
    public function filterByCountry($country = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($country)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $country)) {
                $country = str_replace('*', '%', $country);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(EtablissementI18nPeer::COUNTRY, $country, $comparison);
    }

    /**
     * Filter the query on the ouverture_reception column
     *
     * Example usage:
     * <code>
     * $query->filterByOuvertureReception('fooValue');   // WHERE ouverture_reception = 'fooValue'
     * $query->filterByOuvertureReception('%fooValue%'); // WHERE ouverture_reception LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ouvertureReception The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EtablissementI18nQuery The current query, for fluid interface
     */
    public function filterByOuvertureReception($ouvertureReception = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ouvertureReception)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ouvertureReception)) {
                $ouvertureReception = str_replace('*', '%', $ouvertureReception);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(EtablissementI18nPeer::OUVERTURE_RECEPTION, $ouvertureReception, $comparison);
    }

    /**
     * Filter the query on the ouverture_camping column
     *
     * Example usage:
     * <code>
     * $query->filterByOuvertureCamping('fooValue');   // WHERE ouverture_camping = 'fooValue'
     * $query->filterByOuvertureCamping('%fooValue%'); // WHERE ouverture_camping LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ouvertureCamping The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EtablissementI18nQuery The current query, for fluid interface
     */
    public function filterByOuvertureCamping($ouvertureCamping = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ouvertureCamping)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ouvertureCamping)) {
                $ouvertureCamping = str_replace('*', '%', $ouvertureCamping);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(EtablissementI18nPeer::OUVERTURE_CAMPING, $ouvertureCamping, $comparison);
    }

    /**
     * Filter the query on the arrivees_departs column
     *
     * Example usage:
     * <code>
     * $query->filterByArriveesDeparts('fooValue');   // WHERE arrivees_departs = 'fooValue'
     * $query->filterByArriveesDeparts('%fooValue%'); // WHERE arrivees_departs LIKE '%fooValue%'
     * </code>
     *
     * @param     string $arriveesDeparts The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EtablissementI18nQuery The current query, for fluid interface
     */
    public function filterByArriveesDeparts($arriveesDeparts = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($arriveesDeparts)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $arriveesDeparts)) {
                $arriveesDeparts = str_replace('*', '%', $arriveesDeparts);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(EtablissementI18nPeer::ARRIVEES_DEPARTS, $arriveesDeparts, $comparison);
    }

    /**
     * Filter the query by a related Etablissement object
     *
     * @param   Etablissement|PropelObjectCollection $etablissement The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   EtablissementI18nQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByEtablissement($etablissement, $comparison = null)
    {
        if ($etablissement instanceof Etablissement) {
            return $this
                ->addUsingAlias(EtablissementI18nPeer::ID, $etablissement->getId(), $comparison);
        } elseif ($etablissement instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EtablissementI18nPeer::ID, $etablissement->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByEtablissement() only accepts arguments of type Etablissement or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Etablissement relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return EtablissementI18nQuery The current query, for fluid interface
     */
    public function joinEtablissement($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Etablissement');

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
            $this->addJoinObject($join, 'Etablissement');
        }

        return $this;
    }

    /**
     * Use the Etablissement relation Etablissement object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\EtablissementQuery A secondary query class using the current class as primary query
     */
    public function useEtablissementQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinEtablissement($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Etablissement', '\Cungfoo\Model\EtablissementQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   EtablissementI18n $etablissementI18n Object to remove from the list of results
     *
     * @return EtablissementI18nQuery The current query, for fluid interface
     */
    public function prune($etablissementI18n = null)
    {
        if ($etablissementI18n) {
            $this->addCond('pruneCond0', $this->getAliasedColName(EtablissementI18nPeer::ID), $etablissementI18n->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(EtablissementI18nPeer::LOCALE), $etablissementI18n->getLocale(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
