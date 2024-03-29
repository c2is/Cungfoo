<?php

namespace Cungfoo\Model\om;

use \BasePeer;
use \Criteria;
use \PDO;
use \PDOStatement;
use \Propel;
use \PropelException;
use \PropelPDO;
use Cungfoo\Model\TypeHebergementI18n;
use Cungfoo\Model\TypeHebergementI18nPeer;
use Cungfoo\Model\TypeHebergementPeer;
use Cungfoo\Model\map\TypeHebergementI18nTableMap;

/**
 * Base static class for performing query and update operations on the 'type_hebergement_i18n' table.
 *
 *
 *
 * @package propel.generator.Cungfoo.Model.om
 */
abstract class BaseTypeHebergementI18nPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'cungfoo';

    /** the table name for this class */
    const TABLE_NAME = 'type_hebergement_i18n';

    /** the related Propel class for this table */
    const OM_CLASS = 'Cungfoo\\Model\\TypeHebergementI18n';

    /** the related TableMap class for this table */
    const TM_CLASS = 'TypeHebergementI18nTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 24;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 24;

    /** the column name for the id field */
    const ID = 'type_hebergement_i18n.id';

    /** the column name for the locale field */
    const LOCALE = 'type_hebergement_i18n.locale';

    /** the column name for the name field */
    const NAME = 'type_hebergement_i18n.name';

    /** the column name for the slug field */
    const SLUG = 'type_hebergement_i18n.slug';

    /** the column name for the indice field */
    const INDICE = 'type_hebergement_i18n.indice';

    /** the column name for the surface field */
    const SURFACE = 'type_hebergement_i18n.surface';

    /** the column name for the type_terrasse field */
    const TYPE_TERRASSE = 'type_hebergement_i18n.type_terrasse';

    /** the column name for the description field */
    const DESCRIPTION = 'type_hebergement_i18n.description';

    /** the column name for the composition field */
    const COMPOSITION = 'type_hebergement_i18n.composition';

    /** the column name for the presentation field */
    const PRESENTATION = 'type_hebergement_i18n.presentation';

    /** the column name for the capacite_hebergement field */
    const CAPACITE_HEBERGEMENT = 'type_hebergement_i18n.capacite_hebergement';

    /** the column name for the dimensions field */
    const DIMENSIONS = 'type_hebergement_i18n.dimensions';

    /** the column name for the agencement field */
    const AGENCEMENT = 'type_hebergement_i18n.agencement';

    /** the column name for the equipements field */
    const EQUIPEMENTS = 'type_hebergement_i18n.equipements';

    /** the column name for the annee_utilisation field */
    const ANNEE_UTILISATION = 'type_hebergement_i18n.annee_utilisation';

    /** the column name for the remarque_1 field */
    const REMARQUE_1 = 'type_hebergement_i18n.remarque_1';

    /** the column name for the remarque_2 field */
    const REMARQUE_2 = 'type_hebergement_i18n.remarque_2';

    /** the column name for the remarque_3 field */
    const REMARQUE_3 = 'type_hebergement_i18n.remarque_3';

    /** the column name for the remarque_4 field */
    const REMARQUE_4 = 'type_hebergement_i18n.remarque_4';

    /** the column name for the seo_title field */
    const SEO_TITLE = 'type_hebergement_i18n.seo_title';

    /** the column name for the seo_description field */
    const SEO_DESCRIPTION = 'type_hebergement_i18n.seo_description';

    /** the column name for the seo_h1 field */
    const SEO_H1 = 'type_hebergement_i18n.seo_h1';

    /** the column name for the seo_keywords field */
    const SEO_KEYWORDS = 'type_hebergement_i18n.seo_keywords';

    /** the column name for the active_locale field */
    const ACTIVE_LOCALE = 'type_hebergement_i18n.active_locale';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identiy map to hold any loaded instances of TypeHebergementI18n objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array TypeHebergementI18n[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. TypeHebergementI18nPeer::$fieldNames[TypeHebergementI18nPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Id', 'Locale', 'Name', 'Slug', 'Indice', 'Surface', 'TypeTerrasse', 'Description', 'Composition', 'Presentation', 'CapaciteHebergement', 'Dimensions', 'Agencement', 'Equipements', 'AnneeUtilisation', 'Remarque1', 'Remarque2', 'Remarque3', 'Remarque4', 'SeoTitle', 'SeoDescription', 'SeoH1', 'SeoKeywords', 'ActiveLocale', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'locale', 'name', 'slug', 'indice', 'surface', 'typeTerrasse', 'description', 'composition', 'presentation', 'capaciteHebergement', 'dimensions', 'agencement', 'equipements', 'anneeUtilisation', 'remarque1', 'remarque2', 'remarque3', 'remarque4', 'seoTitle', 'seoDescription', 'seoH1', 'seoKeywords', 'activeLocale', ),
        BasePeer::TYPE_COLNAME => array (TypeHebergementI18nPeer::ID, TypeHebergementI18nPeer::LOCALE, TypeHebergementI18nPeer::NAME, TypeHebergementI18nPeer::SLUG, TypeHebergementI18nPeer::INDICE, TypeHebergementI18nPeer::SURFACE, TypeHebergementI18nPeer::TYPE_TERRASSE, TypeHebergementI18nPeer::DESCRIPTION, TypeHebergementI18nPeer::COMPOSITION, TypeHebergementI18nPeer::PRESENTATION, TypeHebergementI18nPeer::CAPACITE_HEBERGEMENT, TypeHebergementI18nPeer::DIMENSIONS, TypeHebergementI18nPeer::AGENCEMENT, TypeHebergementI18nPeer::EQUIPEMENTS, TypeHebergementI18nPeer::ANNEE_UTILISATION, TypeHebergementI18nPeer::REMARQUE_1, TypeHebergementI18nPeer::REMARQUE_2, TypeHebergementI18nPeer::REMARQUE_3, TypeHebergementI18nPeer::REMARQUE_4, TypeHebergementI18nPeer::SEO_TITLE, TypeHebergementI18nPeer::SEO_DESCRIPTION, TypeHebergementI18nPeer::SEO_H1, TypeHebergementI18nPeer::SEO_KEYWORDS, TypeHebergementI18nPeer::ACTIVE_LOCALE, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID', 'LOCALE', 'NAME', 'SLUG', 'INDICE', 'SURFACE', 'TYPE_TERRASSE', 'DESCRIPTION', 'COMPOSITION', 'PRESENTATION', 'CAPACITE_HEBERGEMENT', 'DIMENSIONS', 'AGENCEMENT', 'EQUIPEMENTS', 'ANNEE_UTILISATION', 'REMARQUE_1', 'REMARQUE_2', 'REMARQUE_3', 'REMARQUE_4', 'SEO_TITLE', 'SEO_DESCRIPTION', 'SEO_H1', 'SEO_KEYWORDS', 'ACTIVE_LOCALE', ),
        BasePeer::TYPE_FIELDNAME => array ('id', 'locale', 'name', 'slug', 'indice', 'surface', 'type_terrasse', 'description', 'composition', 'presentation', 'capacite_hebergement', 'dimensions', 'agencement', 'equipements', 'annee_utilisation', 'remarque_1', 'remarque_2', 'remarque_3', 'remarque_4', 'seo_title', 'seo_description', 'seo_h1', 'seo_keywords', 'active_locale', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. TypeHebergementI18nPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Locale' => 1, 'Name' => 2, 'Slug' => 3, 'Indice' => 4, 'Surface' => 5, 'TypeTerrasse' => 6, 'Description' => 7, 'Composition' => 8, 'Presentation' => 9, 'CapaciteHebergement' => 10, 'Dimensions' => 11, 'Agencement' => 12, 'Equipements' => 13, 'AnneeUtilisation' => 14, 'Remarque1' => 15, 'Remarque2' => 16, 'Remarque3' => 17, 'Remarque4' => 18, 'SeoTitle' => 19, 'SeoDescription' => 20, 'SeoH1' => 21, 'SeoKeywords' => 22, 'ActiveLocale' => 23, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'locale' => 1, 'name' => 2, 'slug' => 3, 'indice' => 4, 'surface' => 5, 'typeTerrasse' => 6, 'description' => 7, 'composition' => 8, 'presentation' => 9, 'capaciteHebergement' => 10, 'dimensions' => 11, 'agencement' => 12, 'equipements' => 13, 'anneeUtilisation' => 14, 'remarque1' => 15, 'remarque2' => 16, 'remarque3' => 17, 'remarque4' => 18, 'seoTitle' => 19, 'seoDescription' => 20, 'seoH1' => 21, 'seoKeywords' => 22, 'activeLocale' => 23, ),
        BasePeer::TYPE_COLNAME => array (TypeHebergementI18nPeer::ID => 0, TypeHebergementI18nPeer::LOCALE => 1, TypeHebergementI18nPeer::NAME => 2, TypeHebergementI18nPeer::SLUG => 3, TypeHebergementI18nPeer::INDICE => 4, TypeHebergementI18nPeer::SURFACE => 5, TypeHebergementI18nPeer::TYPE_TERRASSE => 6, TypeHebergementI18nPeer::DESCRIPTION => 7, TypeHebergementI18nPeer::COMPOSITION => 8, TypeHebergementI18nPeer::PRESENTATION => 9, TypeHebergementI18nPeer::CAPACITE_HEBERGEMENT => 10, TypeHebergementI18nPeer::DIMENSIONS => 11, TypeHebergementI18nPeer::AGENCEMENT => 12, TypeHebergementI18nPeer::EQUIPEMENTS => 13, TypeHebergementI18nPeer::ANNEE_UTILISATION => 14, TypeHebergementI18nPeer::REMARQUE_1 => 15, TypeHebergementI18nPeer::REMARQUE_2 => 16, TypeHebergementI18nPeer::REMARQUE_3 => 17, TypeHebergementI18nPeer::REMARQUE_4 => 18, TypeHebergementI18nPeer::SEO_TITLE => 19, TypeHebergementI18nPeer::SEO_DESCRIPTION => 20, TypeHebergementI18nPeer::SEO_H1 => 21, TypeHebergementI18nPeer::SEO_KEYWORDS => 22, TypeHebergementI18nPeer::ACTIVE_LOCALE => 23, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID' => 0, 'LOCALE' => 1, 'NAME' => 2, 'SLUG' => 3, 'INDICE' => 4, 'SURFACE' => 5, 'TYPE_TERRASSE' => 6, 'DESCRIPTION' => 7, 'COMPOSITION' => 8, 'PRESENTATION' => 9, 'CAPACITE_HEBERGEMENT' => 10, 'DIMENSIONS' => 11, 'AGENCEMENT' => 12, 'EQUIPEMENTS' => 13, 'ANNEE_UTILISATION' => 14, 'REMARQUE_1' => 15, 'REMARQUE_2' => 16, 'REMARQUE_3' => 17, 'REMARQUE_4' => 18, 'SEO_TITLE' => 19, 'SEO_DESCRIPTION' => 20, 'SEO_H1' => 21, 'SEO_KEYWORDS' => 22, 'ACTIVE_LOCALE' => 23, ),
        BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'locale' => 1, 'name' => 2, 'slug' => 3, 'indice' => 4, 'surface' => 5, 'type_terrasse' => 6, 'description' => 7, 'composition' => 8, 'presentation' => 9, 'capacite_hebergement' => 10, 'dimensions' => 11, 'agencement' => 12, 'equipements' => 13, 'annee_utilisation' => 14, 'remarque_1' => 15, 'remarque_2' => 16, 'remarque_3' => 17, 'remarque_4' => 18, 'seo_title' => 19, 'seo_description' => 20, 'seo_h1' => 21, 'seo_keywords' => 22, 'active_locale' => 23, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, )
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
        $toNames = TypeHebergementI18nPeer::getFieldNames($toType);
        $key = isset(TypeHebergementI18nPeer::$fieldKeys[$fromType][$name]) ? TypeHebergementI18nPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(TypeHebergementI18nPeer::$fieldKeys[$fromType], true));
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
        if (!array_key_exists($type, TypeHebergementI18nPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return TypeHebergementI18nPeer::$fieldNames[$type];
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
     * @param      string $column The column name for current table. (i.e. TypeHebergementI18nPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(TypeHebergementI18nPeer::TABLE_NAME.'.', $alias.'.', $column);
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
            $criteria->addSelectColumn(TypeHebergementI18nPeer::ID);
            $criteria->addSelectColumn(TypeHebergementI18nPeer::LOCALE);
            $criteria->addSelectColumn(TypeHebergementI18nPeer::NAME);
            $criteria->addSelectColumn(TypeHebergementI18nPeer::SLUG);
            $criteria->addSelectColumn(TypeHebergementI18nPeer::INDICE);
            $criteria->addSelectColumn(TypeHebergementI18nPeer::SURFACE);
            $criteria->addSelectColumn(TypeHebergementI18nPeer::TYPE_TERRASSE);
            $criteria->addSelectColumn(TypeHebergementI18nPeer::DESCRIPTION);
            $criteria->addSelectColumn(TypeHebergementI18nPeer::COMPOSITION);
            $criteria->addSelectColumn(TypeHebergementI18nPeer::PRESENTATION);
            $criteria->addSelectColumn(TypeHebergementI18nPeer::CAPACITE_HEBERGEMENT);
            $criteria->addSelectColumn(TypeHebergementI18nPeer::DIMENSIONS);
            $criteria->addSelectColumn(TypeHebergementI18nPeer::AGENCEMENT);
            $criteria->addSelectColumn(TypeHebergementI18nPeer::EQUIPEMENTS);
            $criteria->addSelectColumn(TypeHebergementI18nPeer::ANNEE_UTILISATION);
            $criteria->addSelectColumn(TypeHebergementI18nPeer::REMARQUE_1);
            $criteria->addSelectColumn(TypeHebergementI18nPeer::REMARQUE_2);
            $criteria->addSelectColumn(TypeHebergementI18nPeer::REMARQUE_3);
            $criteria->addSelectColumn(TypeHebergementI18nPeer::REMARQUE_4);
            $criteria->addSelectColumn(TypeHebergementI18nPeer::SEO_TITLE);
            $criteria->addSelectColumn(TypeHebergementI18nPeer::SEO_DESCRIPTION);
            $criteria->addSelectColumn(TypeHebergementI18nPeer::SEO_H1);
            $criteria->addSelectColumn(TypeHebergementI18nPeer::SEO_KEYWORDS);
            $criteria->addSelectColumn(TypeHebergementI18nPeer::ACTIVE_LOCALE);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.locale');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.slug');
            $criteria->addSelectColumn($alias . '.indice');
            $criteria->addSelectColumn($alias . '.surface');
            $criteria->addSelectColumn($alias . '.type_terrasse');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.composition');
            $criteria->addSelectColumn($alias . '.presentation');
            $criteria->addSelectColumn($alias . '.capacite_hebergement');
            $criteria->addSelectColumn($alias . '.dimensions');
            $criteria->addSelectColumn($alias . '.agencement');
            $criteria->addSelectColumn($alias . '.equipements');
            $criteria->addSelectColumn($alias . '.annee_utilisation');
            $criteria->addSelectColumn($alias . '.remarque_1');
            $criteria->addSelectColumn($alias . '.remarque_2');
            $criteria->addSelectColumn($alias . '.remarque_3');
            $criteria->addSelectColumn($alias . '.remarque_4');
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
        $criteria->setPrimaryTableName(TypeHebergementI18nPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            TypeHebergementI18nPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(TypeHebergementI18nPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(TypeHebergementI18nPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 TypeHebergementI18n
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = TypeHebergementI18nPeer::doSelect($critcopy, $con);
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
        return TypeHebergementI18nPeer::populateObjects(TypeHebergementI18nPeer::doSelectStmt($criteria, $con));
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
            $con = Propel::getConnection(TypeHebergementI18nPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            TypeHebergementI18nPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(TypeHebergementI18nPeer::DATABASE_NAME);

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
     * @param      TypeHebergementI18n $obj A TypeHebergementI18n object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = serialize(array((string) $obj->getId(), (string) $obj->getLocale()));
            } // if key === null
            TypeHebergementI18nPeer::$instances[$key] = $obj;
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
     * @param      mixed $value A TypeHebergementI18n object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof TypeHebergementI18n) {
                $key = serialize(array((string) $value->getId(), (string) $value->getLocale()));
            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key
                $key = serialize(array((string) $value[0], (string) $value[1]));
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or TypeHebergementI18n object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(TypeHebergementI18nPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return   TypeHebergementI18n Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(TypeHebergementI18nPeer::$instances[$key])) {
                return TypeHebergementI18nPeer::$instances[$key];
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
        TypeHebergementI18nPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to type_hebergement_i18n
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
        $cls = TypeHebergementI18nPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = TypeHebergementI18nPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = TypeHebergementI18nPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                TypeHebergementI18nPeer::addInstanceToPool($obj, $key);
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
     * @return array (TypeHebergementI18n object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = TypeHebergementI18nPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = TypeHebergementI18nPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + TypeHebergementI18nPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = TypeHebergementI18nPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            TypeHebergementI18nPeer::addInstanceToPool($obj, $key);
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
        $criteria->setPrimaryTableName(TypeHebergementI18nPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            TypeHebergementI18nPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(TypeHebergementI18nPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(TypeHebergementI18nPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(TypeHebergementI18nPeer::ID, TypeHebergementPeer::ID, $join_behavior);

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
     * Selects a collection of TypeHebergementI18n objects pre-filled with their TypeHebergement objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of TypeHebergementI18n objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinTypeHebergement(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(TypeHebergementI18nPeer::DATABASE_NAME);
        }

        TypeHebergementI18nPeer::addSelectColumns($criteria);
        $startcol = TypeHebergementI18nPeer::NUM_HYDRATE_COLUMNS;
        TypeHebergementPeer::addSelectColumns($criteria);

        $criteria->addJoin(TypeHebergementI18nPeer::ID, TypeHebergementPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = TypeHebergementI18nPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = TypeHebergementI18nPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = TypeHebergementI18nPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                TypeHebergementI18nPeer::addInstanceToPool($obj1, $key1);
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

                // Add the $obj1 (TypeHebergementI18n) to $obj2 (TypeHebergement)
                $obj2->addTypeHebergementI18n($obj1);

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
        $criteria->setPrimaryTableName(TypeHebergementI18nPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            TypeHebergementI18nPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(TypeHebergementI18nPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(TypeHebergementI18nPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(TypeHebergementI18nPeer::ID, TypeHebergementPeer::ID, $join_behavior);

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
     * Selects a collection of TypeHebergementI18n objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of TypeHebergementI18n objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(TypeHebergementI18nPeer::DATABASE_NAME);
        }

        TypeHebergementI18nPeer::addSelectColumns($criteria);
        $startcol2 = TypeHebergementI18nPeer::NUM_HYDRATE_COLUMNS;

        TypeHebergementPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + TypeHebergementPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(TypeHebergementI18nPeer::ID, TypeHebergementPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = TypeHebergementI18nPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = TypeHebergementI18nPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = TypeHebergementI18nPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                TypeHebergementI18nPeer::addInstanceToPool($obj1, $key1);
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

                // Add the $obj1 (TypeHebergementI18n) to the collection in $obj2 (TypeHebergement)
                $obj2->addTypeHebergementI18n($obj1);
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
        return Propel::getDatabaseMap(TypeHebergementI18nPeer::DATABASE_NAME)->getTable(TypeHebergementI18nPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseTypeHebergementI18nPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseTypeHebergementI18nPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new TypeHebergementI18nTableMap());
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
        return TypeHebergementI18nPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a TypeHebergementI18n or Criteria object.
     *
     * @param      mixed $values Criteria or TypeHebergementI18n object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(TypeHebergementI18nPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from TypeHebergementI18n object
        }


        // Set the correct dbName
        $criteria->setDbName(TypeHebergementI18nPeer::DATABASE_NAME);

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
     * Performs an UPDATE on the database, given a TypeHebergementI18n or Criteria object.
     *
     * @param      mixed $values Criteria or TypeHebergementI18n object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(TypeHebergementI18nPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(TypeHebergementI18nPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(TypeHebergementI18nPeer::ID);
            $value = $criteria->remove(TypeHebergementI18nPeer::ID);
            if ($value) {
                $selectCriteria->add(TypeHebergementI18nPeer::ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(TypeHebergementI18nPeer::TABLE_NAME);
            }

            $comparison = $criteria->getComparison(TypeHebergementI18nPeer::LOCALE);
            $value = $criteria->remove(TypeHebergementI18nPeer::LOCALE);
            if ($value) {
                $selectCriteria->add(TypeHebergementI18nPeer::LOCALE, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(TypeHebergementI18nPeer::TABLE_NAME);
            }

        } else { // $values is TypeHebergementI18n object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(TypeHebergementI18nPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the type_hebergement_i18n table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(TypeHebergementI18nPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(TypeHebergementI18nPeer::TABLE_NAME, $con, TypeHebergementI18nPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TypeHebergementI18nPeer::clearInstancePool();
            TypeHebergementI18nPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a TypeHebergementI18n or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or TypeHebergementI18n object or primary key or array of primary keys
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
            $con = Propel::getConnection(TypeHebergementI18nPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            TypeHebergementI18nPeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof TypeHebergementI18n) { // it's a model object
            // invalidate the cache for this single object
            TypeHebergementI18nPeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(TypeHebergementI18nPeer::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = array($values);
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(TypeHebergementI18nPeer::ID, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(TypeHebergementI18nPeer::LOCALE, $value[1]));
                $criteria->addOr($criterion);
                // we can invalidate the cache for this single PK
                TypeHebergementI18nPeer::removeInstanceFromPool($value);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(TypeHebergementI18nPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            TypeHebergementI18nPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given TypeHebergementI18n object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param      TypeHebergementI18n $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(TypeHebergementI18nPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(TypeHebergementI18nPeer::TABLE_NAME);

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

        return BasePeer::doValidate(TypeHebergementI18nPeer::DATABASE_NAME, TypeHebergementI18nPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve object using using composite pkey values.
     * @param   int $id
     * @param   string $locale
     * @param      PropelPDO $con
     * @return   TypeHebergementI18n
     */
    public static function retrieveByPK($id, $locale, PropelPDO $con = null) {
        $_instancePoolKey = serialize(array((string) $id, (string) $locale));
         if (null !== ($obj = TypeHebergementI18nPeer::getInstanceFromPool($_instancePoolKey))) {
             return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(TypeHebergementI18nPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $criteria = new Criteria(TypeHebergementI18nPeer::DATABASE_NAME);
        $criteria->add(TypeHebergementI18nPeer::ID, $id);
        $criteria->add(TypeHebergementI18nPeer::LOCALE, $locale);
        $v = TypeHebergementI18nPeer::doSelect($criteria, $con);

        return !empty($v) ? $v[0] : null;
    }
} // BaseTypeHebergementI18nPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseTypeHebergementI18nPeer::buildTableMap();

