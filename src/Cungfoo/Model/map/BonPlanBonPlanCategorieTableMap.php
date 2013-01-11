<?php

namespace Cungfoo\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'bon_plan_bon_plan_categorie' table.
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
class BonPlanBonPlanCategorieTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Cungfoo.Model.map.BonPlanBonPlanCategorieTableMap';

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
        $this->setName('bon_plan_bon_plan_categorie');
        $this->setPhpName('BonPlanBonPlanCategorie');
        $this->setClassname('Cungfoo\\Model\\BonPlanBonPlanCategorie');
        $this->setPackage('Cungfoo.Model');
        $this->setUseIdGenerator(false);
        $this->setIsCrossRef(true);
        // columns
        $this->addForeignPrimaryKey('bon_plan_id', 'BonPlanId', 'INTEGER' , 'bon_plan', 'id', true, null, null);
        $this->addForeignPrimaryKey('bon_plan_categorie_id', 'BonPlanCategorieId', 'INTEGER' , 'bon_plan_categorie', 'id', true, null, null);
        $this->addColumn('sortable_rank', 'SortableRank', 'INTEGER', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('BonPlan', 'Cungfoo\\Model\\BonPlan', RelationMap::MANY_TO_ONE, array('bon_plan_id' => 'id', ), null, null);
        $this->addRelation('BonPlanCategorie', 'Cungfoo\\Model\\BonPlanCategorie', RelationMap::MANY_TO_ONE, array('bon_plan_categorie_id' => 'id', ), null, null);
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
            'sortable' =>  array (
  'rank_column' => 'sortable_rank',
  'use_scope' => 'true',
  'scope_column' => 'bon_plan_categorie_id',
),
        );
    } // getBehaviors()

} // BonPlanBonPlanCategorieTableMap
