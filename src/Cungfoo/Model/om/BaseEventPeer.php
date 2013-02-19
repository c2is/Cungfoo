<?php

namespace Cungfoo\Model\om;

use \BasePeer;
use \Criteria;
use \PDO;
use \PDOStatement;
use \Propel;
use \PropelException;
use \PropelPDO;
use Cungfoo\Model\EtablissementEventPeer;
use Cungfoo\Model\Event;
use Cungfoo\Model\EventI18nPeer;
use Cungfoo\Model\EventPeer;
use Cungfoo\Model\map\EventTableMap;

/**
 * Base static class for performing query and update operations on the 'event' table.
 *
 *
 *
 * @package propel.generator.Cungfoo.Model.om
 */
abstract class BaseEventPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'cungfoo';

    /** the table name for this class */
    const TABLE_NAME = 'event';

    /** the related Propel class for this table */
    const OM_CLASS = 'Cungfoo\\Model\\Event';

    /** the related TableMap class for this table */
    const TM_CLASS = 'EventTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 19;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 19;

    /** the column name for the id field */
    const ID = 'event.id';

    /** the column name for the code field */
    const CODE = 'event.code';

    /** the column name for the category field */
    const CATEGORY = 'event.category';

    /** the column name for the address field */
    const ADDRESS = 'event.address';

    /** the column name for the address2 field */
    const ADDRESS2 = 'event.address2';

    /** the column name for the zipcode field */
    const ZIPCODE = 'event.zipcode';

    /** the column name for the city field */
    const CITY = 'event.city';

    /** the column name for the geo_coordinate_x field */
    const GEO_COORDINATE_X = 'event.geo_coordinate_x';

    /** the column name for the geo_coordinate_y field */
    const GEO_COORDINATE_Y = 'event.geo_coordinate_y';

    /** the column name for the distance_camping field */
    const DISTANCE_CAMPING = 'event.distance_camping';

    /** the column name for the image field */
    const IMAGE = 'event.image';

    /** the column name for the priority field */
    const PRIORITY = 'event.priority';

    /** the column name for the tel field */
    const TEL = 'event.tel';

    /** the column name for the fax field */
    const FAX = 'event.fax';

    /** the column name for the email field */
    const EMAIL = 'event.email';

    /** the column name for the website field */
    const WEBSITE = 'event.website';

    /** the column name for the created_at field */
    const CREATED_AT = 'event.created_at';

    /** the column name for the updated_at field */
    const UPDATED_AT = 'event.updated_at';

    /** the column name for the active field */
    const ACTIVE = 'event.active';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identiy map to hold any loaded instances of Event objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array Event[]
     */
    public static $instances = array();


    // i18n behavior

    /**
     * The default locale to use for translations
     * @var        string
     */
    const DEFAULT_LOCALE = 'fr';
    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. EventPeer::$fieldNames[EventPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Id', 'Code', 'Category', 'Address', 'Address2', 'Zipcode', 'City', 'GeoCoordinateX', 'GeoCoordinateY', 'DistanceCamping', 'Image', 'Priority', 'Tel', 'Fax', 'Email', 'Website', 'CreatedAt', 'UpdatedAt', 'Active', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'code', 'category', 'address', 'address2', 'zipcode', 'city', 'geoCoordinateX', 'geoCoordinateY', 'distanceCamping', 'image', 'priority', 'tel', 'fax', 'email', 'website', 'createdAt', 'updatedAt', 'active', ),
        BasePeer::TYPE_COLNAME => array (EventPeer::ID, EventPeer::CODE, EventPeer::CATEGORY, EventPeer::ADDRESS, EventPeer::ADDRESS2, EventPeer::ZIPCODE, EventPeer::CITY, EventPeer::GEO_COORDINATE_X, EventPeer::GEO_COORDINATE_Y, EventPeer::DISTANCE_CAMPING, EventPeer::IMAGE, EventPeer::PRIORITY, EventPeer::TEL, EventPeer::FAX, EventPeer::EMAIL, EventPeer::WEBSITE, EventPeer::CREATED_AT, EventPeer::UPDATED_AT, EventPeer::ACTIVE, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID', 'CODE', 'CATEGORY', 'ADDRESS', 'ADDRESS2', 'ZIPCODE', 'CITY', 'GEO_COORDINATE_X', 'GEO_COORDINATE_Y', 'DISTANCE_CAMPING', 'IMAGE', 'PRIORITY', 'TEL', 'FAX', 'EMAIL', 'WEBSITE', 'CREATED_AT', 'UPDATED_AT', 'ACTIVE', ),
        BasePeer::TYPE_FIELDNAME => array ('id', 'code', 'category', 'address', 'address2', 'zipcode', 'city', 'geo_coordinate_x', 'geo_coordinate_y', 'distance_camping', 'image', 'priority', 'tel', 'fax', 'email', 'website', 'created_at', 'updated_at', 'active', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. EventPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Code' => 1, 'Category' => 2, 'Address' => 3, 'Address2' => 4, 'Zipcode' => 5, 'City' => 6, 'GeoCoordinateX' => 7, 'GeoCoordinateY' => 8, 'DistanceCamping' => 9, 'Image' => 10, 'Priority' => 11, 'Tel' => 12, 'Fax' => 13, 'Email' => 14, 'Website' => 15, 'CreatedAt' => 16, 'UpdatedAt' => 17, 'Active' => 18, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'code' => 1, 'category' => 2, 'address' => 3, 'address2' => 4, 'zipcode' => 5, 'city' => 6, 'geoCoordinateX' => 7, 'geoCoordinateY' => 8, 'distanceCamping' => 9, 'image' => 10, 'priority' => 11, 'tel' => 12, 'fax' => 13, 'email' => 14, 'website' => 15, 'createdAt' => 16, 'updatedAt' => 17, 'active' => 18, ),
        BasePeer::TYPE_COLNAME => array (EventPeer::ID => 0, EventPeer::CODE => 1, EventPeer::CATEGORY => 2, EventPeer::ADDRESS => 3, EventPeer::ADDRESS2 => 4, EventPeer::ZIPCODE => 5, EventPeer::CITY => 6, EventPeer::GEO_COORDINATE_X => 7, EventPeer::GEO_COORDINATE_Y => 8, EventPeer::DISTANCE_CAMPING => 9, EventPeer::IMAGE => 10, EventPeer::PRIORITY => 11, EventPeer::TEL => 12, EventPeer::FAX => 13, EventPeer::EMAIL => 14, EventPeer::WEBSITE => 15, EventPeer::CREATED_AT => 16, EventPeer::UPDATED_AT => 17, EventPeer::ACTIVE => 18, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID' => 0, 'CODE' => 1, 'CATEGORY' => 2, 'ADDRESS' => 3, 'ADDRESS2' => 4, 'ZIPCODE' => 5, 'CITY' => 6, 'GEO_COORDINATE_X' => 7, 'GEO_COORDINATE_Y' => 8, 'DISTANCE_CAMPING' => 9, 'IMAGE' => 10, 'PRIORITY' => 11, 'TEL' => 12, 'FAX' => 13, 'EMAIL' => 14, 'WEBSITE' => 15, 'CREATED_AT' => 16, 'UPDATED_AT' => 17, 'ACTIVE' => 18, ),
        BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'code' => 1, 'category' => 2, 'address' => 3, 'address2' => 4, 'zipcode' => 5, 'city' => 6, 'geo_coordinate_x' => 7, 'geo_coordinate_y' => 8, 'distance_camping' => 9, 'image' => 10, 'priority' => 11, 'tel' => 12, 'fax' => 13, 'email' => 14, 'website' => 15, 'created_at' => 16, 'updated_at' => 17, 'active' => 18, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, )
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
        $toNames = EventPeer::getFieldNames($toType);
        $key = isset(EventPeer::$fieldKeys[$fromType][$name]) ? EventPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(EventPeer::$fieldKeys[$fromType], true));
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
        if (!array_key_exists($type, EventPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return EventPeer::$fieldNames[$type];
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
     * @param      string $column The column name for current table. (i.e. EventPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(EventPeer::TABLE_NAME.'.', $alias.'.', $column);
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
            $criteria->addSelectColumn(EventPeer::ID);
            $criteria->addSelectColumn(EventPeer::CODE);
            $criteria->addSelectColumn(EventPeer::CATEGORY);
            $criteria->addSelectColumn(EventPeer::ADDRESS);
            $criteria->addSelectColumn(EventPeer::ADDRESS2);
            $criteria->addSelectColumn(EventPeer::ZIPCODE);
            $criteria->addSelectColumn(EventPeer::CITY);
            $criteria->addSelectColumn(EventPeer::GEO_COORDINATE_X);
            $criteria->addSelectColumn(EventPeer::GEO_COORDINATE_Y);
            $criteria->addSelectColumn(EventPeer::DISTANCE_CAMPING);
            $criteria->addSelectColumn(EventPeer::IMAGE);
            $criteria->addSelectColumn(EventPeer::PRIORITY);
            $criteria->addSelectColumn(EventPeer::TEL);
            $criteria->addSelectColumn(EventPeer::FAX);
            $criteria->addSelectColumn(EventPeer::EMAIL);
            $criteria->addSelectColumn(EventPeer::WEBSITE);
            $criteria->addSelectColumn(EventPeer::CREATED_AT);
            $criteria->addSelectColumn(EventPeer::UPDATED_AT);
            $criteria->addSelectColumn(EventPeer::ACTIVE);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.code');
            $criteria->addSelectColumn($alias . '.category');
            $criteria->addSelectColumn($alias . '.address');
            $criteria->addSelectColumn($alias . '.address2');
            $criteria->addSelectColumn($alias . '.zipcode');
            $criteria->addSelectColumn($alias . '.city');
            $criteria->addSelectColumn($alias . '.geo_coordinate_x');
            $criteria->addSelectColumn($alias . '.geo_coordinate_y');
            $criteria->addSelectColumn($alias . '.distance_camping');
            $criteria->addSelectColumn($alias . '.image');
            $criteria->addSelectColumn($alias . '.priority');
            $criteria->addSelectColumn($alias . '.tel');
            $criteria->addSelectColumn($alias . '.fax');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.website');
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
        $criteria->setPrimaryTableName(EventPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            EventPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(EventPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(EventPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Event
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = EventPeer::doSelect($critcopy, $con);
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
        return EventPeer::populateObjects(EventPeer::doSelectStmt($criteria, $con));
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
            $con = Propel::getConnection(EventPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            EventPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(EventPeer::DATABASE_NAME);

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
     * @param      Event $obj A Event object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getId();
            } // if key === null
            EventPeer::$instances[$key] = $obj;
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
     * @param      mixed $value A Event object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof Event) {
                $key = (string) $value->getId();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Event object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(EventPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return   Event Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(EventPeer::$instances[$key])) {
                return EventPeer::$instances[$key];
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
        EventPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to event
     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in EtablissementEventPeer instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        EtablissementEventPeer::clearInstancePool();
        // Invalidate objects in EventI18nPeer instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        EventI18nPeer::clearInstancePool();
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
        $cls = EventPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = EventPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = EventPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                EventPeer::addInstanceToPool($obj, $key);
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
     * @return array (Event object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = EventPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = EventPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + EventPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = EventPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            EventPeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
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
        return Propel::getDatabaseMap(EventPeer::DATABASE_NAME)->getTable(EventPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseEventPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseEventPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new EventTableMap());
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
        return EventPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a Event or Criteria object.
     *
     * @param      mixed $values Criteria or Event object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(EventPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from Event object
        }

        if ($criteria->containsKey(EventPeer::ID) && $criteria->keyContainsValue(EventPeer::ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.EventPeer::ID.')');
        }


        // Set the correct dbName
        $criteria->setDbName(EventPeer::DATABASE_NAME);

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
     * Performs an UPDATE on the database, given a Event or Criteria object.
     *
     * @param      mixed $values Criteria or Event object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(EventPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(EventPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(EventPeer::ID);
            $value = $criteria->remove(EventPeer::ID);
            if ($value) {
                $selectCriteria->add(EventPeer::ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(EventPeer::TABLE_NAME);
            }

        } else { // $values is Event object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(EventPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the event table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(EventPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(EventPeer::TABLE_NAME, $con, EventPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EventPeer::clearInstancePool();
            EventPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a Event or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or Event object or primary key or array of primary keys
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
            $con = Propel::getConnection(EventPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            EventPeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof Event) { // it's a model object
            // invalidate the cache for this single object
            EventPeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(EventPeer::DATABASE_NAME);
            $criteria->add(EventPeer::ID, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                EventPeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(EventPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            EventPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given Event object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param      Event $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(EventPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(EventPeer::TABLE_NAME);

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

        return BasePeer::doValidate(EventPeer::DATABASE_NAME, EventPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param      int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return Event
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = EventPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(EventPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(EventPeer::DATABASE_NAME);
        $criteria->add(EventPeer::ID, $pk);

        $v = EventPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return Event[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(EventPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(EventPeer::DATABASE_NAME);
            $criteria->add(EventPeer::ID, $pks, Criteria::IN);
            $objs = EventPeer::doSelect($criteria, $con);
        }

        return $objs;
    }

    // crudable behavior

    /**
     * The default locale to use for translations
     * @var        string
     */
    public static function getMetadata(PropelPDO $con = null)
    {
        return \Cungfoo\Model\MetadataQuery::create()
            ->joinWithI18n()
            ->filterByTableRef(EventPeer::TABLE_NAME)
            ->findOne()
        ;
    }
    // seo behavior
    
    /**
     * The default locale to use for translations
     * @var        string
     */
    public static function getSeo(PropelPDO $con = null)
    {
        return \Cungfoo\Model\SeoQuery::create()
            ->joinWithI18n()
            ->filterByTableRef(EventPeer::TABLE_NAME)
            ->findOne()
        ;
    }
} // BaseEventPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseEventPeer::buildTableMap();

