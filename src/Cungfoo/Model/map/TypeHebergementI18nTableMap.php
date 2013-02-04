<?php

namespace Cungfoo\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'type_hebergement_i18n' table.
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
class TypeHebergementI18nTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Cungfoo.Model.map.TypeHebergementI18nTableMap';

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
        $this->setName('type_hebergement_i18n');
        $this->setPhpName('TypeHebergementI18n');
        $this->setClassname('Cungfoo\\Model\\TypeHebergementI18n');
        $this->setPackage('Cungfoo.Model');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('id', 'Id', 'INTEGER' , 'type_hebergement', 'id', true, null, null);
        $this->addPrimaryKey('locale', 'Locale', 'VARCHAR', true, 5, 'fr');
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('slug', 'Slug', 'VARCHAR', false, 255, null);
        $this->addColumn('indice', 'Indice', 'VARCHAR', false, 255, null);
        $this->addColumn('surface', 'Surface', 'VARCHAR', false, 255, null);
        $this->addColumn('type_terrasse', 'TypeTerrasse', 'VARCHAR', false, 255, null);
        $this->addColumn('description', 'Description', 'LONGVARCHAR', false, null, null);
        $this->addColumn('composition', 'Composition', 'LONGVARCHAR', false, null, null);
        $this->addColumn('presentation', 'Presentation', 'LONGVARCHAR', false, null, null);
        $this->addColumn('capacite_hebergement', 'CapaciteHebergement', 'LONGVARCHAR', false, null, null);
        $this->addColumn('dimensions', 'Dimensions', 'LONGVARCHAR', false, null, null);
        $this->addColumn('agencement', 'Agencement', 'LONGVARCHAR', false, null, null);
        $this->addColumn('equipements', 'Equipements', 'LONGVARCHAR', false, null, null);
        $this->addColumn('annee_utilisation', 'AnneeUtilisation', 'LONGVARCHAR', false, null, null);
        $this->addColumn('remarque_1', 'Remarque1', 'LONGVARCHAR', false, null, null);
        $this->addColumn('remarque_2', 'Remarque2', 'LONGVARCHAR', false, null, null);
        $this->addColumn('remarque_3', 'Remarque3', 'LONGVARCHAR', false, null, null);
        $this->addColumn('remarque_4', 'Remarque4', 'LONGVARCHAR', false, null, null);
        $this->addColumn('active_locale', 'ActiveLocale', 'BOOLEAN', false, 1, false);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('TypeHebergement', 'Cungfoo\\Model\\TypeHebergement', RelationMap::MANY_TO_ONE, array('id' => 'id', ), 'CASCADE', null);
    } // buildRelations()

} // TypeHebergementI18nTableMap
