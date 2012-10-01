<?php

namespace Cungfoo\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'type_hebergement' table.
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
class TypeHebergementTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Cungfoo.Model.map.TypeHebergementTableMap';

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
        $this->setName('type_hebergement');
        $this->setPhpName('TypeHebergement');
        $this->setClassname('Cungfoo\\Model\\TypeHebergement');
        $this->setPackage('Cungfoo.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('CODE', 'Code', 'VARCHAR', true, 255, null);
        $this->addForeignKey('CATEGORY_TYPE_HEBERGEMENT_ID', 'CategoryTypeHebergementId', 'INTEGER', 'category_type_hebergement', 'ID', false, null, null);
        $this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('CategoryTypeHebergement', 'Cungfoo\\Model\\CategoryTypeHebergement', RelationMap::MANY_TO_ONE, array('category_type_hebergement_id' => 'id', ), null, null);
        $this->addRelation('EtablissementTypeHebergement', 'Cungfoo\\Model\\EtablissementTypeHebergement', RelationMap::ONE_TO_MANY, array('id' => 'type_hebergement_id', ), null, null, 'EtablissementTypeHebergements');
        $this->addRelation('TypeHebergementI18n', 'Cungfoo\\Model\\TypeHebergementI18n', RelationMap::ONE_TO_MANY, array('id' => 'id', ), 'CASCADE', null, 'TypeHebergementI18ns');
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
            'i18n' => array('i18n_table' => '%TABLE%_i18n', 'i18n_phpname' => '%PHPNAME%I18n', 'i18n_columns' => 'name', 'i18n_pk_name' => '', 'locale_column' => 'locale', 'default_locale' => 'fr', 'locale_alias' => '', ),
            'crudable' => array('route_prefix' => '/', 'crud_prefix' => '/type-hebergement', 'crud_model' => '', 'crud_form' => '', 'crud_type_file' => '', ),
        );
    } // getBehaviors()

} // TypeHebergementTableMap
