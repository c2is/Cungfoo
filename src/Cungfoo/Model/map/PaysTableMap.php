<?php

namespace Cungfoo\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'pays' table.
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
class PaysTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Cungfoo.Model.map.PaysTableMap';

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
        $this->setName('pays');
        $this->setPhpName('Pays');
        $this->setClassname('Cungfoo\\Model\\Pays');
        $this->setPackage('Cungfoo.Model');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'VARCHAR', true, 255, null);
        $this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Region', 'Cungfoo\\Model\\Region', RelationMap::ONE_TO_MANY, array('id' => 'pays_id', ), null, null, 'Regions');
        $this->addRelation('PaysI18n', 'Cungfoo\\Model\\PaysI18n', RelationMap::ONE_TO_MANY, array('id' => 'id', ), 'CASCADE', null, 'PaysI18ns');
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
            'i18n' => array('i18n_table' => '%TABLE%_i18n', 'i18n_phpname' => '%PHPNAME%I18n', 'i18n_columns' => 'name', 'i18n_pk_name' => '', 'locale_column' => 'locale', 'default_locale' => 'fr', 'locale_alias' => '', ),
            'crudable' => array('route_controller' => '', 'route_prefix' => '', 'routes_file' => '', 'languages_file' => '', 'crud_prefix' => '/pays', 'crud_model' => '', 'crud_form' => '', ),
        );
    } // getBehaviors()

} // PaysTableMap