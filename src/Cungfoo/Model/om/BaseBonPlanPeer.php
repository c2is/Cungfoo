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
use Cungfoo\Model\BonPlanBonPlanCategoriePeer;
use Cungfoo\Model\BonPlanEtablissementPeer;
use Cungfoo\Model\BonPlanI18nPeer;
use Cungfoo\Model\BonPlanPeer;
use Cungfoo\Model\BonPlanRegionPeer;
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
    const NUM_COLUMNS = 18;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 18;

    /** the column name for the id field */
    const ID = 'bon_plan.id';

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

    /** the column name for the image_page field */
    const IMAGE_PAGE = 'bon_plan.image_page';

    /** the column name for the image_liste field */
    const IMAGE_LISTE = 'bon_plan.image_liste';

    /** the column name for the active_compteur field */
    const ACTIVE_COMPTEUR = 'bon_plan.active_compteur';

    /** the column name for the mise_en_avant field */
    const MISE_EN_AVANT = 'bon_plan.mise_en_avant';

    /** the column name for the push_home field */
    const PUSH_HOME = 'bon_plan.push_home';

    /** the column name for the date_start field */
    const DATE_START = 'bon_plan.date_start';

    /** the column name for the day_start field */
    const DAY_START = 'bon_plan.day_start';

    /** the column name for the day_range field */
    const DAY_RANGE = 'bon_plan.day_range';

    /** the column name for the nb_adultes field */
    const NB_ADULTES = 'bon_plan.nb_adultes';

    /** the column name for the nb_enfants field */
    const NB_ENFANTS = 'bon_plan.nb_enfants';

    /** the column name for the period_categories field */
    const PERIOD_CATEGORIES = 'bon_plan.period_categories';

    /** the column name for the active field */
    const ACTIVE = 'bon_plan.active';

    /** The enumerated values for the day_start field */
    const DAY_START_MONDAY = 'monday';
    const DAY_START_TUESDAY = 'tuesday';
    const DAY_START_WEDNESDAY = 'wednesday';
    const DAY_START_THURSDAY = 'thursday';
    const DAY_START_FRIDAY = 'friday';
    const DAY_START_SATURDAY = 'saturday';
    const DAY_START_SUNDAY = 'sunday';

    /** The enumerated values for the day_range field */
    const DAY_RANGE_7 = '7';
    const DAY_RANGE_14 = '14';
    const DAY_RANGE_21 = '21';

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
        BasePeer::TYPE_PHPNAME => array ('Id', 'DateDebut', 'DateFin', 'Prix', 'PrixBarre', 'ImageMenu', 'ImagePage', 'ImageListe', 'ActiveCompteur', 'MiseEnAvant', 'PushHome', 'DateStart', 'DayStart', 'DayRange', 'NbAdultes', 'NbEnfants', 'PeriodCategories', 'Active', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'dateDebut', 'dateFin', 'prix', 'prixBarre', 'imageMenu', 'imagePage', 'imageListe', 'activeCompteur', 'miseEnAvant', 'pushHome', 'dateStart', 'dayStart', 'dayRange', 'nbAdultes', 'nbEnfants', 'periodCategories', 'active', ),
        BasePeer::TYPE_COLNAME => array (BonPlanPeer::ID, BonPlanPeer::DATE_DEBUT, BonPlanPeer::DATE_FIN, BonPlanPeer::PRIX, BonPlanPeer::PRIX_BARRE, BonPlanPeer::IMAGE_MENU, BonPlanPeer::IMAGE_PAGE, BonPlanPeer::IMAGE_LISTE, BonPlanPeer::ACTIVE_COMPTEUR, BonPlanPeer::MISE_EN_AVANT, BonPlanPeer::PUSH_HOME, BonPlanPeer::DATE_START, BonPlanPeer::DAY_START, BonPlanPeer::DAY_RANGE, BonPlanPeer::NB_ADULTES, BonPlanPeer::NB_ENFANTS, BonPlanPeer::PERIOD_CATEGORIES, BonPlanPeer::ACTIVE, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID', 'DATE_DEBUT', 'DATE_FIN', 'PRIX', 'PRIX_BARRE', 'IMAGE_MENU', 'IMAGE_PAGE', 'IMAGE_LISTE', 'ACTIVE_COMPTEUR', 'MISE_EN_AVANT', 'PUSH_HOME', 'DATE_START', 'DAY_START', 'DAY_RANGE', 'NB_ADULTES', 'NB_ENFANTS', 'PERIOD_CATEGORIES', 'ACTIVE', ),
        BasePeer::TYPE_FIELDNAME => array ('id', 'date_debut', 'date_fin', 'prix', 'prix_barre', 'image_menu', 'image_page', 'image_liste', 'active_compteur', 'mise_en_avant', 'push_home', 'date_start', 'day_start', 'day_range', 'nb_adultes', 'nb_enfants', 'period_categories', 'active', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. BonPlanPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'DateDebut' => 1, 'DateFin' => 2, 'Prix' => 3, 'PrixBarre' => 4, 'ImageMenu' => 5, 'ImagePage' => 6, 'ImageListe' => 7, 'ActiveCompteur' => 8, 'MiseEnAvant' => 9, 'PushHome' => 10, 'DateStart' => 11, 'DayStart' => 12, 'DayRange' => 13, 'NbAdultes' => 14, 'NbEnfants' => 15, 'PeriodCategories' => 16, 'Active' => 17, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'dateDebut' => 1, 'dateFin' => 2, 'prix' => 3, 'prixBarre' => 4, 'imageMenu' => 5, 'imagePage' => 6, 'imageListe' => 7, 'activeCompteur' => 8, 'miseEnAvant' => 9, 'pushHome' => 10, 'dateStart' => 11, 'dayStart' => 12, 'dayRange' => 13, 'nbAdultes' => 14, 'nbEnfants' => 15, 'periodCategories' => 16, 'active' => 17, ),
        BasePeer::TYPE_COLNAME => array (BonPlanPeer::ID => 0, BonPlanPeer::DATE_DEBUT => 1, BonPlanPeer::DATE_FIN => 2, BonPlanPeer::PRIX => 3, BonPlanPeer::PRIX_BARRE => 4, BonPlanPeer::IMAGE_MENU => 5, BonPlanPeer::IMAGE_PAGE => 6, BonPlanPeer::IMAGE_LISTE => 7, BonPlanPeer::ACTIVE_COMPTEUR => 8, BonPlanPeer::MISE_EN_AVANT => 9, BonPlanPeer::PUSH_HOME => 10, BonPlanPeer::DATE_START => 11, BonPlanPeer::DAY_START => 12, BonPlanPeer::DAY_RANGE => 13, BonPlanPeer::NB_ADULTES => 14, BonPlanPeer::NB_ENFANTS => 15, BonPlanPeer::PERIOD_CATEGORIES => 16, BonPlanPeer::ACTIVE => 17, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID' => 0, 'DATE_DEBUT' => 1, 'DATE_FIN' => 2, 'PRIX' => 3, 'PRIX_BARRE' => 4, 'IMAGE_MENU' => 5, 'IMAGE_PAGE' => 6, 'IMAGE_LISTE' => 7, 'ACTIVE_COMPTEUR' => 8, 'MISE_EN_AVANT' => 9, 'PUSH_HOME' => 10, 'DATE_START' => 11, 'DAY_START' => 12, 'DAY_RANGE' => 13, 'NB_ADULTES' => 14, 'NB_ENFANTS' => 15, 'PERIOD_CATEGORIES' => 16, 'ACTIVE' => 17, ),
        BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'date_debut' => 1, 'date_fin' => 2, 'prix' => 3, 'prix_barre' => 4, 'image_menu' => 5, 'image_page' => 6, 'image_liste' => 7, 'active_compteur' => 8, 'mise_en_avant' => 9, 'push_home' => 10, 'date_start' => 11, 'day_start' => 12, 'day_range' => 13, 'nb_adultes' => 14, 'nb_enfants' => 15, 'period_categories' => 16, 'active' => 17, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
    );

    /** The enumerated values for this table */
    protected static $enumValueSets = array(
        BonPlanPeer::DAY_START => array(
            BonPlanPeer::DAY_START_MONDAY,
            BonPlanPeer::DAY_START_TUESDAY,
            BonPlanPeer::DAY_START_WEDNESDAY,
            BonPlanPeer::DAY_START_THURSDAY,
            BonPlanPeer::DAY_START_FRIDAY,
            BonPlanPeer::DAY_START_SATURDAY,
            BonPlanPeer::DAY_START_SUNDAY,
        ),
        BonPlanPeer::DAY_RANGE => array(
            BonPlanPeer::DAY_RANGE_7,
            BonPlanPeer::DAY_RANGE_14,
            BonPlanPeer::DAY_RANGE_21,
        ),
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
     * Gets the list of values for all ENUM columns
     * @return array
     */
    public static function getValueSets()
    {
      return BonPlanPeer::$enumValueSets;
    }

    /**
     * Gets the list of values for an ENUM column
     *
     * @param string $colname The ENUM column name.
     *
     * @return array list of possible values for the column
     */
    public static function getValueSet($colname)
    {
        $valueSets = BonPlanPeer::getValueSets();

        return $valueSets[$colname];
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
            $criteria->addSelectColumn(BonPlanPeer::DATE_DEBUT);
            $criteria->addSelectColumn(BonPlanPeer::DATE_FIN);
            $criteria->addSelectColumn(BonPlanPeer::PRIX);
            $criteria->addSelectColumn(BonPlanPeer::PRIX_BARRE);
            $criteria->addSelectColumn(BonPlanPeer::IMAGE_MENU);
            $criteria->addSelectColumn(BonPlanPeer::IMAGE_PAGE);
            $criteria->addSelectColumn(BonPlanPeer::IMAGE_LISTE);
            $criteria->addSelectColumn(BonPlanPeer::ACTIVE_COMPTEUR);
            $criteria->addSelectColumn(BonPlanPeer::MISE_EN_AVANT);
            $criteria->addSelectColumn(BonPlanPeer::PUSH_HOME);
            $criteria->addSelectColumn(BonPlanPeer::DATE_START);
            $criteria->addSelectColumn(BonPlanPeer::DAY_START);
            $criteria->addSelectColumn(BonPlanPeer::DAY_RANGE);
            $criteria->addSelectColumn(BonPlanPeer::NB_ADULTES);
            $criteria->addSelectColumn(BonPlanPeer::NB_ENFANTS);
            $criteria->addSelectColumn(BonPlanPeer::PERIOD_CATEGORIES);
            $criteria->addSelectColumn(BonPlanPeer::ACTIVE);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.date_debut');
            $criteria->addSelectColumn($alias . '.date_fin');
            $criteria->addSelectColumn($alias . '.prix');
            $criteria->addSelectColumn($alias . '.prix_barre');
            $criteria->addSelectColumn($alias . '.image_menu');
            $criteria->addSelectColumn($alias . '.image_page');
            $criteria->addSelectColumn($alias . '.image_liste');
            $criteria->addSelectColumn($alias . '.active_compteur');
            $criteria->addSelectColumn($alias . '.mise_en_avant');
            $criteria->addSelectColumn($alias . '.push_home');
            $criteria->addSelectColumn($alias . '.date_start');
            $criteria->addSelectColumn($alias . '.day_start');
            $criteria->addSelectColumn($alias . '.day_range');
            $criteria->addSelectColumn($alias . '.nb_adultes');
            $criteria->addSelectColumn($alias . '.nb_enfants');
            $criteria->addSelectColumn($alias . '.period_categories');
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
        // Invalidate objects in BonPlanBonPlanCategoriePeer instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        BonPlanBonPlanCategoriePeer::clearInstancePool();
        // Invalidate objects in BonPlanEtablissementPeer instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        BonPlanEtablissementPeer::clearInstancePool();
        // Invalidate objects in BonPlanRegionPeer instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        BonPlanRegionPeer::clearInstancePool();
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

    // crudable behavior
    
    /**
     * The default locale to use for translations
     * @var        string
     */
    public static function getMetadata($locale = 'fr', PropelPDO $con = null)
    {
        return \Cungfoo\Model\MetadataQuery::create()
            ->joinWithI18n($locale)
            ->filterByTableRef(BonPlanPeer::TABLE_NAME)
            ->findOne()
        ;
    }
    // seo behavior
    
    /**
     * The default locale to use for translations
     * @var        string
     */
    public static function getSeo($locale = 'fr', PropelPDO $con = null)
    {
        return \Cungfoo\Model\SeoQuery::create()
            ->joinWithI18n($locale)
            ->filterByTableRef(BonPlanPeer::TABLE_NAME)
            ->findOne()
        ;
    }
} // BaseBonPlanPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseBonPlanPeer::buildTableMap();

