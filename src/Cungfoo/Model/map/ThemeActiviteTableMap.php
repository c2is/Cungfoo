<?php

namespace Cungfoo\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'theme_activite' table.
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
class ThemeActiviteTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Cungfoo.Model.map.ThemeActiviteTableMap';

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
        $this->setName('theme_activite');
        $this->setPhpName('ThemeActivite');
        $this->setClassname('Cungfoo\\Model\\ThemeActivite');
        $this->setPackage('Cungfoo.Model');
        $this->setUseIdGenerator(false);
        $this->setIsCrossRef(true);
        // columns
        $this->addForeignPrimaryKey('theme_id', 'ThemeId', 'INTEGER' , 'theme', 'id', true, null, null);
        $this->addForeignPrimaryKey('activite_id', 'ActiviteId', 'INTEGER' , 'activite', 'id', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Theme', 'Cungfoo\\Model\\Theme', RelationMap::MANY_TO_ONE, array('theme_id' => 'id', ), null, null);
        $this->addRelation('Activite', 'Cungfoo\\Model\\Activite', RelationMap::MANY_TO_ONE, array('activite_id' => 'id', ), null, null);
    } // buildRelations()

} // ThemeActiviteTableMap
