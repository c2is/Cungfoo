<?php

namespace Cungfoo\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'multimedia_etablissement_tag' table.
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
class MultimediaEtablissementTagTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Cungfoo.Model.map.MultimediaEtablissementTagTableMap';

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
        $this->setName('multimedia_etablissement_tag');
        $this->setPhpName('MultimediaEtablissementTag');
        $this->setClassname('Cungfoo\\Model\\MultimediaEtablissementTag');
        $this->setPackage('Cungfoo.Model');
        $this->setUseIdGenerator(false);
        $this->setIsCrossRef(true);
        // columns
        $this->addForeignPrimaryKey('multimedia_etablissement_id', 'MultimediaEtablissementId', 'INTEGER' , 'multimedia_etablissement', 'id', true, null, null);
        $this->addForeignPrimaryKey('tag_id', 'TagId', 'INTEGER' , 'tag', 'id', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('MultimediaEtablissement', 'Cungfoo\\Model\\MultimediaEtablissement', RelationMap::MANY_TO_ONE, array('multimedia_etablissement_id' => 'id', ), 'CASCADE', null);
        $this->addRelation('Tag', 'Cungfoo\\Model\\Tag', RelationMap::MANY_TO_ONE, array('tag_id' => 'id', ), null, null);
    } // buildRelations()

} // MultimediaEtablissementTagTableMap
