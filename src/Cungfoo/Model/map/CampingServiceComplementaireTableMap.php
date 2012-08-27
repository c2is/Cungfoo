<?php

namespace Cungfoo\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'camping_service_complementaire' table.
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
class CampingServiceComplementaireTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Cungfoo.Model.map.CampingServiceComplementaireTableMap';

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
        $this->setName('camping_service_complementaire');
        $this->setPhpName('CampingServiceComplementaire');
        $this->setClassname('Cungfoo\\Model\\CampingServiceComplementaire');
        $this->setPackage('Cungfoo.Model');
        $this->setUseIdGenerator(false);
        $this->setIsCrossRef(true);
        // columns
        $this->addForeignPrimaryKey('CAMPING_ID', 'CampingId', 'INTEGER' , 'camping', 'ID', true, null, null);
        $this->addForeignPrimaryKey('SERVICE_COMPLEMENTAIRE_ID', 'ServiceComplementaireId', 'VARCHAR' , 'service_complementaire', 'ID', true, 255, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Camping', 'Cungfoo\\Model\\Camping', RelationMap::MANY_TO_ONE, array('camping_id' => 'id', ), 'CASCADE', null);
        $this->addRelation('ServiceComplementaire', 'Cungfoo\\Model\\ServiceComplementaire', RelationMap::MANY_TO_ONE, array('service_complementaire_id' => 'id', ), null, null);
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
            'crudable' => array('route_controller' => '\Cungfoo\Controller\CrudController', 'route_prefix' => '/admin', 'routes_file' => '../Cungfoo/crud.yml', 'languages_file' => '../languages.yml', 'crud_prefix' => '', 'crud_model' => '', 'crud_form' => '', ),
        );
    } // getBehaviors()

} // CampingServiceComplementaireTableMap
