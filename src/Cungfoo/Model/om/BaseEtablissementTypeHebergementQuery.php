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
use Cungfoo\Model\EtablissementTypeHebergement;
use Cungfoo\Model\EtablissementTypeHebergementPeer;
use Cungfoo\Model\EtablissementTypeHebergementQuery;
use Cungfoo\Model\TypeHebergement;

/**
 * Base class that represents a query for the 'etablissement_type_hebergement' table.
 *
 *
 *
 * @method EtablissementTypeHebergementQuery orderByEtablissementId($order = Criteria::ASC) Order by the etablissement_id column
 * @method EtablissementTypeHebergementQuery orderByTypeHebergementId($order = Criteria::ASC) Order by the type_hebergement_id column
 *
 * @method EtablissementTypeHebergementQuery groupByEtablissementId() Group by the etablissement_id column
 * @method EtablissementTypeHebergementQuery groupByTypeHebergementId() Group by the type_hebergement_id column
 *
 * @method EtablissementTypeHebergementQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method EtablissementTypeHebergementQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method EtablissementTypeHebergementQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method EtablissementTypeHebergementQuery leftJoinEtablissement($relationAlias = null) Adds a LEFT JOIN clause to the query using the Etablissement relation
 * @method EtablissementTypeHebergementQuery rightJoinEtablissement($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Etablissement relation
 * @method EtablissementTypeHebergementQuery innerJoinEtablissement($relationAlias = null) Adds a INNER JOIN clause to the query using the Etablissement relation
 *
 * @method EtablissementTypeHebergementQuery leftJoinTypeHebergement($relationAlias = null) Adds a LEFT JOIN clause to the query using the TypeHebergement relation
 * @method EtablissementTypeHebergementQuery rightJoinTypeHebergement($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TypeHebergement relation
 * @method EtablissementTypeHebergementQuery innerJoinTypeHebergement($relationAlias = null) Adds a INNER JOIN clause to the query using the TypeHebergement relation
 *
 * @method EtablissementTypeHebergement findOne(PropelPDO $con = null) Return the first EtablissementTypeHebergement matching the query
 * @method EtablissementTypeHebergement findOneOrCreate(PropelPDO $con = null) Return the first EtablissementTypeHebergement matching the query, or a new EtablissementTypeHebergement object populated from the query conditions when no match is found
 *
 * @method EtablissementTypeHebergement findOneByEtablissementId(int $etablissement_id) Return the first EtablissementTypeHebergement filtered by the etablissement_id column
 * @method EtablissementTypeHebergement findOneByTypeHebergementId(int $type_hebergement_id) Return the first EtablissementTypeHebergement filtered by the type_hebergement_id column
 *
 * @method array findByEtablissementId(int $etablissement_id) Return EtablissementTypeHebergement objects filtered by the etablissement_id column
 * @method array findByTypeHebergementId(int $type_hebergement_id) Return EtablissementTypeHebergement objects filtered by the type_hebergement_id column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseEtablissementTypeHebergementQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseEtablissementTypeHebergementQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\EtablissementTypeHebergement', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new EtablissementTypeHebergementQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     EtablissementTypeHebergementQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return EtablissementTypeHebergementQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof EtablissementTypeHebergementQuery) {
            return $criteria;
        }
        $query = new EtablissementTypeHebergementQuery();
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
                         A Primary key composition: [$etablissement_id, $type_hebergement_id]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   EtablissementTypeHebergement|EtablissementTypeHebergement[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = EtablissementTypeHebergementPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(EtablissementTypeHebergementPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   EtablissementTypeHebergement A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ETABLISSEMENT_ID`, `TYPE_HEBERGEMENT_ID` FROM `etablissement_type_hebergement` WHERE `ETABLISSEMENT_ID` = :p0 AND `TYPE_HEBERGEMENT_ID` = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new EtablissementTypeHebergement();
            $obj->hydrate($row);
            EtablissementTypeHebergementPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return EtablissementTypeHebergement|EtablissementTypeHebergement[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|EtablissementTypeHebergement[]|mixed the list of results, formatted by the current formatter
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
     * @return EtablissementTypeHebergementQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(EtablissementTypeHebergementPeer::ETABLISSEMENT_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(EtablissementTypeHebergementPeer::TYPE_HEBERGEMENT_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return EtablissementTypeHebergementQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(EtablissementTypeHebergementPeer::ETABLISSEMENT_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(EtablissementTypeHebergementPeer::TYPE_HEBERGEMENT_ID, $key[1], Criteria::EQUAL);
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
     * @return EtablissementTypeHebergementQuery The current query, for fluid interface
     */
    public function filterByEtablissementId($etablissementId = null, $comparison = null)
    {
        if (is_array($etablissementId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(EtablissementTypeHebergementPeer::ETABLISSEMENT_ID, $etablissementId, $comparison);
    }

    /**
     * Filter the query on the type_hebergement_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTypeHebergementId(1234); // WHERE type_hebergement_id = 1234
     * $query->filterByTypeHebergementId(array(12, 34)); // WHERE type_hebergement_id IN (12, 34)
     * $query->filterByTypeHebergementId(array('min' => 12)); // WHERE type_hebergement_id > 12
     * </code>
     *
     * @see       filterByTypeHebergement()
     *
     * @param     mixed $typeHebergementId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EtablissementTypeHebergementQuery The current query, for fluid interface
     */
    public function filterByTypeHebergementId($typeHebergementId = null, $comparison = null)
    {
        if (is_array($typeHebergementId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(EtablissementTypeHebergementPeer::TYPE_HEBERGEMENT_ID, $typeHebergementId, $comparison);
    }

    /**
     * Filter the query by a related Etablissement object
     *
     * @param   Etablissement|PropelObjectCollection $etablissement The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   EtablissementTypeHebergementQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByEtablissement($etablissement, $comparison = null)
    {
        if ($etablissement instanceof Etablissement) {
            return $this
                ->addUsingAlias(EtablissementTypeHebergementPeer::ETABLISSEMENT_ID, $etablissement->getId(), $comparison);
        } elseif ($etablissement instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EtablissementTypeHebergementPeer::ETABLISSEMENT_ID, $etablissement->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return EtablissementTypeHebergementQuery The current query, for fluid interface
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
     * Filter the query by a related TypeHebergement object
     *
     * @param   TypeHebergement|PropelObjectCollection $typeHebergement The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   EtablissementTypeHebergementQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTypeHebergement($typeHebergement, $comparison = null)
    {
        if ($typeHebergement instanceof TypeHebergement) {
            return $this
                ->addUsingAlias(EtablissementTypeHebergementPeer::TYPE_HEBERGEMENT_ID, $typeHebergement->getId(), $comparison);
        } elseif ($typeHebergement instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EtablissementTypeHebergementPeer::TYPE_HEBERGEMENT_ID, $typeHebergement->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return EtablissementTypeHebergementQuery The current query, for fluid interface
     */
    public function joinTypeHebergement($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
    public function useTypeHebergementQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTypeHebergement($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TypeHebergement', '\Cungfoo\Model\TypeHebergementQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   EtablissementTypeHebergement $etablissementTypeHebergement Object to remove from the list of results
     *
     * @return EtablissementTypeHebergementQuery The current query, for fluid interface
     */
    public function prune($etablissementTypeHebergement = null)
    {
        if ($etablissementTypeHebergement) {
            $this->addCond('pruneCond0', $this->getAliasedColName(EtablissementTypeHebergementPeer::ETABLISSEMENT_ID), $etablissementTypeHebergement->getEtablissementId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(EtablissementTypeHebergementPeer::TYPE_HEBERGEMENT_ID), $etablissementTypeHebergement->getTypeHebergementId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
