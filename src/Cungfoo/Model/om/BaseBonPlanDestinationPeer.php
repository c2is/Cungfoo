<?php

namespace Cungfoo\Model\om;

use \BasePeer;
use \Criteria;
use \PDO;
use \PDOStatement;
use \Propel;
use \PropelException;
use \PropelPDO;
use Cungfoo\Model\BonPlanDestination;
use Cungfoo\Model\BonPlanDestinationPeer;
use Cungfoo\Model\BonPlanPeer;
use Cungfoo\Model\DestinationPeer;
use Cungfoo\Model\map\BonPlanDestinationTableMap;

/**
 * Base static class for performing query and update operations on the 'bon_plan_destination' table.
 *
 *
 *
 * @package propel.generator.Cungfoo.Model.om
 */
abstract class BaseBonPlanDestinationPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'cungfoo';

    /** the table name for this class */
    const TABLE_NAME = 'bon_plan_destination';

    /** the related Propel class for this table */
    const OM_CLASS = 'Cungfoo\\Model\\BonPlanDestination';

    /** the related TableMap class for this table */
    const TM_CLASS = 'BonPlanDestinationTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 2;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 2;

    /** the column name for the bon_plan_id field */
    const BON_PLAN_ID = 'bon_plan_destination.bon_plan_id';

    /** the column name for the destination_id field */
    const DESTINATION_ID = 'bon_plan_destination.destination_id';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identiy map to hold any loaded instances of BonPlanDestination objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array BonPlanDestination[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. BonPlanDestinationPeer::$fieldNames[BonPlanDestinationPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('BonPlanId', 'DestinationId', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('bonPlanId', 'destinationId', ),
        BasePeer::TYPE_COLNAME => array (BonPlanDestinationPeer::BON_PLAN_ID, BonPlanDestinationPeer::DESTINATION_ID, ),
        BasePeer::TYPE_RAW_COLNAME => array ('BON_PLAN_ID', 'DESTINATION_ID', ),
        BasePeer::TYPE_FIELDNAME => array ('bon_plan_id', 'destination_id', ),
        BasePeer::TYPE_NUM => array (0, 1, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. BonPlanDestinationPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('BonPlanId' => 0, 'DestinationId' => 1, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('bonPlanId' => 0, 'destinationId' => 1, ),
        BasePeer::TYPE_COLNAME => array (BonPlanDestinationPeer::BON_PLAN_ID => 0, BonPlanDestinationPeer::DESTINATION_ID => 1, ),
        BasePeer::TYPE_RAW_COLNAME => array ('BON_PLAN_ID' => 0, 'DESTINATION_ID' => 1, ),
        BasePeer::TYPE_FIELDNAME => array ('bon_plan_id' => 0, 'destination_id' => 1, ),
        BasePeer::TYPE_NUM => array (0, 1, )
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
        $toNames = BonPlanDestinationPeer::getFieldNames($toType);
        $key = isset(BonPlanDestinationPeer::$fieldKeys[$fromType][$name]) ? BonPlanDestinationPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(BonPlanDestinationPeer::$fieldKeys[$fromType], true));
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
        if (!array_key_exists($type, BonPlanDestinationPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return BonPlanDestinationPeer::$fieldNames[$type];
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
     * @param      string $column The column name for current table. (i.e. BonPlanDestinationPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(BonPlanDestinationPeer::TABLE_NAME.'.', $alias.'.', $column);
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
            $criteria->addSelectColumn(BonPlanDestinationPeer::BON_PLAN_ID);
            $criteria->addSelectColumn(BonPlanDestinationPeer::DESTINATION_ID);
        } else {
            $criteria->addSelectColumn($alias . '.bon_plan_id');
            $criteria->addSelectColumn($alias . '.destination_id');
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
        $criteria->setPrimaryTableName(BonPlanDestinationPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            BonPlanDestinationPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(BonPlanDestinationPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(BonPlanDestinationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 BonPlanDestination
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = BonPlanDestinationPeer::doSelect($critcopy, $con);
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
        return BonPlanDestinationPeer::populateObjects(BonPlanDestinationPeer::doSelectStmt($criteria, $con));
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
            $con = Propel::getConnection(BonPlanDestinationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            BonPlanDestinationPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(BonPlanDestinationPeer::DATABASE_NAME);

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
     * @param      BonPlanDestination $obj A BonPlanDestination object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = serialize(array((string) $obj->getBonPlanId(), (string) $obj->getDestinationId()));
            } // if key === null
            BonPlanDestinationPeer::$instances[$key] = $obj;
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
     * @param      mixed $value A BonPlanDestination object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof BonPlanDestination) {
                $key = serialize(array((string) $value->getBonPlanId(), (string) $value->getDestinationId()));
            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key
                $key = serialize(array((string) $value[0], (string) $value[1]));
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or BonPlanDestination object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(BonPlanDestinationPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return   BonPlanDestination Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(BonPlanDestinationPeer::$instances[$key])) {
                return BonPlanDestinationPeer::$instances[$key];
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
        BonPlanDestinationPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to bon_plan_destination
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
        $cls = BonPlanDestinationPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = BonPlanDestinationPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = BonPlanDestinationPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                BonPlanDestinationPeer::addInstanceToPool($obj, $key);
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
     * @return array (BonPlanDestination object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = BonPlanDestinationPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = BonPlanDestinationPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + BonPlanDestinationPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = BonPlanDestinationPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            BonPlanDestinationPeer::addInstanceToPool($obj, $key);
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
        $criteria->setPrimaryTableName(BonPlanDestinationPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            BonPlanDestinationPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(BonPlanDestinationPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(BonPlanDestinationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(BonPlanDestinationPeer::BON_PLAN_ID, BonPlanPeer::ID, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related Destination table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinDestination(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(BonPlanDestinationPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            BonPlanDestinationPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(BonPlanDestinationPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(BonPlanDestinationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(BonPlanDestinationPeer::DESTINATION_ID, DestinationPeer::ID, $join_behavior);

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
     * Selects a collection of BonPlanDestination objects pre-filled with their BonPlan objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of BonPlanDestination objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinBonPlan(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(BonPlanDestinationPeer::DATABASE_NAME);
        }

        BonPlanDestinationPeer::addSelectColumns($criteria);
        $startcol = BonPlanDestinationPeer::NUM_HYDRATE_COLUMNS;
        BonPlanPeer::addSelectColumns($criteria);

        $criteria->addJoin(BonPlanDestinationPeer::BON_PLAN_ID, BonPlanPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = BonPlanDestinationPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = BonPlanDestinationPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = BonPlanDestinationPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                BonPlanDestinationPeer::addInstanceToPool($obj1, $key1);
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

                // Add the $obj1 (BonPlanDestination) to $obj2 (BonPlan)
                $obj2->addBonPlanDestination($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of BonPlanDestination objects pre-filled with their Destination objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of BonPlanDestination objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinDestination(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(BonPlanDestinationPeer::DATABASE_NAME);
        }

        BonPlanDestinationPeer::addSelectColumns($criteria);
        $startcol = BonPlanDestinationPeer::NUM_HYDRATE_COLUMNS;
        DestinationPeer::addSelectColumns($criteria);

        $criteria->addJoin(BonPlanDestinationPeer::DESTINATION_ID, DestinationPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = BonPlanDestinationPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = BonPlanDestinationPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = BonPlanDestinationPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                BonPlanDestinationPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = DestinationPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = DestinationPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = DestinationPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    DestinationPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (BonPlanDestination) to $obj2 (Destination)
                $obj2->addBonPlanDestination($obj1);

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
        $criteria->setPrimaryTableName(BonPlanDestinationPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            BonPlanDestinationPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(BonPlanDestinationPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(BonPlanDestinationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(BonPlanDestinationPeer::BON_PLAN_ID, BonPlanPeer::ID, $join_behavior);

        $criteria->addJoin(BonPlanDestinationPeer::DESTINATION_ID, DestinationPeer::ID, $join_behavior);

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
     * Selects a collection of BonPlanDestination objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of BonPlanDestination objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(BonPlanDestinationPeer::DATABASE_NAME);
        }

        BonPlanDestinationPeer::addSelectColumns($criteria);
        $startcol2 = BonPlanDestinationPeer::NUM_HYDRATE_COLUMNS;

        BonPlanPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + BonPlanPeer::NUM_HYDRATE_COLUMNS;

        DestinationPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + DestinationPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(BonPlanDestinationPeer::BON_PLAN_ID, BonPlanPeer::ID, $join_behavior);

        $criteria->addJoin(BonPlanDestinationPeer::DESTINATION_ID, DestinationPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = BonPlanDestinationPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = BonPlanDestinationPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = BonPlanDestinationPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                BonPlanDestinationPeer::addInstanceToPool($obj1, $key1);
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

                // Add the $obj1 (BonPlanDestination) to the collection in $obj2 (BonPlan)
                $obj2->addBonPlanDestination($obj1);
            } // if joined row not null

            // Add objects for joined Destination rows

            $key3 = DestinationPeer::getPrimaryKeyHashFromRow($row, $startcol3);
            if ($key3 !== null) {
                $obj3 = DestinationPeer::getInstanceFromPool($key3);
                if (!$obj3) {

                    $cls = DestinationPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    DestinationPeer::addInstanceToPool($obj3, $key3);
                } // if obj3 loaded

                // Add the $obj1 (BonPlanDestination) to the collection in $obj3 (Destination)
                $obj3->addBonPlanDestination($obj1);
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
        $criteria->setPrimaryTableName(BonPlanDestinationPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            BonPlanDestinationPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(BonPlanDestinationPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(BonPlanDestinationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(BonPlanDestinationPeer::DESTINATION_ID, DestinationPeer::ID, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related Destination table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptDestination(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(BonPlanDestinationPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            BonPlanDestinationPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(BonPlanDestinationPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(BonPlanDestinationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(BonPlanDestinationPeer::BON_PLAN_ID, BonPlanPeer::ID, $join_behavior);

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
     * Selects a collection of BonPlanDestination objects pre-filled with all related objects except BonPlan.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of BonPlanDestination objects.
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
            $criteria->setDbName(BonPlanDestinationPeer::DATABASE_NAME);
        }

        BonPlanDestinationPeer::addSelectColumns($criteria);
        $startcol2 = BonPlanDestinationPeer::NUM_HYDRATE_COLUMNS;

        DestinationPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + DestinationPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(BonPlanDestinationPeer::DESTINATION_ID, DestinationPeer::ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = BonPlanDestinationPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = BonPlanDestinationPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = BonPlanDestinationPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                BonPlanDestinationPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined Destination rows

                $key2 = DestinationPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = DestinationPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = DestinationPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    DestinationPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (BonPlanDestination) to the collection in $obj2 (Destination)
                $obj2->addBonPlanDestination($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of BonPlanDestination objects pre-filled with all related objects except Destination.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of BonPlanDestination objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptDestination(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(BonPlanDestinationPeer::DATABASE_NAME);
        }

        BonPlanDestinationPeer::addSelectColumns($criteria);
        $startcol2 = BonPlanDestinationPeer::NUM_HYDRATE_COLUMNS;

        BonPlanPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + BonPlanPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(BonPlanDestinationPeer::BON_PLAN_ID, BonPlanPeer::ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = BonPlanDestinationPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = BonPlanDestinationPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = BonPlanDestinationPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                BonPlanDestinationPeer::addInstanceToPool($obj1, $key1);
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

                // Add the $obj1 (BonPlanDestination) to the collection in $obj2 (BonPlan)
                $obj2->addBonPlanDestination($obj1);

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
        return Propel::getDatabaseMap(BonPlanDestinationPeer::DATABASE_NAME)->getTable(BonPlanDestinationPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseBonPlanDestinationPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseBonPlanDestinationPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new BonPlanDestinationTableMap());
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
        return BonPlanDestinationPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a BonPlanDestination or Criteria object.
     *
     * @param      mixed $values Criteria or BonPlanDestination object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(BonPlanDestinationPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from BonPlanDestination object
        }


        // Set the correct dbName
        $criteria->setDbName(BonPlanDestinationPeer::DATABASE_NAME);

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
     * Performs an UPDATE on the database, given a BonPlanDestination or Criteria object.
     *
     * @param      mixed $values Criteria or BonPlanDestination object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(BonPlanDestinationPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(BonPlanDestinationPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(BonPlanDestinationPeer::BON_PLAN_ID);
            $value = $criteria->remove(BonPlanDestinationPeer::BON_PLAN_ID);
            if ($value) {
                $selectCriteria->add(BonPlanDestinationPeer::BON_PLAN_ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(BonPlanDestinationPeer::TABLE_NAME);
            }

            $comparison = $criteria->getComparison(BonPlanDestinationPeer::DESTINATION_ID);
            $value = $criteria->remove(BonPlanDestinationPeer::DESTINATION_ID);
            if ($value) {
                $selectCriteria->add(BonPlanDestinationPeer::DESTINATION_ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(BonPlanDestinationPeer::TABLE_NAME);
            }

        } else { // $values is BonPlanDestination object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(BonPlanDestinationPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the bon_plan_destination table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(BonPlanDestinationPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(BonPlanDestinationPeer::TABLE_NAME, $con, BonPlanDestinationPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BonPlanDestinationPeer::clearInstancePool();
            BonPlanDestinationPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a BonPlanDestination or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or BonPlanDestination object or primary key or array of primary keys
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
            $con = Propel::getConnection(BonPlanDestinationPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            BonPlanDestinationPeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof BonPlanDestination) { // it's a model object
            // invalidate the cache for this single object
            BonPlanDestinationPeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(BonPlanDestinationPeer::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = array($values);
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(BonPlanDestinationPeer::BON_PLAN_ID, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(BonPlanDestinationPeer::DESTINATION_ID, $value[1]));
                $criteria->addOr($criterion);
                // we can invalidate the cache for this single PK
                BonPlanDestinationPeer::removeInstanceFromPool($value);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(BonPlanDestinationPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            BonPlanDestinationPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given BonPlanDestination object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param      BonPlanDestination $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(BonPlanDestinationPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(BonPlanDestinationPeer::TABLE_NAME);

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

        return BasePeer::doValidate(BonPlanDestinationPeer::DATABASE_NAME, BonPlanDestinationPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve object using using composite pkey values.
     * @param   int $bon_plan_id
     * @param   int $destination_id
     * @param      PropelPDO $con
     * @return   BonPlanDestination
     */
    public static function retrieveByPK($bon_plan_id, $destination_id, PropelPDO $con = null) {
        $_instancePoolKey = serialize(array((string) $bon_plan_id, (string) $destination_id));
         if (null !== ($obj = BonPlanDestinationPeer::getInstanceFromPool($_instancePoolKey))) {
             return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(BonPlanDestinationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $criteria = new Criteria(BonPlanDestinationPeer::DATABASE_NAME);
        $criteria->add(BonPlanDestinationPeer::BON_PLAN_ID, $bon_plan_id);
        $criteria->add(BonPlanDestinationPeer::DESTINATION_ID, $destination_id);
        $v = BonPlanDestinationPeer::doSelect($criteria, $con);

        return !empty($v) ? $v[0] : null;
    }
} // BaseBonPlanDestinationPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseBonPlanDestinationPeer::buildTableMap();

