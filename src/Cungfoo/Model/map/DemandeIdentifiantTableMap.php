<?php

namespace Cungfoo\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'demande_identifiant' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.Cungfoo.Model.map
 */
class DemandeIdentifiantTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Cungfoo.Model.map.DemandeIdentifiantTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('demande_identifiant');
        $this->setPhpName('DemandeIdentifiant');
        $this->setClassname('Cungfoo\\Model\\DemandeIdentifiant');
        $this->setPackage('Cungfoo.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('SOCIETE_NOM', 'SocieteNom', 'VARCHAR', true, 255, null);
        $this->addColumn('SOCIETE_ADRESSE_1', 'SocieteAdresse1', 'VARCHAR', true, 255, null);
        $this->addColumn('SOCIETE_ADRESSE_2', 'SocieteAdresse2', 'VARCHAR', false, 255, null);
        $this->addColumn('SOCIETE_ADRESSE_3', 'SocieteAdresse3', 'VARCHAR', false, 255, null);
        $this->addColumn('SOCIETE_ADRESSE_4', 'SocieteAdresse4', 'VARCHAR', false, 255, null);
        $this->addColumn('SOCIETE_TELEPHONE', 'SocieteTelephone', 'VARCHAR', false, 255, null);
        $this->addColumn('SOCIETE_FAX', 'SocieteFax', 'VARCHAR', false, 255, null);
        $this->addColumn('CONTACT_PRENOM', 'ContactPrenom', 'VARCHAR', true, 255, null);
        $this->addColumn('CONTACT_NOM', 'ContactNom', 'VARCHAR', true, 255, null);
        $this->addColumn('CONTACT_TELEPHONE', 'ContactTelephone', 'VARCHAR', false, 255, null);
        $this->addColumn('CONTACT_MAIL', 'ContactMail', 'VARCHAR', true, 255, null);
        $this->addColumn('PERMANENCE', 'Permanence', 'VARCHAR', false, 255, null);
        $this->addColumn('PERMANENCE_MATIN_DE', 'PermanenceMatinDe', 'VARCHAR', false, 255, null);
        $this->addColumn('PERMANENCE_MATIN_A', 'PermanenceMatinA', 'VARCHAR', false, 255, null);
        $this->addColumn('PERMANENCE_APRES_MIDI_DE', 'PermanenceApresMidiDe', 'VARCHAR', false, 255, null);
        $this->addColumn('PERMANENCE_APRES_MIDI_A', 'PermanenceApresMidiA', 'VARCHAR', false, 255, null);
        $this->addColumn('CLIENT_VC', 'ClientVc', 'BOOLEAN', false, 1, null);
        $this->addColumn('CLIENT_VC_CODE', 'ClientVcCode', 'VARCHAR', false, 255, null);
        $this->addColumn('CLIENT_VD', 'ClientVd', 'BOOLEAN', false, 1, null);
        $this->addColumn('CLIENT_VD_CODE', 'ClientVdCode', 'VARCHAR', false, 255, null);
        $this->addColumn('BROCHURE', 'Brochure', 'BOOLEAN', false, 1, null);
        $this->addColumn('IDENTIFIANT', 'Identifiant', 'BOOLEAN', false, 1, null);
        $this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('ACTIVE', 'Active', 'BOOLEAN', false, 1, null);
        $this->addColumn('ENABLED', 'Enabled', 'BOOLEAN', false, 1, false);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', 'disable_updated_at' => 'false', ),
            'active' => array('active_column' => 'active', ),
            'crudable' => array('route_prefix' => '/', 'crud_prefix' => '/demandes-identifiant', 'crud_model' => '', 'crud_form' => '', 'crud_type_file' => '', ),
        );
    } // getBehaviors()

} // DemandeIdentifiantTableMap
