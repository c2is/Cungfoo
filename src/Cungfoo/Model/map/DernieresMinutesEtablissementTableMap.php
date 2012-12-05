<?php

namespace Cungfoo\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'dernieres_minutes_etablissement' table.
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
class DernieresMinutesEtablissementTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Cungfoo.Model.map.DernieresMinutesEtablissementTableMap';

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
        $this->setName('dernieres_minutes_etablissement');
        $this->setPhpName('DernieresMinutesEtablissement');
        $this->setClassname('Cungfoo\\Model\\DernieresMinutesEtablissement');
        $this->setPackage('Cungfoo.Model');
        $this->setUseIdGenerator(false);
        $this->setIsCrossRef(true);
        // columns
        $this->addForeignPrimaryKey('dernieres_minutes_id', 'DernieresMinutesId', 'INTEGER' , 'dernieres_minutes', 'id', true, null, null);
        $this->addForeignPrimaryKey('etablissement_id', 'EtablissementId', 'INTEGER' , 'etablissement', 'id', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('DernieresMinutes', 'Cungfoo\\Model\\DernieresMinutes', RelationMap::MANY_TO_ONE, array('dernieres_minutes_id' => 'id', ), 'CASCADE', null);
        $this->addRelation('Etablissement', 'Cungfoo\\Model\\Etablissement', RelationMap::MANY_TO_ONE, array('etablissement_id' => 'id', ), null, null);
    } // buildRelations()

} // DernieresMinutesEtablissementTableMap
