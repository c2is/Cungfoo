<?php

namespace Cungfoo\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'theme_i18n' table.
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
class ThemeI18nTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Cungfoo.Model.map.ThemeI18nTableMap';

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
        $this->setName('theme_i18n');
        $this->setPhpName('ThemeI18n');
        $this->setClassname('Cungfoo\\Model\\ThemeI18n');
        $this->setPackage('Cungfoo.Model');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('id', 'Id', 'INTEGER' , 'theme', 'id', true, null, null);
        $this->addPrimaryKey('locale', 'Locale', 'VARCHAR', true, 5, 'fr');
        $this->addColumn('name', 'Name', 'VARCHAR', false, 255, null);
        $this->addColumn('slug', 'Slug', 'VARCHAR', false, 255, null);
        $this->addColumn('introduction', 'Introduction', 'VARCHAR', false, 255, null);
        $this->addColumn('description', 'Description', 'LONGVARCHAR', false, null, null);
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
        $this->addRelation('Theme', 'Cungfoo\\Model\\Theme', RelationMap::MANY_TO_ONE, array('id' => 'id', ), 'CASCADE', null);
    } // buildRelations()

} // ThemeI18nTableMap
