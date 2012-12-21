<?php

namespace Cungfoo\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'bon_plan' table.
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
class BonPlanTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Cungfoo.Model.map.BonPlanTableMap';

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
        $this->setName('bon_plan');
        $this->setPhpName('BonPlan');
        $this->setClassname('Cungfoo\\Model\\BonPlan');
        $this->setPackage('Cungfoo.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('bon_plan_categorie_id', 'BonPlanCategorieId', 'INTEGER', 'bon_plan_categorie', 'id', true, null, null);
        $this->addColumn('date_debut', 'DateDebut', 'DATE', false, null, null);
        $this->addColumn('date_fin', 'DateFin', 'DATE', false, null, null);
        $this->addColumn('prix', 'Prix', 'INTEGER', false, null, null);
        $this->addColumn('prix_barre', 'PrixBarre', 'INTEGER', false, null, null);
        $this->addColumn('image_menu', 'ImageMenu', 'VARCHAR', false, 255, null);
        $this->addColumn('image_page', 'ImagePage', 'VARCHAR', false, 255, null);
        $this->addColumn('active', 'Active', 'BOOLEAN', false, 1, false);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('BonPlanCategorie', 'Cungfoo\\Model\\BonPlanCategorie', RelationMap::MANY_TO_ONE, array('bon_plan_categorie_id' => 'id', ), null, null);
        $this->addRelation('BonPlanI18n', 'Cungfoo\\Model\\BonPlanI18n', RelationMap::ONE_TO_MANY, array('id' => 'id', ), 'CASCADE', null, 'BonPlanI18ns');
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
  'i18n_columns' => 'name, slug, introduction, description, indice',
  'i18n_pk_name' => NULL,
  'locale_column' => 'locale',
  'default_locale' => 'fr',
  'locale_alias' => '',
),
            'crudable' =>  array (
  'route_prefix' => '/',
  'crud_prefix' => '/bons-plans',
  'crud_model' => NULL,
  'crud_form' => NULL,
  'crud_type_file' => 'image_menu,image_page',
),
        );
    } // getBehaviors()

} // BonPlanTableMap
