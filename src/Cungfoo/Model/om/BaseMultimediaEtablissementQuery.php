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
use Cungfoo\Model\MultimediaEtablissement;
use Cungfoo\Model\MultimediaEtablissementI18n;
use Cungfoo\Model\MultimediaEtablissementPeer;
use Cungfoo\Model\MultimediaEtablissementQuery;
use Cungfoo\Model\MultimediaEtablissementTag;
use Cungfoo\Model\Tag;

/**
 * Base class that represents a query for the 'multimedia_etablissement' table.
 *
 *
 *
 * @method MultimediaEtablissementQuery orderById($order = Criteria::ASC) Order by the id column
 * @method MultimediaEtablissementQuery orderByEtablissementId($order = Criteria::ASC) Order by the etablissement_id column
 * @method MultimediaEtablissementQuery orderByImagePath($order = Criteria::ASC) Order by the image_path column
 * @method MultimediaEtablissementQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method MultimediaEtablissementQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method MultimediaEtablissementQuery orderByActive($order = Criteria::ASC) Order by the active column
 *
 * @method MultimediaEtablissementQuery groupById() Group by the id column
 * @method MultimediaEtablissementQuery groupByEtablissementId() Group by the etablissement_id column
 * @method MultimediaEtablissementQuery groupByImagePath() Group by the image_path column
 * @method MultimediaEtablissementQuery groupByCreatedAt() Group by the created_at column
 * @method MultimediaEtablissementQuery groupByUpdatedAt() Group by the updated_at column
 * @method MultimediaEtablissementQuery groupByActive() Group by the active column
 *
 * @method MultimediaEtablissementQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method MultimediaEtablissementQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method MultimediaEtablissementQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method MultimediaEtablissementQuery leftJoinEtablissement($relationAlias = null) Adds a LEFT JOIN clause to the query using the Etablissement relation
 * @method MultimediaEtablissementQuery rightJoinEtablissement($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Etablissement relation
 * @method MultimediaEtablissementQuery innerJoinEtablissement($relationAlias = null) Adds a INNER JOIN clause to the query using the Etablissement relation
 *
 * @method MultimediaEtablissementQuery leftJoinMultimediaEtablissementTag($relationAlias = null) Adds a LEFT JOIN clause to the query using the MultimediaEtablissementTag relation
 * @method MultimediaEtablissementQuery rightJoinMultimediaEtablissementTag($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MultimediaEtablissementTag relation
 * @method MultimediaEtablissementQuery innerJoinMultimediaEtablissementTag($relationAlias = null) Adds a INNER JOIN clause to the query using the MultimediaEtablissementTag relation
 *
 * @method MultimediaEtablissementQuery leftJoinMultimediaEtablissementI18n($relationAlias = null) Adds a LEFT JOIN clause to the query using the MultimediaEtablissementI18n relation
 * @method MultimediaEtablissementQuery rightJoinMultimediaEtablissementI18n($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MultimediaEtablissementI18n relation
 * @method MultimediaEtablissementQuery innerJoinMultimediaEtablissementI18n($relationAlias = null) Adds a INNER JOIN clause to the query using the MultimediaEtablissementI18n relation
 *
 * @method MultimediaEtablissement findOne(PropelPDO $con = null) Return the first MultimediaEtablissement matching the query
 * @method MultimediaEtablissement findOneOrCreate(PropelPDO $con = null) Return the first MultimediaEtablissement matching the query, or a new MultimediaEtablissement object populated from the query conditions when no match is found
 *
 * @method MultimediaEtablissement findOneByEtablissementId(int $etablissement_id) Return the first MultimediaEtablissement filtered by the etablissement_id column
 * @method MultimediaEtablissement findOneByImagePath(string $image_path) Return the first MultimediaEtablissement filtered by the image_path column
 * @method MultimediaEtablissement findOneByCreatedAt(string $created_at) Return the first MultimediaEtablissement filtered by the created_at column
 * @method MultimediaEtablissement findOneByUpdatedAt(string $updated_at) Return the first MultimediaEtablissement filtered by the updated_at column
 * @method MultimediaEtablissement findOneByActive(boolean $active) Return the first MultimediaEtablissement filtered by the active column
 *
 * @method array findById(int $id) Return MultimediaEtablissement objects filtered by the id column
 * @method array findByEtablissementId(int $etablissement_id) Return MultimediaEtablissement objects filtered by the etablissement_id column
 * @method array findByImagePath(string $image_path) Return MultimediaEtablissement objects filtered by the image_path column
 * @method array findByCreatedAt(string $created_at) Return MultimediaEtablissement objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return MultimediaEtablissement objects filtered by the updated_at column
 * @method array findByActive(boolean $active) Return MultimediaEtablissement objects filtered by the active column
 *
 * @package    propel.generator.Cungfoo.Model.om
 */
abstract class BaseMultimediaEtablissementQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseMultimediaEtablissementQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'cungfoo', $modelName = 'Cungfoo\\Model\\MultimediaEtablissement', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new MultimediaEtablissementQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     MultimediaEtablissementQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return MultimediaEtablissementQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof MultimediaEtablissementQuery) {
            return $criteria;
        }
        $query = new MultimediaEtablissementQuery();
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
     * @return   MultimediaEtablissement|MultimediaEtablissement[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = MultimediaEtablissementPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(MultimediaEtablissementPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   MultimediaEtablissement A model object, or null if the key is not found
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
     * @return   MultimediaEtablissement A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `etablissement_id`, `image_path`, `created_at`, `updated_at`, `active` FROM `multimedia_etablissement` WHERE `id` = :p0';
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
            $obj = new MultimediaEtablissement();
            $obj->hydrate($row);
            MultimediaEtablissementPeer::addInstanceToPool($obj, (string) $key);
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
     * @return MultimediaEtablissement|MultimediaEtablissement[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|MultimediaEtablissement[]|mixed the list of results, formatted by the current formatter
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
     * @return MultimediaEtablissementQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(MultimediaEtablissementPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return MultimediaEtablissementQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(MultimediaEtablissementPeer::ID, $keys, Criteria::IN);
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
     * @return MultimediaEtablissementQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(MultimediaEtablissementPeer::ID, $id, $comparison);
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
     * @return MultimediaEtablissementQuery The current query, for fluid interface
     */
    public function filterByEtablissementId($etablissementId = null, $comparison = null)
    {
        if (is_array($etablissementId)) {
            $useMinMax = false;
            if (isset($etablissementId['min'])) {
                $this->addUsingAlias(MultimediaEtablissementPeer::ETABLISSEMENT_ID, $etablissementId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($etablissementId['max'])) {
                $this->addUsingAlias(MultimediaEtablissementPeer::ETABLISSEMENT_ID, $etablissementId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MultimediaEtablissementPeer::ETABLISSEMENT_ID, $etablissementId, $comparison);
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
     * @return MultimediaEtablissementQuery The current query, for fluid interface
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

        return $this->addUsingAlias(MultimediaEtablissementPeer::IMAGE_PATH, $imagePath, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return MultimediaEtablissementQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(MultimediaEtablissementPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(MultimediaEtablissementPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MultimediaEtablissementPeer::CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return MultimediaEtablissementQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(MultimediaEtablissementPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(MultimediaEtablissementPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MultimediaEtablissementPeer::UPDATED_AT, $updatedAt, $comparison);
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
     * @return MultimediaEtablissementQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(MultimediaEtablissementPeer::ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query by a related Etablissement object
     *
     * @param   Etablissement|PropelObjectCollection $etablissement The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   MultimediaEtablissementQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByEtablissement($etablissement, $comparison = null)
    {
        if ($etablissement instanceof Etablissement) {
            return $this
                ->addUsingAlias(MultimediaEtablissementPeer::ETABLISSEMENT_ID, $etablissement->getId(), $comparison);
        } elseif ($etablissement instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(MultimediaEtablissementPeer::ETABLISSEMENT_ID, $etablissement->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return MultimediaEtablissementQuery The current query, for fluid interface
     */
    public function joinEtablissement($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useEtablissementQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinEtablissement($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Etablissement', '\Cungfoo\Model\EtablissementQuery');
    }

    /**
     * Filter the query by a related MultimediaEtablissementTag object
     *
     * @param   MultimediaEtablissementTag|PropelObjectCollection $multimediaEtablissementTag  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   MultimediaEtablissementQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByMultimediaEtablissementTag($multimediaEtablissementTag, $comparison = null)
    {
        if ($multimediaEtablissementTag instanceof MultimediaEtablissementTag) {
            return $this
                ->addUsingAlias(MultimediaEtablissementPeer::ID, $multimediaEtablissementTag->getMultimediaEtablissementId(), $comparison);
        } elseif ($multimediaEtablissementTag instanceof PropelObjectCollection) {
            return $this
                ->useMultimediaEtablissementTagQuery()
                ->filterByPrimaryKeys($multimediaEtablissementTag->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByMultimediaEtablissementTag() only accepts arguments of type MultimediaEtablissementTag or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the MultimediaEtablissementTag relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return MultimediaEtablissementQuery The current query, for fluid interface
     */
    public function joinMultimediaEtablissementTag($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('MultimediaEtablissementTag');

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
            $this->addJoinObject($join, 'MultimediaEtablissementTag');
        }

        return $this;
    }

    /**
     * Use the MultimediaEtablissementTag relation MultimediaEtablissementTag object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\MultimediaEtablissementTagQuery A secondary query class using the current class as primary query
     */
    public function useMultimediaEtablissementTagQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMultimediaEtablissementTag($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MultimediaEtablissementTag', '\Cungfoo\Model\MultimediaEtablissementTagQuery');
    }

    /**
     * Filter the query by a related MultimediaEtablissementI18n object
     *
     * @param   MultimediaEtablissementI18n|PropelObjectCollection $multimediaEtablissementI18n  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   MultimediaEtablissementQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByMultimediaEtablissementI18n($multimediaEtablissementI18n, $comparison = null)
    {
        if ($multimediaEtablissementI18n instanceof MultimediaEtablissementI18n) {
            return $this
                ->addUsingAlias(MultimediaEtablissementPeer::ID, $multimediaEtablissementI18n->getId(), $comparison);
        } elseif ($multimediaEtablissementI18n instanceof PropelObjectCollection) {
            return $this
                ->useMultimediaEtablissementI18nQuery()
                ->filterByPrimaryKeys($multimediaEtablissementI18n->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByMultimediaEtablissementI18n() only accepts arguments of type MultimediaEtablissementI18n or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the MultimediaEtablissementI18n relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return MultimediaEtablissementQuery The current query, for fluid interface
     */
    public function joinMultimediaEtablissementI18n($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('MultimediaEtablissementI18n');

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
            $this->addJoinObject($join, 'MultimediaEtablissementI18n');
        }

        return $this;
    }

    /**
     * Use the MultimediaEtablissementI18n relation MultimediaEtablissementI18n object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Cungfoo\Model\MultimediaEtablissementI18nQuery A secondary query class using the current class as primary query
     */
    public function useMultimediaEtablissementI18nQuery($relationAlias = null, $joinType = 'LEFT JOIN')
    {
        return $this
            ->joinMultimediaEtablissementI18n($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MultimediaEtablissementI18n', '\Cungfoo\Model\MultimediaEtablissementI18nQuery');
    }

    /**
     * Filter the query by a related Tag object
     * using the multimedia_etablissement_tag table as cross reference
     *
     * @param   Tag $tag the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   MultimediaEtablissementQuery The current query, for fluid interface
     */
    public function filterByTag($tag, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useMultimediaEtablissementTagQuery()
            ->filterByTag($tag, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   MultimediaEtablissement $multimediaEtablissement Object to remove from the list of results
     *
     * @return MultimediaEtablissementQuery The current query, for fluid interface
     */
    public function prune($multimediaEtablissement = null)
    {
        if ($multimediaEtablissement) {
            $this->addUsingAlias(MultimediaEtablissementPeer::ID, $multimediaEtablissement->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     MultimediaEtablissementQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(MultimediaEtablissementPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     MultimediaEtablissementQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(MultimediaEtablissementPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     MultimediaEtablissementQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(MultimediaEtablissementPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     MultimediaEtablissementQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(MultimediaEtablissementPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     MultimediaEtablissementQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(MultimediaEtablissementPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     MultimediaEtablissementQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(MultimediaEtablissementPeer::CREATED_AT);
    }
    // active behavior
    
    /**
     * return only active objects
     *
     * @return boolean
     */
    public function findActive($con = null)
    {
        $this->filterByActive(true);
    
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
     * @return    MultimediaEtablissementQuery The current query, for fluid interface
     */
    public function joinI18n($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $relationName = $relationAlias ? $relationAlias : 'MultimediaEtablissementI18n';

        return $this
            ->joinMultimediaEtablissementI18n($relationAlias, $joinType)
            ->addJoinCondition($relationName, $relationName . '.Locale = ?', $locale);
    }

    /**
     * Adds a JOIN clause to the query and hydrates the related I18n object.
     * Shortcut for $c->joinI18n($locale)->with()
     *
     * @param     string $locale Locale to use for the join condition, e.g. 'fr_FR'
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'. Defaults to left join.
     *
     * @return    MultimediaEtablissementQuery The current query, for fluid interface
     */
    public function joinWithI18n($locale = 'fr', $joinType = Criteria::LEFT_JOIN)
    {
        $this
            ->joinI18n($locale, null, $joinType)
            ->with('MultimediaEtablissementI18n');
        $this->with['MultimediaEtablissementI18n']->setIsWithOneToMany(false);

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
     * @return    MultimediaEtablissementI18nQuery A secondary query class using the current class as primary query
     */
    public function useI18nQuery($locale = 'fr', $relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinI18n($locale, $relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MultimediaEtablissementI18n', 'Cungfoo\Model\MultimediaEtablissementI18nQuery');
    }

}
