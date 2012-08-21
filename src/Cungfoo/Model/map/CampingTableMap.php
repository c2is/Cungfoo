<?php

namespace Cungfoo\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'camping' table.
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
class CampingTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Cungfoo.Model.map.CampingTableMap';

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
        $this->setName('camping');
        $this->setPhpName('Camping');
        $this->setClassname('Cungfoo\\Model\\Camping');
        $this->setPackage('Cungfoo.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('ADRESS', 'Adress', 'VARCHAR', true, 255, null);
        $this->addColumn('PHONE', 'Phone', 'VARCHAR', true, 255, null);
        $this->addForeignKey('SITE_ID', 'SiteId', 'INTEGER', 'site', 'ID', false, null, null);
        $this->addForeignKey('SAISON_ID', 'SaisonId', 'INTEGER', 'saison', 'ID', false, null, null);
        $this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Site', 'Cungfoo\\Model\\Site', RelationMap::MANY_TO_ONE, array('site_id' => 'id', ), null, null);
        $this->addRelation('Saison', 'Cungfoo\\Model\\Saison', RelationMap::MANY_TO_ONE, array('saison_id' => 'id', ), null, null);
        $this->addRelation('CampingI18n', 'Cungfoo\\Model\\CampingI18n', RelationMap::ONE_TO_MANY, array('id' => 'id', ), 'CASCADE', null, 'CampingI18ns');
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
            'i18n' => array('i18n_table' => '%TABLE%_i18n', 'i18n_phpname' => '%PHPNAME%I18n', 'i18n_columns' => 'name, description', 'locale_column' => 'locale', 'default_locale' => '', 'locale_alias' => 'culture', ),
            'crudable' => array('route_controller' => '', 'route_prefix' => '', 'routes_file' => '', 'languages_file' => '', 'crud_prefix' => '/camping', 'crud_model' => '', 'crud_form' => '', ),
        );
    } // getBehaviors()

} // CampingTableMap
