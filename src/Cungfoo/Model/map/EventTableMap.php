<?php

namespace Cungfoo\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'event' table.
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
class EventTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Cungfoo.Model.map.EventTableMap';

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
        $this->setName('event');
        $this->setPhpName('Event');
        $this->setClassname('Cungfoo\\Model\\Event');
        $this->setPackage('Cungfoo.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('CODE', 'Code', 'VARCHAR', true, 255, null);
        $this->addColumn('CATEGORY', 'Category', 'VARCHAR', false, 255, null);
        $this->addColumn('ADDRESS', 'Address', 'VARCHAR', false, 255, null);
        $this->addColumn('ADDRESS2', 'Address2', 'VARCHAR', false, 255, null);
        $this->addColumn('ZIPCODE', 'Zipcode', 'VARCHAR', false, 255, null);
        $this->addColumn('CITY', 'City', 'VARCHAR', false, 255, null);
        $this->addColumn('GEO_COORDINATE_X', 'GeoCoordinateX', 'VARCHAR', false, 255, null);
        $this->addColumn('GEO_COORDINATE_Y', 'GeoCoordinateY', 'VARCHAR', false, 255, null);
        $this->addColumn('DISTANCE_CAMPING', 'DistanceCamping', 'VARCHAR', false, 255, null);
        $this->addColumn('IMAGE', 'Image', 'VARCHAR', false, 255, null);
        $this->addColumn('PRIORITY', 'Priority', 'VARCHAR', false, 255, null);
        $this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('ENABLED', 'Enabled', 'BOOLEAN', false, 1, false);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('EtablissementEvent', 'Cungfoo\\Model\\EtablissementEvent', RelationMap::ONE_TO_MANY, array('id' => 'event_id', ), null, null, 'EtablissementEvents');
        $this->addRelation('EventI18n', 'Cungfoo\\Model\\EventI18n', RelationMap::ONE_TO_MANY, array('id' => 'id', ), 'CASCADE', null, 'EventI18ns');
        $this->addRelation('Etablissement', 'Cungfoo\\Model\\Etablissement', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'Etablissements');
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
            'timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', 'disable_updated_at' => 'false', ),
            'i18n' => array('i18n_table' => '%TABLE%_i18n', 'i18n_phpname' => '%PHPNAME%I18n', 'i18n_columns' => 'name, str_date,subtitle', 'i18n_pk_name' => '', 'locale_column' => 'locale', 'default_locale' => 'fr', 'locale_alias' => '', ),
            'crudable' => array('route_prefix' => '/', 'crud_prefix' => '/events', 'crud_model' => '', 'crud_form' => '', 'crud_type_file' => '', ),
        );
    } // getBehaviors()

} // EventTableMap
