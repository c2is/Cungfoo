<?php

namespace Cungfoo\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'region_point_interet' table.
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
class RegionPointInteretTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Cungfoo.Model.map.RegionPointInteretTableMap';

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
        $this->setName('region_point_interet');
        $this->setPhpName('RegionPointInteret');
        $this->setClassname('Cungfoo\\Model\\RegionPointInteret');
        $this->setPackage('Cungfoo.Model');
        $this->setUseIdGenerator(false);
        $this->setIsCrossRef(true);
        // columns
        $this->addForeignPrimaryKey('region_id', 'RegionId', 'INTEGER' , 'region', 'id', true, null, null);
        $this->addForeignPrimaryKey('point_interet_id', 'PointInteretId', 'INTEGER' , 'point_interet', 'id', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Region', 'Cungfoo\\Model\\Region', RelationMap::MANY_TO_ONE, array('region_id' => 'id', ), 'CASCADE', null);
        $this->addRelation('PointInteret', 'Cungfoo\\Model\\PointInteret', RelationMap::MANY_TO_ONE, array('point_interet_id' => 'id', ), 'CASCADE', null);
    } // buildRelations()

} // RegionPointInteretTableMap
