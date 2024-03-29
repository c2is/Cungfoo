<?php

namespace Cungfoo\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'region_event' table.
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
class RegionEventTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Cungfoo.Model.map.RegionEventTableMap';

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
        $this->setName('region_event');
        $this->setPhpName('RegionEvent');
        $this->setClassname('Cungfoo\\Model\\RegionEvent');
        $this->setPackage('Cungfoo.Model');
        $this->setUseIdGenerator(false);
        $this->setIsCrossRef(true);
        // columns
        $this->addForeignPrimaryKey('region_id', 'RegionId', 'INTEGER' , 'region', 'id', true, null, null);
        $this->addForeignPrimaryKey('event_id', 'EventId', 'INTEGER' , 'event', 'id', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Region', 'Cungfoo\\Model\\Region', RelationMap::MANY_TO_ONE, array('region_id' => 'id', ), 'CASCADE', null);
        $this->addRelation('Event', 'Cungfoo\\Model\\Event', RelationMap::MANY_TO_ONE, array('event_id' => 'id', ), 'CASCADE', null);
    } // buildRelations()

} // RegionEventTableMap
