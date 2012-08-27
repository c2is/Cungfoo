<?php

namespace Cungfoo\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'camping' table.
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
class CampingTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Cungfoo.Model.map.CampingTableMap';

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
        $this->setName('camping');
        $this->setPhpName('Camping');
        $this->setClassname('Cungfoo\\Model\\Camping');
        $this->setPackage('Cungfoo.Model');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('NAME', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('ADDRESS1', 'Address1', 'VARCHAR', false, 255, null);
        $this->addColumn('ADDRESS2', 'Address2', 'VARCHAR', false, 255, null);
        $this->addColumn('ZIP', 'Zip', 'VARCHAR', false, 255, null);
        $this->addColumn('CITY', 'City', 'VARCHAR', false, 255, null);
        $this->addColumn('MAIL', 'Mail', 'VARCHAR', false, 255, null);
        $this->addColumn('COUNTRY', 'Country', 'VARCHAR', false, 255, null);
        $this->addColumn('COUNTRY_CODE', 'CountryCode', 'VARCHAR', false, 255, null);
        $this->addColumn('PHONE1', 'Phone1', 'VARCHAR', false, 255, null);
        $this->addColumn('PHONE2', 'Phone2', 'VARCHAR', false, 255, null);
        $this->addColumn('FAX', 'Fax', 'VARCHAR', false, 255, null);
        $this->addForeignKey('VILLE_ID', 'VilleId', 'VARCHAR', 'ville', 'ID', false, 255, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Ville', 'Cungfoo\\Model\\Ville', RelationMap::MANY_TO_ONE, array('ville_id' => 'id', ), null, null);
        $this->addRelation('CampingTypeHebergement', 'Cungfoo\\Model\\CampingTypeHebergement', RelationMap::ONE_TO_MANY, array('id' => 'camping_id', ), 'CASCADE', null, 'CampingTypeHebergements');
        $this->addRelation('CampingDestination', 'Cungfoo\\Model\\CampingDestination', RelationMap::ONE_TO_MANY, array('id' => 'camping_id', ), 'CASCADE', null, 'CampingDestinations');
        $this->addRelation('CampingActivite', 'Cungfoo\\Model\\CampingActivite', RelationMap::ONE_TO_MANY, array('id' => 'camping_id', ), 'CASCADE', null, 'CampingActivites');
        $this->addRelation('CampingEquipement', 'Cungfoo\\Model\\CampingEquipement', RelationMap::ONE_TO_MANY, array('id' => 'camping_id', ), 'CASCADE', null, 'CampingEquipements');
        $this->addRelation('CampingServiceComplementaire', 'Cungfoo\\Model\\CampingServiceComplementaire', RelationMap::ONE_TO_MANY, array('id' => 'camping_id', ), 'CASCADE', null, 'CampingServiceComplementaires');
        $this->addRelation('TypeHebergement', 'Cungfoo\\Model\\TypeHebergement', RelationMap::MANY_TO_MANY, array(), null, null, 'TypeHebergements');
        $this->addRelation('Destination', 'Cungfoo\\Model\\Destination', RelationMap::MANY_TO_MANY, array(), null, null, 'Destinations');
        $this->addRelation('Activite', 'Cungfoo\\Model\\Activite', RelationMap::MANY_TO_MANY, array(), null, null, 'Activites');
        $this->addRelation('Equipement', 'Cungfoo\\Model\\Equipement', RelationMap::MANY_TO_MANY, array(), null, null, 'Equipements');
        $this->addRelation('ServiceComplementaire', 'Cungfoo\\Model\\ServiceComplementaire', RelationMap::MANY_TO_MANY, array(), null, null, 'ServiceComplementaires');
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
            'crudable' => array('route_controller' => '', 'route_prefix' => '', 'routes_file' => '', 'languages_file' => '', 'crud_prefix' => '/camping', 'crud_model' => '', 'crud_form' => '', ),
        );
    } // getBehaviors()

} // CampingTableMap
