<?php

namespace Cungfoo\Model\om;

use \BasePeer;
use \Criteria;
use \PDO;
use \PDOStatement;
use \Propel;
use \PropelException;
use \PropelPDO;
use Cungfoo\Model\BonPlanBonPlanCategorie;
use Cungfoo\Model\BonPlanBonPlanCategoriePeer;
use Cungfoo\Model\BonPlanBonPlanCategorieQuery;
use Cungfoo\Model\BonPlanCategoriePeer;
use Cungfoo\Model\BonPlanPeer;
use Cungfoo\Model\map\BonPlanBonPlanCategorieTableMap;

/**
 * Base static class for performing query and update operations on the 'bon_plan_bon_plan_categorie' table.
 *
 *
 *
 * @package propel.generator.Cungfoo.Model.om
 */
abstract class BaseBonPlanBonPlanCategoriePeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'cungfoo';

    /** the table name for this class */
    const TABLE_NAME = 'bon_plan_bon_plan_categorie';

    /** the related Propel class for this table */
    const OM_CLASS = 'Cungfoo\\Model\\BonPlanBonPlanCategorie';

    /** the related TableMap class for this table */
    const TM_CLASS = 'BonPlanBonPlanCategorieTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 3;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 3;

    /** the column name for the bon_plan_id field */
    const BON_PLAN_ID = 'bon_plan_bon_plan_categorie.bon_plan_id';

    /** the column name for the bon_plan_categorie_id field */
    const BON_PLAN_CATEGORIE_ID = 'bon_plan_bon_plan_categorie.bon_plan_categorie_id';

    /** the column name for the sortable_rank field */
    const SORTABLE_RANK = 'bon_plan_bon_plan_categorie.sortable_rank';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identiy map to hold any loaded instances of BonPlanBonPlanCategorie objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array BonPlanBonPlanCategorie[]
     */
    public static $instances = array();


    // sortable behavior

    /**
     * rank column
     */
    const RANK_COL = 'bon_plan_bon_plan_categorie.sortable_rank';

    /**
     * Scope column for the set
     */
    const SCOPE_COL = 'bon_plan_bon_plan_categorie.bon_plan_categorie_id';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. BonPlanBonPlanCategoriePeer::$fieldNames[BonPlanBonPlanCategoriePeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('BonPlanId', 'BonPlanCategorieId', 'SortableRank', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('bonPlanId', 'bonPlanCategorieId', 'sortableRank', ),
        BasePeer::TYPE_COLNAME => array (BonPlanBonPlanCategoriePeer::BON_PLAN_ID, BonPlanBonPlanCategoriePeer::BON_PLAN_CATEGORIE_ID, BonPlanBonPlanCategoriePeer::SORTABLE_RANK, ),
        BasePeer::TYPE_RAW_COLNAME => array ('BON_PLAN_ID', 'BON_PLAN_CATEGORIE_ID', 'SORTABLE_RANK', ),
        BasePeer::TYPE_FIELDNAME => array ('bon_plan_id', 'bon_plan_categorie_id', 'sortable_rank', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. BonPlanBonPlanCategoriePeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('BonPlanId' => 0, 'BonPlanCategorieId' => 1, 'SortableRank' => 2, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('bonPlanId' => 0, 'bonPlanCategorieId' => 1, 'sortableRank' => 2, ),
        BasePeer::TYPE_COLNAME => array (BonPlanBonPlanCategoriePeer::BON_PLAN_ID => 0, BonPlanBonPlanCategoriePeer::BON_PLAN_CATEGORIE_ID => 1, BonPlanBonPlanCategoriePeer::SORTABLE_RANK => 2, ),
        BasePeer::TYPE_RAW_COLNAME => array ('BON_PLAN_ID' => 0, 'BON_PLAN_CATEGORIE_ID' => 1, 'SORTABLE_RANK' => 2, ),
        BasePeer::TYPE_FIELDNAME => array ('bon_plan_id' => 0, 'bon_plan_categorie_id' => 1, 'sortable_rank' => 2, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, )
    );

    /**
     * Translates a fieldname to another type
     *
     * @param      string $name field name
     * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
     * @param      string $toType   One of the class type constants
     * @return string          translated name of the field.
     * @throws PropelException - if the specified name could not be found in the fieldname mappings.
     */
    public static function translateFieldName($name, $fromType, $toType)
    {
        $toNames = BonPlanBonPlanCategoriePeer::getFieldNames($toType);
        $key = isset(BonPlanBonPlanCategoriePeer::$fieldKeys[$fromType][$name]) ? BonPlanBonPlanCategoriePeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(BonPlanBonPlanCategoriePeer::$fieldKeys[$fromType], true));
        }

        return $toNames[$key];
    }

    /**
     * Returns an array of field names.
     *
     * @param      string $type The type of fieldnames to return:
     *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
     * @return array           A list of field names
     * @throws PropelException - if the type is not valid.
     */
    public static function getFieldNames($type = BasePeer::TYPE_PHPNAME)
    {
        if (!array_key_exists($type, BonPlanBonPlanCategoriePeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return BonPlanBonPlanCategoriePeer::$fieldNames[$type];
    }

    /**
     * Convenience method which changes table.column to alias.column.
     *
     * Using this method you can maintain SQL abstraction while using column aliases.
     * <code>
     *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
     *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
     * </code>
     * @param      string $alias The alias for the current table.
     * @param      string $column The column name for current table. (i.e. BonPlanBonPlanCategoriePeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(BonPlanBonPlanCategoriePeer::TABLE_NAME.'.', $alias.'.', $column);
    }

    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param      Criteria $criteria object containing the columns to add.
     * @param      string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(BonPlanBonPlanCategoriePeer::BON_PLAN_ID);
            $criteria->addSelectColumn(BonPlanBonPlanCategoriePeer::BON_PLAN_CATEGORIE_ID);
            $criteria->addSelectColumn(BonPlanBonPlanCategoriePeer::SORTABLE_RANK);
        } else {
            $criteria->addSelectColumn($alias . '.bon_plan_id');
            $criteria->addSelectColumn($alias . '.bon_plan_categorie_id');
            $criteria->addSelectColumn($alias . '.sortable_rank');
        }
    }

    /**
     * Returns the number of rows matching criteria.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @return int Number of matching rows.
     */
    public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
    {
        // we may modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(BonPlanBonPlanCategoriePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            BonPlanBonPlanCategoriePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(BonPlanBonPlanCategoriePeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(BonPlanBonPlanCategoriePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        // BasePeer returns a PDOStatement
        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }
    /**
     * Selects one object from the DB.
     *
     * @param      Criteria $criteria object used to create the SELECT statement.
     * @param      PropelPDO $con
     * @return                 BonPlanBonPlanCategorie
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = BonPlanBonPlanCategoriePeer::doSelect($critcopy, $con);
        if ($objects) {
            return $objects[0];
        }

        return null;
    }
    /**
     * Selects several row from the DB.
     *
     * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
     * @param      PropelPDO $con
     * @return array           Array of selected Objects
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelect(Criteria $criteria, PropelPDO $con = null)
    {
        return BonPlanBonPlanCategoriePeer::populateObjects(BonPlanBonPlanCategoriePeer::doSelectStmt($criteria, $con));
    }
    /**
     * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
     *
     * Use this method directly if you want to work with an executed statement durirectly (for example
     * to perform your own object hydration).
     *
     * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
     * @param      PropelPDO $con The connection to use
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     * @return PDOStatement The executed PDOStatement object.
     * @see        BasePeer::doSelect()
     */
    public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(BonPlanBonPlanCategoriePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            BonPlanBonPlanCategoriePeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(BonPlanBonPlanCategoriePeer::DATABASE_NAME);

        // BasePeer returns a PDOStatement
        return BasePeer::doSelect($criteria, $con);
    }
    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doSelect*()
     * methods in your stub classes -- you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by doSelect*()
     * and retrieveByPK*() calls.
     *
     * @param      BonPlanBonPlanCategorie $obj A BonPlanBonPlanCategorie object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = serialize(array((string) $obj->getBonPlanId(), (string) $obj->getBonPlanCategorieId()));
            } // if key === null
            BonPlanBonPlanCategoriePeer::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param      mixed $value A BonPlanBonPlanCategorie object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof BonPlanBonPlanCategorie) {
                $key = serialize(array((string) $value->getBonPlanId(), (string) $value->getBonPlanCategorieId()));
            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key
                $key = serialize(array((string) $value[0], (string) $value[1]));
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or BonPlanBonPlanCategorie object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(BonPlanBonPlanCategoriePeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return   BonPlanBonPlanCategorie Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(BonPlanBonPlanCategoriePeer::$instances[$key])) {
                return BonPlanBonPlanCategoriePeer::$instances[$key];
            }
        }

        return null; // just to be explicit
    }

    /**
     * Clear the instance pool.
     *
     * @return void
     */
    public static function clearInstancePool()
    {
        BonPlanBonPlanCategoriePeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to bon_plan_bon_plan_categorie
     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @return string A string version of PK or null if the components of primary key in result array are all null.
     */
    public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
    {
        // If the PK cannot be derived from the row, return null.
        if ($row[$startcol] === null && $row[$startcol + 1] === null) {
            return null;
        }

        return serialize(array((string) $row[$startcol], (string) $row[$startcol + 1]));
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $startcol = 0)
    {

        return array((int) $row[$startcol], (int) $row[$startcol + 1]);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function populateObjects(PDOStatement $stmt)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = BonPlanBonPlanCategoriePeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = BonPlanBonPlanCategoriePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = BonPlanBonPlanCategoriePeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                BonPlanBonPlanCategoriePeer::addInstanceToPool($obj, $key);
            } // if key exists
        }
        $stmt->closeCursor();

        return $results;
    }
    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     * @return array (BonPlanBonPlanCategorie object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = BonPlanBonPlanCategoriePeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = BonPlanBonPlanCategoriePeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + BonPlanBonPlanCategoriePeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = BonPlanBonPlanCategoriePeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            BonPlanBonPlanCategoriePeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }


    /**
     * Returns the number of rows matching criteria, joining the related BonPlan table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinBonPlan(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(BonPlanBonPlanCategoriePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            BonPlanBonPlanCategoriePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(BonPlanBonPlanCategoriePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(BonPlanBonPlanCategoriePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(BonPlanBonPlanCategoriePeer::BON_PLAN_ID, BonPlanPeer::ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Returns the number of rows matching criteria, joining the related BonPlanCategorie table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinBonPlanCategorie(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(BonPlanBonPlanCategoriePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            BonPlanBonPlanCategoriePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(BonPlanBonPlanCategoriePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(BonPlanBonPlanCategoriePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(BonPlanBonPlanCategoriePeer::BON_PLAN_CATEGORIE_ID, BonPlanCategoriePeer::ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Selects a collection of BonPlanBonPlanCategorie objects pre-filled with their BonPlan objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of BonPlanBonPlanCategorie objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinBonPlan(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(BonPlanBonPlanCategoriePeer::DATABASE_NAME);
        }

        BonPlanBonPlanCategoriePeer::addSelectColumns($criteria);
        $startcol = BonPlanBonPlanCategoriePeer::NUM_HYDRATE_COLUMNS;
        BonPlanPeer::addSelectColumns($criteria);

        $criteria->addJoin(BonPlanBonPlanCategoriePeer::BON_PLAN_ID, BonPlanPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = BonPlanBonPlanCategoriePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = BonPlanBonPlanCategoriePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = BonPlanBonPlanCategoriePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                BonPlanBonPlanCategoriePeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = BonPlanPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = BonPlanPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = BonPlanPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    BonPlanPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (BonPlanBonPlanCategorie) to $obj2 (BonPlan)
                $obj2->addBonPlanBonPlanCategorie($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of BonPlanBonPlanCategorie objects pre-filled with their BonPlanCategorie objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of BonPlanBonPlanCategorie objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinBonPlanCategorie(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(BonPlanBonPlanCategoriePeer::DATABASE_NAME);
        }

        BonPlanBonPlanCategoriePeer::addSelectColumns($criteria);
        $startcol = BonPlanBonPlanCategoriePeer::NUM_HYDRATE_COLUMNS;
        BonPlanCategoriePeer::addSelectColumns($criteria);

        $criteria->addJoin(BonPlanBonPlanCategoriePeer::BON_PLAN_CATEGORIE_ID, BonPlanCategoriePeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = BonPlanBonPlanCategoriePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = BonPlanBonPlanCategoriePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = BonPlanBonPlanCategoriePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                BonPlanBonPlanCategoriePeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = BonPlanCategoriePeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = BonPlanCategoriePeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = BonPlanCategoriePeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    BonPlanCategoriePeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (BonPlanBonPlanCategorie) to $obj2 (BonPlanCategorie)
                $obj2->addBonPlanBonPlanCategorie($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Returns the number of rows matching criteria, joining all related tables
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(BonPlanBonPlanCategoriePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            BonPlanBonPlanCategoriePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(BonPlanBonPlanCategoriePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(BonPlanBonPlanCategoriePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(BonPlanBonPlanCategoriePeer::BON_PLAN_ID, BonPlanPeer::ID, $join_behavior);

        $criteria->addJoin(BonPlanBonPlanCategoriePeer::BON_PLAN_CATEGORIE_ID, BonPlanCategoriePeer::ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }

    /**
     * Selects a collection of BonPlanBonPlanCategorie objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of BonPlanBonPlanCategorie objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(BonPlanBonPlanCategoriePeer::DATABASE_NAME);
        }

        BonPlanBonPlanCategoriePeer::addSelectColumns($criteria);
        $startcol2 = BonPlanBonPlanCategoriePeer::NUM_HYDRATE_COLUMNS;

        BonPlanPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + BonPlanPeer::NUM_HYDRATE_COLUMNS;

        BonPlanCategoriePeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + BonPlanCategoriePeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(BonPlanBonPlanCategoriePeer::BON_PLAN_ID, BonPlanPeer::ID, $join_behavior);

        $criteria->addJoin(BonPlanBonPlanCategoriePeer::BON_PLAN_CATEGORIE_ID, BonPlanCategoriePeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = BonPlanBonPlanCategoriePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = BonPlanBonPlanCategoriePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = BonPlanBonPlanCategoriePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                BonPlanBonPlanCategoriePeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

            // Add objects for joined BonPlan rows

            $key2 = BonPlanPeer::getPrimaryKeyHashFromRow($row, $startcol2);
            if ($key2 !== null) {
                $obj2 = BonPlanPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = BonPlanPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    BonPlanPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 loaded

                // Add the $obj1 (BonPlanBonPlanCategorie) to the collection in $obj2 (BonPlan)
                $obj2->addBonPlanBonPlanCategorie($obj1);
            } // if joined row not null

            // Add objects for joined BonPlanCategorie rows

            $key3 = BonPlanCategoriePeer::getPrimaryKeyHashFromRow($row, $startcol3);
            if ($key3 !== null) {
                $obj3 = BonPlanCategoriePeer::getInstanceFromPool($key3);
                if (!$obj3) {

                    $cls = BonPlanCategoriePeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    BonPlanCategoriePeer::addInstanceToPool($obj3, $key3);
                } // if obj3 loaded

                // Add the $obj1 (BonPlanBonPlanCategorie) to the collection in $obj3 (BonPlanCategorie)
                $obj3->addBonPlanBonPlanCategorie($obj1);
            } // if joined row not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Returns the number of rows matching criteria, joining the related BonPlan table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptBonPlan(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(BonPlanBonPlanCategoriePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            BonPlanBonPlanCategoriePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(BonPlanBonPlanCategoriePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(BonPlanBonPlanCategoriePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(BonPlanBonPlanCategoriePeer::BON_PLAN_CATEGORIE_ID, BonPlanCategoriePeer::ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Returns the number of rows matching criteria, joining the related BonPlanCategorie table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptBonPlanCategorie(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(BonPlanBonPlanCategoriePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            BonPlanBonPlanCategoriePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(BonPlanBonPlanCategoriePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(BonPlanBonPlanCategoriePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(BonPlanBonPlanCategoriePeer::BON_PLAN_ID, BonPlanPeer::ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Selects a collection of BonPlanBonPlanCategorie objects pre-filled with all related objects except BonPlan.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of BonPlanBonPlanCategorie objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptBonPlan(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(BonPlanBonPlanCategoriePeer::DATABASE_NAME);
        }

        BonPlanBonPlanCategoriePeer::addSelectColumns($criteria);
        $startcol2 = BonPlanBonPlanCategoriePeer::NUM_HYDRATE_COLUMNS;

        BonPlanCategoriePeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + BonPlanCategoriePeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(BonPlanBonPlanCategoriePeer::BON_PLAN_CATEGORIE_ID, BonPlanCategoriePeer::ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = BonPlanBonPlanCategoriePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = BonPlanBonPlanCategoriePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = BonPlanBonPlanCategoriePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                BonPlanBonPlanCategoriePeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined BonPlanCategorie rows

                $key2 = BonPlanCategoriePeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = BonPlanCategoriePeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = BonPlanCategoriePeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    BonPlanCategoriePeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (BonPlanBonPlanCategorie) to the collection in $obj2 (BonPlanCategorie)
                $obj2->addBonPlanBonPlanCategorie($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of BonPlanBonPlanCategorie objects pre-filled with all related objects except BonPlanCategorie.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of BonPlanBonPlanCategorie objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptBonPlanCategorie(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(BonPlanBonPlanCategoriePeer::DATABASE_NAME);
        }

        BonPlanBonPlanCategoriePeer::addSelectColumns($criteria);
        $startcol2 = BonPlanBonPlanCategoriePeer::NUM_HYDRATE_COLUMNS;

        BonPlanPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + BonPlanPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(BonPlanBonPlanCategoriePeer::BON_PLAN_ID, BonPlanPeer::ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = BonPlanBonPlanCategoriePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = BonPlanBonPlanCategoriePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = BonPlanBonPlanCategoriePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                BonPlanBonPlanCategoriePeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined BonPlan rows

                $key2 = BonPlanPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = BonPlanPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = BonPlanPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    BonPlanPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (BonPlanBonPlanCategorie) to the collection in $obj2 (BonPlan)
                $obj2->addBonPlanBonPlanCategorie($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }

    /**
     * Returns the TableMap related to this peer.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getDatabaseMap(BonPlanBonPlanCategoriePeer::DATABASE_NAME)->getTable(BonPlanBonPlanCategoriePeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseBonPlanBonPlanCategoriePeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseBonPlanBonPlanCategoriePeer::TABLE_NAME)) {
        $dbMap->addTableObject(new BonPlanBonPlanCategorieTableMap());
      }
    }

    /**
     * The class that the Peer will make instances of.
     *
     *
     * @return string ClassName
     */
    public static function getOMClass()
    {
        return BonPlanBonPlanCategoriePeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a BonPlanBonPlanCategorie or Criteria object.
     *
     * @param      mixed $values Criteria or BonPlanBonPlanCategorie object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(BonPlanBonPlanCategoriePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from BonPlanBonPlanCategorie object
        }


        // Set the correct dbName
        $criteria->setDbName(BonPlanBonPlanCategoriePeer::DATABASE_NAME);

        try {
            // use transaction because $criteria could contain info
            // for more than one table (I guess, conceivably)
            $con->beginTransaction();
            $pk = BasePeer::doInsert($criteria, $con);
            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $pk;
    }

    /**
     * Performs an UPDATE on the database, given a BonPlanBonPlanCategorie or Criteria object.
     *
     * @param      mixed $values Criteria or BonPlanBonPlanCategorie object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(BonPlanBonPlanCategoriePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(BonPlanBonPlanCategoriePeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(BonPlanBonPlanCategoriePeer::BON_PLAN_ID);
            $value = $criteria->remove(BonPlanBonPlanCategoriePeer::BON_PLAN_ID);
            if ($value) {
                $selectCriteria->add(BonPlanBonPlanCategoriePeer::BON_PLAN_ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(BonPlanBonPlanCategoriePeer::TABLE_NAME);
            }

            $comparison = $criteria->getComparison(BonPlanBonPlanCategoriePeer::BON_PLAN_CATEGORIE_ID);
            $value = $criteria->remove(BonPlanBonPlanCategoriePeer::BON_PLAN_CATEGORIE_ID);
            if ($value) {
                $selectCriteria->add(BonPlanBonPlanCategoriePeer::BON_PLAN_CATEGORIE_ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(BonPlanBonPlanCategoriePeer::TABLE_NAME);
            }

        } else { // $values is BonPlanBonPlanCategorie object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(BonPlanBonPlanCategoriePeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the bon_plan_bon_plan_categorie table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(BonPlanBonPlanCategoriePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(BonPlanBonPlanCategoriePeer::TABLE_NAME, $con, BonPlanBonPlanCategoriePeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BonPlanBonPlanCategoriePeer::clearInstancePool();
            BonPlanBonPlanCategoriePeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a BonPlanBonPlanCategorie or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or BonPlanBonPlanCategorie object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param      PropelPDO $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *				if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, PropelPDO $con = null)
     {
        if ($con === null) {
            $con = Propel::getConnection(BonPlanBonPlanCategoriePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            BonPlanBonPlanCategoriePeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof BonPlanBonPlanCategorie) { // it's a model object
            // invalidate the cache for this single object
            BonPlanBonPlanCategoriePeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(BonPlanBonPlanCategoriePeer::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = array($values);
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(BonPlanBonPlanCategoriePeer::BON_PLAN_ID, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(BonPlanBonPlanCategoriePeer::BON_PLAN_CATEGORIE_ID, $value[1]));
                $criteria->addOr($criterion);
                // we can invalidate the cache for this single PK
                BonPlanBonPlanCategoriePeer::removeInstanceFromPool($value);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(BonPlanBonPlanCategoriePeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            BonPlanBonPlanCategoriePeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given BonPlanBonPlanCategorie object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param      BonPlanBonPlanCategorie $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(BonPlanBonPlanCategoriePeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(BonPlanBonPlanCategoriePeer::TABLE_NAME);

            if (! is_array($cols)) {
                $cols = array($cols);
            }

            foreach ($cols as $colName) {
                if ($tableMap->hasColumn($colName)) {
                    $get = 'get' . $tableMap->getColumn($colName)->getPhpName();
                    $columns[$colName] = $obj->$get();
                }
            }
        } else {

        }

        return BasePeer::doValidate(BonPlanBonPlanCategoriePeer::DATABASE_NAME, BonPlanBonPlanCategoriePeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve object using using composite pkey values.
     * @param   int $bon_plan_id
     * @param   int $bon_plan_categorie_id
     * @param      PropelPDO $con
     * @return   BonPlanBonPlanCategorie
     */
    public static function retrieveByPK($bon_plan_id, $bon_plan_categorie_id, PropelPDO $con = null) {
        $_instancePoolKey = serialize(array((string) $bon_plan_id, (string) $bon_plan_categorie_id));
         if (null !== ($obj = BonPlanBonPlanCategoriePeer::getInstanceFromPool($_instancePoolKey))) {
             return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(BonPlanBonPlanCategoriePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $criteria = new Criteria(BonPlanBonPlanCategoriePeer::DATABASE_NAME);
        $criteria->add(BonPlanBonPlanCategoriePeer::BON_PLAN_ID, $bon_plan_id);
        $criteria->add(BonPlanBonPlanCategoriePeer::BON_PLAN_CATEGORIE_ID, $bon_plan_categorie_id);
        $v = BonPlanBonPlanCategoriePeer::doSelect($criteria, $con);

        return !empty($v) ? $v[0] : null;
    }
    // sortable behavior

    /**
     * Get the highest rank
     *
     * @param      int $scope		Scope to determine which suite to consider
     * @param     PropelPDO optional connection
     *
     * @return    integer highest position
     */
    public static function getMaxRank($scope = null, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(BonPlanBonPlanCategoriePeer::DATABASE_NAME);
        }
        // shift the objects with a position lower than the one of object
        $c = new Criteria();
        $c->addSelectColumn('MAX(' . BonPlanBonPlanCategoriePeer::RANK_COL . ')');
        $c->add(BonPlanBonPlanCategoriePeer::SCOPE_COL, $scope, Criteria::EQUAL);
        $stmt = BonPlanBonPlanCategoriePeer::doSelectStmt($c, $con);

        return $stmt->fetchColumn();
    }

    /**
     * Get an item from the list based on its rank
     *
     * @param     integer   $rank rank
     * @param      int $scope		Scope to determine which suite to consider
     * @param     PropelPDO $con optional connection
     *
     * @return BonPlanBonPlanCategorie
     */
    public static function retrieveByRank($rank, $scope = null, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(BonPlanBonPlanCategoriePeer::DATABASE_NAME);
        }

        $c = new Criteria;
        $c->add(BonPlanBonPlanCategoriePeer::RANK_COL, $rank);
        $c->add(BonPlanBonPlanCategoriePeer::SCOPE_COL, $scope, Criteria::EQUAL);

        return BonPlanBonPlanCategoriePeer::doSelectOne($c, $con);
    }

    /**
     * Reorder a set of sortable objects based on a list of id/position
     * Beware that there is no check made on the positions passed
     * So incoherent positions will result in an incoherent list
     *
     * @param     array     $order id => rank pairs
     * @param     PropelPDO $con   optional connection
     *
     * @return    boolean true if the reordering took place, false if a database problem prevented it
     */
    public static function reorder(array $order, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(BonPlanBonPlanCategoriePeer::DATABASE_NAME);
        }

        $con->beginTransaction();
        try {
            $ids = array_keys($order);
            $objects = BonPlanBonPlanCategoriePeer::retrieveByPKs($ids);
            foreach ($objects as $object) {
                $pk = $object->getPrimaryKey();
                if ($object->getSortableRank() != $order[$pk]) {
                    $object->setSortableRank($order[$pk]);
                    $object->save($con);
                }
            }
            $con->commit();

            return true;
        } catch (PropelException $e) {
            $con->rollback();
            throw $e;
        }
    }

    /**
     * Return an array of sortable objects ordered by position
     *
     * @param     Criteria  $criteria  optional criteria object
     * @param     string    $order     sorting order, to be chosen between Criteria::ASC (default) and Criteria::DESC
     * @param     PropelPDO $con       optional connection
     *
     * @return    array list of sortable objects
     */
    public static function doSelectOrderByRank(Criteria $criteria = null, $order = Criteria::ASC, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(BonPlanBonPlanCategoriePeer::DATABASE_NAME);
        }

        if ($criteria === null) {
            $criteria = new Criteria();
        } elseif ($criteria instanceof Criteria) {
            $criteria = clone $criteria;
        }

        $criteria->clearOrderByColumns();

        if ($order == Criteria::ASC) {
            $criteria->addAscendingOrderByColumn(BonPlanBonPlanCategoriePeer::RANK_COL);
        } else {
            $criteria->addDescendingOrderByColumn(BonPlanBonPlanCategoriePeer::RANK_COL);
        }

        return BonPlanBonPlanCategoriePeer::doSelect($criteria, $con);
    }

    /**
     * Return an array of sortable objects in the given scope ordered by position
     *
     * @param     int       $scope  the scope of the list
     * @param     string    $order  sorting order, to be chosen between Criteria::ASC (default) and Criteria::DESC
     * @param     PropelPDO $con    optional connection
     *
     * @return    array list of sortable objects
     */
    public static function retrieveList($scope, $order = Criteria::ASC, PropelPDO $con = null)
    {
        $c = new Criteria();
        $c->add(BonPlanBonPlanCategoriePeer::SCOPE_COL, $scope);

        return BonPlanBonPlanCategoriePeer::doSelectOrderByRank($c, $order, $con);
    }

    /**
     * Return the number of sortable objects in the given scope
     *
     * @param     int       $scope  the scope of the list
     * @param     PropelPDO $con    optional connection
     *
     * @return    array list of sortable objects
     */
    public static function countList($scope, PropelPDO $con = null)
    {
        $c = new Criteria();
        $c->add(BonPlanBonPlanCategoriePeer::SCOPE_COL, $scope);

        return BonPlanBonPlanCategoriePeer::doCount($c, $con);
    }

    /**
     * Deletes the sortable objects in the given scope
     *
     * @param     int       $scope  the scope of the list
     * @param     PropelPDO $con    optional connection
     *
     * @return    int number of deleted objects
     */
    public static function deleteList($scope, PropelPDO $con = null)
    {
        $c = new Criteria();
        $c->add(BonPlanBonPlanCategoriePeer::SCOPE_COL, $scope);

        return BonPlanBonPlanCategoriePeer::doDelete($c, $con);
    }

    /**
     * Adds $delta to all Rank values that are >= $first and <= $last.
     * '$delta' can also be negative.
     *
     * @param      int $delta Value to be shifted by, can be negative
     * @param      int $first First node to be shifted
     * @param      int $last  Last node to be shifted
     * @param      int $scope Scope to use for the shift
     * @param      PropelPDO $con Connection to use.
     */
    public static function shiftRank($delta, $first = null, $last = null, $scope = null, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(BonPlanBonPlanCategoriePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $whereCriteria = BonPlanBonPlanCategorieQuery::create();
        if (null !== $first) {
            $whereCriteria->add(BonPlanBonPlanCategoriePeer::RANK_COL, $first, Criteria::GREATER_EQUAL);
        }
        if (null !== $last) {
            $whereCriteria->addAnd(BonPlanBonPlanCategoriePeer::RANK_COL, $last, Criteria::LESS_EQUAL);
        }
        $whereCriteria->add(BonPlanBonPlanCategoriePeer::SCOPE_COL, $scope, Criteria::EQUAL);

        $valuesCriteria = new Criteria(BonPlanBonPlanCategoriePeer::DATABASE_NAME);
        $valuesCriteria->add(BonPlanBonPlanCategoriePeer::RANK_COL, array('raw' => BonPlanBonPlanCategoriePeer::RANK_COL . ' + ?', 'value' => $delta), Criteria::CUSTOM_EQUAL);

        BasePeer::doUpdate($whereCriteria, $valuesCriteria, $con);
        BonPlanBonPlanCategoriePeer::clearInstancePool();
    }

} // BaseBonPlanBonPlanCategoriePeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseBonPlanBonPlanCategoriePeer::buildTableMap();

