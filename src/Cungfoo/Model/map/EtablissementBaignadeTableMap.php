<?php

namespace Cungfoo\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'etablissement_baignade' table.
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
class EtablissementBaignadeTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Cungfoo.Model.map.EtablissementBaignadeTableMap';

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
        $this->setName('etablissement_baignade');
        $this->setPhpName('EtablissementBaignade');
        $this->setClassname('Cungfoo\\Model\\EtablissementBaignade');
        $this->setPackage('Cungfoo.Model');
        $this->setUseIdGenerator(false);
        $this->setIsCrossRef(true);
        // columns
        $this->addForeignPrimaryKey('ETABLISSEMENT_ID', 'EtablissementId', 'INTEGER' , 'etablissement', 'ID', true, null, null);
        $this->addForeignPrimaryKey('BAIGNADE_ID', 'BaignadeId', 'INTEGER' , 'baignade', 'ID', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Etablissement', 'Cungfoo\\Model\\Etablissement', RelationMap::MANY_TO_ONE, array('etablissement_id' => 'id', ), 'CASCADE', null);
        $this->addRelation('Baignade', 'Cungfoo\\Model\\Baignade', RelationMap::MANY_TO_ONE, array('baignade_id' => 'id', ), null, null);
    } // buildRelations()

} // EtablissementBaignadeTableMap
