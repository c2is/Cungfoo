<?php

namespace Cungfoo\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'top_camping_i18n' table.
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
class TopCampingI18nTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Cungfoo.Model.map.TopCampingI18nTableMap';

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
        $this->setName('top_camping_i18n');
        $this->setPhpName('TopCampingI18n');
        $this->setClassname('Cungfoo\\Model\\TopCampingI18n');
        $this->setPackage('Cungfoo.Model');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('id', 'Id', 'INTEGER' , 'top_camping', 'id', true, null, null);
        $this->addPrimaryKey('locale', 'Locale', 'VARCHAR', true, 5, 'fr');
        $this->addColumn('seo_title', 'SeoTitle', 'VARCHAR', false, 255, null);
        $this->addColumn('seo_description', 'SeoDescription', 'LONGVARCHAR', false, null, null);
        $this->addColumn('seo_h1', 'SeoH1', 'VARCHAR', false, 255, null);
        $this->addColumn('seo_keywords', 'SeoKeywords', 'LONGVARCHAR', false, null, null);
        $this->addColumn('active_locale', 'ActiveLocale', 'BOOLEAN', false, 1, false);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('TopCamping', 'Cungfoo\\Model\\TopCamping', RelationMap::MANY_TO_ONE, array('id' => 'id', ), 'CASCADE', null);
    } // buildRelations()

} // TopCampingI18nTableMap
