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
use Cungfoo\Model\MultimediaEtablissement;
use Cungfoo\Model\MultimediaEtablissementTag;
use Cungfoo\Model\MultimediaEtablissementTagPeer;
use Cungfoo\Model\MultimediaEtablissementTagQuery;
use Cungfoo\Model\Tag;

/**
 * Base class that represents a query for the 'multimedia_etablissement_tag' table.
 *
 *
 *
 * @method MultimediaEtablissementTagQuery orderByMultimediaEtablissementId($order = Criteria::ASC) Order by the multimedia_etablissement_id column
 * @method MultimediaEtablissementTagQuery orderByTagId($order = Criteria::ASC) Order by the tag_id column
 *
 * @method MultimediaEtablissementTagQuery groupByMultimediaEtablissementId() Group by the multimedia_etablissement_id column
 * @method MultimediaEtablissementTagQuery groupByTagId() Group by the tag_id column
 *
 * @method MultimediaEtablissementTagQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method MultimediaEtablissementTagQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method MultimediaEtablissementTagQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method MultimediaEtablissementTagQuery leftJoinMultimediaEtablissement($relationAlias = null) Adds a LEFT JOIN clause to the query using the MultimediaEtablissement relation
 * @method MultimediaEtablissementTagQuery rightJoinMultimediaEtablissement($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MultimediaEtablissement relation
 * @method MultimediaEtablissementTagQuery innerJoinMultimediaEtablissement($relationAlias = null) Adds a INNER JOIN clause to the query using the MultimediaEtablissement relation
 *
 * @method MultimediaEtablissementTagQuery leftJoinTag($relationAlias = null) Adds a LEFT JOIN clause to the query using the Tag relation
 * @method MultimediaEtablissementTagQuery rightJoinTag($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Tag relation
 * @method MultimediaEtablissementTagQuery innerJoinTag($relationAlias = null) Adds a INNER JOIN clause to the query using the Tag relation
 *
 * @method MultimediaEtablissementTag findOne(PropelPDO $con = null) Return the first MultimediaEtablissementTag matching the query
 * @method MultimediaEtablissementTag findOneOrCreate(PropelPDO $con = null) Return the first MultimediaEtablissementTag matching the query, or a new MultimediaEtablissementTag object populated from the query conditions when no match is found
 *
 * @method MultimediaEtablissementTag findOneByMultimediaEtablissementId(int $multimedia_etablissement_id) Return the first MultimediaEtablissementTag filtered by the multimedia_etablissement_id column
 * @method MultimediaEtablissementTag findOneByTagId(int $tag_id) Return the first MultimediaEtablissementTag filtered by the tag_id column
 *
 * @method array findByMultimediaEtablissementId(int $multimedia_etablissement_id) Return MultimediaEtablissementTag objects filtered by the multimedia_etablissement_id column
 * @method array findByTagId(int $tag_id) Return MultimediaEtablissementTag objects filtered by the tag_id column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseMultimediaEtablissementTagQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseMultimediaEtablissementTagQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\MultimediaEtablissementTag', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new MultimediaEtablissementTagQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     MultimediaEtablissementTagQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return MultimediaEtablissementTagQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof MultimediaEtablissementTagQuery) {
            return $criteria;
        }
        $query = new MultimediaEtablissementTagQuery();
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
                         A Primary key composition: [$multimedia_etablissement_id, $tag_id]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   MultimediaEtablissementTag|MultimediaEtablissementTag[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = MultimediaEtablissementTagPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(MultimediaEtablissementTagPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   MultimediaEtablissementTag A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `multimedia_etablissement_id`, `tag_id` FROM `multimedia_etablissement_tag` WHERE `multimedia_etablissement_id` = :p0 AND `tag_id` = :p1';
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
            $obj = new MultimediaEtablissementTag();
            $obj->hydrate($row);
            MultimediaEtablissementTagPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return MultimediaEtablissementTag|MultimediaEtablissementTag[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|MultimediaEtablissementTag[]|mixed the list of results, formatted by the current formatter
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
     * @return MultimediaEtablissementTagQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(MultimediaEtablissementTagPeer::MULTIMEDIA_ETABLISSEMENT_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(MultimediaEtablissementTagPeer::TAG_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return MultimediaEtablissementTagQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(MultimediaEtablissementTagPeer::MULTIMEDIA_ETABLISSEMENT_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(MultimediaEtablissementTagPeer::TAG_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the multimedia_etablissement_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMultimediaEtablissementId(1234); // WHERE multimedia_etablissement_id = 1234
     * $query->filterByMultimediaEtablissementId(array(12, 34)); // WHERE multimedia_etablissement_id IN (12, 34)
     * $query->filterByMultimediaEtablissementId(array('min' => 12)); // WHERE multimedia_etablissement_id > 12
     * </code>
     *
     * @see       filterByMultimediaEtablissement()
     *
     * @param     mixed $multimediaEtablissementId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return MultimediaEtablissementTagQuery The current query, for fluid interface
     */
    public function filterByMultimediaEtablissementId($multimediaEtablissementId = null, $comparison = null)
    {
        if (is_array($multimediaEtablissementId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(MultimediaEtablissementTagPeer::MULTIMEDIA_ETABLISSEMENT_ID, $multimediaEtablissementId, $comparison);
    }

    /**
     * Filter the query on the tag_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTagId(1234); // WHERE tag_id = 1234
     * $query->filterByTagId(array(12, 34)); // WHERE tag_id IN (12, 34)
     * $query->filterByTagId(array('min' => 12)); // WHERE tag_id > 12
     * </code>
     *
     * @see       filterByTag()
     *
     * @param     mixed $tagId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return MultimediaEtablissementTagQuery The current query, for fluid interface
     */
    public function filterByTagId($tagId = null, $comparison = null)
    {
        if (is_array($tagId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(MultimediaEtablissementTagPeer::TAG_ID, $tagId, $comparison);
    }

    /**
     * Filter the query by a related MultimediaEtablissement object
     *
     * @param   MultimediaEtablissement|PropelObjectCollection $multimediaEtablissement The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   MultimediaEtablissementTagQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByMultimediaEtablissement($multimediaEtablissement, $comparison = null)
    {
        if ($multimediaEtablissement instanceof MultimediaEtablissement) {
            return $this
                ->addUsingAlias(MultimediaEtablissementTagPeer::MULTIMEDIA_ETABLISSEMENT_ID, $multimediaEtablissement->getId(), $comparison);
        } elseif ($multimediaEtablissement instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(MultimediaEtablissementTagPeer::MULTIMEDIA_ETABLISSEMENT_ID, $multimediaEtablissement->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByMultimediaEtablissement() only accepts arguments of type MultimediaEtablissement or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the MultimediaEtablissement relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return MultimediaEtablissementTagQuery The current query, for fluid interface
     */
    public function joinMultimediaEtablissement($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('MultimediaEtablissement');

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
            $this->addJoinObject($join, 'MultimediaEtablissement');
        }

        return $this;
    }

    /**
     * Use the MultimediaEtablissement relation MultimediaEtablissement object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\MultimediaEtablissementQuery A secondary query class using the current class as primary query
     */
    public function useMultimediaEtablissementQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMultimediaEtablissement($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MultimediaEtablissement', '\Cungfoo\Model\MultimediaEtablissementQuery');
    }

    /**
     * Filter the query by a related Tag object
     *
     * @param   Tag|PropelObjectCollection $tag The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   MultimediaEtablissementTagQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByTag($tag, $comparison = null)
    {
        if ($tag instanceof Tag) {
            return $this
                ->addUsingAlias(MultimediaEtablissementTagPeer::TAG_ID, $tag->getId(), $comparison);
        } elseif ($tag instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(MultimediaEtablissementTagPeer::TAG_ID, $tag->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByTag() only accepts arguments of type Tag or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Tag relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return MultimediaEtablissementTagQuery The current query, for fluid interface
     */
    public function joinTag($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Tag');

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
            $this->addJoinObject($join, 'Tag');
        }

        return $this;
    }

    /**
     * Use the Tag relation Tag object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\TagQuery A secondary query class using the current class as primary query
     */
    public function useTagQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTag($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Tag', '\Cungfoo\Model\TagQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   MultimediaEtablissementTag $multimediaEtablissementTag Object to remove from the list of results
     *
     * @return MultimediaEtablissementTagQuery The current query, for fluid interface
     */
    public function prune($multimediaEtablissementTag = null)
    {
        if ($multimediaEtablissementTag) {
            $this->addCond('pruneCond0', $this->getAliasedColName(MultimediaEtablissementTagPeer::MULTIMEDIA_ETABLISSEMENT_ID), $multimediaEtablissementTag->getMultimediaEtablissementId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(MultimediaEtablissementTagPeer::TAG_ID), $multimediaEtablissementTag->getTagId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
