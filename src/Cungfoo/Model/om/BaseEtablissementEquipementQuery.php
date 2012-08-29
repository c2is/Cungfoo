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
use Cungfoo\Model\Equipement;
use Cungfoo\Model\Etablissement;
use Cungfoo\Model\EtablissementEquipement;
use Cungfoo\Model\EtablissementEquipementPeer;
use Cungfoo\Model\EtablissementEquipementQuery;

/**
 * Base class that represents a query for the 'etablissement_equipement' table.
 *
 *
 *
 * @method EtablissementEquipementQuery orderByEtablissementId($order = Criteria::ASC) Order by the etablissement_id column
 * @method EtablissementEquipementQuery orderByEquipementId($order = Criteria::ASC) Order by the equipement_id column
 *
 * @method EtablissementEquipementQuery groupByEtablissementId() Group by the etablissement_id column
 * @method EtablissementEquipementQuery groupByEquipementId() Group by the equipement_id column
 *
 * @method EtablissementEquipementQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method EtablissementEquipementQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method EtablissementEquipementQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method EtablissementEquipementQuery leftJoinEtablissement($relationAlias = null) Adds a LEFT JOIN clause to the query using the Etablissement relation
 * @method EtablissementEquipementQuery rightJoinEtablissement($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Etablissement relation
 * @method EtablissementEquipementQuery innerJoinEtablissement($relationAlias = null) Adds a INNER JOIN clause to the query using the Etablissement relation
 *
 * @method EtablissementEquipementQuery leftJoinEquipement($relationAlias = null) Adds a LEFT JOIN clause to the query using the Equipement relation
 * @method EtablissementEquipementQuery rightJoinEquipement($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Equipement relation
 * @method EtablissementEquipementQuery innerJoinEquipement($relationAlias = null) Adds a INNER JOIN clause to the query using the Equipement relation
 *
 * @method EtablissementEquipement findOne(PropelPDO $con = null) Return the first EtablissementEquipement matching the query
 * @method EtablissementEquipement findOneOrCreate(PropelPDO $con = null) Return the first EtablissementEquipement matching the query, or a new EtablissementEquipement object populated from the query conditions when no match is found
 *
 * @method EtablissementEquipement findOneByEtablissementId(int $etablissement_id) Return the first EtablissementEquipement filtered by the etablissement_id column
 * @method EtablissementEquipement findOneByEquipementId(string $equipement_id) Return the first EtablissementEquipement filtered by the equipement_id column
 *
 * @method array findByEtablissementId(int $etablissement_id) Return EtablissementEquipement objects filtered by the etablissement_id column
 * @method array findByEquipementId(string $equipement_id) Return EtablissementEquipement objects filtered by the equipement_id column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseEtablissementEquipementQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseEtablissementEquipementQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\EtablissementEquipement', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new EtablissementEquipementQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     EtablissementEquipementQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return EtablissementEquipementQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof EtablissementEquipementQuery) {
            return $criteria;
        }
        $query = new EtablissementEquipementQuery();
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
                         A Primary key composition: [$etablissement_id, $equipement_id]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   EtablissementEquipement|EtablissementEquipement[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = EtablissementEquipementPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(EtablissementEquipementPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   EtablissementEquipement A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ETABLISSEMENT_ID`, `EQUIPEMENT_ID` FROM `etablissement_equipement` WHERE `ETABLISSEMENT_ID` = :p0 AND `EQUIPEMENT_ID` = :p1';
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
            $obj = new EtablissementEquipement();
            $obj->hydrate($row);
            EtablissementEquipementPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return EtablissementEquipement|EtablissementEquipement[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|EtablissementEquipement[]|mixed the list of results, formatted by the current formatter
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
     * @return EtablissementEquipementQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(EtablissementEquipementPeer::ETABLISSEMENT_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(EtablissementEquipementPeer::EQUIPEMENT_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return EtablissementEquipementQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(EtablissementEquipementPeer::ETABLISSEMENT_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(EtablissementEquipementPeer::EQUIPEMENT_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the etablissement_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEtablissementId(1234); // WHERE etablissement_id = 1234
     * $query->filterByEtablissementId(array(12, 34)); // WHERE etablissement_id IN (12, 34)
     * $query->filterByEtablissementId(array('min' => 12)); // WHERE etablissement_id > 12
     * </code>
     *
     * @see       filterByEtablissement()
     *
     * @param     mixed $etablissementId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EtablissementEquipementQuery The current query, for fluid interface
     */
    public function filterByEtablissementId($etablissementId = null, $comparison = null)
    {
        if (is_array($etablissementId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(EtablissementEquipementPeer::ETABLISSEMENT_ID, $etablissementId, $comparison);
    }

    /**
     * Filter the query on the equipement_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEquipementId('fooValue');   // WHERE equipement_id = 'fooValue'
     * $query->filterByEquipementId('%fooValue%'); // WHERE equipement_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $equipementId The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EtablissementEquipementQuery The current query, for fluid interface
     */
    public function filterByEquipementId($equipementId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($equipementId)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $equipementId)) {
                $equipementId = str_replace('*', '%', $equipementId);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(EtablissementEquipementPeer::EQUIPEMENT_ID, $equipementId, $comparison);
    }

    /**
     * Filter the query by a related Etablissement object
     *
     * @param   Etablissement|PropelObjectCollection $etablissement The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   EtablissementEquipementQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByEtablissement($etablissement, $comparison = null)
    {
        if ($etablissement instanceof Etablissement) {
            return $this
                ->addUsingAlias(EtablissementEquipementPeer::ETABLISSEMENT_ID, $etablissement->getId(), $comparison);
        } elseif ($etablissement instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EtablissementEquipementPeer::ETABLISSEMENT_ID, $etablissement->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return EtablissementEquipementQuery The current query, for fluid interface
     */
    public function joinEtablissement($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
    public function useEtablissementQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEtablissement($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Etablissement', '\Cungfoo\Model\EtablissementQuery');
    }

    /**
     * Filter the query by a related Equipement object
     *
     * @param   Equipement|PropelObjectCollection $equipement The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   EtablissementEquipementQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByEquipement($equipement, $comparison = null)
    {
        if ($equipement instanceof Equipement) {
            return $this
                ->addUsingAlias(EtablissementEquipementPeer::EQUIPEMENT_ID, $equipement->getId(), $comparison);
        } elseif ($equipement instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EtablissementEquipementPeer::EQUIPEMENT_ID, $equipement->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByEquipement() only accepts arguments of type Equipement or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Equipement relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return EtablissementEquipementQuery The current query, for fluid interface
     */
    public function joinEquipement($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Equipement');

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
            $this->addJoinObject($join, 'Equipement');
        }

        return $this;
    }

    /**
     * Use the Equipement relation Equipement object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\EquipementQuery A secondary query class using the current class as primary query
     */
    public function useEquipementQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEquipement($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Equipement', '\Cungfoo\Model\EquipementQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   EtablissementEquipement $etablissementEquipement Object to remove from the list of results
     *
     * @return EtablissementEquipementQuery The current query, for fluid interface
     */
    public function prune($etablissementEquipement = null)
    {
        if ($etablissementEquipement) {
            $this->addCond('pruneCond0', $this->getAliasedColName(EtablissementEquipementPeer::ETABLISSEMENT_ID), $etablissementEquipement->getEtablissementId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(EtablissementEquipementPeer::EQUIPEMENT_ID), $etablissementEquipement->getEquipementId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
