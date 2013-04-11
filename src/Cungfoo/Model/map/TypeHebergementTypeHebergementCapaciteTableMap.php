<?php

namespace Cungfoo\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'type_hebergement_type_hebergement_capacite' table.
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
class TypeHebergementTypeHebergementCapaciteTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Cungfoo.Model.map.TypeHebergementTypeHebergementCapaciteTableMap';

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
        $this->setName('type_hebergement_type_hebergement_capacite');
        $this->setPhpName('TypeHebergementTypeHebergementCapacite');
        $this->setClassname('Cungfoo\\Model\\TypeHebergementTypeHebergementCapacite');
        $this->setPackage('Cungfoo.Model');
        $this->setUseIdGenerator(false);
        $this->setIsCrossRef(true);
        // columns
        $this->addForeignPrimaryKey('type_hebergement_id', 'TypeHebergementId', 'INTEGER' , 'type_hebergement', 'id', true, null, null);
        $this->addForeignPrimaryKey('type_hebergement_capacite_id', 'TypeHebergementCapaciteId', 'INTEGER' , 'type_hebergement_capacite', 'id', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('TypeHebergement', 'Cungfoo\\Model\\TypeHebergement', RelationMap::MANY_TO_ONE, array('type_hebergement_id' => 'id', ), 'CASCADE', null);
        $this->addRelation('TypeHebergementCapacite', 'Cungfoo\\Model\\TypeHebergementCapacite', RelationMap::MANY_TO_ONE, array('type_hebergement_capacite_id' => 'id', ), 'CASCADE', null);
    } // buildRelations()

} // TypeHebergementTypeHebergementCapaciteTableMap
