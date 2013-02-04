<?php

namespace Cungfoo\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'bon_plan_region' table.
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
class BonPlanRegionTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Cungfoo.Model.map.BonPlanRegionTableMap';

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
        $this->setName('bon_plan_region');
        $this->setPhpName('BonPlanRegion');
        $this->setClassname('Cungfoo\\Model\\BonPlanRegion');
        $this->setPackage('Cungfoo.Model');
        $this->setUseIdGenerator(false);
        $this->setIsCrossRef(true);
        // columns
        $this->addForeignPrimaryKey('bon_plan_id', 'BonPlanId', 'INTEGER' , 'bon_plan', 'id', true, null, null);
        $this->addForeignPrimaryKey('region_id', 'RegionId', 'INTEGER' , 'region', 'id', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('BonPlan', 'Cungfoo\\Model\\BonPlan', RelationMap::MANY_TO_ONE, array('bon_plan_id' => 'id', ), 'CASCADE', null);
        $this->addRelation('Region', 'Cungfoo\\Model\\Region', RelationMap::MANY_TO_ONE, array('region_id' => 'id', ), 'CASCADE', null);
    } // buildRelations()

} // BonPlanRegionTableMap
