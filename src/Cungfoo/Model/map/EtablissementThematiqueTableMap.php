<?php

namespace Cungfoo\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'etablissement_thematique' table.
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
class EtablissementThematiqueTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Cungfoo.Model.map.EtablissementThematiqueTableMap';

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
        $this->setName('etablissement_thematique');
        $this->setPhpName('EtablissementThematique');
        $this->setClassname('Cungfoo\\Model\\EtablissementThematique');
        $this->setPackage('Cungfoo.Model');
        $this->setUseIdGenerator(false);
        $this->setIsCrossRef(true);
        // columns
        $this->addForeignPrimaryKey('etablissement_id', 'EtablissementId', 'INTEGER' , 'etablissement', 'id', true, null, null);
        $this->addForeignPrimaryKey('thematique_id', 'ThematiqueId', 'INTEGER' , 'thematique', 'id', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Etablissement', 'Cungfoo\\Model\\Etablissement', RelationMap::MANY_TO_ONE, array('etablissement_id' => 'id', ), 'CASCADE', null);
        $this->addRelation('Thematique', 'Cungfoo\\Model\\Thematique', RelationMap::MANY_TO_ONE, array('thematique_id' => 'id', ), null, null);
    } // buildRelations()

} // EtablissementThematiqueTableMap
