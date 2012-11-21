<?php

namespace Cungfoo\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'dernieres_minutes' table.
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
class DernieresMinutesTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Cungfoo.Model.map.DernieresMinutesTableMap';

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
        $this->setName('dernieres_minutes');
        $this->setPhpName('DernieresMinutes');
        $this->setClassname('Cungfoo\\Model\\DernieresMinutes');
        $this->setPackage('Cungfoo.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('DATE_START', 'DateStart', 'DATE', false, null, null);
        $this->addColumn('DAY_START', 'DayStart', 'ENUM', true, null, null);
        $this->getColumn('DAY_START', false)->setValueSet(array (
  0 => 'monday',
  1 => 'tuesday',
  2 => 'wednesday',
  3 => 'thursday',
  4 => 'friday',
  5 => 'saturday',
  6 => 'sunday',
));
        $this->addColumn('DAY_RANGE', 'DayRange', 'ENUM', true, null, null);
        $this->getColumn('DAY_RANGE', false)->setValueSet(array (
  0 => '7',
  1 => '14',
  2 => '21',
));
        $this->addColumn('ACTIVE', 'Active', 'BOOLEAN', false, 1, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('DernieresMinutesEtablissement', 'Cungfoo\\Model\\DernieresMinutesEtablissement', RelationMap::ONE_TO_MANY, array('id' => 'dernieres_minutes_id', ), 'CASCADE', null, 'DernieresMinutesEtablissements');
        $this->addRelation('DernieresMinutesDestination', 'Cungfoo\\Model\\DernieresMinutesDestination', RelationMap::ONE_TO_MANY, array('id' => 'dernieres_minutes_id', ), 'CASCADE', null, 'DernieresMinutesDestinations');
        $this->addRelation('Etablissement', 'Cungfoo\\Model\\Etablissement', RelationMap::MANY_TO_MANY, array(), null, null, 'Etablissements');
        $this->addRelation('Destination', 'Cungfoo\\Model\\Destination', RelationMap::MANY_TO_MANY, array(), null, null, 'Destinations');
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
            'crudable' => array('route_prefix' => '/', 'crud_prefix' => '/dernieres_minutes', 'crud_model' => '', 'crud_form' => '', 'crud_type_file' => '', ),
        );
    } // getBehaviors()

} // DernieresMinutesTableMap
