<?php

namespace Cungfoo\Model\om;

use \BasePeer;
use \Criteria;
use \PDO;
use \PDOStatement;
use \Propel;
use \PropelException;
use \PropelPDO;
use Cungfoo\Model\DemandeIdentifiant;
use Cungfoo\Model\DemandeIdentifiantPeer;
use Cungfoo\Model\map\DemandeIdentifiantTableMap;

/**
 * Base static class for performing query and update operations on the 'demande_identifiant' table.
 *
 *
 *
 * @package propel.generator.Cungfoo.Model.om
 */
abstract class BaseDemandeIdentifiantPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'cungfoo';

    /** the table name for this class */
    const TABLE_NAME = 'demande_identifiant';

    /** the related Propel class for this table */
    const OM_CLASS = 'Cungfoo\\Model\\DemandeIdentifiant';

    /** the related TableMap class for this table */
    const TM_CLASS = 'DemandeIdentifiantTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 26;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 26;

    /** the column name for the ID field */
    const ID = 'demande_identifiant.ID';

    /** the column name for the SOCIETE_NOM field */
    const SOCIETE_NOM = 'demande_identifiant.SOCIETE_NOM';

    /** the column name for the SOCIETE_ADRESSE_1 field */
    const SOCIETE_ADRESSE_1 = 'demande_identifiant.SOCIETE_ADRESSE_1';

    /** the column name for the SOCIETE_ADRESSE_2 field */
    const SOCIETE_ADRESSE_2 = 'demande_identifiant.SOCIETE_ADRESSE_2';

    /** the column name for the SOCIETE_ADRESSE_3 field */
    const SOCIETE_ADRESSE_3 = 'demande_identifiant.SOCIETE_ADRESSE_3';

    /** the column name for the SOCIETE_ADRESSE_4 field */
    const SOCIETE_ADRESSE_4 = 'demande_identifiant.SOCIETE_ADRESSE_4';

    /** the column name for the SOCIETE_TELEPHONE field */
    const SOCIETE_TELEPHONE = 'demande_identifiant.SOCIETE_TELEPHONE';

    /** the column name for the SOCIETE_FAX field */
    const SOCIETE_FAX = 'demande_identifiant.SOCIETE_FAX';

    /** the column name for the CONTACT_PRENOM field */
    const CONTACT_PRENOM = 'demande_identifiant.CONTACT_PRENOM';

    /** the column name for the CONTACT_NOM field */
    const CONTACT_NOM = 'demande_identifiant.CONTACT_NOM';

    /** the column name for the CONTACT_TELEPHONE field */
    const CONTACT_TELEPHONE = 'demande_identifiant.CONTACT_TELEPHONE';

    /** the column name for the CONTACT_MAIL field */
    const CONTACT_MAIL = 'demande_identifiant.CONTACT_MAIL';

    /** the column name for the PERMANENCE field */
    const PERMANENCE = 'demande_identifiant.PERMANENCE';

    /** the column name for the PERMANENCE_MATIN_DE field */
    const PERMANENCE_MATIN_DE = 'demande_identifiant.PERMANENCE_MATIN_DE';

    /** the column name for the PERMANENCE_MATIN_A field */
    const PERMANENCE_MATIN_A = 'demande_identifiant.PERMANENCE_MATIN_A';

    /** the column name for the PERMANENCE_APRES_MIDI_DE field */
    const PERMANENCE_APRES_MIDI_DE = 'demande_identifiant.PERMANENCE_APRES_MIDI_DE';

    /** the column name for the PERMANENCE_APRES_MIDI_A field */
    const PERMANENCE_APRES_MIDI_A = 'demande_identifiant.PERMANENCE_APRES_MIDI_A';

    /** the column name for the CLIENT_VC field */
    const CLIENT_VC = 'demande_identifiant.CLIENT_VC';

    /** the column name for the CLIENT_VC_CODE field */
    const CLIENT_VC_CODE = 'demande_identifiant.CLIENT_VC_CODE';

    /** the column name for the CLIENT_VD field */
    const CLIENT_VD = 'demande_identifiant.CLIENT_VD';

    /** the column name for the CLIENT_VD_CODE field */
    const CLIENT_VD_CODE = 'demande_identifiant.CLIENT_VD_CODE';

    /** the column name for the BROCHURE field */
    const BROCHURE = 'demande_identifiant.BROCHURE';

    /** the column name for the IDENTIFIANT field */
    const IDENTIFIANT = 'demande_identifiant.IDENTIFIANT';

    /** the column name for the CREATED_AT field */
    const CREATED_AT = 'demande_identifiant.CREATED_AT';

    /** the column name for the UPDATED_AT field */
    const UPDATED_AT = 'demande_identifiant.UPDATED_AT';

    /** the column name for the ENABLED field */
    const ENABLED = 'demande_identifiant.ENABLED';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identiy map to hold any loaded instances of DemandeIdentifiant objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array DemandeIdentifiant[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. DemandeIdentifiantPeer::$fieldNames[DemandeIdentifiantPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Id', 'SocieteNom', 'SocieteAdresse1', 'SocieteAdresse2', 'SocieteAdresse3', 'SocieteAdresse4', 'SocieteTelephone', 'SocieteFax', 'ContactPrenom', 'ContactNom', 'ContactTelephone', 'ContactMail', 'Permanence', 'PermanenceMatinDe', 'PermanenceMatinA', 'PermanenceApresMidiDe', 'PermanenceApresMidiA', 'ClientVc', 'ClientVcCode', 'ClientVd', 'ClientVdCode', 'Brochure', 'Identifiant', 'CreatedAt', 'UpdatedAt', 'Enabled', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'societeNom', 'societeAdresse1', 'societeAdresse2', 'societeAdresse3', 'societeAdresse4', 'societeTelephone', 'societeFax', 'contactPrenom', 'contactNom', 'contactTelephone', 'contactMail', 'permanence', 'permanenceMatinDe', 'permanenceMatinA', 'permanenceApresMidiDe', 'permanenceApresMidiA', 'clientVc', 'clientVcCode', 'clientVd', 'clientVdCode', 'brochure', 'identifiant', 'createdAt', 'updatedAt', 'enabled', ),
        BasePeer::TYPE_COLNAME => array (DemandeIdentifiantPeer::ID, DemandeIdentifiantPeer::SOCIETE_NOM, DemandeIdentifiantPeer::SOCIETE_ADRESSE_1, DemandeIdentifiantPeer::SOCIETE_ADRESSE_2, DemandeIdentifiantPeer::SOCIETE_ADRESSE_3, DemandeIdentifiantPeer::SOCIETE_ADRESSE_4, DemandeIdentifiantPeer::SOCIETE_TELEPHONE, DemandeIdentifiantPeer::SOCIETE_FAX, DemandeIdentifiantPeer::CONTACT_PRENOM, DemandeIdentifiantPeer::CONTACT_NOM, DemandeIdentifiantPeer::CONTACT_TELEPHONE, DemandeIdentifiantPeer::CONTACT_MAIL, DemandeIdentifiantPeer::PERMANENCE, DemandeIdentifiantPeer::PERMANENCE_MATIN_DE, DemandeIdentifiantPeer::PERMANENCE_MATIN_A, DemandeIdentifiantPeer::PERMANENCE_APRES_MIDI_DE, DemandeIdentifiantPeer::PERMANENCE_APRES_MIDI_A, DemandeIdentifiantPeer::CLIENT_VC, DemandeIdentifiantPeer::CLIENT_VC_CODE, DemandeIdentifiantPeer::CLIENT_VD, DemandeIdentifiantPeer::CLIENT_VD_CODE, DemandeIdentifiantPeer::BROCHURE, DemandeIdentifiantPeer::IDENTIFIANT, DemandeIdentifiantPeer::CREATED_AT, DemandeIdentifiantPeer::UPDATED_AT, DemandeIdentifiantPeer::ENABLED, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID', 'SOCIETE_NOM', 'SOCIETE_ADRESSE_1', 'SOCIETE_ADRESSE_2', 'SOCIETE_ADRESSE_3', 'SOCIETE_ADRESSE_4', 'SOCIETE_TELEPHONE', 'SOCIETE_FAX', 'CONTACT_PRENOM', 'CONTACT_NOM', 'CONTACT_TELEPHONE', 'CONTACT_MAIL', 'PERMANENCE', 'PERMANENCE_MATIN_DE', 'PERMANENCE_MATIN_A', 'PERMANENCE_APRES_MIDI_DE', 'PERMANENCE_APRES_MIDI_A', 'CLIENT_VC', 'CLIENT_VC_CODE', 'CLIENT_VD', 'CLIENT_VD_CODE', 'BROCHURE', 'IDENTIFIANT', 'CREATED_AT', 'UPDATED_AT', 'ENABLED', ),
        BasePeer::TYPE_FIELDNAME => array ('id', 'societe_nom', 'societe_adresse_1', 'societe_adresse_2', 'societe_adresse_3', 'societe_adresse_4', 'societe_telephone', 'societe_fax', 'contact_prenom', 'contact_nom', 'contact_telephone', 'contact_mail', 'permanence', 'permanence_matin_de', 'permanence_matin_a', 'permanence_apres_midi_de', 'permanence_apres_midi_a', 'client_vc', 'client_vc_code', 'client_vd', 'client_vd_code', 'brochure', 'identifiant', 'created_at', 'updated_at', 'enabled', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. DemandeIdentifiantPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'SocieteNom' => 1, 'SocieteAdresse1' => 2, 'SocieteAdresse2' => 3, 'SocieteAdresse3' => 4, 'SocieteAdresse4' => 5, 'SocieteTelephone' => 6, 'SocieteFax' => 7, 'ContactPrenom' => 8, 'ContactNom' => 9, 'ContactTelephone' => 10, 'ContactMail' => 11, 'Permanence' => 12, 'PermanenceMatinDe' => 13, 'PermanenceMatinA' => 14, 'PermanenceApresMidiDe' => 15, 'PermanenceApresMidiA' => 16, 'ClientVc' => 17, 'ClientVcCode' => 18, 'ClientVd' => 19, 'ClientVdCode' => 20, 'Brochure' => 21, 'Identifiant' => 22, 'CreatedAt' => 23, 'UpdatedAt' => 24, 'Enabled' => 25, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'societeNom' => 1, 'societeAdresse1' => 2, 'societeAdresse2' => 3, 'societeAdresse3' => 4, 'societeAdresse4' => 5, 'societeTelephone' => 6, 'societeFax' => 7, 'contactPrenom' => 8, 'contactNom' => 9, 'contactTelephone' => 10, 'contactMail' => 11, 'permanence' => 12, 'permanenceMatinDe' => 13, 'permanenceMatinA' => 14, 'permanenceApresMidiDe' => 15, 'permanenceApresMidiA' => 16, 'clientVc' => 17, 'clientVcCode' => 18, 'clientVd' => 19, 'clientVdCode' => 20, 'brochure' => 21, 'identifiant' => 22, 'createdAt' => 23, 'updatedAt' => 24, 'enabled' => 25, ),
        BasePeer::TYPE_COLNAME => array (DemandeIdentifiantPeer::ID => 0, DemandeIdentifiantPeer::SOCIETE_NOM => 1, DemandeIdentifiantPeer::SOCIETE_ADRESSE_1 => 2, DemandeIdentifiantPeer::SOCIETE_ADRESSE_2 => 3, DemandeIdentifiantPeer::SOCIETE_ADRESSE_3 => 4, DemandeIdentifiantPeer::SOCIETE_ADRESSE_4 => 5, DemandeIdentifiantPeer::SOCIETE_TELEPHONE => 6, DemandeIdentifiantPeer::SOCIETE_FAX => 7, DemandeIdentifiantPeer::CONTACT_PRENOM => 8, DemandeIdentifiantPeer::CONTACT_NOM => 9, DemandeIdentifiantPeer::CONTACT_TELEPHONE => 10, DemandeIdentifiantPeer::CONTACT_MAIL => 11, DemandeIdentifiantPeer::PERMANENCE => 12, DemandeIdentifiantPeer::PERMANENCE_MATIN_DE => 13, DemandeIdentifiantPeer::PERMANENCE_MATIN_A => 14, DemandeIdentifiantPeer::PERMANENCE_APRES_MIDI_DE => 15, DemandeIdentifiantPeer::PERMANENCE_APRES_MIDI_A => 16, DemandeIdentifiantPeer::CLIENT_VC => 17, DemandeIdentifiantPeer::CLIENT_VC_CODE => 18, DemandeIdentifiantPeer::CLIENT_VD => 19, DemandeIdentifiantPeer::CLIENT_VD_CODE => 20, DemandeIdentifiantPeer::BROCHURE => 21, DemandeIdentifiantPeer::IDENTIFIANT => 22, DemandeIdentifiantPeer::CREATED_AT => 23, DemandeIdentifiantPeer::UPDATED_AT => 24, DemandeIdentifiantPeer::ENABLED => 25, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID' => 0, 'SOCIETE_NOM' => 1, 'SOCIETE_ADRESSE_1' => 2, 'SOCIETE_ADRESSE_2' => 3, 'SOCIETE_ADRESSE_3' => 4, 'SOCIETE_ADRESSE_4' => 5, 'SOCIETE_TELEPHONE' => 6, 'SOCIETE_FAX' => 7, 'CONTACT_PRENOM' => 8, 'CONTACT_NOM' => 9, 'CONTACT_TELEPHONE' => 10, 'CONTACT_MAIL' => 11, 'PERMANENCE' => 12, 'PERMANENCE_MATIN_DE' => 13, 'PERMANENCE_MATIN_A' => 14, 'PERMANENCE_APRES_MIDI_DE' => 15, 'PERMANENCE_APRES_MIDI_A' => 16, 'CLIENT_VC' => 17, 'CLIENT_VC_CODE' => 18, 'CLIENT_VD' => 19, 'CLIENT_VD_CODE' => 20, 'BROCHURE' => 21, 'IDENTIFIANT' => 22, 'CREATED_AT' => 23, 'UPDATED_AT' => 24, 'ENABLED' => 25, ),
        BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'societe_nom' => 1, 'societe_adresse_1' => 2, 'societe_adresse_2' => 3, 'societe_adresse_3' => 4, 'societe_adresse_4' => 5, 'societe_telephone' => 6, 'societe_fax' => 7, 'contact_prenom' => 8, 'contact_nom' => 9, 'contact_telephone' => 10, 'contact_mail' => 11, 'permanence' => 12, 'permanence_matin_de' => 13, 'permanence_matin_a' => 14, 'permanence_apres_midi_de' => 15, 'permanence_apres_midi_a' => 16, 'client_vc' => 17, 'client_vc_code' => 18, 'client_vd' => 19, 'client_vd_code' => 20, 'brochure' => 21, 'identifiant' => 22, 'created_at' => 23, 'updated_at' => 24, 'enabled' => 25, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, )
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
        $toNames = DemandeIdentifiantPeer::getFieldNames($toType);
        $key = isset(DemandeIdentifiantPeer::$fieldKeys[$fromType][$name]) ? DemandeIdentifiantPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(DemandeIdentifiantPeer::$fieldKeys[$fromType], true));
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
        if (!array_key_exists($type, DemandeIdentifiantPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return DemandeIdentifiantPeer::$fieldNames[$type];
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
     * @param      string $column The column name for current table. (i.e. DemandeIdentifiantPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(DemandeIdentifiantPeer::TABLE_NAME.'.', $alias.'.', $column);
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
            $criteria->addSelectColumn(DemandeIdentifiantPeer::ID);
            $criteria->addSelectColumn(DemandeIdentifiantPeer::SOCIETE_NOM);
            $criteria->addSelectColumn(DemandeIdentifiantPeer::SOCIETE_ADRESSE_1);
            $criteria->addSelectColumn(DemandeIdentifiantPeer::SOCIETE_ADRESSE_2);
            $criteria->addSelectColumn(DemandeIdentifiantPeer::SOCIETE_ADRESSE_3);
            $criteria->addSelectColumn(DemandeIdentifiantPeer::SOCIETE_ADRESSE_4);
            $criteria->addSelectColumn(DemandeIdentifiantPeer::SOCIETE_TELEPHONE);
            $criteria->addSelectColumn(DemandeIdentifiantPeer::SOCIETE_FAX);
            $criteria->addSelectColumn(DemandeIdentifiantPeer::CONTACT_PRENOM);
            $criteria->addSelectColumn(DemandeIdentifiantPeer::CONTACT_NOM);
            $criteria->addSelectColumn(DemandeIdentifiantPeer::CONTACT_TELEPHONE);
            $criteria->addSelectColumn(DemandeIdentifiantPeer::CONTACT_MAIL);
            $criteria->addSelectColumn(DemandeIdentifiantPeer::PERMANENCE);
            $criteria->addSelectColumn(DemandeIdentifiantPeer::PERMANENCE_MATIN_DE);
            $criteria->addSelectColumn(DemandeIdentifiantPeer::PERMANENCE_MATIN_A);
            $criteria->addSelectColumn(DemandeIdentifiantPeer::PERMANENCE_APRES_MIDI_DE);
            $criteria->addSelectColumn(DemandeIdentifiantPeer::PERMANENCE_APRES_MIDI_A);
            $criteria->addSelectColumn(DemandeIdentifiantPeer::CLIENT_VC);
            $criteria->addSelectColumn(DemandeIdentifiantPeer::CLIENT_VC_CODE);
            $criteria->addSelectColumn(DemandeIdentifiantPeer::CLIENT_VD);
            $criteria->addSelectColumn(DemandeIdentifiantPeer::CLIENT_VD_CODE);
            $criteria->addSelectColumn(DemandeIdentifiantPeer::BROCHURE);
            $criteria->addSelectColumn(DemandeIdentifiantPeer::IDENTIFIANT);
            $criteria->addSelectColumn(DemandeIdentifiantPeer::CREATED_AT);
            $criteria->addSelectColumn(DemandeIdentifiantPeer::UPDATED_AT);
            $criteria->addSelectColumn(DemandeIdentifiantPeer::ENABLED);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.SOCIETE_NOM');
            $criteria->addSelectColumn($alias . '.SOCIETE_ADRESSE_1');
            $criteria->addSelectColumn($alias . '.SOCIETE_ADRESSE_2');
            $criteria->addSelectColumn($alias . '.SOCIETE_ADRESSE_3');
            $criteria->addSelectColumn($alias . '.SOCIETE_ADRESSE_4');
            $criteria->addSelectColumn($alias . '.SOCIETE_TELEPHONE');
            $criteria->addSelectColumn($alias . '.SOCIETE_FAX');
            $criteria->addSelectColumn($alias . '.CONTACT_PRENOM');
            $criteria->addSelectColumn($alias . '.CONTACT_NOM');
            $criteria->addSelectColumn($alias . '.CONTACT_TELEPHONE');
            $criteria->addSelectColumn($alias . '.CONTACT_MAIL');
            $criteria->addSelectColumn($alias . '.PERMANENCE');
            $criteria->addSelectColumn($alias . '.PERMANENCE_MATIN_DE');
            $criteria->addSelectColumn($alias . '.PERMANENCE_MATIN_A');
            $criteria->addSelectColumn($alias . '.PERMANENCE_APRES_MIDI_DE');
            $criteria->addSelectColumn($alias . '.PERMANENCE_APRES_MIDI_A');
            $criteria->addSelectColumn($alias . '.CLIENT_VC');
            $criteria->addSelectColumn($alias . '.CLIENT_VC_CODE');
            $criteria->addSelectColumn($alias . '.CLIENT_VD');
            $criteria->addSelectColumn($alias . '.CLIENT_VD_CODE');
            $criteria->addSelectColumn($alias . '.BROCHURE');
            $criteria->addSelectColumn($alias . '.IDENTIFIANT');
            $criteria->addSelectColumn($alias . '.CREATED_AT');
            $criteria->addSelectColumn($alias . '.UPDATED_AT');
            $criteria->addSelectColumn($alias . '.ENABLED');
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
        $criteria->setPrimaryTableName(DemandeIdentifiantPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            DemandeIdentifiantPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(DemandeIdentifiantPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(DemandeIdentifiantPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 DemandeIdentifiant
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = DemandeIdentifiantPeer::doSelect($critcopy, $con);
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
        return DemandeIdentifiantPeer::populateObjects(DemandeIdentifiantPeer::doSelectStmt($criteria, $con));
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
            $con = Propel::getConnection(DemandeIdentifiantPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            DemandeIdentifiantPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(DemandeIdentifiantPeer::DATABASE_NAME);

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
     * @param      DemandeIdentifiant $obj A DemandeIdentifiant object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getId();
            } // if key === null
            DemandeIdentifiantPeer::$instances[$key] = $obj;
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
     * @param      mixed $value A DemandeIdentifiant object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof DemandeIdentifiant) {
                $key = (string) $value->getId();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or DemandeIdentifiant object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(DemandeIdentifiantPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return   DemandeIdentifiant Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(DemandeIdentifiantPeer::$instances[$key])) {
                return DemandeIdentifiantPeer::$instances[$key];
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
        DemandeIdentifiantPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to demande_identifiant
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
        $cls = DemandeIdentifiantPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = DemandeIdentifiantPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = DemandeIdentifiantPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                DemandeIdentifiantPeer::addInstanceToPool($obj, $key);
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
     * @return array (DemandeIdentifiant object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = DemandeIdentifiantPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = DemandeIdentifiantPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + DemandeIdentifiantPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = DemandeIdentifiantPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            DemandeIdentifiantPeer::addInstanceToPool($obj, $key);
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
        return Propel::getDatabaseMap(DemandeIdentifiantPeer::DATABASE_NAME)->getTable(DemandeIdentifiantPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseDemandeIdentifiantPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseDemandeIdentifiantPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new DemandeIdentifiantTableMap());
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
        return DemandeIdentifiantPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a DemandeIdentifiant or Criteria object.
     *
     * @param      mixed $values Criteria or DemandeIdentifiant object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(DemandeIdentifiantPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from DemandeIdentifiant object
        }

        if ($criteria->containsKey(DemandeIdentifiantPeer::ID) && $criteria->keyContainsValue(DemandeIdentifiantPeer::ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.DemandeIdentifiantPeer::ID.')');
        }


        // Set the correct dbName
        $criteria->setDbName(DemandeIdentifiantPeer::DATABASE_NAME);

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
     * Performs an UPDATE on the database, given a DemandeIdentifiant or Criteria object.
     *
     * @param      mixed $values Criteria or DemandeIdentifiant object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(DemandeIdentifiantPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(DemandeIdentifiantPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(DemandeIdentifiantPeer::ID);
            $value = $criteria->remove(DemandeIdentifiantPeer::ID);
            if ($value) {
                $selectCriteria->add(DemandeIdentifiantPeer::ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(DemandeIdentifiantPeer::TABLE_NAME);
            }

        } else { // $values is DemandeIdentifiant object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(DemandeIdentifiantPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the demande_identifiant table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(DemandeIdentifiantPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(DemandeIdentifiantPeer::TABLE_NAME, $con, DemandeIdentifiantPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DemandeIdentifiantPeer::clearInstancePool();
            DemandeIdentifiantPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a DemandeIdentifiant or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or DemandeIdentifiant object or primary key or array of primary keys
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
            $con = Propel::getConnection(DemandeIdentifiantPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            DemandeIdentifiantPeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof DemandeIdentifiant) { // it's a model object
            // invalidate the cache for this single object
            DemandeIdentifiantPeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(DemandeIdentifiantPeer::DATABASE_NAME);
            $criteria->add(DemandeIdentifiantPeer::ID, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                DemandeIdentifiantPeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(DemandeIdentifiantPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            DemandeIdentifiantPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given DemandeIdentifiant object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param      DemandeIdentifiant $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(DemandeIdentifiantPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(DemandeIdentifiantPeer::TABLE_NAME);

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

        return BasePeer::doValidate(DemandeIdentifiantPeer::DATABASE_NAME, DemandeIdentifiantPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param      int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return DemandeIdentifiant
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = DemandeIdentifiantPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(DemandeIdentifiantPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(DemandeIdentifiantPeer::DATABASE_NAME);
        $criteria->add(DemandeIdentifiantPeer::ID, $pk);

        $v = DemandeIdentifiantPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return DemandeIdentifiant[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(DemandeIdentifiantPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(DemandeIdentifiantPeer::DATABASE_NAME);
            $criteria->add(DemandeIdentifiantPeer::ID, $pks, Criteria::IN);
            $objs = DemandeIdentifiantPeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BaseDemandeIdentifiantPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseDemandeIdentifiantPeer::buildTableMap();

