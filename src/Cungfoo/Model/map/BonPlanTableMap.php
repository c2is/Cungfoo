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
        $this->addColumn('date_debut', 'DateDebut', 'DATE', false, null, null);
        $this->addColumn('date_fin', 'DateFin', 'DATE', false, null, null);
        $this->addColumn('prix', 'Prix', 'INTEGER', false, null, null);
        $this->addColumn('prix_barre', 'PrixBarre', 'INTEGER', false, null, null);
        $this->addColumn('image_menu', 'ImageMenu', 'VARCHAR', false, 255, null);
        $this->addColumn('image_page', 'ImagePage', 'VARCHAR', false, 255, null);
        $this->addColumn('image_liste', 'ImageListe', 'VARCHAR', false, 255, null);
        $this->addColumn('active_compteur', 'ActiveCompteur', 'BOOLEAN', false, 1, null);
        $this->addColumn('mise_en_avant', 'MiseEnAvant', 'BOOLEAN', false, 1, null);
        $this->addColumn('push_home', 'PushHome', 'BOOLEAN', false, 1, null);
        $this->addColumn('date_start', 'DateStart', 'DATE', false, null, null);
        $this->addColumn('day_start', 'DayStart', 'ENUM', true, null, null);
        $this->getColumn('day_start', false)->setValueSet(array (
  0 => 'monday',
  1 => 'tuesday',
  2 => 'wednesday',
  3 => 'thursday',
  4 => 'friday',
  5 => 'saturday',
  6 => 'sunday',
));
        $this->addColumn('day_range', 'DayRange', 'ENUM', true, null, null);
        $this->getColumn('day_range', false)->setValueSet(array (
  0 => '7',
  1 => '14',
  2 => '21',
));
        $this->addColumn('nb_adultes', 'NbAdultes', 'INTEGER', false, null, 1);
        $this->addColumn('nb_enfants', 'NbEnfants', 'INTEGER', false, null, 0);
        $this->addColumn('period_categories', 'PeriodCategories', 'VARCHAR', false, 255, null);
        $this->addColumn('active', 'Active', 'BOOLEAN', false, 1, false);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('BonPlanBonPlanCategorie', 'Cungfoo\\Model\\BonPlanBonPlanCategorie', RelationMap::ONE_TO_MANY, array('id' => 'bon_plan_id', ), null, null, 'BonPlanBonPlanCategories');
        $this->addRelation('BonPlanEtablissement', 'Cungfoo\\Model\\BonPlanEtablissement', RelationMap::ONE_TO_MANY, array('id' => 'bon_plan_id', ), 'CASCADE', null, 'BonPlanEtablissements');
        $this->addRelation('BonPlanRegion', 'Cungfoo\\Model\\BonPlanRegion', RelationMap::ONE_TO_MANY, array('id' => 'bon_plan_id', ), 'CASCADE', null, 'BonPlanRegions');
        $this->addRelation('BonPlanI18n', 'Cungfoo\\Model\\BonPlanI18n', RelationMap::ONE_TO_MANY, array('id' => 'id', ), 'CASCADE', null, 'BonPlanI18ns');
        $this->addRelation('BonPlanCategorie', 'Cungfoo\\Model\\BonPlanCategorie', RelationMap::MANY_TO_MANY, array(), null, null, 'BonPlanCategories');
        $this->addRelation('Etablissement', 'Cungfoo\\Model\\Etablissement', RelationMap::MANY_TO_MANY, array(), null, null, 'Etablissements');
        $this->addRelation('Region', 'Cungfoo\\Model\\Region', RelationMap::MANY_TO_MANY, array(), null, null, 'Regions');
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
  'i18n_columns' => 'name, slug, introduction, description, indice, indice_prix',
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
  'crud_type_file' => 'image_menu,image_page,image_liste',
),
        );
    } // getBehaviors()

} // BonPlanTableMap
