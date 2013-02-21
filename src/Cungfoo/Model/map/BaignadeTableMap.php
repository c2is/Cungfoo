<?php

namespace Cungfoo\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'baignade' table.
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
class BaignadeTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Cungfoo.Model.map.BaignadeTableMap';

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
        $this->setName('baignade');
        $this->setPhpName('Baignade');
        $this->setClassname('Cungfoo\\Model\\Baignade');
        $this->setPackage('Cungfoo.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('code', 'Code', 'VARCHAR', true, 255, null);
        $this->addColumn('image_path', 'ImagePath', 'VARCHAR', false, 255, null);
        $this->addColumn('vignette', 'Vignette', 'VARCHAR', false, 255, null);
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
        $this->addRelation('EtablissementBaignade', 'Cungfoo\\Model\\EtablissementBaignade', RelationMap::ONE_TO_MANY, array('id' => 'baignade_id', ), 'CASCADE', null, 'EtablissementBaignades');
        $this->addRelation('ThemeBaignade', 'Cungfoo\\Model\\ThemeBaignade', RelationMap::ONE_TO_MANY, array('id' => 'baignade_id', ), 'CASCADE', null, 'ThemeBaignades');
        $this->addRelation('BaignadeI18n', 'Cungfoo\\Model\\BaignadeI18n', RelationMap::ONE_TO_MANY, array('id' => 'id', ), 'CASCADE', null, 'BaignadeI18ns');
        $this->addRelation('Etablissement', 'Cungfoo\\Model\\Etablissement', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'Etablissements');
        $this->addRelation('Theme', 'Cungfoo\\Model\\Theme', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'Themes');
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
  'i18n_columns' => 'name, description, keywords,seo_title,seo_description,seo_h1,seo_keywords,active_locale',
  'i18n_pk_name' => NULL,
  'locale_column' => 'locale',
  'default_locale' => 'fr',
  'locale_alias' => '',
),
            'crudable' =>  array (
  'route_prefix' => '/',
  'crud_prefix' => '/baignades',
  'crud_model' => NULL,
  'crud_form' => NULL,
  'crud_type_file' => 'image_path, vignette',
  'crud_search' => 'name',
),
            'seo' =>  array (
  'seo_columns' => 'seo_title,seo_description,seo_h1,seo_keywords',
  'seo_description' => 'LONGVARCHAR',
  'seo_keywords' => 'LONGVARCHAR',
),
        );
    } // getBehaviors()

} // BaignadeTableMap
