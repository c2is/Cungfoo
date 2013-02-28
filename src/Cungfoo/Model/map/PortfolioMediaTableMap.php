<?php

namespace Cungfoo\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'portfolio_media' table.
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
class PortfolioMediaTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Cungfoo.Model.map.PortfolioMediaTableMap';

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
        $this->setName('portfolio_media');
        $this->setPhpName('PortfolioMedia');
        $this->setClassname('Cungfoo\\Model\\PortfolioMedia');
        $this->setPackage('Cungfoo.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('file', 'File', 'VARCHAR', false, 255, null);
        $this->addColumn('title', 'Title', 'VARCHAR', true, 255, null);
        $this->addColumn('description', 'Description', 'LONGVARCHAR', false, null, null);
        $this->addColumn('width', 'Width', 'VARCHAR', false, 255, null);
        $this->addColumn('height', 'Height', 'VARCHAR', false, 255, null);
        $this->addColumn('size', 'Size', 'VARCHAR', false, 255, null);
        $this->addColumn('type', 'Type', 'VARCHAR', false, 255, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('active', 'Active', 'BOOLEAN', false, 1, false);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('PortfolioMediaTag', 'Cungfoo\\Model\\PortfolioMediaTag', RelationMap::ONE_TO_MANY, array('id' => 'media_id', ), 'CASCADE', null, 'PortfolioMediaTags');
        $this->addRelation('PortfolioUsage', 'Cungfoo\\Model\\PortfolioUsage', RelationMap::ONE_TO_MANY, array('id' => 'media_id', ), 'CASCADE', null, 'PortfolioUsages');
        $this->addRelation('PortfolioMediaI18n', 'Cungfoo\\Model\\PortfolioMediaI18n', RelationMap::ONE_TO_MANY, array('id' => 'id', ), 'CASCADE', null, 'PortfolioMediaI18ns');
        $this->addRelation('PortfolioTag', 'Cungfoo\\Model\\PortfolioTag', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'PortfolioTags');
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'timestampable' =>  array (
  'create_column' => 'created_at',
  'update_column' => 'updated_at',
  'disable_updated_at' => 'false',
),
            'active' =>  array (
  'active_column' => 'active',
  'active_locale_column' => 'active_locale',
),
            'crudable' =>  array (
  'route_prefix' => '/',
  'crud_prefix' => '/portfolio/medias',
  'crud_model' => NULL,
  'crud_form' => NULL,
  'crud_type_file' => 'file',
),
            'seo' =>  array (
  'seo_columns' => 'seo_title,seo_description,seo_h1,seo_keywords',
  'seo_description' => 'LONGVARCHAR',
  'seo_keywords' => 'LONGVARCHAR',
),
            'i18n' =>  array (
  'i18n_table' => '%TABLE%_i18n',
  'i18n_phpname' => '%PHPNAME%I18n',
  'i18n_columns' => ',seo_title,seo_description,seo_h1,seo_keywords,active_locale',
  'i18n_pk_name' => NULL,
  'locale_column' => 'locale',
  'default_locale' => 'fr',
  'locale_alias' => '',
),
        );
    } // getBehaviors()

} // PortfolioMediaTableMap
