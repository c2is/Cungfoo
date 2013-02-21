<?php

namespace Cungfoo\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'point_interet' table.
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
class PointInteretTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Cungfoo.Model.map.PointInteretTableMap';

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
        $this->setName('point_interet');
        $this->setPhpName('PointInteret');
        $this->setClassname('Cungfoo\\Model\\PointInteret');
        $this->setPackage('Cungfoo.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('code', 'Code', 'VARCHAR', true, 255, null);
        $this->addColumn('address', 'Address', 'VARCHAR', false, 255, null);
        $this->addColumn('address2', 'Address2', 'VARCHAR', false, 255, null);
        $this->addColumn('zipcode', 'Zipcode', 'VARCHAR', false, 255, null);
        $this->addColumn('city', 'City', 'VARCHAR', false, 255, null);
        $this->addColumn('tel', 'Tel', 'VARCHAR', false, 255, null);
        $this->addColumn('fax', 'Fax', 'VARCHAR', false, 255, null);
        $this->addColumn('email', 'Email', 'VARCHAR', false, 255, null);
        $this->addColumn('website', 'Website', 'VARCHAR', false, 255, null);
        $this->addColumn('geo_coordinate_x', 'GeoCoordinateX', 'VARCHAR', false, 255, null);
        $this->addColumn('geo_coordinate_y', 'GeoCoordinateY', 'VARCHAR', false, 255, null);
        $this->addColumn('distance_camping', 'DistanceCamping', 'VARCHAR', false, 255, null);
        $this->addColumn('image', 'Image', 'VARCHAR', false, 255, null);
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
        $this->addRelation('EtablissementPointInteret', 'Cungfoo\\Model\\EtablissementPointInteret', RelationMap::ONE_TO_MANY, array('id' => 'point_interet_id', ), 'CASCADE', null, 'EtablissementPointInterets');
        $this->addRelation('RegionPointInteret', 'Cungfoo\\Model\\RegionPointInteret', RelationMap::ONE_TO_MANY, array('id' => 'point_interet_id', ), 'CASCADE', null, 'RegionPointInterets');
        $this->addRelation('PointInteretI18n', 'Cungfoo\\Model\\PointInteretI18n', RelationMap::ONE_TO_MANY, array('id' => 'id', ), 'CASCADE', null, 'PointInteretI18ns');
        $this->addRelation('Etablissement', 'Cungfoo\\Model\\Etablissement', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'Etablissements');
        $this->addRelation('Region', 'Cungfoo\\Model\\Region', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'Regions');
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
  'i18n_columns' => 'name,presentation,transport,categorie,type, slug,seo_title,seo_description,seo_h1,seo_keywords,active_locale',
  'i18n_pk_name' => NULL,
  'locale_column' => 'locale',
  'default_locale' => 'fr',
  'locale_alias' => '',
),
            'crudable' =>  array (
  'route_prefix' => '/',
  'crud_prefix' => '/points-interet',
  'crud_model' => NULL,
  'crud_form' => NULL,
  'crud_type_file' => NULL,
  'crud_search' => 'name',
),
            'seo' =>  array (
  'seo_columns' => 'seo_title,seo_description,seo_h1,seo_keywords',
  'seo_description' => 'LONGVARCHAR',
  'seo_keywords' => 'LONGVARCHAR',
),
        );
    } // getBehaviors()

} // PointInteretTableMap
