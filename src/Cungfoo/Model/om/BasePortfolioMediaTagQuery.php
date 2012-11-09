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
use Cungfoo\Model\PortfolioMedia;
use Cungfoo\Model\PortfolioMediaTag;
use Cungfoo\Model\PortfolioMediaTagPeer;
use Cungfoo\Model\PortfolioMediaTagQuery;
use Cungfoo\Model\PortfolioTag;

/**
 * Base class that represents a query for the 'portfolio_media_tag' table.
 *
 *
 *
 * @method PortfolioMediaTagQuery orderByMediaId($order = Criteria::ASC) Order by the media_id column
 * @method PortfolioMediaTagQuery orderByTagId($order = Criteria::ASC) Order by the tag_id column
 *
 * @method PortfolioMediaTagQuery groupByMediaId() Group by the media_id column
 * @method PortfolioMediaTagQuery groupByTagId() Group by the tag_id column
 *
 * @method PortfolioMediaTagQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method PortfolioMediaTagQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method PortfolioMediaTagQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method PortfolioMediaTagQuery leftJoinPortfolioMedia($relationAlias = null) Adds a LEFT JOIN clause to the query using the PortfolioMedia relation
 * @method PortfolioMediaTagQuery rightJoinPortfolioMedia($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PortfolioMedia relation
 * @method PortfolioMediaTagQuery innerJoinPortfolioMedia($relationAlias = null) Adds a INNER JOIN clause to the query using the PortfolioMedia relation
 *
 * @method PortfolioMediaTagQuery leftJoinPortfolioTag($relationAlias = null) Adds a LEFT JOIN clause to the query using the PortfolioTag relation
 * @method PortfolioMediaTagQuery rightJoinPortfolioTag($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PortfolioTag relation
 * @method PortfolioMediaTagQuery innerJoinPortfolioTag($relationAlias = null) Adds a INNER JOIN clause to the query using the PortfolioTag relation
 *
 * @method PortfolioMediaTag findOne(PropelPDO $con = null) Return the first PortfolioMediaTag matching the query
 * @method PortfolioMediaTag findOneOrCreate(PropelPDO $con = null) Return the first PortfolioMediaTag matching the query, or a new PortfolioMediaTag object populated from the query conditions when no match is found
 *
 * @method PortfolioMediaTag findOneByMediaId(int $media_id) Return the first PortfolioMediaTag filtered by the media_id column
 * @method PortfolioMediaTag findOneByTagId(int $tag_id) Return the first PortfolioMediaTag filtered by the tag_id column
 *
 * @method array findByMediaId(int $media_id) Return PortfolioMediaTag objects filtered by the media_id column
 * @method array findByTagId(int $tag_id) Return PortfolioMediaTag objects filtered by the tag_id column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BasePortfolioMediaTagQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BasePortfolioMediaTagQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\PortfolioMediaTag', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new PortfolioMediaTagQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     PortfolioMediaTagQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return PortfolioMediaTagQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof PortfolioMediaTagQuery) {
            return $criteria;
        }
        $query = new PortfolioMediaTagQuery();
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
                         A Primary key composition: [$media_id, $tag_id]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   PortfolioMediaTag|PortfolioMediaTag[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PortfolioMediaTagPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(PortfolioMediaTagPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   PortfolioMediaTag A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `MEDIA_ID`, `TAG_ID` FROM `portfolio_media_tag` WHERE `MEDIA_ID` = :p0 AND `TAG_ID` = :p1';
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
            $obj = new PortfolioMediaTag();
            $obj->hydrate($row);
            PortfolioMediaTagPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return PortfolioMediaTag|PortfolioMediaTag[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|PortfolioMediaTag[]|mixed the list of results, formatted by the current formatter
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
     * @return PortfolioMediaTagQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(PortfolioMediaTagPeer::MEDIA_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(PortfolioMediaTagPeer::TAG_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return PortfolioMediaTagQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(PortfolioMediaTagPeer::MEDIA_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(PortfolioMediaTagPeer::TAG_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the media_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMediaId(1234); // WHERE media_id = 1234
     * $query->filterByMediaId(array(12, 34)); // WHERE media_id IN (12, 34)
     * $query->filterByMediaId(array('min' => 12)); // WHERE media_id > 12
     * </code>
     *
     * @see       filterByPortfolioMedia()
     *
     * @param     mixed $mediaId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PortfolioMediaTagQuery The current query, for fluid interface
     */
    public function filterByMediaId($mediaId = null, $comparison = null)
    {
        if (is_array($mediaId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(PortfolioMediaTagPeer::MEDIA_ID, $mediaId, $comparison);
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
     * @see       filterByPortfolioTag()
     *
     * @param     mixed $tagId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PortfolioMediaTagQuery The current query, for fluid interface
     */
    public function filterByTagId($tagId = null, $comparison = null)
    {
        if (is_array($tagId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(PortfolioMediaTagPeer::TAG_ID, $tagId, $comparison);
    }

    /**
     * Filter the query by a related PortfolioMedia object
     *
     * @param   PortfolioMedia|PropelObjectCollection $portfolioMedia The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PortfolioMediaTagQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByPortfolioMedia($portfolioMedia, $comparison = null)
    {
        if ($portfolioMedia instanceof PortfolioMedia) {
            return $this
                ->addUsingAlias(PortfolioMediaTagPeer::MEDIA_ID, $portfolioMedia->getId(), $comparison);
        } elseif ($portfolioMedia instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PortfolioMediaTagPeer::MEDIA_ID, $portfolioMedia->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPortfolioMedia() only accepts arguments of type PortfolioMedia or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PortfolioMedia relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PortfolioMediaTagQuery The current query, for fluid interface
     */
    public function joinPortfolioMedia($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PortfolioMedia');

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
            $this->addJoinObject($join, 'PortfolioMedia');
        }

        return $this;
    }

    /**
     * Use the PortfolioMedia relation PortfolioMedia object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\PortfolioMediaQuery A secondary query class using the current class as primary query
     */
    public function usePortfolioMediaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPortfolioMedia($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PortfolioMedia', '\Cungfoo\Model\PortfolioMediaQuery');
    }

    /**
     * Filter the query by a related PortfolioTag object
     *
     * @param   PortfolioTag|PropelObjectCollection $portfolioTag The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   PortfolioMediaTagQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByPortfolioTag($portfolioTag, $comparison = null)
    {
        if ($portfolioTag instanceof PortfolioTag) {
            return $this
                ->addUsingAlias(PortfolioMediaTagPeer::TAG_ID, $portfolioTag->getId(), $comparison);
        } elseif ($portfolioTag instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PortfolioMediaTagPeer::TAG_ID, $portfolioTag->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPortfolioTag() only accepts arguments of type PortfolioTag or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PortfolioTag relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PortfolioMediaTagQuery The current query, for fluid interface
     */
    public function joinPortfolioTag($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PortfolioTag');

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
            $this->addJoinObject($join, 'PortfolioTag');
        }

        return $this;
    }

    /**
     * Use the PortfolioTag relation PortfolioTag object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\PortfolioTagQuery A secondary query class using the current class as primary query
     */
    public function usePortfolioTagQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPortfolioTag($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PortfolioTag', '\Cungfoo\Model\PortfolioTagQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   PortfolioMediaTag $portfolioMediaTag Object to remove from the list of results
     *
     * @return PortfolioMediaTagQuery The current query, for fluid interface
     */
    public function prune($portfolioMediaTag = null)
    {
        if ($portfolioMediaTag) {
            $this->addCond('pruneCond0', $this->getAliasedColName(PortfolioMediaTagPeer::MEDIA_ID), $portfolioMediaTag->getMediaId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(PortfolioMediaTagPeer::TAG_ID), $portfolioMediaTag->getTagId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
