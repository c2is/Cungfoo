<?php

namespace Cungfoo\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'demande_annulation' table.
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
class DemandeAnnulationTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Cungfoo.Model.map.DemandeAnnulationTableMap';

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
        $this->setName('demande_annulation');
        $this->setPhpName('DemandeAnnulation');
        $this->setClassname('Cungfoo\\Model\\DemandeAnnulation');
        $this->setPackage('Cungfoo.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('assure_nom', 'AssureNom', 'VARCHAR', true, 255, null);
        $this->addColumn('assure_prenom', 'AssurePrenom', 'VARCHAR', true, 255, null);
        $this->addColumn('assure_adresse', 'AssureAdresse', 'LONGVARCHAR', true, null, null);
        $this->addColumn('assure_code_postal', 'AssureCodePostal', 'VARCHAR', true, 255, null);
        $this->addColumn('assure_ville', 'AssureVille', 'VARCHAR', true, 255, null);
        $this->addColumn('assure_pays', 'AssurePays', 'VARCHAR', true, 255, null);
        $this->addColumn('assure_mail', 'AssureMail', 'VARCHAR', true, 255, null);
        $this->addColumn('assure_telephone', 'AssureTelephone', 'VARCHAR', true, 255, null);
        $this->addColumn('montant_sejour_camping', 'MontantSejourCamping', 'VARCHAR', true, 255, null);
        $this->addColumn('montant_verse_camping', 'MontantVerseCamping', 'VARCHAR', true, 255, null);
        $this->addForeignKey('camping_id', 'CampingId', 'INTEGER', 'etablissement', 'id', true, null, null);
        $this->addColumn('camping_num_resa', 'CampingNumResa', 'VARCHAR', true, 255, null);
        $this->addColumn('sinistre_nature', 'SinistreNature', 'ENUM', true, null, null);
        $this->getColumn('sinistre_nature', false)->setValueSet(array (
  0 => 'annulation.natureSinistre.annulation',
  1 => 'annulation.natureSinistre.interruption',
));
        $this->addColumn('sinistre_suite', 'SinistreSuite', 'ENUM', true, null, null);
        $this->getColumn('sinistre_suite', false)->setValueSet(array (
  0 => 'annulation.suiteSinistre.maladie',
  1 => 'annulation.suiteSinistre.accident',
  2 => 'annulation.suiteSinistre.autre',
));
        $this->addColumn('sinistre_date', 'SinistreDate', 'VARCHAR', true, 255, null);
        $this->addColumn('sinistre_resume', 'SinistreResume', 'VARCHAR', true, 255, null);
        $this->addColumn('file_1', 'File1', 'VARCHAR', false, 255, null);
        $this->addColumn('file_2', 'File2', 'VARCHAR', false, 255, null);
        $this->addColumn('file_3', 'File3', 'VARCHAR', false, 255, null);
        $this->addColumn('file_4', 'File4', 'VARCHAR', false, 255, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Etablissement', 'Cungfoo\\Model\\Etablissement', RelationMap::MANY_TO_ONE, array('camping_id' => 'id', ), null, null);
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
            'crudable' =>  array (
  'route_prefix' => '/',
  'crud_prefix' => '/demandes-annulation',
  'crud_model' => NULL,
  'crud_form' => NULL,
  'crud_type_file' => 'file_1, file_2, file_3, file_4',
),
        );
    } // getBehaviors()

} // DemandeAnnulationTableMap
