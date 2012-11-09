<?php

namespace Cungfoo\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'portfolio_media_tag' table.
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
class PortfolioMediaTagTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Cungfoo.Model.map.PortfolioMediaTagTableMap';

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
        $this->setName('portfolio_media_tag');
        $this->setPhpName('PortfolioMediaTag');
        $this->setClassname('Cungfoo\\Model\\PortfolioMediaTag');
        $this->setPackage('Cungfoo.Model');
        $this->setUseIdGenerator(false);
        $this->setIsCrossRef(true);
        // columns
        $this->addForeignPrimaryKey('MEDIA_ID', 'MediaId', 'INTEGER' , 'portfolio_media', 'ID', true, null, null);
        $this->addForeignPrimaryKey('TAG_ID', 'TagId', 'INTEGER' , 'portfolio_tag', 'ID', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('PortfolioMedia', 'Cungfoo\\Model\\PortfolioMedia', RelationMap::MANY_TO_ONE, array('media_id' => 'id', ), 'CASCADE', null);
        $this->addRelation('PortfolioTag', 'Cungfoo\\Model\\PortfolioTag', RelationMap::MANY_TO_ONE, array('tag_id' => 'id', ), null, null);
    } // buildRelations()

} // PortfolioMediaTagTableMap
