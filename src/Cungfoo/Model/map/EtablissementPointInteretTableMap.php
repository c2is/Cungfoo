<?php

namespace Cungfoo\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'etablissement_point_interet' table.
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
class EtablissementPointInteretTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Cungfoo.Model.map.EtablissementPointInteretTableMap';

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
        $this->setName('etablissement_point_interet');
        $this->setPhpName('EtablissementPointInteret');
        $this->setClassname('Cungfoo\\Model\\EtablissementPointInteret');
        $this->setPackage('Cungfoo.Model');
        $this->setUseIdGenerator(false);
        $this->setIsCrossRef(true);
        // columns
        $this->addForeignPrimaryKey('etablissement_id', 'EtablissementId', 'INTEGER' , 'etablissement', 'id', true, null, null);
        $this->addForeignPrimaryKey('point_interet_id', 'PointInteretId', 'INTEGER' , 'point_interet', 'id', true, null, null);
        $this->addColumn('distance', 'Distance', 'VARCHAR', false, 255, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Etablissement', 'Cungfoo\\Model\\Etablissement', RelationMap::MANY_TO_ONE, array('etablissement_id' => 'id', ), 'CASCADE', null);
        $this->addRelation('PointInteret', 'Cungfoo\\Model\\PointInteret', RelationMap::MANY_TO_ONE, array('point_interet_id' => 'id', ), null, null);
    } // buildRelations()

} // EtablissementPointInteretTableMap
