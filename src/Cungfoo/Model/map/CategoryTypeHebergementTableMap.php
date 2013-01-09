<?php

namespace Cungfoo\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'category_type_hebergement' table.
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
class CategoryTypeHebergementTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Cungfoo.Model.map.CategoryTypeHebergementTableMap';

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
        $this->setName('category_type_hebergement');
        $this->setPhpName('CategoryTypeHebergement');
        $this->setClassname('Cungfoo\\Model\\CategoryTypeHebergement');
        $this->setPackage('Cungfoo.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('code', 'Code', 'VARCHAR', true, 255, null);
        $this->addColumn('image_menu', 'ImageMenu', 'VARCHAR', false, 255, null);
        $this->addColumn('image_page', 'ImagePage', 'VARCHAR', false, 255, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('active', 'Active', 'BOOLEAN', false, 1, false);
        $this->addColumn('sortable_rank', 'SortableRank', 'INTEGER', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('TypeHebergement', 'Cungfoo\\Model\\TypeHebergement', RelationMap::ONE_TO_MANY, array('id' => 'category_type_hebergement_id', ), null, null, 'TypeHebergements');
        $this->addRelation('CategoryTypeHebergementI18n', 'Cungfoo\\Model\\CategoryTypeHebergementI18n', RelationMap::ONE_TO_MANY, array('id' => 'id', ), 'CASCADE', null, 'CategoryTypeHebergementI18ns');
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
),
            'sortable' =>  array (
  'rank_column' => 'sortable_rank',
  'use_scope' => 'false',
  'scope_column' => 'sortable_scope',
),
            'i18n' =>  array (
  'i18n_table' => '%TABLE%_i18n',
  'i18n_phpname' => '%PHPNAME%I18n',
  'i18n_columns' => 'name,slug,accroche,description',
  'i18n_pk_name' => NULL,
  'locale_column' => 'locale',
  'default_locale' => 'fr',
  'locale_alias' => '',
),
            'crudable' =>  array (
  'route_prefix' => '/',
  'crud_prefix' => '/category-type-hebergement',
  'crud_model' => NULL,
  'crud_form' => NULL,
  'crud_type_file' => 'image_menu,image_page',
),
        );
    } // getBehaviors()

} // CategoryTypeHebergementTableMap
