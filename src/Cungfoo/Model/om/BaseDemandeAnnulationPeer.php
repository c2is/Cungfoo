<?php

namespace Cungfoo\Model\om;

use \BasePeer;
use \Criteria;
use \PDO;
use \PDOStatement;
use \Propel;
use \PropelException;
use \PropelPDO;
use Cungfoo\Model\DemandeAnnulation;
use Cungfoo\Model\DemandeAnnulationPeer;
use Cungfoo\Model\EtablissementPeer;
use Cungfoo\Model\map\DemandeAnnulationTableMap;

/**
 * Base static class for performing query and update operations on the 'demande_annulation' table.
 *
 *
 *
 * @package propel.generator.Cungfoo.Model.om
 */
abstract class BaseDemandeAnnulationPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'cungfoo';

    /** the table name for this class */
    const TABLE_NAME = 'demande_annulation';

    /** the related Propel class for this table */
    const OM_CLASS = 'Cungfoo\\Model\\DemandeAnnulation';

    /** the related TableMap class for this table */
    const TM_CLASS = 'DemandeAnnulationTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 24;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 24;

    /** the column name for the id field */
    const ID = 'demande_annulation.id';

    /** the column name for the assure_nom field */
    const ASSURE_NOM = 'demande_annulation.assure_nom';

    /** the column name for the assure_prenom field */
    const ASSURE_PRENOM = 'demande_annulation.assure_prenom';

    /** the column name for the assure_adresse field */
    const ASSURE_ADRESSE = 'demande_annulation.assure_adresse';

    /** the column name for the assure_code_postal field */
    const ASSURE_CODE_POSTAL = 'demande_annulation.assure_code_postal';

    /** the column name for the assure_ville field */
    const ASSURE_VILLE = 'demande_annulation.assure_ville';

    /** the column name for the assure_pays field */
    const ASSURE_PAYS = 'demande_annulation.assure_pays';

    /** the column name for the assure_mail field */
    const ASSURE_MAIL = 'demande_annulation.assure_mail';

    /** the column name for the assure_telephone field */
    const ASSURE_TELEPHONE = 'demande_annulation.assure_telephone';

    /** the column name for the camping_id field */
    const CAMPING_ID = 'demande_annulation.camping_id';

    /** the column name for the camping_num_resa field */
    const CAMPING_NUM_RESA = 'demande_annulation.camping_num_resa';

    /** the column name for the camping_montant_sejour field */
    const CAMPING_MONTANT_SEJOUR = 'demande_annulation.camping_montant_sejour';

    /** the column name for the camping_montant_verse field */
    const CAMPING_MONTANT_VERSE = 'demande_annulation.camping_montant_verse';

    /** the column name for the sinistre_nature field */
    const SINISTRE_NATURE = 'demande_annulation.sinistre_nature';

    /** the column name for the sinistre_suite field */
    const SINISTRE_SUITE = 'demande_annulation.sinistre_suite';

    /** the column name for the sinistre_date field */
    const SINISTRE_DATE = 'demande_annulation.sinistre_date';

    /** the column name for the sinistre_resume field */
    const SINISTRE_RESUME = 'demande_annulation.sinistre_resume';

    /** the column name for the file_1 field */
    const FILE_1 = 'demande_annulation.file_1';

    /** the column name for the file_2 field */
    const FILE_2 = 'demande_annulation.file_2';

    /** the column name for the file_3 field */
    const FILE_3 = 'demande_annulation.file_3';

    /** the column name for the file_4 field */
    const FILE_4 = 'demande_annulation.file_4';

    /** the column name for the created_at field */
    const CREATED_AT = 'demande_annulation.created_at';

    /** the column name for the updated_at field */
    const UPDATED_AT = 'demande_annulation.updated_at';

    /** the column name for the active field */
    const ACTIVE = 'demande_annulation.active';

    /** The enumerated values for the sinistre_nature field */
    const SINISTRE_NATURE_ANNULATION_NATURESINISTRE_ANNULATION = 'annulation.natureSinistre.annulation';
    const SINISTRE_NATURE_ANNULATION_NATURESINISTRE_INTERRUPTION = 'annulation.natureSinistre.interruption';

    /** The enumerated values for the sinistre_suite field */
    const SINISTRE_SUITE_ANNULATION_SUITESINISTRE_MALADIE = 'annulation.suiteSinistre.maladie';
    const SINISTRE_SUITE_ANNULATION_SUITESINISTRE_ACCIDENT = 'annulation.suiteSinistre.accident';
    const SINISTRE_SUITE_ANNULATION_SUITESINISTRE_AUTRE = 'annulation.suiteSinistre.autre';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identiy map to hold any loaded instances of DemandeAnnulation objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array DemandeAnnulation[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. DemandeAnnulationPeer::$fieldNames[DemandeAnnulationPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Id', 'AssureNom', 'AssurePrenom', 'AssureAdresse', 'AssureCodePostal', 'AssureVille', 'AssurePays', 'AssureMail', 'AssureTelephone', 'CampingId', 'CampingNumResa', 'CampingMontantSejour', 'CampingMontantVerse', 'SinistreNature', 'SinistreSuite', 'SinistreDate', 'SinistreResume', 'File1', 'File2', 'File3', 'File4', 'CreatedAt', 'UpdatedAt', 'Active', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'assureNom', 'assurePrenom', 'assureAdresse', 'assureCodePostal', 'assureVille', 'assurePays', 'assureMail', 'assureTelephone', 'campingId', 'campingNumResa', 'campingMontantSejour', 'campingMontantVerse', 'sinistreNature', 'sinistreSuite', 'sinistreDate', 'sinistreResume', 'file1', 'file2', 'file3', 'file4', 'createdAt', 'updatedAt', 'active', ),
        BasePeer::TYPE_COLNAME => array (DemandeAnnulationPeer::ID, DemandeAnnulationPeer::ASSURE_NOM, DemandeAnnulationPeer::ASSURE_PRENOM, DemandeAnnulationPeer::ASSURE_ADRESSE, DemandeAnnulationPeer::ASSURE_CODE_POSTAL, DemandeAnnulationPeer::ASSURE_VILLE, DemandeAnnulationPeer::ASSURE_PAYS, DemandeAnnulationPeer::ASSURE_MAIL, DemandeAnnulationPeer::ASSURE_TELEPHONE, DemandeAnnulationPeer::CAMPING_ID, DemandeAnnulationPeer::CAMPING_NUM_RESA, DemandeAnnulationPeer::CAMPING_MONTANT_SEJOUR, DemandeAnnulationPeer::CAMPING_MONTANT_VERSE, DemandeAnnulationPeer::SINISTRE_NATURE, DemandeAnnulationPeer::SINISTRE_SUITE, DemandeAnnulationPeer::SINISTRE_DATE, DemandeAnnulationPeer::SINISTRE_RESUME, DemandeAnnulationPeer::FILE_1, DemandeAnnulationPeer::FILE_2, DemandeAnnulationPeer::FILE_3, DemandeAnnulationPeer::FILE_4, DemandeAnnulationPeer::CREATED_AT, DemandeAnnulationPeer::UPDATED_AT, DemandeAnnulationPeer::ACTIVE, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID', 'ASSURE_NOM', 'ASSURE_PRENOM', 'ASSURE_ADRESSE', 'ASSURE_CODE_POSTAL', 'ASSURE_VILLE', 'ASSURE_PAYS', 'ASSURE_MAIL', 'ASSURE_TELEPHONE', 'CAMPING_ID', 'CAMPING_NUM_RESA', 'CAMPING_MONTANT_SEJOUR', 'CAMPING_MONTANT_VERSE', 'SINISTRE_NATURE', 'SINISTRE_SUITE', 'SINISTRE_DATE', 'SINISTRE_RESUME', 'FILE_1', 'FILE_2', 'FILE_3', 'FILE_4', 'CREATED_AT', 'UPDATED_AT', 'ACTIVE', ),
        BasePeer::TYPE_FIELDNAME => array ('id', 'assure_nom', 'assure_prenom', 'assure_adresse', 'assure_code_postal', 'assure_ville', 'assure_pays', 'assure_mail', 'assure_telephone', 'camping_id', 'camping_num_resa', 'camping_montant_sejour', 'camping_montant_verse', 'sinistre_nature', 'sinistre_suite', 'sinistre_date', 'sinistre_resume', 'file_1', 'file_2', 'file_3', 'file_4', 'created_at', 'updated_at', 'active', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. DemandeAnnulationPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'AssureNom' => 1, 'AssurePrenom' => 2, 'AssureAdresse' => 3, 'AssureCodePostal' => 4, 'AssureVille' => 5, 'AssurePays' => 6, 'AssureMail' => 7, 'AssureTelephone' => 8, 'CampingId' => 9, 'CampingNumResa' => 10, 'CampingMontantSejour' => 11, 'CampingMontantVerse' => 12, 'SinistreNature' => 13, 'SinistreSuite' => 14, 'SinistreDate' => 15, 'SinistreResume' => 16, 'File1' => 17, 'File2' => 18, 'File3' => 19, 'File4' => 20, 'CreatedAt' => 21, 'UpdatedAt' => 22, 'Active' => 23, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'assureNom' => 1, 'assurePrenom' => 2, 'assureAdresse' => 3, 'assureCodePostal' => 4, 'assureVille' => 5, 'assurePays' => 6, 'assureMail' => 7, 'assureTelephone' => 8, 'campingId' => 9, 'campingNumResa' => 10, 'campingMontantSejour' => 11, 'campingMontantVerse' => 12, 'sinistreNature' => 13, 'sinistreSuite' => 14, 'sinistreDate' => 15, 'sinistreResume' => 16, 'file1' => 17, 'file2' => 18, 'file3' => 19, 'file4' => 20, 'createdAt' => 21, 'updatedAt' => 22, 'active' => 23, ),
        BasePeer::TYPE_COLNAME => array (DemandeAnnulationPeer::ID => 0, DemandeAnnulationPeer::ASSURE_NOM => 1, DemandeAnnulationPeer::ASSURE_PRENOM => 2, DemandeAnnulationPeer::ASSURE_ADRESSE => 3, DemandeAnnulationPeer::ASSURE_CODE_POSTAL => 4, DemandeAnnulationPeer::ASSURE_VILLE => 5, DemandeAnnulationPeer::ASSURE_PAYS => 6, DemandeAnnulationPeer::ASSURE_MAIL => 7, DemandeAnnulationPeer::ASSURE_TELEPHONE => 8, DemandeAnnulationPeer::CAMPING_ID => 9, DemandeAnnulationPeer::CAMPING_NUM_RESA => 10, DemandeAnnulationPeer::CAMPING_MONTANT_SEJOUR => 11, DemandeAnnulationPeer::CAMPING_MONTANT_VERSE => 12, DemandeAnnulationPeer::SINISTRE_NATURE => 13, DemandeAnnulationPeer::SINISTRE_SUITE => 14, DemandeAnnulationPeer::SINISTRE_DATE => 15, DemandeAnnulationPeer::SINISTRE_RESUME => 16, DemandeAnnulationPeer::FILE_1 => 17, DemandeAnnulationPeer::FILE_2 => 18, DemandeAnnulationPeer::FILE_3 => 19, DemandeAnnulationPeer::FILE_4 => 20, DemandeAnnulationPeer::CREATED_AT => 21, DemandeAnnulationPeer::UPDATED_AT => 22, DemandeAnnulationPeer::ACTIVE => 23, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID' => 0, 'ASSURE_NOM' => 1, 'ASSURE_PRENOM' => 2, 'ASSURE_ADRESSE' => 3, 'ASSURE_CODE_POSTAL' => 4, 'ASSURE_VILLE' => 5, 'ASSURE_PAYS' => 6, 'ASSURE_MAIL' => 7, 'ASSURE_TELEPHONE' => 8, 'CAMPING_ID' => 9, 'CAMPING_NUM_RESA' => 10, 'CAMPING_MONTANT_SEJOUR' => 11, 'CAMPING_MONTANT_VERSE' => 12, 'SINISTRE_NATURE' => 13, 'SINISTRE_SUITE' => 14, 'SINISTRE_DATE' => 15, 'SINISTRE_RESUME' => 16, 'FILE_1' => 17, 'FILE_2' => 18, 'FILE_3' => 19, 'FILE_4' => 20, 'CREATED_AT' => 21, 'UPDATED_AT' => 22, 'ACTIVE' => 23, ),
        BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'assure_nom' => 1, 'assure_prenom' => 2, 'assure_adresse' => 3, 'assure_code_postal' => 4, 'assure_ville' => 5, 'assure_pays' => 6, 'assure_mail' => 7, 'assure_telephone' => 8, 'camping_id' => 9, 'camping_num_resa' => 10, 'camping_montant_sejour' => 11, 'camping_montant_verse' => 12, 'sinistre_nature' => 13, 'sinistre_suite' => 14, 'sinistre_date' => 15, 'sinistre_resume' => 16, 'file_1' => 17, 'file_2' => 18, 'file_3' => 19, 'file_4' => 20, 'created_at' => 21, 'updated_at' => 22, 'active' => 23, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, )
    );

    /** The enumerated values for this table */
    protected static $enumValueSets = array(
        DemandeAnnulationPeer::SINISTRE_NATURE => array(
            DemandeAnnulationPeer::SINISTRE_NATURE_ANNULATION_NATURESINISTRE_ANNULATION,
            DemandeAnnulationPeer::SINISTRE_NATURE_ANNULATION_NATURESINISTRE_INTERRUPTION,
        ),
        DemandeAnnulationPeer::SINISTRE_SUITE => array(
            DemandeAnnulationPeer::SINISTRE_SUITE_ANNULATION_SUITESINISTRE_MALADIE,
            DemandeAnnulationPeer::SINISTRE_SUITE_ANNULATION_SUITESINISTRE_ACCIDENT,
            DemandeAnnulationPeer::SINISTRE_SUITE_ANNULATION_SUITESINISTRE_AUTRE,
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
        $toNames = DemandeAnnulationPeer::getFieldNames($toType);
        $key = isset(DemandeAnnulationPeer::$fieldKeys[$fromType][$name]) ? DemandeAnnulationPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(DemandeAnnulationPeer::$fieldKeys[$fromType], true));
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
        if (!array_key_exists($type, DemandeAnnulationPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return DemandeAnnulationPeer::$fieldNames[$type];
    }

    /**
     * Gets the list of values for all ENUM columns
     * @return array
     */
    public static function getValueSets()
    {
      return DemandeAnnulationPeer::$enumValueSets;
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
        $valueSets = DemandeAnnulationPeer::getValueSets();

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
     * @param      string $column The column name for current table. (i.e. DemandeAnnulationPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(DemandeAnnulationPeer::TABLE_NAME.'.', $alias.'.', $column);
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
            $criteria->addSelectColumn(DemandeAnnulationPeer::ID);
            $criteria->addSelectColumn(DemandeAnnulationPeer::ASSURE_NOM);
            $criteria->addSelectColumn(DemandeAnnulationPeer::ASSURE_PRENOM);
            $criteria->addSelectColumn(DemandeAnnulationPeer::ASSURE_ADRESSE);
            $criteria->addSelectColumn(DemandeAnnulationPeer::ASSURE_CODE_POSTAL);
            $criteria->addSelectColumn(DemandeAnnulationPeer::ASSURE_VILLE);
            $criteria->addSelectColumn(DemandeAnnulationPeer::ASSURE_PAYS);
            $criteria->addSelectColumn(DemandeAnnulationPeer::ASSURE_MAIL);
            $criteria->addSelectColumn(DemandeAnnulationPeer::ASSURE_TELEPHONE);
            $criteria->addSelectColumn(DemandeAnnulationPeer::CAMPING_ID);
            $criteria->addSelectColumn(DemandeAnnulationPeer::CAMPING_NUM_RESA);
            $criteria->addSelectColumn(DemandeAnnulationPeer::CAMPING_MONTANT_SEJOUR);
            $criteria->addSelectColumn(DemandeAnnulationPeer::CAMPING_MONTANT_VERSE);
            $criteria->addSelectColumn(DemandeAnnulationPeer::SINISTRE_NATURE);
            $criteria->addSelectColumn(DemandeAnnulationPeer::SINISTRE_SUITE);
            $criteria->addSelectColumn(DemandeAnnulationPeer::SINISTRE_DATE);
            $criteria->addSelectColumn(DemandeAnnulationPeer::SINISTRE_RESUME);
            $criteria->addSelectColumn(DemandeAnnulationPeer::FILE_1);
            $criteria->addSelectColumn(DemandeAnnulationPeer::FILE_2);
            $criteria->addSelectColumn(DemandeAnnulationPeer::FILE_3);
            $criteria->addSelectColumn(DemandeAnnulationPeer::FILE_4);
            $criteria->addSelectColumn(DemandeAnnulationPeer::CREATED_AT);
            $criteria->addSelectColumn(DemandeAnnulationPeer::UPDATED_AT);
            $criteria->addSelectColumn(DemandeAnnulationPeer::ACTIVE);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.assure_nom');
            $criteria->addSelectColumn($alias . '.assure_prenom');
            $criteria->addSelectColumn($alias . '.assure_adresse');
            $criteria->addSelectColumn($alias . '.assure_code_postal');
            $criteria->addSelectColumn($alias . '.assure_ville');
            $criteria->addSelectColumn($alias . '.assure_pays');
            $criteria->addSelectColumn($alias . '.assure_mail');
            $criteria->addSelectColumn($alias . '.assure_telephone');
            $criteria->addSelectColumn($alias . '.camping_id');
            $criteria->addSelectColumn($alias . '.camping_num_resa');
            $criteria->addSelectColumn($alias . '.camping_montant_sejour');
            $criteria->addSelectColumn($alias . '.camping_montant_verse');
            $criteria->addSelectColumn($alias . '.sinistre_nature');
            $criteria->addSelectColumn($alias . '.sinistre_suite');
            $criteria->addSelectColumn($alias . '.sinistre_date');
            $criteria->addSelectColumn($alias . '.sinistre_resume');
            $criteria->addSelectColumn($alias . '.file_1');
            $criteria->addSelectColumn($alias . '.file_2');
            $criteria->addSelectColumn($alias . '.file_3');
            $criteria->addSelectColumn($alias . '.file_4');
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
        $criteria->setPrimaryTableName(DemandeAnnulationPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            DemandeAnnulationPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(DemandeAnnulationPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(DemandeAnnulationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 DemandeAnnulation
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = DemandeAnnulationPeer::doSelect($critcopy, $con);
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
        return DemandeAnnulationPeer::populateObjects(DemandeAnnulationPeer::doSelectStmt($criteria, $con));
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
            $con = Propel::getConnection(DemandeAnnulationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            DemandeAnnulationPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(DemandeAnnulationPeer::DATABASE_NAME);

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
     * @param      DemandeAnnulation $obj A DemandeAnnulation object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getId();
            } // if key === null
            DemandeAnnulationPeer::$instances[$key] = $obj;
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
     * @param      mixed $value A DemandeAnnulation object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof DemandeAnnulation) {
                $key = (string) $value->getId();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or DemandeAnnulation object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(DemandeAnnulationPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return   DemandeAnnulation Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(DemandeAnnulationPeer::$instances[$key])) {
                return DemandeAnnulationPeer::$instances[$key];
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
        DemandeAnnulationPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to demande_annulation
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
        $cls = DemandeAnnulationPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = DemandeAnnulationPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = DemandeAnnulationPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                DemandeAnnulationPeer::addInstanceToPool($obj, $key);
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
     * @return array (DemandeAnnulation object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = DemandeAnnulationPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = DemandeAnnulationPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + DemandeAnnulationPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = DemandeAnnulationPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            DemandeAnnulationPeer::addInstanceToPool($obj, $key);
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
        $criteria->setPrimaryTableName(DemandeAnnulationPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            DemandeAnnulationPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(DemandeAnnulationPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(DemandeAnnulationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(DemandeAnnulationPeer::CAMPING_ID, EtablissementPeer::ID, $join_behavior);

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
     * Selects a collection of DemandeAnnulation objects pre-filled with their Etablissement objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of DemandeAnnulation objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinEtablissement(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(DemandeAnnulationPeer::DATABASE_NAME);
        }

        DemandeAnnulationPeer::addSelectColumns($criteria);
        $startcol = DemandeAnnulationPeer::NUM_HYDRATE_COLUMNS;
        EtablissementPeer::addSelectColumns($criteria);

        $criteria->addJoin(DemandeAnnulationPeer::CAMPING_ID, EtablissementPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = DemandeAnnulationPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = DemandeAnnulationPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = DemandeAnnulationPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                DemandeAnnulationPeer::addInstanceToPool($obj1, $key1);
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

                // Add the $obj1 (DemandeAnnulation) to $obj2 (Etablissement)
                $obj2->addDemandeAnnulation($obj1);

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
        $criteria->setPrimaryTableName(DemandeAnnulationPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            DemandeAnnulationPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(DemandeAnnulationPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(DemandeAnnulationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(DemandeAnnulationPeer::CAMPING_ID, EtablissementPeer::ID, $join_behavior);

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
     * Selects a collection of DemandeAnnulation objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of DemandeAnnulation objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(DemandeAnnulationPeer::DATABASE_NAME);
        }

        DemandeAnnulationPeer::addSelectColumns($criteria);
        $startcol2 = DemandeAnnulationPeer::NUM_HYDRATE_COLUMNS;

        EtablissementPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + EtablissementPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(DemandeAnnulationPeer::CAMPING_ID, EtablissementPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = DemandeAnnulationPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = DemandeAnnulationPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = DemandeAnnulationPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                DemandeAnnulationPeer::addInstanceToPool($obj1, $key1);
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

                // Add the $obj1 (DemandeAnnulation) to the collection in $obj2 (Etablissement)
                $obj2->addDemandeAnnulation($obj1);
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
        return Propel::getDatabaseMap(DemandeAnnulationPeer::DATABASE_NAME)->getTable(DemandeAnnulationPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseDemandeAnnulationPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseDemandeAnnulationPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new DemandeAnnulationTableMap());
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
        return DemandeAnnulationPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a DemandeAnnulation or Criteria object.
     *
     * @param      mixed $values Criteria or DemandeAnnulation object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(DemandeAnnulationPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from DemandeAnnulation object
        }

        if ($criteria->containsKey(DemandeAnnulationPeer::ID) && $criteria->keyContainsValue(DemandeAnnulationPeer::ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.DemandeAnnulationPeer::ID.')');
        }


        // Set the correct dbName
        $criteria->setDbName(DemandeAnnulationPeer::DATABASE_NAME);

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
     * Performs an UPDATE on the database, given a DemandeAnnulation or Criteria object.
     *
     * @param      mixed $values Criteria or DemandeAnnulation object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(DemandeAnnulationPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(DemandeAnnulationPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(DemandeAnnulationPeer::ID);
            $value = $criteria->remove(DemandeAnnulationPeer::ID);
            if ($value) {
                $selectCriteria->add(DemandeAnnulationPeer::ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(DemandeAnnulationPeer::TABLE_NAME);
            }

        } else { // $values is DemandeAnnulation object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(DemandeAnnulationPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the demande_annulation table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(DemandeAnnulationPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(DemandeAnnulationPeer::TABLE_NAME, $con, DemandeAnnulationPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DemandeAnnulationPeer::clearInstancePool();
            DemandeAnnulationPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a DemandeAnnulation or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or DemandeAnnulation object or primary key or array of primary keys
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
            $con = Propel::getConnection(DemandeAnnulationPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            DemandeAnnulationPeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof DemandeAnnulation) { // it's a model object
            // invalidate the cache for this single object
            DemandeAnnulationPeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(DemandeAnnulationPeer::DATABASE_NAME);
            $criteria->add(DemandeAnnulationPeer::ID, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                DemandeAnnulationPeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(DemandeAnnulationPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            DemandeAnnulationPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given DemandeAnnulation object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param      DemandeAnnulation $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(DemandeAnnulationPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(DemandeAnnulationPeer::TABLE_NAME);

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

        return BasePeer::doValidate(DemandeAnnulationPeer::DATABASE_NAME, DemandeAnnulationPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param      int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return DemandeAnnulation
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = DemandeAnnulationPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(DemandeAnnulationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(DemandeAnnulationPeer::DATABASE_NAME);
        $criteria->add(DemandeAnnulationPeer::ID, $pk);

        $v = DemandeAnnulationPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return DemandeAnnulation[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(DemandeAnnulationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(DemandeAnnulationPeer::DATABASE_NAME);
            $criteria->add(DemandeAnnulationPeer::ID, $pks, Criteria::IN);
            $objs = DemandeAnnulationPeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BaseDemandeAnnulationPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseDemandeAnnulationPeer::buildTableMap();

