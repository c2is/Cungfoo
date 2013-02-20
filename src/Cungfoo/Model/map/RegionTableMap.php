<?php

namespace Cungfoo\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'region' table.
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
class RegionTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Cungfoo.Model.map.RegionTableMap';

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
        $this->setName('region');
        $this->setPhpName('Region');
        $this->setClassname('Cungfoo\\Model\\Region');
        $this->setPackage('Cungfoo.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('code', 'Code', 'VARCHAR', true, 255, null);
        $this->addColumn('image_path', 'ImagePath', 'VARCHAR', false, 255, null);
        $this->addColumn('image_encart_path', 'ImageEncartPath', 'VARCHAR', false, 255, null);
        $this->addColumn('image_encart_petite_path', 'ImageEncartPetitePath', 'VARCHAR', false, 255, null);
        $this->addForeignKey('pays_id', 'PaysId', 'INTEGER', 'pays', 'id', false, null, null);
        $this->addForeignKey('destination_id', 'DestinationId', 'INTEGER', 'destination', 'id', false, null, null);
        $this->addColumn('mea_home', 'MeaHome', 'BOOLEAN', false, 1, null);
        $this->addColumn('image_detail_1', 'ImageDetail1', 'VARCHAR', false, 255, null);
        $this->addColumn('image_detail_2', 'ImageDetail2', 'VARCHAR', false, 255, null);
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
        $this->addRelation('Pays', 'Cungfoo\\Model\\Pays', RelationMap::MANY_TO_ONE, array('pays_id' => 'id', ), 'SET NULL', null);
        $this->addRelation('Destination', 'Cungfoo\\Model\\Destination', RelationMap::MANY_TO_ONE, array('destination_id' => 'id', ), null, null);
        $this->addRelation('RegionPointInteret', 'Cungfoo\\Model\\RegionPointInteret', RelationMap::ONE_TO_MANY, array('id' => 'region_id', ), 'CASCADE', null, 'RegionPointInterets');
        $this->addRelation('RegionEvent', 'Cungfoo\\Model\\RegionEvent', RelationMap::ONE_TO_MANY, array('id' => 'region_id', ), 'CASCADE', null, 'RegionEvents');
        $this->addRelation('Ville', 'Cungfoo\\Model\\Ville', RelationMap::ONE_TO_MANY, array('id' => 'region_id', ), 'SET NULL', null, 'Villes');
        $this->addRelation('BonPlanRegion', 'Cungfoo\\Model\\BonPlanRegion', RelationMap::ONE_TO_MANY, array('id' => 'region_id', ), 'CASCADE', null, 'BonPlanRegions');
        $this->addRelation('RegionI18n', 'Cungfoo\\Model\\RegionI18n', RelationMap::ONE_TO_MANY, array('id' => 'id', ), 'CASCADE', null, 'RegionI18ns');
        $this->addRelation('PointInteret', 'Cungfoo\\Model\\PointInteret', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'PointInterets');
        $this->addRelation('Event', 'Cungfoo\\Model\\Event', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'Events');
        $this->addRelation('BonPlan', 'Cungfoo\\Model\\BonPlan', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'BonPlans');
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
            'i18n' =>  array (
  'i18n_table' => '%TABLE%_i18n',
  'i18n_phpname' => '%PHPNAME%I18n',
  'i18n_columns' => 'slug,name,introduction,description,seo_title,seo_description,seo_h1,seo_keywords,active_locale',
  'i18n_pk_name' => NULL,
  'locale_column' => 'locale',
  'default_locale' => 'fr',
  'locale_alias' => '',
),
            'crudable' =>  array (
  'route_prefix' => '/',
  'crud_prefix' => '/regions',
  'crud_model' => NULL,
  'crud_form' => NULL,
  'crud_type_file' => 'image_path,image_encart_path,image_encart_petite_path,image_detail_1,image_detail_2',
  'crud_search' => 'name',
),
            'seo' =>  array (
  'seo_columns' => 'seo_title,seo_description,seo_h1,seo_keywords',
  'seo_description' => 'LONGVARCHAR',
  'seo_keywords' => 'LONGVARCHAR',
),
        );
    } // getBehaviors()

} // RegionTableMap
