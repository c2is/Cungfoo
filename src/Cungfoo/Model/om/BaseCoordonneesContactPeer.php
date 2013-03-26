<?php

namespace Cungfoo\Model\om;

use \BasePeer;
use \Criteria;
use \PDO;
use \PDOStatement;
use \Propel;
use \PropelException;
use \PropelPDO;
use Cungfoo\Model\CoordonneesContact;
use Cungfoo\Model\CoordonneesContactI18nPeer;
use Cungfoo\Model\CoordonneesContactPeer;
use Cungfoo\Model\map\CoordonneesContactTableMap;

/**
 * Base static class for performing query and update operations on the 'coordonnees_contact' table.
 *
 *
 *
 * @package propel.generator.Cungfoo.Model.om
 */
abstract class BaseCoordonneesContactPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'cungfoo';

    /** the table name for this class */
    const TABLE_NAME = 'coordonnees_contact';

    /** the related Propel class for this table */
    const OM_CLASS = 'Cungfoo\\Model\\CoordonneesContact';

    /** the related TableMap class for this table */
    const TM_CLASS = 'CoordonneesContactTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 16;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 16;

    /** the column name for the id field */
    const ID = 'coordonnees_contact.id';

    /** the column name for the civilite field */
    const CIVILITE = 'coordonnees_contact.civilite';

    /** the column name for the nom field */
    const NOM = 'coordonnees_contact.nom';

    /** the column name for the prenom field */
    const PRENOM = 'coordonnees_contact.prenom';

    /** the column name for the type field */
    const TYPE = 'coordonnees_contact.type';

    /** the column name for the adresse field */
    const ADRESSE = 'coordonnees_contact.adresse';

    /** the column name for the ville field */
    const VILLE = 'coordonnees_contact.ville';

    /** the column name for the code_postal field */
    const CODE_POSTAL = 'coordonnees_contact.code_postal';

    /** the column name for the pays field */
    const PAYS = 'coordonnees_contact.pays';

    /** the column name for the email field */
    const EMAIL = 'coordonnees_contact.email';

    /** the column name for the telephone field */
    const TELEPHONE = 'coordonnees_contact.telephone';

    /** the column name for the fax field */
    const FAX = 'coordonnees_contact.fax';

    /** the column name for the message field */
    const MESSAGE = 'coordonnees_contact.message';

    /** the column name for the created_at field */
    const CREATED_AT = 'coordonnees_contact.created_at';

    /** the column name for the updated_at field */
    const UPDATED_AT = 'coordonnees_contact.updated_at';

    /** the column name for the active field */
    const ACTIVE = 'coordonnees_contact.active';

    /** The enumerated values for the civilite field */
    const CIVILITE_MADAME = 'madame';
    const CIVILITE_MADEMOISELLE = 'mademoiselle';
    const CIVILITE_MONSIEUR = 'monsieur';

    /** The enumerated values for the type field */
    const TYPE_PARTICULIER = 'particulier';
    const TYPE_PROFESSIONNEL = 'professionnel';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identiy map to hold any loaded instances of CoordonneesContact objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array CoordonneesContact[]
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
     * e.g. CoordonneesContactPeer::$fieldNames[CoordonneesContactPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Id', 'Civilite', 'Nom', 'Prenom', 'Type', 'Adresse', 'Ville', 'CodePostal', 'Pays', 'Email', 'Telephone', 'Fax', 'Message', 'CreatedAt', 'UpdatedAt', 'Active', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'civilite', 'nom', 'prenom', 'type', 'adresse', 'ville', 'codePostal', 'pays', 'email', 'telephone', 'fax', 'message', 'createdAt', 'updatedAt', 'active', ),
        BasePeer::TYPE_COLNAME => array (CoordonneesContactPeer::ID, CoordonneesContactPeer::CIVILITE, CoordonneesContactPeer::NOM, CoordonneesContactPeer::PRENOM, CoordonneesContactPeer::TYPE, CoordonneesContactPeer::ADRESSE, CoordonneesContactPeer::VILLE, CoordonneesContactPeer::CODE_POSTAL, CoordonneesContactPeer::PAYS, CoordonneesContactPeer::EMAIL, CoordonneesContactPeer::TELEPHONE, CoordonneesContactPeer::FAX, CoordonneesContactPeer::MESSAGE, CoordonneesContactPeer::CREATED_AT, CoordonneesContactPeer::UPDATED_AT, CoordonneesContactPeer::ACTIVE, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID', 'CIVILITE', 'NOM', 'PRENOM', 'TYPE', 'ADRESSE', 'VILLE', 'CODE_POSTAL', 'PAYS', 'EMAIL', 'TELEPHONE', 'FAX', 'MESSAGE', 'CREATED_AT', 'UPDATED_AT', 'ACTIVE', ),
        BasePeer::TYPE_FIELDNAME => array ('id', 'civilite', 'nom', 'prenom', 'type', 'adresse', 'ville', 'code_postal', 'pays', 'email', 'telephone', 'fax', 'message', 'created_at', 'updated_at', 'active', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. CoordonneesContactPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Civilite' => 1, 'Nom' => 2, 'Prenom' => 3, 'Type' => 4, 'Adresse' => 5, 'Ville' => 6, 'CodePostal' => 7, 'Pays' => 8, 'Email' => 9, 'Telephone' => 10, 'Fax' => 11, 'Message' => 12, 'CreatedAt' => 13, 'UpdatedAt' => 14, 'Active' => 15, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'civilite' => 1, 'nom' => 2, 'prenom' => 3, 'type' => 4, 'adresse' => 5, 'ville' => 6, 'codePostal' => 7, 'pays' => 8, 'email' => 9, 'telephone' => 10, 'fax' => 11, 'message' => 12, 'createdAt' => 13, 'updatedAt' => 14, 'active' => 15, ),
        BasePeer::TYPE_COLNAME => array (CoordonneesContactPeer::ID => 0, CoordonneesContactPeer::CIVILITE => 1, CoordonneesContactPeer::NOM => 2, CoordonneesContactPeer::PRENOM => 3, CoordonneesContactPeer::TYPE => 4, CoordonneesContactPeer::ADRESSE => 5, CoordonneesContactPeer::VILLE => 6, CoordonneesContactPeer::CODE_POSTAL => 7, CoordonneesContactPeer::PAYS => 8, CoordonneesContactPeer::EMAIL => 9, CoordonneesContactPeer::TELEPHONE => 10, CoordonneesContactPeer::FAX => 11, CoordonneesContactPeer::MESSAGE => 12, CoordonneesContactPeer::CREATED_AT => 13, CoordonneesContactPeer::UPDATED_AT => 14, CoordonneesContactPeer::ACTIVE => 15, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID' => 0, 'CIVILITE' => 1, 'NOM' => 2, 'PRENOM' => 3, 'TYPE' => 4, 'ADRESSE' => 5, 'VILLE' => 6, 'CODE_POSTAL' => 7, 'PAYS' => 8, 'EMAIL' => 9, 'TELEPHONE' => 10, 'FAX' => 11, 'MESSAGE' => 12, 'CREATED_AT' => 13, 'UPDATED_AT' => 14, 'ACTIVE' => 15, ),
        BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'civilite' => 1, 'nom' => 2, 'prenom' => 3, 'type' => 4, 'adresse' => 5, 'ville' => 6, 'code_postal' => 7, 'pays' => 8, 'email' => 9, 'telephone' => 10, 'fax' => 11, 'message' => 12, 'created_at' => 13, 'updated_at' => 14, 'active' => 15, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
    );

    /** The enumerated values for this table */
    protected static $enumValueSets = array(
        CoordonneesContactPeer::CIVILITE => array(
            CoordonneesContactPeer::CIVILITE_MADAME,
            CoordonneesContactPeer::CIVILITE_MADEMOISELLE,
            CoordonneesContactPeer::CIVILITE_MONSIEUR,
        ),
        CoordonneesContactPeer::TYPE => array(
            CoordonneesContactPeer::TYPE_PARTICULIER,
            CoordonneesContactPeer::TYPE_PROFESSIONNEL,
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
        $toNames = CoordonneesContactPeer::getFieldNames($toType);
        $key = isset(CoordonneesContactPeer::$fieldKeys[$fromType][$name]) ? CoordonneesContactPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(CoordonneesContactPeer::$fieldKeys[$fromType], true));
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
        if (!array_key_exists($type, CoordonneesContactPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return CoordonneesContactPeer::$fieldNames[$type];
    }

    /**
     * Gets the list of values for all ENUM columns
     * @return array
     */
    public static function getValueSets()
    {
      return CoordonneesContactPeer::$enumValueSets;
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
        $valueSets = CoordonneesContactPeer::getValueSets();

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
     * @param      string $column The column name for current table. (i.e. CoordonneesContactPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(CoordonneesContactPeer::TABLE_NAME.'.', $alias.'.', $column);
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
            $criteria->addSelectColumn(CoordonneesContactPeer::ID);
            $criteria->addSelectColumn(CoordonneesContactPeer::CIVILITE);
            $criteria->addSelectColumn(CoordonneesContactPeer::NOM);
            $criteria->addSelectColumn(CoordonneesContactPeer::PRENOM);
            $criteria->addSelectColumn(CoordonneesContactPeer::TYPE);
            $criteria->addSelectColumn(CoordonneesContactPeer::ADRESSE);
            $criteria->addSelectColumn(CoordonneesContactPeer::VILLE);
            $criteria->addSelectColumn(CoordonneesContactPeer::CODE_POSTAL);
            $criteria->addSelectColumn(CoordonneesContactPeer::PAYS);
            $criteria->addSelectColumn(CoordonneesContactPeer::EMAIL);
            $criteria->addSelectColumn(CoordonneesContactPeer::TELEPHONE);
            $criteria->addSelectColumn(CoordonneesContactPeer::FAX);
            $criteria->addSelectColumn(CoordonneesContactPeer::MESSAGE);
            $criteria->addSelectColumn(CoordonneesContactPeer::CREATED_AT);
            $criteria->addSelectColumn(CoordonneesContactPeer::UPDATED_AT);
            $criteria->addSelectColumn(CoordonneesContactPeer::ACTIVE);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.civilite');
            $criteria->addSelectColumn($alias . '.nom');
            $criteria->addSelectColumn($alias . '.prenom');
            $criteria->addSelectColumn($alias . '.type');
            $criteria->addSelectColumn($alias . '.adresse');
            $criteria->addSelectColumn($alias . '.ville');
            $criteria->addSelectColumn($alias . '.code_postal');
            $criteria->addSelectColumn($alias . '.pays');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.telephone');
            $criteria->addSelectColumn($alias . '.fax');
            $criteria->addSelectColumn($alias . '.message');
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
        $criteria->setPrimaryTableName(CoordonneesContactPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            CoordonneesContactPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(CoordonneesContactPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(CoordonneesContactPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 CoordonneesContact
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = CoordonneesContactPeer::doSelect($critcopy, $con);
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
        return CoordonneesContactPeer::populateObjects(CoordonneesContactPeer::doSelectStmt($criteria, $con));
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
            $con = Propel::getConnection(CoordonneesContactPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            CoordonneesContactPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(CoordonneesContactPeer::DATABASE_NAME);

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
     * @param      CoordonneesContact $obj A CoordonneesContact object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getId();
            } // if key === null
            CoordonneesContactPeer::$instances[$key] = $obj;
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
     * @param      mixed $value A CoordonneesContact object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof CoordonneesContact) {
                $key = (string) $value->getId();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or CoordonneesContact object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(CoordonneesContactPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return   CoordonneesContact Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(CoordonneesContactPeer::$instances[$key])) {
                return CoordonneesContactPeer::$instances[$key];
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
        CoordonneesContactPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to coordonnees_contact
     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in CoordonneesContactI18nPeer instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        CoordonneesContactI18nPeer::clearInstancePool();
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
        $cls = CoordonneesContactPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = CoordonneesContactPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = CoordonneesContactPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CoordonneesContactPeer::addInstanceToPool($obj, $key);
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
     * @return array (CoordonneesContact object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = CoordonneesContactPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = CoordonneesContactPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + CoordonneesContactPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CoordonneesContactPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            CoordonneesContactPeer::addInstanceToPool($obj, $key);
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
        return Propel::getDatabaseMap(CoordonneesContactPeer::DATABASE_NAME)->getTable(CoordonneesContactPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseCoordonneesContactPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseCoordonneesContactPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new CoordonneesContactTableMap());
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
        return CoordonneesContactPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a CoordonneesContact or Criteria object.
     *
     * @param      mixed $values Criteria or CoordonneesContact object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(CoordonneesContactPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from CoordonneesContact object
        }

        if ($criteria->containsKey(CoordonneesContactPeer::ID) && $criteria->keyContainsValue(CoordonneesContactPeer::ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.CoordonneesContactPeer::ID.')');
        }


        // Set the correct dbName
        $criteria->setDbName(CoordonneesContactPeer::DATABASE_NAME);

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
     * Performs an UPDATE on the database, given a CoordonneesContact or Criteria object.
     *
     * @param      mixed $values Criteria or CoordonneesContact object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(CoordonneesContactPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(CoordonneesContactPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(CoordonneesContactPeer::ID);
            $value = $criteria->remove(CoordonneesContactPeer::ID);
            if ($value) {
                $selectCriteria->add(CoordonneesContactPeer::ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(CoordonneesContactPeer::TABLE_NAME);
            }

        } else { // $values is CoordonneesContact object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(CoordonneesContactPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the coordonnees_contact table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(CoordonneesContactPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(CoordonneesContactPeer::TABLE_NAME, $con, CoordonneesContactPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CoordonneesContactPeer::clearInstancePool();
            CoordonneesContactPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a CoordonneesContact or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or CoordonneesContact object or primary key or array of primary keys
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
            $con = Propel::getConnection(CoordonneesContactPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            CoordonneesContactPeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof CoordonneesContact) { // it's a model object
            // invalidate the cache for this single object
            CoordonneesContactPeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CoordonneesContactPeer::DATABASE_NAME);
            $criteria->add(CoordonneesContactPeer::ID, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                CoordonneesContactPeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(CoordonneesContactPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            CoordonneesContactPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given CoordonneesContact object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param      CoordonneesContact $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(CoordonneesContactPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(CoordonneesContactPeer::TABLE_NAME);

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

        return BasePeer::doValidate(CoordonneesContactPeer::DATABASE_NAME, CoordonneesContactPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param      int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return CoordonneesContact
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = CoordonneesContactPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(CoordonneesContactPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(CoordonneesContactPeer::DATABASE_NAME);
        $criteria->add(CoordonneesContactPeer::ID, $pk);

        $v = CoordonneesContactPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return CoordonneesContact[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(CoordonneesContactPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(CoordonneesContactPeer::DATABASE_NAME);
            $criteria->add(CoordonneesContactPeer::ID, $pks, Criteria::IN);
            $objs = CoordonneesContactPeer::doSelect($criteria, $con);
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
            ->filterByTableRef(CoordonneesContactPeer::TABLE_NAME)
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
            ->filterByTableRef(CoordonneesContactPeer::TABLE_NAME)
            ->findOne()
        ;
    }
} // BaseCoordonneesContactPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseCoordonneesContactPeer::buildTableMap();

