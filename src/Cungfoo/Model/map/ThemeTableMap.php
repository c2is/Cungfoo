<?php

namespace Cungfoo\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'theme' table.
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
class ThemeTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Cungfoo.Model.map.ThemeTableMap';

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
        $this->setName('theme');
        $this->setPhpName('Theme');
        $this->setClassname('Cungfoo\\Model\\Theme');
        $this->setPackage('Cungfoo.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('image_path', 'ImagePath', 'VARCHAR', false, 255, null);
        $this->addColumn('active', 'Active', 'BOOLEAN', false, 1, false);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('ThemeActivite', 'Cungfoo\\Model\\ThemeActivite', RelationMap::ONE_TO_MANY, array('id' => 'theme_id', ), null, null, 'ThemeActivites');
        $this->addRelation('ThemeBaignade', 'Cungfoo\\Model\\ThemeBaignade', RelationMap::ONE_TO_MANY, array('id' => 'theme_id', ), null, null, 'ThemeBaignades');
        $this->addRelation('ThemeServiceComplementaire', 'Cungfoo\\Model\\ThemeServiceComplementaire', RelationMap::ONE_TO_MANY, array('id' => 'theme_id', ), null, null, 'ThemeServiceComplementaires');
        $this->addRelation('ThemePersonnage', 'Cungfoo\\Model\\ThemePersonnage', RelationMap::ONE_TO_MANY, array('id' => 'theme_id', ), null, null, 'ThemePersonnages');
        $this->addRelation('ThemeI18n', 'Cungfoo\\Model\\ThemeI18n', RelationMap::ONE_TO_MANY, array('id' => 'id', ), 'CASCADE', null, 'ThemeI18ns');
        $this->addRelation('Activite', 'Cungfoo\\Model\\Activite', RelationMap::MANY_TO_MANY, array(), null, null, 'Activites');
        $this->addRelation('Baignade', 'Cungfoo\\Model\\Baignade', RelationMap::MANY_TO_MANY, array(), null, null, 'Baignades');
        $this->addRelation('ServiceComplementaire', 'Cungfoo\\Model\\ServiceComplementaire', RelationMap::MANY_TO_MANY, array(), null, null, 'ServiceComplementaires');
        $this->addRelation('Personnage', 'Cungfoo\\Model\\Personnage', RelationMap::MANY_TO_MANY, array(), null, null, 'Personnages');
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
            'active' =>  array (
  'active_column' => 'active',
),
            'i18n' =>  array (
  'i18n_table' => '%TABLE%_i18n',
  'i18n_phpname' => '%PHPNAME%I18n',
  'i18n_columns' => 'name, slug, introduction, description',
  'i18n_pk_name' => NULL,
  'locale_column' => 'locale',
  'default_locale' => 'fr',
  'locale_alias' => '',
),
            'crudable' =>  array (
  'route_prefix' => '/',
  'crud_prefix' => '/theme',
  'crud_model' => NULL,
  'crud_form' => NULL,
  'crud_type_file' => 'image_path',
),
        );
    } // getBehaviors()

} // ThemeTableMap
