<?php

namespace Cungfoo\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'dernieres_minutes_destination' table.
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
class DernieresMinutesDestinationTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Cungfoo.Model.map.DernieresMinutesDestinationTableMap';

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
        $this->setName('dernieres_minutes_destination');
        $this->setPhpName('DernieresMinutesDestination');
        $this->setClassname('Cungfoo\\Model\\DernieresMinutesDestination');
        $this->setPackage('Cungfoo.Model');
        $this->setUseIdGenerator(false);
        $this->setIsCrossRef(true);
        // columns
        $this->addForeignPrimaryKey('DERNIERES_MINUTES_ID', 'DernieresMinutesId', 'INTEGER' , 'dernieres_minutes', 'ID', true, null, null);
        $this->addForeignPrimaryKey('DESTINATION_ID', 'DestinationId', 'INTEGER' , 'destination', 'ID', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('DernieresMinutes', 'Cungfoo\\Model\\DernieresMinutes', RelationMap::MANY_TO_ONE, array('dernieres_minutes_id' => 'id', ), 'CASCADE', null);
        $this->addRelation('Destination', 'Cungfoo\\Model\\Destination', RelationMap::MANY_TO_ONE, array('destination_id' => 'id', ), null, null);
    } // buildRelations()

} // DernieresMinutesDestinationTableMap