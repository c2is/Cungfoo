<?php

namespace Cungfoo\Model\om;

use \BasePeer;
use \Criteria;
use \PDO;
use \PDOStatement;
use \Propel;
use \PropelException;
use \PropelPDO;
use Cungfoo\Model\BonPlanEtablissementPeer;
use Cungfoo\Model\CategoriePeer;
use Cungfoo\Model\DepartementPeer;
use Cungfoo\Model\Etablissement;
use Cungfoo\Model\EtablissementActivitePeer;
use Cungfoo\Model\EtablissementBaignadePeer;
use Cungfoo\Model\EtablissementDestinationPeer;
use Cungfoo\Model\EtablissementEventPeer;
use Cungfoo\Model\EtablissementI18nPeer;
use Cungfoo\Model\EtablissementPeer;
use Cungfoo\Model\EtablissementPointInteretPeer;
use Cungfoo\Model\EtablissementServiceComplementairePeer;
use Cungfoo\Model\EtablissementSituationGeographiquePeer;
use Cungfoo\Model\EtablissementThematiquePeer;
use Cungfoo\Model\EtablissementTypeHebergementPeer;
use Cungfoo\Model\PersonnagePeer;
use Cungfoo\Model\TopCampingPeer;
use Cungfoo\Model\VillePeer;
use Cungfoo\Model\map\EtablissementTableMap;

/**
 * Base static class for performing query and update operations on the 'etablissement' table.
 *
 *
 *
 * @package propel.generator.Cungfoo.Model.om
 */
