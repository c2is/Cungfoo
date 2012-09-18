<?php

namespace Cungfoo\Model\om;

use \BasePeer;
use \Criteria;
use \PDO;
use \PDOStatement;
use \Propel;
use \PropelException;
use \PropelPDO;
use Cungfoo\Model\EtablissementPeer;
use Cungfoo\Model\EtablissementSituationGeographique;
use Cungfoo\Model\EtablissementSituationGeographiquePeer;
use Cungfoo\Model\SituationGeographiquePeer;
use Cungfoo\Model\map\EtablissementSituationGeographiqueTableMap;

/**
 * Base static class for performing query and update operations on the 'etablissement_situation_geographique' table.
 *
 *
 *
 * @package propel.generator.Cungfoo.Model.om
 */
abstract class BaseEtablissementSituationGeographiquePeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'cungfoo';

    /** the table name for this class */
    const TABLE_NAME = 'etablissement_situation_geographique';

    /** the related Propel class for this table */
    const OM_CLASS = 'Cungfoo\\Model\\EtablissementSituationGeographique';

    /** the related TableMap class for this table */
    const TM_CLASS = 'EtablissementSituationGeographiqueTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 2;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 2;

    /** the column name for the ETABLISSEMENT_ID field */
    const ETABLISSEMENT_ID = 'etablissement_situation_geographique.ETABLISSEMENT_ID';

    /** the column name for the SITUATION_GEOGRAPHIQUE_ID field */
    const SITUATION_GEOGRAPHIQUE_ID = 'etablissement_situation_geographique.SITUATION_GEOGRAPHIQUE_ID';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identiy map to hold any loaded instances of EtablissementSituationGeographique objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array EtablissementSituationGeographique[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. EtablissementSituationGeographiquePeer::$fieldNames[EtablissementSituationGeographiquePeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('EtablissementId', 'SituationGeographiqueId', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('etablissementId', 'situationGeographiqueId', ),
        BasePeer::TYPE_COLNAME => array (EtablissementSituationGeographiquePeer::ETABLISSEMENT_ID, EtablissementSituationGeographiquePeer::SITUATION_GEOGRAPHIQUE_ID, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ETABLISSEMENT_ID', 'SITUATION_GEOGRAPHIQUE_ID', ),
        BasePeer::TYPE_FIELDNAME => array ('etablissement_id', 'situation_geographique_id', ),
        BasePeer::TYPE_NUM => array (0, 1, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. EtablissementSituationGeographiquePeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('EtablissementId' => 0, 'SituationGeographiqueId' => 1, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('etablissementId' => 0, 'situationGeographiqueId' => 1, ),
        BasePeer::TYPE_COLNAME => array (EtablissementSituationGeographiquePeer::ETABLISSEMENT_ID => 0, EtablissementSituationGeographiquePeer::SITUATION_GEOGRAPHIQUE_ID => 1, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ETABLISSEMENT_ID' => 0, 'SITUATION_GEOGRAPHIQUE_ID' => 1, ),
        BasePeer::TYPE_FIELDNAME => array ('etablissement_id' => 0, 'situation_geographique_id' => 1, ),
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
        $toNames = EtablissementSituationGeographiquePeer::getFieldNames($toType);
        $key = isset(EtablissementSituationGeographiquePeer::$fieldKeys[$fromType][$name]) ? EtablissementSituationGeographiquePeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(EtablissementSituationGeographiquePeer::$fieldKeys[$fromType], true));
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
        if (!array_key_exists($type, EtablissementSituationGeographiquePeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return EtablissementSituationGeographiquePeer::$fieldNames[$type];
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
     * @param      string $column The column name for current table. (i.e. EtablissementSituationGeographiquePeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(EtablissementSituationGeographiquePeer::TABLE_NAME.'.', $alias.'.', $column);
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
            $criteria->addSelectColumn(EtablissementSituationGeographiquePeer::ETABLISSEMENT_ID);
            $criteria->addSelectColumn(EtablissementSituationGeographiquePeer::SITUATION_GEOGRAPHIQUE_ID);
        } else {
            $criteria->addSelectColumn($alias . '.ETABLISSEMENT_ID');
            $criteria->addSelectColumn($alias . '.SITUATION_GEOGRAPHIQUE_ID');
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
        $criteria->setPrimaryTableName(EtablissementSituationGeographiquePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            EtablissementSituationGeographiquePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(EtablissementSituationGeographiquePeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(EtablissementSituationGeographiquePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 EtablissementSituationGeographique
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = EtablissementSituationGeographiquePeer::doSelect($critcopy, $con);
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
        return EtablissementSituationGeographiquePeer::populateObjects(EtablissementSituationGeographiquePeer::doSelectStmt($criteria, $con));
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
            $con = Propel::getConnection(EtablissementSituationGeographiquePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            EtablissementSituationGeographiquePeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(EtablissementSituationGeographiquePeer::DATABASE_NAME);

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
     * @param      EtablissementSituationGeographique $obj A EtablissementSituationGeographique object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = serialize(array((string) $obj->getEtablissementId(), (string) $obj->getSituationGeographiqueId()));
            } // if key === null
            EtablissementSituationGeographiquePeer::$instances[$key] = $obj;
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
     * @param      mixed $value A EtablissementSituationGeographique object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof EtablissementSituationGeographique) {
                $key = serialize(array((string) $value->getEtablissementId(), (string) $value->getSituationGeographiqueId()));
            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key
                $key = serialize(array((string) $value[0], (string) $value[1]));
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or EtablissementSituationGeographique object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(EtablissementSituationGeographiquePeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return   EtablissementSituationGeographique Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(EtablissementSituationGeographiquePeer::$instances[$key])) {
                return EtablissementSituationGeographiquePeer::$instances[$key];
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
        EtablissementSituationGeographiquePeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to etablissement_situation_geographique
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
        $cls = EtablissementSituationGeographiquePeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = EtablissementSituationGeographiquePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = EtablissementSituationGeographiquePeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                EtablissementSituationGeographiquePeer::addInstanceToPool($obj, $key);
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
     * @return array (EtablissementSituationGeographique object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = EtablissementSituationGeographiquePeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = EtablissementSituationGeographiquePeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + EtablissementSituationGeographiquePeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = EtablissementSituationGeographiquePeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            EtablissementSituationGeographiquePeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }


    /**
     * Returns the number of rows matching criteria, joining the related Etablissement table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinEtablissement(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(EtablissementSituationGeographiquePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            EtablissementSituationGeographiquePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(EtablissementSituationGeographiquePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(EtablissementSituationGeographiquePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(EtablissementSituationGeographiquePeer::ETABLISSEMENT_ID, EtablissementPeer::ID, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related SituationGeographique table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinSituationGeographique(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(EtablissementSituationGeographiquePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            EtablissementSituationGeographiquePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(EtablissementSituationGeographiquePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(EtablissementSituationGeographiquePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(EtablissementSituationGeographiquePeer::SITUATION_GEOGRAPHIQUE_ID, SituationGeographiquePeer::ID, $join_behavior);

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
     * Selects a collection of EtablissementSituationGeographique objects pre-filled with their Etablissement objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of EtablissementSituationGeographique objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinEtablissement(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(EtablissementSituationGeographiquePeer::DATABASE_NAME);
        }

        EtablissementSituationGeographiquePeer::addSelectColumns($criteria);
        $startcol = EtablissementSituationGeographiquePeer::NUM_HYDRATE_COLUMNS;
        EtablissementPeer::addSelectColumns($criteria);

        $criteria->addJoin(EtablissementSituationGeographiquePeer::ETABLISSEMENT_ID, EtablissementPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = EtablissementSituationGeographiquePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = EtablissementSituationGeographiquePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = EtablissementSituationGeographiquePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                EtablissementSituationGeographiquePeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = EtablissementPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = EtablissementPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = EtablissementPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    EtablissementPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (EtablissementSituationGeographique) to $obj2 (Etablissement)
                $obj2->addEtablissementSituationGeographique($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of EtablissementSituationGeographique objects pre-filled with their SituationGeographique objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of EtablissementSituationGeographique objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinSituationGeographique(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(EtablissementSituationGeographiquePeer::DATABASE_NAME);
        }

        EtablissementSituationGeographiquePeer::addSelectColumns($criteria);
        $startcol = EtablissementSituationGeographiquePeer::NUM_HYDRATE_COLUMNS;
        SituationGeographiquePeer::addSelectColumns($criteria);

        $criteria->addJoin(EtablissementSituationGeographiquePeer::SITUATION_GEOGRAPHIQUE_ID, SituationGeographiquePeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = EtablissementSituationGeographiquePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = EtablissementSituationGeographiquePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = EtablissementSituationGeographiquePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                EtablissementSituationGeographiquePeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = SituationGeographiquePeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = SituationGeographiquePeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = SituationGeographiquePeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    SituationGeographiquePeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (EtablissementSituationGeographique) to $obj2 (SituationGeographique)
                $obj2->addEtablissementSituationGeographique($obj1);

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
        $criteria->setPrimaryTableName(EtablissementSituationGeographiquePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            EtablissementSituationGeographiquePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(EtablissementSituationGeographiquePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(EtablissementSituationGeographiquePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(EtablissementSituationGeographiquePeer::ETABLISSEMENT_ID, EtablissementPeer::ID, $join_behavior);

        $criteria->addJoin(EtablissementSituationGeographiquePeer::SITUATION_GEOGRAPHIQUE_ID, SituationGeographiquePeer::ID, $join_behavior);

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
     * Selects a collection of EtablissementSituationGeographique objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of EtablissementSituationGeographique objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(EtablissementSituationGeographiquePeer::DATABASE_NAME);
        }

        EtablissementSituationGeographiquePeer::addSelectColumns($criteria);
        $startcol2 = EtablissementSituationGeographiquePeer::NUM_HYDRATE_COLUMNS;

        EtablissementPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + EtablissementPeer::NUM_HYDRATE_COLUMNS;

        SituationGeographiquePeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + SituationGeographiquePeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(EtablissementSituationGeographiquePeer::ETABLISSEMENT_ID, EtablissementPeer::ID, $join_behavior);

        $criteria->addJoin(EtablissementSituationGeographiquePeer::SITUATION_GEOGRAPHIQUE_ID, SituationGeographiquePeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = EtablissementSituationGeographiquePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = EtablissementSituationGeographiquePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = EtablissementSituationGeographiquePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                EtablissementSituationGeographiquePeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

            // Add objects for joined Etablissement rows

            $key2 = EtablissementPeer::getPrimaryKeyHashFromRow($row, $startcol2);
            if ($key2 !== null) {
                $obj2 = EtablissementPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = EtablissementPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    EtablissementPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 loaded

                // Add the $obj1 (EtablissementSituationGeographique) to the collection in $obj2 (Etablissement)
                $obj2->addEtablissementSituationGeographique($obj1);
            } // if joined row not null

            // Add objects for joined SituationGeographique rows

            $key3 = SituationGeographiquePeer::getPrimaryKeyHashFromRow($row, $startcol3);
            if ($key3 !== null) {
                $obj3 = SituationGeographiquePeer::getInstanceFromPool($key3);
                if (!$obj3) {

                    $cls = SituationGeographiquePeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    SituationGeographiquePeer::addInstanceToPool($obj3, $key3);
                } // if obj3 loaded

                // Add the $obj1 (EtablissementSituationGeographique) to the collection in $obj3 (SituationGeographique)
                $obj3->addEtablissementSituationGeographique($obj1);
            } // if joined row not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Returns the number of rows matching criteria, joining the related Etablissement table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptEtablissement(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(EtablissementSituationGeographiquePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            EtablissementSituationGeographiquePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(EtablissementSituationGeographiquePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(EtablissementSituationGeographiquePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(EtablissementSituationGeographiquePeer::SITUATION_GEOGRAPHIQUE_ID, SituationGeographiquePeer::ID, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related SituationGeographique table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptSituationGeographique(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(EtablissementSituationGeographiquePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            EtablissementSituationGeographiquePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(EtablissementSituationGeographiquePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(EtablissementSituationGeographiquePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(EtablissementSituationGeographiquePeer::ETABLISSEMENT_ID, EtablissementPeer::ID, $join_behavior);

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
     * Selects a collection of EtablissementSituationGeographique objects pre-filled with all related objects except Etablissement.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of EtablissementSituationGeographique objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptEtablissement(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(EtablissementSituationGeographiquePeer::DATABASE_NAME);
        }

        EtablissementSituationGeographiquePeer::addSelectColumns($criteria);
        $startcol2 = EtablissementSituationGeographiquePeer::NUM_HYDRATE_COLUMNS;

        SituationGeographiquePeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + SituationGeographiquePeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(EtablissementSituationGeographiquePeer::SITUATION_GEOGRAPHIQUE_ID, SituationGeographiquePeer::ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = EtablissementSituationGeographiquePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = EtablissementSituationGeographiquePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = EtablissementSituationGeographiquePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                EtablissementSituationGeographiquePeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined SituationGeographique rows

                $key2 = SituationGeographiquePeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = SituationGeographiquePeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = SituationGeographiquePeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    SituationGeographiquePeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (EtablissementSituationGeographique) to the collection in $obj2 (SituationGeographique)
                $obj2->addEtablissementSituationGeographique($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of EtablissementSituationGeographique objects pre-filled with all related objects except SituationGeographique.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of EtablissementSituationGeographique objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptSituationGeographique(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(EtablissementSituationGeographiquePeer::DATABASE_NAME);
        }

        EtablissementSituationGeographiquePeer::addSelectColumns($criteria);
        $startcol2 = EtablissementSituationGeographiquePeer::NUM_HYDRATE_COLUMNS;

        EtablissementPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + EtablissementPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(EtablissementSituationGeographiquePeer::ETABLISSEMENT_ID, EtablissementPeer::ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = EtablissementSituationGeographiquePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = EtablissementSituationGeographiquePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = EtablissementSituationGeographiquePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                EtablissementSituationGeographiquePeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined Etablissement rows

                $key2 = EtablissementPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = EtablissementPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = EtablissementPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    EtablissementPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (EtablissementSituationGeographique) to the collection in $obj2 (Etablissement)
                $obj2->addEtablissementSituationGeographique($obj1);

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
        return Propel::getDatabaseMap(EtablissementSituationGeographiquePeer::DATABASE_NAME)->getTable(EtablissementSituationGeographiquePeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseEtablissementSituationGeographiquePeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseEtablissementSituationGeographiquePeer::TABLE_NAME)) {
        $dbMap->addTableObject(new EtablissementSituationGeographiqueTableMap());
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
        return EtablissementSituationGeographiquePeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a EtablissementSituationGeographique or Criteria object.
     *
     * @param      mixed $values Criteria or EtablissementSituationGeographique object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(EtablissementSituationGeographiquePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from EtablissementSituationGeographique object
        }


        // Set the correct dbName
        $criteria->setDbName(EtablissementSituationGeographiquePeer::DATABASE_NAME);

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
     * Performs an UPDATE on the database, given a EtablissementSituationGeographique or Criteria object.
     *
     * @param      mixed $values Criteria or EtablissementSituationGeographique object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(EtablissementSituationGeographiquePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(EtablissementSituationGeographiquePeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(EtablissementSituationGeographiquePeer::ETABLISSEMENT_ID);
            $value = $criteria->remove(EtablissementSituationGeographiquePeer::ETABLISSEMENT_ID);
            if ($value) {
                $selectCriteria->add(EtablissementSituationGeographiquePeer::ETABLISSEMENT_ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(EtablissementSituationGeographiquePeer::TABLE_NAME);
            }

            $comparison = $criteria->getComparison(EtablissementSituationGeographiquePeer::SITUATION_GEOGRAPHIQUE_ID);
            $value = $criteria->remove(EtablissementSituationGeographiquePeer::SITUATION_GEOGRAPHIQUE_ID);
            if ($value) {
                $selectCriteria->add(EtablissementSituationGeographiquePeer::SITUATION_GEOGRAPHIQUE_ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(EtablissementSituationGeographiquePeer::TABLE_NAME);
            }

        } else { // $values is EtablissementSituationGeographique object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(EtablissementSituationGeographiquePeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the etablissement_situation_geographique table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(EtablissementSituationGeographiquePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(EtablissementSituationGeographiquePeer::TABLE_NAME, $con, EtablissementSituationGeographiquePeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EtablissementSituationGeographiquePeer::clearInstancePool();
            EtablissementSituationGeographiquePeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a EtablissementSituationGeographique or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or EtablissementSituationGeographique object or primary key or array of primary keys
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
            $con = Propel::getConnection(EtablissementSituationGeographiquePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            EtablissementSituationGeographiquePeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof EtablissementSituationGeographique) { // it's a model object
            // invalidate the cache for this single object
            EtablissementSituationGeographiquePeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(EtablissementSituationGeographiquePeer::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = array($values);
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(EtablissementSituationGeographiquePeer::ETABLISSEMENT_ID, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(EtablissementSituationGeographiquePeer::SITUATION_GEOGRAPHIQUE_ID, $value[1]));
                $criteria->addOr($criterion);
                // we can invalidate the cache for this single PK
                EtablissementSituationGeographiquePeer::removeInstanceFromPool($value);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(EtablissementSituationGeographiquePeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            EtablissementSituationGeographiquePeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given EtablissementSituationGeographique object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param      EtablissementSituationGeographique $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(EtablissementSituationGeographiquePeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(EtablissementSituationGeographiquePeer::TABLE_NAME);

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

        return BasePeer::doValidate(EtablissementSituationGeographiquePeer::DATABASE_NAME, EtablissementSituationGeographiquePeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve object using using composite pkey values.
     * @param   int $etablissement_id
     * @param   int $situation_geographique_id
     * @param      PropelPDO $con
     * @return   EtablissementSituationGeographique
     */
    public static function retrieveByPK($etablissement_id, $situation_geographique_id, PropelPDO $con = null) {
        $_instancePoolKey = serialize(array((string) $etablissement_id, (string) $situation_geographique_id));
         if (null !== ($obj = EtablissementSituationGeographiquePeer::getInstanceFromPool($_instancePoolKey))) {
             return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(EtablissementSituationGeographiquePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $criteria = new Criteria(EtablissementSituationGeographiquePeer::DATABASE_NAME);
        $criteria->add(EtablissementSituationGeographiquePeer::ETABLISSEMENT_ID, $etablissement_id);
        $criteria->add(EtablissementSituationGeographiquePeer::SITUATION_GEOGRAPHIQUE_ID, $situation_geographique_id);
        $v = EtablissementSituationGeographiquePeer::doSelect($criteria, $con);

        return !empty($v) ? $v[0] : null;
    }
} // BaseEtablissementSituationGeographiquePeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseEtablissementSituationGeographiquePeer::buildTableMap();

