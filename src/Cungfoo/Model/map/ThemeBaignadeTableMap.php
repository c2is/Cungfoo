<?php

namespace Cungfoo\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'theme_baignade' table.
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
class ThemeBaignadeTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Cungfoo.Model.map.ThemeBaignadeTableMap';

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
        $this->setName('theme_baignade');
        $this->setPhpName('ThemeBaignade');
        $this->setClassname('Cungfoo\\Model\\ThemeBaignade');
        $this->setPackage('Cungfoo.Model');
        $this->setUseIdGenerator(false);
        $this->setIsCrossRef(true);
        // columns
        $this->addForeignPrimaryKey('theme_id', 'ThemeId', 'INTEGER' , 'theme', 'id', true, null, null);
        $this->addForeignPrimaryKey('baignade_id', 'BaignadeId', 'INTEGER' , 'baignade', 'id', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Theme', 'Cungfoo\\Model\\Theme', RelationMap::MANY_TO_ONE, array('theme_id' => 'id', ), null, null);
        $this->addRelation('Baignade', 'Cungfoo\\Model\\Baignade', RelationMap::MANY_TO_ONE, array('baignade_id' => 'id', ), null, null);
    } // buildRelations()

} // ThemeBaignadeTableMap
