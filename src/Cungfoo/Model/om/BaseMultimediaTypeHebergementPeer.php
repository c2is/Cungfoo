<?php

namespace Cungfoo\Model\om;

use \BasePeer;
use \Criteria;
use \PDO;
use \PDOStatement;
use \Propel;
use \PropelException;
use \PropelPDO;
use Cungfoo\Model\MultimediaTypeHebergement;
use Cungfoo\Model\MultimediaTypeHebergementI18nPeer;
use Cungfoo\Model\MultimediaTypeHebergementPeer;
use Cungfoo\Model\TypeHebergementPeer;
use Cungfoo\Model\map\MultimediaTypeHebergementTableMap;

/**
 * Base static class for performing query and update operations on the 'multimedia_type_hebergement' table.
 *
 *
 *
 * @package propel.generator.Cungfoo.Model.om
 */
abstract class BaseMultimediaTypeHebergementPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'cungfoo';

    /** the table name for this class */
    const TABLE_NAME = 'multimedia_type_hebergement';

    /** the related Propel class for this table */
    const OM_CLASS = 'Cungfoo\\Model\\MultimediaTypeHebergement';

    /** the related TableMap class for this table */
    const TM_CLASS = 'MultimediaTypeHebergementTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 6;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 6;

    /** the column name for the id field */
    const ID = 'multimedia_type_hebergement.id';

    /** the column name for the type_hebergement_id field */
    const TYPE_HEBERGEMENT_ID = 'multimedia_type_hebergement.type_hebergement_id';

    /** the column name for the image_path field */
    const IMAGE_PATH = 'multimedia_type_hebergement.image_path';

    /** the column name for the created_at field */
    const CREATED_AT = 'multimedia_type_hebergement.created_at';

    /** the column name for the updated_at field */
    const UPDATED_AT = 'multimedia_type_hebergement.updated_at';

    /** the column name for the active field */
    const ACTIVE = 'multimedia_type_hebergement.active';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identiy map to hold any loaded instances of MultimediaTypeHebergement objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array MultimediaTypeHebergement[]
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
     * e.g. MultimediaTypeHebergementPeer::$fieldNames[MultimediaTypeHebergementPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Id', 'TypeHebergementId', 'ImagePath', 'CreatedAt', 'UpdatedAt', 'Active', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'typeHebergementId', 'imagePath', 'createdAt', 'updatedAt', 'active', ),
        BasePeer::TYPE_COLNAME => array (MultimediaTypeHebergementPeer::ID, MultimediaTypeHebergementPeer::TYPE_HEBERGEMENT_ID, MultimediaTypeHebergementPeer::IMAGE_PATH, MultimediaTypeHebergementPeer::CREATED_AT, MultimediaTypeHebergementPeer::UPDATED_AT, MultimediaTypeHebergementPeer::ACTIVE, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID', 'TYPE_HEBERGEMENT_ID', 'IMAGE_PATH', 'CREATED_AT', 'UPDATED_AT', 'ACTIVE', ),
        BasePeer::TYPE_FIELDNAME => array ('id', 'type_hebergement_id', 'image_path', 'created_at', 'updated_at', 'active', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. MultimediaTypeHebergementPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'TypeHebergementId' => 1, 'ImagePath' => 2, 'CreatedAt' => 3, 'UpdatedAt' => 4, 'Active' => 5, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'typeHebergementId' => 1, 'imagePath' => 2, 'createdAt' => 3, 'updatedAt' => 4, 'active' => 5, ),
        BasePeer::TYPE_COLNAME => array (MultimediaTypeHebergementPeer::ID => 0, MultimediaTypeHebergementPeer::TYPE_HEBERGEMENT_ID => 1, MultimediaTypeHebergementPeer::IMAGE_PATH => 2, MultimediaTypeHebergementPeer::CREATED_AT => 3, MultimediaTypeHebergementPeer::UPDATED_AT => 4, MultimediaTypeHebergementPeer::ACTIVE => 5, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID' => 0, 'TYPE_HEBERGEMENT_ID' => 1, 'IMAGE_PATH' => 2, 'CREATED_AT' => 3, 'UPDATED_AT' => 4, 'ACTIVE' => 5, ),
        BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'type_hebergement_id' => 1, 'image_path' => 2, 'created_at' => 3, 'updated_at' => 4, 'active' => 5, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
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
        $toNames = MultimediaTypeHebergementPeer::getFieldNames($toType);
        $key = isset(MultimediaTypeHebergementPeer::$fieldKeys[$fromType][$name]) ? MultimediaTypeHebergementPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(MultimediaTypeHebergementPeer::$fieldKeys[$fromType], true));
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
        if (!array_key_exists($type, MultimediaTypeHebergementPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return MultimediaTypeHebergementPeer::$fieldNames[$type];
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
     * @param      string $column The column name for current table. (i.e. MultimediaTypeHebergementPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(MultimediaTypeHebergementPeer::TABLE_NAME.'.', $alias.'.', $column);
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
            $criteria->addSelectColumn(MultimediaTypeHebergementPeer::ID);
            $criteria->addSelectColumn(MultimediaTypeHebergementPeer::TYPE_HEBERGEMENT_ID);
            $criteria->addSelectColumn(MultimediaTypeHebergementPeer::IMAGE_PATH);
            $criteria->addSelectColumn(MultimediaTypeHebergementPeer::CREATED_AT);
            $criteria->addSelectColumn(MultimediaTypeHebergementPeer::UPDATED_AT);
            $criteria->addSelectColumn(MultimediaTypeHebergementPeer::ACTIVE);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.type_hebergement_id');
            $criteria->addSelectColumn($alias . '.image_path');
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
        $criteria->setPrimaryTableName(MultimediaTypeHebergementPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            MultimediaTypeHebergementPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(MultimediaTypeHebergementPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(MultimediaTypeHebergementPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 MultimediaTypeHebergement
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = MultimediaTypeHebergementPeer::doSelect($critcopy, $con);
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
        return MultimediaTypeHebergementPeer::populateObjects(MultimediaTypeHebergementPeer::doSelectStmt($criteria, $con));
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
            $con = Propel::getConnection(MultimediaTypeHebergementPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            MultimediaTypeHebergementPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(MultimediaTypeHebergementPeer::DATABASE_NAME);

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
     * @param      MultimediaTypeHebergement $obj A MultimediaTypeHebergement object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getId();
            } // if key === null
            MultimediaTypeHebergementPeer::$instances[$key] = $obj;
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
     * @param      mixed $value A MultimediaTypeHebergement object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof MultimediaTypeHebergement) {
                $key = (string) $value->getId();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or MultimediaTypeHebergement object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(MultimediaTypeHebergementPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return   MultimediaTypeHebergement Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(MultimediaTypeHebergementPeer::$instances[$key])) {
                return MultimediaTypeHebergementPeer::$instances[$key];
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
        MultimediaTypeHebergementPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to multimedia_type_hebergement
     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in MultimediaTypeHebergementI18nPeer instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        MultimediaTypeHebergementI18nPeer::clearInstancePool();
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
        $cls = MultimediaTypeHebergementPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = MultimediaTypeHebergementPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = MultimediaTypeHebergementPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                MultimediaTypeHebergementPeer::addInstanceToPool($obj, $key);
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
     * @return array (MultimediaTypeHebergement object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = MultimediaTypeHebergementPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = MultimediaTypeHebergementPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + MultimediaTypeHebergementPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = MultimediaTypeHebergementPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            MultimediaTypeHebergementPeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }


    /**
     * Returns the number of rows matching criteria, joining the related TypeHebergement table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinTypeHebergement(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(MultimediaTypeHebergementPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            MultimediaTypeHebergementPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(MultimediaTypeHebergementPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(MultimediaTypeHebergementPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(MultimediaTypeHebergementPeer::TYPE_HEBERGEMENT_ID, TypeHebergementPeer::ID, $join_behavior);

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
     * Selects a collection of MultimediaTypeHebergement objects pre-filled with their TypeHebergement objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of MultimediaTypeHebergement objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinTypeHebergement(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(MultimediaTypeHebergementPeer::DATABASE_NAME);
        }

        MultimediaTypeHebergementPeer::addSelectColumns($criteria);
        $startcol = MultimediaTypeHebergementPeer::NUM_HYDRATE_COLUMNS;
        TypeHebergementPeer::addSelectColumns($criteria);

        $criteria->addJoin(MultimediaTypeHebergementPeer::TYPE_HEBERGEMENT_ID, TypeHebergementPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = MultimediaTypeHebergementPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = MultimediaTypeHebergementPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = MultimediaTypeHebergementPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                MultimediaTypeHebergementPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = TypeHebergementPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = TypeHebergementPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = TypeHebergementPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    TypeHebergementPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (MultimediaTypeHebergement) to $obj2 (TypeHebergement)
                $obj2->addMultimediaTypeHebergement($obj1);

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
        $criteria->setPrimaryTableName(MultimediaTypeHebergementPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            MultimediaTypeHebergementPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(MultimediaTypeHebergementPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(MultimediaTypeHebergementPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(MultimediaTypeHebergementPeer::TYPE_HEBERGEMENT_ID, TypeHebergementPeer::ID, $join_behavior);

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
     * Selects a collection of MultimediaTypeHebergement objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of MultimediaTypeHebergement objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(MultimediaTypeHebergementPeer::DATABASE_NAME);
        }

        MultimediaTypeHebergementPeer::addSelectColumns($criteria);
        $startcol2 = MultimediaTypeHebergementPeer::NUM_HYDRATE_COLUMNS;

        TypeHebergementPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + TypeHebergementPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(MultimediaTypeHebergementPeer::TYPE_HEBERGEMENT_ID, TypeHebergementPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = MultimediaTypeHebergementPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = MultimediaTypeHebergementPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = MultimediaTypeHebergementPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                MultimediaTypeHebergementPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

            // Add objects for joined TypeHebergement rows

            $key2 = TypeHebergementPeer::getPrimaryKeyHashFromRow($row, $startcol2);
            if ($key2 !== null) {
                $obj2 = TypeHebergementPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = TypeHebergementPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    TypeHebergementPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 loaded

                // Add the $obj1 (MultimediaTypeHebergement) to the collection in $obj2 (TypeHebergement)
                $obj2->addMultimediaTypeHebergement($obj1);
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
        return Propel::getDatabaseMap(MultimediaTypeHebergementPeer::DATABASE_NAME)->getTable(MultimediaTypeHebergementPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseMultimediaTypeHebergementPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseMultimediaTypeHebergementPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new MultimediaTypeHebergementTableMap());
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
        return MultimediaTypeHebergementPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a MultimediaTypeHebergement or Criteria object.
     *
     * @param      mixed $values Criteria or MultimediaTypeHebergement object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(MultimediaTypeHebergementPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from MultimediaTypeHebergement object
        }

        if ($criteria->containsKey(MultimediaTypeHebergementPeer::ID) && $criteria->keyContainsValue(MultimediaTypeHebergementPeer::ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.MultimediaTypeHebergementPeer::ID.')');
        }


        // Set the correct dbName
        $criteria->setDbName(MultimediaTypeHebergementPeer::DATABASE_NAME);

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
     * Performs an UPDATE on the database, given a MultimediaTypeHebergement or Criteria object.
     *
     * @param      mixed $values Criteria or MultimediaTypeHebergement object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(MultimediaTypeHebergementPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(MultimediaTypeHebergementPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(MultimediaTypeHebergementPeer::ID);
            $value = $criteria->remove(MultimediaTypeHebergementPeer::ID);
            if ($value) {
                $selectCriteria->add(MultimediaTypeHebergementPeer::ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(MultimediaTypeHebergementPeer::TABLE_NAME);
            }

        } else { // $values is MultimediaTypeHebergement object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(MultimediaTypeHebergementPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the multimedia_type_hebergement table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(MultimediaTypeHebergementPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(MultimediaTypeHebergementPeer::TABLE_NAME, $con, MultimediaTypeHebergementPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            MultimediaTypeHebergementPeer::clearInstancePool();
            MultimediaTypeHebergementPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a MultimediaTypeHebergement or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or MultimediaTypeHebergement object or primary key or array of primary keys
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
            $con = Propel::getConnection(MultimediaTypeHebergementPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            MultimediaTypeHebergementPeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof MultimediaTypeHebergement) { // it's a model object
            // invalidate the cache for this single object
            MultimediaTypeHebergementPeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(MultimediaTypeHebergementPeer::DATABASE_NAME);
            $criteria->add(MultimediaTypeHebergementPeer::ID, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                MultimediaTypeHebergementPeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(MultimediaTypeHebergementPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            MultimediaTypeHebergementPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given MultimediaTypeHebergement object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param      MultimediaTypeHebergement $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(MultimediaTypeHebergementPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(MultimediaTypeHebergementPeer::TABLE_NAME);

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

        return BasePeer::doValidate(MultimediaTypeHebergementPeer::DATABASE_NAME, MultimediaTypeHebergementPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param      int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return MultimediaTypeHebergement
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = MultimediaTypeHebergementPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(MultimediaTypeHebergementPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(MultimediaTypeHebergementPeer::DATABASE_NAME);
        $criteria->add(MultimediaTypeHebergementPeer::ID, $pk);

        $v = MultimediaTypeHebergementPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return MultimediaTypeHebergement[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(MultimediaTypeHebergementPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(MultimediaTypeHebergementPeer::DATABASE_NAME);
            $criteria->add(MultimediaTypeHebergementPeer::ID, $pks, Criteria::IN);
            $objs = MultimediaTypeHebergementPeer::doSelect($criteria, $con);
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
            ->filterByTableRef(MultimediaTypeHebergementPeer::TABLE_NAME)
            ->findOne()
        ;
    }
} // BaseMultimediaTypeHebergementPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseMultimediaTypeHebergementPeer::buildTableMap();

