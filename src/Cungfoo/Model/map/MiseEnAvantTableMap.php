<?php

namespace Cungfoo\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'mise_en_avant' table.
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
class MiseEnAvantTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Cungfoo.Model.map.MiseEnAvantTableMap';

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
        $this->setName('mise_en_avant');
        $this->setPhpName('MiseEnAvant');
        $this->setClassname('Cungfoo\\Model\\MiseEnAvant');
        $this->setPackage('Cungfoo.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('IMAGE_FOND_PATH', 'ImageFondPath', 'VARCHAR', false, 255, null);
        $this->addColumn('PRIX', 'Prix', 'VARCHAR', false, 255, null);
        $this->addColumn('ILLUSTRATION_PATH', 'IllustrationPath', 'VARCHAR', false, 255, null);
        $this->addColumn('DATE_FIN_VALIDITE', 'DateFinValidite', 'DATE', false, null, null);
        $this->addColumn('SORTABLE_RANK', 'SortableRank', 'INTEGER', false, null, null);
        $this->addColumn('ACTIVE', 'Active', 'BOOLEAN', false, 1, false);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('MiseEnAvantI18n', 'Cungfoo\\Model\\MiseEnAvantI18n', RelationMap::ONE_TO_MANY, array('id' => 'id', ), 'CASCADE', null, 'MiseEnAvantI18ns');
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
            'sortable' => array('rank_column' => 'sortable_rank', 'use_scope' => 'false', 'scope_column' => 'sortable_scope', ),
            'active' => array('active_column' => 'active', ),
            'i18n' => array('i18n_table' => '%TABLE%_i18n', 'i18n_phpname' => '%PHPNAME%I18n', 'i18n_columns' => 'titre, accroche, lien, titre_lien', 'i18n_pk_name' => '', 'locale_column' => 'locale', 'default_locale' => 'fr', 'locale_alias' => '', ),
            'crudable' => array('route_prefix' => '/', 'crud_prefix' => '/mise-en-avant', 'crud_model' => '', 'crud_form' => '', 'crud_type_file' => 'image_fond_path, illustration_path', ),
        );
    } // getBehaviors()

} // MiseEnAvantTableMap
