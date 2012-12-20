<?php

namespace Cungfoo\Model\om;

use \BasePeer;
use \Criteria;
use \PDO;
use \PDOStatement;
use \Propel;
use \PropelException;
use \PropelPDO;
use Cungfoo\Model\BonPlan;
use Cungfoo\Model\BonPlanCategoriePeer;
use Cungfoo\Model\BonPlanI18nPeer;
use Cungfoo\Model\BonPlanPeer;
use Cungfoo\Model\map\BonPlanTableMap;

/**
 * Base static class for performing query and update operations on the 'bon_plan' table.
 *
 *
 *
 * @package propel.generator.Cungfoo.Model.om
 */
abstract class BaseBonPlanPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'cungfoo';

    /** the table name for this class */
    const TABLE_NAME = 'bon_plan';

    /** the related Propel class for this table */
    const OM_CLASS = 'Cungfoo\\Model\\BonPlan';

    /** the related TableMap class for this table */
    const TM_CLASS = 'BonPlanTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 8;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 8;

    /** the column name for the id field */
    const ID = 'bon_plan.id';

    /** the column name for the bon_plan_categorie_id field */
    const BON_PLAN_CATEGORIE_ID = 'bon_plan.bon_plan_categorie_id';

    /** the column name for the date_debut field */
    const DATE_DEBUT = 'bon_plan.date_debut';

    /** the column name for the date_fin field */
    const DATE_FIN = 'bon_plan.date_fin';

    /** the column name for the prix field */
    const PRIX = 'bon_plan.prix';

    /** the column name for the prix_barre field */
    const PRIX_BARRE = 'bon_plan.prix_barre';

    /** the column name for the image_menu field */
    const IMAGE_MENU = 'bon_plan.image_menu';

    /** the column name for the active field */
    const ACTIVE = 'bon_plan.active';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identiy map to hold any loaded instances of BonPlan objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array BonPlan[]
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
     * e.g. BonPlanPeer::$fieldNames[BonPlanPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Id', 'BonPlanCategorieId', 'DateDebut', 'DateFin', 'Prix', 'PrixBarre', 'ImageMenu', 'Active', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'bonPlanCategorieId', 'dateDebut', 'dateFin', 'prix', 'prixBarre', 'imageMenu', 'active', ),
        BasePeer::TYPE_COLNAME => array (BonPlanPeer::ID, BonPlanPeer::BON_PLAN_CATEGORIE_ID, BonPlanPeer::DATE_DEBUT, BonPlanPeer::DATE_FIN, BonPlanPeer::PRIX, BonPlanPeer::PRIX_BARRE, BonPlanPeer::IMAGE_MENU, BonPlanPeer::ACTIVE, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID', 'BON_PLAN_CATEGORIE_ID', 'DATE_DEBUT', 'DATE_FIN', 'PRIX', 'PRIX_BARRE', 'IMAGE_MENU', 'ACTIVE', ),
        BasePeer::TYPE_FIELDNAME => array ('id', 'bon_plan_categorie_id', 'date_debut', 'date_fin', 'prix', 'prix_barre', 'image_menu', 'active', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. BonPlanPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'BonPlanCategorieId' => 1, 'DateDebut' => 2, 'DateFin' => 3, 'Prix' => 4, 'PrixBarre' => 5, 'ImageMenu' => 6, 'Active' => 7, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'bonPlanCategorieId' => 1, 'dateDebut' => 2, 'dateFin' => 3, 'prix' => 4, 'prixBarre' => 5, 'imageMenu' => 6, 'active' => 7, ),
        BasePeer::TYPE_COLNAME => array (BonPlanPeer::ID => 0, BonPlanPeer::BON_PLAN_CATEGORIE_ID => 1, BonPlanPeer::DATE_DEBUT => 2, BonPlanPeer::DATE_FIN => 3, BonPlanPeer::PRIX => 4, BonPlanPeer::PRIX_BARRE => 5, BonPlanPeer::IMAGE_MENU => 6, BonPlanPeer::ACTIVE => 7, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID' => 0, 'BON_PLAN_CATEGORIE_ID' => 1, 'DATE_DEBUT' => 2, 'DATE_FIN' => 3, 'PRIX' => 4, 'PRIX_BARRE' => 5, 'IMAGE_MENU' => 6, 'ACTIVE' => 7, ),
        BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'bon_plan_categorie_id' => 1, 'date_debut' => 2, 'date_fin' => 3, 'prix' => 4, 'prix_barre' => 5, 'image_menu' => 6, 'active' => 7, ),
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
        $toNames = BonPlanPeer::getFieldNames($toType);
        $key = isset(BonPlanPeer::$fieldKeys[$fromType][$name]) ? BonPlanPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(BonPlanPeer::$fieldKeys[$fromType], true));
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
        if (!array_key_exists($type, BonPlanPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return BonPlanPeer::$fieldNames[$type];
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
     * @param      string $column The column name for current table. (i.e. BonPlanPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(BonPlanPeer::TABLE_NAME.'.', $alias.'.', $column);
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
            $criteria->addSelectColumn(BonPlanPeer::ID);
            $criteria->addSelectColumn(BonPlanPeer::BON_PLAN_CATEGORIE_ID);
            $criteria->addSelectColumn(BonPlanPeer::DATE_DEBUT);
            $criteria->addSelectColumn(BonPlanPeer::DATE_FIN);
            $criteria->addSelectColumn(BonPlanPeer::PRIX);
            $criteria->addSelectColumn(BonPlanPeer::PRIX_BARRE);
            $criteria->addSelectColumn(BonPlanPeer::IMAGE_MENU);
            $criteria->addSelectColumn(BonPlanPeer::ACTIVE);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.bon_plan_categorie_id');
            $criteria->addSelectColumn($alias . '.date_debut');
            $criteria->addSelectColumn($alias . '.date_fin');
            $criteria->addSelectColumn($alias . '.prix');
            $criteria->addSelectColumn($alias . '.prix_barre');
            $criteria->addSelectColumn($alias . '.image_menu');
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
        $criteria->setPrimaryTableName(BonPlanPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            BonPlanPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(BonPlanPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(BonPlanPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 BonPlan
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = BonPlanPeer::doSelect($critcopy, $con);
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
        return BonPlanPeer::populateObjects(BonPlanPeer::doSelectStmt($criteria, $con));
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
            $con = Propel::getConnection(BonPlanPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            BonPlanPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(BonPlanPeer::DATABASE_NAME);

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
     * @param      BonPlan $obj A BonPlan object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getId();
            } // if key === null
            BonPlanPeer::$instances[$key] = $obj;
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
     * @param      mixed $value A BonPlan object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof BonPlan) {
                $key = (string) $value->getId();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or BonPlan object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(BonPlanPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return   BonPlan Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(BonPlanPeer::$instances[$key])) {
                return BonPlanPeer::$instances[$key];
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
        BonPlanPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to bon_plan
     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in BonPlanI18nPeer instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        BonPlanI18nPeer::clearInstancePool();
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
        $cls = BonPlanPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = BonPlanPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = BonPlanPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                BonPlanPeer::addInstanceToPool($obj, $key);
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
     * @return array (BonPlan object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = BonPlanPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = BonPlanPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + BonPlanPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = BonPlanPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            BonPlanPeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
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
        $criteria->setPrimaryTableName(BonPlanPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            BonPlanPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(BonPlanPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(BonPlanPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(BonPlanPeer::BON_PLAN_CATEGORIE_ID, BonPlanCategoriePeer::ID, $join_behavior);

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
     * Selects a collection of BonPlan objects pre-filled with their BonPlanCategorie objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of BonPlan objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinBonPlanCategorie(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(BonPlanPeer::DATABASE_NAME);
        }

        BonPlanPeer::addSelectColumns($criteria);
        $startcol = BonPlanPeer::NUM_HYDRATE_COLUMNS;
        BonPlanCategoriePeer::addSelectColumns($criteria);

        $criteria->addJoin(BonPlanPeer::BON_PLAN_CATEGORIE_ID, BonPlanCategoriePeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = BonPlanPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = BonPlanPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = BonPlanPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                BonPlanPeer::addInstanceToPool($obj1, $key1);
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

                // Add the $obj1 (BonPlan) to $obj2 (BonPlanCategorie)
                $obj2->addBonPlan($obj1);

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
        $criteria->setPrimaryTableName(BonPlanPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            BonPlanPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(BonPlanPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(BonPlanPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(BonPlanPeer::BON_PLAN_CATEGORIE_ID, BonPlanCategoriePeer::ID, $join_behavior);

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
     * Selects a collection of BonPlan objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of BonPlan objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(BonPlanPeer::DATABASE_NAME);
        }

        BonPlanPeer::addSelectColumns($criteria);
        $startcol2 = BonPlanPeer::NUM_HYDRATE_COLUMNS;

        BonPlanCategoriePeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + BonPlanCategoriePeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(BonPlanPeer::BON_PLAN_CATEGORIE_ID, BonPlanCategoriePeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = BonPlanPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = BonPlanPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = BonPlanPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                BonPlanPeer::addInstanceToPool($obj1, $key1);
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
                } // if obj2 loaded

                // Add the $obj1 (BonPlan) to the collection in $obj2 (BonPlanCategorie)
                $obj2->addBonPlan($obj1);
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
        return Propel::getDatabaseMap(BonPlanPeer::DATABASE_NAME)->getTable(BonPlanPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseBonPlanPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseBonPlanPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new BonPlanTableMap());
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
        return BonPlanPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a BonPlan or Criteria object.
     *
     * @param      mixed $values Criteria or BonPlan object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(BonPlanPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from BonPlan object
        }

        if ($criteria->containsKey(BonPlanPeer::ID) && $criteria->keyContainsValue(BonPlanPeer::ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.BonPlanPeer::ID.')');
        }


        // Set the correct dbName
        $criteria->setDbName(BonPlanPeer::DATABASE_NAME);

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
     * Performs an UPDATE on the database, given a BonPlan or Criteria object.
     *
     * @param      mixed $values Criteria or BonPlan object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(BonPlanPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(BonPlanPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(BonPlanPeer::ID);
            $value = $criteria->remove(BonPlanPeer::ID);
            if ($value) {
                $selectCriteria->add(BonPlanPeer::ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(BonPlanPeer::TABLE_NAME);
            }

        } else { // $values is BonPlan object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(BonPlanPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the bon_plan table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(BonPlanPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(BonPlanPeer::TABLE_NAME, $con, BonPlanPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BonPlanPeer::clearInstancePool();
            BonPlanPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a BonPlan or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or BonPlan object or primary key or array of primary keys
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
            $con = Propel::getConnection(BonPlanPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            BonPlanPeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof BonPlan) { // it's a model object
            // invalidate the cache for this single object
            BonPlanPeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(BonPlanPeer::DATABASE_NAME);
            $criteria->add(BonPlanPeer::ID, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                BonPlanPeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(BonPlanPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            BonPlanPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given BonPlan object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param      BonPlan $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(BonPlanPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(BonPlanPeer::TABLE_NAME);

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

        return BasePeer::doValidate(BonPlanPeer::DATABASE_NAME, BonPlanPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param      int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return BonPlan
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = BonPlanPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(BonPlanPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(BonPlanPeer::DATABASE_NAME);
        $criteria->add(BonPlanPeer::ID, $pk);

        $v = BonPlanPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return BonPlan[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(BonPlanPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(BonPlanPeer::DATABASE_NAME);
            $criteria->add(BonPlanPeer::ID, $pks, Criteria::IN);
            $objs = BonPlanPeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BaseBonPlanPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseBonPlanPeer::buildTableMap();