abstract class BaseEtablissementPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'cungfoo';

    /** the table name for this class */
    const TABLE_NAME = 'etablissement';

    /** the related Propel class for this table */
    const OM_CLASS = 'Cungfoo\\Model\\Etablissement';

    /** the related TableMap class for this table */
    const TM_CLASS = 'EtablissementTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 29;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 29;

    /** the column name for the id field */
    const ID = 'etablissement.id';

    /** the column name for the code field */
    const CODE = 'etablissement.code';

    /** the column name for the slug field */
    const SLUG = 'etablissement.slug';

    /** the column name for the name field */
    const NAME = 'etablissement.name';

    /** the column name for the title field */
    const TITLE = 'etablissement.title';

    /** the column name for the address1 field */
    const ADDRESS1 = 'etablissement.address1';

    /** the column name for the address2 field */
    const ADDRESS2 = 'etablissement.address2';

    /** the column name for the zip field */
    const ZIP = 'etablissement.zip';

    /** the column name for the city field */
    const CITY = 'etablissement.city';

    /** the column name for the mail field */
    const MAIL = 'etablissement.mail';

    /** the column name for the country_code field */
    const COUNTRY_CODE = 'etablissement.country_code';

    /** the column name for the phone1 field */
    const PHONE1 = 'etablissement.phone1';

    /** the column name for the phone2 field */
    const PHONE2 = 'etablissement.phone2';

    /** the column name for the fax field */
    const FAX = 'etablissement.fax';

    /** the column name for the opening_date field */
    const OPENING_DATE = 'etablissement.opening_date';

    /** the column name for the closing_date field */
    const CLOSING_DATE = 'etablissement.closing_date';

    /** the column name for the ville_id field */
    const VILLE_ID = 'etablissement.ville_id';

    /** the column name for the departement_id field */
    const DEPARTEMENT_ID = 'etablissement.departement_id';

    /** the column name for the categorie_id field */
    const CATEGORIE_ID = 'etablissement.categorie_id';

    /** the column name for the geo_coordinate_x field */
    const GEO_COORDINATE_X = 'etablissement.geo_coordinate_x';

    /** the column name for the geo_coordinate_y field */
    const GEO_COORDINATE_Y = 'etablissement.geo_coordinate_y';

    /** the column name for the video_path field */
    const VIDEO_PATH = 'etablissement.video_path';

    /** the column name for the image_360_path field */
    const IMAGE_360_PATH = 'etablissement.image_360_path';

    /** the column name for the capacite field */
    const CAPACITE = 'etablissement.capacite';

    /** the column name for the related_1 field */
    const RELATED_1 = 'etablissement.related_1';

    /** the column name for the related_2 field */
    const RELATED_2 = 'etablissement.related_2';

    /** the column name for the created_at field */
    const CREATED_AT = 'etablissement.created_at';

    /** the column name for the updated_at field */
    const UPDATED_AT = 'etablissement.updated_at';

    /** the column name for the active field */
    const ACTIVE = 'etablissement.active';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identiy map to hold any loaded instances of Etablissement objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array Etablissement[]
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
     * e.g. EtablissementPeer::$fieldNames[EtablissementPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Id', 'Code', 'Slug', 'Name', 'Title', 'Address1', 'Address2', 'Zip', 'City', 'Mail', 'CountryCode', 'Phone1', 'Phone2', 'Fax', 'OpeningDate', 'ClosingDate', 'VilleId', 'DepartementId', 'CategorieId', 'GeoCoordinateX', 'GeoCoordinateY', 'VideoPath', 'Image360Path', 'Capacite', 'Related1', 'Related2', 'CreatedAt', 'UpdatedAt', 'Active', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'code', 'slug', 'name', 'title', 'address1', 'address2', 'zip', 'city', 'mail', 'countryCode', 'phone1', 'phone2', 'fax', 'openingDate', 'closingDate', 'villeId', 'departementId', 'categorieId', 'geoCoordinateX', 'geoCoordinateY', 'videoPath', 'image360Path', 'capacite', 'related1', 'related2', 'createdAt', 'updatedAt', 'active', ),
        BasePeer::TYPE_COLNAME => array (EtablissementPeer::ID, EtablissementPeer::CODE, EtablissementPeer::SLUG, EtablissementPeer::NAME, EtablissementPeer::TITLE, EtablissementPeer::ADDRESS1, EtablissementPeer::ADDRESS2, EtablissementPeer::ZIP, EtablissementPeer::CITY, EtablissementPeer::MAIL, EtablissementPeer::COUNTRY_CODE, EtablissementPeer::PHONE1, EtablissementPeer::PHONE2, EtablissementPeer::FAX, EtablissementPeer::OPENING_DATE, EtablissementPeer::CLOSING_DATE, EtablissementPeer::VILLE_ID, EtablissementPeer::DEPARTEMENT_ID, EtablissementPeer::CATEGORIE_ID, EtablissementPeer::GEO_COORDINATE_X, EtablissementPeer::GEO_COORDINATE_Y, EtablissementPeer::VIDEO_PATH, EtablissementPeer::IMAGE_360_PATH, EtablissementPeer::CAPACITE, EtablissementPeer::RELATED_1, EtablissementPeer::RELATED_2, EtablissementPeer::CREATED_AT, EtablissementPeer::UPDATED_AT, EtablissementPeer::ACTIVE, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID', 'CODE', 'SLUG', 'NAME', 'TITLE', 'ADDRESS1', 'ADDRESS2', 'ZIP', 'CITY', 'MAIL', 'COUNTRY_CODE', 'PHONE1', 'PHONE2', 'FAX', 'OPENING_DATE', 'CLOSING_DATE', 'VILLE_ID', 'DEPARTEMENT_ID', 'CATEGORIE_ID', 'GEO_COORDINATE_X', 'GEO_COORDINATE_Y', 'VIDEO_PATH', 'IMAGE_360_PATH', 'CAPACITE', 'RELATED_1', 'RELATED_2', 'CREATED_AT', 'UPDATED_AT', 'ACTIVE', ),
        BasePeer::TYPE_FIELDNAME => array ('id', 'code', 'slug', 'name', 'title', 'address1', 'address2', 'zip', 'city', 'mail', 'country_code', 'phone1', 'phone2', 'fax', 'opening_date', 'closing_date', 'ville_id', 'departement_id', 'categorie_id', 'geo_coordinate_x', 'geo_coordinate_y', 'video_path', 'image_360_path', 'capacite', 'related_1', 'related_2', 'created_at', 'updated_at', 'active', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. EtablissementPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Code' => 1, 'Slug' => 2, 'Name' => 3, 'Title' => 4, 'Address1' => 5, 'Address2' => 6, 'Zip' => 7, 'City' => 8, 'Mail' => 9, 'CountryCode' => 10, 'Phone1' => 11, 'Phone2' => 12, 'Fax' => 13, 'OpeningDate' => 14, 'ClosingDate' => 15, 'VilleId' => 16, 'DepartementId' => 17, 'CategorieId' => 18, 'GeoCoordinateX' => 19, 'GeoCoordinateY' => 20, 'VideoPath' => 21, 'Image360Path' => 22, 'Capacite' => 23, 'Related1' => 24, 'Related2' => 25, 'CreatedAt' => 26, 'UpdatedAt' => 27, 'Active' => 28, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'code' => 1, 'slug' => 2, 'name' => 3, 'title' => 4, 'address1' => 5, 'address2' => 6, 'zip' => 7, 'city' => 8, 'mail' => 9, 'countryCode' => 10, 'phone1' => 11, 'phone2' => 12, 'fax' => 13, 'openingDate' => 14, 'closingDate' => 15, 'villeId' => 16, 'departementId' => 17, 'categorieId' => 18, 'geoCoordinateX' => 19, 'geoCoordinateY' => 20, 'videoPath' => 21, 'image360Path' => 22, 'capacite' => 23, 'related1' => 24, 'related2' => 25, 'createdAt' => 26, 'updatedAt' => 27, 'active' => 28, ),
        BasePeer::TYPE_COLNAME => array (EtablissementPeer::ID => 0, EtablissementPeer::CODE => 1, EtablissementPeer::SLUG => 2, EtablissementPeer::NAME => 3, EtablissementPeer::TITLE => 4, EtablissementPeer::ADDRESS1 => 5, EtablissementPeer::ADDRESS2 => 6, EtablissementPeer::ZIP => 7, EtablissementPeer::CITY => 8, EtablissementPeer::MAIL => 9, EtablissementPeer::COUNTRY_CODE => 10, EtablissementPeer::PHONE1 => 11, EtablissementPeer::PHONE2 => 12, EtablissementPeer::FAX => 13, EtablissementPeer::OPENING_DATE => 14, EtablissementPeer::CLOSING_DATE => 15, EtablissementPeer::VILLE_ID => 16, EtablissementPeer::DEPARTEMENT_ID => 17, EtablissementPeer::CATEGORIE_ID => 18, EtablissementPeer::GEO_COORDINATE_X => 19, EtablissementPeer::GEO_COORDINATE_Y => 20, EtablissementPeer::VIDEO_PATH => 21, EtablissementPeer::IMAGE_360_PATH => 22, EtablissementPeer::CAPACITE => 23, EtablissementPeer::RELATED_1 => 24, EtablissementPeer::RELATED_2 => 25, EtablissementPeer::CREATED_AT => 26, EtablissementPeer::UPDATED_AT => 27, EtablissementPeer::ACTIVE => 28, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID' => 0, 'CODE' => 1, 'SLUG' => 2, 'NAME' => 3, 'TITLE' => 4, 'ADDRESS1' => 5, 'ADDRESS2' => 6, 'ZIP' => 7, 'CITY' => 8, 'MAIL' => 9, 'COUNTRY_CODE' => 10, 'PHONE1' => 11, 'PHONE2' => 12, 'FAX' => 13, 'OPENING_DATE' => 14, 'CLOSING_DATE' => 15, 'VILLE_ID' => 16, 'DEPARTEMENT_ID' => 17, 'CATEGORIE_ID' => 18, 'GEO_COORDINATE_X' => 19, 'GEO_COORDINATE_Y' => 20, 'VIDEO_PATH' => 21, 'IMAGE_360_PATH' => 22, 'CAPACITE' => 23, 'RELATED_1' => 24, 'RELATED_2' => 25, 'CREATED_AT' => 26, 'UPDATED_AT' => 27, 'ACTIVE' => 28, ),
        BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'code' => 1, 'slug' => 2, 'name' => 3, 'title' => 4, 'address1' => 5, 'address2' => 6, 'zip' => 7, 'city' => 8, 'mail' => 9, 'country_code' => 10, 'phone1' => 11, 'phone2' => 12, 'fax' => 13, 'opening_date' => 14, 'closing_date' => 15, 'ville_id' => 16, 'departement_id' => 17, 'categorie_id' => 18, 'geo_coordinate_x' => 19, 'geo_coordinate_y' => 20, 'video_path' => 21, 'image_360_path' => 22, 'capacite' => 23, 'related_1' => 24, 'related_2' => 25, 'created_at' => 26, 'updated_at' => 27, 'active' => 28, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, )
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
        $toNames = EtablissementPeer::getFieldNames($toType);
        $key = isset(EtablissementPeer::$fieldKeys[$fromType][$name]) ? EtablissementPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(EtablissementPeer::$fieldKeys[$fromType], true));
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
        if (!array_key_exists($type, EtablissementPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return EtablissementPeer::$fieldNames[$type];
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
     * @param      string $column The column name for current table. (i.e. EtablissementPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(EtablissementPeer::TABLE_NAME.'.', $alias.'.', $column);
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
            $criteria->addSelectColumn(EtablissementPeer::ID);
            $criteria->addSelectColumn(EtablissementPeer::CODE);
            $criteria->addSelectColumn(EtablissementPeer::SLUG);
            $criteria->addSelectColumn(EtablissementPeer::NAME);
            $criteria->addSelectColumn(EtablissementPeer::TITLE);
            $criteria->addSelectColumn(EtablissementPeer::ADDRESS1);
            $criteria->addSelectColumn(EtablissementPeer::ADDRESS2);
            $criteria->addSelectColumn(EtablissementPeer::ZIP);
            $criteria->addSelectColumn(EtablissementPeer::CITY);
            $criteria->addSelectColumn(EtablissementPeer::MAIL);
            $criteria->addSelectColumn(EtablissementPeer::COUNTRY_CODE);
            $criteria->addSelectColumn(EtablissementPeer::PHONE1);
            $criteria->addSelectColumn(EtablissementPeer::PHONE2);
            $criteria->addSelectColumn(EtablissementPeer::FAX);
            $criteria->addSelectColumn(EtablissementPeer::OPENING_DATE);
            $criteria->addSelectColumn(EtablissementPeer::CLOSING_DATE);
            $criteria->addSelectColumn(EtablissementPeer::VILLE_ID);
            $criteria->addSelectColumn(EtablissementPeer::DEPARTEMENT_ID);
            $criteria->addSelectColumn(EtablissementPeer::CATEGORIE_ID);
            $criteria->addSelectColumn(EtablissementPeer::GEO_COORDINATE_X);
            $criteria->addSelectColumn(EtablissementPeer::GEO_COORDINATE_Y);
            $criteria->addSelectColumn(EtablissementPeer::VIDEO_PATH);
            $criteria->addSelectColumn(EtablissementPeer::IMAGE_360_PATH);
            $criteria->addSelectColumn(EtablissementPeer::CAPACITE);
            $criteria->addSelectColumn(EtablissementPeer::RELATED_1);
            $criteria->addSelectColumn(EtablissementPeer::RELATED_2);
            $criteria->addSelectColumn(EtablissementPeer::CREATED_AT);
            $criteria->addSelectColumn(EtablissementPeer::UPDATED_AT);
            $criteria->addSelectColumn(EtablissementPeer::ACTIVE);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.code');
            $criteria->addSelectColumn($alias . '.slug');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.title');
            $criteria->addSelectColumn($alias . '.address1');
            $criteria->addSelectColumn($alias . '.address2');
            $criteria->addSelectColumn($alias . '.zip');
            $criteria->addSelectColumn($alias . '.city');
            $criteria->addSelectColumn($alias . '.mail');
            $criteria->addSelectColumn($alias . '.country_code');
            $criteria->addSelectColumn($alias . '.phone1');
            $criteria->addSelectColumn($alias . '.phone2');
            $criteria->addSelectColumn($alias . '.fax');
            $criteria->addSelectColumn($alias . '.opening_date');
            $criteria->addSelectColumn($alias . '.closing_date');
            $criteria->addSelectColumn($alias . '.ville_id');
            $criteria->addSelectColumn($alias . '.departement_id');
            $criteria->addSelectColumn($alias . '.categorie_id');
            $criteria->addSelectColumn($alias . '.geo_coordinate_x');
            $criteria->addSelectColumn($alias . '.geo_coordinate_y');
            $criteria->addSelectColumn($alias . '.video_path');
            $criteria->addSelectColumn($alias . '.image_360_path');
            $criteria->addSelectColumn($alias . '.capacite');
            $criteria->addSelectColumn($alias . '.related_1');
            $criteria->addSelectColumn($alias . '.related_2');
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
        $criteria->setPrimaryTableName(EtablissementPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            EtablissementPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(EtablissementPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(EtablissementPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Etablissement
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = EtablissementPeer::doSelect($critcopy, $con);
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
        return EtablissementPeer::populateObjects(EtablissementPeer::doSelectStmt($criteria, $con));
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
            $con = Propel::getConnection(EtablissementPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            EtablissementPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(EtablissementPeer::DATABASE_NAME);

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
     * @param      Etablissement $obj A Etablissement object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getId();
            } // if key === null
            EtablissementPeer::$instances[$key] = $obj;
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
     * @param      mixed $value A Etablissement object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof Etablissement) {
                $key = (string) $value->getId();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Etablissement object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(EtablissementPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return   Etablissement Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(EtablissementPeer::$instances[$key])) {
                return EtablissementPeer::$instances[$key];
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
        EtablissementPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to etablissement
     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in EtablissementPeer instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        EtablissementPeer::clearInstancePool();
        // Invalidate objects in EtablissementPeer instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        EtablissementPeer::clearInstancePool();
        // Invalidate objects in EtablissementTypeHebergementPeer instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        EtablissementTypeHebergementPeer::clearInstancePool();
        // Invalidate objects in EtablissementDestinationPeer instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        EtablissementDestinationPeer::clearInstancePool();
        // Invalidate objects in EtablissementActivitePeer instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        EtablissementActivitePeer::clearInstancePool();
        // Invalidate objects in EtablissementServiceComplementairePeer instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        EtablissementServiceComplementairePeer::clearInstancePool();
        // Invalidate objects in EtablissementSituationGeographiquePeer instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        EtablissementSituationGeographiquePeer::clearInstancePool();
        // Invalidate objects in EtablissementBaignadePeer instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        EtablissementBaignadePeer::clearInstancePool();
        // Invalidate objects in EtablissementThematiquePeer instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        EtablissementThematiquePeer::clearInstancePool();
        // Invalidate objects in EtablissementPointInteretPeer instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        EtablissementPointInteretPeer::clearInstancePool();
        // Invalidate objects in EtablissementEventPeer instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        EtablissementEventPeer::clearInstancePool();
        // Invalidate objects in PersonnagePeer instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        PersonnagePeer::clearInstancePool();
        // Invalidate objects in TopCampingPeer instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        TopCampingPeer::clearInstancePool();
        // Invalidate objects in BonPlanEtablissementPeer instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        BonPlanEtablissementPeer::clearInstancePool();
        // Invalidate objects in EtablissementI18nPeer instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        EtablissementI18nPeer::clearInstancePool();
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
        $cls = EtablissementPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = EtablissementPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = EtablissementPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                EtablissementPeer::addInstanceToPool($obj, $key);
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
     * @return array (Etablissement object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = EtablissementPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = EtablissementPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + EtablissementPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = EtablissementPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            EtablissementPeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }


    /**
     * Returns the number of rows matching criteria, joining the related Ville table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinVille(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(EtablissementPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            EtablissementPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(EtablissementPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(EtablissementPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(EtablissementPeer::VILLE_ID, VillePeer::ID, $join_behavior);

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
        $criteria->setPrimaryTableName(EtablissementPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            EtablissementPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(EtablissementPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(EtablissementPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(EtablissementPeer::DEPARTEMENT_ID, DepartementPeer::ID, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related Categorie table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinCategorie(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(EtablissementPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            EtablissementPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(EtablissementPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(EtablissementPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(EtablissementPeer::CATEGORIE_ID, CategoriePeer::ID, $join_behavior);

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
     * Selects a collection of Etablissement objects pre-filled with their Ville objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Etablissement objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinVille(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(EtablissementPeer::DATABASE_NAME);
        }

        EtablissementPeer::addSelectColumns($criteria);
        $startcol = EtablissementPeer::NUM_HYDRATE_COLUMNS;
        VillePeer::addSelectColumns($criteria);

        $criteria->addJoin(EtablissementPeer::VILLE_ID, VillePeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = EtablissementPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = EtablissementPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = EtablissementPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                EtablissementPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = VillePeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = VillePeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = VillePeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    VillePeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (Etablissement) to $obj2 (Ville)
                $obj2->addEtablissement($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Etablissement objects pre-filled with their Departement objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Etablissement objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinDepartement(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(EtablissementPeer::DATABASE_NAME);
        }

        EtablissementPeer::addSelectColumns($criteria);
        $startcol = EtablissementPeer::NUM_HYDRATE_COLUMNS;
        DepartementPeer::addSelectColumns($criteria);

        $criteria->addJoin(EtablissementPeer::DEPARTEMENT_ID, DepartementPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = EtablissementPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = EtablissementPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = EtablissementPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                EtablissementPeer::addInstanceToPool($obj1, $key1);
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

                // Add the $obj1 (Etablissement) to $obj2 (Departement)
                $obj2->addEtablissement($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Etablissement objects pre-filled with their Categorie objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Etablissement objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinCategorie(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(EtablissementPeer::DATABASE_NAME);
        }

        EtablissementPeer::addSelectColumns($criteria);
        $startcol = EtablissementPeer::NUM_HYDRATE_COLUMNS;
        CategoriePeer::addSelectColumns($criteria);

        $criteria->addJoin(EtablissementPeer::CATEGORIE_ID, CategoriePeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = EtablissementPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = EtablissementPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = EtablissementPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                EtablissementPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = CategoriePeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = CategoriePeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = CategoriePeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    CategoriePeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (Etablissement) to $obj2 (Categorie)
                $obj2->addEtablissement($obj1);

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
        $criteria->setPrimaryTableName(EtablissementPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            EtablissementPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(EtablissementPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(EtablissementPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(EtablissementPeer::VILLE_ID, VillePeer::ID, $join_behavior);

        $criteria->addJoin(EtablissementPeer::DEPARTEMENT_ID, DepartementPeer::ID, $join_behavior);

        $criteria->addJoin(EtablissementPeer::CATEGORIE_ID, CategoriePeer::ID, $join_behavior);

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
     * Selects a collection of Etablissement objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Etablissement objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(EtablissementPeer::DATABASE_NAME);
        }

        EtablissementPeer::addSelectColumns($criteria);
        $startcol2 = EtablissementPeer::NUM_HYDRATE_COLUMNS;

        VillePeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + VillePeer::NUM_HYDRATE_COLUMNS;

        DepartementPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + DepartementPeer::NUM_HYDRATE_COLUMNS;

        CategoriePeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + CategoriePeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(EtablissementPeer::VILLE_ID, VillePeer::ID, $join_behavior);

        $criteria->addJoin(EtablissementPeer::DEPARTEMENT_ID, DepartementPeer::ID, $join_behavior);

        $criteria->addJoin(EtablissementPeer::CATEGORIE_ID, CategoriePeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = EtablissementPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = EtablissementPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = EtablissementPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                EtablissementPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

            // Add objects for joined Ville rows

            $key2 = VillePeer::getPrimaryKeyHashFromRow($row, $startcol2);
            if ($key2 !== null) {
                $obj2 = VillePeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = VillePeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    VillePeer::addInstanceToPool($obj2, $key2);
                } // if obj2 loaded

                // Add the $obj1 (Etablissement) to the collection in $obj2 (Ville)
                $obj2->addEtablissement($obj1);
            } // if joined row not null

            // Add objects for joined Departement rows

            $key3 = DepartementPeer::getPrimaryKeyHashFromRow($row, $startcol3);
            if ($key3 !== null) {
                $obj3 = DepartementPeer::getInstanceFromPool($key3);
                if (!$obj3) {

                    $cls = DepartementPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    DepartementPeer::addInstanceToPool($obj3, $key3);
                } // if obj3 loaded

                // Add the $obj1 (Etablissement) to the collection in $obj3 (Departement)
                $obj3->addEtablissement($obj1);
            } // if joined row not null

            // Add objects for joined Categorie rows

            $key4 = CategoriePeer::getPrimaryKeyHashFromRow($row, $startcol4);
            if ($key4 !== null) {
                $obj4 = CategoriePeer::getInstanceFromPool($key4);
                if (!$obj4) {

                    $cls = CategoriePeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    CategoriePeer::addInstanceToPool($obj4, $key4);
                } // if obj4 loaded

                // Add the $obj1 (Etablissement) to the collection in $obj4 (Categorie)
                $obj4->addEtablissement($obj1);
            } // if joined row not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Returns the number of rows matching criteria, joining the related Ville table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptVille(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(EtablissementPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            EtablissementPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(EtablissementPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(EtablissementPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(EtablissementPeer::DEPARTEMENT_ID, DepartementPeer::ID, $join_behavior);

        $criteria->addJoin(EtablissementPeer::CATEGORIE_ID, CategoriePeer::ID, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related Departement table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptDepartement(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(EtablissementPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            EtablissementPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(EtablissementPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(EtablissementPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(EtablissementPeer::VILLE_ID, VillePeer::ID, $join_behavior);

        $criteria->addJoin(EtablissementPeer::CATEGORIE_ID, CategoriePeer::ID, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related Categorie table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptCategorie(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(EtablissementPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            EtablissementPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(EtablissementPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(EtablissementPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(EtablissementPeer::VILLE_ID, VillePeer::ID, $join_behavior);

        $criteria->addJoin(EtablissementPeer::DEPARTEMENT_ID, DepartementPeer::ID, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related EtablissementRelatedByRelated1 table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptEtablissementRelatedByRelated1(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(EtablissementPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            EtablissementPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(EtablissementPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(EtablissementPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(EtablissementPeer::VILLE_ID, VillePeer::ID, $join_behavior);

        $criteria->addJoin(EtablissementPeer::DEPARTEMENT_ID, DepartementPeer::ID, $join_behavior);

        $criteria->addJoin(EtablissementPeer::CATEGORIE_ID, CategoriePeer::ID, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related EtablissementRelatedByRelated2 table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptEtablissementRelatedByRelated2(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(EtablissementPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            EtablissementPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(EtablissementPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(EtablissementPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(EtablissementPeer::VILLE_ID, VillePeer::ID, $join_behavior);

        $criteria->addJoin(EtablissementPeer::DEPARTEMENT_ID, DepartementPeer::ID, $join_behavior);

        $criteria->addJoin(EtablissementPeer::CATEGORIE_ID, CategoriePeer::ID, $join_behavior);

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
     * Selects a collection of Etablissement objects pre-filled with all related objects except Ville.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Etablissement objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptVille(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(EtablissementPeer::DATABASE_NAME);
        }

        EtablissementPeer::addSelectColumns($criteria);
        $startcol2 = EtablissementPeer::NUM_HYDRATE_COLUMNS;

        DepartementPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + DepartementPeer::NUM_HYDRATE_COLUMNS;

        CategoriePeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + CategoriePeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(EtablissementPeer::DEPARTEMENT_ID, DepartementPeer::ID, $join_behavior);

        $criteria->addJoin(EtablissementPeer::CATEGORIE_ID, CategoriePeer::ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = EtablissementPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = EtablissementPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = EtablissementPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                EtablissementPeer::addInstanceToPool($obj1, $key1);
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
                } // if $obj2 already loaded

                // Add the $obj1 (Etablissement) to the collection in $obj2 (Departement)
                $obj2->addEtablissement($obj1);

            } // if joined row is not null

                // Add objects for joined Categorie rows

                $key3 = CategoriePeer::getPrimaryKeyHashFromRow($row, $startcol3);
                if ($key3 !== null) {
                    $obj3 = CategoriePeer::getInstanceFromPool($key3);
                    if (!$obj3) {

                        $cls = CategoriePeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    CategoriePeer::addInstanceToPool($obj3, $key3);
                } // if $obj3 already loaded

                // Add the $obj1 (Etablissement) to the collection in $obj3 (Categorie)
                $obj3->addEtablissement($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Etablissement objects pre-filled with all related objects except Departement.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Etablissement objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptDepartement(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(EtablissementPeer::DATABASE_NAME);
        }

        EtablissementPeer::addSelectColumns($criteria);
        $startcol2 = EtablissementPeer::NUM_HYDRATE_COLUMNS;

        VillePeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + VillePeer::NUM_HYDRATE_COLUMNS;

        CategoriePeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + CategoriePeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(EtablissementPeer::VILLE_ID, VillePeer::ID, $join_behavior);

        $criteria->addJoin(EtablissementPeer::CATEGORIE_ID, CategoriePeer::ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = EtablissementPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = EtablissementPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = EtablissementPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                EtablissementPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined Ville rows

                $key2 = VillePeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = VillePeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = VillePeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    VillePeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (Etablissement) to the collection in $obj2 (Ville)
                $obj2->addEtablissement($obj1);

            } // if joined row is not null

                // Add objects for joined Categorie rows

                $key3 = CategoriePeer::getPrimaryKeyHashFromRow($row, $startcol3);
                if ($key3 !== null) {
                    $obj3 = CategoriePeer::getInstanceFromPool($key3);
                    if (!$obj3) {

                        $cls = CategoriePeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    CategoriePeer::addInstanceToPool($obj3, $key3);
                } // if $obj3 already loaded

                // Add the $obj1 (Etablissement) to the collection in $obj3 (Categorie)
                $obj3->addEtablissement($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Etablissement objects pre-filled with all related objects except Categorie.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Etablissement objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptCategorie(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(EtablissementPeer::DATABASE_NAME);
        }

        EtablissementPeer::addSelectColumns($criteria);
        $startcol2 = EtablissementPeer::NUM_HYDRATE_COLUMNS;

        VillePeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + VillePeer::NUM_HYDRATE_COLUMNS;

        DepartementPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + DepartementPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(EtablissementPeer::VILLE_ID, VillePeer::ID, $join_behavior);

        $criteria->addJoin(EtablissementPeer::DEPARTEMENT_ID, DepartementPeer::ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = EtablissementPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = EtablissementPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = EtablissementPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                EtablissementPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined Ville rows

                $key2 = VillePeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = VillePeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = VillePeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    VillePeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (Etablissement) to the collection in $obj2 (Ville)
                $obj2->addEtablissement($obj1);

            } // if joined row is not null

                // Add objects for joined Departement rows

                $key3 = DepartementPeer::getPrimaryKeyHashFromRow($row, $startcol3);
                if ($key3 !== null) {
                    $obj3 = DepartementPeer::getInstanceFromPool($key3);
                    if (!$obj3) {

                        $cls = DepartementPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    DepartementPeer::addInstanceToPool($obj3, $key3);
                } // if $obj3 already loaded

                // Add the $obj1 (Etablissement) to the collection in $obj3 (Departement)
                $obj3->addEtablissement($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Etablissement objects pre-filled with all related objects except EtablissementRelatedByRelated1.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Etablissement objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptEtablissementRelatedByRelated1(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(EtablissementPeer::DATABASE_NAME);
        }

        EtablissementPeer::addSelectColumns($criteria);
        $startcol2 = EtablissementPeer::NUM_HYDRATE_COLUMNS;

        VillePeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + VillePeer::NUM_HYDRATE_COLUMNS;

        DepartementPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + DepartementPeer::NUM_HYDRATE_COLUMNS;

        CategoriePeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + CategoriePeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(EtablissementPeer::VILLE_ID, VillePeer::ID, $join_behavior);

        $criteria->addJoin(EtablissementPeer::DEPARTEMENT_ID, DepartementPeer::ID, $join_behavior);

        $criteria->addJoin(EtablissementPeer::CATEGORIE_ID, CategoriePeer::ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = EtablissementPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = EtablissementPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = EtablissementPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                EtablissementPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined Ville rows

                $key2 = VillePeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = VillePeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = VillePeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    VillePeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (Etablissement) to the collection in $obj2 (Ville)
                $obj2->addEtablissement($obj1);

            } // if joined row is not null

                // Add objects for joined Departement rows

                $key3 = DepartementPeer::getPrimaryKeyHashFromRow($row, $startcol3);
                if ($key3 !== null) {
                    $obj3 = DepartementPeer::getInstanceFromPool($key3);
                    if (!$obj3) {

                        $cls = DepartementPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    DepartementPeer::addInstanceToPool($obj3, $key3);
                } // if $obj3 already loaded

                // Add the $obj1 (Etablissement) to the collection in $obj3 (Departement)
                $obj3->addEtablissement($obj1);

            } // if joined row is not null

                // Add objects for joined Categorie rows

                $key4 = CategoriePeer::getPrimaryKeyHashFromRow($row, $startcol4);
                if ($key4 !== null) {
                    $obj4 = CategoriePeer::getInstanceFromPool($key4);
                    if (!$obj4) {

                        $cls = CategoriePeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    CategoriePeer::addInstanceToPool($obj4, $key4);
                } // if $obj4 already loaded

                // Add the $obj1 (Etablissement) to the collection in $obj4 (Categorie)
                $obj4->addEtablissement($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Etablissement objects pre-filled with all related objects except EtablissementRelatedByRelated2.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Etablissement objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptEtablissementRelatedByRelated2(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(EtablissementPeer::DATABASE_NAME);
        }

        EtablissementPeer::addSelectColumns($criteria);
        $startcol2 = EtablissementPeer::NUM_HYDRATE_COLUMNS;

        VillePeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + VillePeer::NUM_HYDRATE_COLUMNS;

        DepartementPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + DepartementPeer::NUM_HYDRATE_COLUMNS;

        CategoriePeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + CategoriePeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(EtablissementPeer::VILLE_ID, VillePeer::ID, $join_behavior);

        $criteria->addJoin(EtablissementPeer::DEPARTEMENT_ID, DepartementPeer::ID, $join_behavior);

        $criteria->addJoin(EtablissementPeer::CATEGORIE_ID, CategoriePeer::ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = EtablissementPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = EtablissementPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = EtablissementPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                EtablissementPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined Ville rows

                $key2 = VillePeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = VillePeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = VillePeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    VillePeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (Etablissement) to the collection in $obj2 (Ville)
                $obj2->addEtablissement($obj1);

            } // if joined row is not null

                // Add objects for joined Departement rows

                $key3 = DepartementPeer::getPrimaryKeyHashFromRow($row, $startcol3);
                if ($key3 !== null) {
                    $obj3 = DepartementPeer::getInstanceFromPool($key3);
                    if (!$obj3) {

                        $cls = DepartementPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    DepartementPeer::addInstanceToPool($obj3, $key3);
                } // if $obj3 already loaded

                // Add the $obj1 (Etablissement) to the collection in $obj3 (Departement)
                $obj3->addEtablissement($obj1);

            } // if joined row is not null

                // Add objects for joined Categorie rows

                $key4 = CategoriePeer::getPrimaryKeyHashFromRow($row, $startcol4);
                if ($key4 !== null) {
                    $obj4 = CategoriePeer::getInstanceFromPool($key4);
                    if (!$obj4) {

                        $cls = CategoriePeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    CategoriePeer::addInstanceToPool($obj4, $key4);
                } // if $obj4 already loaded

                // Add the $obj1 (Etablissement) to the collection in $obj4 (Categorie)
                $obj4->addEtablissement($obj1);

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
        return Propel::getDatabaseMap(EtablissementPeer::DATABASE_NAME)->getTable(EtablissementPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseEtablissementPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseEtablissementPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new EtablissementTableMap());
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
        return EtablissementPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a Etablissement or Criteria object.
     *
     * @param      mixed $values Criteria or Etablissement object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(EtablissementPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from Etablissement object
        }

        if ($criteria->containsKey(EtablissementPeer::ID) && $criteria->keyContainsValue(EtablissementPeer::ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.EtablissementPeer::ID.')');
        }


        // Set the correct dbName
        $criteria->setDbName(EtablissementPeer::DATABASE_NAME);

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
     * Performs an UPDATE on the database, given a Etablissement or Criteria object.
     *
     * @param      mixed $values Criteria or Etablissement object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(EtablissementPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(EtablissementPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(EtablissementPeer::ID);
            $value = $criteria->remove(EtablissementPeer::ID);
            if ($value) {
                $selectCriteria->add(EtablissementPeer::ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(EtablissementPeer::TABLE_NAME);
            }

        } else { // $values is Etablissement object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(EtablissementPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the etablissement table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(EtablissementPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(EtablissementPeer::TABLE_NAME, $con, EtablissementPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EtablissementPeer::clearInstancePool();
            EtablissementPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a Etablissement or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or Etablissement object or primary key or array of primary keys
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
            $con = Propel::getConnection(EtablissementPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            EtablissementPeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof Etablissement) { // it's a model object
            // invalidate the cache for this single object
            EtablissementPeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(EtablissementPeer::DATABASE_NAME);
            $criteria->add(EtablissementPeer::ID, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                EtablissementPeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(EtablissementPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            EtablissementPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given Etablissement object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param      Etablissement $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(EtablissementPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(EtablissementPeer::TABLE_NAME);

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

        return BasePeer::doValidate(EtablissementPeer::DATABASE_NAME, EtablissementPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param      int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return Etablissement
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = EtablissementPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(EtablissementPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(EtablissementPeer::DATABASE_NAME);
        $criteria->add(EtablissementPeer::ID, $pk);

        $v = EtablissementPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return Etablissement[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(EtablissementPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(EtablissementPeer::DATABASE_NAME);
            $criteria->add(EtablissementPeer::ID, $pks, Criteria::IN);
            $objs = EtablissementPeer::doSelect($criteria, $con);
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
            ->filterByTableRef(EtablissementPeer::TABLE_NAME)
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
            ->filterByTableRef(EtablissementPeer::TABLE_NAME)
            ->findOne()
        ;
    }
} // BaseEtablissementPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseEtablissementPeer::buildTableMap();

