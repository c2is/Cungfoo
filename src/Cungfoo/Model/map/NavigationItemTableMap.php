<?php

namespace Cungfoo\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'navigation_item' table.
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
class NavigationItemTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Cungfoo.Model.map.NavigationItemTableMap';

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
        $this->setName('navigation_item');
        $this->setPhpName('NavigationItem');
        $this->setClassname('Cungfoo\\Model\\NavigationItem');
        $this->setPackage('Cungfoo.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('parent_id', 'ParentId', 'INTEGER', 'navigation_item', 'id', false, null, null);
        $this->addForeignKey('navigation_id', 'NavigationId', 'INTEGER', 'navigation', 'id', true, null, null);
        $this->addColumn('sortable_rank', 'SortableRank', 'INTEGER', false, null, null);
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
        $this->addRelation('Parent', 'Cungfoo\\Model\\NavigationItem', RelationMap::MANY_TO_ONE, array('parent_id' => 'id', ), 'CASCADE', null);
        $this->addRelation('Navigation', 'Cungfoo\\Model\\Navigation', RelationMap::MANY_TO_ONE, array('navigation_id' => 'id', ), 'CASCADE', null);
        $this->addRelation('Child', 'Cungfoo\\Model\\NavigationItem', RelationMap::ONE_TO_MANY, array('id' => 'parent_id', ), 'CASCADE', null, 'Childs');
        $this->addRelation('NavigationItemI18n', 'Cungfoo\\Model\\NavigationItemI18n', RelationMap::ONE_TO_MANY, array('id' => 'id', ), 'CASCADE', null, 'NavigationItemI18ns');
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
            'sortable' =>  array (
  'rank_column' => 'sortable_rank',
  'use_scope' => 'false',
  'scope_column' => 'sortable_scope',
),
            'timestampable' =>  array (
  'create_column' => 'created_at',
  'update_column' => 'updated_at',
  'disable_updated_at' => 'false',
),
            'active' =>  array (
  'active_column' => 'active',
  'active_locale_column' => 'active_locale',
),
            'i18n' =>  array (
  'i18n_table' => '%TABLE%_i18n',
  'i18n_phpname' => '%PHPNAME%I18n',
  'i18n_columns' => 'title,path,seo_title,seo_description,seo_h1,seo_keywords,active_locale',
  'i18n_pk_name' => NULL,
  'locale_column' => 'locale',
  'default_locale' => 'fr',
  'locale_alias' => '',
),
            'crudable' =>  array (
  'route_prefix' => '/',
  'crud_prefix' => '/navigation/items',
  'crud_model' => NULL,
  'crud_form' => NULL,
  'crud_type_file' => NULL,
),
            'seo' =>  array (
  'seo_columns' => 'seo_title,seo_description,seo_h1,seo_keywords',
  'seo_description' => 'LONGVARCHAR',
  'seo_keywords' => 'LONGVARCHAR',
),
        );
    } // getBehaviors()

} // NavigationItemTableMap
