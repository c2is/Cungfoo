<?php

namespace Cungfoo\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'etablissement_type_hebergement_i18n' table.
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
class EtablissementTypeHebergementI18nTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Cungfoo.Model.map.EtablissementTypeHebergementI18nTableMap';

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
        $this->setName('etablissement_type_hebergement_i18n');
        $this->setPhpName('EtablissementTypeHebergementI18n');
        $this->setClassname('Cungfoo\\Model\\EtablissementTypeHebergementI18n');
        $this->setPackage('Cungfoo.Model');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('id', 'Id', 'INTEGER' , 'etablissement_type_hebergement', 'id', true, null, null);
        $this->addPrimaryKey('locale', 'Locale', 'VARCHAR', true, 5, 'fr');
        $this->addColumn('minimum_price', 'MinimumPrice', 'VARCHAR', false, 255, null);
        $this->addColumn('minimum_price_discount_label', 'MinimumPriceDiscountLabel', 'VARCHAR', false, 255, null);
        $this->addColumn('minimum_price_start_date', 'MinimumPriceStartDate', 'DATE', false, null, null);
        $this->addColumn('minimum_price_end_date', 'MinimumPriceEndDate', 'DATE', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('EtablissementTypeHebergement', 'Cungfoo\\Model\\EtablissementTypeHebergement', RelationMap::MANY_TO_ONE, array('id' => 'id', ), 'CASCADE', null);
    } // buildRelations()

} // EtablissementTypeHebergementI18nTableMap
