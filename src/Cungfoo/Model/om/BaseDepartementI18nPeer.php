<?php

namespace Cungfoo\Model\om;

use \BasePeer;
use \Criteria;
use \PDO;
use \PDOStatement;
use \Propel;
use \PropelException;
use \PropelPDO;
use Cungfoo\Model\DepartementI18n;
use Cungfoo\Model\DepartementI18nPeer;
use Cungfoo\Model\DepartementPeer;
use Cungfoo\Model\map\DepartementI18nTableMap;

/**
 * Base static class for performing query and update operations on the 'departement_i18n' table.
 *
 *
 *
 * @package propel.generator.Cungfoo.Model.om
 */
abstract class BaseDepartementI18nPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'cungfoo';

    /** the table name for this class */
    const TABLE_NAME = 'departement_i18n';

    /** the related Propel class for this table */
    const OM_CLASS = 'Cungfoo\\Model\\DepartementI18n';

    /** the related TableMap class for this table */
    const TM_CLASS = 'DepartementI18nTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 11;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 11;

    /** the column name for the id field */
    const ID = 'departement_i18n.id';

    /** the column name for the locale field */
    const LOCALE = 'departement_i18n.locale';

    /** the column name for the slug field */
    const SLUG = 'departement_i18n.slug';

    /** the column name for the name field */
    const NAME = 'departement_i18n.name';

    /** the column name for the introduction field */
    const INTRODUCTION = 'departement_i18n.introduction';

    /** the column name for the description field */
    const DESCRIPTION = 'departement_i18n.description';

    /** the column name for the seo_title field */
    const SEO_TITLE = 'departement_i18n.seo_title';

    /** the column name for the seo_description field */
    const SEO_DESCRIPTION = 'departement_i18n.seo_description';

    /** the column name for the seo_h1 field */
    const SEO_H1 = 'departement_i18n.seo_h1';

    /** the column name for the seo_keywords field */
    const SEO_KEYWORDS = 'departement_i18n.seo_keywords';

    /** the column name for the active_locale field */
    const ACTIVE_LOCALE = 'departement_i18n.active_locale';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identiy map to hold any loaded instances of DepartementI18n objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array DepartementI18n[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. DepartementI18nPeer::$fieldNames[DepartementI18nPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Id', 'Locale', 'Slug', 'Name', 'Introduction', 'Description', 'SeoTitle', 'SeoDescription', 'SeoH1', 'SeoKeywords', 'ActiveLocale', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'locale', 'slug', 'name', 'introduction', 'description', 'seoTitle', 'seoDescription', 'seoH1', 'seoKeywords', 'activeLocale', ),
        BasePeer::TYPE_COLNAME => array (DepartementI18nPeer::ID, DepartementI18nPeer::LOCALE, DepartementI18nPeer::SLUG, DepartementI18nPeer::NAME, DepartementI18nPeer::INTRODUCTION, DepartementI18nPeer::DESCRIPTION, DepartementI18nPeer::SEO_TITLE, DepartementI18nPeer::SEO_DESCRIPTION, DepartementI18nPeer::SEO_H1, DepartementI18nPeer::SEO_KEYWORDS, DepartementI18nPeer::ACTIVE_LOCALE, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID', 'LOCALE', 'SLUG', 'NAME', 'INTRODUCTION', 'DESCRIPTION', 'SEO_TITLE', 'SEO_DESCRIPTION', 'SEO_H1', 'SEO_KEYWORDS', 'ACTIVE_LOCALE', ),
        BasePeer::TYPE_FIELDNAME => array ('id', 'locale', 'slug', 'name', 'introduction', 'description', 'seo_title', 'seo_description', 'seo_h1', 'seo_keywords', 'active_locale', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. DepartementI18nPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Locale' => 1, 'Slug' => 2, 'Name' => 3, 'Introduction' => 4, 'Description' => 5, 'SeoTitle' => 6, 'SeoDescription' => 7, 'SeoH1' => 8, 'SeoKeywords' => 9, 'ActiveLocale' => 10, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'locale' => 1, 'slug' => 2, 'name' => 3, 'introduction' => 4, 'description' => 5, 'seoTitle' => 6, 'seoDescription' => 7, 'seoH1' => 8, 'seoKeywords' => 9, 'activeLocale' => 10, ),
        BasePeer::TYPE_COLNAME => array (DepartementI18nPeer::ID => 0, DepartementI18nPeer::LOCALE => 1, DepartementI18nPeer::SLUG => 2, DepartementI18nPeer::NAME => 3, DepartementI18nPeer::INTRODUCTION => 4, DepartementI18nPeer::DESCRIPTION => 5, DepartementI18nPeer::SEO_TITLE => 6, DepartementI18nPeer::SEO_DESCRIPTION => 7, DepartementI18nPeer::SEO_H1 => 8, DepartementI18nPeer::SEO_KEYWORDS => 9, DepartementI18nPeer::ACTIVE_LOCALE => 10, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID' => 0, 'LOCALE' => 1, 'SLUG' => 2, 'NAME' => 3, 'INTRODUCTION' => 4, 'DESCRIPTION' => 5, 'SEO_TITLE' => 6, 'SEO_DESCRIPTION' => 7, 'SEO_H1' => 8, 'SEO_KEYWORDS' => 9, 'ACTIVE_LOCALE' => 10, ),
        BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'locale' => 1, 'slug' => 2, 'name' => 3, 'introduction' => 4, 'description' => 5, 'seo_title' => 6, 'seo_description' => 7, 'seo_h1' => 8, 'seo_keywords' => 9, 'active_locale' => 10, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
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
        $toNames = DepartementI18nPeer::getFieldNames($toType);
        $key = isset(DepartementI18nPeer::$fieldKeys[$fromType][$name]) ? DepartementI18nPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(DepartementI18nPeer::$fieldKeys[$fromType], true));
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
        if (!array_key_exists($type, DepartementI18nPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return DepartementI18nPeer::$fieldNames[$type];
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
     * @param      string $column The column name for current table. (i.e. DepartementI18nPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(DepartementI18nPeer::TABLE_NAME.'.', $alias.'.', $column);
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
            $criteria->addSelectColumn(DepartementI18nPeer::ID);
            $criteria->addSelectColumn(DepartementI18nPeer::LOCALE);
            $criteria->addSelectColumn(DepartementI18nPeer::SLUG);
            $criteria->addSelectColumn(DepartementI18nPeer::NAME);
            $criteria->addSelectColumn(DepartementI18nPeer::INTRODUCTION);
            $criteria->addSelectColumn(DepartementI18nPeer::DESCRIPTION);
            $criteria->addSelectColumn(DepartementI18nPeer::SEO_TITLE);
            $criteria->addSelectColumn(DepartementI18nPeer::SEO_DESCRIPTION);
            $criteria->addSelectColumn(DepartementI18nPeer::SEO_H1);
            $criteria->addSelectColumn(DepartementI18nPeer::SEO_KEYWORDS);
            $criteria->addSelectColumn(DepartementI18nPeer::ACTIVE_LOCALE);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.locale');
            $criteria->addSelectColumn($alias . '.slug');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.introduction');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.seo_title');
            $criteria->addSelectColumn($alias . '.seo_description');
            $criteria->addSelectColumn($alias . '.seo_h1');
            $criteria->addSelectColumn($alias . '.seo_keywords');
            $criteria->addSelectColumn($alias . '.active_locale');
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
        $criteria->setPrimaryTableName(DepartementI18nPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            DepartementI18nPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(DepartementI18nPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(DepartementI18nPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 DepartementI18n
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = DepartementI18nPeer::doSelect($critcopy, $con);
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
        return DepartementI18nPeer::populateObjects(DepartementI18nPeer::doSelectStmt($criteria, $con));
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
            $con = Propel::getConnection(DepartementI18nPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            DepartementI18nPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(DepartementI18nPeer::DATABASE_NAME);

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
     * @param      DepartementI18n $obj A DepartementI18n object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = serialize(array((string) $obj->getId(), (string) $obj->getLocale()));
            } // if key === null
            DepartementI18nPeer::$instances[$key] = $obj;
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
     * @param      mixed $value A DepartementI18n object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof DepartementI18n) {
                $key = serialize(array((string) $value->getId(), (string) $value->getLocale()));
            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key
                $key = serialize(array((string) $value[0], (string) $value[1]));
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or DepartementI18n object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(DepartementI18nPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return   DepartementI18n Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(DepartementI18nPeer::$instances[$key])) {
                return DepartementI18nPeer::$instances[$key];
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
        DepartementI18nPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to departement_i18n
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

        return array((int) $row[$startcol], (string) $row[$startcol + 1]);
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
        $cls = DepartementI18nPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = DepartementI18nPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = DepartementI18nPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                DepartementI18nPeer::addInstanceToPool($obj, $key);
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
     * @return array (DepartementI18n object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = DepartementI18nPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = DepartementI18nPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + DepartementI18nPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = DepartementI18nPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            DepartementI18nPeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }


    /**
     * Returns the number of rows matching criteria, joining the related Departement table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinDepartement(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(DepartementI18nPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            DepartementI18nPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(DepartementI18nPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(DepartementI18nPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(DepartementI18nPeer::ID, DepartementPeer::ID, $join_behavior);

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
     * Selects a collection of DepartementI18n objects pre-filled with their Departement objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of DepartementI18n objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinDepartement(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(DepartementI18nPeer::DATABASE_NAME);
        }

        DepartementI18nPeer::addSelectColumns($criteria);
        $startcol = DepartementI18nPeer::NUM_HYDRATE_COLUMNS;
        DepartementPeer::addSelectColumns($criteria);

        $criteria->addJoin(DepartementI18nPeer::ID, DepartementPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = DepartementI18nPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = DepartementI18nPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = DepartementI18nPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                DepartementI18nPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = DepartementPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = DepartementPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = DepartementPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    DepartementPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (DepartementI18n) to $obj2 (Departement)
                $obj2->addDepartementI18n($obj1);

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
        $criteria->setPrimaryTableName(DepartementI18nPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            DepartementI18nPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(DepartementI18nPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(DepartementI18nPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(DepartementI18nPeer::ID, DepartementPeer::ID, $join_behavior);

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
     * Selects a collection of DepartementI18n objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of DepartementI18n objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(DepartementI18nPeer::DATABASE_NAME);
        }

        DepartementI18nPeer::addSelectColumns($criteria);
        $startcol2 = DepartementI18nPeer::NUM_HYDRATE_COLUMNS;

        DepartementPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + DepartementPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(DepartementI18nPeer::ID, DepartementPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = DepartementI18nPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = DepartementI18nPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = DepartementI18nPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                DepartementI18nPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

            // Add objects for joined Departement rows

            $key2 = DepartementPeer::getPrimaryKeyHashFromRow($row, $startcol2);
            if ($key2 !== null) {
                $obj2 = DepartementPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = DepartementPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    DepartementPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 loaded

                // Add the $obj1 (DepartementI18n) to the collection in $obj2 (Departement)
                $obj2->addDepartementI18n($obj1);
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
        return Propel::getDatabaseMap(DepartementI18nPeer::DATABASE_NAME)->getTable(DepartementI18nPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseDepartementI18nPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseDepartementI18nPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new DepartementI18nTableMap());
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
        return DepartementI18nPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a DepartementI18n or Criteria object.
     *
     * @param      mixed $values Criteria or DepartementI18n object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(DepartementI18nPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from DepartementI18n object
        }


        // Set the correct dbName
        $criteria->setDbName(DepartementI18nPeer::DATABASE_NAME);

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
     * Performs an UPDATE on the database, given a DepartementI18n or Criteria object.
     *
     * @param      mixed $values Criteria or DepartementI18n object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(DepartementI18nPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(DepartementI18nPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(DepartementI18nPeer::ID);
            $value = $criteria->remove(DepartementI18nPeer::ID);
            if ($value) {
                $selectCriteria->add(DepartementI18nPeer::ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(DepartementI18nPeer::TABLE_NAME);
            }

            $comparison = $criteria->getComparison(DepartementI18nPeer::LOCALE);
            $value = $criteria->remove(DepartementI18nPeer::LOCALE);
            if ($value) {
                $selectCriteria->add(DepartementI18nPeer::LOCALE, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(DepartementI18nPeer::TABLE_NAME);
            }

        } else { // $values is DepartementI18n object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(DepartementI18nPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the departement_i18n table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(DepartementI18nPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(DepartementI18nPeer::TABLE_NAME, $con, DepartementI18nPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DepartementI18nPeer::clearInstancePool();
            DepartementI18nPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a DepartementI18n or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or DepartementI18n object or primary key or array of primary keys
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
            $con = Propel::getConnection(DepartementI18nPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            DepartementI18nPeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof DepartementI18n) { // it's a model object
            // invalidate the cache for this single object
            DepartementI18nPeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(DepartementI18nPeer::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = array($values);
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(DepartementI18nPeer::ID, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(DepartementI18nPeer::LOCALE, $value[1]));
                $criteria->addOr($criterion);
                // we can invalidate the cache for this single PK
                DepartementI18nPeer::removeInstanceFromPool($value);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(DepartementI18nPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            DepartementI18nPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given DepartementI18n object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param      DepartementI18n $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(DepartementI18nPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(DepartementI18nPeer::TABLE_NAME);

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

        return BasePeer::doValidate(DepartementI18nPeer::DATABASE_NAME, DepartementI18nPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve object using using composite pkey values.
     * @param   int $id
     * @param   string $locale
     * @param      PropelPDO $con
     * @return   DepartementI18n
     */
    public static function retrieveByPK($id, $locale, PropelPDO $con = null) {
        $_instancePoolKey = serialize(array((string) $id, (string) $locale));
         if (null !== ($obj = DepartementI18nPeer::getInstanceFromPool($_instancePoolKey))) {
             return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(DepartementI18nPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $criteria = new Criteria(DepartementI18nPeer::DATABASE_NAME);
        $criteria->add(DepartementI18nPeer::ID, $id);
        $criteria->add(DepartementI18nPeer::LOCALE, $locale);
        $v = DepartementI18nPeer::doSelect($criteria, $con);

        return !empty($v) ? $v[0] : null;
    }
} // BaseDepartementI18nPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseDepartementI18nPeer::buildTableMap();

