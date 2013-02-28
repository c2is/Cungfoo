<?php

namespace Cungfoo\Model\om;

use \BasePeer;
use \Criteria;
use \PDO;
use \PDOStatement;
use \Propel;
use \PropelException;
use \PropelPDO;
use Cungfoo\Model\PortfolioMediaPeer;
use Cungfoo\Model\PortfolioUsage;
use Cungfoo\Model\PortfolioUsagePeer;
use Cungfoo\Model\map\PortfolioUsageTableMap;

/**
 * Base static class for performing query and update operations on the 'portfolio_usage' table.
 *
 *
 *
 * @package propel.generator.Cungfoo.Model.om
 */
abstract class BasePortfolioUsagePeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'cungfoo';

    /** the table name for this class */
    const TABLE_NAME = 'portfolio_usage';

    /** the related Propel class for this table */
    const OM_CLASS = 'Cungfoo\\Model\\PortfolioUsage';

    /** the related TableMap class for this table */
    const TM_CLASS = 'PortfolioUsageTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 8;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 8;

    /** the column name for the id field */
    const ID = 'portfolio_usage.id';

    /** the column name for the media_id field */
    const MEDIA_ID = 'portfolio_usage.media_id';

    /** the column name for the table_ref field */
    const TABLE_REF = 'portfolio_usage.table_ref';

    /** the column name for the column_ref field */
    const COLUMN_REF = 'portfolio_usage.column_ref';

    /** the column name for the element_id field */
    const ELEMENT_ID = 'portfolio_usage.element_id';

    /** the column name for the created_at field */
    const CREATED_AT = 'portfolio_usage.created_at';

    /** the column name for the updated_at field */
    const UPDATED_AT = 'portfolio_usage.updated_at';

    /** the column name for the active field */
    const ACTIVE = 'portfolio_usage.active';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identiy map to hold any loaded instances of PortfolioUsage objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array PortfolioUsage[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. PortfolioUsagePeer::$fieldNames[PortfolioUsagePeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Id', 'MediaId', 'TableRef', 'ColumnRef', 'ElementId', 'CreatedAt', 'UpdatedAt', 'Active', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'mediaId', 'tableRef', 'columnRef', 'elementId', 'createdAt', 'updatedAt', 'active', ),
        BasePeer::TYPE_COLNAME => array (PortfolioUsagePeer::ID, PortfolioUsagePeer::MEDIA_ID, PortfolioUsagePeer::TABLE_REF, PortfolioUsagePeer::COLUMN_REF, PortfolioUsagePeer::ELEMENT_ID, PortfolioUsagePeer::CREATED_AT, PortfolioUsagePeer::UPDATED_AT, PortfolioUsagePeer::ACTIVE, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID', 'MEDIA_ID', 'TABLE_REF', 'COLUMN_REF', 'ELEMENT_ID', 'CREATED_AT', 'UPDATED_AT', 'ACTIVE', ),
        BasePeer::TYPE_FIELDNAME => array ('id', 'media_id', 'table_ref', 'column_ref', 'element_id', 'created_at', 'updated_at', 'active', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. PortfolioUsagePeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'MediaId' => 1, 'TableRef' => 2, 'ColumnRef' => 3, 'ElementId' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, 'Active' => 7, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'mediaId' => 1, 'tableRef' => 2, 'columnRef' => 3, 'elementId' => 4, 'createdAt' => 5, 'updatedAt' => 6, 'active' => 7, ),
        BasePeer::TYPE_COLNAME => array (PortfolioUsagePeer::ID => 0, PortfolioUsagePeer::MEDIA_ID => 1, PortfolioUsagePeer::TABLE_REF => 2, PortfolioUsagePeer::COLUMN_REF => 3, PortfolioUsagePeer::ELEMENT_ID => 4, PortfolioUsagePeer::CREATED_AT => 5, PortfolioUsagePeer::UPDATED_AT => 6, PortfolioUsagePeer::ACTIVE => 7, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID' => 0, 'MEDIA_ID' => 1, 'TABLE_REF' => 2, 'COLUMN_REF' => 3, 'ELEMENT_ID' => 4, 'CREATED_AT' => 5, 'UPDATED_AT' => 6, 'ACTIVE' => 7, ),
        BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'media_id' => 1, 'table_ref' => 2, 'column_ref' => 3, 'element_id' => 4, 'created_at' => 5, 'updated_at' => 6, 'active' => 7, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
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
        $toNames = PortfolioUsagePeer::getFieldNames($toType);
        $key = isset(PortfolioUsagePeer::$fieldKeys[$fromType][$name]) ? PortfolioUsagePeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(PortfolioUsagePeer::$fieldKeys[$fromType], true));
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
        if (!array_key_exists($type, PortfolioUsagePeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return PortfolioUsagePeer::$fieldNames[$type];
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
     * @param      string $column The column name for current table. (i.e. PortfolioUsagePeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(PortfolioUsagePeer::TABLE_NAME.'.', $alias.'.', $column);
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
            $criteria->addSelectColumn(PortfolioUsagePeer::ID);
            $criteria->addSelectColumn(PortfolioUsagePeer::MEDIA_ID);
            $criteria->addSelectColumn(PortfolioUsagePeer::TABLE_REF);
            $criteria->addSelectColumn(PortfolioUsagePeer::COLUMN_REF);
            $criteria->addSelectColumn(PortfolioUsagePeer::ELEMENT_ID);
            $criteria->addSelectColumn(PortfolioUsagePeer::CREATED_AT);
            $criteria->addSelectColumn(PortfolioUsagePeer::UPDATED_AT);
            $criteria->addSelectColumn(PortfolioUsagePeer::ACTIVE);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.media_id');
            $criteria->addSelectColumn($alias . '.table_ref');
            $criteria->addSelectColumn($alias . '.column_ref');
            $criteria->addSelectColumn($alias . '.element_id');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.active');
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
        $criteria->setPrimaryTableName(PortfolioUsagePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            PortfolioUsagePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(PortfolioUsagePeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(PortfolioUsagePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 PortfolioUsage
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = PortfolioUsagePeer::doSelect($critcopy, $con);
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
        return PortfolioUsagePeer::populateObjects(PortfolioUsagePeer::doSelectStmt($criteria, $con));
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
            $con = Propel::getConnection(PortfolioUsagePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            PortfolioUsagePeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(PortfolioUsagePeer::DATABASE_NAME);

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
     * @param      PortfolioUsage $obj A PortfolioUsage object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getId();
            } // if key === null
            PortfolioUsagePeer::$instances[$key] = $obj;
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
     * @param      mixed $value A PortfolioUsage object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof PortfolioUsage) {
                $key = (string) $value->getId();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or PortfolioUsage object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(PortfolioUsagePeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return   PortfolioUsage Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(PortfolioUsagePeer::$instances[$key])) {
                return PortfolioUsagePeer::$instances[$key];
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
        PortfolioUsagePeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to portfolio_usage
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
        if ($row[$startcol] === null) {
            return null;
        }

        return (string) $row[$startcol];
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

        return (int) $row[$startcol];
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
        $cls = PortfolioUsagePeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = PortfolioUsagePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = PortfolioUsagePeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PortfolioUsagePeer::addInstanceToPool($obj, $key);
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
     * @return array (PortfolioUsage object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = PortfolioUsagePeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = PortfolioUsagePeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + PortfolioUsagePeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PortfolioUsagePeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            PortfolioUsagePeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }


    /**
     * Returns the number of rows matching criteria, joining the related PortfolioMedia table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinPortfolioMedia(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(PortfolioUsagePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            PortfolioUsagePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(PortfolioUsagePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(PortfolioUsagePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(PortfolioUsagePeer::MEDIA_ID, PortfolioMediaPeer::ID, $join_behavior);

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
     * Selects a collection of PortfolioUsage objects pre-filled with their PortfolioMedia objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of PortfolioUsage objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinPortfolioMedia(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(PortfolioUsagePeer::DATABASE_NAME);
        }

        PortfolioUsagePeer::addSelectColumns($criteria);
        $startcol = PortfolioUsagePeer::NUM_HYDRATE_COLUMNS;
        PortfolioMediaPeer::addSelectColumns($criteria);

        $criteria->addJoin(PortfolioUsagePeer::MEDIA_ID, PortfolioMediaPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = PortfolioUsagePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = PortfolioUsagePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = PortfolioUsagePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                PortfolioUsagePeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = PortfolioMediaPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = PortfolioMediaPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = PortfolioMediaPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    PortfolioMediaPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (PortfolioUsage) to $obj2 (PortfolioMedia)
                $obj2->addPortfolioUsage($obj1);

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
        $criteria->setPrimaryTableName(PortfolioUsagePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            PortfolioUsagePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(PortfolioUsagePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(PortfolioUsagePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(PortfolioUsagePeer::MEDIA_ID, PortfolioMediaPeer::ID, $join_behavior);

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
     * Selects a collection of PortfolioUsage objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of PortfolioUsage objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(PortfolioUsagePeer::DATABASE_NAME);
        }

        PortfolioUsagePeer::addSelectColumns($criteria);
        $startcol2 = PortfolioUsagePeer::NUM_HYDRATE_COLUMNS;

        PortfolioMediaPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + PortfolioMediaPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(PortfolioUsagePeer::MEDIA_ID, PortfolioMediaPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = PortfolioUsagePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = PortfolioUsagePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = PortfolioUsagePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                PortfolioUsagePeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

            // Add objects for joined PortfolioMedia rows

            $key2 = PortfolioMediaPeer::getPrimaryKeyHashFromRow($row, $startcol2);
            if ($key2 !== null) {
                $obj2 = PortfolioMediaPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = PortfolioMediaPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    PortfolioMediaPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 loaded

                // Add the $obj1 (PortfolioUsage) to the collection in $obj2 (PortfolioMedia)
                $obj2->addPortfolioUsage($obj1);
            } // if joined row not null

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
        return Propel::getDatabaseMap(PortfolioUsagePeer::DATABASE_NAME)->getTable(PortfolioUsagePeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BasePortfolioUsagePeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BasePortfolioUsagePeer::TABLE_NAME)) {
        $dbMap->addTableObject(new PortfolioUsageTableMap());
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
        return PortfolioUsagePeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a PortfolioUsage or Criteria object.
     *
     * @param      mixed $values Criteria or PortfolioUsage object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(PortfolioUsagePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from PortfolioUsage object
        }

        if ($criteria->containsKey(PortfolioUsagePeer::ID) && $criteria->keyContainsValue(PortfolioUsagePeer::ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.PortfolioUsagePeer::ID.')');
        }


        // Set the correct dbName
        $criteria->setDbName(PortfolioUsagePeer::DATABASE_NAME);

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
     * Performs an UPDATE on the database, given a PortfolioUsage or Criteria object.
     *
     * @param      mixed $values Criteria or PortfolioUsage object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(PortfolioUsagePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(PortfolioUsagePeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(PortfolioUsagePeer::ID);
            $value = $criteria->remove(PortfolioUsagePeer::ID);
            if ($value) {
                $selectCriteria->add(PortfolioUsagePeer::ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(PortfolioUsagePeer::TABLE_NAME);
            }

        } else { // $values is PortfolioUsage object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(PortfolioUsagePeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the portfolio_usage table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(PortfolioUsagePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(PortfolioUsagePeer::TABLE_NAME, $con, PortfolioUsagePeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PortfolioUsagePeer::clearInstancePool();
            PortfolioUsagePeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a PortfolioUsage or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or PortfolioUsage object or primary key or array of primary keys
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
            $con = Propel::getConnection(PortfolioUsagePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            PortfolioUsagePeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof PortfolioUsage) { // it's a model object
            // invalidate the cache for this single object
            PortfolioUsagePeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PortfolioUsagePeer::DATABASE_NAME);
            $criteria->add(PortfolioUsagePeer::ID, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                PortfolioUsagePeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(PortfolioUsagePeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            PortfolioUsagePeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given PortfolioUsage object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param      PortfolioUsage $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(PortfolioUsagePeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(PortfolioUsagePeer::TABLE_NAME);

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

        return BasePeer::doValidate(PortfolioUsagePeer::DATABASE_NAME, PortfolioUsagePeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param      int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return PortfolioUsage
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = PortfolioUsagePeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(PortfolioUsagePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(PortfolioUsagePeer::DATABASE_NAME);
        $criteria->add(PortfolioUsagePeer::ID, $pk);

        $v = PortfolioUsagePeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return PortfolioUsage[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(PortfolioUsagePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(PortfolioUsagePeer::DATABASE_NAME);
            $criteria->add(PortfolioUsagePeer::ID, $pks, Criteria::IN);
            $objs = PortfolioUsagePeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BasePortfolioUsagePeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BasePortfolioUsagePeer::buildTableMap();

