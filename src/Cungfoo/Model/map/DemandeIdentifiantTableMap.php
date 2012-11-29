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
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('societe_nom', 'SocieteNom', 'VARCHAR', true, 255, null);
        $this->addColumn('societe_adresse_1', 'SocieteAdresse1', 'VARCHAR', true, 255, null);
        $this->addColumn('societe_adresse_2', 'SocieteAdresse2', 'VARCHAR', false, 255, null);
        $this->addColumn('societe_adresse_3', 'SocieteAdresse3', 'VARCHAR', false, 255, null);
        $this->addColumn('societe_adresse_4', 'SocieteAdresse4', 'VARCHAR', false, 255, null);
        $this->addColumn('societe_telephone', 'SocieteTelephone', 'VARCHAR', false, 255, null);
        $this->addColumn('societe_fax', 'SocieteFax', 'VARCHAR', false, 255, null);
        $this->addColumn('contact_prenom', 'ContactPrenom', 'VARCHAR', true, 255, null);
        $this->addColumn('contact_nom', 'ContactNom', 'VARCHAR', true, 255, null);
        $this->addColumn('contact_telephone', 'ContactTelephone', 'VARCHAR', false, 255, null);
        $this->addColumn('contact_mail', 'ContactMail', 'VARCHAR', true, 255, null);
        $this->addColumn('permanence', 'Permanence', 'VARCHAR', false, 255, null);
        $this->addColumn('permanence_matin_de', 'PermanenceMatinDe', 'VARCHAR', false, 255, null);
        $this->addColumn('permanence_matin_a', 'PermanenceMatinA', 'VARCHAR', false, 255, null);
        $this->addColumn('permanence_apres_midi_de', 'PermanenceApresMidiDe', 'VARCHAR', false, 255, null);
        $this->addColumn('permanence_apres_midi_a', 'PermanenceApresMidiA', 'VARCHAR', false, 255, null);
        $this->addColumn('client_vc', 'ClientVc', 'BOOLEAN', false, 1, null);
        $this->addColumn('client_vc_code', 'ClientVcCode', 'VARCHAR', false, 255, null);
        $this->addColumn('client_vd', 'ClientVd', 'BOOLEAN', false, 1, null);
        $this->addColumn('client_vd_code', 'ClientVdCode', 'VARCHAR', false, 255, null);
        $this->addColumn('brochure', 'Brochure', 'BOOLEAN', false, 1, null);
        $this->addColumn('identifiant', 'Identifiant', 'BOOLEAN', false, 1, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('active', 'Active', 'BOOLEAN', false, 1, false);
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
            'timestampable' =>  array (
  'create_column' => 'created_at',
  'update_column' => 'updated_at',
  'disable_updated_at' => 'false',
),
            'active' =>  array (
  'active_column' => 'active',
),
            'crudable' =>  array (
  'route_prefix' => '/',
  'crud_prefix' => '/demandes-identifiant',
  'crud_model' => NULL,
  'crud_form' => NULL,
  'crud_type_file' => NULL,
),
        );
    } // getBehaviors()

} // DemandeIdentifiantTableMap
