<?php

namespace Cungfoo\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'mise_en_avant_i18n' table.
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
class MiseEnAvantI18nTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Cungfoo.Model.map.MiseEnAvantI18nTableMap';

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
        $this->setName('mise_en_avant_i18n');
        $this->setPhpName('MiseEnAvantI18n');
        $this->setClassname('Cungfoo\\Model\\MiseEnAvantI18n');
        $this->setPackage('Cungfoo.Model');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('ID', 'Id', 'INTEGER' , 'mise_en_avant', 'ID', true, null, null);
        $this->addPrimaryKey('LOCALE', 'Locale', 'VARCHAR', true, 5, 'fr');
        $this->addColumn('TITRE', 'Titre', 'VARCHAR', false, 255, null);
        $this->addColumn('ACCROCHE', 'Accroche', 'VARCHAR', false, 255, null);
        $this->addColumn('LIEN', 'Lien', 'VARCHAR', false, 255, null);
        $this->addColumn('TITRE_LIEN', 'TitreLien', 'VARCHAR', false, 255, null);
        $this->addColumn('PRIX', 'Prix', 'VARCHAR', false, 255, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('MiseEnAvant', 'Cungfoo\\Model\\MiseEnAvant', RelationMap::MANY_TO_ONE, array('id' => 'id', ), 'CASCADE', null);
    } // buildRelations()

} // MiseEnAvantI18nTableMap
